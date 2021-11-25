<?php
class PdfModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->library( 'Utility' );
	}

   	function getClientExcel($ids)
   	{
   		$query = 'SELECT * FROM client where id in('.$ids.') ORDER BY client.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getClientPdf($ids)
   	{
   		$query = 'SELECT * FROM client where id in('.$ids.')';
        $query = $this->db->query($query);

		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('client_name').'</th>
                                    <th scope="col">'.$this->lang->line('focal_point_name').'</th>
                                    <th scope="col">'.$this->lang->line('focal_point_number').'</th>
                                    <th scope="col">'.$this->lang->line('focal_point_email').'</th>
                                    <th scope="col">'.$this->lang->line('max_chaperone_user').'</th>
                                    <th scope="col">'.$this->lang->line('max_portal_user').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}
			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['client_name'].'</td>
					 <td>'.$row['focal_point_name'].'</td>
	                 <td>'.$row['focal_point_number'].'</td>
	                 <td>'.$row['focal_point_email'].'</td>
	                 <td>'.$row['max_chaperone'].'</td>
	                 <td>'.$row['max_parent'].'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}


   	function getClientUserExcel($ids)
   	{

   		$query = 'SELECT client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name FROM client_user LEFT JOIN client ON client.id =  client_user.client_id where client_user.id in('.$ids.') ORDER BY client_user.id DESC';

   		// $query = 'SELECT * FROM client where id in('.$ids.')';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getClientUserPdf($ids)
   	{
   		$query = 'SELECT client_user.id as client_user_id,client_user.client_id,client_user.username,client_user.email,client_user.mobile_number,client_user.login_username,client_user.login_password,client_user.last_login_date,client_user.status,client.client_name FROM client_user LEFT JOIN client ON client.id =  client_user.client_id where client_user.id in('.$ids.') ORDER BY client_user.id DESC';

   		// $query = 'SELECT * FROM client where id in('.$ids.')';
        $query = $this->db->query($query);

		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('client_name').'</th>
                                    <th scope="col">'.$this->lang->line('client_user_name').'</th>
                                    <th scope="col">'.$this->lang->line('client_email_id').'</th>
                                    <th scope="col">'.$this->lang->line('client_mobile_number').'</th>
                                    <th scope="col">'.$this->lang->line('login_user_name').'</th>
                                    <th scope="col">'.$this->lang->line('login_password').'</th>
                                    <th scope="col">'.$this->lang->line('last_login_date').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}
			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['client_name'].'</td>
					 <td>'.$row['username'].'</td>
	                 <td>'.$row['email'].'</td>
	                 <td>'.$row['mobile_number'].'</td>
	                 <td>'.$row['login_username'].'</td>
	                 <td>'.$row['login_password'].'</td>
	                 <td>'.$row['last_login_date'].'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}


   	function getBusExcel($ids)
   	{
   		$query = 'SELECT * FROM bus where id in('.$ids.') ORDER BY  bus.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getBusPdf($ids)
   	{
   		$query = 'SELECT * FROM bus where id in('.$ids.')';
        $query = $this->db->query($query);

		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('bus_id_number').'</th>
                                    <th scope="col">'.$this->lang->line('bus_plate_number').'</th>
                                    <th scope="col">'.$this->lang->line('note').'</th>
                                    <th scope="col">'.$this->lang->line('modify').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['bus_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['bus_number'].'</td>
					 <td>'.$row['bus_plate_number'].'</td>
	                 <td>'.$row['bus_note'].'</td>
	                 <td>'.$date.'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}

   	function getDriverExcel($ids)
   	{
   
   		$query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number FROM driver LEFT JOIN bus ON bus.id = driver.bus_id where driver.id in('.$ids.') ORDER BY  driver.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getDriverPdf($ids)
   	{
   		$query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number FROM driver LEFT JOIN bus ON bus.id = driver.bus_id where driver.id in('.$ids.')';
        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('driver_name').'</th>
                                    <th scope="col">'.$this->lang->line('driver_number').'</th>
                                    <th scope="col">'.$this->lang->line('assigned_bus').'</th>
                                    <th scope="col">'.$this->lang->line('note').'</th>
                                    <th scope="col">'.$this->lang->line('modify').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['bus_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['driver_name'].'</td>
					 <td>'.$row['driver_unique_id'].'</td>
	                 <td>'.$row['bus_number'].'</td>
	                 <td>'.$row['note'].'</td>
	                 <td>'.$date.'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}


   	function getChaperoneExcel($ids)
   	{
   
   		$query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id FROM chaperone LEFT JOIN bus ON bus.id = chaperone.bus_id where chaperone.id in('.$ids.') ORDER BY  chaperone.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getChaperonePdf($ids)
   	{
   		$query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id FROM chaperone LEFT JOIN bus ON bus.id = chaperone.bus_id where chaperone.id in('.$ids.')';

        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('chaperone_name').'</th>
                                    <th scope="col">'.$this->lang->line('chaperone_number').'</th>
                                    <th scope="col">'.$this->lang->line('assigned_bus').'</th>
                                    <th scope="col">'.$this->lang->line('note').'</th>
                                    <th scope="col">'.$this->lang->line('secret_code').'</th>
                                    <th scope="col">'.$this->lang->line('modify').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['chaperone_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['chaperone_name'].'</td>
					 <td>'.$row['chaperone_unique_id'].'</td>
	                 <td>'.$row['bus_unique_id'].'</td>
	                 <td>'.$row['note'].'</td>
	                 <td>'.$row['secret_code'].'</td>
	                 <td>'.$date.'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}


   	function getParentExcelOld($ids)
   	{
   
   		$query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id FROM parents LEFT JOIN bus ON bus.id = parents.bus_id where parents.id in('.$ids.')';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getParentPdfOld($ids)
   	{
   		$query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id FROM parents LEFT JOIN bus ON bus.id = parents.bus_id where parents.id in('.$ids.')';
   		
        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('parents_name').'</th>
                                    <th scope="col">'.$this->lang->line('parent_number').'</th>
                                    <th scope="col">'.$this->lang->line('assigned_bus').'</th>
                                    <th scope="col">'.$this->lang->line('note').'</th>
                                    <th scope="col">'.$this->lang->line('secret_code').'</th>
                                    <th scope="col">'.$this->lang->line('modify').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['parents_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['parents_name'].'</td>
					 <td>'.$row['parents_unique_id'].'</td>
	                 <td>'.$row['bus_unique_id'].'</td>
	                 <td>'.$row['note'].'</td>
	                 <td>'.$row['secret_code'].'</td>
	                 <td>'.$date.'</td>
	                 <td>'.$status.'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}
   	
   	function getParentExcel($ids)
   	{
       $query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,child.child_name,parents.client_user_id FROM parents LEFT JOIN child ON child.parents_id = parents.id where parents.id in('.$ids.')';

        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getParentPdf($ids)
   	{
        $query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,child.child_name,parents.client_user_id FROM parents LEFT JOIN child ON child.parents_id = parents.id where parents.id in('.$ids.')';
        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('child_name').'</th>
                                    <th scope="col">'.$this->lang->line('parents_name').'</th>
                                    <th scope="col">'.$this->lang->line('parent_number').'</th>
                                    <th scope="col">'.$this->lang->line('note').'</th>
                                    <th scope="col">'.$this->lang->line('secret_code').'</th>
                                    <th scope="col">'.$this->lang->line('modify').'</th>
                                    <th scope="col"> '.$this->lang->line('status').'</th>
                                  </tr>
                                </thead>';

         $i = 1;

   		foreach($data as $row)
		{
			if($row['parents_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['child_name'].'</td>
           <td>'.$row['parents_name'].'</td>
					 <td>'.$row['parents_unique_id'].'</td>
           <td>'.$row['note'].'</td>
           <td>'.$row['secret_code'].'</td>
           <td>'.$date.'</td>
           <td>'.$status.'</td>
        </tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}
   	function getNotificationExcel($ids)
   	{
   		$query = 'SELECT * FROM notifcation where id in('.$ids.') ORDER BY notifcation.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getNotificationPdf($ids)
   	{
   		$query = 'SELECT * FROM notifcation where id in('.$ids.')';
        $query = $this->db->query($query);

		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('date_time').'</th>
                                    <th scope="col">'.$this->lang->line('clients').'</th>
                                    <th scope="col">'.$this->lang->line('user').'</th>
                                    <th scope="col">'.$this->lang->line('based_on_app_version').'</th>
                                    <th scope="col">'.$this->lang->line('all_app_version').'</th>
                                    <th scope="col">'.$this->lang->line('platform').'</th>
                                    <th scope="col">'.$this->lang->line('msg').'</th>
                                  </tr>
                                </thead>';



         $i = 1;

   		foreach($data as $row)
		{

			$date = date("d/m/Y h:s A", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
	                 <td>'.$date.'</td>
					 <td>'.$row['client'].'</td>
					 <td>'.$row['app_user'].'</td>
	                 <td>'.$row['based_app'].'</td>
	                 <td>'.$row['version'].'</td>
	                 <td>'.$row['platform'].'</td>
	                 <td>'.$row['msg'].'</td>
				</tr>';
			$i++;
		}
		$output .= '</table>';
		// print_r($output);die;
		return $output;
   	}
   	function getBusCsv($ids)
    {
      $query = 'SELECT bus_number,bus_plate_number,bus_note FROM bus where id in('.$ids.')';
      // $query = 'SELECT * FROM bus ';
      $query = $this->db->query($query);

      return $query->result_array();
    }

    function getDriverCsv($ids)
    {
      $query = 'SELECT driver_name,drive_mobile_number,note FROM driver where id in('.$ids.')';
      $query = $this->db->query($query);

      return $query->result_array();
    }

    function getChaperoneCsv($ids)
    {
      $query = 'SELECT chaperone_name,phone_number,note,secret_code FROM chaperone where id in('.$ids.')';
      $query = $this->db->query($query);

    return $query->result_array();
    }

    function getParentCsv($ids)
    {
      $query = 'SELECT  parents_name,phone_number,note,secret_code,child.child_name FROM parents LEFT JOIN child ON child.parents_id = parents.id where parents.id in('.$ids.')';
      
        $query = $this->db->query($query);

    return $query->result_array();
    }

    function getTripParentsCsv($ids)
    {
      $query = 'SELECT  trip_add_parents.note,parents.parents_name,parents.phone_number FROM trip_add_parents LEFT JOIN parents ON parents.id = trip_add_parents.parents_id where trip_add_parents.id in('.$ids.')';
      $query = $this->db->query($query);

      return $query->result_array();
    }
    function getTripParentsExcel($ids)
    {
      $query = 'SELECT  trip_add_parents.note,trip_add_parents.updated_at,parents.parents_name,parents.phone_number,child.child_name FROM trip_add_parents LEFT JOIN parents ON parents.id = trip_add_parents.parents_id LEFT JOIN child ON child.id = trip_add_parents.child_id where trip_add_parents.id in('.$ids.')';
      $query = $this->db->query($query);

      return $query->result_array();
    }
    function getTripCsv($ids)
    {
      $query = 'SELECT  bus.bus_number,chaperone.chaperone_name, driver.driver_name,t.trip_date,t.trip_start,t.trip_end,t.note FROM trip t LEFT JOIN bus ON bus.id = t.bus_id LEFT JOIN chaperone ON chaperone.id = t.chaperone_id LEFT JOIN  driver ON  driver.id = t.driver_id where t.id in('.$ids.')';

        $query = $this->db->query($query);

      return $query->result_array();
    }
    function getTripExcel($ids)
    {
      $query = 'SELECT  bus.bus_number,chaperone.chaperone_name, driver.driver_name,t.id as tripId,t.trip_id,t.trip_date,t.trip_start,t.trip_end,t.note,t.updated_at,t.status FROM trip t LEFT JOIN bus ON bus.id = t.bus_id LEFT JOIN chaperone ON chaperone.id = t.chaperone_id LEFT JOIN  driver ON  driver.id = t.driver_id where t.id in('.$ids.') ORDER BY  t.id DESC';

        $query = $this->db->query($query);

      return $query->result_array();
    }
    function getTrackPdf($ids)
    {
      // $query = 'SELECT * FROM bus where id in('.$ids.')';


      $query = 'SELECT  bus.bus_number,chaperone.chaperone_name, driver.driver_name,t.id as tripId,t.trip_id,t.trip_date,t.trip_start,t.trip_end,t.note,t.updated_at,t.status FROM trip t LEFT JOIN bus ON bus.id = t.bus_id LEFT JOIN chaperone ON chaperone.id = t.chaperone_id LEFT JOIN  driver ON  driver.id = t.driver_id where t.id in('.$ids.')';
        $query = $this->db->query($query);

    $data = $query->result_array();

      // print_r($data);die;
      $output = '<table class="table table-borderless border-top border-bottom" id="example">
            <thead>
              <tr>
                <th scope="col">'.$this->lang->line('s_no').'</th>
                <th scope="col">'.$this->lang->line('trip_id').'</th>
                <th scope="col">'.$this->lang->line('bus_number').'</th>
                <th scope="col">'.$this->lang->line('driver').'</th>
                <th scope="col">'.$this->lang->line('chaperone').'</th>
                <th scope="col"> '.$this->lang->line('status').'</th>
                <th scope="col"> '.$this->lang->line('estimated_start_time').'</th>
                <th scope="col"> '.$this->lang->line('estimated_end_time').'</th>
              </tr>
            </thead>';

         $i = 1;

          foreach($data as $row)
        {
              if($row['status'] == 1){
                    $status = 'Live';
                }else{
                    $status = 'No Live';
                }
          $output .= '
            <tr>
               <td>'.$i.'</td>
               <td>'.$row['trip_id'].'</td>
               <td>'.$row['bus_number'].'</td>
                       <td>'.$row['driver_name'].'</td>
                       <td>'.$row['chaperone_name'].'</td>
                       <td>'.$status.'</td>
                       <td>'.$row['trip_start'].'</td>
                       <td>'.$row['trip_end'].'</td>
            </tr>';
          $i++;
        }
        
        $output .= '</table>';
        // print_r($output);die;
        return $output;
    }
    
    function getAppExcel($ids)
   	{
   		$query = 'SELECT * FROM app_related where id in('.$ids.') ORDER BY app_related.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}
   	
   	function getAdminPortalUserExcel($ids)
   	{
   		$query = 'SELECT * FROM admin where id in('.$ids.') ORDER BY admin.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}
   	
   	function getParentChildExcel($ids)
    {
      $query = 'SELECT child.id as child_id,child.child_name,child.child_image,child.parents_id,child.client_user_id FROM child LEFT JOIN parents ON parents.id = child.parents_id where child.id in('.$ids.')';
      $query = $this->db->query($query);

      return $query->result_array();
    }
}