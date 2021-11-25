<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_subadminlogin();
       
         $this->load->library('excel');
        $this->load->library('csvimport');
        // $this->load->library('pdf');
	}


    public function bus_list()
    {
        $data['title'] = $this->lang->line('buses');

        $data['bus_count'] = $this->CommonModel->select_single_row("Select count(*) as bus_total from bus where client_user_id =".$this->session->userdata('ses_subadmin_id')."");
        $where = array(
            "is_delete"         =>  0,
            "client_user_id"    =>  $this->session->userdata('ses_subadmin_id')
        );

        $data['getAllBus'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'bus','bus.id');

        // $this->loadSubAdminView('subadmin/bus/bus_list',$data); 
        $this->loadSubAdminView('subadmin/bus/list',$data); 
    }

    public function bus_add()
    {   
        $data['title'] = $this->lang->line('add_bus');


        $this->loadSubAdminView('subadmin/bus/add_bus',$data); 

    }


    public function bus_insert()
    {
        $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

        $count_data= $busdata_max+1;//autoincrement

        $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
        $bus_code = 'BUS'.$rand; 

        // print_r($bus_code);die;

        $data = array(
                    "bus_number"            =>  $this->input->post('bus_number'),
                    "bus_plate_number"      =>  $this->input->post('bus_plate_number'),
                    "bus_note"              =>  $this->input->post('bus_note'),
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_unique_id"         =>  $bus_code,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'bus');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_add_successfully'));
            // redirect('subadmin/bus_add'); 
            redirect('subadmin/bus'); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('bus_not_add_successfully'));
             redirect('subadmin/bus_add'); 
            
        }

    }

    public function check_busPlateNumber()
    {
        $condition = array(
            "bus_plate_number" => $this->input->post('bus_plate_number'),
             "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function check_busNumber()
    {
        // echo "string";

        $condition = array(
            "bus_number" => $this->input->post('bus_number'),
             "is_delete" => 0
        );
        $busData = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        if ($busData) {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function view_bus()
    {

        $data['title'] = $this->lang->line('bus_detail');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['busDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        // print_r($data['busDetail']);die;

        $this->loadSubAdminView('subadmin/bus/view_bus',$data); 
    }

    public function bus_edit()
    {

        $data['title'] = $this->lang->line('bus_detail');

        $condition = array(
                'id' => $this->uri->segment(3)
        );
        $data['busDetail'] = $this->CommonModel->selectRowDataByCondition($condition,'bus');
        // print_r($data['busDetail']);die;

        $this->loadSubAdminView('subadmin/bus/edit_bus',$data); 
    }

    public function bus_update()
    {
        // print_r($_POST);die;
        $condition = array(
                'id' => $this->input->post('bus_id')
        );
        // print_r($condition);die;

        $data = array(
                     "bus_number"           =>  $this->input->post('bus_number'),
                    "bus_plate_number"      =>  $this->input->post('bus_plate_number'),
                    "bus_note"              =>  $this->input->post('bus_note'),
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_update_successfully'));
            redirect('subadmin/bus'); 
            // redirect('subadmin/bus_edit/'.$this->input->post('bus_id')); 
        }else{

            $this->session->set_flashdata('error',$this->lang->line('bus_not_update_successfully'));
             redirect('subadmin/bus_edit/'.$this->input->post('bus_id')); 
            
        }
    }

    public function changeStatus()
    {

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('bus_id')),'bus');

        $condition = array(
            "id" => $this->input->post('bus_id')
        );
        if($data->bus_status == 1){
            $data = array("bus_status" => '0');
        }else{
            $data = array("bus_status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_bus()
    {
        $val = explode(',',($this->input->post('busId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'bus');

            if($busData)
            {
                $updateData = $this->CommonModel->delete($where,'bus'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                redirect('subadmin/bus'); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_delete_successfully'));
             redirect('subadmin/bus'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('bus_not_delete_successfully'));
             redirect('subadmin/bus'); 
        }
           
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(4));
// print_r($where);die;
        $busData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(4)),'bus');
// print_r($busData);die;
        if($busData){

            // $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'bus'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('bus_delete_successfully'));
                 redirect('subadmin/bus'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('bus_not_delete_successfully'));
                 redirect('subadmin/bus'); 
            }
        }

        else{
             
            $this->session->set_flashdata('error','Something Went Wrong');
            redirect('subadmin/bus'); 
            
        }
    }
    
    public function import_bus()
    {
        // PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
       // PHPExcel_Settings::setZipClass(PHPExcel_Settings::ZIPARCHIVE);
        //PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        $path = $_FILES["file"]["tmp_name"];
        
        $object = PHPExcel_IOFactory::load($path);
      
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

                $count_data= $busdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $bus_code = 'BUS'.$rand;

                $bus_number         =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $bus_plate_number   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $bus_note           =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                // print_r($bus_number);
                // echo "<br>";
                // print_r($bus_plate_number);
                // echo "<br>";
                // print_r($bus_note);

                // $where = array('bus_number'=>$bus_number);
                $where = array(
                        'bus_number'     => $bus_number,
                        'client_user_id' => $this->session->userdata('ses_subadmin_id')
                    );
                $busDetail = $this->CommonModel->getsingle('bus',$where);

                if(!empty($busDetail))
                {
    
                    $newData[] = array(
                            'id'            => $busDetail->id,
                            'bus_number'    => $busDetail->bus_number,
                            'plate_number'  => $bus_plate_number,
                            'note'          => $bus_note,
                    );
                    
                    // $check = explode(", ",$arr);

                    $plateNumberString[] = $bus_plate_number;
                    $plateNumber = implode(",", $plateNumberString);

                    $notetring[] = $bus_note;
                    $busNote = implode(",", $notetring);

                    $busNumbertring[] = $bus_number;
                    $busNumber = implode(",", $busNumbertring);

                    $comma_string[] = $busDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;

                }
                else
                {
                    // echo "string";
                     $data = array(
                        "bus_number"            =>  $bus_number,
                        "bus_plate_number"      =>  $bus_plate_number,
                        "bus_note"              =>  $bus_note,
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "bus_unique_id"         =>  $bus_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $set = $this->CommonModel->insertData($data,'bus');  
                }
            }
            // print_r($plate_number);die;
            // die;
            
            if($set)
            {   
                if (!empty($arr)) 
                {
                    $id = $arr;
                    $countBus = $this->CommonModel->countDuplicateBus($id);
                    // print_r($countBus->busTotal);die;

                    $data = array(
                        'count'         =>  $countBus->busTotal,
                        'id'            =>  $arr,
                        // 'newData'       =>  $newData,
                        'bus_number'    =>  $busNumber,
                        'note'          =>  $busNote,
                        'plateNumber'   =>  $plateNumber,
                    );

                    echo json_encode($data);
                }else{
                    // echo "0";
                    echo "1";
                }
                
            }else{
                echo "0";
            }
        }   
    }


    public function replaceDeuplicateData()
    {

        $id = explode(',',($this->input->post('id'))); 
        $busNumber = explode(',',($this->input->post('bus_number'))); 
        $note       = explode(',',($this->input->post('note'))); 
        $plateNumber = explode(',',($this->input->post('plateNumber'))); 

        // print_r($busNumber);

        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'bus'); 
        }
        // die;

        for ($i=0; $i < count($busNumber); $i++) 
        { 
            $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');
            $count_data= $busdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $bus_code = 'BUS'.$rand;
            
            $where = array( 
                "bus_number"=>  $busNumber[$i],
                'client_user_id' => $this->session->userdata('ses_subadmin_id')
            );
            $busDetail = $this->CommonModel->getsingle('bus',$where);
            
            if($busDetail)
            {
                $condition = array('id'=>$busDetail->id);

                $data = array(
                     "bus_number"            =>  $busNumber[$i],
                    "bus_plate_number"      =>  $plateNumber[$i],
                    "bus_note"              =>  $note[$i],
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  
                
            }else{
                 $data = array(
                    "bus_number"            =>  $busNumber[$i],
                    "bus_plate_number"      =>  $plateNumber[$i],
                    "bus_note"              =>  $note[$i],
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_unique_id"         =>  $bus_code,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->insertData($data,'bus');
            }
            
           
        }
        if($set)
        {
            $this->session->set_flashdata('success',$this->lang->line('bus_update_successfully'));
             redirect('subadmin/bus'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('bus_not_update_successfully'));
             redirect('subadmin/bus'); 
        }
    }


    public function import_bus_Old()
    {
        // PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
       // PHPExcel_Settings::setZipClass(PHPExcel_Settings::ZIPARCHIVE);
        //PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        $path = $_FILES["file"]["tmp_name"];
        
        $object = PHPExcel_IOFactory::load($path);
      
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

                $count_data= $busdata_max+1;//autoincrement

                $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
                $bus_code = 'BUS'.$rand;

                $bus_number         =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $bus_plate_number   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $bus_note           =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();

//                 print_r($bus_number);
//                 echo "<br>";
//                 print_r($bus_plate_number);
//                 echo "<br>";
//                 print_r($bus_note);
// die;
                // $where = array('bus_number'=>$bus_number);
                $where = array(
                        'bus_number'     => $bus_number,
                        'client_user_id' => $this->session->userdata('ses_subadmin_id')
                    );
                $busDetail = $this->CommonModel->getsingle('bus',$where);

                if(!empty($busDetail))
                {
                    

                    $condition = array('id'=>$busDetail->id);

                    $data = array(
                        "bus_number"            =>  $bus_number,
                        "bus_plate_number"      =>  $bus_plate_number,
                        "bus_note"              =>  $bus_note,
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

                    $set = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  

                }else{
                     $data = array(
                        "bus_number"            =>  $bus_number,
                        "bus_plate_number"      =>  $bus_plate_number,
                        "bus_note"              =>  $bus_note,
                        "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                        "bus_unique_id"         =>  $bus_code,
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $set = $this->CommonModel->insertData($data,'bus');  
                }
            }
            
            if($set)
            {
                echo "1";
            }else{
                echo "0";
            }
        }   
    }
    
     public function import_busOld()
    {
         $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;


        foreach($file_data as $row)
        {


            $bus_number         =   $row["us Numbe"];
            $bus_plate_number   =   $row["Plate Numbe"];
            $bus_note           =   $row["Note"];

            $busdata_max = $this->db->select('id')->order_by('id','desc')->limit(1)->get('bus')->row('id');

            $count_data= $busdata_max+1;//autoincrement

            $rand = str_pad($count_data, 5, '0', STR_PAD_LEFT);
            $bus_code = 'BUS'.$rand;

           

            $where = array('bus_number'=>$bus_number);
            $busDetail = $this->CommonModel->getsingle('bus',$where);

            if(!empty($busDetail))
            {
                
                $condition = array('id'=>$busDetail->id);

                $data = array(
                    "bus_number"            =>  $bus_number,
                    "bus_plate_number"      =>  $bus_plate_number,
                    "bus_note"              =>  $bus_note,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'bus',$data);  

            }else{
                 $data = array(
                    "bus_number"            =>  $bus_number,
                    "bus_plate_number"      =>  $bus_plate_number,
                    "bus_note"              =>  $bus_note,
                    "client_user_id"        =>  $this->session->userdata('ses_subadmin_id'),
                    "bus_unique_id"         =>  $bus_code,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );
              
                $set = $this->CommonModel->insertData($data,'bus');  
            }
        }

        
        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function excelBusList()
    {
        // $fileName = 'bus-'.time().'.xlsx';  
        $fileName = 'bus-'.time().'.xls';  

        $ids = $this->input->post('busId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getBusExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('bus_id_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('bus_plate_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('modify'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('note'));
        
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
         $i = 1;
        foreach ($empInfo as $element) 
        {
            // if($element['bus_status'] ==1)
            // {
            //     $status = $this->lang->line('active');
            // }else{
            //     $status = $this->lang->line('deactive'); 
            // }

            $date = date("d/m/Y", strtotime($element['updated_at']));

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['bus_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['bus_plate_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount,$date);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['bus_note']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $status);
            $rowCount++;
            $i++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cutomer_Report.xls"');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }

    public function pdfBusList()
    {
        $fileName = 'bus-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('busId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('clients').'</h3>';
        $html_content .= $this->PdfModel->getBusPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
       
    }
    public function exportCSV()
    {
        $ids = $this->input->post('busId');
        //get data 
        $usersData = $this->PdfModel->getBusCsv($ids);

        // print_r($usersData);die;

        // $filename = 'bus-'.time().'.csv';  
        $filename = 'bus-'.time().'.xlsx';  

        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
     
        // file creation 
        $file = fopen('php://output', 'w');
     
       // $header = array("Bus Number","Plate Number","Note","Modify"); 
        $header = array("Bus Number","Plate Number","Note"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }

    public function editBus()
    {
        $ids = $this->input->post('busId');
        // print_r($ids);die;

        redirect('subadmin/bus_edit/'.$ids);
    }
    public function import_bus_view()
    {
        $data['title'] = $this->lang->line('import_bus');
        // echo "string"; die;
        $this->loadSubAdminView('subadmin/bus/import_view',$data); 
    }

    public function donwload_bus_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "bus.csv";
        // $fileName = "bus.xlsx";
        $fileName = "bus.xls";
        if ($fileName) 
        {

            $file = realpath ("download" ) . "/" . $fileName;
            // print_r($file);die;
            // check file exists    
            if (file_exists ( $file )) 
            {
                // echo "string";die;
                // get file content
                $data = file_get_contents ( $file );
                //force download
                force_download ($fileName, $data );
            } else {
                // echo "strings";die;
                // Redirect to base url
                redirect ( base_url () );
            }
        }
    }

}
