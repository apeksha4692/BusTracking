<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientUserController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
         $this->load->library('csvimport');
        
	}

    public function clentuser_list()
    {
        $data['clientuser_count'] = $this->CommonModel->select_single_row("Select count(*) as client_user_total from client_user ");

        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        // $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
        
         $data['getAllClient'] = $this->CommonModel->clientGroup();
        
        $data['title'] = $this->lang->line('clients_portal_user');
        
        $where = array(
            "is_delete" => 0
        );

        $data['getAllClientUser'] = $this->CommonModel->getClientUser();
       
        // print_r($data['getAllClientUser'] );die;
        $this->loadAdminView('admin/clientuser/list_clientuser',$data); 
    }

    public function clientuser_add()
    {
        $data['title'] = 'Add Client User';

        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/clientuser/add_clientuser',$data); 
    }

    public function check_user()
    {
        // $condition = array(
        //     "mobile_number" => $this->input->post('login_username'),
        //     //  "is_delete" => 0
        // );
        
        $clientUser_id = $this->input->post('clientUser_id');
         
        if($clientUser_id == 0) {
            $condition = array(
                "mobile_number" => $this->input->post('mobile_number'),
            );
            
        }else{
            $condition = "(mobile_number='".$this->input->post('mobile_number')."' AND id !=".$clientUser_id.")";
        }
        
        $clientUserData = $this->CommonModel->selectRowDataByCondition($condition,'client_user');
        if ($clientUserData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function check_UserMail()
    {
        // $condition = array(
        //     "email" => $this->input->post('email_id'),
        //     //  "is_delete" => 0
        // );
        $clientUser_id = $this->input->post('clientUser_id');
        
        if($clientUser_id == 0) {
            $condition = array(
                "email" => $this->input->post('email_id'),
            );
        }else{
            $condition = "(email='".$this->input->post('email_id')."' AND id !=".$clientUser_id.")";
        }
        
        $clientUserData = $this->CommonModel->selectRowDataByCondition($condition,'client_user');
        
        if ($clientUserData) {
            echo "1";
        }else{
            echo "0";
        }

    }
    public function clientuser_insert()
    {
        // $condition = array(
        //     "mobile_number" => $this->input->post('mobile_number'),
        //     //  "is_delete" => 0
        // );
        
        $condition = "(email='".$this->input->post('email')."' or mobile_number=".$this->input->post('mobile_number').")";
        
        $clientUserData = $this->CommonModel->selectRowDataByCondition($condition,'client_user');
        
        if(!empty($clientUserData))
        {
            $data['post'] = $_POST;
             $this->session->set_flashdata('error','Mobile Number OR Email-Id already exit. Used different Mobile Number OR Email-Id');
            $data['title'] = 'Add Client User';

            $where = array(
                "delete" => 0,
                "status" => 1,
            );
    
            $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');
    
            $this->loadAdminView('admin/clientuser/add_clientuser',$data);  
                    
            return;
        }
        
        $data = array(
                    "client_id"           =>  $this->input->post('client_id'),
                    "username"            =>  $this->input->post('username'),
                    "email"               =>  $this->input->post('email'),
                    "mobile_number"       =>  $this->input->post('mobile_number'),
                    "login_username"      =>  $this->input->post('login_username'),
                    "login_password"      =>  $this->input->post('login_password'),
                    "created_at"          =>  date('Y-m-d H:i:s a'),
                    "updated_at"          =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'client_user');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success','Client User Add Successfully');
            // redirect('admin/clientuser_add');
            redirect('admin/clientuser');  
        }else{
            
            $this->session->set_flashdata('error','Client User not add Successfully ');
            redirect('admin/clientuser_add');  
            
        }

    }

    public function changeStatus()
    {

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('client_user_id')),'client_user');
// print_r($data);die;
        $condition = array(
            "id" => $this->input->post('client_user_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }


        $updateData = $this->CommonModel->updateRowByCondition($condition,'client_user',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_clientuser()
    {
          $client_id = $this->input->post('client_id');
        // echo "string";die;
        $val = explode(',',($this->input->post('cliendUserId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $clientuserData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'client_user');

            if($clientuserData)
            {
                $updateData = $this->CommonModel->delete($where,'client_user'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('admin/clientuser'); 
            }
        }

        if($updateData)
        {
            if(!empty($client_id))
            {
                $data['clientuser_count'] = $this->CommonModel->select_single_row("Select count(*) as client_user_total from client_user ");
                 $data['client_id'] = $client_id;
                
                $data['title'] = $this->lang->line('clients_portal_user');
                
                $data['getAllClient'] = $this->CommonModel->clientGroup();
                
                $client_name = $client_id;
                $getClientId = $this->CommonModel->getClientName($client_name);
                
                $comma_string = array();
                foreach ($getClientId as $k)
                {
                    $comma_string[] = $k['id'];
                }
                $client_id = implode(",", $comma_string);
                $data['getAllClientUser']  =  $this->CommonModel->getClientUserByClient($client_id);
                
                $this->session->set_flashdata('success',$this->lang->line('clientUser_delete_successfully'));
                $this->loadAdminView('admin/clientuser/list_clientuser',$data); 
                return;
            }else{
            
            
                $this->session->set_flashdata('success',$this->lang->line('clientUser_delete_successfully'));
                 redirect('admin/clientuser'); 
                 
            }
        }else{
            $this->session->set_flashdata('error',$this->lang->line('clientUser_not_delete_successfully'));
            redirect('admin/clientuser');  
        }
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(3));

        $clientuserData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(3)),'client_user');

        if($clientuserData){

            // $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'client_user'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('clientUser_delete_successfully'));
                 redirect('admin/clientuser'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('clientUser_not_delete_successfully'));
                redirect('admin/clientuser');  
            }
        }

        else{
             
           $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            redirect('admin/clientuser'); 
            
        }
    }

    public function clientuser_view()
    {
        $data['title'] = 'View Client User';

        $client_user_id = $this->uri->segment(3);
        $data['getclientUserData'] = $this->CommonModel->getClientUserDetail($client_user_id);

        $this->loadAdminView('admin/clientuser/view_clientuser',$data); 
    }   

    public function clientuser_edit()
    {
        $data['title'] = 'Edit Client User';

        $client_user_id = $this->uri->segment(3);
        $data['getclientUserData'] = $this->CommonModel->getClientUserDetail($client_user_id);

         $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');


        $this->loadAdminView('admin/clientuser/edit_clientuser',$data); 
        
    }

    public function clientuser_update()
    {
        // print_r($_POST);die;
        $condition = array(
            "id" => $this->input->post('id')
        );

        $data = array(

                    "client_id"           =>  $this->input->post('client_id'),
                    "username"            =>  $this->input->post('username'),
                    "email"               =>  $this->input->post('email'),
                    "mobile_number"       =>  $this->input->post('mobile_number'),
                    "login_username"      =>  $this->input->post('login_username'),
                    "login_password"      =>  $this->input->post('login_password'),
                    "created_at"          =>  date('Y-m-d H:i:s a'),
                    "updated_at"          =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'client_user',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success','Client User Detail Updated Successfully');
            // redirect('admin/clientuser_edit/'.$this->input->post('id'));
            redirect('admin/clientuser');  
        }else{
            $this->session->set_flashdata('error','Client User Detail not Updated Successfully ');
            redirect('admin/clientuser_edit/'.$this->input->post('id')); 
            
        }
    }

    /*public function getClientUserData()
    {
        $client_id = $this->input->post('client_id');

        $clientuserData = $this->CommonModel->getClientUserByClient($client_id);
        // print_r($clientuserData);die;

        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";

                    if( $clientuserData[$i]['status'] == 1)
                    {
                        $status = '<button title="'. $this->lang->line('change_staus').'" class="btn-success btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="changeStatus("'.$clientuserData[$i]['client_user_id'].'","Deactive")">'.$this->lang->line('active').'</button>';

                    }else{

                       $status = '<button title="'. $this->lang->line('change_staus').'" class="btn-success btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="changeStatus("'.$clientuserData[$i]['client_user_id'].'","Deactive")">'.$this->lang->line('deactive').'</button>';
                    }

                    $viewUrl = base_url('admin/clientuser_view/'.$clientuserData[$i]['client_user_id']);
                    $view = '<a class="text-warning mr-3" href="'. $viewUrl.'">View</a>';


                    $editUrl = base_url('admin/clientuser_edit/'.$clientuserData[$i]['client_user_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';



                    $deleteUrl = base_url('admin/clientuser_delete/'.$clientuserData[$i]['client_user_id']);
                    $delete = '<a onclick="return deleteclientUser()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    $action = $view.'<br>'.$edit.'<br>'.$delete;

                    // print_r($action);die;

                    $arr[] = array(
                        $k,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['username'],
                        $clientuserData[$i]['email'],
                        $clientuserData[$i]['mobile_number'],
                        $clientuserData[$i]['login_username'],
                        $clientuserData[$i]['login_password'],
                        $clientuserData[$i]['last_login_date'],
                        // $clientuserData[$i]['status'],
                        $status,
                        $action,
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
    }*/


     public function getClientUserData()
    {
        // $client_id = $this->input->post('client_id');
        // $clientuserData = $this->CommonModel->getClientUserByClient($client_id);
        
        $client_name = $this->input->post('client_name');
        $getClientId = $this->CommonModel->getClientName($client_name);
        
        $comma_string = array();
        foreach ($getClientId as $k)
        {
            $comma_string[] = $k['id'];
        }
        $client_id = implode(",", $comma_string);
        $clientuserData = $this->CommonModel->getClientUserByClient($client_id);
        
        // print_r($clientuserData);die;
        if (!empty($clientuserData))
        {
            $k = 0;
            for ($i=0; $i < count($clientuserData); $i++) 
            { 
                $k = $k+1;
                // $k = "";
                    $checkBox = '<input id="'.$clientuserData[$i]['client_user_id'].'" type="checkbox" value="'.$clientuserData[$i]['client_user_id'].'" name="clientuser_id[]" class="form-control-custom"  data-id ="'.$clientuserData[$i]['client_user_id'].'" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                      <label for="'.$clientuserData[$i]['client_user_id'].'"></label><br>
                      <span id="errmsg" style="color: red;"></span>';

                    if( $clientuserData[$i]['status'] == 1)
                    {
                        $value = "change_status('".$clientuserData[$i]['client_user_id']."','Deactive')";
                        $status = '<button title="'.$this->lang->line('change_staus').'" type="button" id="button" class="btn-info btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="'.$value.'">'.$this->lang->line('active').'</button>';

                    }else{
                       $value = "change_status('".$clientuserData[$i]['client_user_id']."','Active')";
                        $status = '<button title="'.$this->lang->line('change_staus').'" type="button" id="button" class="btn-info btn btn-sm" value="'.$clientuserData[$i]['client_user_id'].'" onclick="'.$value.'">'.$this->lang->line('deactive').'</button>';
                    }


                    $viewUrl = base_url('admin/clientuser_view/'.$clientuserData[$i]['client_user_id']);
                    $view = '<a class="text-warning mr-3" href="'. $viewUrl.'">View</a>';


                    $editUrl = base_url('admin/clientuser_edit/'.$clientuserData[$i]['client_user_id']);
                    $edit = '<a class="text-warning mr-3" href="'. $editUrl.'">Edit</a>';



                    $deleteUrl = base_url('admin/clientuser_delete/'.$clientuserData[$i]['client_user_id']);
                    $delete = '<a onclick="return deleteclientUser()" class="text-warning mr-3" href="'. $deleteUrl.'">Delete</a>';
                    // print_r($view);die;

                    $action = $view.'<br>'.$edit.'<br>'.$delete;

                    // print_r($action);die;

                    $arr[] = array(
                        // $k,
                        $checkBox,
                        $clientuserData[$i]['client_name'],
                        $clientuserData[$i]['username'],
                        $clientuserData[$i]['email'],
                        $clientuserData[$i]['mobile_number'],
                        $clientuserData[$i]['login_username'],
                        $clientuserData[$i]['login_password'],
                        $clientuserData[$i]['last_login_date'],
                        // $clientuserData[$i]['status'],
                        // $status,
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

    public function import_clientUser()
    {
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $client_name        =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $clientFocalNumber  =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $clientFocalEmail   =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $client_user_name   =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $client_user_email  =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $client_mobile      =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $login_username     =   $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $login_password     =   $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                //  $where = array('focal_point_email'=>$clientFocalEmail);
                $where = "(focal_point_email='".$clientFocalEmail."' or focal_point_number=".$clientFocalNumber.")";
                 
                $clientDetail = $this->CommonModel->getsingle('client',$where);
                
                if($clientDetail){
                    $client_id = $clientDetail->id;
                }else{
                    $data = array(
                        "client_name"           =>  $client_name,
                        "focal_point_email"     =>  $clientFocalEmail,
                        "focal_point_number"     =>  $clientFocalNumber,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

                    $busInsert = $this->CommonModel->insertData($data,'client'); 

                    $client_id = $this->db->insert_id();
                }      

                // $where = array(
                //     //'login_username'=>$login_username
                //     // 'mobile_number'=>$client_mobile,
                //     "mobile_number"       =>  $client_mobile,
                //     "client_id" => $client_id
                // );
                
                $where = "(email='".$client_user_email."' or mobile_number=".$client_mobile." AND client_id =".$client_id.")";
                $clientUserDetail = $this->CommonModel->getsingle('client_user',$where);

                if(!empty($clientUserDetail))
                {
                    
                    // $condition = array('id'=>$clientDetail->id);

                    // $data = array(
                    //     "client_id"           =>  $client_id,
                    //     "username"            =>  $client_user_name,
                    //     "email"               =>  $client_user_email,
                    //     "mobile_number"       =>  $client_mobile,
                    //     "login_username"      =>  $login_username,
                    //     "login_password"      =>  $login_password,
                    //     "updated_at"            =>  date('Y-m-d H:i:s a'),
                    // );

                    // $set = $this->CommonModel->updateRowByCondition($condition,'client_user',$data); 
                     $clientIdString[] = $client_id;
                    $clientId = implode(",", $clientIdString);

                    $clientUserNameString[] = $client_user_name;
                    $clientUserName = implode(",", $clientUserNameString);

                    $clientUserEmailString[] = $client_user_email;
                    $clientUserEmail = implode(",", $clientUserEmailString);
                    
                    $clientMobileString[] = $client_mobile;
                    $clientMobile = implode(",", $clientMobileString);
                    
                    $loginUsernameString[] = $login_username;
                    $loginUserame = implode(",", $loginUsernameString);
                    
                    $loginPasswordString[] = $login_password;
                    $loginPassword = implode(",", $loginPasswordString);

                    $comma_string[] = $clientUserDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;

                }else{
                    $data = array(
                        "client_id"           =>  $client_id,
                        "username"            =>  $client_user_name,
                        "email"               =>  $client_user_email,
                        "mobile_number"       =>  $client_mobile,
                        "login_username"      =>  $login_username,
                        "login_password"      =>  $login_password,
                        "created_at"          =>  date('Y-m-d H:i:s a'),
                        "updated_at"          =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $set = $this->CommonModel->insertData($data,'client_user');  
                }
            }
            if($set)
            {
                // echo "1";
                 if (!empty($arr)) 
                {
                    $id = $arr;
                    $countClientUser = $this->CommonModel->countDuplicateClientUser($id);
                    // print_r($countBus->busTotal);die;
    
    
                    $data = array(
                        'count'             =>  $countClientUser->clientUserTotal,
                        'id'                =>  $arr,
                        'clientId'          =>  $clientId,
                        'clientUserName'    =>  $clientUserName,
                        'clientUserEmail'   =>  $clientUserEmail,
                        'clientMobile'      =>  $clientMobile,
                        'loginUserame'      =>  $loginUserame,
                        'loginPassword'     =>  $loginPassword,
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
    
    
     public function import_clientUserOld()
    {
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;
        foreach($file_data as $row)
        {   
            // print_r($row['Mobile Number']);die;
            $client_name        =   $row["Client Name"];
            $client_user_name   =   $row["User Name"];
            $client_user_email  =   $row["Email Id"];
            $client_mobile      =   $row["Mobile Number"];
            $login_username     =   $row["Login User Name"];
            $login_password     =   $row["Login Password"];
// print_r($client_mobile);die;
            $where = array('client_name'=>$client_name);
            $clientDetail = $this->CommonModel->getsingle('client',$where);
            
            if($clientDetail){
                $client_id = $clientDetail->id;
            }else{
                $data = array(
                    "client_name"           =>  $client_name,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $busInsert = $this->CommonModel->insertData($data,'client'); 

                $client_id = $this->db->insert_id();
            }      

            $where = array('login_username'=>$login_username);
            $clientUserDetail = $this->CommonModel->getsingle('client_user',$where);

            if(!empty($clientUserDetail))
            {
                    $clientIdString[] = $client_id;
                    $clientId = implode(",", $clientIdString);

                    $clientUserNameString[] = $client_user_name;
                    $clientUserName = implode(",", $clientUserNameString);

                    $clientUserEmailString[] = $client_user_email;
                    $clientUserEmail = implode(",", $clientUserEmailString);
                    
                    $clientMobileString[] = $client_mobile;
                    $clientMobile = implode(",", $clientMobileString);
                    
                    $loginUserameString[] = $login_username;
                    $loginUserame = implode(",", $loginUserameString);
                    
                    $loginPasswordString[] = $login_password;
                    $loginPassword = implode(",", $loginPasswordString);

                    $comma_string[] = $clientUserDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;
                
                // $condition = array('id'=>$clientDetail->id);

                // $data = array(
                //     "client_id"           =>  $client_id,
                //     "username"            =>  $client_user_name,
                //     "email"               =>  $client_user_email,
                //     "mobile_number"       =>  $client_mobile,
                //     "login_username"      =>  $login_username,
                //     "login_password"      =>  $login_password,
                //     "updated_at"          =>  date('Y-m-d H:i:s a'),
                // );

                // $set = $this->CommonModel->updateRowByCondition($condition,'client_user',$data);  

            }else{
                $data = array(
                    "client_id"           =>  $client_id,
                    "username"            =>  $client_user_name,
                    "email"               =>  $client_user_email,
                    "mobile_number"       =>  $client_mobile,
                    "login_username"      =>  $login_username,
                    "login_password"      =>  $login_password,
                    "created_at"          =>  date('Y-m-d H:i:s a'),
                    "updated_at"          =>  date('Y-m-d H:i:s a'),
                );
              
                $set = $this->CommonModel->insertData($data,'client_user');  
            }
        }
        // die;
        if($set)
        {
            //echo "1";
            if (!empty($arr)) 
            {
                $id = $arr;
                $countClientUser = $this->CommonModel->countDuplicateClientUser($id);
                // print_r($countBus->busTotal);die;


                $data = array(
                    'count'             =>  $countClientUser->clientUserTotal,
                    'id'                =>  $arr,
                    'clientId'          =>  $clientId,
                    'clientUserName'    =>  $clientUserName,
                    'clientUserEmail'   =>  $clientUserEmail,
                    'clientMobile'      =>  $clientMobile,
                    'loginUserame'      =>  $loginUserame,
                    'loginPassword'     =>  $loginPassword,
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
    
    public function replaceDeuplicateData()
    {
        // print_r($_POST);
        
        $id = explode(',',($this->input->post('id'))); 
        $clientId = explode(',',($this->input->post('clientId'))); 
        $clientUserName = explode(',',($this->input->post('clientUserName'))); 
        $clientUserEmail = explode(',',($this->input->post('clientUserEmail'))); 
        $clientMobile = explode(',',($this->input->post('clientMobile'))); 
        $loginUserame = explode(',',($this->input->post('loginUserame'))); 
        $loginPassword = explode(',',($this->input->post('loginPassword'))); 

        // print_r($busNumber);

        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'client_user'); 
        }
        
        for ($i=0; $i < count($clientUserName); $i++) 
        { 

            $data = array(
                     "client_id"           =>  $clientId[$i],
                        "username"            =>  $clientUserName[$i],
                        "email"               =>  $clientUserEmail[$i],
                        "mobile_number"       =>  $clientMobile[$i],
                        "login_username"      =>  $loginUserame[$i],
                        "login_password"      =>  $loginPassword[$i],
                        "created_at"          =>  date('Y-m-d H:i:s a'),
                        "updated_at"          =>  date('Y-m-d H:i:s a'),
                );
           

            $set = $this->CommonModel->insertData($data,'client_user');
        }

        if ($set) 
        {
            $this->session->set_flashdata('success','Client User Detail Updated Successfully');
            // redirect('admin/clientuser_edit/'.$this->input->post('id'));
            redirect('admin/clientuser');  
        }else{
            $this->session->set_flashdata('error','Client User Detail not Updated Successfully ');
            redirect('admin/clientuser_edit/'.$this->input->post('id')); 
            
        }
    }
    
     public function excelClientUserList()
    {
        // print_r($_POST);die;
        // $fileName = 'clientUser-'.time().'.xlsx';  
        $fileName = 'clientUser-'.time().'.xls';  

        // $ids = $this->input->post('cliendId');
        $ids = $this->input->post('cliendUserId');

        // $this->load->library('excel');

        $empInfo = $this->PdfModel->getClientUserExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        //  $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1',  $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1',  $this->lang->line('client_user_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1',  $this->lang->line('client_email_id'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1',  $this->lang->line('client_mobile_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1',  $this->lang->line('login_user_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F1',  $this->lang->line('login_password'));       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1',  $this->lang->line('last_login_date'));       
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1',  $this->lang->line('status'));       
        // set Row
        $rowCount = 2;
        $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['username']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['mobile_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['login_username']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['login_password']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['last_login_date']);
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

    public function pdfClientUserList()
    {
        $fileName = 'clientUser-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('cliendId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('clients').'</h3>';
        $html_content .= $this->PdfModel->getClientUserPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
    }
    
    public function editClientUser()
    {
        // print_r($_POST);die;
        $ids = $this->input->post('cliendUserId');
        // print_r($ids);die;

        redirect('admin/clientuser_edit/'.$ids);
    }

     public function import_clientUser_view()
    {
        $data['title'] = $this->lang->line('import_client_user');
        // echo "string"; die;
        $this->loadAdminView('admin/clientuser/import_view',$data); 
    }

    public function donwload_client_user_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "clients_portal_user.csv";
        // $fileName = "clients_portal_user.xlsx";
        $fileName = "clients_portal_user.xls";
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
