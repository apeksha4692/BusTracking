<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        
	}

    public function profile()
    {
        $data['title'] = $this->lang->line('profile');

        $client_user_id = $this->session->userdata('ses_subadmin_id');
        $data['getSubAdminData'] = $this->CommonModel->subadminDetail($client_user_id);

        $this->loadSubAdminView('subadmin/profile',$data); 
    }
    
    public function update_profile()
    {
        // print_r($_POST);die;
        // echo "string";die;
        $data['title'] = $this->lang->line('profile');

        // $where = array('id'=>$this->session->userdata('ses_subadmin_id'));
        // $getAdminData = $this->CommonModel->getsingle('admin',$where);

       /* if (isset($_FILES['image'])) 
        {  
            if($_FILES['image']['size'] != 0)
            {
                $config['upload_path']          =  'uploads/admin/';
                $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['max_size']             =  (1024)*(1024);
                $config['max_width']            =  0;
                $config['max_height']           =  0;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('image'))
                {
                    $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                    redirect('admin/profile');
                }
                else
                {
                    $this->upload_data['file'] = $this->upload->data();
                    $profile_img = $this->upload->data('file_name');      
                }
            }
            else
            {
               $profile_img = $getAdminData->profile_image; 
            }
        }
        else
        {
            $profile_img = $getAdminData->profile_image; 
        }
*/
        // $profile = $this->lang->line('profile');

        $data = array(
            // 'profile_image'     => $profile_img,
            'username'              =>  $this->input->post('username'),
            'email'                 =>  $this->input->post('email'),
            'mobile_number'         =>  $this->input->post('mobile_number'),
            'updated_at'            =>  date('Y-m-d H:i:s')
        );
        $where = array('id' => $this->session->userdata('ses_subadmin_id'));
        $this->CommonModel->update_entry('client_user',$data,$where);
        // $this->session->set_flashdata('success','Your Profile Update successfully');
        $this->session->set_flashdata('success',$this->lang->line('profile_update_successfully'));
        redirect('subadmin/profile');
    }
    
    public function change_password()
    {
        $where = array('id'=>$this->session->userdata('ses_subadmin_id'));
        $getSubAdminData = $this->CommonModel->getsingle('client_user',$where);

        $oldPassword        = $this->input->post('old_password');
        $newPassword        = $this->input->post('new_password');
        $confirmPassword    = $this->input->post('confirm_password');

        if($getSubAdminData->login_password != $oldPassword)
        {
            $this->session->set_flashdata('error',$this->lang->line('old_password_not_match'));
            redirect('admin/profile');
        }
        else{
            // echo "string";
            $data = array(
                'login_password'      => $newPassword,
            );
            $this->CommonModel->update_entry('client_user',$data,$where);
            $this->session->set_flashdata('success',$this->lang->line('password_update_successfully'));
            redirect('subadmin/profile');
        }

    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('subadmin/login','refresh');
    }
}
