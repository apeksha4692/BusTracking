<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
         $this->load->library('csvimport');
	}

    public function driver_list()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('driver');

       $data['driver_count'] = $this->CommonModel->select_single_row("Select count(*) as driver_total from driver  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);
// print_r( $data['getAllDriver'] );die;
        $this->loadSubAdminView('subadmin/driver/list',$data); 
    }
    
     public function check_driverNumber()
    {
        $condition = array(
            "drive_mobile_number" => $this->input->post('drive_mobile_number'),
            "client_user_id" => $this->session->userdata('ses_subadmin_id'),
            //  "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'driver');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function driver_add()
    {   
        $data['title'] = $this->lang->line('add_new_driver');

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        // $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');
        // $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $data['getAllBus'] = $this->CommonModel->getBusAvaiable($client_user_id);
        
        $this->loadSubAdminView('subadmin/driver/add_driver',$data); 

    }


    public function driver_insert()
    {
        $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

        $count_data= $driverdata_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $driver_code = 'Driver'.$rand; 

        // print_r($driver_code);die;
        $driver_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"      		=>  $driver_name,
                    "drive_mobile_number"   =>  $this->input->post('drive_mobile_number'),
                    // "bus_id"        		=>  $this->input->post('bus_id'),
                    "note"        			=>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'driver');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_add_successfully'));
            // redirect('subadmin/driver_add');
             redirect('subadmin/driver'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('driver_not_add_successfully'));
             redirect('subadmin/driver_add'); 
            
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

    public function driver_edit()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('edit_driver');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['driverDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'driver');
        // print_r($data['driverDetail']);die;

         $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        // $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');
        $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

        $this->loadSubAdminView('subadmin/driver/edit_driver',$data); 
    }

    public function driver_update()
    {
        // print_r($_POST);die;
        $condition = array(
                'id' => $this->input->post('driver_id')
        );
        // print_r($condition);die;

      	$driver_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "driver_name"      		=>  $driver_name,
                    "drive_mobile_number"   =>  $this->input->post('drive_mobile_number'),
                    // "bus_id"        		=>  $this->input->post('bus_id'),
                    "note"        			=>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_update_successfully'));
             redirect('subadmin/driver');
            // redirect('subadmin/driver_edit/'.$this->input->post('driver_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('driver_not_update_successfully'));
             redirect('subadmin/driver_edit/'.$this->input->post('driver_id')); 
            
        }
    }

    public function changeStatus()
    {
    	// print_r($_POST);die;

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('driver_id')),'driver');

        $condition = array(
            "id" => $this->input->post('driver_id')
        );
        if($data->driver_status == 1){
            $data = array("driver_status" => '0');
        }else{
            $data = array("driver_status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_driver()
    {
    	// echo "string";die;
    	// print_r($_POST);die;
        $val = explode(',',($this->input->post('driverId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'driver');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'driver'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/driver'); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_delete_successfully'));
             redirect('subadmin/driver'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('driver_not_delete_successfully'));
             redirect('subadmin/driver'); 
        }
           
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(4));

        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(4)),'driver');

        if($busData){
            
            $updateData = $this->CommonModel->delete($where,'driver'); 

            if($updateData)
	        {
	            $this->session->set_flashdata('success',$this->lang->line('driver_delete_successfully'));
	             redirect('subadmin/driver'); 
	        }else{
	            $this->session->set_flashdata('error',$this->lang->line('driver_not_delete_successfully'));
	             redirect('subadmin/driver'); 
	        }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('subadmin/driver'); 
            
        }
    }
     public function import_driver()
    {
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

                $count_data= $driverdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $driver_code = 'Driver'.$rand; 


                $driver_name    =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $driver_mobile  =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $driver_note    =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                
                
                $where = array(
                    'drive_mobile_number'=>$driver_mobile,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $driverDetail = $this->CommonModel->getsingle('driver',$where);
    
                if(!empty($driverDetail))
                {
                    $driverNameString[] = $driver_name;
                    $driverName = implode(",", $driverNameString);

                    $driverMobiletring[] = $driver_mobile;
                    $driverMobile = implode(",", $driverMobiletring);

                    $driverNotetring[] = $driver_note;
                    $driverNote = implode(",", $driverNotetring);

                    $comma_string[] = $driverDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr; 
    
                }else{   
                // echo "string";                 

                    $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "driver_unique_id"      =>  $driver_code,
                        "driver_name"           =>  $driver_name,
                        "drive_mobile_number"   =>  $driver_mobile,
                        "note"                  =>  $driver_note,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->insertData($data,'driver');  
                }
            }
            
            // die;

            if($set)
            {
                // echo "1";
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countDriver = $this->CommonModel->countDuplicateDriver($id);
                    // print_r($countBus->busTotal);die;

                    $data = array(
                        'count'         =>  $countDriver->driverTotal,
                        'id'            =>  $arr,
                        'driverName'    =>  $driverName,
                        'driverMobile'  =>  $driverMobile,
                        'driverNote'    =>  $driverNote,
                    );

                    echo json_encode($data);
                }else{
                    // echo "0";
                    echo "1";
                }
            }else{
                echo "0";
            }
        }   
    }

    public function replaceDriverDuplicateData()
    {
        // print_r($_POST);die;

        $id = explode(',',($this->input->post('id'))); 
        $driver_name = explode(',',($this->input->post('driverName'))); 
        $driver_mobile       = explode(',',($this->input->post('driverMobile'))); 
        $driver_note = explode(',',($this->input->post('driverNote'))); 

        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'driver'); 
        }
        // die;

        for ($i=0; $i < count($driver_mobile); $i++) 
        { 
            
            $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

            $count_data= $driverdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $driver_code = 'Driver'.$rand;
            
            $where = array(
                "drive_mobile_number"   =>  $driver_mobile[$i],
                'client_user_id' => $this->session->userdata('ses_subadmin_id')
            );
            $driverDetail = $this->CommonModel->getsingle('driver',$where);
            
            if(!empty($driverDetail))
            {
                $condition = array('id'=>$driverDetail->id);
    
                $data = array(
                   "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name[$i],
                    "drive_mobile_number"   =>  $driver_mobile[$i],
                    "note"                  =>  $driver_note[$i],
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'driver',$data); 
                
            }else{
                 $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name[$i],
                    "drive_mobile_number"   =>  $driver_mobile[$i],
                    "note"                  =>  $driver_note[$i],
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

            //   print_r($data);
                $set = $this->CommonModel->insertData($data,'driver');  
            }    
            
        }
