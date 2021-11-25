<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class LocationController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function setLocation_post()
	{
	     $this->form_validation->set_rules('parent_id', 'Parent Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $parent_id = $this->input->post('parent_id');
        
        $parentsWhere = array('id' => $parent_id);
        
        $parentsData = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
            
        if(empty($parentsData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No Parents found',
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
        
        
//          $this->form_validation->set_rules('pickup_address', 'Pickup Address', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
        
        
//          $this->form_validation->set_rules('pickup_latitude', 'Pickup Latitude', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
//          $this->form_validation->set_rules('pickup_longitude', 'Pickup Longitude', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
//          $this->form_validation->set_rules('drop_address', 'Drop Address', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
//          $this->form_validation->set_rules('drop_latitude', 'Drop Latitude', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
//          $this->form_validation->set_rules('drop_longitude', 'Drop Longitude', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
//         }
        
        if(!empty($this->input->post('pickup_address'))){
            $data = array(
                // 'profile_image'     => $profile_img,
                'pickup_address'       =>  $this->input->post('pickup_address'),
                'pickup_latitude'      =>  $this->input->post('pickup_latitude'),
                'pickup_longitude'     =>  $this->input->post('pickup_longitude'),
                // 'drop_address'         =>  $this->input->post('drop_address'),
                // 'drop_latitude'        =>  $this->input->post('drop_latitude'),
                // 'drop_longitude'       =>  $this->input->post('drop_longitude'),
                'updated_at'            =>  date('Y-m-d H:i:s')
            );
        }else{
            $data = array(
                // 'profile_image'     => $profile_img,
                // 'pickup_address'       =>  $this->input->post('pickup_address'),
                // 'pickup_latitude'      =>  $this->input->post('pickup_latitude'),
                // 'pickup_longitude'     =>  $this->input->post('pickup_longitude'),
                'drop_address'         =>  $this->input->post('drop_address'),
                'drop_latitude'        =>  $this->input->post('drop_latitude'),
                'drop_longitude'       =>  $this->input->post('drop_longitude'),
                'updated_at'            =>  date('Y-m-d H:i:s')
            );
        }
        // $data = array(
        //     // 'profile_image'     => $profile_img,
        //     'pickup_address'       =>  $this->input->post('pickup_address'),
        //     'pickup_latitude'      =>  $this->input->post('pickup_latitude'),
        //     'pickup_longitude'     =>  $this->input->post('pickup_longitude'),
        //     'drop_address'         =>  $this->input->post('drop_address'),
        //     'drop_latitude'        =>  $this->input->post('drop_latitude'),
        //     'drop_longitude'       =>  $this->input->post('drop_longitude'),
        //     'updated_at'            =>  date('Y-m-d H:i:s')
        // );
        // $where = array('id' => $this->input->post('trip_id'));
        // $updateTripLocation = $this->CommonModel->update_entry('trip',$data,$where);
        
        $where = array(
            'parents_id' => $this->input->post('parent_id'),
            'trip_id'    => $this->input->post('trip_id'),
        
        );
        $updateTripLocation = $this->CommonModel->update_entry('trip_add_parents',$data,$where);
        
        if($updateTripLocation)
        {
            // $whereTip = array('id' => $this->input->post('trip_id'));
            // $tripData = $this->CommonModel->getsingle('trip',$whereTip);
            
            
            $whereTip = array(
                'parents_id' => $this->input->post('parent_id'),
                'trip_id'    => $this->input->post('trip_id'),
            );  
             $tripData = $this->CommonModel->getsingle('trip_add_parents',$whereTip);
            // print_r($tripData);die;
            $dataText['trip_id'] 			= $this->check_value($tripData->trip_id);
            $dataText['pickup_address'] 	= $this->check_value($tripData->pickup_address);
            $dataText['pickup_latitude'] 	= $this->check_value($tripData->pickup_latitude);
            $dataText['pickup_longitude'] 	= $this->check_value($tripData->pickup_longitude);
            $dataText['drop_address'] 		= $this->check_value($tripData->drop_address);
            $dataText['drop_latitude'] 		= $this->check_value($tripData->drop_latitude);
            $dataText['drop_longitude'] 	= $this->check_value($tripData->drop_longitude);
            $dataText['updated_at'] 		= $this->check_value($tripData->updated_at);
            $dataText['updated_date'] 	= date("d/m/Y",strtotime($tripData->updated_at));
            $dataText['updated_time'] 	= date("H:i:s",strtotime($tripData->updated_at));
            
            
            if(!empty($this->input->post('pickup_address'))){
                $msg = "You pick up location updated successfully";
            }else{
                $msg = "You drop up location updated successfully";
            }
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> $msg,
				'object'	=> $dataText
			)); 
        }
        else
		{
			return $this->response(array(
					'status'	=> REST_Controller::HTTP_BAD_REQUEST,
					'message' 	=> 'Somethings went wrong',
					'object'	=> new stdClass()
				));
		}
	}
	
	public function calculateDistance_post()
	{
	    $this->form_validation->set_rules('parent_id', 'Parent Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $parent_id = $this->input->post('parent_id');
        
        $parentsWhere = array('id' => $parent_id);
        
        $parentsData = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
            
        if(empty($parentsData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No Parents found',
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
        
        $tripWhere = array('id' => $trip_id);
        
        $tripData = $this->CommonModel->selectRowDataByCondition($tripWhere,'trip');
            
        if(empty($tripData))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No Trip found',
				'Data '	=> new stdClass()
			));
        }
        
        // print_r($tripData);
        
        $pickup_latitude    =   $tripData->pickup_latitude;
        $pickup_longitude   =   $tripData->pickup_longitude;
        $drop_latitude      =   $tripData->drop_latitude;
        $drop_longitude     =   $tripData->drop_longitude;
        
        $trip_start     =   $tripData->trip_start;
        $trip_end      =   $tripData->trip_end;
        
        $tripLocationDetail = $this->ApiModel->distanceCalculation($pickup_latitude,$pickup_longitude,$drop_latitude,$drop_longitude,$trip_id);
        
        if($tripLocationDetail)
        {
            $total_distance = $tripLocationDetail->distance;
            $dropoff_time   = ((float)$total_distance/(float)56)*(float)60;
    
            $drop      = explode('.', $dropoff_time);
            if (empty($drop[1])) {
                $var1 = '00';
            }else{
                $b = $drop[1];
                $var1 = substr($drop[1],-3,-1);
            }
            $time = $drop[0].':'.$var1;
            
            $dataText['trip_id'] = $tripLocationDetail->id;
            $dataText['pickup_address'] = $tripLocationDetail->pickup_address;
            $dataText['pickup_latitude'] 		= $tripLocationDetail->pickup_latitude;
            $dataText['pickup_longitude'] 		= $tripLocationDetail->pickup_longitude;
            $dataText['drop_address'] 	= $tripLocationDetail->drop_address;
            $dataText['drop_latitude'] 	= $tripLocationDetail->drop_latitude;
            $dataText['drop_longitude'] = $tripLocationDetail->drop_longitude;
            $dataText['total_distance'] = $total_distance.' KM';
            $dataText['total_time'] = $time;
            $dataText['updated_at'] 	= $tripData->updated_at;
            $dataText['updated_date'] 	= date("d/m/Y",strtotime($tripData->updated_at));
            $dataText['updated_time'] 	= date("H:i:s",strtotime($tripData->updated_at));

			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Trip detail',
				'object'	=> $dataText
			));
           
        }
        else
		{
			return $this->response(array(
					'status'	=> REST_Controller::HTTP_BAD_REQUEST,
					'message' 	=> 'Somethings went wrong',
					'object'	=> new stdClass()
				));

		}
        

        
        
        
        
        
        
        
        
        
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}