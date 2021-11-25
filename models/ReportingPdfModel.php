<?php
class ReportingPdfModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->library( 'Utility' );
	}


	function getChaperoneExcel($ids)
   	{
   
   		$query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,client.client_name,client_user.id as client_user_id FROM chaperone LEFT JOIN bus ON bus.id = chaperone.bus_id LEFT JOIN client_user ON client_user.id = chaperone.client_user_id LEFT JOIN client ON client.id = client_user.client_id where chaperone.id in('.$ids.') ORDER BY  chaperone.id DESC';
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getChaperonePdf($ids)
   	{
   		$query = 'SELECT chaperone.id as chaperone_id,chaperone.chaperone_name,chaperone.phone_number,chaperone.bus_id,chaperone.secret_code,chaperone.note,chaperone.chaperone_status,chaperone.chaperone_unique_id,chaperone.is_delete,chaperone.created_at,chaperone.updated_at,bus.bus_unique_id,bus.bus_plate_number,chaperone.client_user_id,client.client_name,client_user.id as client_user_id FROM chaperone LEFT JOIN bus ON bus.id = chaperone.bus_id LEFT JOIN client_user ON client_user.id = chaperone.client_user_id LEFT JOIN client ON client.id = client_user.client_id where chaperone.id in('.$ids.')';

        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('client_name').'</th>
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
					 <td>'.$row['client_name'].'</td>
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


   	function getParentExcel($ids)
   	{
   
   		$query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,client.client_name,client_user.id as client_user_id FROM parents LEFT JOIN bus ON bus.id = parents.bus_id  LEFT JOIN client_user ON client_user.id = parents.client_user_id LEFT JOIN client ON client.id = client_user.client_id where  parents.id in('.$ids.') ORDER BY  parents.id DESC';

        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getParentPdf($ids)
   	{
   		$query = 'SELECT parents.id as parents_id,parents.parents_name,parents.phone_number,parents.bus_id,parents.secret_code,parents.note,parents.parents_status,parents.parents_unique_id,parents.is_delete,parents.created_at,parents.updated_at,bus.bus_unique_id,bus.bus_plate_number,parents.client_user_id,client.client_name,client_user.id as client_user_id FROM parents LEFT JOIN bus ON bus.id = parents.bus_id  LEFT JOIN client_user ON client_user.id = parents.client_user_id LEFT JOIN client ON client.id = client_user.client_id where  parents.id in('.$ids.')';
   		
        $query = $this->db->query($query);
		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                     <th scope="col">'.$this->lang->line('client_name').'</th>
                                    <th scope="col">'.$this->lang->line('parents_name').'</th>
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
					  <td>'.$row['client_name'].'</td>
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


   	function getBusExcel($ids)
   	{
   		$query = 'SELECT bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id FROM bus LEFT JOIN client_user ON client_user.id = bus.client_user_id LEFT JOIN client ON client.id = client_user.client_id where  bus.id in('.$ids.') ORDER BY  bus.id DESC';
   		
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getBusPdf($ids)
   	{
   		// $query = 'SELECT * FROM bus where id in('.$ids.')';

   		$query = 'SELECT bus.id as bus_id,bus.bus_unique_id,bus.bus_number,bus.bus_plate_number,bus.bus_note,bus.bus_status,bus.is_delete,bus.created_at,bus.updated_at,bus.client_user_id,client.client_name,client_user.id as client_user_id FROM bus LEFT JOIN client_user ON client_user.id = bus.client_user_id LEFT JOIN client ON client.id = client_user.client_id where  bus.id in('.$ids.')';


        $query = $this->db->query($query);

		$data = $query->result_array();

   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('client_name').'</th>
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
					 <td>'.$row['client_name'].'</td>
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
   
   		$query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number,client.client_name,client_user.id as client_user_id FROM driver LEFT JOIN bus ON bus.id = driver.bus_id  LEFT JOIN client_user ON client_user.id = driver.client_user_id LEFT JOIN client ON client.id = client_user.client_id where driver.id in('.$ids.') ORDER BY  driver.id DESC';
   		
        $query = $this->db->query($query);

		return $query->result_array();
   	}

   	function getDriverPdf($ids)
   	{
   		$query = 'SELECT driver.id as driver_id,driver.client_user_id,driver.driver_unique_id,driver.driver_name,driver.bus_id,driver.note,driver.driver_status,driver.is_delete,driver.created_at,driver.updated_at,bus.bus_unique_id,bus.bus_plate_number,bus.bus_number,client.client_name,client_user.id as client_user_id FROM driver LEFT JOIN bus ON bus.id = driver.bus_id  LEFT JOIN client_user ON client_user.id = driver.client_user_id LEFT JOIN client ON client.id = client_user.client_id where driver.id in('.$ids.')';

        $query = $this->db->query($query);
		$data = $query->result_array();


   		// print_r($data);die;
   		$output = '<table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">'.$this->lang->line('s_no').'</th>
                                    <th scope="col">'.$this->lang->line('client_name').'</th>
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
			if($row['driver_status'] ==1)
			{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('active').'</span>';
			}else{
				$status = '<span class="btn-success btn btn-sm">'.$this->lang->line('deactive').'</span>'; 
			}

			$date = date("d/m/Y", strtotime($row['updated_at']));

			$output .= '
				<tr>
					 <td>'.$i.'</td>
					 <td>'.$row['client_name'].'</td>
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
}