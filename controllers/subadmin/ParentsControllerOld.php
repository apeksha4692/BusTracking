<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentsController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('csvimport');
	}

    public function parents_list()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('parent');

        $data['parents_count'] = $this->CommonModel->select_single_row("Select count(*) as parents_total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
// print_r($data['parents_count'] );die;
        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);
// print_r( $data['getAllChaperone'] );die;
        $this->loadSubAdminView('subadmin/parents/list',$data); 
    }

    public function parents_add()
    {   
        // echo "string";die;
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $condition = array(
            'id' => $getSubAdminData->client_id,
        );

        $cleintDetail = $this->CommonModel->selectRowDataByCondition($condition,'client');

        $condition1 = array(
            "client_user_id"    => $this->session->userdata('ses_subadmin_id'),
        );

        $totalCount  = $this->CommonModel->countDataWithCondition('parents',$condition1);

        if($cleintDetail->max_chaperone <= $totalCount)
        {
              $this->session->set_flashdata('error',$this->lang->line('max_parents'));
                redirect('subadmin/parents'); 
        }
        else{
            $data['title'] = $this->lang->line('add_new_parent');

            $where = array(
                "is_delete"         =>  0,
                "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
            );

            $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

            $this->loadSubAdminView('subadmin/parents/add',$data); 
        }
    }

    public function parents_insert()
    {
        $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

        $count_data= $parents_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $parents_code = 'Parent'.$rand; 

        // print_r($driver_code);die;
        $parents_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "parents_unique_id"     =>  $parents_code,
                    "parents_name"      	=>  $parents_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    // "bus_id"        		=>  $this->input->post('bus_id'),
                    "note"        			=>  $this->input->post('note'),
                    "secret_code"           =>  $this->input->post('secret_code'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'parents');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_add_successfully'));
            // redirect('subadmin/parents_add');
             redirect('subadmin/parents'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('parent_not_add_successfully'));
             redirect('subadmin/parents_add'); 
            
        }

    }

    public function view_bus()
    {

        $data['title'] = $this->lang->line('bus_detail');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['busDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        // print_r($data['busDetail']);die;

        $this->loadSubAdminView('subadmin/bus/view_bus',$data); 
    }

    public function parents_edit()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('edit_parent');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['parentDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        // print_r($data['driverDetail']);die;

         $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        // $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');
        $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

        $this->loadSubAdminView('subadmin/parents/edit',$data); 
    }

    public function parents_update()
    {
        // echo "string";die;
        // print_r($_POST);die;
        $condition = array(
                'id' => $this->input->post('parent_id')
        );

      	$parents_name = $this->input->post('f_name').' '.$this->input->post('family_name');


        $data = array(
                    "parents_name"          =>  $parents_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    // "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_update_successfully'));
            // redirect('subadmin/parents_edit/'.$this->input->post('parent_id')); 
             redirect('subadmin/parents');
        }else{

            $this->session->set_flashdata('error',$this->lang->line('parent_not_update_successfully'));
             redirect('subadmin/parents_edit/'.$this->input->post('parent_id'));    
        }
    }

    public function changeStatus()
    {
    	// print_r($_POST);die;

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('parents_id')),'parents');

        $condition = array(
            "id" => $this->input->post('parents_id')
        );
        if($data->parents_status == 1){
            $data = array("parents_status" => '0');
        }else{
            $data = array("parents_status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_parents()
    {
        $val = explode(',',($this->input->post('parentsId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'parents');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'parents'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/parents'); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_delete_successfully'));
             redirect('subadmin/parents'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('parent_not_delete_successfully'));
             redirect('subadmin/parents'); 
        }
           
    }

    public function delete()
    {
        // echo "string";die;
        $where = array('id'=>$this->uri->segment(4));

        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(4)),'parents');

        if($busData){
            
            $updateData = $this->CommonModel->delete($where,'parents'); 

             if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('parent_delete_successfully'));
                 redirect('subadmin/parents'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('parent_not_delete_successfully'));
                 redirect('subadmin/parents'); 
            }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
             redirect('subadmin/parents');
            
        }
    }

    public function import_parent_old()
    {
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        // print_r($path);die;
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

                $count_data= $parents_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $parents_code = 'Parent'.$rand; 

                $parent_name     =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $parent_mobile   =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $parent_note     =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $secret_code        =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                // print_r($chaperone_name);
                // print_r($chaperone_mobile);
                // print_r($assign_bus);
                // print_r($chaperone_note);
                // print_r($secret_code);
                // echo "<br>";
                $where = array('bus_plate_number'=>$assign_bus);
                $busDetail = $this->CommonModel->getsingle('bus',$where);

                if(!empty($busDetail))
                {
                    $bus_id = $busDetail->id;

                }else{

                    $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

                    $count_data= $busdata_max+1;//autoincrement

                    $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                    $bus_code = 'BUS'.$rand;
                    

                     $data = array(
                        "bus_plate_number"      =>  $assign_bus,
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "bus_unique_id"         =>  $bus_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $busInsert = $this->CommonModel->insertData($data,'bus'); 

                    $bus_id = $this->db->insert_id();
                    // return  $insert_id; 
                }
                $where = array('phone_number'=>$parent_mobile);
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);

                if(!empty($chaperoneDetail))
                {
                    $condition = array('id'=>$parentsDetail->id);

                    $data = array(
                        "parents_name"          =>  $parent_name,
                        "phone_number"          =>  $parent_mobile,
                        "bus_id"                =>  $bus_id,
                        "note"                  =>  $parent_note,
                        "secret_code"           =>  $secret_code,
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

                    $set = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  

                }else{                   


                     $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "parents_unique_id"     =>  $parents_code,
                        "parents_name"          =>  $parent_name,
                        "phone_number"          =>  $parent_mobile,
                        "bus_id"                =>  $bus_id,
                        "note"                  =>  $parent_note,
                        "secret_code"           =>  $secret_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

                    $set = $this->CommonModel->insertData($data,'parents');  
                }
            }
            // die;
            if($set)
            {
                echo "1";
            }else{
                echo "0";
            }
        }   
    }
    
    
     public function import_parent()
    {
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;

        foreach($file_data as $row)
        {
            $parent_name     =    $row["Parents Name"];
            $parent_mobile   =    $row["Mobile Numbe"];
            $parent_note     =    $row["Note"];
            $secret_code     =    $row["Security Code"];

            $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

            $count_data= $parents_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $parents_code = 'Parent'.$rand; 


            $where = array('phone_number'=>$parent_mobile);
            $parentsDetail = $this->CommonModel->getsingle('parents',$where);

            if(!empty($chaperoneDetail))
            {
                $condition = array('id'=>$parentsDetail->id);

                $data = array(
                    "parents_name"          =>  $parent_name,
                    "phone_number"          =>  $parent_mobile,
                    "note"                  =>  $parent_note,
                    "secret_code"           =>  $secret_code,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  

            }else{                   
                 $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "parents_unique_id"     =>  $parents_code,
                    "parents_name"          =>  $parent_name,
                    "phone_number"          =>  $parent_mobile,
                    "note"                  =>  $parent_note,
                    "secret_code"           =>  $secret_code,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->insertData($data,'parents');  
            }
        }

        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }

    }
     public function excelParentsList()
    {
        $fileName = 'parents-'.time().'.xlsx';  

        $ids = $this->input->post('parentId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getParentExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('parents_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('parent_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('assigned_bus'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('note'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('secret_code'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['parents_status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['parents_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['parents_unique_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['bus_unique_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['note']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['secret_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $status);
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

    public function pdfParentsList()
    {
        // print_r($_POST);die;
        $fileName = 'parents-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('parentId');
        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('parent').'</h3>';
        $html_content .= $this->PdfModel->getParentPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
 
    }
    
    

}
