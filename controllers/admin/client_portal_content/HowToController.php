<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HowToController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        // $this->load->library('csvimport');
	}

    public function howto_list()
    {
        // echo "hi";die;
        $condition = array(
            "id" => 2
        );

        $data['how_to'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 
        
         $where = array(
            "image_status"   =>  1,
            "how_to_id"      =>  2
        );

        $data['getHowToImg'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'how_to_img','how_to_img.id');
        
        // $data['getHowToImg'] = $this->CommonModel->howToImg();
        // print_r($data['getHowToImg']);die;
        // print_r($data['about_us']);die;
        $this->loadAdminView('admin/client_portal_content/howto_list',$data); 
    }
    
    public function editHowTo()
    {
        $data['title'] = 'Edit How To';
        
        $condition = array(
            "id" => $this->uri->segment(4)
        );

        $data['how_to'] = $this->CommonModel->selectRowDataByCondition($condition,'cms'); 

         $this->loadAdminView('admin/client_portal_content/edit_how_to',$data); 
    }
    
    public function update_howto()
    {
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
             $this->session->set_flashdata('success','How To updated Successfully');
            redirect('admin/client_portal_content/how_to'); 
        }else{
             $this->session->set_flashdata('error','How To not updated successfully');
            redirect('admin/client_portal_content/editHow_To/'.$this->input->post('id'));
        }
    }
    
    public function delete_howToImg()
    {
        $val = explode(',',($this->input->post('howToImgId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $howToImgData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'how_to_img');

            if($howToImgData)
            {
                $updateData = $this->CommonModel->delete($where,'how_to_img'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                 redirect('admin/client_portal_content/how_to');
            }
        }

        if ($updateData) 
        {
            $this->session->set_flashdata('success','How to image detail deleted successfully');
            // redirect('admin/client/edit/'.$this->input->post('id')); 
            redirect('admin/client_portal_content/how_to');
        }else{
            $this->session->set_flashdata('error','How to image detail not deleted successfully');
             redirect('admin/client_portal_content/addHow_To_Img'); 
            
        }
    }
    
    public function editHow_toImg()
    {
        $ids = $this->input->post('howToImgId');
        redirect('admin/client_portal_content/how_to_image_edit/'.$ids);
    }
    
    
    public function addHowToImg()
    {
        $data['title'] = 'Add How To Image';

         $this->loadAdminView('admin/client_portal_content/add_how_to_img',$data); 
    }
    
    
     public function insertHowToImg()
    {
        $this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('description', 'description', 'required'); 
         $this->form_validation->set_rules('ar_description', 'afrabic description', 'required'); 
			
         if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('error','Please filled description in English');
            redirect('admin/client_portal_content/addHow_To_Img'); 
         } 
         
        // print_r($_POST);die;
        // if (empty($this->input->post('description'))) {
        //   $this->session->set_flashdata('error','Please filled description in English');
        //     redirect('admin/client_portal_content/addHow_To_Img');   
        // }
        // else if (empty($this->input->post('ar_description'))) {
        //   $this->session->set_flashdata('error','Please filled description in Arabic');
        //     redirect('admin/client_portal_content/addHow_To_Img');   
        // }
        // else{
            $config['upload_path']         =  'uploads/how_to_work_image/';
            $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
            $config['max_size']             =  (1024)*(1024);
            $config['max_width']            =  0;
            $config['max_height']           =  0;
    
            $this->load->library('upload');
            $this->upload->initialize($config);
    
            if(!$this->upload->do_upload('profile_pic'))
            {
                $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                $this->session->set_flashdata('error','You select invalid image format');
                 redirect('admin/client_portal_content/addHow_To_Img'); 
            }
            else
            {
                $this->upload_data['file'] = $this->upload->data();
                $img = $this->upload->data('file_name');      
            }
            
             $data = array(
                        "description"     =>  $this->input->post('description'),
                        "ar_description"  =>  $this->input->post('ar_description'),
                        'img'             =>  $img,
                        'how_to_id'      =>  2,
                        "created_at"      =>  date('Y-m-d H:i:s a'),
                        "updated_at"      =>  date('Y-m-d H:i:s a'),
                );
                
             $insertData = $this->CommonModel->insertData($data,'how_to_img');  
    
    
            if ($insertData) 
            {
                $this->session->set_flashdata('success','How to image detail added successfully');
                // redirect('admin/client/edit/'.$this->input->post('id')); 
                redirect('admin/client_portal_content/how_to');
            }else{
                $this->session->set_flashdata('error','How to image detail not added successfully');
                 redirect('admin/client_portal_content/addHow_To_Img'); 
                
            }
        // }

    }
    
    public function how_to_image_edit()
    {
        $data['title'] = 'Edit How to Image';
         $condition = array(
            "id" => $this->uri->segment(4)
        );

        $data['how_to_img'] = $this->CommonModel->selectRowDataByCondition($condition,'how_to_img'); 
        // print_r($data['how_to_img']);die;

        $this->loadAdminView('admin/client_portal_content/edit_how_to_img',$data); 
    }
    
    
    public function updateHowToImg()
    {
        // print_r($_FILES);die;
        $condition = array(
            "id" => $this->input->post('id')
        );

        $howToImgData = $this->CommonModel->getsingle('how_to_img',$condition);
        
        // print_r($howToImgData->img);die;
        
        if (isset($_FILES['profile_pic'])) 
        {  
            if($_FILES['profile_pic']['size'] != 0)
            {
                 $config['upload_path']         =  'uploads/how_to_work_image/';
                $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['max_size']             =  (1024)*(1024);
                $config['max_width']            =  0;
                $config['max_height']           =  0;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('profile_pic'))
                {
                    $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                     redirect('admin/client_portal_content/how_to_image_edit/'.$this->input->post('id')); 
                }
                else
                {
                    $this->upload_data['file'] = $this->upload->data();
                    $img = $this->upload->data('file_name');      
                }
            }
            else
            {
               $img = $howToImgData->img;
            }
        }
        else
        {
           $img = $howToImgData->img;
        }
        
        $data = array(
                    "description"     =>  $this->input->post('description'),
                    "ar_description"  =>  $this->input->post('ar_description'),
                    'img'             =>  $img,
                    "created_at"      =>  date('Y-m-d H:i:s a'),
                    "updated_at"      =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'how_to_img',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success','How to image detail updated successfully');
            // redirect('admin/client/edit/'.$this->input->post('id')); 
            redirect('admin/client_portal_content/how_to');
        }else{
            $this->session->set_flashdata('error','How to image detail not updated successfully');
            redirect('admin/client_portal_content/how_to_image_edit/'.$this->input->post('id')); 
            
        }
    }
        
    
    
}