<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ChaperoneController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function chaperone_list()
    {	
        $data['title'] = $this->lang->line('chaperone');

        $data['chaperone_count'] = $this->CommonModel->select_single_row("Select count(*) as total from chaperone ");

        $data['getAllClient'] = $this->CommonModel->clientGroup();

        $data['getAllChaperone'] = $this->CommonModel->chaperoneDataReport();
    	$this->loadAdminView('admin/reporting/chaperone/chaperone_list',$data); 
    }
    
     public function check_chaperoneNumber()
    {
        $condition = array(
            "phone_number" => $this->input->post('phone_number'),
            "client_user_id"    =>  $this->input->post('client_user_id')
            //  "is_delete" => 0
             
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'chaperone');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }


    public function delete_chaperone()
    {
        $client_id = $this->input->post('client_id');
        
        $val = explode(',',($this->input->post('chaperoneId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'chaperone');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'chaperone'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('admin/reporting/chaperone_list'); 
            }
        }

        if($updateData)
        {
            if(!empty($client_id))
            {
                $data['client_id'] = $client_id;
                
                $data['title'] = $this->lang->line('chaperone');
    
                $data['chaperone_count'] = $this->CommonModel->select_single_row("Select count(*) as total from chaperone ");
            
                $data['getAllClient'] = $this->CommonModel->clientGroup();
                
                $client_name = $client_id;
                $getClientId = $this->CommonModel->getClientName($client_name);
                
                $comma_string = array();
                foreach ($getClientId as $k)
                {
                    $comma_string[] = $k['id'];
                }
                $client_id = implode(",", $comma_string);
                $data['getAllChaperone']  =  $this->CommonModel->chaperoneDataReportByClient($client_id);
                
                $this->session->set_flashdata('success',$this->lang->line('chaperone_delete_successfully'));
            	$this->loadAdminView('admin/reporting/chaperone/chaperone_list',$data);
        	    return;
            }else{
                $this->session->set_flashdata('success',$this->lang->line('chaperone_delete_successfully'));
                 redirect('admin/reporting/chaperone_list'); 
            }
        }else{
            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_delete_successfully'));
             redirect('admin/reporting/chaperone_list'); 
        }
           
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(5));
        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(5)),'chaperone');

        if($busData){
            
            $updateData = $this->CommonModel->delete($where,'chaperone'); 

             if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('chaperone_delete_successfully'));
                 redirect('admin/reporting/chaperone_list'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('chaperone_not_delete_successfully'));
                 redirect('admin/reporting/chaperone_list'); 
            }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('admin/reporting/chaperone_list'); 
            
        }
    }


    public function chaperone_add()
    {   
        $data['title'] = $this->lang->line('add_new_chaperone');

        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/reporting/chaperone/add',$data); 

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
        $condition  = array("client_user_id" => $this->input->post('client_user_id'));

        $clientUserBusData = $this->CommonModel->selectResultDataByCondition($condition,'bus');

        if (!empty($clientUserBusData)) {
            echo json_encode($clientUserBusData);
        }else{
            echo "0";
        }
    }

    public function chaperone_insert()
    {
        
         $condition = array(
            "phone_number" => $this->input->post('phone_number'),
            "client_user_id"    =>  $this->input->post('client_user_id')
            //  "is_delete" => 0
             
        );
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($condition,'chaperone');
        
        
        if(!empty($chaperoneData)){
            $data['post'] = $_POST;
            // print_r($data['post'] );die;
             $this->session->set_flashdata('error','Mobile Number already exit. Used different Mobile Number');
           
            $data['title'] = $this->lang->line('add_new_chaperone');

            $where = array(
                "delete" => 0,
                "status" => 1,
            );
    
            $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
            
            $wh = array(
                "is_delete"         =>  0,
                 "status" => 1,
                // "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
            );
    
            $data['getAllClientUser'] = $this->CommonModel->selectResultDataByCondition($wh,'client_user');
    
            $this->loadAdminView('admin/reporting/chaperone/add',$data);
                    
            return;
        }
        
        $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

        $count_data= $chaperone_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $chaperone_code = 'Chaperone'.$rand; 

        // print_r($driver_code);die;
        $chaperone_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "chaperone_unique_id"   =>  $chaperone_code,
                    "chaperone_name"        =>  $chaperone_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "secret_code"           =>  $this->input->post('secret_code'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'chaperone');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_add_successfully'));
            redirect('admin/reporting/chaperone_list'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_add_successfully'));
             redirect('admin/reporting/chaperone_list');    
        }
    }

    public function chaperone_edit()
    {
        // echo "string";die;
        $data['title'] = $this->lang->line('edit_chaperone');

        $where1 = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where1,'client','client.id');

         $where = array(
            "is_delete"         =>  0,
             "status" => 1,
            // "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllClientUser'] = $this->CommonModel->selectResultDataByCondition($where,'client_user');

         $where = array(
            "is_delete"         =>  0,
            // "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

        $chaperone_id = $this->uri->segment(4);

        $data['chaperoneDetail'] = $this->CommonModel->chaperoneDetail($chaperone_id);
        // print_r($data['chaperoneDetail']);die;


        $this->loadAdminView('admin/reporting/chaperone/edit',$data); 
    }

    public function chaperone_update()
    {
        // echo "string";die;
        $condition = array(
                'id' => $this->input->post('chaperone_id')
        );
        // print_r($_POST);die;

        $chaperone_name = $this->input->post('f_name').' '.$this->input->post('family_name');


        $data = array(
                    "chaperone_name"        =>  $chaperone_name,
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "phone_number"          =>  $this->input->post('phone_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_update_successfully'));
            redirect('admin/reporting/chaperone_list'); 
            // redirect('subadmin/chaperone_edit/'.$this->input->post('chaperone_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_update_successfully'));
             redirect('admin/reporting/chaperoneEdit/'.$this->input->post('chaperone_id')); 
            
        }
    }


    // public function import_chaperone()
    // {
    //     // echo "string";die;
    //     $path = $_FILES["file"]["tmp_name"];
    //     $object = PHPExcel_IOFactory::load($path);
    //     // print_r($object);die;
    //     foreach($object->getWorksheetIterator() as $worksheet)
    //     {
    //         $highestRow = $worksheet->getHighestRow();
    //         $highestColumn = $worksheet->getHighestColumn();

    //         for($row=2; $row<=$highestRow; $row++)
    //         {

    //             $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

    //             $count_data= $chaperone_max+1;//autoincrement

    //             $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
    //             $chaperone_code = 'Chaperone'.$rand; 

    //             $client_name        =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    //             $clientUser_name    =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    //             $chaperone_name     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    //             $chaperone_mobile   =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
    //             $assign_bus         =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();
    //             $chaperone_note     =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
    //             $secret_code        =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();

    //             // print_r($chaperone_name);
    //             // print_r($chaperone_mobile);
    //             // print_r($assign_bus);
    //             // print_r($chaperone_note);
    //             // print_r($secret_code);
    //             // echo "<br>";
    //             $where = array('bus_plate_number'=>$assign_bus);
    //             $busDetail = $this->CommonModel->getsingle('bus',$where);

    //             if(!empty($busDetail))
    //             {
    //                 $bus_id = $busDetail->id;

    //             }else{

    //                 $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

    //                 $count_data= $busdata_max+1;//autoincrement

    //                 $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
    //                 $bus_code = 'BUS'.$rand;
                    

    //                  $data = array(
    //                     "bus_plate_number"      =>  $assign_bus,
    //                     "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
    //                     "bus_unique_id"         =>  $bus_code,
    //                     "created_at"            =>  date('Y-m-d H:i:s a'),
    //                     "updated_at"            =>  date('Y-m-d H:i:s a'),
    //                 );
                  
    //                 $busInsert = $this->CommonModel->insertData($data,'bus'); 

    //                 $bus_id = $this->db->insert_id();
    //                 // return  $insert_id; 
    //             }
    //             $where = array('phone_number'=>$chaperone_mobile);
    //             $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);

    //             if(!empty($chaperoneDetail))
    //             {
    //                 $condition = array('id'=>$chaperoneDetail->id);

    //                 $data = array(
    //                     "chaperone_name"        =>  $chaperone_name,
    //                     "phone_number"          =>  $chaperone_mobile,
    //                     "bus_id"                =>  $bus_id,
    //                     "note"                  =>  $chaperone_note,
    //                     "secret_code"           =>  $secret_code,
    //                     "updated_at"            =>  date('Y-m-d H:i:s a'),
    //                 );

    //                 $set = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

    //             }else{                   

    //                  $data = array(
    //                     "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
    //                     "chaperone_unique_id"   =>  $chaperone_code,
    //                     "chaperone_name"        =>  $chaperone_name,
    //                     "phone_number"          =>  $chaperone_mobile,
    //                     "bus_id"                =>  $bus_id,
    //                     "note"                  =>  $chaperone_note,
    //                     "secret_code"           =>  $secret_code,
    //                     "created_at"            =>  date('Y-m-d H:i:s a'),
    //                     "updated_at"            =>  date('Y-m-d H:i:s a'),
    //                 );

    //                 $set = $this->CommonModel->insertData($data,'chaperone');  
    //             }
    //         }
    //         // die;
    //         if($set)
    //         {
    //             echo "1";
    //         }else{
    //             echo "0";
    //         }
    //     }   
    // }

    public function excelChaperoneList()
    {
        // echo "string";die();
        // print_r($_POST);die;
        // $fileName = 'chaperone-'.time().'.xlsx';  
        $fileName = 'chaperone-'.time().'.xls';  

        $ids = $this->input->post('chaperoneId');

        // $this->load->library('excel');

        $empInfo = $this->ReportingPdfModel->getChaperoneExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('chaperone_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('chaperone_number'));
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('assigned_bus'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('modify'));
         $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('secret_code'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('note'));
       
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['chaperone_status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount,$element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['chaperone_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['phone_number']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['bus_unique_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['secret_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['note']);
            
            
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $status);
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

    public function pdfChaperoneList()
    {
        // print_r($_POST);die;
        $fileName = 'chaperone-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('chaperoneId');

        $html_content = '<h3 align="center">'.$this->lang->line('chaperone').'</h3>';
        $html_content .= $this->ReportingPdfModel->getChaperonePdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
 
    }


    public function getClientUserReport()
    {
        // echo "string";die;
        // $client_id = $this->input->post('client_id');
        // $clientuserData = $this->CommonModel->chaperoneDataReportByClient($client_id);

        $client_name = $this->input->post('client_name');
        $getClientId = $this->CommonModel->getClientName($client_name);
        
        $comma_string = array();
        foreach ($getClientId as $k)
        {
            $comma_string[] = $k['id'];
        }
        $client_id = implode(",", $comma_string);
        $clientuserData = $this->CommonModel->chaperoneDataReportByClient($client_id);

        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";
                    $checkBox = '<input id="'.$clientuserData[$i]['chaperone_id'].'" type="checkbox" value="'.$clientuserData[$i]['chaperone_id'].'" name="chaperone_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['chaperone_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['chaperone_id'].'"></label><br>
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

                    $modify_date = date("d/m/Y", strtotime($clientuserData[$i]['chaperone_id']));

                    $editUrl = base_url('admin/reporting/chaperoneEdit/'.$clientuserData[$i]['chaperone_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';



                    $deleteUrl = base_url('admin/reporting/ChaperoneController/'.$clientuserData[$i]['chaperone_id']);
                    $delete = '<a onclick="return deleteclientUser()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    // $action = $view.'<br>'.$edit.'<br>'.$delete;
                    $action = $edit.'<br>'.$delete;

                    // print_r($action);die;

                    $arr[] = array(
                        // $k,
                        $checkBox,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['chaperone_name'],
                        $clientuserData[$i]['phone_number'],
                        // $clientuserData[$i]['bus_unique_id'],
                        $modify_date,
                        $clientuserData[$i]['secret_code'],
                        $clientuserData[$i]['note'],
                        // $clientuserData[$i]['last_login_date'],
                        // $clientuserData[$i]['status'],
                        
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
    
    public function editChaperone()
    {
        $ids = $this->input->post('chaperoneId');
        // print_r($ids);die;

        redirect('admin/reporting/chaperoneEdit/'.$ids);
    }
    
     public function import_chaperone_view()
    {
        $data['title'] = $this->lang->line('import_chaperone');
        // echo "string"; die;
        // $this->loadSubAdminView('subadmin/chaperone/import_chaperone_view',$data); 
        
        $this->loadAdminView('admin/reporting/chaperone/import_chaperone_view',$data); 
    }
    
    public function import_chaperone()
    {
        // echo "hi";
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
                $chaperone_name             =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $chaperone_mobile           =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $secret_code                =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $chaperone_note             =   $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                
                
                // print_r($clientName);   
                // echo "<br>";
                // print_r($clientFocalEmail);   
                // echo "<br>";
                // print_r($clientUserName);
                // echo "<br>";
                // print_r($clientUserMobileNumber);  
                // echo "<br>";
                // print_r($bus_number);
                // echo "<br>";
                // print_r($bus_plate_number);
                // echo "<br>";
                // print_r($bus_note);    
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
                        "client_id"         =>  $client_id,
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
                        'phone_number'=>$chaperone_mobile,
                        'client_user_id' => $clientUserId
                    );
                // $busDetail = $this->CommonModel->getsingle('bus',$where);
                $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);
                // print_r($busDetail);
                // echo "<br>";
                $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');
    
                $count_data= $chaperone_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $chaperone_code = 'Chaperone'.$rand;
        
                if(!empty($chaperoneDetail))
                {
                    $clientString[] = $client_id;
                    $clientId = implode(",", $clientString);
                    
                    // $clientUserString[] = $busDetail->client_user_id;
                    $clientUserString[] = $clientUserId;
                    $clientUserId = implode(",", $clientUserString);
                    
                    $chaperoneNameString[] = $chaperone_name;
                    $chaperoneName = implode(",", $chaperoneNameString);

                    $chaperoneMobiletring[] = $chaperone_mobile;
                    $chaperoneMobile = implode(",", $chaperoneMobiletring);

                    $chaperoneNotetring[] = $chaperone_note;
                    $chaperoneNote = implode(",", $chaperoneNotetring);
                    
                    $secretCodetring[] = $secret_code;
                    $secretCode = implode(",", $secretCodetring);
                    
                    $comma_string[] = $chaperoneDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;
                    
                }else{
                    
                     $client_user_id = $clientUserId;
        
                    //  $client_user_id = $this->session->userdata('ses_subadmin_id');
                    $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
                    $max_chaperone = $getSubAdminData->max_chaperone;
                    
                    $chaperoneCount = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$client_user_id."");
                    $chaperoneTotal = $chaperoneCount->total;
                    
                    if(empty($max_chaperone) && empty($chaperoneTotal)){
                        echo "000";exit;
                    }else{
                    
                        if($max_chaperone <= $chaperoneTotal)
                        {
                            echo "00";die;
                             
                        }else
                        {
                            // echo "insert";
                            $data = array(
                                 "client_user_id"         =>  $clientUserId,
                                "chaperone_unique_id"   =>  $chaperone_code,
                                "chaperone_name"        =>  $chaperone_name,
                                "phone_number"          =>  $chaperone_mobile,
                                "note"                  =>  $chaperone_note,
                                "secret_code"           =>  $secret_code,
                                "created_at"            =>  date('Y-m-d H:i:s a'),
                                "updated_at"            =>  date('Y-m-d H:i:s a'),
                            );
            
                            $set = $this->CommonModel->insertData($data,'chaperone');
                        }
                    }
                }
            }
        //     print_r($set);
        //   die; 
            if($set)
            { 
                if (!empty($arr)) 
                {
                    $id = $arr;
                     $countChaperone = $this->CommonModel->countDuplicateChaperone($id);
                    // print_r($countBus->busTotal);die;
                    
                    $data = array(
                        'count'          =>  $countChaperone->chaperoneTotal,
                        'id'             =>  $arr,
                        'clientId'        =>  $clientId,
                        'clientUserId'    =>  $clientUserId,
                        'chaperoneName'    =>  $chaperoneName,
                        'chaperoneMobile'  =>  $chaperoneMobile,
                        'chaperoneNote'    =>  $chaperoneNote,
                        'secretCode'    =>  $secretCode,
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
    
    public function replaceChaperoneDuplicateData()
    {
        // print_r($_POST);
         $id = explode(',',($this->input->post('id'))); 
        $chaperone_name = explode(',',($this->input->post('chaperoneName'))); 
        $chaperone_mobile   = explode(',',($this->input->post('chaperoneMobile'))); 
        $chaperone_note = explode(',',($this->input->post('chaperoneNote')));
        $secret_code = explode(',',($this->input->post('secretCode')));
        $clientUserId = explode(',',($this->input->post('clientUserId')));
        
        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'chaperone'); 
        }
        // die;

        for ($i=0; $i < count($chaperone_mobile); $i++) 
        { 
            $client_user_id = $clientUserId[$i];
        
            //  $client_user_id = $this->session->userdata('ses_subadmin_id');
            $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
    
            $max_chaperone = $getSubAdminData->max_chaperone;
                    
            $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

            $count_data= $chaperone_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $chaperone_code = 'Chaperone'.$rand;
        
            $chaperoneCount = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$clientUserId[$i]."");
            $chaperoneTotal = $chaperoneCount->total;
                    
            if($max_chaperone <= $chaperoneTotal)
            {
                $this->session->set_flashdata('error',$this->lang->line('max_chaperone'));
                redirect('admin/reporting/chaperone_list');
            }else{
                $where = array(
                        'phone_number'=>$chaperone_mobile[$i],
                        'client_user_id' => $clientUserId[$i]
                    );
                // $busDetail = $this->CommonModel->getsingle('bus',$where);
                $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);
                if(!empty($chaperoneDetail))
                {
                     $condition = array('id'=>$chaperoneDetail->id);
    
                    $data = array(
                        "chaperone_unique_id"   =>  $chaperone_code,
                       "chaperone_name"         =>  $chaperone_name[$i],
                        "phone_number"          =>  $chaperone_mobile[$i],
                        "note"                  =>  $chaperone_note[$i],
                        "secret_code"           =>  $secret_code[$i],
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  
                    
                }else{
                     $data = array(
                     "client_user_id"        =>  $clientUserId[$i],
                    "chaperone_unique_id"   =>  $chaperone_code,
                    "chaperone_name"        =>  $chaperone_name[$i],
                    "phone_number"          =>  $chaperone_mobile[$i],
                    "note"                  =>  $chaperone_note[$i],
                    "secret_code"           =>  $secret_code[$i],
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );
// print_r($data);
                $set = $this->CommonModel->insertData($data,'chaperone'); 
                }
                
                                
               
            }
        }
        // die;
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_update_successfully'));
             redirect('admin/reporting/chaperone_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_update_successfully'));
             redirect('admin/reporting/chaperone_list'); 
        }
        
        
    }
    public function donwload_chaperone_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        $fileName = "reporting_chaperone.xls";
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
