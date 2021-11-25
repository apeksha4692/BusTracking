<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->library('session');
    	$this->load->helper('cookie');
		// $this->load->model('CommonModel');
	}
	public function login_view()
	{
        // echo "string";die;
		$this->load->view('admin/login');
	}

	public function check_loginOld()
    {
    	// print_r($_POST);die;
       
        // $email      = 	$this->input->post('email');
        $username      =   $this->input->post('username');
        $password   = 	$this->input->post('password');

        $data = array(
            // 'email' => $email,
            'username' => $username,
            'password' => $password
        );
        //print_r($adminData);die();
        $adminData = $this->CommonModel->adminData($data);
       

        if(!empty($adminData))
        {
            // print_r($adminData->id);die;
            $this->session->set_flashdata('success',$this->lang->line('login_successfully'));
            $this->session->set_userdata('ses_admin_id',$adminData->id);
            // redirect('admin/dashboard');
            redirect('admin/client');
        }
        else
        {
            $this->session->set_flashdata('error',$this->lang->line('you_not_valid_user'));
            redirect('admin/login');
        }   
	}
	
	public function check_login()
    {
        // print_r($_POST);die;
       
        // $email      =    $this->input->post('email');
        $username      =   $this->input->post('username');
        $password   =   $this->input->post('password');
        $chkremember      =   $this->input->post("chkremember");

        $data = array(
            // 'email' => $email,
            'username' => $username,
            'password' => $password
        );
        //print_r($adminData);die();
        $adminData = $this->CommonModel->adminData($data);
        // print_r($adminData);die();

        if(!empty($adminData))
        {
            
            if ($chkremember) 
            {
               $this->input->set_cookie('username', $username, 86500); /* Create cookie for store emailid */
                $this->input->set_cookie('password', $password, 86500); /* Create cookie for password */

            }else{
                delete_cookie('username'); /* Delete email cookie */
                delete_cookie('password'); /* Delete password cookie */
            }
            
            $data = array(
                    'last_login'=>  date('Y-m-d H:i:s')
                );
            $where = array('id' => $adminData->id);
            $updateadminDetail = $this->CommonModel->update_entry('admin',$data,$where);
            if($updateadminDetail){
                $this->session->set_flashdata('success',$this->lang->line('login_successfully'));
                $this->session->set_userdata('ses_admin_id',$adminData->id);
                redirect('admin/client');
            }else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
               redirect('admin/client');
            }
        }
        else
        {
            $this->session->set_flashdata('error',$this->lang->line('you_not_valid_user'));
            redirect('admin/login');
        }   

    }
}
