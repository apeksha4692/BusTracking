<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CmsController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
         // $this->common->check_subadminlogin();
        
	}

    public function about_us()
    {
        // echo "HI";die;
        $data['title'] = $this->lang->line('about_us');

         $condition = array(
                'id' => 1
        );
        $data['aboutDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');

        $this->loadSubAdminView('subadmin/cms/about_us',$data);
        // $this->load->view('subadmin/cms/about_us',$data);
    }

    public function how_to()
    {

        $data['title'] = $this->lang->line('how_to');

        $condition = array(
                'id' => 2
        );
        $data['howToDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'cms');
        // $howToDetail = $this->CommonModel->selectRowDataByCondition($condition,'cms');

        $where = array(
            "image_status"   =>  1,
            "how_to_id"      =>  2
        );

        $data['getHowToImg'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'how_to_img','how_to_img.id');

// print_r($data['howToDetail']);die;

        // $this->session->set_flashdata('error',"Comming Soon");
        // redirect('subadmin/bus'); 
        $this->loadSubAdminView('subadmin/cms/how_to',$data);
    }

    public function contactUs()
    {
        $data['title'] = $this->lang->line('contact_us');

        $condition = array(
                'id' => 1
        );
        $data['contactInformation'] = $this->CommonModel->selectRowDataByCondition($condition,'contact_information');

        $this->loadSubAdminView('subadmin/cms/contact',$data);
    }


    public function send_contact()
    {

        $name = $this->input->post('first_name').' '.$this->input->post('last_name');

        $data = array(
                    "name"          =>  $name,
                    "email"         =>  $this->input->post('email'),
                    "topic"         =>  $this->input->post('topic'),
                    "message"       =>  $this->input->post('message'),
                    "created_at"    =>  date('Y-m-d H:i:s a'),
                    "updated_at"    =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'contact_us_list');  

        if ($insertData) 
        {
            // $contactUser_id = $this->db->insert_id();
            
            // $condition = array(
            //         'id' => $contactUser_id
            // );
            // $contactUserDetail = $this->CommonModel->selectRowDataByCondition($condition,'contact_us_list');
            
            // $view = $this->load->view('email_templates/user_msg',$contactUserDetail,TRUE );
            
            // // print_r($view);die;
            
            // $condition = array(
            //         'id' => $contactUser_id
            // );
            // $contactInfoDetail = $this->CommonModel->selectRowDataByCondition($condition,'contact_information');
            
            // $this->email->from('info@wasalo.com', $this->lang->line('wasalo'))
            //         ->to($contactUserDetail->email)    
            //         ->subject('Enquiry User')    
            //         ->message($view)
            //         ->set_mailtype('html');
            // // send email
            // $sent = $this->email->send();
            
            // print_r($sent);die;
            
            $this->session->set_flashdata('success',$this->lang->line('contact_send_successfully'));
            redirect('subadmin/contactUs'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('contact_not_send_successfully'));
             redirect('subadmin/contactUs'); 
            
        }
        
    }
}
