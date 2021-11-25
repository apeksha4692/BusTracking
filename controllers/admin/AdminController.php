<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function admin_content()
    {	
    	$this->loadAdminView('admin/admin_content'); 
    }

    public function client_content()
    {   
        $this->loadAdminView('admin/client_content'); 
    }


    

}
