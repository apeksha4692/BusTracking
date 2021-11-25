<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		//$token = $this->input->get_request_header('token', TRUE);	
		//$this->user = $this->_userLoginCheck( $token );
	}

	public function subadmin_reset_verify()
    {
        // echo "string";die;

    	$id = $this->input->get('token');
        
    	$condition = array(
            // "email_id"      => $email_id,
			"id"  	=> $id,
		);	
		$clientUserDetail = $this->CommonModel->selectRowDataByCondition($condition,'client_user');
// print_r($clientUserDetail);die;

        if(empty($clientUserDetail))
        {	          
             $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
               redirect('subadmin/login'); 
        }
        else
        {
        	// $fullname = $userDetail->first_name.''.$userDetail->last_name;
            $email_id = $clientUserDetail->email;
        	$client_user_id  = $clientUserDetail->id;
            $username  = $clientUserDetail->username;
        	// print_r($id);die;
            $this->load->view('subadmin/email_templates/reset_password',
            	array(
                    'email_id'          =>  $email_id,
            		'client_user_id'	=>	$client_user_id,
	            	'username'		    =>	$username
	            ));
		}
	} 

	public function verify_subamdinresetpassword()
	{
        // echo "string";die;
        $condition  = array("id" => $this->input->get('id'));

        // print_r($_POST);die;

        $newPassword        = $this->input->post('new_password');
        $confirmPassword    = $this->input->post('confirm_password');

        $data = array(
                'login_password'      => $newPassword,
            );
         $updateData = $this->CommonModel->update_entry('client_user',$data,$condition);

         if($updateData)
         {

            // $clientUserDetail = $this->CommonModel->selectRowDataByCondition($condition,'client_user');;
            // $this->session->set_flashdata('success','Password reset Successfully');
            // $this->load->view('email_templates/thankyou',array(
            //     // 'name'  =>  $fullname
            //     'name'  =>  $clientUserDetail->username
            // ));

            $this->session->set_flashdata('success',$this->lang->line('password_reset_successfully'));
            redirect('subadmin/login');
         }else{
             $this->session->set_flashdata('error', 'Password not reset');
            $this->load->view('subadmin/forgot_password');
         }
        

   //      if ($newPassword == $confirmPassword) 
   //      {
   //          $data       = array(
			// 	"password" => $this->input->post('npwd')
			// );

   //          $updateData = $this->CommonModel->updateRowByCondition($condition,'user',$data);

   //          if($updateData) 
   //          { 
   //          	$userDetail = $this->CommonModel->selectRowDataByCondition($condition,'user');
   //          	// print_r($userDetail);die;
   //          	// $fullname = $userDetail->first_name.''.$userDetail->last_name;

   //              $this->session->set_flashdata('success','Password reset Successfully');
   //              $this->load->view('email_templates/thankyou',array(
   //                  // 'name'  =>  $fullname
	  //           	'name'  =>  $userDetail->full_name
	  //           ));
   //          }
   //          else
   //          {
   //              $this->session->set_flashdata('error', 'Password not reset');
   //              $this->load->view('email_templates/forget_password');
   //          }
   //      }
   //      else 
   //      { 
   //          $this->session->set_flashdata('error', 'Your new Password and confirm Password not match!');
   //          redirect('Auth/forget?id='.base64_encode($this->input->post('email')));
   //      } 
		
	} 

    public function admin_reset_verify()
    {
        // echo "string";die;

      $id = $this->input->get('token');
        
      $condition = array(
            // "email_id"      => $email_id,
      "id"    => $id,
    );  
    $adminDetail = $this->CommonModel->selectRowDataByCondition($condition,'admin');
// print_r($clientUserDetail);die;

        if(empty($adminDetail))
        {           
             $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
               redirect('admin/login'); 
        }
        else
        {
          // $fullname = $userDetail->first_name.''.$userDetail->last_name;
            $email_id = $adminDetail->email;
          $client_user_id  = $adminDetail->id;
            $username  = $adminDetail->username;
          // print_r($id);die;
            $this->load->view('admin/email_templates/reset_password',
              array(
                    'email_id'          =>  $email_id,
                'client_user_id'  =>  $client_user_id,
                'username'        =>  $username
              ));
    }
  } 


    public function verify_amdinresetpassword()
  {
        // echo "string";die;
        $condition  = array("id" => $this->input->get('id'));

        // print_r($_POST);die;

        $newPassword        = $this->input->post('new_password');
        $confirmPassword    = $this->input->post('confirm_password');

        $data = array(
                'password'          => md5($newPassword),
                'orginal_password'  => $newPassword,
            );

        // print_r($data);die;
         $updateData = $this->CommonModel->update_entry('admin',$data,$condition);

         if($updateData)
         {
            $this->session->set_flashdata('success',$this->lang->line('password_reset_successfully'));
            redirect('admin/login');
         }else{
             $this->session->set_flashdata('error', 'Password not reset');
            $this->load->view('admin/forgot_password');
         }
  } 
      
}   
           
