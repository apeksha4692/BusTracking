<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DriverController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function driver_list()
    {	
        $data['title'] = $this->lang->line('driver');
    	$data['getAllClient'] = $this->CommonModel->clientGroup();

        $data['driver_count'] = $this->CommonModel->select_single_row("Select count(*) as total from driver ");

        $data['getAllDriver'] = $this->CommonModel->driverDataReport();

    	$this->loadAdminView('admin/reporting/driver/driver_list',$data); 
    }

    public function getClientUser(){
        $condition  = array("client_id" => $this->input->post('client_id'));

        $clientUserData = $this->CommonModel->selectResultDataByCondition($condition,'client_user');

        if (!empty($clientUserData)) {
            echo json_encode($clientUserData);
        }else{
            echo "0";
        }
    }

    public function getClientUserBus()
    {
        $client_user_id = $this->input->post('client_user_id');

        $clientUserBusData = $this->CommonModel->getBusAvaiable($client_user_id);

        if (!empty($clientUserBusData)) {
            echo json_encode($clientUserBusData);
        }else{
            echo "0";
        }
    }
    
    public function check_driverNumber()
    {
        $condition = array(
            "drive_mobile_number" => $this->input->post('drive_mobile_number'),
            "client_user_id" => $this->input->post('client_user_id'),
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
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/reporting/driver/add',$data); 

    }

    public function driver_insert()
    {
        // print_r($_POST);die;
         $condition = array(
            "drive_mobile_number" => $this->input->post('drive_mobile_number'),
            "client_user_id" => $this->input->post('client_user_id'),
            //  "is_delete" => 0
        );
        $driverData = $this->CommonModel->selectRowDataByCondition($condition,'driver');
        
        // print_r($clientData);die;
        
        if(!empty($driverData))
        {
            $data['post'] = $_POST;
            // print_r($data['post'] );die;
             $this->session->set_flashdata('error','Driver Mobile Number already exit. Used different Mobile Number');
            
            $data['title'] = $this->lang->line('add_new_driver');
            $where = array(
                "delete" => 0,
                "status" => 1,
            );
    
            $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
            
            $wh = array(
                "is_delete"         =>  0,
                 "status" => 1,
            );
    
            $data['getAllClientUser'] = $this->CommonModel->selectResultDataByCondition($wh,'client_user');
        
        
            $this->loadAdminView('admin/reporting/driver/add',$data);  
                    
            return;
        }
        

        $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

        $count_data= $driverdata_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $driver_code = 'Driver'.$rand; 

        // print_r($driver_code);die;
        $driver_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "driver_unique_id"      =>  $driver_code,
                    "driver_name"           =>  $driver_name,
                    "drive_mobile_number"   =>  $this->input->post('drive_mobile_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'driver');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_add_successfully'));
            // redirect('subadmin/driver_add');
            redirect('admin/reporting/driver_list'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('driver_not_add_successfully'));
             redirect('admin/reporting/driver_list'); 
            
        }

    }


    public function driver_edit()
    {
        // echo "string";die;
        $data['title'] = $this->lang->line('edit_driver');

         $where1 = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where1,'client','client.id');

         $where = array(
            "is_delete"         =>  0,
             "status" => 1,
        );

        $data['getAllClientUser'] = $this->CommonModel->selectResultDataByCondition($where,'client_user');

        $driver_id = $this->uri->segment(4);

        // $driverDetail = $this->CommonModel->driverDetail($driver_id);

        // $client_user_id = $driverDetail->client_user_id;

        // $data['getAllBus'] = $this->CommonModel->getBusAvaiable($client_user_id);

         $where = array(
            "is_delete"         =>  0,
            // "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');


        $data['driverDetail'] = $this->CommonModel->driverDetail($driver_id);
        // print_r($data['driverDetail']);die;

        $this->loadAdminView('admin/reporting/driver/edit',$data); 

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
                    "driver_name"           =>  $driver_name,
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "drive_mobile_number"   =>  $this->input->post('drive_mobile_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'driver',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_update_successfully'));
             redirect('admin/reporting/driver_list'); 
            // redirect('subadmin/driver_edit/'.$this->input->post('driver_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('driver_not_update_successfully'));
             redirect('admin/reporting/driverEdit/'.$this->input->post('driver_id')); 
            
        }
    }



    public function delete_driver()
    {
        $client_id = $this->input->post('client_id');
        
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
                redirect('admin/reporting/driver_list'); 
            }
        }

        if($updateData)
        {
            
            if(!empty($client_id))
            {
                 $data['driver_count'] = $this->CommonModel->select_single_row("Select count(*) as total from driver ");
                $data['title'] = $this->lang->line('driver');
            // 	$where = array(
            //         "delete" => 0,
            //         "status" => 1,
            //     );
        
            //     $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
        
               
                
                $data['client_id'] = $client_id;
            //     $data['getAllDriver'] = $this->CommonModel->driverDataReportByClient($client_id);
                
                $data['getAllClient'] = $this->CommonModel->clientGroup();
                
                $client_name = $client_id;
                $getClientId = $this->CommonModel->getClientName($client_name);
                
                $comma_string = array();
                foreach ($getClientId as $k)
                {
                    $comma_string[] = $k['id'];
                }
                $client_id = implode(",", $comma_string);
                $data['getAllDriver']  =  $this->CommonModel->driverDataReportByClient($client_id);
                
                $this->session->set_flashdata('success',$this->lang->line('driver_delete_successfully'));
                $this->loadAdminView('admin/reporting/driver/driver_list',$data); 
                return;
                
            }else{
                $this->session->set_flashdata('success',$this->lang->line('driver_delete_successfully'));
                redirect('admin/reporting/driver_list'); 
            }
        }else{
            $this->session->set_flashdata('error',$this->lang->line('driver_not_delete_successfully'));
           redirect('admin/reporting/driver_list'); 
        }
           
    }

    public function delete()
    {

        $where = array('id'=>$this->uri->segment(5));

        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(5)),'driver');

        if($busData){
            
            $updateData = $this->CommonModel->delete($where,'driver'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('driver_delete_successfully'));
                redirect('admin/reporting/driver_list'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('driver_not_delete_successfully'));
                 redirect('admin/reporting/driver_list'); 
            }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('admin/reporting/driver_list');  
        }
    }



    
    public function excelDriverList()
    {
        // echo "string";die;
        // $fileName = 'driver-'.time().'.xlsx';  
        $fileName = 'driver-'.time().'.xls';  

        $ids = $this->input->post('driverId');

        $empInfo = $this->ReportingPdfModel->getDriverExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('driver_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('driver_number'));
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('assigned_bus'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('note'));
        
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['driver_status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['driver_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['driver_unique_id']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['note']);
            
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $status);
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
        // echo "string";die;
        $fileName = 'driver-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('driverId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('driver').'</h3>';
        $html_content .= $this->ReportingPdfModel->getDriverPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);        
    }

     public function getDriverReport()
    {
        // echo "string";die;
        // $client_id = $this->input->post('client_id');
        // $clientuserData = $this->CommonModel->driverDataReportByClient($client_id);
        
        $client_name = $this->input->post('client_name');
        $getClientId = $this->CommonModel->getClientName($client_name);
        
        $comma_string = array();
        foreach ($getClientId as $k)
        {
            $comma_string[] = $k['id'];
        }
        $client_id = implode(",", $comma_string);
        $clientuserData = $this->CommonModel->driverDataReportByClient($client_id);
        
        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";

                    $checkBox = '<input id="'.$clientuserData[$i]['driver_id'].'" type="checkbox" value="'.$clientuserData[$i]['driver_id'].'" name="driver_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['driver_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['driver_id'].'"></label><br>
                      <span id="errmsg" style="color: red;"></span>';

                   /* if( $clientuserData[$i]['status'] == 1)
                    {
                        $value = "change_status('".$clientuserData[$i]['client_user_id']."','Deactive')";
                        $status = '<button title="'.$this->lang->line('change_staus').'" type="button" id="button" class="btn-info btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="'.$value.'">'.$this->lang->line('active').'</button>';

                    }else{
                       $value = "change_status('".$clientuserData[$i]['client_user_id']."','Active')";
                        $status = '<button title="'.$this->lang->line('change_staus').'" type="button" id="button" class="btn-info btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="'.$value.'">'.$this->lang->line('deactive').'</button>';
                    }*/


                    // $viewUrl = base_url('admin/clientuser_view/'.$clientuserData[$i]['client_user_id']);
                    // $view = '<a class="text-warning mr-3" href="'. $viewUrl.'">View</a>';

                    $modify_date = date("d/m/Y", strtotime($clientuserData[$i]['updated_at']));

                    $editUrl = base_url('admin/reporting/driverEdit/'.$clientuserData[$i]['driver_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';

                    $deleteUrl = base_url('admin/reporting/DriverController/delete/'.$clientuserData[$i]['driver_id']);
                    $delete = '<a onclick="return deleteclientUser()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    // $action = $view.'<br>'.$edit.'<br>'.$delete;
                    $action = $edit.'<br>'.$delete;
                    
                    $note = '<p class="show-read-more mb-0">'. $clientuserData[$i]['note'].'</p>';

                    // print_r($action);die;

                    $arr[] = array(
                        $checkBox,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['driver_name'],
                        $clientuserData[$i]['drive_mobile_number'],
                        $modify_date,
                        $note,
                        // $action,
                    );
            }

        }
// print_r($arr);die;
        if (!empty($arr)) {
            $arr2 = array("data" => $arr);
        }else{
            $arr2 = array("data" => []);
        }
        
        echo json_encode($arr2);
    }
    
     public function editDriver()
    {
        $ids = $this->input->post('busId');
        // print_r($ids);die;

        redirect('admin/reporting/driverEdit/'.$ids);
    }
    
     public function import_driver_view()
    {
        $data['title'] = $this->lang->line('import_driver');
        // echo "string"; die;
        $this->loadAdminView('admin/reporting/driver/import_driver_view',$data); 
    }
    
    public function import_driver()
    {
         $path = $_FILES["file"]["tmp_name"];
        
        $object = PHPExcel_IOFactory::load($path);
      
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {
                $clientName                 =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $clientFocalNumber         =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $clientFocalEmail           =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $clientUserName             =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $clientUserMobileNumber     =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $clientUserEmail            =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $driver_name                =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $driver_mobile              =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $driver_note                =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            
                // print_r($clientName);   
                // echo "<br>";
                // print_r($clientFocalEmail);   
                // echo "<br>";
                // print_r($clientUserName);
                // echo "<br>";
                // print_r($clientUserMobileNumber);  
                // echo "<br>";
                // print_r($driver_name);
                // echo "<br>";
                // print_r($driver_mobile);
                // echo "<br>";
                // print_r($driver_note);    
        //-----------------Check Client Detail------------------------       
                // $where = array('focal_point_email'=>$clientFocalEmail);
                $where = "(focal_point_email='".$clientFocalEmail."' or focal_point_number=".$clientFocalNumber.")";
                $clientDetail = $this->CommonModel->getsingle('client',$where);
                // print_r($clientDetail); 
                // echo "<br>";
                if(!empty($clientDetail)){
                    $client_id = $clientDetail->id;
                }else{
                    $data = array(
                        "client_name"           =>  $clientName,
                        "focal_point_email"     =>  $clientFocalEmail,
                        "focal_point_number"     =>  $clientFocalNumber,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                    $clientInsert = $this->CommonModel->insertData($data,'client'); 

                    $client_id = $this->db->insert_id();
                }
                // print_r($client_id); 
                // echo "<br>";
         //-----------------Check Client User Detail------------------------
         
                // $where = array(
                //     'client_id'=>$client_id,
                //     'mobile_number'=>$clientUserMobileNumber,
                // );
                $where = "(email='".$clientUserEmail."' or mobile_number=".$clientUserMobileNumber." AND client_id =".$client_id.")";
                $clientUserDetail = $this->CommonModel->getsingle('client_user',$where);
                
                // print_r($clientUserDetail);
                // echo "<br>";
                if(!empty($clientUserDetail)){
                    $clientUserId = $clientUserDetail->id;
                }else{
                    $data = array(
                        "client_id"          =>  $client_id,
                        "username"          =>  $clientUserName,
                        'mobile_number'     =>  $clientUserMobileNumber,
                        'email'             =>  $clientUserEmail,
                        "created_at"        =>  date('Y-m-d H:i:s a'),
                        "updated_at"        =>  date('Y-m-d H:i:s a'),
                    );

                    $clientUserInsert = $this->CommonModel->insertData($data,' client_user'); 

                    $clientUserId = $this->db->insert_id();
                }
                // print_r($clientUserId);
                // echo "<br>";
        //-----------------Check Bus Detail------------------------
                $where = array(
                      'drive_mobile_number'=>$driver_mobile,
                        'client_user_id' => $clientUserId
                    );
                $driverDetail = $this->CommonModel->getsingle('driver',$where);
                // print_r($busDetail);
                // echo "<br>";
                $driverdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('driver')->row('id');

                $count_data= $driverdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $driver_code = 'Driver'.$rand; 
        
                if(!empty($driverDetail))
                {
                    // echo "1";
                    // echo "<br>";
                    $clientString[] = $client_id;
                    $clientId = implode(",", $clientString);

                    // $clientUserString[] = $busDetail->client_user_id;
                    $clientUserString[] = $clientUserId;
                    $clientUserId = implode(",", $clientUserString);
                    
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
                    $data = array(
                        "client_user_id"        =>  $clientUserId,
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
        //     print_r($set);
        //   die; 
            if($set)
            { 
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countDriver = $this->CommonModel->countDuplicateDriver($id);
                    // print_r($countBus->busTotal);die;
                    
                    $data = array(
                        'count'         =>  $countDriver->driverTotal,
                        'id'            =>  $arr,
                        'clientId'      =>  $clientId,
                        'clientUserId'  =>  $clientUserId,
                        'driverName'    =>  $driverName,
                        'driverMobile'  =>  $driverMobile,
                        'driverNote'    =>  $driverNote,
                    );

                    echo json_encode($data);
                }else{
                    echo "1";
                }
            }else{
                echo "0";
            }
        }
    }
    
    public function replaceDriverDuplicateData()
    {
        // print_r($_POST);
        // print_r($_POST);die;

        $id = explode(',',($this->input->post('id'))); 
        $driver_name = explode(',',($this->input->post('driverName'))); 
        $driver_mobile       = explode(',',($this->input->post('driverMobile'))); 
        $driver_note = explode(',',($this->input->post('driverNote'))); 
        $clientUserId = explode(',',($this->input->post('clientUserId'))); 

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

             $data = array(
                    "client_user_id"        =>  $clientUserId[$i],
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
// die;
        // die;
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('driver_update_successfully'));
             redirect('admin/reporting/driver_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('driver_not_update_successfully'));
             redirect('admin/reporting/driver_list'); 
        }
    }
    
    
    public function donwload_driver_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "driver.csv";
        // $fileName = "driver.xlsx";
        $fileName = "reporting_driver.xls";
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
