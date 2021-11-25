<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPasswordController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->library('session');
		// $this->load->model('CommonModel');
	}

    public function forgot_password()
    {

        $this->load->view('subadmin/forgot_password');
    }

    public function send_reset_mail()
    {
        $condition = array(
                'email' => $this->input->post('email')
        );
        $subAdminDetail = $this->CommonModel->selectRowDataByCondition($condition,'client_user');

         // print_r($subAdminDetail);

         if(empty($subAdminDetail))
         {
            $this->session->set_flashdata('error',$this->lang->line('your_not_registered_with_us'));
            redirect('subadmin/forgot_password');

         }else
         {
            // echo "string";
            $view = $this->load->view('subadmin/email_templates/forget_password',$subAdminDetail,TRUE );
// print_r($subAdminDetail);die;
            $this->email->from('info@wasalo.com', $this->lang->line('wasalo'))
                    ->to($subAdminDetail->email)    
                    ->subject($this->lang->line('forgot_password_mail'))    
                    ->message($view)
                    ->set_mailtype('html');
            // send email
            $sent = $this->email->send();

            if ($sent) {
                $this->session->set_flashdata('success',$this->lang->line('password_reset_link_send_email'));
                redirect('subadmin/login'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/forgot_password');
            }       

         }
    }
    
}
