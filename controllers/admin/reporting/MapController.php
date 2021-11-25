<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class MapController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function map_show()
    {	
    	// echo "string";die;
        $data['title'] = $this->lang->line('status');

        $data['getAllStatus'] = $this->CommonModel->mapDataReport();

        $where = array(
            "delete" => 0,
            "status" => 1,
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $data['getAllBus'] = $this->CommonModel->busDataReport();
        $data['getAllDriver'] = $this->CommonModel->driverDataReport();
        $data['getAllChaperone'] = $this->CommonModel->chaperoneDataReport();
        $data['getAllParent'] = $this->CommonModel->parentsDataReport();

        // print_r($data['getAllStatus']);die;
    	$this->loadAdminView('admin/reporting/map',$data); 
    }

     public function getMapReportAjax()
    {
        
        // $client_user = $this->session->userdata('ses_subadmin_id');
        $bus_id = $this->input->post('bus_id');
        $driver_id = $this->input->post('driver_id');
        $status = $this->input->post('status');
        $chaperone_id = $this->input->post('chaperone_id');
         $parents_id = $this->input->post('parents_id');

        $data['getAllStatus'] = $this->CommonModel->mapReportAjax($bus_id,$driver_id,$status,$chaperone_id,$parents_id);

        $this->load->view('admin/reporting/ajaxMap',$data); 
    }


    public function mapReportDetail()
    {   
        
        $bus_id = $this->input->post('bus_id');
        $driver_id = $this->input->post('driver_id');
        $status = $this->input->post('status');
        $chaperone_id = $this->input->post('chaperone_id');
        $parents_id = $this->input->post('parents_id');
        // $data['getAllStatus'] = $this->CommonModel->busDetailCheck($bus_id);
        $userData = $this->CommonModel->mapReportDetail($bus_id,$driver_id,$status,$chaperone_id,$parents_id);
        // print_r($userData);die;
        
        if (!empty($userData)) {
            echo json_encode($userData);
        }else{
            echo "0";
        }

    }

    public function getClientMapReportAjax()
    {
         $client_id = $this->input->post('client_id');

        $data['getAllStatus'] = $this->CommonModel->getClientMapReportAjax($client_id);

        $this->load->view('admin/reporting/ajaxMap',$data); 
    }

   

}
