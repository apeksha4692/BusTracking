<?php
class ApiModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library( 'Utility' );
	}

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
		    ->where(array("trip.complete_status !=" => 2))
		    ->order_by("trip.id", "desc");

		
		return $this->db->get()->row();
   	}
   	
   	public function checkParentsTripList($parents_id)
   	{
   	    $this->db->select("trip_add_parents.id as trip_add_parents_id,trip_add_parents.client_user_id,trip_add_parents.trip_id,trip_add_parents.parents_id,trip_add_parents.note,trip_add_parents.trip_parents_status,trip_add_parents.created_at as trip_add_parents_created,trip_add_parents.updated_at as trip_add_parents_update,trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number as chaperone_phone,bus.bus_number,client.client_name,client.logo_image as client_logo_image,driver.driver_name,driver.drive_mobile_number,client_user.username as client_user_name,trip.complete_status,child.id as child_id,child.child_name,child.child_image")
    		->from('trip_add_parents')
    		->join('trip','trip_add_parents.trip_id = trip.id','left')
    		->join('child','trip_add_parents.child_id = child.id','left')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 ->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
    		->where(array("trip_add_parents.parents_id" => $parents_id))
    		 ->order_by("trip.trip_start", "asc");
    		 
        return $this->db->get()->result_array();
   	}
   	
   	public function checkParentsTripDetail($trip_id,$parentId)
   	{
   	    // print_r($trip_id);
   	    // print_r($parentId);
   	    
   	    $this->db->select("trip_add_parents.id as trip_add_parents_id,trip_add_parents.client_user_id,trip_add_parents.trip_id,trip_add_parents.parents_id,trip_add_parents.note,trip_add_parents.trip_parents_status,trip_add_parents.created_at as trip_add_parents_created,trip_add_parents.updated_at as trip_add_parents_update,trip.id as trip_id,trip.trip_id as tridID,trip.client_user_id, trip.bus_id, trip.driver_id, trip.chaperone_id, trip.trip_date, trip.trip_start, trip.trip_end, trip.status,trip.note,trip.created_at,trip.updated_at,trip.pickup_address,trip.pickup_latitude,trip.pickup_longitude,trip.drop_address,trip.drop_latitude,trip.drop_longitude,chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number as chaperone_phone,bus.bus_number,client.client_name,client.logo_image as client_logo_image,driver.driver_name,driver.drive_mobile_number,client_user.username as client_user_name,trip.complete_status,child.id as child_id,child.child_name,child.child_image")
    		->from('trip_add_parents')
    		->join('trip','trip_add_parents.trip_id = trip.id','left')
    		->join('bus','bus.id = trip.bus_id','left')
    		 ->join('driver','driver.id = trip.driver_id','left')
    		 ->join('child','trip_add_parents.child_id = child.id','left')
    		 ->join('chaperone','chaperone.id = trip.chaperone_id','left')
    		 ->join('client_user','client_user.id = trip.client_user_id','left')
		    ->join('client','client.id = client_user.client_id','left')
    		->where(array("trip_add_parents.parents_id" => $parentId))
    		->where(array("trip_add_parents.trip_id" => $trip_id))
    		 ->order_by("trip_add_parents.id", "desc");
    		 
        return $this->db->get()->row();
   	    
   	}
   	public function distanceCalculation($pickup_latitude,$pickup_longitude,$drop_latitude,$drop_longitude,$trip_id)
   	{
   	    $this->db->select(" *,
		ROUND(
		    (6353 * 2 * ASIN(
		    SQRT( 
		        POWER(
		           SIN(
		                (".$pickup_latitude." - abs(".$drop_latitude.")) 
		                * pi()/180 / 2),2) 
		                + COS(".$pickup_latitude." * pi()/180 ) 
		                * COS(abs(".$drop_latitude.") *  pi()/180) 
		                * POWER(SIN((".$pickup_longitude. "- ".$drop_longitude.") 
		                *  pi()/180 / 2), 2) )
		            )
		        ), 
		    2
		) 
		AS distance")
			->from('trip')
		    ->where(array("trip.id" => $trip_id));
		return $this->db->get()->row();
		
        
   	}
    
    public function getParentsNotificationData($type,$parentId)
    {
        // print_r($type);die;
        // SELECT * FROM `parents_notification` WHERE (`parents_id`= 0 AND `type`=2) OR (`parents_id`=108 AND `type`!=1) ORDER BY parents_notification.id DESC
        
        if($type == 1){
             $query = 'SELECT * FROM parents_notification where (parents_id = 0 AND type = '.$type.') OR (parents_id = '.$parentId.' AND type != 2) ';
        }else{
             $query = 'SELECT * FROM parents_notification where (parents_id = 0 AND type = '.$type.') OR (parents_id = '.$parentId.' AND type != 1) ';
        }
       
        
        $query = $this->db->query($query);

		return $query->result_array();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
