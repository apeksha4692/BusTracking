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
	    $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
            
        }
        
        $this->form_validation->set_rules('id', 'User Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
            
        }
        
        $type           = $this->input->post('type');
        $id    = $this->input->post('user_id');
        
        if($type == 1){
            $chaperoneWhere = array('id' => $id);
            $data = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
            
            $condition = "(app_user= 'all' or app_user= 'chaperone')";
        }else{
            $parentsWhere = array('id' => $id); 
            $data = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
            
            $condition = "(app_user= 'all' or app_user= 'parent')";
        }
        
        //  $condition = "(focal_point_email='".$client_focal_email."' or focal_point_number=".$client_focal_number.")";
        
        $notification_list = $this->CommonModel->selectResultDataByCondition($condition,'notifcation');
        
        
        // print_r($notification_list);die;
        
        if(!empty($notification_list))
		{

			foreach ($notification_list as $key => $value) 
			{
			    if($value['platform'] == 'all'){
			        $platform = 'android and ios';
			    }else if($value['platform'] == 'android'){
			        $platform = 'android';
			    }else{
			        $platform = 'ios';
			    }
			   
				$dataText[] = array(
					'notification_id' 			=>  $this->check_value($value['id']),
					'platform' 			=>  $this->check_value($value['platform']),
					'msg' 			=>  $this->check_value($value['msg']),
					'version' 			=>  $this->check_value($value['version']),
					'message' 			=>  'Admin update new application with '.$value['version'].' version in '.$platform,				);
			}
			$msg = 'All Notification List';
		}else
		{
			$dataText = 'null';
			$msg = 'No Notification Found';
		}

		$arr = $dataText;

		return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			'Output'	=> $arr
		));
        
        
	}
	
	public function notificationList_post()
	{
	    $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
            
        }
        
        $this->form_validation->set_rules('id', 'User Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
            
        }
        
        $type           = $this->input->post('type');
        $id    = $this->input->post('id');
        

        $notification_list = $this->CommonModel->selectResultDataByCondition(array('to_id' => $id),'notification_list');
        
        if(!empty($notification_list))
		{
			foreach ($notification_list as $key => $value) 
			{

				$dataText[] = array(
					'notification_id' 	=>  $this->check_value($value['id']),
					'from_id' 	=>  $this->check_value($value['from_id']),
					'to_id' 	=>  $this->check_value($value['to_id']),
					'title' 			=>  $this->check_value($value['title']),
					'msg' 				=>  $this->check_value($value['message']),
					'msg_for' 			=>  $this->check_value($value['msg_for']),
				);

			}
			$msg = 'All Notification List';
		}else
		{
			$dataText = 'null';
			$msg = 'No Notification Found';
		}

		$arr = $dataText;

		return $this->response(array(
			'status'	=> REST_Controller::HTTP_OK,
			'message' 	=> $msg,
			'Output'	=> $arr
		));
        
        
	}
	
	
	
	
	
	
	
	
	
	
	
}