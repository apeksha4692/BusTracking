<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class NotificationController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function notification_list_post()
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
        
        $parentId = $parentsData->id;
        $type = 1;
//         $timeWhere = array(
// 			"status" => 1,
// 			"type"  => 1,
// 			"parents_id" => 0,
// 			"parents_id" => $parentId,
			
// 		);

// 		$timeData = $this->CommonModel->selectResultDataByCondition($timeWhere,'parents_notificatio');
		
// 		SELECT * FROM `parents_notification` WHERE (`parents_id`= 0 AND `type`=2) OR (`parents_id`=108 AND `type`!=1)

		$timeData = $this->ApiModel->getParentsNotificationData($type,$parentId);
	    
	    $parentsNotification = $parentsData->notification_id;
	    $checked_arr = explode(",",$parentsNotification);
	    
        if($timeData)
        {
        	foreach ($timeData as $key => $value) 
        	{
        	    $id = $value['id'];
        	    $status = in_array($id, $checked_arr);
        	    
        	    if(empty($status)){
        	        $status = 0;
        	    }else{
        	        $status = 1;
        	    }
        	   // print_r($status);
        	    
        		$time[] = array(
					'id' 	    =>  $value['id'],
					'name' 		=>  $value['name'],
					'isChecked' =>  $status
				);
        	}
        	$arr['time'] = $time;
        }else
        {
			$arr['time'] = array();
        }
        
//         $distanceWhere = array(
// 			"status" => 1,
// 			"type"  => 2,
// 			"parents_id" => 0,
// 			"parents_id" => $parentId,
			
// 		);
       
// 		$distanceData = $this->CommonModel->selectResultDataByCondition($distanceWhere,'parents_notification');

        $type = 2;
		$distanceData = $this->ApiModel->getParentsNotificationData($type,$parentId);
        if($distanceData)
        {
        	foreach ($distanceData as $key => $value) 
        	{
        	    $id = $value['id'];
        	    $status = in_array($id, $checked_arr);
        	    
        	    if(empty($status)){
        	        $status = 0;
        	    }else{
        	        $status = 1;
        	    }
        	    
        		$distance[] = array(
					'id' 	    =>  $value['id'],
					'name' 		=>  $value['name'],
					'isChecked' =>  $status
				);
        	}
        	$arr['distance'] = $distance;
        }else
        {
			$arr['time'] = array();
        }
        
		return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> 'All Setup Notification List',
			'output'	=> $arr
		));

	}
	
	public function setupNotifiication_post()
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
        
        // print_r($parentsData->notification_id);die;
        $parentId = $parentsData->id;
        
        $this->form_validation->set_rules('notification_id', 'Notification Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $notification_id = $this->input->post('notification_id');
        
        // $notificationList = implode(', ', $notification_id); 
        
        // print_r($parentsData->notification_id);die;
        
        if(empty($parentsData->notification_id))
        {
            $notificationList = $notification_id;
        }else
        {
            $parentsnofication = explode(",",$parentsData->notification_id);
            $notifi_id = array($notification_id);
            
            // $result=array_diff($parentsnofication,$notifi_id);
            $result=array_intersect($parentsnofication,$notifi_id);
            
            if(empty($result))
            {
                // echo 0;
                $a=array($parentsData->notification_id);
                array_push($a,$notification_id);
                $notificationList = implode(',', $a);
                // print_r($notificationList);
            }else{
                // echo 1;
                $uncheck_id =array_diff($parentsnofication,$notifi_id);
                $notificationList = implode(',', $uncheck_id);
                // print_r($uncheck_id);
            }
            // print_r($notificationList);
            
            // $a=array($parentsData->notification_id);
            // array_push($a,$notification_id);
            // $notificationList = implode(', ', $a);
        }
        
        //  print_r($notificationList);
        // die;
    
        $data = array(
                'notification_id' => $notificationList, 
        );
        
        $updateNotificationData = $this->CommonModel->updateRowByCondition($parentsWhere,'parents',$data); 
        
        
        if($updateNotificationData){
            return $this->response(array(
					'status'	=> REST_Controller::HTTP_OK,
					'message' 	=> 'You setup notification successfully',
				));
            
        }else{
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Something went wrong',
			));
        }
        
        


	}
	
	
	public function addNotification_post()
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
        
        $this->form_validation->set_rules('notification_type', 'Notification Type', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        $this->form_validation->set_rules('value', 'Notification Value', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data'	=> new stdClass()
			));
        }
        
        // print_r($_POST);die;
        
        $parentId = $parentsData->id;
        $notification_type = $this->input->post('notification_type');
        $value = $this->input->post('value');
        
        $data = array(
                'type' => $notification_type,
                'parents_id' => $parentId,
                'value' => $value,
                'name' => $value.' untill arrival',
                'status' => 1,
            );
            
	    $insertData = $this->CommonModel->insertData($data,'parents_notification'); 
	    
	    if($insertData)
	    {
            	    
	        $last_id 		= $this->db->insert_id();
			$fetchCondition = array(
				"id" 	=> $last_id
			);
			$result = $this->CommonModel->selectRowDataByCondition($fetchCondition,'parents_notification');
			
			$parentsNotification = $parentsData->notification_id;
    	    $checked_arr = explode(",",$parentsNotification);
    	    $status = in_array($last_id, $checked_arr);
    	    
    	    if(empty($status)){
    	        $status = 0;
    	    }else{
    	        $status = 1;
    	    }
    	    
			$notificationData['id'] = $result->id;
			$notificationData['notification_type'] = $result->type;
			$notificationData['parents_id'] = $result->parents_id;
			$notificationData['name'] = $result->name;
			$notificationData['isChecked'] = $status;
			
	        return $this->response(array(
				'status'	=> REST_Controller::HTTP_OK,
				'message' 	=> 'Custom notifcation added successfully',
				
				// 'object'	=> $notificationData
			));
	    }else{
	        return $this->response(array(
					'status'	=> REST_Controller::HTTP_BAD_REQUEST,
					'message' 	=> 'Somethings went wrong',
					'object'	=> new stdClass()
				));
	    }
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	}
}