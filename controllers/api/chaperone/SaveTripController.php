<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class SaveTripController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function check_save_trip_post()
	{
	    $this->form_validation->set_rules('chaperone_id', 'Chaperone Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        
        $chaperoneWhere = array('id' => $chaperone_id);
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
        if(empty($chaperoneData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No chaperone found',
				'Data '	=> new stdClass()
			));
        }
        
        $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $trip_id = $this->input->post('trip_id');
        
        $whereTrip = array(
	            "chaperone_id" 	 =>  $chaperone_id,
	            "id"             =>  $trip_id
	        );
	    $tripAvailable = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip');
	    
	    
	    if(empty($tripAvailable))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Trip not found',
				'Data '	=> new stdClass()
			));
        }
        
        $whereSaveTrip = array(
	            "user_id" 	 => $chaperone_id,
	            "trip_id"   => $trip_id
	        );
	    $checkSaveTripAvailable = $this->CommonModel->selectRowDataByCondition($whereSaveTrip,'save_trip');
	    
	   // print_r($saveTripAvailable);die;
	    
	    if(empty($checkSaveTripAvailable))
	    {
	        $status    = 	0;
	        $msg = 'Trip not save';
	        
//             return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> 'Trip not save',
// 				'object'	=> $data
// 			));
	    }else{
            $status    = 	1;
            $msg = 'Trip already save';
// 	       return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> 'Trip already save',
// 			    'object'	=> $data
// 			));
	       
	    }
	    
	    $output["status"]     = REST_Controller::HTTP_OK;
        $output["message"]    = $msg;
        $output["check_status"]      =   $status;
        
        $this->response($output, REST_Controller::HTTP_OK);
	}
	
    public function save_trip_post()
    {
        $this->form_validation->set_rules('chaperone_id', 'Chaperone Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        
        $chaperoneWhere = array('id' => $chaperone_id);
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
        if(empty($chaperoneData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No chaperone found',
				'Data '	=> new stdClass()
			));
        }
        
        $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $trip_id = $this->input->post('trip_id');
        
        $whereTrip = array(
	            "chaperone_id" 	=> $chaperone_id,
	            "id"            => $trip_id
	        );
	    $tripAvailable = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip');
	    
	    
	    if(empty($tripAvailable))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Trip not found',
				'Data '	=> new stdClass()
			));
        }
        
        $whereSaveTrip = array(
	            "user_id" 	 => $chaperone_id,
	            "trip_id"   => $trip_id
	        );
	    $saveTripAvailable = $this->CommonModel->selectRowDataByCondition($whereSaveTrip,'save_trip');
	    
	   // print_r($saveTripAvailable);die;
	    
	    if(empty($saveTripAvailable))
	    {
	        $data = array(
	            "user_id" 	 => $chaperone_id,
	            "trip_id"   => $trip_id     
	       );
	       
	       $updateData = $this->CommonModel->insertData($data,'save_trip'); 
	       
	       if($updateData){
    	       return $this->response(array(
    				'status'	=> REST_Controller::HTTP_OK,
    				'message' 	=> 'Trip save successfully',
    				// 'object'	=> new stdClass()
    			));
	       }else{
	           return $this->response(array(
    				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
    				'message' 	=> 'Trip not save successfully.',
    				// 'object'	=> new stdClass()
    			));
	       } 
	    }else{
	        $where = array('id' => $saveTripAvailable->id);
	        
	        $data = array(
	            "user_id" 	 => $chaperone_id,
	            "trip_id"   => $trip_id     
	       );
	       
	       $updateData = $this->CommonModel->updateRowByCondition($where,'save_trip',$data); 
	       
	       if($updateData){
    	       return $this->response(array(
    				'status'	=> REST_Controller::HTTP_OK,
    				'message' 	=> 'Trip replace and save successfully',
    				// 'object'	=> new stdClass()
    			));
	       }else{
	           return $this->response(array(
    				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
    				'message' 	=> 'Trip not update successfully.',
    				// 'object'	=> new stdClass()
    			));
	       }
	    }
    }
}