<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class TripController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function tripList_post()
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
        
        // $chaperoneTripData = $this->ApiModel->checkChaperoneTrip($chaperone_id);
        $chaperoneTripData = $this->CommonModel->checkChaperoneTrip($chaperone_id);
        // print_r($chaperoneTripData);die;
        if($chaperoneTripData){
            foreach ($chaperoneTripData as $key => $value) 
        	{
        		$dataText[] = array(
					'trip_id' 		        =>  $value['trip_id'],
					'trip_number' 		    =>  $value['tridID'],
					'bus_number' 			=>  $value['bus_number'],
					'driver_name' 			=>  $value['driver_name'],
					'chaperone_name' 	=>  $value['chaperone_name'],
					'chaperone_phone' 	=>  $value['chaperone_phone'],
					'drive_mobile_number' 	=>  $value['drive_mobile_number'],
					'client_user_name' 		=>  $value['client_user_name'],
					'client_name' 			=>  $value['client_name'],
					'pickup_address' 			=>  $this->check_value($value['pickup_address']),
					'pickup_latitude' 			=>  $this->check_value($value['pickup_latitude']),
					'pickup_longitude' 			=>  $this->check_value($value['pickup_longitude']),
				// 	'client_logo_image'     =>  $this->check_value(base_url().'uploads/client/'.$value['client_logo_image']),
					'drop_address' 			=>  $this->check_value($value['drop_address']),
					'drop_latitude' 			=>  $this->check_value($value['drop_latitude']),
					'drop_longitude' 			=>  $this->check_value($value['drop_longitude']),
					'trip_start' 			=>  $this->check_value($value['trip_start']),
					'trip_end' 			=>  $this->check_value($value['trip_end']),
					'status' 			=>  $this->check_value($value['status']),
					'complete_status' 			=>  $this->check_value($value['complete_status']),
					'updated_date' 			=>  $this->check_value($value['updated_at']),
				);
        	}
        	$msg = "All Chaperone Trip";
        // 	$arr['chaperone_trip'] = $chaperoneTrip;
        }else{
            $msg = "No Chaperone Trip";
            $dataText = array();  
        }
        
        $arr = $dataText;
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			// 'count' 	=> $totalTip,
			'object'	=> $arr
		));
	}
	
	public function tripDetail_post()
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
        
        // $chaperoneTripData = $this->ApiModel->checkChaperoneTrip($chaperone_id);
        $chaperoneTripData = $this->CommonModel->checkChaperoneTripAvailable($chaperone_id);
        // print_r($chaperoneTripData);die;
        if($chaperoneTripData){
            if(empty($chaperoneTripData->save_trip_date)){
                $save_trip_date ="";
            }else{
                $save_trip_date = date("d.m.Y", strtotime($chaperoneTripData->save_trip_date));
            }
            
        	$data['trip_id'] 		= 	 $this->check_value($chaperoneTripData->trip_id);
        	$data['trip_number'] 		= 	 $this->check_value($chaperoneTripData->tridID);
        	$data['bus_number'] 		= 	 $this->check_value($chaperoneTripData->bus_number);
        	$data['driver_name'] 		= 	 $this->check_value($chaperoneTripData->driver_name);
        	$data['drive_mobile_number'] 		= 	 $this->check_value($chaperoneTripData->drive_mobile_number);
        	$data['chaperone_name'] 		= 	 $this->check_value($chaperoneTripData->chaperone_name);
        	$data['chaperone_phone'] 		= 	 $this->check_value($chaperoneTripData->chaperone_phone);
        // 	$data['client_user_name'] 		= 	 $this->check_value($chaperoneTripData->client_user_name);
        // 	$data['client_name'] 		= 	 $this->check_value($chaperoneTripData->client_name);
        // 	$data['client_logo_image'] 		= 	 $this->check_value(base_url().'uploads/client/'.$chaperoneTripData->client_logo_image);
        	$data['pickup_address'] 		= 	 $this->check_value($chaperoneTripData->pickup_address);
        	$data['pickup_latitude'] 		= 	 $this->check_value($chaperoneTripData->pickup_latitude);
        	$data['pickup_longitude'] 		= 	 $this->check_value($chaperoneTripData->pickup_longitude);
        	$data['drop_address'] 		= 	 $this->check_value($chaperoneTripData->drop_address);
        	$data['drop_latitude'] 		= 	 $this->check_value($chaperoneTripData->drop_latitude);
        	$data['drop_longitude'] 		= 	 $this->check_value($chaperoneTripData->drop_longitude);
        	$data['trip_start'] 		= 	 $this->check_value($chaperoneTripData->trip_start);
        	$data['trip_end'] 		= 	 $this->check_value($chaperoneTripData->trip_end);
        	$data['status'] 		= 	 $this->check_value($chaperoneTripData->status);
        	$data['complete_status'] 		= 	 $this->check_value($chaperoneTripData->complete_status);
        	$data['date'] 		= 	$save_trip_date;
        	$msg = "Chaperone Trip";
        // 	$arr['chaperone_trip'] = $chaperoneTrip;
        }else{
            $msg = "Currently you don't have any assigned Trip please wait for admin to assign a new trip to you";
            // $data = array(); 
            $data = null; 
        }
        
        // $arr = $dataText;
        
        return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			// 'count' 	=> $totalTip,
			'object'	=> $data
		));
            
	}
	
	public function tripStartStop_post()
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
        
        // $this->form_validation->set_rules('source_location', 'Source Location', 'required');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     return $this->response(array(
        //         'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        //         'message' 	=> validation_errors(),
        //         'Data'	=> new stdClass()
        //     ));
        // }
        // $this->form_validation->set_rules('destination_location', 'destination location', 'required');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     return $this->response(array(
        //         'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        //         'message' 	=> validation_errors(),
        //         'Data'	=> new stdClass()
        //     ));
        // }
        
        // $source_location = $this->input->post('source_location');
        // $destintion_location = $this->input->post('destination_location');
        
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
        
        $this->form_validation->set_rules('status', 'status', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $trip_id	        =   $this->input->post('trip_id'); 
        $complete_status	=   $this->input->post('status'); 
        $latitude	=   $this->input->post('latitude'); 
        $longitude	=   $this->input->post('longitude'); 
        
        $whereTrip = array("id" =>  $trip_id,);
		$tripDetail = $this->CommonModel->selectRowDataByCondition($whereTrip,'trip');
		
		
		if(empty($tripDetail))
		{
		    return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'No trip found',
				'object'	=> new stdClass()
			));
		}
		
		$whereTripParents = array(
		    "trip_id" =>  $trip_id,
		    "pickup_latitude !=" =>  "",
		    "pickup_longitude !=" =>  "",
		
		);
		$getParentsTrip = $this->CommonModel->selectResultDataByCondition($whereTripParents,'trip_add_parents');
		
	
        
		if(empty($getParentsTrip)){
		    return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Parents not add pickup address',
				'Data'	=> null
			));
		}
		
		$sizeParentsTrip = sizeof($getParentsTrip);
        
        
        if($sizeParentsTrip < 1)
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Parents not add pickup address',
				'Data'	=> null
			));
            
        }
        // echo 1; die;
        
        
        
		if($complete_status == 1){
			$status 	=  1;
		}else{
		    $status 	=  2;
		}
		
		if($complete_status == 1){
			 $dataAddress = array(
            	"pickup_latitude" 	=>  $latitude,
            	"pickup_longitude" 	=>  $longitude,
            );
    		
    		$updateAddData = $this->db->where('id',$trip_id)->update('trip', $dataAddress);
		}else{
             $dataAddress = array(
            	"drop_latitude" 	=>  $latitude,
            	"drop_longitude" 	=>  $longitude,
            );
    		
    		$updateAddData = $this->db->where('id',$trip_id)->update('trip', $dataAddress);
		}
			
        $data = array(
        	"complete_status" 	=>  $complete_status,
        	"status" 	        =>  $status,
        );
		
		$updateData = $this->db->where('id',$trip_id)->update('trip', $data);
        
        if($updateData)
		{
		  //   $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.urlencode($source_location).'&destinations='.urlencode($destintion_location).'&key=AIzaSyAzhCZWT6VcpxKA9oQ1iaZ1fyKHNkFcsGg');
    //           $distance_arr = json_decode($distance_data);
    
    
            foreach($getParentsTrip as $p)
            {
                $parentId = $p['parents_id'];
    
                $type = 1;
                $getParentsDetail = $this->CommonModel->selectRowDataByCondition( array('id' => $p['parents_id']),'parents');
                
                $parentdNotification = $getParentsDetail->notification_id;
                
                $parentdeviceType = $getParentsDetail->device_type;
                $parentdeviceId = $getParentsDetail->device_id;
                
                $timeData = $this->ApiModel->getParentsNotificationData($type,$parentId);
            
                $checked_arr = explode(",",$parentdNotification);
    
                if(in_array("1", $checked_arr))
                {
                    if($complete_status == 1)
                    {
    
                        $chaperoneWhere = array('id' => $tripDetail->chaperone_id);
                        $data = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone');
    
                        $message    =  $tripDetail->trip_id .' trip started';
                        $title  = 'Trip start';
                        $notification = 'Trip start';
    
                        //send notification to vendor
                        if ($parentdeviceType != '' || !empty($parentdeviceType)) 
                        {
                            if(strtolower($parentdeviceType) == 'ios')
                            {
                                $message_arr = array(
                                    'title'     =>  $title,
                                    'message'   =>  $message, 
                                    "alert"     =>  $title, 
                                    'sound'     =>  'default',
                                    'subject'   =>  'P',
                                    'type'      =>  '2',
                                    'id'        =>  $tripDetail->trip_id,
                                    'device_id' =>  $parentdeviceId
                                );
    
                                $send_notification = $this->_sendiOSNotification($message_arr);
    
                            }else{
                                $values = array( 
                                    'title'     =>  $title,
                                    'message'   =>  $message,
                                    'id'        =>  $tripDetail->trip_id,
                                    'subject'   =>  'P',
                                    'type'      =>  '2',
                                    'device_id' =>  $parentdeviceId
    
                                );
                                $send_notification=$this->_sendAndroidNotification($values);
                            }
                        }
    
                        $insArr1 = array(
                            "from_id"     => $tripDetail->chaperone_id,
                            "to_id"       => $parentId,
                            "title"       => $title,
                            "message"     => $message,
                            "msg_for"     => $title,
                            "is_read"     => '4',
                        );
                        $resArr = $this->CommonModel->insertData($insArr1,'notification_list');
                    }
                }
            }

            
		    if($complete_status == 1){
				$msg 	=  'Your trip start successfully';
			}else{
				$msg 	=  'Your trip stop successfully';
			}

			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> $msg,
				// 'object'	=> $distance_arr
			));
		}else
		{
			return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Somethings went wrong',
				// 'object'	=> new stdClass()
			));
		}
		
        
        
	}
	
	

	
}