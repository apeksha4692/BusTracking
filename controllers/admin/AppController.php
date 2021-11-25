<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function app_list()
    {
        // echo "string";die;
         $data['app_related_count'] = $this->CommonModel->select_single_row("Select count(*) as total from app_related ");

        $data['title'] = 'Client List';


        $data['getAllApp'] = $this->CommonModel->app_list();

        $this->loadAdminView('admin/app/list',$data); 
    }

/*app_version
                                    release_date
                                    android_ready
                                    ios_ready
*/
    public function app_add()
    {
        // echo "string";die;
        $data['title'] = $this->lang->line('add_app_version');

         $this->loadAdminView('admin/app/add_app',$data); 
    }

    public function app_insert()
    {
        // print_r($_POST);die;
        $data = array(
                    "app_version"      =>  $this->input->post('app_version'),
                    "release_date"     =>  $this->input->post('release_date'),
                    "android_ready"    =>  $this->input->post('android_ready'),
                    "ios_ready"        =>  $this->input->post('ios_ready'),
                    "notes"            =>  $this->input->post('notes'),
                    "created_at"       =>  date('Y-m-d H:i:s a'),
                    "updated_at"       =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'app_related');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('app_version_add_successfully'));
            redirect('admin/app_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('app_version_not_add_successfully'));
            redirect('admin/app_list'); 
            
        }

    }

    public function changeStatus()
    {
        // echo "string";die;
       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('app_id')),'app_related');

        $condition = array(
            "id" => $this->input->post('app_id')
        );
        if($data->app_status == 1){
            $data = array("app_status" => '0');
        }else{
            $data = array("app_status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'app_related',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function delete_app()
    {
        // print_r($_POST);
        
        $val = explode(',',($this->input->post('appId')));
        
        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $appData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'app_related');
            
            if($appData)
            {
                
                $updateData = $this->CommonModel->delete($where,'app_related'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('app_version_not_delete_successfully'));
                redirect('admin/app_list'); 
            }
        }

       if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('app_version_delete_successfully'));
            redirect('admin/app_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('app_version_not_delete_successfully'));
             redirect('admin/app_list'); 
        }

    }
    public function delete()
    {
        // echo "string";die;
        $where = array('id'=>$this->uri->segment(3));
// print_r($where);die;
        $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(3)),'app_related');

        if($clientData){

            $updateData = $this->CommonModel->delete($where,'app_related'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('app_version_delete_successfully'));
                redirect('admin/app_list'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('app_version_not_delete_successfully'));
                 redirect('admin/app_list'); 
            }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('admin/app_list'); 
            
        }
    }
    
    public function editAppId()
    {
        // print_r($_POST);die;
        $ids = $this->input->post('appId');
        // print_r($ids);die;

        redirect('/admin/app_edit/'.$ids);
    }


    public function app_edit()
    {
        $data['title'] = $this->lang->line('edit_app_version');
        $where = array('id'=>$this->uri->segment(3));
        $data['getappData'] = $this->CommonModel->getsingle('app_related',$where);

        $this->loadAdminView('admin/app/edit_app',$data); 
    }

    public function app_update()
    {

        $condition = array(
            "id" => $this->input->post('app_id')
        );
        
        $data = array(
                    "app_version"      =>  $this->input->post('app_version'),
                    "release_date"     =>  $this->input->post('release_date'),
                    "android_ready"    =>  $this->input->post('android_ready'),
                    "ios_ready"        =>  $this->input->post('ios_ready'),
                    "notes"            =>  $this->input->post('notes'),
                    "created_at"       =>  date('Y-m-d H:i:s a'),
                    "updated_at"       =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'app_related',$data);  


        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('app_version_update_successfully'));
            redirect('admin/app_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('app_version_not_update_successfully'));
            redirect('admin/app_edit/'.$this->input->post('app_id')); 
            
        }
    }
    
    public function excelAppist()
    {
        // print_r($_POST);
        
        $fileName = 'app-'.time().'.xls';
        
        $ids = $this->input->post('appId');
        
        $this->load->library('excel');

        $empInfo = $this->PdfModel->getAppExcel($ids);
        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('app_version'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('release_date'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('android_ready'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('ios_ready'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('note'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            // if($element['bus_status'] ==1)
            // {
            //     $status = $this->lang->line('active');
            // }else{
            //     $status = $this->lang->line('deactive'); 
            // }

            // $date = date("d/m/Y", strtotime($element['updated_at']));

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['app_version']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['release_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['android_ready']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['ios_ready']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,$element['notes']);
            $rowCount++;
            $i++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cutomer_Report.xls"');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }


}
