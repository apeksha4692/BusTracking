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
        $data['title'] = $this->lang->line('parent');

        $data['parents_count'] = $this->CommonModel->select_single_row("Select count(*) as parents_total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);
        $this->loadSubAdminView('subadmin/parents/list',$data); 
    }
    
    public function check_parnetsNumber()
    {
        $condition = array(
            "phone_number"      => $this->input->post('parnetns_phone_number'),
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    

    public function parents_add()
    {   
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $condition = array(
            'id' => $getSubAdminData->client_id,
        );

        $cleintDetail = $this->CommonModel->selectRowDataByCondition($condition,'client');

        $condition1 = array(
            "client_user_id"    => $this->session->userdata('ses_subadmin_id'),
        );
        
        $parents_count = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
        // print_r($parents_count->total);die;
        // $totalCount  = $this->CommonModel->countDataWithCondition('parents',$condition1);
         $parents_total = $parents_count->total;
        
        if($getSubAdminData->max_parent <= $parents_total)
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
        $condition = array(
            "phone_number"      => $this->input->post('phone_number'),
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        
         if(!empty($busData))
         {
            $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $condition = array(
            'id' => $getSubAdminData->client_id,
        );

        $cleintDetail = $this->CommonModel->selectRowDataByCondition($condition,'client'); 
             
             
            $data['title'] = $this->lang->line('add_new_parent');
            $data['post'] = $_POST;
             
            $where = array(
                "is_delete"         =>  0,
                "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
            );

            $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');
             $this->session->set_flashdata('error','Number Already exit. Used different Number');
            $this->loadSubAdminView('subadmin/parents/add',$data);
                    //  redirect('admin/client/add',$data); 
                    
            return;
        }
        
        $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

        $count_data= $parents_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $parents_code = 'Parent'.$rand; 
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
    public function import_parent()
    {
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
        
        $max_parent = $getSubAdminData->max_parent;
        
        $parents_count = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
        // print_r($parents_count->total);die;
         $parents_total = $parents_count->total;
        
        if($max_parent <= $parents_total)
        {
             echo "00";
        }else{
        
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
    
    
                    $parent_name     =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $parent_mobile   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    // $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $secret_code        =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                     $parent_note     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    // print_r($chaperone_name);
                    // print_r($chaperone_mobile);
                    // print_r($assign_bus);
                    // print_r($chaperone_note);
                    // print_r($secret_code);
                    // echo "<br>";
                     $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');
    
                    $count_data= $parents_max+1;//autoincrement
        
                    $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                    $parents_code = 'Parent'.$rand; 
        
        
                    $where = array(
                        'phone_number'=>$parent_mobile,
                        'client_user_id' => $this->session->userdata('ses_subadmin_id')
                    );
                    $parentsDetail = $this->CommonModel->getsingle('parents',$where);
    
                    if(!empty($parentsDetail))
                    {
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
                        
                        $parentsCount = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
                        $parentsTotal = $parentsCount->total;
                        
                         if($max_parent <= $parentsTotal)
                        {
                             echo "00";
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
                }
                // die;
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
                            'chaperoneName'    =>  $chaperoneName,
                            'chaperoneNumber'          =>  $chaperoneNumber,
                            'chaperoneNote'   =>  $chaperoneNote,
                            'chaperoneSecret'   =>  $chaperoneSecret,
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
    }
    
    public function replaceParentsDuplicateData()
    {
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);
        
        $max_parent = $getSubAdminData->max_parent;
        // print_r($_POST);die;
        
        $id = explode(',',($this->input->post('id'))); 
        $parent_name = explode(',',($this->input->post('chaperoneName'))); 
        $parent_mobile       = explode(',',($this->input->post('chaperoneMobile'))); 
        $parent_note = explode(',',($this->input->post('chaperoneNote'))); 
        $secret_code = explode(',',($this->input->post('secretCode'))); 

        // print_r($busNumber);

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
            
            $parentsCount = $this->CommonModel->select_single_row("Select count(*) as total from parents  where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
                        
            $parentsTotal = $parentsCount->total;
            
             if($max_parent <= $parentsTotal)
            {
                  $this->session->set_flashdata('error',$this->lang->line('max_parents'));
                redirect('subadmin/parents');
            }else{
                
                $where = array(
                    "phone_number"  =>  $parent_mobile[$i],
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);
                    
                if(!empty($parentsDetail))    
                {
                    $condition = array('id'=>$parentsDetail->id);
                    $data = array(
                        "parents_unique_id"     =>  $parents_code[$i],
                        "parents_name"          =>  $parent_name[$i],
                        "phone_number"          =>  $parent_mobile[$i],
                        "note"                  =>  $parent_note[$i],
                        "secret_code"           =>  $secret_code[$i],
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                    $set = $this->CommonModel->updateRowByCondition($condition,'parents',$data); 
                }else{
                    $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
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
             redirect('subadmin/parents'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('parent_update_successfully'));
             redirect('subadmin/parents'); 
        }

        
    }
        
        
    public function import_parent_Old()
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

                $parent_name     =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $parent_mobile   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                // $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $secret_code        =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                 $parent_note     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                // print_r($chaperone_name);
                // print_r($chaperone_mobile);
                // print_r($assign_bus);
                // print_r($chaperone_note);
                // print_r($secret_code);
                // echo "<br>";
                 $parents_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('parents')->row('id');

                $count_data= $parents_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $parents_code = 'Parent'.$rand; 
    
    
                $where = array(
                    'phone_number'=>$parent_mobile,
                    'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $parentsDetail = $this->CommonModel->getsingle('parents',$where);

                if(!empty($parentsDetail))
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
            // die;
            if($set)
            {
                echo "1";
            }else{
                echo "0";
            }
        }   
    }
    
    
     public function import_parentOld()
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
    //  public function excelParentsList()
    public function exportParentsCSV()
    {
        // $fileName = 'parents-'.time().'.xlsx';  
        $fileName = 'parents-'.time().'.xls';  
         $ids = $this->input->post('parentsId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getParentExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('parents_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('parent_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('assign_trip_ids'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('secret_code'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('note'));
        
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', $this->lang->line('status'));      
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
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['parents_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['phone_number']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['bus_unique_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $assignTrip);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['secret_code']);
             $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['note']);
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

    public function exportParentsCSVOld()
    {
        $ids = $this->input->post('parentsId');
        //get data 
        $usersData = $this->PdfModel->getParentCsv($ids);

        // print_r($usersData);die;

        // $filename = 'parents-'.time().'.csv';  
        $filename = 'parents-'.time().'.xlsx';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');
     
       // $header = array("Bus Number","Plate Number","Note","Modify"); 
        $header = array("Parents Name","Child Name","Mobile Numbe","Note","Security Code"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }


    public function editParents()
    {
        $ids = $this->input->post('parentsId');
        // print_r($ids);die;
        redirect('subadmin/parents_edit/'.$ids);
    }
     public function import_parents_view()
    {
        $data['title'] = $this->lang->line('import_parent');
        // echo "string"; die;
        $this->loadSubAdminView('subadmin/parents/import_parents_view',$data); 
    }

    public function donwload_parents_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "parent.csv";
        // $fileName = "parent.xlsx";
        $fileName = "parent.xls";
        // $fileName = 'parents-'.time().'.csv';  
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
    
    public function parents_view()
    {

        $parents_id  = $this->uri->segment(3);
        $data['title'] = $this->lang->line('view_parent');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['parentsDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'parents');
        
         $data['childList'] = $this->CommonModel->parentsChildList($parents_id);

        // print_r($data['childList']);die;
        $this->loadSubAdminView('subadmin/parents/view_parents',$data); 
    }
    
    public function add_child()
    {
        $data['title'] = $this->lang->line('add_child');
        
        $this->loadSubAdminView('subadmin/parents/add_child',$data);
    }
    
    public function insert_child()
    {
        $filesCount = count($_FILES['images']['name']);
        for($i = 0; $i < $filesCount; $i++)
        {
            $targetFilePath = './uploads/child_image/' . $_FILES['images']['name'][$i];
            
            if(move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFilePath)){
                $uploadData = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "parents_id"    => $this->input->post('parents_id'),
                    "child_name"     => $this->input->post('child_name')[$i],
                    "child_image"         => $_FILES['images']['name'][$i]
                );
                $insertData = $this->CommonModel->insertData($uploadData,'child');
            }
        }
        
        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('child_added_successfully'));
            // redirect('subadmin/bus_add'); 
            redirect('subadmin/parents_view/'.$this->input->post('parents_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('child_not_added_successfully'));
             redirect('subadmin/add_child/'.$this->input->post('parents_id')); 
        }
    }
    
    public function exportChildCSV()
    {
        $fileName = 'parentChild-'.time().'.xls';  

        $ids = $this->input->post('child_id');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getParentChildExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('child_name'));    
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['child_name']);
            
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
    
    public function editChild()
    {
        // print_r($_POST);die;
        $ids = $this->input->post('child_id');
       
        redirect('subadmin/parent/edit_child/'.$ids);
    }
    
    public function edit_child()
    {
        $data['title'] = $this->lang->line('edit_child');

        $condition = array(
                'id' => $this->uri->segment(4)
        );
        $data['childDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'child');
        // print_r($data['busDetail']);die;
        $this->loadSubAdminView('subadmin/parents/edit_child',$data); 
    }
    
    public function update_child()
    {
        $condition = array(
            "id" => $this->input->post('id')
        );

        $childData = $this->CommonModel->getsingle('child',$condition);

        if (isset($_FILES['profile_pic'])) 
        {  
            if($_FILES['profile_pic']['size'] != 0)
            {
                 $config['upload_path']         =  'uploads/child_image/';
                $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['max_size']             =  (1024)*(1024);
                $config['max_width']            =  0;
                $config['max_height']           =  0;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('profile_pic'))
                {
                    $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                    redirect('subadmin/parent/edit_child/'.$this->input->post('id'));
                }
                else
                {
                    $this->upload_data['file'] = $this->upload->data();
                    $child_image = $this->upload->data('file_name');      
                }
            }
            else
            {
               $child_image = $childData->child_image; 
            }
        }
        else
        {
           $child_image = $childData->child_image; 
        }

        $data = array(
                    "child_name"           =>  $this->input->post('child_name'),
                    'child_image'            =>  $child_image,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'child',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->input->post('child_updated_successfully')); 
            redirect('subadmin/parents_view/'.$childData->parents_id);
        }else{
            $this->session->set_flashdata('error',$this->input->post('child_not_updated_successfully'));
            redirect('subadmin/parent/edit_child/'.$this->input->post('id')); 
            
        }
    }
    
    
    public function delete_child()
    {
        // print_r($_POST);die;
        $val = explode(',',($this->input->post('child_id')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'child');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'child'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/parents_view/'.$this->input->post('parents_id')); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('child_delet_successfully'));
             redirect('subadmin/parents_view/'.$this->input->post('parents_id')); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('child_not_delet_successfully'));
             redirect('subadmin/parents_view/'.$this->input->post('parents_id')); 
        }
           
    }

}
