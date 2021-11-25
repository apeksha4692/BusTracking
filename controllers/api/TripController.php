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
	
	public function tripDetail_post()
	{
	   // echo "hi";die;
	    
	   // $lang = $this->input->post('lang');
	   // $check_langauge = $this->switchLang($lang);
	   // print_r($check_langauge);
// 	    echo "<br>";
// 	     $this->response(array(
// 				'status'	=> REST_Controller::HTTP_UNAUTHORIZED,
// 				'message' 	=> $this->lang->line('checking'),
// 				'object'	=> new stdClass()
// 			));
// // 	     echo "<br>";
	    $this->form_validation->set_rules('email_id', 'lang:checking', 'required');
	   // $this->form_validation->set_rules('email_id',$this->lang->line('checking'), 'required');
	   // lang:pseudo
        if ($this->form_validation->run() == FALSE)
        {
        	return $this->response(array(
				'status'	=> REST_Controller::HTTP_BAD_REQUEST,
				'message' 	=> validation_errors(),
				'object'	=> new stdClass()
			));
            
        } 
	}
	
	public function check_language_post(){
	    echo 1;
	}
}