// die;
        // die;
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_update_successfully'));
             redirect('subadmin/driver'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('driver_not_update_successfully'));
             redirect('subadmin/driver'); 
        }
        
    }

    public function import_driverOld()
    {
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

                $count_data= $driverdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $driver_code = 'Driver'.$rand; 


                $driver_name    =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $driver_mobile  =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                // $assign_bus     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $driver_note    =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                
                
                $where = array(
                    'drive_mobile_number'=>$driver_mobile,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $driverDetail = $this->CommonModel->getsingle('driver',$where);
    
                if(!empty($driverDetail))
                {
                    $condition = array('id'=>$driverDetail->id);
    
                    $data = array(
                        "driver_name"           =>  $driver_name,
                        "drive_mobile_number"   =>  $driver_mobile,
                        "note"                  =>  $driver_note,
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  
    
                }else{                    
                    $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "driver_unique_id"      =>  $driver_code,
                        "driver_name"           =>  $driver_name,
                        "drive_mobile_number"   =>  $driver_mobile,
                        "note"                  =>  $driver_note,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->insertData($data,'driver');  
                }
            }
            
            if($set)
            {
                echo "1";
            }else{
                echo "0";
            }
        }   
    }
    
    
     public function import_driver_old()
    {
        // echo "string";die;
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;


        foreach($file_data as $row)
        {

            $driver_name    =   $row["Driver Name"];
            $driver_mobile  =   $row["Driver Mobile Numbe"];
            // $assign_bus     =   $row["Client Name"];
            $driver_note    =   $row["Note"];

            $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');
            $count_data= $driverdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $driver_code = 'Driver'.$rand; 

            $where = array(
                'drive_mobile_number'=>$driver_mobile,
                'client_user_id' => $this->session->userdata('ses_subadmin_id')
            );
            $driverDetail = $this->CommonModel->getsingle('driver',$where);

            if(!empty($driverDetail))
            {
                $condition = array('id'=>$driverDetail->id);

                $data = array(
                    "driver_name"           =>  $driver_name,
                    "drive_mobile_number"   =>  $driver_mobile,
                    "note"                  =>  $driver_note,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  

            }else{                    
                $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name,
                    "drive_mobile_number"   =>  $driver_mobile,
                    "note"                  =>  $driver_note,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->insertData($data,'driver');  
            }
        }

        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }
    //  public function excelDriverList()
    public function exportDriverCSV()
    {
        // $fileName = 'driver-'.time().'.xlsx';  
        $fileName = 'driver-'.time().'.xls';  

        $ids = $this->input->post('driverId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getDriverExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('driver_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('driver_number'));
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('assigned_bus'));
         $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('note'));
       
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['driver_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['driver_unique_id']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['note']);
            
            // $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status);
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

    public function pdfDriverList()
    {
        $fileName = 'driver-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('driverId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('driver').'</h3>';
        $html_content .= $this->PdfModel->getDriverPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
       
    }
    public function exportDriverCSVOld()
    {
        $ids = $this->input->post('driverId');
        //get data 
        $usersData = $this->PdfModel->getDriverCsv($ids);

        // print_r($usersData);die;

        // $filename = 'driver-'.time().'.csv';  
        // $filename = 'driver-'.time().'.xlsx';  
        $filename = 'driver-'.time().'.xls';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');
     
       // $header = array("Bus Number","Plate Number","Note","Modify"); 
        $header = array("Driver Name","Driver Mobile Numbe","Note"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }


    public function editDriver()
    {
        $ids = $this->input->post('busId');
        // print_r($ids);die;

        redirect('subadmin/driver_edit/'.$ids);
    }
     public function import_driver_view()
    {
        $data['title'] = $this->lang->line('import_driver');
        // echo "string"; die;
        $this->loadSubAdminView('subadmin/driver/import_driver_view',$data); 
    }

    public function donwload_driver_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "driver.csv";
        // $fileName = "driver.xlsx";
        $fileName = "driver.xls";
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
            // print_r($file);die;
            // check file exists    
            if (file_exists ( $file )) 
            {
                // echo "string";die;
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                // echo "strings";die;
                // Redirect to base url
                redirect ( base_url () );
            }
        }
    }
}
