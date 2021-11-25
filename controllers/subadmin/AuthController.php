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
		$this->load->view('subadmin/login');
	}


	public function check_loginOld()
    {
        $login_username      = 	    $this->input->post('login_username');
        $login_password      = 	    $this->input->post('login_password');

        $data = array(
            'login_username' => $login_username,
            'login_password' => $login_password
        );
        //print_r($adminData);die();
        $subadminData = $this->CommonModel->subadminData($data);
        // print_r($subadminData);die();

        if(!empty($subadminData))
        {
            if($subadminData->status == 0)
            {
                echo "stringdsd";die;
                $this->session->set_flashdata('error',$this->lang->line('deactive_by_admin'));
                redirect('subadmin/login');
            }elseif($subadminData->is_delete == 1){
                echo "sdd";die;
                $this->session->set_flashdata('error',$this->lang->line('deleted_by_admin'));
                redirect('subadmin/login');
            }
            else
            {
                $data = array(
                    'last_login_date'            =>  date('Y-m-d H:i:s')
                );
                $where = array('id' => $subadminData->id);
                $updateSubadminDetail = $this->CommonModel->update_entry('client_user',$data,$where);

                if($updateSubadminDetail){ 
                    $this->session->set_flashdata('success',$this->lang->line('login_successfully'));
                    $this->session->set_userdata('ses_subadmin_id',$subadminData->id);
                    // redirect('subadmin/dashboard');
                    redirect('subadmin/bus');
                }else{
                    $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                    redirect('subadmin/login');
                }
            }
        }
        else
        {
            $this->session->set_flashdata('error',$this->lang->line('you_not_valid_user'));
            redirect('subadmin/login');
        }   

	}
	
	public function check_login()
    {
        // print_r($_POST);

        $login_username   =   $this->input->post("login_username");
        $login_password   =   $this->input->post("login_password");
        $chkremember      =   $this->input->post("chkremember");

        $data = array(
            'login_username' => $login_username,
            'login_password' => $login_password
        );
        //print_r($adminData);die();
        $subadminData = $this->CommonModel->subadminData($data);
        // print_r($subadminData);die();

        if(!empty($subadminData))
        {
            if($subadminData->status == 0)
            {
                echo "stringdsd";die;
                $this->session->set_flashdata('error',$this->lang->line('deactive_by_admin'));
                redirect('subadmin/login');
            }elseif($subadminData->is_delete == 1){
                echo "sdd";die;
                $this->session->set_flashdata('error',$this->lang->line('deleted_by_admin'));
                redirect('subadmin/login');
            }
            else
            {

                if ($chkremember) 
                {
                   $this->input->set_cookie('login_username', $login_username, 86500); /* Create cookie for store emailid */
                    $this->input->set_cookie('login_password', $login_password, 86500); /* Create cookie for password */

                }else{
                    delete_cookie('login_username'); /* Delete email cookie */
                    delete_cookie('login_password'); /* Delete password cookie */
                }

                $data = array(
                    'last_login_date'            =>  date('Y-m-d H:i:s')
                );
                $where = array('id' => $subadminData->id);
                $updateSubadminDetail = $this->CommonModel->update_entry('client_user',$data,$where);

                if($updateSubadminDetail){ 
                    $this->session->set_flashdata('success',$this->lang->line('login_successfully'));
                    $this->session->set_userdata('ses_subadmin_id',$subadminData->id);
                    // redirect('subadmin/dashboard');
                    redirect('subadmin/bus');
                }else{
                    $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                    redirect('subadmin/login');
                }
            }
        }
        else
        {
            $this->session->set_flashdata('error',$this->lang->line('you_not_valid_user'));
            redirect('subadmin/login');
        }   

    }
}
