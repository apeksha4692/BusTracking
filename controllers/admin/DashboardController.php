<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        
	}
	public function index()
	{
                $data['title'] = 'Dashboard';
        //echo "string";die;
        $data['client'] = $this->CommonModel->select_single_row("Select count(*) as client_total from client ");

         $data['client_user'] = $this->CommonModel->select_single_row("Select count(*) as client_user_total from client_user ");

// print_r($data['client_user']);die;

        // $data['dj'] = $this->CommonModel->select_single_row("Select count(*) as dj_total from user where user_type != 1 and is_delete = 0");
        // $data['pendingSong'] = $this->CommonModel->select_single_row("Select count(*) as pendingTotal from song_request where dj_status = 0");
        // $data['acceptSong'] = $this->CommonModel->select_single_row("Select count(*) as acceptTotal from song_request where dj_status = 1");
        // $data['rejectSong'] = $this->CommonModel->select_single_row("Select count(*) as rejectTotal from song_request where dj_status = 2");


                $this->loadAdminView('admin/dashboard',$data); 
	}

    
}
