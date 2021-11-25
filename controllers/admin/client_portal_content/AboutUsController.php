<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUsController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        // $this->load->library('csvimport');
	}

    public function aboutUs_view()
    {
        $condition = array(
            "id" => 1
        );

        $data['about_us'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        // print_r($data['about_us']);die;
        $this->loadAdminView('admin/client_portal_content/about_us',$data); 
    }
    
     public function update_about()
    {
        // print_r($_POST);die;
        
        
        $data = array(
            "title" => $this->input->post('title'),
            "description" => $this->input->post('description'),
            "ar_title" => $this->input->post('ar_title'),
            "ar_description" => $this->input->post('ar_description'),
        );

        $condition = array(
            "id" => $this->input->post('id')
        );
        $updateData = $this->CommonModel->updateRowByCondition($condition,'cms',$data); 
        
        if($updateData){
             $this->session->set_flashdata('success','About updated Successfully');
                redirect('admin/client_portal_content/about_us'); 
        }else{
             $this->session->set_flashdata('error','About not updated successfully');
                redirect('admin/client_portal_content/about_us');
            
        }
    }
    
}
