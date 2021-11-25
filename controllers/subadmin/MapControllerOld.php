<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class MapController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function map_show()
    {	
    	// echo "string";die;
        $data['title'] = $this->lang->line('status');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllStatus'] = $this->CommonModel->statusUserListTodayDate($client_user);

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');


        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);

        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);

        $this->loadSubAdminView('subadmin/track/map',$data); 
    }


    public function getMapAjax()
    {
        
        $client_user = $this->session->userdata('ses_subadmin_id');
        $bus_id = $this->input->post('bus_id');
        $driver_id = $this->input->post('driver_id');
        $status = $this->input->post('status');
        $chaperone_id = $this->input->post('chaperone_id');
        $parents_id = $this->input->post('parents_id');

        $data['getAllStatus'] = $this->CommonModel->mapDataToday($bus_id,$driver_id,$status,$chaperone_id,$client_user,$parents_id);

        $this->load->view('subadmin/track/ajaxMap',$data); 
    }


    public function mapDataDetail()
    {   
       $client_user = $this->session->userdata('ses_subadmin_id');
        $bus_id = $this->input->post('bus_id');
        $driver_id = $this->input->post('driver_id');
        $status = $this->input->post('status');
        $chaperone_id = $this->input->post('chaperone_id');
        $parents_id = $this->input->post('parents_id');
        
        $userData = $this->CommonModel->mapDataDetail($bus_id,$driver_id,$status,$chaperone_id,$client_user);
        // print_r($userData);die;
        
        if (!empty($userData)) {
            echo json_encode($userData);
        }else{
            echo "0";
        }

    }
}
