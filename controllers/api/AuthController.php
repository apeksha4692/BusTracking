<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class AuthController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'form_validation' );
		$this->load->language( 'english' );
		$this->form_validation->set_error_delimiters('', '');
	}
	
	public function signup1_post()
	{
// 	    $this->form_validation->set_rules('type', 'Type', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {
//         	return $this->response(array(
// 				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
// 				'message' 	=> validation_errors(),
// 				'Data'	=> new stdClass()
// 			));
            
//         }
        
        $this->form_validation->set_rules('secret_code', 'Secret Code', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
            
        }
        
        $this->form_validation->set_rules('device_type', 'Device Type', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
        }
        
        $this->form_validation->set_rules('device_id', 'Device Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'Data '	=> new stdClass()
			));
        }
        
        $type           = $this->input->post('type');
        $secret_code    = $this->input->post('secret_code');
        
        if($type == 1){
            $chaperoneWhere = array('secret_code' => $secret_code);
            $data = $this->CommonModel->selectRowDataByCondition($chaperoneWhere,'chaperone'); 
        }else{
            $parentsWhere = array('secret_code' => $secret_code);  
            $data = $this->CommonModel->selectRowDataByCondition($parentsWhere,'parents');
        }
        
        if(empty($data))
        {
            return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> 'Incorrect secret code',
				'Data '	=> new stdClass()
			));
        }
        
        $condition = array('id' => $data->id);
        $updateData = array(
		            "device_type"	=> $this->input->post('device_type'),
					"device_id" 	=> $this->input->post('device_id'),
					"updated_at" 	=> date('Y-m-d H:i:s')
				);
        
        if($type == 1)
        {
            $chaperoneUpdate  = $this->CommonModel->updateRowByCondition($condition,'chaperone',$updateData);
          
            if($chaperoneUpdate)
            {
                $chaperone_id = $data->id;
                $chaperoneDetails = $this->CommonModel->chaperoneDetail($chaperone_id);
    
                $dataDetail['chaperone_id'] 	    = 	$chaperoneDetails->chaperone_id;
                $dataDetail['child_image'] 		    =  $this->check_value(base_url().'uploads/chaperone/default.png');
				$dataDetail['chaperone_name']     = 	$this->check_value($chaperoneDetails->chaperone_name);
				$dataDetail['phone_number'] 	    = 	$this->check_value($chaperoneDetails->phone_number);
				$dataDetail['secret_code'] 	    = 	$this->check_value($chaperoneDetails->secret_code);
				$dataDetail['school_name'] 	    = 	$this->check_value($chaperoneDetails->client_name);
				$dataDetail['school_employee_name']   = 	$this->check_value($chaperoneDetails->username);
				$dataDetail['school_logo']        =   base_url().'uploads/client/'.$chaperoneDetails->logo_image;
				$dataDetail['device_id'] 	 	    = 	$this->check_value($chaperoneDetails->device_id);
				$dataDetail['device_type'] 	 	= 	$this->check_value($chaperoneDetails->device_type);
				
				
				// print_r($dataDetail);die;
				return $this->response(array(
						'status'	=> REST_Controller::HTTP_OK,
						'message' 	=> 'Login successfully',
					   	'Data'	=> $dataDetail
					));
            }else{
				return $this->response(array(
					'status'	=> REST_Controller::HTTP_BAD_REQUEST,
					'message' 	=> 'Data not updated',
					'Data'	=> new stdClass()
				));
            }
             
        }else{
            $parentsUpdate  = $this->CommonModel->updateRowByCondition($condition,'parents',$updateData);

            if($parentsUpdate)
            {
                $parent_id = $data->id; 
                $parentsDetails = $this->CommonModel->parentsDetail($parent_id);
                
                $dataDetail['parents_id'] 	    = 	$this->check_value($parentsDetails->parents_id);
				$dataDetail['parents_name']     = 	$this->check_value($parentsDetails->parents_name);
				$dataDetail['phone_number'] 	    = 	$this->check_value($parentsDetails->phone_number);
				$dataDetail['secret_code'] 	    = 	$this->check_value($parentsDetails->secret_code);
				$dataDetail['school_name'] 	    = 	$this->check_value($parentsDetails->client_name);
				$dataDetail['school_employee_name']   = 	$this->check_value($parentsDetails->client_user_name);
				$dataDetail['school_logo']        =   base_url().'uploads/client/'.$parentsDetails->logo_image;
				$dataDetail['device_id'] 	 	    = 	$this->check_value($parentsDetails->device_id);
				$dataDetail['device_type'] 	 	= 	$this->check_value($parentsDetails->device_type);
				
				
				
				
				return $this->response(array(
						'status'	=> REST_Controller::HTTP_OK,
						'message' 	=> 'Login successfully',
					   	'Data'	=> $dataDetail
					));
            }else{
				return $this->response(array(
					'status'	=> REST_Controller::HTTP_BAD_REQUEST,
					'message' 	=> 'Data not updated',
					'Data'	=> new stdClass()
				));
            }
        }
	}
	
	public function signup_post()
    {
        $this->form_validation->set_rules('secret_code', 'Secret Code', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
        		'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        		'message' 	=> validation_errors(),
        		'Data '	=> new stdClass()
        	));
            
        }
    
        $this->form_validation->set_rules('device_type', 'Device Type', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
        		'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        		'message' 	=> validation_errors(),
        		'Data '	=> new stdClass()
        	));
        }
    
        $this->form_validation->set_rules('device_id', 'Device Id', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
        		'status'	=> REST_Controller::HTTP_BAD_REQUEST,
        		'message' 	=> validation_errors(),
        		'Data '	=> new stdClass()
        	));
        }
    
        $secret_code    = $this->input->post('secret_code');
    
        $where = array('secret_code' => $secret_code);
    
        $chaperoneData = $this->CommonModel->selectRowDataByCondition($where,'chaperone');
    
        $parentsData = $this->CommonModel->selectRowDataByCondition($where,'parents');
    
        $updateData = array(
            "device_type"   => $this->input->post('device_type'),
            "device_id"     => $this->input->post('device_id'),
            "updated_at"    => date('Y-m-d H:i:s')
        );
    
        if($chaperoneData)
        {
            $whereChaperone = array('id' => $chaperoneData->id);
            $chaperoneUpdate  = $this->CommonModel->updateRowByCondition($whereChaperone,'chaperone',$updateData);
    
            if($chaperoneUpdate)
            {
                $chaperone_id = $chaperoneData->id;
                $chaperoneDetails = $this->CommonModel->chaperoneDetail($chaperone_id);
    
                $dataDetail['user_type']         =   1;
                $dataDetail['chaperone_id']      =   $chaperoneDetails->chaperone_id;
                $dataDetail['child_image']       =  $this->check_value(base_url().'uploads/chaperone/default.png');
                $dataDetail['chaperone_name']    =     $this->check_value($chaperoneDetails->chaperone_name);
                $dataDetail['phone_number']      =   $this->check_value($chaperoneDetails->phone_number);
                $dataDetail['secret_code']       =   $this->check_value($chaperoneDetails->secret_code);
                $dataDetail['school_name']       =   $this->check_value($chaperoneDetails->client_name);
                $dataDetail['school_employee_name']   =     $this->check_value($chaperoneDetails->username);
                $dataDetail['school_logo']        =   base_url().'uploads/client/'.$chaperoneDetails->logo_image;
                $dataDetail['device_id']          =   $this->check_value($chaperoneDetails->device_id);
                $dataDetail['device_type']        =   $this->check_value($chaperoneDetails->device_type);
                
                
                // print_r($dataDetail);die;
                return $this->response(array(
                        'status'    => REST_Controller::HTTP_OK,
                        'message'   => 'Login successfully',
                        'Data'  => $dataDetail
                    ));
            }else{
                return $this->response(array(
                    'status'    => REST_Controller::HTTP_BAD_REQUEST,
                    'message'   => 'Data not updated',
                    'Data'  => new stdClass()
                ));
            }
    
        }else if($parentsData)
        {
            $condition = array('id' => $parentsData->id);
            $parents  = $this->CommonModel->updateRowByCondition($condition,'parents',$updateData);
    
            if($parents)
            {
                $parent_id = $parentsData->id; 
                $parentsDetails = $this->CommonModel->parentsDetail($parent_id);
                
                $dataDetail['user_type']         =   2;
                $dataDetail['parents_id']       =   $this->check_value($parentsDetails->parents_id);
                $dataDetail['parents_name']     =   $this->check_value($parentsDetails->parents_name);
                $dataDetail['phone_number']         =   $this->check_value($parentsDetails->phone_number);
                $dataDetail['secret_code']      =   $this->check_value($parentsDetails->secret_code);
                $dataDetail['school_name']      =   $this->check_value($parentsDetails->client_name);
                $dataDetail['school_employee_name']   =     $this->check_value($parentsDetails->client_user_name);
                $dataDetail['school_logo']        =   base_url().'uploads/client/'.$parentsDetails->logo_image;
                $dataDetail['device_id']            =   $this->check_value($parentsDetails->device_id);
                $dataDetail['device_type']      =   $this->check_value($parentsDetails->device_type);
                
                return $this->response(array(
                        'status'    => REST_Controller::HTTP_OK,
                        'message'   => 'Login successfully',
                        'Data'  => $dataDetail
                    ));
            }else{
                return $this->response(array(
                    'status'    => REST_Controller::HTTP_BAD_REQUEST,
                    'message'   => 'Data not updated',
                    'Data'  => new stdClass()
                ));
            }
        }
        else
        {
            return $this->response(array(
                'status'    => REST_Controller::HTTP_BAD_REQUEST,
                'message'   => 'Incorrect secret code',
                'Data ' => new stdClass()
            ));
        }
    }
}