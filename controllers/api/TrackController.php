<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class TrackController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function source_destination_post()
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
        $this->form_validation->set_rules('source_location', 'Source Location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        $this->form_validation->set_rules('destination_location', 'destination location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        $source_location = $this->input->post('source_location');
        $destintion_location = $this->input->post('destination_location');
        
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
        // $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.urlencode($source_location).'&destinations='.urlencode($destintion_location).'&key=AIzaSyAK5p5VCGES93jNO-Tj_JtoMdutckksSdU');
    //   $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$source_location&destinations=New+York+City,NY&key=AIzaSyAK5p5VCGES93jNO-Tj_JtoMdutckksSdU');
        
        $distance_arr = json_decode($distance_data);
        
        
        if($distance_arr)
		{
		   
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				 'object'	=> $distance_arr
			));
		}else
		{
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Somethings went wrong',
			
			));
		}
        
	    
	}
	public function save_latitude_longitude_post()
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
        $this->form_validation->set_rules('latitude', 'Source Location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        $this->form_validation->set_rules('longitude', 'destination location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        // $this->form_validation->set_rules('travel_time', 'travel time', 'required');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     return $this->response(array(
        //         'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        //         'message' 	=> validation_errors(),
        //         'Data'	=> new stdClass()
        //     ));
        // }
        
        $chaperone_id = $this->input->post('chaperone_id');
        $trip_id = $this->input->post('trip_id');
        $source_location = $this->input->post('latitude');
        $destintion_location = $this->input->post('longitude');
        $travel_time = $this->input->post('travel_time');
        
        $data = array(
                    "chaperone_id"        =>  $chaperone_id,
                    "trip_id"        =>  $trip_id,
                    "latitude"        =>  $source_location,
                    "longitude"        =>  $destintion_location,
                    "travel_time" => $travel_time,
        );

        $insertData = $this->CommonModel->insertData($data,'save_lat_long');
        
        if($insertData)
		{
		   
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'meg'	=> "save sucessfully"
			));
		}else
		{
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Somethings went wrong',
			
			));
		}
	}
	
	public function latitude_longitude_post()
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
        $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $this->form_validation->set_rules('parents_id', 'Parents Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        $trip_id = $this->input->post('trip_id');
        $parents_id = $this->input->post('parents_id');
	    
	      $fieldName = 'id';
	      $table = 'save_lat_long';
	   //   $getdata = $this->CommonModel->selectRowDatabyFieldName($table,$fieldName);
	   
	        $where =  array(
                    "chaperone_id"  =>  $chaperone_id,
                    "trip_id"       =>  $trip_id,
                );
	        
	       $getdata = $this->CommonModel->selectRowDataByConditionAndFieldName($where,$table,$fieldName);
	       //print_r($getdata);die;
	       if(empty($getdata))
	       {
	           return $this->response(array(
						'status'	=> REST_Controller::HTTP_BAD_REQUEST,
						'message' 	=> 'No Data Found.',
						'object'	=> new stdClass()
					));
	       }
	      
	        $whereTrip =  array(
                    "id"        =>  $trip_id,
                );
	      
    	    $tripData = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip'); 
    	    
    	    $whereTripParents =  array(
                    "trip_id"        =>  $trip_id,
                    "parents_id"        =>  $parents_id,
                );
	      
    	    $parentsTripData = $this->CommonModel->selectRowDataByCondition($whereTripParents,'trip_add_parents'); 
            
            // $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.urlencode($parentsTripData->pickup_address).'&destinations='.urlencode($parentsTripData->drop_address).'&mode=DRIVING&key=AIzaSyAzhCZWT6VcpxKA9oQ1iaZ1fyKHNkFcsGg');

             $distance_location =  $parentsTripData->pickup_latitude.','.$parentsTripData->pickup_longitude;
            
            
            $whereTrip = array('id'=>$trip_id);
            $tripDetail = $this->CommonModel->getsingle('trip',$whereTrip);
        
            // $bus_location =  '('.$tripDetail->pickup_latitude.','.$tripDetail->pickup_longitude.')';
            // $bus_location =  $tripDetail->pickup_latitude.','.$tripDetail->pickup_longitude;
            $bus_location =  $getdata->latitude.','.$getdata->longitude;
            
            // print_r($distance_location);die;
         
            
        //   $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins=31.9591295,35.8649304&amp;destinations=22.69263295230495,75.86760733276606&amp;key=AIzaSyAK5p5VCGES93jNO-Tj_JtoMdutckksSdU');
        
          $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$bus_location.'&destinations='.$distance_location.'&key=AIzaSyAK5p5VCGES93jNO-Tj_JtoMdutckksSdU');
        
        //   $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$bus_location.'&destinations='.$distance_location.'&key=AIzaSyDqlh45h5nKLG-SlnhXVor7aYoyWT1n0JE');
            
            // 22.7050743
            // 75.9091941
            // print_r($distance_data);
            // die;
           

            $distance_arr = json_decode($distance_data);
            
            // print_r($distance_arr);die;
            
            $data['id']= $getdata->id;
            $data['chaperone_id']= $getdata->chaperone_id;
            $data['trip_id']= $getdata->trip_id;
            $data['latitude']= $getdata->latitude;
            $data['longitude']= $getdata->longitude;
            $data['travel_time']= $getdata->travel_time;
            $data['created_date']= $getdata->created_date;
            $data['trip_source_latitude']= $tripData->pickup_latitude;
            $data['trip_source_longitude'] = $tripData->pickup_longitude;
            
            $data['parents_pickup_address']= $parentsTripData->pickup_address;
            $data['parents_pickup_latitude'] = $parentsTripData->pickup_latitude;
            $data['parents_pickup_longitude']= $parentsTripData->pickup_longitude;
            $data['parents_drop_address'] = $parentsTripData->drop_address;
            $data['parents_drop_latitude']= $parentsTripData->drop_latitude;
            $data['parents_drop_longitude'] = $parentsTripData->drop_longitude;
            $data['distance'] =$distance_arr;
            
            foreach($distance_arr->rows as $v)
            {
               foreach($v as $k)
               {
                   foreach($k as $a)
                   {
                       $data['distance_text']= $a->distance->text;
                       $data['distance_value']= $a->distance->value;
                       $data['duration_text']= $a->duration->text;
                       $data['duration_value']= $a->duration->value;
                    }
               }
            }
              
            if($getdata)
            {
            
                return $this->response(array(
                	'status'	=> REST_Controller::HTTP_OK,
                	/*'meg'	=> "save sucessfully",*/
                // 	'object' => $getdata,
                	'object' => $data
                	
                ));
            }else
            {
                return $this->response(array(
                	'status'	=> REST_Controller::HTTP_OK,
                	'message' 	=> 'Somethings went wrong',
            
                ));
            }
	}
	
    
    public function midpoint_post()
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
        
        $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $this->form_validation->set_rules('logitude', 'Logitude', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            return $this->response(array(
                'status'	=> REST_Controller::HTTP_BAD_REQUEST,
                'message' 	=> validation_errors(),
                'Data'	=> new stdClass()
            ));
        }
        
        $chaperone_id = $this->input->post('chaperone_id');
        $trip_id = $this->input->post('trip_id');
        $address = $this->input->post('address');
        $latitude = $this->input->post('latitude');
        $logitude = $this->input->post('logitude');
        
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
        
        $tripWhere = array('id' => $trip_id);
        $tripData = $this->CommonModel->selectRowDataByCondition($tripWhere,'trip'); 
        
        $source_location = $tripData->pickup_address;
        $source_latitude = $tripData->pickup_latitude;
        $source_longitude = $tripData->pickup_longitude;
        
        $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.urlencode($source_location).'&destinations='.urlencode($address).'&key=AIzaSyAzhCZWT6VcpxKA9oQ1iaZ1fyKHNkFcsGg');
        $distance_arr = json_decode($distance_data);
        print_r($distance_arr);
        
    }
    
    
    public function all_pick_up_points_post()
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
        
         $this->form_validation->set_rules('trip_id', 'Trip Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
         $this->form_validation->set_rules('current_latitude', 'Current Latitude', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
         $this->form_validation->set_rules('current_logitude', 'Current Logitude', 'required');
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
        
        $trip_id = $this->input->post('trip_id');
        $current_latitude = $this->input->post('current_latitude');
        $current_logitude = $this->input->post('current_logitude');
        
        $whereTrip = array('id' => $trip_id);
        
        $TripDetail = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip');
        
        // $d['start_latitude'] = $TripDetail->pickup_latitude;
        // $d['start_longitude'] = $TripDetail->pickup_longitude;
        
       
        
//         $arr['total_amount'] 	= 	$totalAmount->total_amount;
// 		$arr['pending_amount'] = 	$pendingAmount->pending_amount;
		
        $parentsTripLocation = $this->CommonModel->parentsTripLocationDistance($chaperone_id,$trip_id,$current_latitude,$current_logitude);
        
        
        // print_r($parentsTripLocation);die;
        
        $start_latitude = $TripDetail->pickup_latitude;
        $start_longitude = $TripDetail->pickup_longitude;
        
        // $arr['start_latitude'] = $TripDetail->pickup_latitude;
        // $arr['start_longitude'] = $TripDetail->pickup_longitude;
        
        
        if($parentsTripLocation)
        {
            foreach($parentsTripLocation as $value)
            {
                $dataText[] = array(
					'trip_id' 		        =>  $value['trip_id'],
					'parents_name' 		    =>  $value['parents_name'],
					'child_name' 			=>  $value['child_name'],
					'client_logo_image'     =>  $this->check_value(base_url().'uploads/child_image/'.$value['child_image']),
					'pickup_address' 			=>  $this->check_value($value['pickup_address']),
					'pickup_latitude' 			=>  $this->check_value($value['pickup_latitude']),
					'pickup_longitude' 			=>  $this->check_value($value['pickup_longitude']),
					'distance' 			=>  $this->check_value($value['distance']),
				// 	'drop_address' 			=>  $this->check_value($value['drop_address']),
				// 	'drop_latitude' 			=>  $this->check_value($value['drop_latitude']),
				// 	'drop_longitude' 			=>  $this->check_value($value['drop_longitude']),
	
				);
        	}
        	$msg = "All Parents Pickup point";
        // 	$arr['pickup+request'] = $dataText;
            
        }else{
            $msg = "No Parents Pickup point";
            $dataText = array();
            // $arr['pickup_request'] = $dataText;
        }
        
        $arr = $dataText;

        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			'start_latitude' 	=> $start_latitude,
			'start_longitude' 	=> $start_longitude,
// 			'trip_location'	=> $d,
			'object'	=> $arr
		));
        
	}
	
}