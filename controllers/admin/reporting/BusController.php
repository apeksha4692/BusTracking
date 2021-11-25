<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class BusController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function bus_list()
    {	
        $data['title'] = $this->lang->line('buses');

        $data['bus_count'] = $this->CommonModel->select_single_row("Select count(*) as total from bus ");

    	 $data['getAllClient'] = $this->CommonModel->clientGroup();

        $data['getAllBus'] = $this->CommonModel->busDataReport();
        // print_r($data['getAllBus']);die;
    	$this->loadAdminView('admin/reporting/bus/bus_list',$data); 
    }

     public function bus_add()
    {   
        // echo "string";die;

        $data['title'] = $this->lang->line('add_bus');

        // echo "string";die;
        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/reporting/bus/add',$data); 
    }
    
    public function check_busPlateNumber()
    {
        // print_r($_POST);die;
        $condition = array(
            "bus_plate_number" => $this->input->post('bus_plate_number'),
            "client_user_id" => $this->input->post('client_user_id'),
             "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function check_busNumber()
    {
        //  print_r($_POST);die;
        // echo "string";

        $condition = array(
            "bus_number" => $this->input->post('bus_number'),
             "client_user_id" => $this->input->post('client_user_id'),
             "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function bus_insert()
    {
        
         $condition = array(
            "bus_plate_number" => $this->input->post('bus_plate_number'),
            "client_user_id" => $this->input->post('client_user_id'),
             "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        
        
        if(!empty($busData)){
            $data['post'] = $_POST;
            // print_r($data['post'] );die;
             $this->session->set_flashdata('error','Bus Id  already exit. Used different Bus Id');
             
             $data['title'] = $this->lang->line('add_bus');
            // echo "string";die;
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
        
            $this->loadAdminView('admin/reporting/bus/add',$data);
                    
            return;
        }
        
        $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

        $count_data= $busdata_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $bus_code = 'BUS'.$rand; 

        // print_r($bus_code);die;

        $data = array(
                    "bus_number"            =>  $this->input->post('bus_number'),
                    "bus_plate_number"      =>  $this->input->post('bus_plate_number'),
                    "bus_note"              =>  $this->input->post('bus_note'),
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "bus_unique_id"         =>  $bus_code,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'bus');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_add_successfully'));
            // redirect('subadmin/bus_add'); 
            redirect('admin/reporting/bus_list'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('bus_not_add_successfully'));
             redirect('admin/reporting/bus_list'); 
            
        }

    }


    public function bus_edit()
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

        $bus_id = $this->uri->segment(4);

        // print_r($parent_id);die;
        $data['busDetail'] = $this->CommonModel->busDetail($bus_id);
        // print_r($data['busDetail']);die;


        $this->loadAdminView('admin/reporting/bus/edit',$data); 
    }

    public function bus_update()
    {
        // print_r($_POST);die;
        $condition = array(
                'id' => $this->input->post('bus_id')
        );
        // print_r($condition);die;

        $data = array(
                    "client_user_id"        =>  $this->input->post('client_user_id'),
                    "bus_number"            =>  $this->input->post('bus_number'),
                    "bus_plate_number"      =>  $this->input->post('bus_plate_number'),
                    "bus_note"              =>  $this->input->post('bus_note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_update_successfully'));
            redirect('admin/reporting/bus_list'); 
            // redirect('subadmin/bus_edit/'.$this->input->post('bus_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('bus_not_update_successfully'));
             redirect('admin/reporting/busEdit/'.$this->input->post('bus_id')); 
            
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


    public function delete_bus()
    {
        // print_r($_POST);die;
        $bus_id = $this->input->post('busId');
        $client_id = $this->input->post('client_id');
        $client_user_id = $this->input->post('client_user_id');
        // print_r($bus_id);die;
        $val = explode(',',($this->input->post('busId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'bus');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'bus'); 

                // $w1 = array('bus_id'=>$value);
                // $uData = $this->CommonModel->delete($w1,'driver');
                // $u1Data = $this->CommonModel->delete($w1,'chaperone');
                // $u2Data = $this->CommonModel->delete($w1,'parents');
                
            }
            else
            {
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('admin/reporting/bus_list'); 
            }
        }

        if($updateData)
        {
            // echo "hi";
            // print_r( $client_id);
            // die;
             
            if(!empty($client_id))
            {
                $data['title'] = $this->lang->line('buses');

                $data['bus_count'] = $this->CommonModel->select_single_row("Select count(*) as total from bus ");
                
                $data['client_id'] = $client_id;
                    
               $data['getAllClient'] = $this->CommonModel->clientGroup();
                
                $client_name = $client_id;
                $getClientId = $this->CommonModel->getClientName($client_name);
                
                $comma_string = array();
                foreach ($getClientId as $k)
                {
                    $comma_string[] = $k['id'];
                }
                $client_id = implode(",", $comma_string);
                $data['getAllBus']  =  $this->CommonModel->busDataReportByClient($client_id);
                
                $this->session->set_flashdata('success',$this->lang->line('bus_delete_successfully'));
                $this->loadAdminView('admin/reporting/bus/bus_list',$data); 
    	        return;
            }else
            {
                $data['client_id'] = "";
                $this->session->set_flashdata('success',$this->lang->line('bus_delete_successfully'));
                redirect('admin/reporting/bus_list'); 
            }
        }else{
            $this->session->set_flashdata('error',$this->lang->line('bus_not_delete_successfully'));
             redirect('admin/reporting/bus_list'); 
        }
        
        // die;
           
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(5));
// print_r($where);die;
        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(5)),'bus');
// print_r($busData);die;
        if($busData){

            // $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'bus'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('bus_delete_successfully'));
                 redirect('admin/reporting/bus_list'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('bus_not_delete_successfully'));
                redirect('admin/reporting/bus_list'); 
            }
        }

        else{
             
            $this->session->set_flashdata('error','Something Went Wrong');
            redirect('admin/reporting/bus_list'); 
            
        }
    }

      public function excelBusList()
    {
        // $fileName = 'bus-'.time().'.xlsx';  
        $fileName = 'bus-'.time().'.xls';  

        $ids = $this->input->post('busId');

        $this->load->library('excel');

        $empInfo = $this->ReportingPdfModel->getBusExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('bus_id_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('bus_plate_number'));
         $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('modify'));       
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('note'));
       
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['bus_status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['bus_plate_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['bus_note']);
            
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

    public function pdfBusList()
    {
        $fileName = 'bus-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('busId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('bus').'</h3>';
        $html_content .= $this->ReportingPdfModel->getBusPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
    }

     public function getBusReport()
    {
        // $client_id = $this->input->post('client_id');
        // $clientuserData = $this->CommonModel->busDataReportByClient($client_id);
        $client_name = $this->input->post('client_name');
        $getClientId = $this->CommonModel->getClientName($client_name);
        
        $comma_string = array();
        foreach ($getClientId as $k)
        {
            $comma_string[] = $k['id'];
        }
        $client_id = implode(",", $comma_string);
        $clientuserData = $this->CommonModel->busDataReportByClient($client_id);
        
        
        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";


                    $checkBox = '<input id="'.$clientuserData[$i]['bus_id'].'" type="checkbox" value="'.$clientuserData[$i]['bus_id'].'" name="bus_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['bus_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['bus_id'].'"></label><br>
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

                    $editUrl = base_url('admin/reporting/busEdit/'.$clientuserData[$i]['bus_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';



                    $deleteUrl = base_url('admin/reporting/BusController/delete/'.$clientuserData[$i]['bus_id']);
                    $delete = '<a onclick="return deleteBus()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    // $action = $view.'<br>'.$edit.'<br>'.$delete;
                    $action = $edit.'<br>'.$delete;

                    // print_r($action);die;

                    $arr[] = array(
                        // $k,
                        $checkBox,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['bus_number'],
                        $clientuserData[$i]['bus_plate_number'],
                         $modify_date,
                        $clientuserData[$i]['bus_note'],
                       
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
    
     public function editBus()
    {
        $ids = $this->input->post('busId');

        redirect('admin/reporting/busEdit/'.$ids);
    }
    
    public function import_bus_view()
    {
        $data['title'] = $this->lang->line('import_bus');
        $this->loadAdminView('admin/reporting/bus/import_view',$data);
    }
    
    public function import_bus()
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
                $bus_number                 =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $bus_plate_number           =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $bus_note                   =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                
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
                        'bus_number'     => $bus_number,
                        'client_user_id' => $clientUserId
                    );
                $busDetail = $this->CommonModel->getsingle('bus',$where);
                // print_r($busDetail);
                // echo "<br>";
                $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

                $count_data= $busdata_max+1;//autoincrement
        
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $bus_code = 'BUS'.$rand; 
        
                if(!empty($busDetail))
                {
                    // echo "1";
                    // echo "<br>";
                    $clientString[] = $client_id;
                    $clientId = implode(",", $clientString);
                    
                    // $clientUserString[] = $busDetail->client_user_id;
                    $clientUserString[] = $clientUserId;
                    $clientUserId = implode(",", $clientUserString);
                    
                    $busNumbertring[] = $bus_number;
                    $busNumber = implode(",", $busNumbertring);
                    
                    $plateNumberString[] = $bus_plate_number;
                    $plateNumber = implode(",", $plateNumberString);
                    
                    $notetring[] = $bus_note;
                    $busNote = implode(",", $notetring);

                    $comma_string[] = $busDetail->id;
                    $arr = implode(",", $comma_string);

                    $set = $arr;
                    
                }else{
                    // echo "0";
                    // echo "<br>";
                    $data = array(
                        "bus_number"            =>  $bus_number,
                        "bus_plate_number"      =>  $bus_plate_number,
                        "bus_note"              =>  $bus_note,
                        "client_user_id"        =>  $clientUserId,
                        "bus_unique_id"         =>  $bus_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $set = $this->CommonModel->insertData($data,'bus');  
                }
            }
        //     print_r($set);
        //   die; 
            if($set)
            { 
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countBus = $this->CommonModel->countDuplicateBus($id);
                    // print_r($countBus->busTotal);die;
                    
                    $data = array(
                        'count'         =>  $countBus->busTotal,
                        'id'            =>  $arr,
                        'clientId'      =>  $clientId,
                        'clientUserId'  =>  $clientUserId,
                        'bus_number'    =>  $busNumber,
                        'note'          =>  $busNote,
                        'plateNumber'   =>  $plateNumber,
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
    
    public function replaceDuplicateData()
    {
        // print_r($_POST);die;
        $id = explode(',',($this->input->post('id'))); 
        $busNumber = explode(',',($this->input->post('bus_number'))); 
        $note       = explode(',',($this->input->post('note'))); 
        $plateNumber = explode(',',($this->input->post('plateNumber'))); 
        $clientUserId = explode(',',($this->input->post('clientUserId'))); 

        // print_r($busNumber);

        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'bus'); 
        }
        // die;

        for ($i=0; $i < count($busNumber); $i++) 
        { 
            $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');
            $count_data= $busdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $bus_code = 'BUS'.$rand;

            $data = array(
                    "bus_number"            =>  $busNumber[$i],
                    "bus_plate_number"      =>  $plateNumber[$i],
                    "bus_note"              =>  $note[$i],
                    "bus_unique_id"         =>  $bus_code,
                    "client_user_id"        =>  $clientUserId[$i],
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

            $set = $this->CommonModel->insertData($data,'bus');
        }
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_update_successfully'));
             redirect('admin/reporting/bus_list'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('bus_not_update_successfully'));
             redirect('admin/reporting/bus_list'); 
        }
    }
    
    public function donwload_bus_import($fileName = NULL)
    {
        $this->load->helper('download');
        // $fileName = "bus.csv";
        // $fileName = "bus.xlsx";
        $fileName = "reporting_bus.xls";
        if ($fileName) 
        {
            $file = realpath ("download" ) . "/" . $fileName;
            if (file_exists ( $file )) 
            {
                $data = file_get_contents ( $file );
                force_download ($fileName, $data );
            } else {
                redirect ( base_url () );
            }
        }
    }

}
