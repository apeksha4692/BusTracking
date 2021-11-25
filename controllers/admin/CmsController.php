<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        
	}

    public function about_us()
    {
        $aboutData['title'] = 'About Us';
        $condition = array(
            "id" => 2
        );

        $aboutData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        $this->loadAdminView('admin/cms/page',$aboutData); 
    }

    public function privacy_policy()
    {
        $privacyData['title'] = 'Privacy Policy';

        $condition = array(
            "id" => 3
        );

        $privacyData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
        $this->loadAdminView('admin/cms/page',$privacyData); 
    }

    public function terms_condition()
    {
        $termData['title'] = 'Terms and Condition';
        $condition = array(
            "id" => 1
        );

        $termData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
         $this->loadAdminView('admin/cms/page',$termData); 

    }

    public function disclaimer()
    {
        $disclaimerData['title'] = 'Disclaimer';
        $condition = array(
            "id" => 4
        );

        $disclaimerData['data'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
         $this->loadAdminView('admin/cms/page',$disclaimerData); 

    }

    public function update_cms()
    {
        $title = $this->input->post('title');

        $data = array(
            "description" => $this->input->post('description')
        );

        $condition = array(
            "id" => $this->input->post('id')
        );
        $updateData = $this->CommonModel->updateRowByCondition($condition,'cms',$data); 

        if ($updateData) 
        {
            if($title == 'Terms and Condition')
            {
                $this->session->set_flashdata('success','Terms and Condition Updated Successfully');
                redirect('admin/cms/terms_condition');
            }else if($title == 'About Us'){
                 $this->session->set_flashdata('success','About Us Updated Successfully');
                redirect('admin/cms/about_us');
            }else if($title == 'Privacy Policy'){
                 $this->session->set_flashdata('success','Privacy Policy Condition Updated Successfully');
                redirect('admin/cms/privacy_policy');    
            }else if($title == 'Disclaimer'){
                 $this->session->set_flashdata('success','Disclaimer Updated Successfully');
                redirect('admin/cms/disclaimer'); 
            }

           
        }else{
            if($title == 'Terms and Condition')
            {
                $this->session->set_flashdata('error','Terms and Condition not Updated Successfully');
                redirect('admin/cms/terms_condition');
            }else if($title == 'About Us'){
                 $this->session->set_flashdata('error','About Us not Updated Successfully');
                redirect('admin/cms/about_us');
            }else if($title == 'Privacy Policy'){
                 $this->session->set_flashdata('error','Privacy Policy Condition not Updated Successfully');
                redirect('admin/cms/privacy_policy');    
            }else if($title == 'Disclaimer'){
                 $this->session->set_flashdata('error','Disclaimer not Updated Successfully');
                redirect('admin/cms/disclaimer'); 
            }
        }
        
    }
    
    public function contactUs_list()
    {
        $data['title'] = "Contact Information";

        $where = array(
            'id'    =>  1
        );

        $data['contactData'] = $this->CommonModel->getsingle('contact_information',$where);

        $this->loadAdminView('admin/cms/contactus',$data); 
    }

    public function update_contact()
    {

        $where = array(
            'id'    =>  1
        );

        $data = array(
            "email_id"          => $this->input->post('email_id'),
            "address"           => $this->input->post('address'),
            "mobile_number"     => $this->input->post('mobile_number'),
            "whatsapp_number"   => $this->input->post('whatsapp_number'),
            "facebook"          => $this->input->post('facebook'),
            "twitter"           => $this->input->post('twitter'),
            "instagram"         => $this->input->post('instagram'),
            "linkedin"          => $this->input->post('linkedin'),
        );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'contact_information',$data); 

        if($updateData){
             $this->session->set_flashdata('success','Information Updated Successfully');
                redirect('admin/cms/contact_us'); 
        }else{
             $this->session->set_flashdata('error','Information not Updated Successfully');
                redirect('admin/cms/contact_us'); 
        }
    }
}
