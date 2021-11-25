<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPortalUser extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        // $this->load->library('csvimport');
	}

    public function list()
    {
        $data['title'] ="Admin Portal User Name";
        
        $data['user'] = $this->CommonModel->select_single_row("Select count(*) as total from admin where id != 1");
        
        $where = array(
            "id !="    =>  1
        );

        $data['getAllAdminUser'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'admin','admin.id');

        $this->loadAdminView('admin/admin_portal_user/list',$data); 
    }
    
    public function add()
    {
        $data['title'] ="Add New Admin Portal User";
        $this->loadAdminView('admin/admin_portal_user/add',$data); 
    }
    
    public function insertAdminPortal()
    {
         $condition = array(
            "email" => $this->input->post('email'),
        );
        $Data = $this->CommonModel->selectRowDataByCondition($condition,'admin');
        
        if($Data){
            $data['title'] ="Add New Admin Portal User";
            $data['post'] = $_POST;
             $this->session->set_flashdata('error','Email Already exit. Used different email');
            $this->loadAdminView('admin/admin_portal_user/add',$data);
             return;
            
        }
        
        $client = $this->input->post('client');
        
        $role = implode(", ", $client);
        
         $name = $this->input->post('f_name').' '.$this->input->post('l_name');
         
         $data = array(
                    "email"            =>  $this->input->post('email'),
                    "password"         =>  md5($this->input->post('password')),
                    "orginal_password" =>  $this->input->post('password'),
                    "note"             =>  $this->input->post('note'),
                    "name"             =>  $name,
                    "role"             =>  $role,
                    "create_at"       =>  date('Y-m-d H:i:s a'),
                    "updated_at"       =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'admin');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success','You add admin portal user successfully');
            redirect('admin/admin_portal_user/user_list'); 
        }else{

            $this->session->set_flashdata('error','Somethings went wrong');
             redirect('admin/admin_portal_user/add_user'); 
        }

    }
    
    public function delete_adminPortal()
    {
        $val = explode(',',($this->input->post('adminPortalId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $updateData = $this->CommonModel->delete($where,'admin'); 

        }

        if($updateData)
        {
            $this->session->set_flashdata('success','You delete admin portal user');
            redirect('admin/admin_portal_user/user_list'); 
        }else{
            $this->session->set_flashdata('error','Somethings went wrong');
            redirect('admin/admin_portal_user/user_list');  
        }
    }
    
    public function editAdminPortal()
    {
        $ids = $this->input->post('adminPortalId');
        redirect('admin/admin_portal_user/edit_user/'.$ids);
    }
    
    public function edit()
    {
        // echo "h";
         $data['title'] = 'Edit New Admin Portal User';

        $id = $this->uri->segment(4);
        
         $condition = array(
            "id" => $this->uri->segment(4)
        );

        $data['adminPortalUser'] = $this->CommonModel->selectRowDataByCondition($condition,'admin'); 

        $this->loadAdminView('admin/admin_portal_user/edit',$data); 
    }
    
    public function updateAdminPortal()
    {
        $condition = array(
            "id" => $this->input->post('id')
        );
        
        
         $client = $this->input->post('client');
        
        $role = implode(", ", $client);
        //  print_r($role);die;
         $name = $this->input->post('f_name').' '.$this->input->post('l_name');
         
         $data = array(
                    "email"            =>  $this->input->post('email'),
                    "password"         =>  md5($this->input->post('password')),
                    "orginal_password" =>  $this->input->post('password'),
                    "note"              =>  $this->input->post('note'),
                    "name"             =>  $name,
                    "role"             =>  $role,
                    "create_at"       =>  date('Y-m-d H:i:s a'),
                    "updated_at"       =>  date('Y-m-d H:i:s a'),
            );

        // $insertData = $this->CommonModel->insertData($data,'admin'); 
        $updateData = $this->CommonModel->updateRowByCondition($condition,'admin',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success','You updated admin portal user successfully');
            redirect('admin/admin_portal_user/user_list'); 
        }else{

            $this->session->set_flashdata('error','Somethings went wrong');
             redirect('admin/admin_portal_user/add_user'); 
        }
    }
    
    public function exportAdminPortal(){
        // print_r($_POST);
        
        $fileName = 'adminPortalUser-'.time().'.xls';  

        $ids = $this->input->post('adminPortalId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getAdminPortalUserExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Admin Portal User Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Last Date/Time Login');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Note');       
        // set Row
        $rowCount = 2;
          $i = 1;
        foreach ($empInfo as $element) 
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['last_login']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['note']);
            $rowCount++;
            $i++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cutomer_Report.xls"');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    
    public function check_adminPortalEmail(){
         $condition = array(
            "email" => $this->input->post('email'),
        );
        $Data = $this->CommonModel->selectRowDataByCondition($condition,'admin');
        if ($Data) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    
}