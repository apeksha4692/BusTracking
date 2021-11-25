<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        // $this->load->library('csvimport');
	}

    public function contact_list()
    {
        $data['title'] = "Contact List";
        $data['contact_list'] = $this->CommonModel->selectResultData('contact_us_list','contact_us_list.id'); 
        
        // print_r($data['contact']);die;
        $this->loadAdminView('admin/client_portal_content/contact_list',$data); 
    }
    
    public function delete_contact_list()
    {
        // print_r($_POST);
        
        $val = explode(',',($this->input->post('contact_id')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $updateData = $this->CommonModel->delete($where,'contact_us_list');
        }

        if($updateData)
        {
            $this->session->set_flashdata('success','You delete contact list successfully');
            redirect('admin/client_portal_content/contact');
        }else{
            $this->session->set_flashdata('error','Somethings went wrong');
           redirect('admin/client_portal_content/contact');
        }
    }
    
    public function contact_information()
    {
        // echo "hi";
        $data['title'] = 'Contact Informtaion';

        $where = array('id'=>1);

        $data['contactInformation'] = $this->CommonModel->selectRowDataByCondition($where,'contact_information');

        $this->loadAdminView('admin/client_portal_content/contact_information',$data); 
    }
    
    public function update_contact_information()
    {
        // print_r($_POST);
        $condition = array(
            "id" => $this->input->post('id')
        );
        
        $data = array(
                "name"              =>  $this->input->post('name'),
                "ar_name"           =>  $this->input->post('ar_name'),
                "ar_address"        =>  $this->input->post('ar_address'),
                "mobile_number"     =>  $this->input->post('mobile_number'),
                "email_id"          =>  $this->input->post('email_id'),
                "ar_email_id"       =>  $this->input->post('ar_email_id'),
                "website"           =>  $this->input->post('website'),
                "forwardingmail_one"           =>  $this->input->post('forwardingmail_one'),
                "forwardingmail_two"           =>  $this->input->post('forwardingmail_two'),
                "created_at"        =>  date('Y-m-d H:i:s a'),
                "updated_at"        =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'contact_information',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success','Contact Information updated successfully');
            redirect('admin/client_portal_content/contact_information');
        }else{
            $this->session->set_flashdata('error','Contact Information not updated successfully ');
            redirect('admin/client_portal_content/contact_information');
            
        }
    }
}