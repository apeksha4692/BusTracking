<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class AccountController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function logout_post()
	{
	   // $lang = $this->input->post('lang');
	   // $check_langauge = $this->switchLang($lang);
	
	    $this->form_validation->set_rules('type','Type','required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'object'	=> new stdClass()
			));
            
        }
        
        $this->form_validation->set_rules('user_id','User Id','required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'object'	=> new stdClass()
			));
            
        }
	    
	    $type           = $this->input->post('type');
        $id    = $this->input->post('user_id');
        if($type == 1){
            $chaperoneWhere = array('id' => $id);
            $data = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
        }else{
            $parentsWhere = array('id' => $id); 
            $data = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
        }
	    
	    if(empty($data))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'No User Found',
				'Data '	=> new stdClass()
			));
        }
        
         $condition = array('id' => $data->id);
         $updateData = array(
	        	"device_type"  => '',
	        	"device_id" 	=> ''
	        );
	   
        if($type == 1)
        {
            $chaperoneUpdate  = $this->CommonModel->updateRowByCondition($condition,'chaperone',$updateData);
            if ($chaperoneUpdate) {
            return $this->response(array(
    				'status'	=> REST_Controller::HTTP_OK,
    				'message' 	=> 'Logout Successfully',
    				'object'	=> new stdClass()
    			));
            }else{
                return $this->response(array(
    				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
    				'message' 	=> 'Logout',
    				'object'	=> new stdClass()
    			));
            }
            
        }else{
            $parentsUpdate  = $this->CommonModel->updateRowByCondition($condition,'parents',$updateData);
            if ($parentsUpdate) {
            return $this->response(array(
    				'status'	=> REST_Controller::HTTP_OK,
    				'message' 	=> 'Logout Successfully',
    				'object'	=> new stdClass()
    			));
            }else{
                return $this->response(array(
    				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
    				'message' 	=> 'Logout',
    				'object'	=> new stdClass()
    			));
            }
        }
	}
}