<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChaperoneController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('csvimport');
	}

    public function chaperone_list()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('chaperone');

        $data['chaperone_count'] = $this->CommonModel->select_single_row("Select count(*) as chaperone_total from chaperone where client_user_id =".$this->session->userdata('ses_subadmin_id')."");

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);
// print_r( $data['getAllChaperone'] );die;
        $this->loadSubAdminView('subadmin/chaperone/list',$data); 
    }

    public function chaperone_add()
    {   
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        
        //  $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $max_chaperone = $getSubAdminData->max_chaperone;
        // print_r($getSubAdminData->max_chaperone);
        // echo "<br>";
        
         $chaperone_count = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
         $chaperone_total = $chaperone_count->total;
        //  print_r($chaperone_count->total);die;
         
        if($max_chaperone <= $chaperone_total)
        {
              $this->session->set_flashdata('error',$this->lang->line('chaperone_cross_maxlimit'));
            redirect('subadmin/chaperone'); 
             
        }
        
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $condition = array(
            'id' => $getSubAdminData->client_id,
        );

        $cleintDetail = $this->CommonModel->selectRowDataByCondition($condition,'client');

        $condition1 = array(
            "client_user_id"    => $this->session->userdata('ses_subadmin_id'),
        );

        $totalCount  = $this->CommonModel->countDataWithCondition('chaperone',$condition1);

        if($cleintDetail->max_chaperone == $totalCount)
        {
              $this->session->set_flashdata('error',$this->lang->line('max_chaperone'));
                redirect('subadmin/chaperone'); 
        }
        else{
            $data['title'] = $this->lang->line('add_new_chaperone');

            $where = array(
                "is_delete"         =>  0,
                "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
            );

            $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

            $this->loadSubAdminView('subadmin/chaperone/add',$data); 
        }

    }

     public function check_chaperoneNumber()
    {
        $condition = array(
            "phone_number" => $this->input->post('chaperone_phone_number'),
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
            //  "is_delete" => 0
             
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'chaperone');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function chaperone_insert()
    {
        // print_r($_POST);die;
        $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

        $count_data= $chaperone_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $chaperone_code = 'Chaperone'.$rand; 

        // print_r($driver_code);die;
        $chaperone_name = $this->input->post('f_name').' '.$this->input->post('family_name');

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "chaperone_unique_id"   =>  $chaperone_code,
                    "chaperone_name"      	=>  $chaperone_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    // "bus_id"        		=>  $this->input->post('bus_id'),
                    "note"        			=>  $this->input->post('note'),
                    "secret_code"           =>  $this->input->post('secret_code'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'chaperone');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_add_successfully'));
            redirect('subadmin/chaperone'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_add_successfully'));
             redirect('subadmin/chaperone_add'); 
            
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

    public function chaperone_edit()
    {
    	// echo "string";die;
        $data['title'] = $this->lang->line('edit_chaperone');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['chaperoneDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'chaperone');
        // print_r($data['driverDetail']);die;

         $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        // $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');
        $data['getAllBus'] = $this->CommonModel->selectResultDataByCondition($where,'bus');

        $this->loadSubAdminView('subadmin/chaperone/edit',$data); 
    }

    public function chaperone_update()
    {
        // print_r($_POST);die;
        $condition = array(
                'id' => $this->input->post('chaperone_id')
        );

      	$chaperone_name = $this->input->post('f_name').' '.$this->input->post('family_name');


        $data = array(
                    "chaperone_name"        =>  $chaperone_name,
                    "phone_number"          =>  $this->input->post('phone_number'),
                    // "bus_id"                =>  $this->input->post('bus_id'),
                    "note"                  =>  $this->input->post('note'),
                    "secret_code"           =>  $this->input->post('secret_code'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_update_successfully'));
            redirect('subadmin/chaperone'); 
            // redirect('subadmin/chaperone_edit/'.$this->input->post('chaperone_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_update_successfully'));
             redirect('subadmin/chaperone_edit/'.$this->input->post('chaperone_id')); 
            
        }
    }

    public function changeStatus()
    {
    	// print_r($_POST);die;

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('chaperone_id')),'chaperone');

        $condition = array(
            "id" => $this->input->post('chaperone_id')
        );
        if($data->driver_status == 1){
            $data = array("chaperone_status" => '0');
        }else{
            $data = array("chaperone_status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_chaperone()
    {
    	// echo "string";die;
    	// print_r($_POST);die;
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
                redirect('subadmin/chaperone'); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('chaperone_delete_successfully'));
             redirect('subadmin/chaperone'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_delete_successfully'));
             redirect('subadmin/chaperone'); 
        }
           
    }

    public function delete()
    {
        // echo "string";die;
        $where = array('id'=>$this->uri->segment(4));

        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(4)),'chaperone');

        if($busData){
            
            $updateData = $this->CommonModel->delete($where,'chaperone'); 

             if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('chaperone_delete_successfully'));
                 redirect('subadmin/chaperone'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('chaperone_not_delete_successfully'));
                 redirect('subadmin/chaperone'); 
            }
        }

        else{
            $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('subadmin/driver'); 
            
        }
    }
    public function import_chaperone()
    {
        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $max_chaperone = $getSubAdminData->max_chaperone;
        
        $chaperone_count = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
        $chaperone_total = $chaperone_count->total;
        
        if($max_chaperone <= $chaperone_total)
        {
             echo "00";
        }
        else
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
                    $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');
    
                    $count_data= $chaperone_max+1;//autoincrement
    
                    $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                    $chaperone_code = 'Chaperone'.$rand; 
    
                    $chaperone_name     =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $chaperone_mobile   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    // $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $secret_code        =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $chaperone_note     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                    
                    $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');
    
                    $count_data= $chaperone_max+1;//autoincrement
        
                    $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                    $chaperone_code = 'Chaperone'.$rand; 
        
                    $where = array(
                        'phone_number'=>$chaperone_mobile,
                        'client_user_id' => $this->session->userdata('ses_subadmin_id')
                    );
                    $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);
                    
                        if(!empty($chaperoneDetail))
                        {
                        
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
                        }else
                        { 
                            $chaperoneCount = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
                            $chaperoneTotal = $chaperoneCount->total;
                    
                            if($max_chaperone <= $chaperoneTotal)
                            {
                                // $this->session->set_flashdata('error',$this->lang->line('max_chaperone'));
                                // redirect('subadmin/chaperone');
                                echo "00";die;
                                 
                            }else
                            {
                                // echo "insert";
                                $data = array(
                                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
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
    
                // die;
                if($set)
                {
                    // echo "1";
                    if (!empty($arr)) 
                    {
                        $id = $arr;
                        $countChaperone = $this->CommonModel->countDuplicateChaperone($id);
                        // print_r($countBus->busTotal);die;
    
                        $data = array(
                            'count'         =>  $countChaperone->chaperoneTotal,
                            'id'            =>  $arr,
                            'chaperoneName'    =>  $chaperoneName,
                            'chaperoneMobile'  =>  $chaperoneMobile,
                            'chaperoneNote'    =>  $chaperoneNote,
                            'secretCode'    =>  $secretCode,
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
    
    public function replaceChaperoneDuplicateData()
    {
         $client_user_id = $this->session->userdata('ses_subadmin_id');
        $getSubAdminData = $this->CommonModel->subadminDetail($client_user_id);

        $max_chaperone = $getSubAdminData->max_chaperone;
        
        // print_r($_POST);
        
        $id = explode(',',($this->input->post('id'))); 
       $chaperone_name = explode(',',($this->input->post('chaperoneName'))); 
        $chaperone_mobile   = explode(',',($this->input->post('chaperoneMobile'))); 
        $chaperone_note = explode(',',($this->input->post('chaperoneNote')));
        $secret_code = explode(',',($this->input->post('secretCode')));
        
        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'chaperone'); 
        }
        // die;

        for ($i=0; $i < count($chaperone_mobile); $i++) 
        { 
            $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

                $count_data= $chaperone_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $chaperone_code = 'Chaperone'.$rand;
            
             $chaperonecount = $this->CommonModel->select_single_row("Select count(*) as total from chaperone where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
                            $chaperonetotal = $chaperonecount->total;
                    
            if($max_chaperone <= $chaperonetotal)
            {
                $this->session->set_flashdata('error',$this->lang->line('max_chaperone'));
                redirect('subadmin/chaperone');
            }else{
                
                $where = array(
                	"phone_number"          =>  $chaperone_mobile[$i],
                	'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);
                
                if(!empty($chaperoneDetail))
                {
                    $condition = array('id'=>$chaperoneDetail->id);
    
                    $data = array(
                        "chaperone_unique_id"   =>  $chaperone_code,
                        "chaperone_name"        =>  $chaperone_name[$i],
                        "phone_number"          =>  $chaperone_mobile[$i],
                        "note"                  =>  $chaperone_note[$i],
                        "secret_code"           =>  $secret_code[$i],
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

                }else{
                    $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
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
             redirect('subadmin/chaperone'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('chaperone_not_update_successfully'));
             redirect('subadmin/chaperone'); 
        }
    }
    public function import_chaperoneOld()
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

                $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

                $count_data= $chaperone_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $chaperone_code = 'Chaperone'.$rand; 

                $chaperone_name     =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $chaperone_mobile   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                // $assign_bus         =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $secret_code        =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $chaperone_note     =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                // print_r($chaperone_name);
                // print_r($chaperone_mobile);
                // // print_r($assign_bus);
                // print_r($chaperone_note);
                // print_r($secret_code);
                // echo "<br>";
                
                $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

                $count_data= $chaperone_max+1;//autoincrement
    
                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $chaperone_code = 'Chaperone'.$rand; 
    
                $where = array(
                	'phone_number'=>$chaperone_mobile,
                	'client_user_id' => $this->session->userdata('ses_subadmin_id')
                );
                $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);

                if(!empty($chaperoneDetail))
                {
                    $condition = array('id'=>$chaperoneDetail->id);
    
                    $data = array(
                        "chaperone_name"        =>  $chaperone_name,
                        "phone_number"          =>  $chaperone_mobile,
                        "note"                  =>  $chaperone_note,
                        "secret_code"           =>  $secret_code,
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
    
                    $set = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

                }else{                   
    
                     $data = array(
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
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
            // die;
            if($set)
            {
                echo "1";
            }else{
                echo "0";
            }
        }   
    }
    
    public function import_chaperone_old()
    {
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;

        foreach($file_data as $row)
        {   

            $chaperone_name     =   $row["Chaperone Name"];
            $chaperone_mobile   =   $row["Mobile Numbe"];
            // $assign_bus         =   $row["Driver Name"];
            $chaperone_note     =   $row["Note"];
            $secret_code        =   $row["Security Code"];

            $chaperone_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('chaperone')->row('id');

            $count_data= $chaperone_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $chaperone_code = 'Chaperone'.$rand; 

            $where = array('phone_number'=>$chaperone_mobile);
            $chaperoneDetail = $this->CommonModel->getsingle('chaperone',$where);

            if(!empty($chaperoneDetail))
            {
                $condition = array('id'=>$chaperoneDetail->id);

                $data = array(
                    "chaperone_name"        =>  $chaperone_name,
                    "phone_number"          =>  $chaperone_mobile,
                    "note"                  =>  $chaperone_note,
                    "secret_code"           =>  $secret_code,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'chaperone',$data);  

            }else{                   

                 $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
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

        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    // public function excelChaperoneList()
    public function exportChaperoneCSV()
    {
        // $fileName = 'driver-'.time().'.xlsx';  
        $fileName = 'chaperone-'.time().'.xls';  

        $ids = $this->input->post('chaperoneId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getChaperoneExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('chaperone_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('chaperone_number'));
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('assigned_bus'));
         $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('secret_code'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('note'));
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            // if($element['chaperone_status'] ==1)
            // {
            //     $status = $this->lang->line('active');
            // }else{
            //     $status = $this->lang->line('deactive'); 
            // }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['chaperone_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['phone_number']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['bus_unique_id']);
             $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['secret_code']);
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

    public function pdfChaperoneList()
    {
        $fileName = 'driver-'.time().'.pdf';  

        $ids = $this->input->post('chaperoneId');

        $html_content = '<h3 align="center">'.$this->lang->line('chaperone').'</h3>';
        $html_content .= $this->PdfModel->getChaperonePdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
 
    }
    public function exportChaperoneCSVOld()
    {
        $ids = $this->input->post('chaperoneId');
        //get data 
        $usersData = $this->PdfModel->getChaperoneCsv($ids);

        // print_r($usersData);die;

        // $filename = 'chaperone-'.time().'.csv';  
        // $filename = 'chaperone-'.time().'.xlsx';  
        $filename = 'chaperone-'.time().'.xls';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');
     
       // $header = array("Bus Number","Plate Number","Note","Modify"); 
        $header = array("Chaperone Name","Mobile Numbe","Security Code","Note"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }

    public function editChaperone()
    {
        $ids = $this->input->post('chaperoneId');
        // print_r($ids);die;

        redirect('subadmin/chaperone_edit/'.$ids);
    }
     public function import_chaperone_view()
    {
        $data['title'] = $this->lang->line('import_chaperone');
        // echo "string"; die;
        $this->loadSubAdminView('subadmin/chaperone/import_chaperone_view',$data); 
    }

    public function donwload_chaperone_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "chaperone.csv";
        // $fileName = "chaperone.xlsx";
        $fileName = "chaperone.xls";
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
