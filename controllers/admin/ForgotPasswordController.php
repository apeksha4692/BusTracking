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

        $this->load->view('admin/forgot_password');
    }

    public function send_reset_mail()
    {
        // echo "string";die;
        $condition = array(
                'email' => $this->input->post('email')
        );
        $adminDetail = $this->CommonModel->selectRowDataByCondition($condition,'admin');

         // print_r($adminDetail);die;
         if(empty($adminDetail))
         {
            $this->session->set_flashdata('error',$this->lang->line('your_not_registered_with_us'));
            redirect('admin/forgot_password');

         }else
         {
            // echo "string";die;
            $view = $this->load->view('admin/email_templates/forget_password',$adminDetail,TRUE );
// print_r($subAdminDetail);die;
            $this->email->from('info@wasalo.com', $this->lang->line('wasalo'))
                    ->to($adminDetail->email)    
                    ->subject($this->lang->line('forgot_password_mail'))    
                    ->message($view)
                    ->set_mailtype('html');
            // send email
            $sent = $this->email->send();

            if ($sent) {
                // echo "d";die;
                $this->session->set_flashdata('success',$this->lang->line('password_reset_link_send_email'));
                redirect('admin/login'); 
            }else{
                // echo "fdf";die;
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('admin/forgot_password');
            }       

         }
    }
    
}
