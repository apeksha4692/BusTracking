<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class TripController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
        $this->load->library('excel');
        $this->load->library('pdf');
	}

    public function trip_list()
    {	
    	// echo "string";die;
        $data['title'] = $this->lang->line('status');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllStatus'] = $this->CommonModel->tripUserList($client_user);

        $data['trip_count'] = $this->CommonModel->select_single_row("Select count(*) as total from track where client_user_id =".$this->session->userdata('ses_subadmin_id')."");

        // print_r($data['getAllStatus']);die;
    	$this->loadSubAdminView('subadmin/trip/list',$data); 
    }
    
    public function trip_addOld()
    {
        // echo "string";
        $data['title'] = 'Add Trip';

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        $client_user = $this->session->userdata('ses_subadmin_id');

        $data['getAllDriver'] = $this->CommonModel->driverData($client_user);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneData($client_user);

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);
// print_r($data['getAllBus']);die;
        $this->loadSubAdminView('subadmin/trip/add',$data); 

    }
    
    public function trip_add()
    {
        // echo "string";
        $data['title'] = 'Add Trip';

        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        $client_user = $this->session->userdata('ses_subadmin_id');
        $today_date = date('Y-m-d');

        $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

        $data['getAllChild'] = $this->CommonModel->childTripData($client_user,$today_date);

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);
// print_r($data['getAllChild']);die;
        $this->loadSubAdminView('subadmin/trip/add',$data); 

    }
    
     public function addTripAjax()
    {

        $today_date = $this->input->post('date');
        $client_user = $this->session->userdata('ses_subadmin_id');
        // $today_date = date('Y-m-d');

        $data['getAllBus'] = $this->CommonModel->busTripData($client_user,$today_date);

        $data['getAllDriver'] = $this->CommonModel->driverTripData($client_user,$today_date);

        $data['getAllChaperone'] = $this->CommonModel->chaperoneTripData($client_user,$today_date);

        $data['getAllChild'] = $this->CommonModel->childTripData($client_user,$today_date);

        $data['getAllParent'] = $this->CommonModel->parentsData($client_user);

        $this->load->view('subadmin/trip/addTripAjax',$data); 
    }
    
    public function getParentName()
    {
        $condition  = array("id" => $this->input->post('child_id'));

        $childData = $this->CommonModel->selectRowDataByCondition($condition,'child');
        // print_r($childData);die;

        $where  = array("id" => $childData->parents_id);
        $parentData = $this->CommonModel->selectRowDataByCondition($where,'parents');

        // print_r($parentData);die;

        if (!empty($parentData)) {
            
            $arr = array(
                'parents_id'    => $parentData->id,
                'parents_name'  => $parentData->parents_name,
            );

            echo json_encode($arr);
        }else{
            echo "0";
        }

    }

    public function trip_insert()
    {
        // print_r($_POST);die;

        $data = array(
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_id"                =>  $this->input->post('bus_id'),
                    "driver_id"             =>  $this->input->post('driver_id'),
                    "chaperone_id"          =>  $this->input->post('chaperone_id'),
                    "child_id"              =>  $this->input->post('child_id'),
                    "parents_id"            =>  $this->input->post('parents_id'),
                    // "pickup_address"        =>  $this->input->post('pickup_address'),
                    // "pickup_latitude"       =>  $this->input->post('pickup_latitude'),
                    // "pickup_longitude"      =>  $this->input->post('pickup_longitude'),
                    // "drop_address"          =>  $this->input->post('drop_address'),
                    // "drop_latitude"         =>  $this->input->post('drop_latitude'),
                    // "drop_longitude"        =>  $this->input->post('drop_longitude'),
                    "trip_date"             =>  $this->input->post('trip_date'),
                    "trip_start"            =>  $this->input->post('trip_start'),
                    "trip_end"              =>  $this->input->post('trip_end'),
                    // "status"                =>  $this->input->post('status'),
                    "complete_status"       =>  0,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'track');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('trip_add_successfully'));
            redirect('subadmin/trip_list'); 
            // redirect('subadmin/chaperone_add'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('trip_not_add_successfully'));
             redirect('subadmin/trip_list'); 
            
        }
    }

}
