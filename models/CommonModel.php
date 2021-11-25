<?php
class CommonModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->library( 'Utility' );
	}

	//fetch all data api
	public function selectResultData($table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		return $this->db->get()->result_array();
	}

	//select all data asc
	public function selectAllResultData($table)
	{
		$this->db->select('*')
		->from($table);
		return $this->db->get()->result_array();
	}

	public function countData($table)
	{
		return $this->db->count_all_results($table);
	}
	public function countDataWithCondition($table,$condition)
	{
		return $this->db->where($condition)->from($table)->count_all_results();
	}
	public function totalColumnSumWithCondition($table,$condition,$param)
	{
		$this->db->select('SUM('.$param.') as rate');
        $this->db->from($table);
        $result = $this->db->get()->row();
        // return $this->db->last_query();
        return $result;
	}

	//check condition api
	public function selectRowDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->row();
	}
	//check condition api
	public function selectRowDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		$this->db->order_by($fieldName, "desc")->limit(1);
		return $this->db->get()->row();
	}
	//check api
	public function selectRowDatabyFieldName($table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc")->limit(1);
		return $this->db->get()->row();
	}
	//get all data with where condition api
	public function selectResultDataByCondition($condition,$table)
	{
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	public function selectResultDataByCondition1($condition,$table)
	{
		// print_r($condition);
		$this->db->select('*')
		->from($table);
		$this->db->where($condition);
		$data = $this->db->get();
		// print_r($data);
		if (!empty($data->result_array())) {
			return $data->result_array();
		}
	}
	
	//get all data with where condition api
	public function selectResultDataByConditionAndFieldName($condition,$table,$fieldName)
	{
		$this->db->select('*')
		->from($table);
		$this->db->order_by($fieldName, "desc");
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	//insert api
	public function insertData($data,$table)
	{
		$result = $this->db->insert($table, $data);
		if( $result != FALSE )
		{
			return $data;
		}
		else
		{
			return FALSE;
		} 	
	}

	//update condition api
	public function updateRowByCondition($condition,$table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data , $condition);
	}
	//update condition api
	public function updateRow($table,$data)
	{  
		//echo $this->email->print_debugger();
		return $this->db->update($table, $data);
	}

	public function update_entry($table,$data,$where)
	{
	    $this->db->where($where);
	    $query = $this->db->update($table,$data);
	    return $this->db->affected_rows();
	}
	
   public function sendMail1($data)
   {
   	// print_r($data);exit;
   	    $this->email->initialize(array(
			'protocol' 	=> 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_user' => 'neeteshagrawal',
			'smtp_pass' => 'neetesh@12345',
			'smtp_port' => 587,
			'crlf' 		=> "\r\n",
			'mailtype' 	=> "html",
			'charset' 	=> "iso-8859-1",
			'newline' 	=> "\r\n"
		));

		$this->email->from('info@pueodj.com', 'Pueo Dj');
		$this->email->to($data['to']);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		if($this->email->send())
		{
			return 1;
		}else{
			return 0;
		}
   	}


   	public function sendMail($to,$subject,$message,$options = array())
    {
    	// print_r($to);die;
        $this->load->library('email');
        $config = array (
		        'mailtype' => 'html',
		        'charset'  => 'utf-8',
		        'priority' => '1'
	      	);

        $this->email->initialize($config);
		if (isset($options['fromEmail']) && isset($options['fromName'])) 
		{
			$this->email->from($options['fromEmail'], $options['fromName']);  
		}
		else
		{
			$this->email->from('info@sliceledger.com', 'DJ');         
        }

		$this->email->to($to);

		if(isset($options['replyToEmail']) && isset($options['replyToName']))
		{
			$this->email->reply_to($options['replyToEmail'],$options['replyToName']);
		}

	    $this->email->subject($subject);
	    $this->email->message($message);

     // echo $message;die();

        if($this->email->send())
        {
            return true;
        }else
        {
            return false;
        }
    } 
	//delete api
	public function delete($condition,$table)
	{
		$this->db->where($condition);
		return $this->db->delete($table);
	}

	
	public function adminData($data)
    {
    	// print_r($data);die;
        // $AdminData = $this->db->select('*')
        //             ->from('admin')
        //             ->where(
        //                 array(
        //                     // 'email' 	  	 	=> ($data['email']),
        //                     'username' 	  	 	=> ($data['username']),
        //                     'password' 		 	=> md5($data['password']),
        //                     'orginal_password' 	=> $data['password'],
        //                 ))
        //             ->get()->row();
                    
         $this->db->select("*")->from('admin')->where(array(
                            'password' 		 	=> md5($data['password']),
                            'orginal_password' 	=> $data['password'],
                        ));
                        
		 $where = '(email="'.$data['username'].'" or username = "'.$data['username'].'")';
		 
          return  $this->db->where($where)->get()->row();
            
    // 	return $AdminData;   
    }

    public function getsingle($table,$where)
     {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->row();
         
        $num = $data->num_rows();
        
        if($num)
        {
          return $get;
        }
        else
        {
          return false;
        }
    }
    public function select_single_row($sql)
    {
        $res= $this->db->query($sql);
        return $res->row();
    }
	
   	public function getClientUser()
   	{
   		$this->db->select("client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name")
    		->from('client_user')
		    ->join('client','client.id = client_user.client_id','left')
		    ->order_by("client_user.id", "desc");
		
		return $this->db->get()->result_array();
   	}

   	public function getClientUserDetail($client_user_id){

   		$this->db->select("client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name")
    		->from('client_user')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("client_user.id" => $client_user_id));

   		return $this->db->get()->row();


   	}


   	public function subadminData($data)
    {
        // $SubAdminData = $this->db->select('*')
        //             ->from('client_user')
        //             ->where(
        //                 array(
        //                     'login_username' 	=> ($data['login_username']),
        //                     'login_password' 	=> $data['login_password'],
        //                     // 'is_delete'   => 0
        //                 ))
        //             ->get()->row();
         $SubAdminData = $this->db->select('client_user.*,,client.client_name')
                    ->from('client_user')
                    ->join('client','client.id = client_user.client_id','left')
                    ->where(
                        array(
                            'login_username' 	=> ($data['login_username']),
                            'login_password' 	=> $data['login_password'],
                            // 'is_delete'   => 0
                        ))
                    ->get()->row();
    	return $SubAdminData;   
    }

    public function subadminDetail($client_user_id){
    	$this->db->select("client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name,client.logo_image,client.max_chaperone,client.max_parent")
    		->from('client_user')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("client_user.id" => $client_user_id));

   		return $this->db->get()->row();
    }

    public function getClientUserByClient($client_id)
   	{
   		
//   		$this->db->select("client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name")
//     		->from('client_use')
// 		    ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		  //   $this->db->where(array("client_user.client_id" => $client_id));
// 		     $this->db->where_in('client_user.id',$client_id);
// 		 }
// 		    $this->db->order_by("client_user.client_id", "desc");
		
// 		return $this->db->get()->result_array();
		
		if($client_id != 0){
		    $query = 'SELECT client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name FROM client_user LEFT JOIN client ON client.id = client_user.client_id where client_user.client_id in('.$client_id.') ORDER BY `client_user`.`client_id` DESC';
		}else{
		     $query = 'SELECT client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name FROM client_user LEFT JOIN client ON client.id = client_user.client_id ORDER BY `client_user`.`client_id` DESC';
		}
		
// 		$query = 'SELECT * FROM bus where id in('.$ids.')';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	
   	public function driverData($client_user)
   	{
   		$this->db->select("driver.id as driver_id,driver.drive_mobile_number,driver.client_user_id,driver.driver_unique_id,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number")
    		->from('driver')
		    ->join('bus','bus.id = driver.bus_id','left')
		    ->where(array("driver.client_user_id" => $client_user))
		    ->order_by("driver.id", "desc");
		
		return $this->db->get()->result_array();
   	}

   	public function chaperoneData($client_user)
   	{
   		$this->db->select("chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,chaperone.phone_number")
    		->from('chaperone')
		    ->join('bus','bus.id = chaperone.bus_id','left')
		    ->where(array("chaperone.client_user_id" => $client_user))
		    ->order_by("chaperone.id", "desc");
		
		return $this->db->get()->result_array();
   	}

   /*	public function parentsData($client_user)
   	{
   		$this->db->select("parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id")
    		->from('parents')
		    ->join('bus','bus.id = parents.bus_id','left')
		    ->where(array("parents.client_user_id" => $client_user))
		    ->order_by("parents.id", "desc");
		
		return $this->db->get()->result_array();
   	}*/
   	
   	 public function parentsData($client_user)
   	{
   		$this->db->select("parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,bus.bus_number")
    		->from('parents')
		    ->join('bus','bus.id = parents.bus_id','left')
		    ->where(array("parents.client_user_id" => $client_user))
		    ->order_by("parents.id", "desc");
		
		return $this->db->get()->result_array();
   	}

   	public function getBusAvaiable($client_user_id)
   	{
   		// SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM driver d WHERE d.bus_id = b.id) AND `b`.`client_user_id` = '2'


   			$query = 'SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM driver d WHERE d.bus_id = b.id) AND  `b`.`client_user_id` ='.$client_user_id.'';
        	$query = $this->db->query($query);

			return $query->result_array();
   	}
   	
   	public function chaperoneDataReport()
   	{
   		$this->db->select("chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,client.client_name,client_user.id as client_user_id")
    		->from('chaperone')
		    ->join('bus','bus.id = chaperone.bus_id','left')
		     ->join('client_user','client_user.id = chaperone.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    // ->where(array("chaperone.client_user_id" => $client_user))
		    ->order_by("chaperone.id", "desc");
		
		return $this->db->get()->result_array();
   	}


   	public function chaperoneDetail($chaperone_id)
   	{	
   		$this->db->select("chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,client.client_name,client_user.id as client_user_id,client_user.client_id,client_user.username,client.logo_image,chaperone.device_id,chaperone.device_type")
    		->from('chaperone')
		    ->join('bus','bus.id = chaperone.bus_id','left')
		     ->join('client_user','client_user.id = chaperone.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->where(array("chaperone.id" => $chaperone_id));
		    // ->order_by("chaperone.id", "desc");

   		return $this->db->get()->row();

   	}

   	public function chaperoneDataReportByClient($client_id)
   	{
   		// print_r($client_id);die;
   		
//   		$this->db->select("chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,client.client_name,client_user.id as client_user_id")
//     		->from('chaperone')
// 		    ->join('bus','bus.id = chaperone.bus_id','left')
// 		     ->join('client_user','client_user.id = chaperone.client_user_id','left')
// 		     ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		     $this->db->where(array("client_user.client_id" => $client_id));
// 		 }
// 		    $this->db->order_by("client_user.client_id", "desc");
		
// 		return $this->db->get()->result_array();

        if($client_id != 0){
		    $query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,chaperone.client_user_id,client.client_name,client_user.id as client_user_id FROM chaperone LEFT JOIN client_user ON client_user.id = chaperone.client_user_id LEFT JOIN client ON client.id = client_user.client_id where client_user.client_id in('.$client_id.') ORDER BY `chaperone`.`id` DESC';
		}else{
		     $query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,chaperone.client_user_id,client.client_name,client_user.id as client_user_id FROM chaperone LEFT JOIN client_user ON client_user.id = chaperone.client_user_id LEFT JOIN client ON client.id = client_user.client_id ORDER BY `chaperone`.`id` DESC';
		}
		
		 $query = $this->db->query($query);

        return $query->result_array(); 
   	}

   	public function parentsDataReport()
   	{
   		$this->db->select("parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,client.client_name,client_user.id as client_user_id")
    		->from('parents')
		    ->join('bus','bus.id = parents.bus_id','left')
		     ->join('client_user','client_user.id = parents.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->order_by("parents.id", "desc");

		return $this->db->get()->result_array();
   	}


   	public function parentsDetail($parent_id)
   	{	
   		$this->db->select("parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,client.id as client_id,client.client_name,client_user.id as client_user_id,client_user.username as client_user_name,client.logo_image,parents.device_id,parents.device_type")
    		->from('parents')
		    ->join('bus','bus.id = parents.bus_id','left')
		     ->join('client_user','client_user.id = parents.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->where(array("parents.id" => $parent_id));
		    // ->order_by("chaperone.id", "desc");

   		return $this->db->get()->row();

   	}

   	public function parentsDataReportByClient($client_id)
   	{
   		// print_r($client_id);die;
   		
//   		$this->db->select("parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,client.id as client_id,client.client_name,client_user.id as client_user_id")
//     		->from('parents')
// 		    ->join('bus','bus.id = parents.bus_id','left')
// 		     ->join('client_user','client_user.id = parents.client_user_id','left')
// 		     ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		     $this->db->where(array("client_user.client_id" => $client_id));
// 		 }
// 		    $this->db->order_by("client_user.client_id", "desc");
		
// 		return $this->db->get()->result_array();
        if($client_id != 0){
            $query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,parents.client_user_id,client.id as client_id,client.client_name,client_user.id as client_user_id FROM parents LEFT JOIN client_user ON client_user.id = parents.client_user_id LEFT JOIN client ON client.id = client_user.client_id where client_user.client_id in('.$client_id.') ORDER BY `parents`.`id` DESC';
        }else{
             $query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,parents.client_user_id,client.id as client_id,client.client_name,client_user.id as client_user_id FROM parents LEFT JOIN client_user ON client_user.id = parents.client_user_id LEFT JOIN client ON client.id = client_user.client_id ORDER BY `parents`.`id` DESC';
        }
        
//      $query = 'SELECT * FROM bus where id in('.$ids.')';
        $query = $this->db->query($query);

        return $query->result_array(); 
   	}
   	

   	public function busDataReport()
   	{
   		$this->db->select("bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id")
    		->from('bus')
		    // ->join('bus','bus.id = parents.bus_id','left')
		     ->join('client_user','client_user.id = bus.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->order_by("bus.id", "desc");

		return $this->db->get()->result_array();
   	}


   	public function busDetail($bus_id)
   	{	
   		$this->db->select("bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id,client.id as client_id")
    		->from('bus')
		     ->join('client_user','client_user.id = bus.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->where(array("bus.id" => $bus_id));
		    // ->order_by("chaperone.id", "desc");

   		return $this->db->get()->row();

   	}

   	public function busDataReportByClient($client_id)
   	{
//   		$this->db->select("bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id,client.id as client_id")
//     		->from('bus')
// 		     ->join('client_user','client_user.id = bus.client_user_id','left')
// 		     ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		     $this->db->where(array("client_user.client_id" => $client_id));
// 		 }
// 		    $this->db->order_by("client_user.client_id", "desc");
// 		return $this->db->get()->result_array();

        if($client_id != 0){
            $query = 'SELECT bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id,client.id as client_id FROM bus LEFT JOIN client_user ON client_user.id = bus.client_user_id LEFT JOIN client ON client.id = client_user.client_id where client_user.client_id in('.$client_id.') ORDER BY `bus`.`id` DESC';
        }else{
             $query = 'SELECT bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id,client.id as client_id FROM bus LEFT JOIN client_user ON client_user.id = bus.client_user_id LEFT JOIN client ON client.id = client_user.client_id ORDER BY `bus`.`id` DESC';
        }
        
//      $query = 'SELECT * FROM bus where id in('.$ids.')';
        $query = $this->db->query($query);

        return $query->result_array(); 
   	}


   	public function driverDataReport()
   	{
   		$this->db->select("driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.drive_mobile_number,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number,client.client_name,client_user.id as client_user_id")
    		->from('driver')
		    ->join('bus','bus.id = driver.bus_id','left')
		   ->join('client_user','client_user.id = driver.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->order_by("driver.id", "desc");
		
		return $this->db->get()->result_array();
   	}


   	public function driverDetail($driver_id)
   	{	
   		$this->db->select("driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.drive_mobile_number,driver.driver_name,driver.bus_id,driver.note,driver.drive_mobile_number,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number,client.client_name,client_user.id as client_user_id,client.id as client_id")
    		->from('driver')
		    ->join('bus','bus.id = driver.bus_id','left')
		   ->join('client_user','client_user.id = driver.client_user_id','left')
		     ->join('client','client.id = client_user.client_id','left')
		    ->where(array("driver.id" => $driver_id));

   		return $this->db->get()->row();

   	}

   	public function app_list(){
    	$this->db->select("*")
    		->from('app_related')
    		->order_by("app_related.id", "desc");

   		return $this->db->get()->result_array();
    }
    
    public function driverDataReportByClient($client_id)
   	{
//   		$this->db->select("driver.id as driver_id,driver.client_user_id,driver.drive_mobile_number,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number,client.client_name,client_user.id as client_user_id")
//     		->from('driver')
// 		    ->join('bus','bus.id = driver.bus_id','left')
// 		     ->join('client_user','client_user.id = driver.client_user_id','left')
// 		     ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		     $this->db->where(array("client_user.client_id" => $client_id));
// 		 }
// 		    $this->db->order_by("client_user.client_id", "desc");
		
// 		return $this->db->get()->result_array();

        if($client_id != 0){
            $query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.drive_mobile_number,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,client.client_name,client_user.id as client_user_id FROM driver LEFT JOIN client_user ON client_user.id = driver.client_user_id LEFT JOIN client ON client.id = client_user.client_id where client_user.client_id in('.$client_id.') ORDER BY `driver`.`id` DESC';
        }else{
             $query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.drive_mobile_number,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,client.client_name,client_user.id as client_user_id FROM driver LEFT JOIN client_user ON client_user.id = driver.client_user_id LEFT JOIN client ON client.id = client_user.client_id ORDER BY `driver`.`id` DESC';
        }
        
        $query = $this->db->query($query);

        return $query->result_array(); 
   	}

   	public function notifcation_list(){
    	$this->db->select("*")
    		->from('notifcation')
    		->order_by("notifcation.id", "desc");

   		return $this->db->get()->result_array();
    }
    public function statusDataReport()
    {

    // 	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    // 		->from('track')
    // 		->join('bus','bus.id = track.bus_id','left')
    // 		 ->join('driver','driver.id = track.driver_id','left')
    // 		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    // 		->join('client_user','client_user.id = track.client_user_id','left')
		  //  ->join('client','client.id = client_user.client_id','left')
		  //  ->order_by("track.id", "desc");
		    
		    $this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 // ->join('child','child.id = track.child_id','left')
    		 // ->join('parents','parents.id = track.parents_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		  //  ->where(array("trip.client_user_id" => $client_user))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->result_array();
    }
   
   	public function statusDataReportByClient($trip_id,$bus_id,$driver_id,$status,$chaperone_id,$trip_date)
   	{
//   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
//     		->from('track')
//     		->join('bus','bus.id = track.bus_id','left')
//     		 ->join('driver','driver.id = track.driver_id','left')
//     		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
//     		->join('client_user','client_user.id = track.client_user_id','left')
// 		    ->join('client','client.id = client_user.client_id','left')
// 		    ->where(array("track.trip_date" => $trip_date));
// 		 if($bus_id != 0){
// 		     $this->db->where(array("track.bus_id" => $bus_id));
// 		 } if($driver_id != 0){
// 		     $this->db->where(array("track.driver_id" => $driver_id));
// 		 } if($status != 0){
// 		     $this->db->where(array("track.status" => $status));
// 		 } if($chaperone_id != 0){
// 		     $this->db->where(array("track.chaperone_id" => $chaperone_id));
// 		 }
// 		    $this->db->order_by("track.id", "desc");

        $this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');

		 if($bus_id != 0){
		     $this->db->where(array("trip.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("trip.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("trip.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("trip.chaperone_id" => $chaperone_id));
		 }if($trip_id != 0){
		     $this->db->where(array("trip.id" => $trip_id));
		 }
		 	//  $this->db->where(array("trip.client_user_id" => $client_user));   
		 	 // $this->db->where(array("trip.trip_date" => $trip_date));
		 $this->db->order_by("trip.id", "desc");
		
		return $this->db->get()->result_array();
		
		return $this->db->get()->result_array();
   	}
   	
   	public function statusUserList($client_user)
    {
        $today_date = date('Y-m-d');

    	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("track.client_user_id" => $client_user))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("track.id", "desc");

		
		return $this->db->get()->result_array();
    }


    public function statusUser($bus_id,$driver_id,$status,$chaperone_id,$client_user,$trip_date)
   	{
   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 if($bus_id != 0){
		     $this->db->where(array("track.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("track.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("track.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("track.chaperone_id" => $chaperone_id));
		 }
		 	 $this->db->where(array("track.client_user_id" => $client_user));   
		 	 $this->db->where(array("track.trip_date" => $trip_date));
		 $this->db->order_by("track.id", "desc");;
		
		return $this->db->get()->result_array();
   	}
   	
   	public function adminTripList()
    {

    // 	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date ,track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    // 		->from('track')
    // 		->join('bus','bus.id = track.bus_id','left')
    // 		 ->join('driver','driver.id = track.driver_id','left')
    // 		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    // 		->join('client_user','client_user.id = track.client_user_id','left')
		  //  ->join('client','client.id = client_user.client_id','left')
		  //  // ->where(array("track.client_user_id" => $client_user))
		  //  ->order_by("track.id", "desc");
		    
		    $this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->order_by("trip.id", "desc");

		return $this->db->get()->result_array();
    }

    public function tripDataReportByClient($client_id)
   	{
//   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date ,track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
//     		->from('track')
//     		->join('bus','bus.id = track.bus_id','left')
//     		 ->join('driver','driver.id = track.driver_id','left')
//     		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
//     		->join('client_user','client_user.id = track.client_user_id','left')
// 		    ->join('client','client.id = client_user.client_id','left');
// 		 if($client_id != 0){
// 		     $this->db->where(array("client_user.client_id" => $client_id));
// 		 }
// 		    $this->db->order_by("track.id", "desc");;
		    
    	$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		    if($client_id != 0){
    		     $this->db->where(array("client_user.client_id" => $client_id));
    		 }
		     $this->db->order_by("trip.id", "desc");
		
		return $this->db->get()->result_array();
   	}
   	public function statusUserListTodayDate($client_user)
    {
    	$today_date = date('Y-m-d');

    	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date ,track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("track.trip_date" => $today_date))
		    ->where(array("track.client_user_id" => $client_user))
		    ->order_by("track.id", "desc");

		
		return $this->db->get()->result_array();
    }


   	public function mapDataToday($bus_id,$driver_id,$status,$chaperone_id,$client_user,$parents_id)
   	{
   		 $today_date = date('Y-m-d');

   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 if($bus_id != 0){
		     $this->db->where(array("track.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("track.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("track.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("track.chaperone_id" => $chaperone_id));
		 }if($parents_id != 0){
		     $this->db->where(array("track.parents_id" => $parents_id));
		 }
		 $this->db->where(array("track.trip_date" => $today_date));   
		 $this->db->where(array("track.client_user_id" => $client_user));   
		 $this->db->order_by("track.id", "desc");;
		
		return $this->db->get()->result_array();
   	}

   	public function mapDataDetail($bus_id,$driver_id,$status,$chaperone_id,$client_user,$parents_id,$trip_id)
   	{
   		 $today_date = date('Y-m-d');

   	// 	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name,driver.drive_mobile_number,chaperone.phone_number")
    // 		->from('track')
    $this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_latitude, trip.pickup_longitude, trip.drop_address, trip.drop_latitude, trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
            ->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 if($bus_id != 0){
		     $this->db->where(array("trip.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("trip.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("trip.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("trip.chaperone_id" => $chaperone_id));
		 }if($parents_id != 0){
		     $this->db->where(array("trip.parents_id" => $parents_id));
		 }if($trip_id != 0){
		     $this->db->where(array("trip.id" => $trip_id));
		 }
// 		 $this->db->where(array("trip.trip_date" => $today_date));   
		 $this->db->where(array("trip.client_user_id" => $client_user));   
		 $this->db->order_by("trip.id", "desc");;
		
		// return $this->db->get()->result_array();
		return $this->db->get()->row();
   	}
   		public function mapDataReport()
    {

//     	$today_date = date('Y-m-d');

//     	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date ,track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
//     		->from('track')
//     		->join('bus','bus.id = track.bus_id','left')
//     		 ->join('driver','driver.id = track.driver_id','left')
//     		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
//     		->join('client_user','client_user.id = track.client_user_id','left')
// 		    ->join('client','client.id = client_user.client_id','left')
// 		    ->where(array("track.trip_date" => $today_date))
// 		    ->order_by("track.id", "desc");

		
// 		return $this->db->get()->result_array();

        $this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_latitude, trip.pickup_longitude, trip.drop_address, trip.drop_latitude, trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
            ->from('trip')
            ->join('bus','bus.id = trip.bus_id','left')
             ->join('driver','driver.id = trip.driver_id','left')
             ->join('chaperone','chaperone.id = trip.chaperone_id','left')
            ->join('client_user','client_user.id = trip.client_user_id','left')
            ->join('client','client.id = client_user.client_id','left')
            ->order_by("trip.id", "desc");

        return $this->db->get()->result_array();
        
        
    }

    public function mapReportAjax($bus_id,$driver_id,$status,$chaperone_id,$parents_id)
   	{
   		 $today_date = date('Y-m-d');

   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join(' parents',' parents.id = track.parents_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 if($bus_id != 0){
		     $this->db->where(array("track.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("track.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("track.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("track.chaperone_id" => $chaperone_id));
		 }if($parents_id != 0){
		     $this->db->where(array("track.parents_id" => $parents_id));
		 }
		 $this->db->where(array("track.trip_date" => $today_date));   
		 // $this->db->where(array("track.client_user_id" => $client_user));   
		 $this->db->order_by("track.id", "desc");;
		
		return $this->db->get()->result_array();
   	}

   	public function mapReportDetail($bus_id,$driver_id,$status,$chaperone_id,$parents_id)
   	{
   		 $today_date = date('Y-m-d');

   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name,driver.drive_mobile_number,chaperone.phone_number")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join(' parents',' parents.id = track.parents_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 if($bus_id != 0){
		     $this->db->where(array("track.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("track.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("track.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("track.chaperone_id" => $chaperone_id));
		 }if($parents_id != 0){
		     $this->db->where(array("track.parents_id" => $parents_id));
		 }
		 $this->db->where(array("track.trip_date" => $today_date));   
		 // $this->db->where(array("track.client_user_id" => $client_user));   
		 $this->db->order_by("track.id", "desc");;
		
		// return $this->db->get()->result_array();
		return $this->db->get()->row();
   	}

   	public function getClientMapReportAjax($client_id)
   	{
   		 $today_date = date('Y-m-d');

   		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status, track.pickup_address, track.pickup_latitude, track.pickup_longitude, track.drop_address, track.drop_latitude, track.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name,client_user.id as client_user_id")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');

		 if($client_id != 0){
		     $this->db->where(array("client_user.client_id" => $client_id));
		 }

		 $this->db->where(array("track.trip_date" => $today_date));   
		 $this->db->order_by("track.id", "desc");;
		
		return $this->db->get()->result_array();
   	}
   	
   	
   	public function tripUserList($client_user)
    {
        $today_date = date('Y-m-d');

    // 	$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    // 		->from('track')
    // 		->join('bus','bus.id = track.bus_id','left')
    // 		 ->join('driver','driver.id = track.driver_id','left')
    // 		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    // 		->join('client_user','client_user.id = track.client_user_id','left')
		  //  ->join('client','client.id = client_user.client_id','left')
		  //  ->where(array("track.client_user_id" => $client_user))
		  ////  ->where(array("track.trip_date" => $today_date))
		  //  ->order_by("track.id", "desc");

		$this->db->select("track.id as track_id,track.client_user_id, track.bus_id, track.driver_id, track.chaperone_id, track.parents_id,track.trip_date, track.trip_start, track.trip_end, track.status,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name,child.child_name,parents.parents_name")
    		->from('track')
    		->join('bus','bus.id = track.bus_id','left')
    		 ->join('driver','driver.id = track.driver_id','left')
    		 ->join('chaperone','chaperone.id = track.chaperone_id','left')
    		 ->join('child','child.id = track.child_id','left')
    		 ->join('parents','parents.id = track.parents_id','left')
    		->join('client_user','client_user.id = track.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("track.client_user_id" => $client_user))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("track.id", "desc");
		return $this->db->get()->result_array();
    }
   	
//   	public function busTripData($client_user,$today_date)
//   	{
//   		// $today_date = date('Y-m-d');
//   		// SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM track t WHERE t.bus_id = b.id AND t.complete_status != 2 AND `t`.`trip_date` LIKE "2020-05-23") AND `b`.`client_user_id` =2

//       $query = 'SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM track t WHERE t.bus_id = b.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `b`.`client_user_id` ='.$client_user.'';
//         	 $query = $this->db->query($query);

// 		return $query->result_array();

//   	}
   	
//   	public function driverTripData($client_user,$today_date)
//   	{

//   		$query = 'SELECT d.* FROM driver d where NOT EXISTS (SELECT * FROM track t WHERE t.driver_id = d.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `d`.`client_user_id` ='.$client_user.'';
//         	$query = $this->db->query($query);

// 		return $query->result_array();
//   	}

//   	public function chaperoneTripData($client_user,$today_date)
//   	{

//   		$query = 'SELECT c.* FROM chaperone c where NOT EXISTS (SELECT * FROM track t WHERE t.chaperone_id = c.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `c`.`client_user_id` ='.$client_user.'';
//         	$query = $this->db->query($query);

// 		return $query->result_array();
//   	}
// public function busTripData($client_user,$today_date)
    public function busTripData($client_user)
   	{
   		// $today_date = date('Y-m-d');
   		// SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM track t WHERE t.bus_id = b.id AND t.complete_status != 2 AND `t`.`trip_date` LIKE "2020-05-23") AND `b`.`client_user_id` =2

    //   $query = 'SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM trip t WHERE t.bus_id = b.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `b`.`client_user_id` ='.$client_user.'';
        
        $query = 'SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM trip t WHERE t.bus_id = b.id AND t.complete_status != 2) AND  `b`.`client_user_id` ='.$client_user.'';
        	 $query = $this->db->query($query);
        	 
		return $query->result_array();
   	}
   	
   	// public function driverTripData($client_user,$today_date)
   	public function driverTripData($client_user)
   	{

   	// 	$query = 'SELECT d.* FROM driver d where NOT EXISTS (SELECT * FROM trip t WHERE t.driver_id = d.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `d`.`client_user_id` ='.$client_user.'';
    
        $query = 'SELECT d.* FROM driver d where NOT EXISTS (SELECT * FROM trip t WHERE t.driver_id = d.id AND t.complete_status != 2) AND  `d`.`client_user_id` ='.$client_user.'';
        $query = $this->db->query($query);
        	
		return $query->result_array();
   	}

   	// public function chaperoneTripData($client_user,$today_date)
   	public function chaperoneTripData($client_user)
   	{

   	// 	$query = 'SELECT c.* FROM chaperone c where NOT EXISTS (SELECT * FROM trip t WHERE t.chaperone_id = c.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `c`.`client_user_id` ='.$client_user.'';
        $query = 'SELECT c.* FROM chaperone c where NOT EXISTS (SELECT * FROM trip t WHERE t.chaperone_id = c.id AND t.complete_status != 2) AND  `c`.`client_user_id` ='.$client_user.'';	
        $query = $this->db->query($query);

		return $query->result_array();
   	}
   	public function childTripData($client_user,$today_date)
   	{

   		$query = 'SELECT c.* FROM child c where NOT EXISTS (SELECT * FROM track t WHERE t.child_id = c.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `c`.`client_user_id` ='.$client_user.'';
        	$query = $this->db->query($query);

		return $query->result_array();
   	}
    	public function tripList($client_user)
    {
        $today_date = date('Y-m-d');

    	$this->db->select("trip.id as trip_id,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 // ->join('child','child.id = track.child_id','left')
    		 // ->join('parents','parents.id = track.parents_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("trip.client_user_id" => $client_user))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->result_array();
    }
	public function tripListClient($client_user)
    {
        $today_date = date('Y-m-d');

    	$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 // ->join('child','child.id = track.child_id','left')
    		 // ->join('parents','parents.id = track.parents_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("trip.client_user_id" => $client_user))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->result_array();
    }
    
   	public function tripParentsList($trip_id)
    {
        $today_date = date('Y-m-d');

    	// $this->db->select("trip.id as trip_id,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    	$this->db->select("trip_add_parents.id as trip_add_parents_id, trip_add_parents.trip_id, trip_add_parents.parents_id,trip_add_parents.note,trip_add_parents.created_at,trip_add_parents.updated_at,parents.parents_name,parents.phone_number,child.child_name,child.child_image")
    		->from('trip_add_parents')
    		 ->join('parents','parents.id = trip_add_parents.parents_id','left')
    		 ->join('child','child.id = trip_add_parents.child_id','left')
    		 ->join('trip','trip.id = trip_add_parents.trip_id','left')
		    ->where(array("trip_add_parents.trip_id" => $trip_id))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip_add_parents.id", "desc");

		
		return $this->db->get()->result_array();
    }

    // public function parentTripData($client_user,$today_date)
    public function parentTripData($client_user)
   	{

   	// 	$query = 'SELECT p.* FROM parents p where NOT EXISTS (SELECT * FROM trip_add_parents t WHERE t.parents_id = p.id AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `p`.`client_user_id` ='.$client_user.'';
        $query = 'SELECT p.* FROM parents p where NOT EXISTS (SELECT * FROM trip_add_parents t WHERE t.parents_id = p.id AND t.trip_parents_status != 2) AND  `p`.`client_user_id` ='.$client_user.'';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	public function tripDetail($client_user,$trip_id)
    {
        $today_date = date('Y-m-d');

    	$this->db->select("trip.id as tripId,trip.trip_id,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 // ->join('child','child.id = track.child_id','left')
    		 // ->join('parents','parents.id = track.parents_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("trip.client_user_id" => $client_user))
		    ->where(array("trip.id" => $trip_id))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip.id", "desc");

		return $this->db->get()->row();
    }

    public function parentsAssignTripIds($parents_id)
    {
    	$this->db->select("trip_add_parents.id as trip_add_parents_id, trip_add_parents.trip_id, trip_add_parents.parents_id,trip_add_parents.note,trip_add_parents.created_at,trip_add_parents.updated_at,parents.parents_name,parents.phone_number,trip.trip_id")
    		->from('trip_add_parents')
    		 ->join('parents','parents.id = trip_add_parents.parents_id','left')
    		 ->join('trip','trip.id = trip_add_parents.trip_id','left')
		    ->where(array("trip_add_parents.parents_id" => $parents_id))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip_add_parents.id", "desc");

		
		return $this->db->get()->result_array();
    
    }
     public function tripAddParentsDetail($trip_add_parents_id)
    {
    	$this->db->select("trip_add_parents.id as trip_add_parents_id, trip_add_parents.trip_id as tripId, trip_add_parents.parents_id,trip_add_parents.note,trip_add_parents.created_at,trip_add_parents.updated_at,parents.parents_name,parents.phone_number,trip.trip_id,trip.trip_date,trip.complete_status,trip_add_parents.child_id,child_name")
    		->from('trip_add_parents')
    		 ->join('parents','parents.id = trip_add_parents.parents_id','left')
    		 ->join('child','child.id = trip_add_parents.child_id','left')
    		 ->join('trip','trip.id = trip_add_parents.trip_id','left')
		    ->where(array("trip_add_parents.id" => $trip_add_parents_id))
		  //  ->where(array("track.trip_date" => $today_date))
		    ->order_by("trip_add_parents.id", "desc");		
		return $this->db->get()->row();
    }
    public function tripEditDetail($tripId)
    {
        $today_date = date('Y-m-d');

    	$this->db->select("trip.id as tripId,trip.trip_id,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->where(array("trip.id" => $tripId))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->row();
    }
    
    public function busTripEditData($client_user,$tripId)
   	{
   		// $today_date = date('Y-m-d');
//    		// SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM track t WHERE t.bus_id = b.id AND t.complete_status != 2 AND `t`.`trip_date` LIKE "2020-05-23") AND `b`.`client_user_id` =2
// $query = 'SELECT b.* FROM bus b where NOT EXISTS (SELECT * FROM track t WHERE t.bus_id = b.id AND t.complete_status != 2 AND  `t`.`trip_date` LIKE "'.$today_date.'") AND  `b`.`client_user_id` ='.$client_user.'';


       $query = 'SELECT b.* FROM bus b where  `b`.`client_user_id` ='.$client_user.'';
        	 $query = $this->db->query($query);

		return $query->result_array();

   	}

   	public function driverTripEditData($client_user,$tripId)
   	{
   		$query = 'SELECT d.* FROM driver d where  `d`.`client_user_id` ='.$client_user.'';
        	$query = $this->db->query($query);

		return $query->result_array();
   	}


   	public function chaperoneTripEditData($client_user,$tripId)
   	{

   		$query = 'SELECT c.* FROM chaperone c where  `c`.`client_user_id` ='.$client_user.'';
        	$query = $this->db->query($query);

		return $query->result_array();
   	}
    
    public function parentTripEditData($client_user)
   	{
   		// $query = 'SELECT p.* FROM parents p where NOT EXISTS (SELECT * FROM trip_add_parents t WHERE t.parents_id = p.id AND t.trip_parents_status != 2 OR t.trip_parents_status = 0) AND  `p`.`client_user_id` ='.$client_user.'';
   		$query = 'SELECT p.* FROM parents p where `p`.`client_user_id` ='.$client_user.'';
        	$query = $this->db->query($query);

		return $query->result_array();
   	}
   	public function countDuplicateBus($id){
   		$query = 'SELECT count(*) as busTotal FROM bus where id in('.$id.')';
        $query = $this->db->query($query);

		return $query->row();
   	}

   	public function countDuplicateDriver($id){
   		$query = 'SELECT count(*) as driverTotal FROM driver where id in('.$id.')';
        $query = $this->db->query($query);
		return $query->row();
   	}
   	
   	public function countDuplicateChaperone($id){
   		$query = 'SELECT count(*) as chaperoneTotal FROM chaperone where id in('.$id.')';
        $query = $this->db->query($query);
		return $query->row();
   	}
   	
   	public function countDuplicateParents($id){
   		$query = 'SELECT count(*) as parentsTotal FROM parents where id in('.$id.')';
        $query = $this->db->query($query);
		return $query->row();
   	}
   	
   	public function countDuplicateTripsParents($id){
   		$query = 'SELECT count(*) as parentsTripTotal FROM parents where id in('.$id.')';
        $query = $this->db->query($query);
		return $query->row();
   	}
   	
   	public function countDuplicateTrips($id){
   		$query = 'SELECT count(*) as tripTotal FROM trip where id in('.$id.')';
        $query = $this->db->query($query);
		return $query->row();
   	}
   	public function countDuplicateClient($id){
   		$query = 'SELECT count(*) as clientTotal FROM client where id in('.$id.')';
        $query = $this->db->query($query);

		return $query->row();
   	}
   	public function countDuplicateClientUser($id){
   		$query = 'SELECT count(*) as clientUserTotal FROM client_user where id in('.$id.')';
        $query = $this->db->query($query);

		return $query->row();
   	}
   	public function trackUser($trip_id,$bus_id,$driver_id,$status,$chaperone_id,$client_user)
   	{

// print_r($trip_id);

   		$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');

		 if($bus_id != 0){
		     $this->db->where(array("trip.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("trip.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("trip.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("trip.chaperone_id" => $chaperone_id));
		 }if($trip_id != 0){
		     $this->db->where(array("trip.id" => $trip_id));
		 }
		 	 $this->db->where(array("trip.client_user_id" => $client_user));   
		 	 // $this->db->where(array("trip.trip_date" => $trip_date));
		 $this->db->order_by("trip.id", "desc");;
		
		return $this->db->get()->result_array();
   	}


   	public function trackStatus($client_user)
    {
    	// $today_date = date('Y-m-d');

    	$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    // ->where(array("track.trip_date" => $today_date))
		    ->where(array("trip.client_user_id" => $client_user))
		    ->where(array("trip.status" => 1))
		    ->where(array("trip.complete_status" => 1))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->result_array();
    }

    public function trackMap($bus_id,$driver_id,$status,$chaperone_id,$client_user,$parents_id,$trip_id)
   	{
   		 $today_date = date('Y-m-d');

   		$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,bus.bus_number,client.client_name,driver.driver_name")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left');
		 
		 if($bus_id != 0){
		     $this->db->where(array("trip.bus_id" => $bus_id));
		 } if($driver_id != 0){
		     $this->db->where(array("trip.driver_id" => $driver_id));
		 } if($status != 0){
		     $this->db->where(array("trip.status" => $status));
		 } if($chaperone_id != 0){
		     $this->db->where(array("trip.chaperone_id" => $chaperone_id));
		 }if($trip_id != 0){
		     $this->db->where(array("trip.id" => $trip_id));
		 }
// 		 $this->db->where(array("trip.status" => 1));
// 		 $this->db->where(array("trip.complete_status" => 1));
		 // $this->db->where(array("track.trip_date" => $today_date));   
		 $this->db->where(array("trip.client_user_id" => $client_user));   
		 $this->db->order_by("trip.id", "desc");;
		
		return $this->db->get()->result_array();
   	}
   	
   	public function howToImg()
    {
        $today_date = date('Y-m-d');
    	$this->db->select("cms.id as cm_id,cms.title,cms.ar_title,cms.description,cms.ar_description,how_to_img.id as how_to_img_id,how_to_img.how_to_id,how_to_img.img,how_to_img.description,how_to_img.ar_description")
    		->from('how_to_img')
    // 		->join('how_to_img','how_to_img.how_to_id = cms.id','left')
    		->join('cms','cms.id=how_to_img.how_to_id ','left')
		    ->where(array("how_to_img.how_to_id" => 2))
		    ->group_by('cms.id')
		    ->order_by("how_to_img.id", "desc");
		return $this->db->get()->result_array();
    }
    
    public function clientGroup()
    {
        $today_date = date('Y-m-d');
    	$this->db->select("*")
    		->from('client')
		    ->group_by('client.client_name')
		    ->order_by("client.id", "desc");
		return $this->db->get()->result_array();
    }
    
    public function getClientName($client_name)
    {
        $today_date = date('Y-m-d');
    	$this->db->select("*")
    		->from('client')
		    ->like('client.client_name', $client_name)
		    ->order_by("client.id", "desc");
		return $this->db->get()->result_array();
    }
//--------------API Model ----------------------------------
    function checkChaperoneTrip($chaperone_id)
   	{
   		$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number as chaperone_phone,bus.bus_number,client.client_name,client.logo_image as client_logo_image,driver.driver_name,driver.drive_mobile_number,client_user.username as client_user_name,trip.complete_status")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    // ->where(array("track.trip_date" => $today_date))
		    ->where(array("trip.chaperone_id" => $chaperone_id))
		  //  ->where(array("trip.status" => 1))
		  //  ->where(array("trip.complete_status" => 1))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->result_array();
   	}
   	 function checkChaperoneTripAvailable($chaperone_id)
   	{
   		$this->db->select("trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number as chaperone_phone ,bus.bus_number,client.client_name,client.logo_image as client_logo_image,driver.driver_name,driver.drive_mobile_number,client_user.username as client_user_name,trip.complete_status,save_trip.updated_at as save_trip_date")
    		->from('trip')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
		    ->join('save_trip','save_trip.trip_id = trip.id','left')
		    // ->where(array("track.trip_date" => $today_date))
		    ->where(array("trip.chaperone_id" => $chaperone_id))
		  //  ->where(array("trip.status" => 1))
		    ->where(array("trip.complete_status !=" => 2))
		    ->order_by("trip.id", "desc");
		    
		return $this->db->get()->row();
   	}
   	
   	function parentsChildList($parents_id)
   	{
   		$this->db->select("child.id as child_id,child.child_name,child.child_image,child.parents_id,child.client_user_id")
    		->from('child')
    		->join('parents','parents.id = child.parents_id','left')
		    ->where(array("child.parents_id" => $parents_id))
		    ->order_by("child.id", "desc");

		
		return $this->db->get()->result_array();
   	}
   	
   	public function parentChildTripData($client_user)
   	{

        $query = 'SELECT c.* FROM child c where NOT EXISTS (SELECT * FROM trip_add_parents t WHERE t.child_id = c.id AND t.trip_parents_status != 2) AND  `c`.`client_user_id` ='.$client_user.'';
        $query = $this->db->query($query);

		return $query->result_array();
   	}
   	
   	public function childTripEditData($client_user)
   	{

   		$query = 'SELECT c.* FROM child c where `c`.`client_user_id` ='.$client_user.'';
        	$query = $this->db->query($query);

		return $query->result_array();
   	}
   	
   	
   	public function parentsTripLocation($chaperone_id,$trip_id)
   	{
   		$this->db->select("trip_add_parents.id,trip_add_parents.trip_id,trip_add_parents.parents_id,trip_add_parents.child_id,trip_add_parents.pickup_address,trip_add_parents.pickup_latitude,trip_add_parents.pickup_longitude,trip_add_parents.drop_address,trip_add_parents.drop_latitude,trip_add_parents.drop_longitude,parents.parents_name,child.child_name,child.child_image")
    		->from('trip_add_parents')
    // 		->join('bus','bus.id = trip.bus_id','left')
    // 		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('parents','parents.id = trip_add_parents.parents_id','left')
    		 ->join('child','child.id = trip_add_parents.child_id','left')
    // 		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    // 		->join('client_user','client_user.id = trip.client_user_id','left')
		  //  ->join('client','client.id = client_user.client_id','left')
		  //  ->where(array("trip.chaperone_id" => $chaperone_id))
		    ->where(array("trip_add_parents.trip_id" => $trip_id))
		    ->order_by("trip_add_parents.id", "desc");

		
		return $this->db->get()->result_array();
   	}
   	
   	public function parentsTripLocationDistance($chaperone_id,$trip_id,$current_latitude,$current_logitude)
   	{
//   		$this->db->select(" trip_add_parents.id,trip_add_parents.trip_id,trip_add_parents.parents_id,trip_add_parents.child_id,trip_add_parents.pickup_address,trip_add_parents.pickup_latitude,trip_add_parents.pickup_longitude,trip_add_parents.drop_address,trip_add_parents.drop_latitude,trip_add_parents.drop_longitude,parents.parents_name,child.child_name,child.child_image,
// 				( 3959 * acos( cos( radians(.$current_latitude.) ) * cos( radians( pickup_latitude ) ) * cos( radians( pickup_longitude ) - radians$current_logitude) ) + sin( radians(.$current_latitude.) ) * sin( radians( pickup_latitude ) ) ) ) AS distance ")
// 			->from('trip_add_parents')
//     		 ->join('parents','parents.id = trip_add_parents.parents_id','left')
//     		 ->join('child','child.id = trip_add_parents.child_id','left')
//     		 ->where(array("trip_add_parents.trip_id" => $trip_id))
// 		    ->order_by("trip_add_parents.id", "desc");
        
        $query = 'SELECT `trip_add_parents`.`id`, `trip_add_parents`.`trip_id`, `trip_add_parents`.`parents_id`, `trip_add_parents`.`child_id`, `trip_add_parents`.`pickup_address`, `trip_add_parents`.`pickup_latitude`, `trip_add_parents`.`pickup_longitude`, `trip_add_parents`.`drop_address`, `trip_add_parents`.`drop_latitude`, `trip_add_parents`.`drop_longitude`, `parents`.`parents_name`, `child`.`child_name`, `child`.`child_image`, ( 3959 * acos( cos( radians('.$current_latitude.') ) * cos( radians( pickup_latitude ) ) * cos( radians( pickup_longitude ) - radians('.$current_logitude.') ) + sin( radians('.$current_latitude.') ) * sin( radians( pickup_latitude ) ) ) ) AS distance
            FROM `trip_add_parents`
            LEFT JOIN `parents` ON `parents`.`id` = `trip_add_parents`.`parents_id`
            LEFT JOIN `child` ON `child`.`id` = `trip_add_parents`.`child_id`
            where trip_add_parents.trip_id = '.$trip_id.' 
            ORDER BY `distance` ASC';
		$query = $this->db->query($query);

		return $query->result_array();
// 		return $this->db->get()->result_array();
   	}

}