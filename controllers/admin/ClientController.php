<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientController extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->common->check_adminlogin();
        $this->load->library('excel');
        // $this->load->library('csvimport');
	}

    public function clent_list()
    {
        // echo "string";die;
         $data['client_count'] = $this->CommonModel->select_single_row("Select count(*) as client_total from client ");

        $data['title'] = 'Client List';

        $where = array(
            "delete" => 0
        );

        $data['getAllClient'] = $this->CommonModel->selectResultDataByConditionAndFieldName($where,'client','client.id');

        $this->loadAdminView('admin/client/list_client',$data); 
    }

    public function client_add()
    {
        $data['title'] = 'Add Client';

         $this->loadAdminView('admin/client/add_client',$data); 
    }
    
    public function check_UserFocalemail()
    {
         $client_id = $this->input->post('client_id');
         
        if($client_id == 0) {
            $condition = array(
                "focal_point_email" => $this->input->post('focal_point_email'),
            );
            
        }else{
            $condition = "(focal_point_email='".$this->input->post('focal_point_email')."' AND id !=".$client_id.")";
        }
        
        $clientData = $this->CommonModel->selectRowDataByCondition($condition,'client');
        if ($clientData) {
            echo "1";
        }else{
            echo "0";
        }
    }
    
    public function check_UserFocalNumber()
    {
        $client_id = $this->input->post('client_id');
        
        if($client_id == 0) {
            $condition = array(
                "focal_point_number" => $this->input->post('focal_point_number'),
            );
            
        }else{
            $condition = "(focal_point_number='".$this->input->post('focal_point_number')."' AND id !=".$client_id.")";

        }
        
        $clientData = $this->CommonModel->selectRowDataByCondition($condition,'client');
        if ($clientData) {
            echo "1";
        }else{
            echo "0";
        }

    }
    public function client_insert()
    {
        // print_r($_POST);die;
        
        $client_focal_email=  $this->input->post('focal_point_email');
        $client_focal_number = $this->input->post('focal_point_number');
        // $condition = array(
        //     "focal_point_email" => $this->input->post('focal_point_email'),
        //     //  "is_delete" => 0
        // );
        $condition = "(focal_point_email='".$client_focal_email."' or focal_point_number=".$client_focal_number.")";
        $clientData = $this->CommonModel->selectRowDataByCondition($condition,'client');
        
        // print_r($clientData);die;
        
        if(!empty($clientData)){
            $data['title'] = 'Add Client';
            $data['post'] = $_POST;
            // print_r($data['post'] );die;
             $this->session->set_flashdata('error','Email Already exit. Used different email');
            $this->loadAdminView('admin/client/add_client',$data);
                    //  redirect('admin/client/add',$data); 
                    
            return;
        }
        // echo "1";die;
        // die;
        $config['upload_path']          =  'uploads/client/';
        $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_pic')) 
        {
            $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                     redirect('admin/client/add'); 
        } 
        else 
        {
            $logo_image = $this->upload->data('file_name');  
        }

        $data = array(
                    "client_name"           =>  $this->input->post('client_name'),
                    "focal_point_name"      =>  $this->input->post('focal_point_name'),
                    "focal_point_number"    =>  $this->input->post('focal_point_number'),
                    "focal_point_email"     =>  $this->input->post('focal_point_email'),
                    "max_chaperone"         =>  $this->input->post('max_chaperone'),
                    "max_parent"            =>  $this->input->post('max_parent'),
                    "status"                =>  $this->input->post('status'),
                    'logo_image'            =>  $logo_image,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $insertData = $this->CommonModel->insertData($data,'client');  

        if ($insertData) 
        {
            $this->session->set_flashdata('success',$this->lang->line('client_add_successfully'));
            // redirect('admin/client/add');
            redirect('admin/client'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('client_not_add_successfully'));
            redirect('admin/client/add'); 
            
        }

    }
    
  

    public function changeStatus()
    {

       $data = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->input->post('client_id')),'client');

        $condition = array(
            "id" => $this->input->post('client_id')
        );
        if($data->status == 1){
            $data = array("status" => '0');
        }else{
            $data = array("status" => '1');
        }

        $updateData = $this->CommonModel->updateRowByCondition($condition,'client',$data);  

        if($updateData)
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function delete_client()
    {
        $val = explode(',',($this->input->post('cliendId')));

        foreach ($val as $key => $value) 
        {
            $where = array('id'=>$value);

            $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $value),'client');

            if($clientData)
            {
                $updateData = $this->CommonModel->delete($where,'client'); 
            }
            else{
                $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
                 redirect('admin/client'); 
            }
        }

        if($updateData)
        {
            $this->session->set_flashdata('success',$this->lang->line('client_delete_successfully'));
             redirect('admin/client'); 
        }else{
            $this->session->set_flashdata('error',$this->lang->line('client_not_delete_successfully'));
             redirect('admin/client'); 
        }
    }

    public function delete()
    {
        $where = array('id'=>$this->uri->segment(4));

        $clientData = $this->CommonModel->selectRowDataByCondition(array('id' =>  $this->uri->segment(4)),'client');

        if($clientData){

            $data = array("delete" => '1');
            
            $updateData = $this->CommonModel->delete($where,'client'); 

            if($updateData)
            {
                $this->session->set_flashdata('success',$this->lang->line('client_delete_successfully'));
                 redirect('admin/client'); 
            }else{
                $this->session->set_flashdata('error',$this->lang->line('client_not_delete_successfully'));
                 redirect('admin/client'); 
            }
        }

        else{
             
             $this->session->set_flashdata('error',$this->lang->line('somethings_went_wrong'));
            
        }
    }

    public function client_view()
    {
        $data['title'] = 'View Client';

        $where = array('id'=>$this->uri->segment(4));
// print_r($where);die;
        $data['getclientData'] = $this->CommonModel->getsingle('client',$where);

        $this->loadAdminView('admin/client/view_client',$data); 
    }   

    public function client_edit()
    {
        $data['title'] = 'Edit Client';

        $where = array('id'=>$this->uri->segment(4));

        $data['getclientData'] = $this->CommonModel->getsingle('client',$where);


        $this->loadAdminView('admin/client/edit_client',$data); 
        
    }

    public function client_update()
    {
        $condition = array(
            "id" => $this->input->post('id')
        );

        $clientData = $this->CommonModel->getsingle('client',$condition);

        // print_r($clientData->logo_image);die;
        
        $condition = "(focal_point_email='".$client_focal_email."' or focal_point_number=".$client_focal_number.")";
        $clientData = $this->CommonModel->selectRowDataByCondition($condition,'client');
        
        // print_r($clientData);die;
        
        if(!empty($clientData)){
            $data['title'] = 'Edit Client';
            $data['post'] = $_POST;
            $where = array('id'=>$this->uri->segment(4));
    
            $data['getclientData'] = $this->CommonModel->getsingle('client',$where);
            $this->session->set_flashdata('error','Email Already exit. Used different email');
            $this->loadAdminView('admin/client/edit_client',$data);
                    
            return;
        }
        

        if (isset($_FILES['profile_pic'])) 
        {  
            if($_FILES['profile_pic']['size'] != 0)
            {
                 $config['upload_path']         =  'uploads/client/';
                $config['allowed_types']        =  'jpeg|jpg|png|JPEG|JPG|PNG';
                $config['max_size']             =  (1024)*(1024);
                $config['max_width']            =  0;
                $config['max_height']           =  0;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('profile_pic'))
                {
                    $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                    $this->session->set_flashdata('error','You select invalid image format');
                    redirect('admin/profile');
                }
                else
                {
                    $this->upload_data['file'] = $this->upload->data();
                    $logo_image = $this->upload->data('file_name');      
                }
            }
            else
            {
               $logo_image = $clientData->logo_image; 
            }
        }
        else
        {
           $logo_image = $clientData->logo_image; 
        }

        $data = array(
                    "client_name"           =>  $this->input->post('client_name'),
                    "focal_point_name"      =>  $this->input->post('focal_point_name'),
                    "focal_point_number"    =>  $this->input->post('focal_point_number'),
                    "focal_point_email"     =>  $this->input->post('focal_point_email'),
                    "max_chaperone"         =>  $this->input->post('max_chaperone'),
                    "max_parent"            =>  $this->input->post('max_parent'),
                     "status"                =>  $this->input->post('status'),
                    'logo_image'            =>  $logo_image,
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
            );

        $updateData = $this->CommonModel->updateRowByCondition($condition,'client',$data);  

        if ($updateData) 
        {
            $this->session->set_flashdata('success','Client Detail Updated Successfully');
            // redirect('admin/client/edit/'.$this->input->post('id')); 
            redirect('admin/client');
        }else{
            $this->session->set_flashdata('error','Client Detail not Updated Successfully ');
            redirect('admin/client/edit/'.$this->input->post('id')); 
            
        }
    }

    public function import_client()
    {
        // echo "string";die;
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        // print_r($object);die;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for($row=2; $row<=$highestRow; $row++)
            {

                $client_name         =   $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $client_focal_name   =   $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $client_focal_number =   $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $client_focal_email  =   $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $max_chaperone       =   $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $max_parent          =   $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                // print_r($client_name);
                // print_r($client_focal_name);
                // print_r($client_focal_number);
                // print_r($client_focal_email);
                // print_r($max_chaperone);
                // print_r($max_parent);
                // echo "<br>";
                // $where = array('focal_point_email'=>$client_focal_email);
                
                $where = "(focal_point_email='".$client_focal_email."' or focal_point_number=".$client_focal_number.")";
                $clientDetail = $this->CommonModel->getsingle('client',$where);

                if(!empty($clientDetail))
                {
                   
                    // $check = explode(", ",$arr);

                    $clientNameString[] = $client_name;
                    $clientName = implode(",", $clientNameString);

                    $clientFocalNametring[] = $client_focal_name;
                    $clientFocalName = implode(",", $clientFocalNametring);

                    $clientFocalNumbertring[] = $client_focal_number;
                    $clientFocalNumber = implode(",", $clientFocalNumbertring);
                    
                    $clientFocalEmailString[] = $client_focal_email;
                    $clientFocalEmail = implode(",", $clientFocalEmailString);
                    
                    $maxChaperoneString[] = $max_chaperone;
                    $maxChaperone = implode(",", $maxChaperoneString);
                    
                    $maxParentString[] = $max_parent;
                    $maxParentEmail = implode(",", $maxParentString);
                    
                    $logoImgString[] = $clientDetail->logo_image;
                    $logoImg = implode(",", $logoImgString);

                    $comma_string[] = $clientDetail->id;
                    $arr = implode(",", $comma_string);
                    // print_r($arr);

                    $set = $arr;
                    
                    
                    // $condition = array('id'=>$clientDetail->id);

                    // $data = array(
                    //     "client_name"           =>  $client_name,
                    //     "focal_point_name"      =>  $client_focal_name,
                    //     "focal_point_number"    =>  $client_focal_number,
                    //     "focal_point_email"     =>  $client_focal_email,
                    //     "max_chaperone"         =>  $max_chaperone,
                    //     "max_parent"            =>  $max_parent,
                    //     "updated_at"            =>  date('Y-m-d H:i:s a'),
                    // );

                    // $set = $this->CommonModel->updateRowByCondition($condition,'client',$data);  

                }else{
                    $data = array(
                        "client_name"           =>  $client_name,
                        "focal_point_name"      =>  $client_focal_name,
                        "focal_point_number"    =>  $client_focal_number,
                        "focal_point_email"     =>  $client_focal_email,
                        "max_chaperone"         =>  $max_chaperone,
                        "max_parent"            =>  $max_parent,
                        "status"                =>  '1',
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );
                  
                    $set = $this->CommonModel->insertData($data,'client');  
                }
            }
            if($set)
            {
                // echo "1";
                 if (!empty($arr)) 
                {
                    $id = $arr;
                    $countCLient = $this->CommonModel->countDuplicateClient($id);
                    // print_r($countBus->busTotal);die;

                    $data = array(
                        'count'            =>  $countCLient->clientTotal,
                        'id'               =>  $arr,
                        // 'newData'       =>  $newData,
                        'clientName'       =>  $clientName,
                        'clientFocalName'  =>  $clientFocalName,
                        'clientFocalNumber'  =>  $clientFocalNumber,
                        'clientFocalEmail' =>  $clientFocalEmail,
                        'maxChaperone'     =>  $maxChaperone,
                        'maxParentEmail'   =>  $maxParentEmail,
                        'logoImg'          =>  $logoImg,
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
    
    public function replaceClientDuplicateData()
    {
        // print_r($_POST);die;
        
         $id = explode(',',($this->input->post('id'))); 
        $clientName = explode(',',($this->input->post('clientName'))); 
        $clientFocalName       = explode(',',($this->input->post('clientFocalName'))); 
        $clientFocalNumber       = explode(',',($this->input->post('clientFocalNumber'))); 
        $clientFocalEmail = explode(',',($this->input->post('clientFocalEmail'))); 
        $maxChaperone = explode(',',($this->input->post('maxChaperone'))); 
        $maxParentEmail = explode(',',($this->input->post('maxParentEmail'))); 
        $logoImg = explode(',',($this->input->post('logoImg'))); 
        
        foreach ($id as $key => $v) 
        {
            // print_r($v);
            $where = array('id'=>$v);
            $updateData = $this->CommonModel->delete($where,'client'); 
        }
        
        for ($i=0; $i < count($clientName); $i++) 
        { 
             $data = array(
                        "client_name"           =>  $clientName[$i],
                        "focal_point_name"      =>  $clientFocalName[$i],
                        "focal_point_number"    =>  $clientFocalNumber[$i],
                        "focal_point_email"     =>  $clientFocalEmail[$i],
                        "max_chaperone"         =>  $maxChaperone[$i],
                        "max_parent"            =>  $maxParentEmail[$i],
                        "logo_image"            =>  $logoImg[$i],
                        "status"                =>  '1',
                        "created_at"            =>  date('Y-m-d H:i:s a'),
                        "updated_at"            =>  date('Y-m-d H:i:s a'),
                    );

            $set = $this->CommonModel->insertData($data,'client');
        }
        
        if ($set) 
        {
            $this->session->set_flashdata('success','Client Detail Updated Successfully');
            // redirect('admin/client/add');
            redirect('admin/client'); 
        }else{
            $this->session->set_flashdata('error','Client detail not updated successfully');
            redirect('admin/client/add'); 
            
        }
        
        
    }
    
     public function import_clientOld()
    {
        // $path = $_FILES["file"]["tmp_name"];
        $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
        // print_r($file_data);die;

        foreach($file_data as $row)
        {
            $client_name         =   $row["Client Name"];
            $client_focal_name   =   $row["focal point name"];
            $client_focal_number =   $row["focal point numbe"];
            $client_focal_email  =   $row["focal email"];
            $max_chaperone       =   $row["max use"];
            $max_parent          =   $row["max pare"];

            $where = array('focal_point_email'=>$client_focal_email);
            $clientDetail = $this->CommonModel->getsingle('client',$where);

            if(!empty($clientDetail))
            {
                
                $condition = array('id'=>$clientDetail->id);

                $data = array(
                    "client_name"           =>  $client_name,
                    "focal_point_name"      =>  $client_focal_name,
                    "focal_point_number"    =>  $client_focal_number,
                    "focal_point_email"     =>  $client_focal_email,
                    "max_chaperone"         =>  $max_chaperone,
                    "max_parent"            =>  $max_parent,
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );

                $set = $this->CommonModel->updateRowByCondition($condition,'client',$data);  

            }else{
                $data = array(
                    "client_name"           =>  $client_name,
                    "focal_point_name"      =>  $client_focal_name,
                    "focal_point_number"    =>  $client_focal_number,
                    "focal_point_email"     =>  $client_focal_email,
                    "max_chaperone"         =>  $max_chaperone,
                    "max_parent"            =>  $max_parent,
                    "status"                =>  '1',
                    "created_at"            =>  date('Y-m-d H:i:s a'),
                    "updated_at"            =>  date('Y-m-d H:i:s a'),
                );
              
                $set = $this->CommonModel->insertData($data,'client');  
            }
        }
        if($set)
        {
            echo "1";
        }else{
            echo "0";
        }
    }


     public function excelClientList()
    {
        $fileName = 'client-'.time().'.xls';  

        $ids = $this->input->post('cliendId');

        $this->load->library('excel');

        $empInfo = $this->PdfModel->getClientExcel($ids);

        // print_r($empInfo);die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('s_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('client_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $this->lang->line('focal_point_name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('focal_point_number'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('focal_point_email'));       
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('max_chaperone_user'));      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('max_portal_user'));       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('status'));      
        // set Row
        $rowCount = 2;
          $i = 1;
        foreach ($empInfo as $element) 
        {
            if($element['status'] ==1)
            {
                $status = $this->lang->line('active');
            }else{
                $status = $this->lang->line('deactive'); 
            }

            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['client_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['focal_point_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['focal_point_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['focal_point_email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['max_chaperone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['max_parent']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status);
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

    public function pdfClientList()
    {
        $fileName = 'client-'.time().'.pdf';  

        // echo "string";
        $ids = $this->input->post('cliendId');

        // print_r($ids);die;

        $html_content = '<h3 align="center">'.$this->lang->line('clients').'</h3>';
        $html_content .= $this->PdfModel->getClientPdf($ids);
        // print_r($html_content);die;
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        // $this->pdf->stream($fileName , array("Attachment"=>0));
        $this->pdf->stream($fileName);
        // $this->pdf->stream(array("Attachment"=>0));
        
    }
     public function editClient()
    {
        $ids = $this->input->post('cliendId');
        // print_r($ids);die;

        redirect('admin/client/edit/'.$ids);
    }

     public function import_client_view()
    {
        $data['title'] = $this->lang->line('import_client');
        // echo "string"; die;
        $this->loadAdminView('admin/client/import_view',$data); 
    }

    public function donwload_client_import($fileName = NULL)
    {
        // echo "string";die;
        $this->load->helper('download');
        // echo "string";
        // print_r($fileName);die;
        // $fileName = "client.csv";
        // $fileName = "client.xlsx";
        $fileName = "client.xls";
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
