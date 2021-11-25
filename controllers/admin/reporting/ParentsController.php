<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ParentsController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function parents_list()
    {	
        // echo "string";die;
        $data['title'] = $this->lang->line('parent');

    	$data['getAllClient'] = $this->CommonModel->clientGroup();

        $data['parents_count'] = $this->CommonModel->select_single_row("Select count(*) as total from parents ");

        $data['getAllParent'] = $this->CommonModel->parentsDataReport();
        // print_r($data['getAllParent']);die;
    	$this->loadAdminView('admin/reporting/parents/parents_list',$data); 
    }

     public function parents_add()
    {   
         $data['title'] = $this->lang->line('add_new_parent');

        // echo "string";die;
        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/reporting/parents/add',$data); 
    }

    public function check_parnetsNumber()
    {
        $condition = array(
            "phone_number" => $this->input->post('phone_number'),
            "client_user_id" => $this->input->post('client_user_id'),
            //  "is_delete" => 0
             
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function parents_insert()
    {
        //  print_r($_POST);die;
        
        $condition = array(
            "phone_number" => $this->input->post('phone_number'),
            "client_user_id" => $this->input->post('client_user_id'),
            //  "is_delete" => 0
             
        );
        $parentsData = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        
        if(!empty($parentsData))
        {
             $where = array(
                "delete" => 0,
                "status" => 1,
            );
    
            $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
        
             $wh1 = array(
                "is_delete"         =>  0,
                 "status" => 1,
            );
    
            $data['getAllClientUser'] = $this->CommonModel->selectResultDataByCondition($wh1,'client_user');
        
            $data['title'] = $this->lang->line('add_new_parent');
            $data['post'] = $_POST;
             $this->session->set_flashdata('error','Mobile Number already exit');
            $this->loadAdminView('admin/reporting/parents/add',$data);
                    
            return;
        }
// die;
        $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

        $count_data= $parents_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $parents_code = 'Parent'.$rand; 

        // print_r($driver_code);die;
        $parents_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "parents_unique_id"     =>  $parents_code,
                    "parents_name"          =>  $parents_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "secret_code"           =>  $this->input->post('secret_code'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'parents');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_add_successfully'));
            // redirect('subadmin/parents_add');
             redirect('admin/reporting/parents_list'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('parent_not_add_successfully'));
             redirect('admin/reporting/parentsAdd');   
        }
    }


    public function parents_edit()
    {
        // echo "string";die;
        $data['title'] = $this->lang->line('edit_parent');

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

        $parent_id = $this->uri->segment(4);

        // print_r($parent_id);die;
        $data['parentDetail'] = $this->CommonModel->parentsDetail($parent_id);
        // print_r($data['parentDetail']);die;


        $this->loadAdminView('admin/reporting/parents/edit',$data); 
    }


    public function parents_update()
    {
        $condition = array(
                'id' => $this->input->post('parent_id')
        );

        $parents_name = $this->input->post('f_name').' '.$this->input->post('family_name');


        $data = array(
                    "parents_name"          =>  $parents_name,
                    "client_user_id"          =>  $this->input->post('client_user_id'),
                    "phone_number"          =>  $this->input->post('phone_number'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_update_successfully'));
            // redirect('subadmin/parents_edit/'.$this->input->post('parent_id')); 
             redirect('admin/reporting/parents_list');
        }else{

            $this->session->set_flashdata('error',$this->lang->line('parent_not_update_successfully'));
             redirect('admin/reporting/parentsEdit/'.$this->input->post('parent_id'));    
        }
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


    public function delete_parents()
    {
        $client_id = $this->input->post('client_id');
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
                redirect('admin/reporting/parents_list'); 
            }
        }

        if($updateData)
        {
             if(!empty($client_id))
             {
                 $data['client_id'] = $client_id;
                $data['title'] = $this->lang->line('parent');
                 $data['parents_count'] = $this->CommonModel->select_single_row("Select count(*) as total from parents ");

            // 	$where = array(
            //         "delete" => 0,
            //         "status" => 1,
            //     );
        
            //     $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
                // $data['getAllParent'] = $this->CommonModel->parentsDataReportByClient($client_id);
                
                
                
                $data['getAllClient'] = $this->CommonModel->clientGroup();
                
                $client_name = $client_id;
                $getClientId = $this->CommonModel->getClientName($client_name);
                
                $comma_string = array();
                foreach ($getClientId as $k)
                {
                    $comma_string[] = $k['id'];
                }
                $client_id = implode(",", $comma_string);
                $data['getAllParent']  =  $this->CommonModel->parentsDataReportByClient($client_id);
                 $this->session->set_flashdata('success',$this->lang->line('parent_delete_successfully'));
            	$this->loadAdminView('admin/reporting/parents/parents_list',$data); 
            	return;
            }else{
                $this->session->set_flashdata('success',$this->lang->line('parent_delete_successfully'));
                 redirect('admin/reporting/parents_list'); 
            }
        }else{
            $this->session->set_flashdata('error',$this->lang->line('parent_not_delete_successfully'));
             redirect('admin/reporting/parents_list'); 
        }
           
    }

    public function delete()
    {
        // echo "string";die;
        $where = array('id'=>$this->uri->segment(5));
        // print_r($where);die;
        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(5)),'parents');

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

    public function excelParentsList()
    {
        // $fileName = 'parents-'.time().'.xlsx';  
        $fileName = 'parents-'.time().'.xls';  

        $ids = $this->input->post('parentId');

        $this->load->library('excel');

        $empInfo = $this->ReportingPdfModel->getParentExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('parents_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('parent_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('assigned_bus'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('secret_code'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('note'));
        
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', $this->lang->line('status'));      
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
            
            $parents_id = $element['parents_id'];
            $parnets_trip = $this->CommonModel->parentsAssignTripIds($parents_id);
            $comma_string = array();
            
            foreach ($parnets_trip as $k)
            {
                $comma_string[] = $k['trip_id'];
            }
            $comma_separated = implode(",", $comma_string);
            //  echo $comma_separated;
             $assignTrip =  $comma_separated;
             
            $date = date("d/m/Y", strtotime($element['updated_at']));
                
            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['parents_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['phone_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $assignTrip);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['secret_code']);
           
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['note']);
             
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

    public function pdfParentsList()
    {
        // print_r($_POST);die;
        $fileName = 'parents-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('parentId');
        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('parent').'</h3>';
        $html_content .= $this->ReportingPdfModel->getParentPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
 
    }

     public function getParentsReport()
    {
        // echo "string";die;
        // $client_id = $this->input->post('client_id');
        // $clientuserData = $this->CommonModel->parentsDataReportByClient($client_id);
        
        $client_name = $this->input->post('client_name');
        $getClientId = $this->CommonModel->getClientName($client_name);
        
        $comma_string = array();
        foreach ($getClientId as $k)
        {
            $comma_string[] = $k['id'];
        }
        $client_id = implode(",", $comma_string);
        $clientuserData = $this->CommonModel->parentsDataReportByClient($client_id);

        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                // $k = $k+1;
                
                 $parents_id = $clientuserData[$i]['parents_id'];
                $parnets_trip = $this->CommonModel->parentsAssignTripIds($parents_id);
                $comma_string = array();
                
                foreach ($parnets_trip as $k)
                {
                    $comma_string[] = $k['trip_id'];
                }
                $comma_separated = implode(",", $comma_string);
                //  echo $comma_separated;
                 $assignTrip =  $comma_separated;
             
                    $checkBox = '<input id="'.$clientuserData[$i]['parents_id'].'" type="checkbox" value="'.$clientuserData[$i]['parents_id'].'" name="parents_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['parents_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['parents_id'].'"></label><br>
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

                    $editUrl = base_url('admin/reporting/parentsEdit/'.$clientuserData[$i]['parents_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';

                    $deleteUrl = base_url('admin/reporting/ParentsController/deleter/'.$clientuserData[$i]['parents_id']);
                    $delete = '<a onclick="return deleteclientUser()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    // $action = $view.'<br>'.$edit.'<br>'.$delete;
                    $action = $edit.'<br>'.$delete;

                    $arr[] = array(
                        // $k,
                        $checkBox,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['parents_name'],
                        $clientuserData[$i]['phone_number'],
                        $assignTrip,
                        $modify_date,
                        $clientuserData[$i]['secret_code'],
                        $clientuserData[$i]['note']
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
    
    
    public function editParents()
    {
        $ids = $this->input->post('parentsId');
        // print_r($ids);die;
        redirect('admin/reporting/parentsEdit/'.$ids);
    }
    
    public function import_parents_view()
    {
        $data['title'] = $this->lang->line('import_parent');
        $this->loadAdminView('admin/reporting/parents/import_parents_view',$data);
    }
    
    public function import_parents()
    {
        // echo "hi";
        $path = $_FILES["file"]["tmp_name"];
        
        $object = PHPExcel_IOFactory::load($path);
      
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            // print_r($worksheet);
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {
               $clientName                 =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $clientFocalNumber          =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $clientFocalEmail           =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $clientUserName             =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $clientUserMobileNumber     =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $clientUserEmail            =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $parent_name                =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $parent_mobile              =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $secret_code                =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $parent_note                =   $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                
                
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
                        'email'     =>  $clientUserEmail,
                        "created_at"        =>  date('Y-m-d H:i:s a'),
                        "updated_at"        =>  date('Y-m-d H:i:s a'),
                    );

                    $clientUserInsert = $this->CommonModel->insertData($data,' client_user'); 

                    $clientUserId = $this->db->insert_id();
                }
                // print_r($clientUserId);
                // echo "<br>";
                $where = array(
                        'phone_number'=>$parent_mobile,
                        'client_user_id' => $clientUserId
                    );
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);
                // print_r($parentsDetail);
                // echo "<br>";

                $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');
    
                $count_data= $parents_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $parents_code = 'Parent'.$rand; 
                
                if(!empty($parentsDetail))
                {
                    $clientString[] = $client_id;
                    $clientId = implode(",", $clientString);
                    
                    // $clientUserString[] = $busDetail->client_user_id;
                    $clientUserString[] = $clientUserId;
                    $clientUserId = implode(",", $clientUserString);
                    
                    $chaperoneNameString[] = $parent_name;
                    $chaperoneName = implode(",", $chaperoneNameString);

                    $chaperoneNumberString[] = $parent_mobile;
                    $chaperoneNumber = implode(",", $chaperoneNumberString);

                    $chaperoneNoteString[] = $parent_note;
                    $chaperoneNote = implode(",", $chaperoneNoteString);

                     $chaperoneSecretString[] = $secret_code;
                    $chaperoneSecret = implode(",", $chaperoneSecretString);

                    $comma_string[] = $parentsDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;
                }else{
                    $client_user_id = $clientUserId;
                    $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
            
                    $max_parent = $getSubAdminData->max_parent;
                    $parentsCount = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$clientUserId."");
                    $parentsTotal = $parentsCount->total;
                    
                    if(empty($max_parent) && empty($parentsTotal)){
                        echo "000";exit;
                    }
                    // else if(empty($parentsTotal)){
                    //     echo "000";exit;
                    // }
                    else
                    {    
                        // echo "0000";exit;
                        if($max_parent <= $parentsTotal)
                        {
                             echo "00";
                        }else{
                            $data = array(
                                "client_user_id"         =>  $clientUserId,
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
                }
            }
            
            if($set)
            { 
                if (!empty($arr)) 
                {
                    $id = $arr;
                   $countparents = $this->CommonModel->countDuplicateParents($id);
                    // print_r($countBus->busTotal);die;
                    
                    $data = array(
                        'count'         =>  $countparents->parentsTotal,
                        'id'            =>  $arr,
                        'clientId'      =>  $clientId,
                        'clientUserId'  =>  $clientUserId,
                        'chaperoneName'    =>  $chaperoneName,
                        'chaperoneNumber'          =>  $chaperoneNumber,
                        'chaperoneNote'   =>  $chaperoneNote,
                        'chaperoneSecret'   =>  $chaperoneSecret,
                    );

                    echo json_encode($data);
                }else{
                    echo "1";
                }
            }else{
                echo "0";
            }
        }
        
        // die;
    }
    public function replaceParentsDuplicateData()
    {
        // print_r($_POST);
        $id = explode(',',($this->input->post('id'))); 
        $parent_name = explode(',',($this->input->post('chaperoneName'))); 
        $parent_mobile       = explode(',',($this->input->post('chaperoneMobile'))); 
        $parent_note = explode(',',($this->input->post('chaperoneNote'))); 
        $secret_code = explode(',',($this->input->post('secretCode'))); 
        $clientUserId = explode(',',($this->input->post('clientUserId')));
        
        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'parents'); 
        }
        // die;

        for ($i=0; $i < count($parent_mobile); $i++) 
        { 
            $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

            $count_data= $parents_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $parents_code = 'Parent'.$rand; 
            
            $parentsCount = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$clientUserId[$i]."");
                        
            $parentsTotal = $parentsCount->total;
            
            $client_user_id = $clientUserId[$i];
        
            //  $client_user_id = $this->session->userdata('ses_subadmin_id');
            $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
    
             $max_parent = $getSubAdminData->max_parent;
            
             if($max_parent <= $parentsTotal)
            {
                  $this->session->set_flashdata('error',$this->lang->line('max_parents'));
                redirect('admin/reporting/parents_list');
            }else{
                
                 $where = array(
                        'phone_number'=>$parent_mobile[$i],
                        'client_user_id' => $clientUserId[$i]
                    );
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);

                if($parentsDetail){
                    $condition = array('id'=>$parentsDetail->id);
                    // $parents_id = $parentsDetail->id;
    
                    $data = array(
                        "parents_unique_id"     =>  $parents_code[$i],
                            "parents_name"      =>  $parent_name[$i],
                            "phone_number"      =>  $parent_mobile[$i],
                            "note"              =>  $parent_note[$i],
                            "secret_code"       =>  $secret_code[$i],
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'parents',$data);  
                }else{
                    $data = array(
                            "client_user_id"        =>  $clientUserId[$i],
                            "parents_unique_id"     =>  $parents_code[$i],
                            "parents_name"          =>  $parent_name[$i],
                            "phone_number"          =>  $parent_mobile[$i],
                            "note"                  =>  $parent_note[$i],
                            "secret_code"           =>  $secret_code[$i],
                            "created_at"            =>  date('Y-m-d H:i:s a'),
                            "updated_at"            =>  date('Y-m-d H:i:s a'),
                        );
    
                $set = $this->CommonModel->insertData($data,'parents');
                }
                
                
                
            }
        }
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('parent_update_successfully'));
             redirect('admin/reporting/parents_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('parent_update_successfully'));
             redirect('admin/reporting/parents_list'); 
        }
    }
    public function donwload_parents_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        $fileName = "reporting_parent.xls";
        // $fileName = 'parents-'.time().'.csv';  
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
 
            if (file_exists ( $file )) 
            {
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                redirect ( base_url () );
            }
        }
    }

}
