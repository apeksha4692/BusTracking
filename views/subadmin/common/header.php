<!DOCTYPE html>

<!-- <html lang="en"> -->

<html lang="<?php if(!empty($this->session->userdata('site_lang'))){echo $this->session->userdata('site_lang');}else{ echo "english";}?>">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $this->lang->line('school_bus_tracking'); ?> </title>

    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assest/img/favicon.png">

    <!-- Font Awesome -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>assest/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->

    <link href="<?php echo base_url(); ?>assest/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->


    <link href="<?php echo base_url(); ?>assest/css/style.css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assest/parsley.min.js"></script>
    <link href="<?php echo base_url(); ?>assest/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/toastr.min.css">

    <style type="text/css">
      .parsley-errors-list{
          color: red;
          list-style-type: none;
          padding: 0;
          margin: 0;
      }
    </style>
    <!-- Data table For pdf,export-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
        
         <link href="<?php echo base_url(); ?>assest/timer_picker/timepicki.css" rel="stylesheet">

</head>



<body>
<nav class="navbar navbar-expand-lg navbar-blue bg-white">
  <div class="container-fluid">
  <a class="navbar-brand mt-3" href="<?php echo site_url('subadmin/bus');?>"><img width="300px" src="<?php echo base_url(); ?>assest/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);

        if($record_num=='bus'||$record_num=='bus_add'||$record_num1=='bus_edit'||$record_num=='import_bus_view'){
            $bus_class = 'nav-link active';
        }else{
            $bus_class = 'nav-link';
        }

        if($record_num=='driver'||$record_num=='driver_add'||$record_num1=='driver_edit'||$record_num=='import_driver_view'){
            $driver_class = 'nav-link active';
        }else{
            $driver_class = 'nav-link';
        }

        if($record_num=='chaperone'||$record_num=='chaperone_add'||$record_num1=='chaperone_edit'||$record_num=='import_chaperone_view'){
            $chaperone_class = 'nav-link active';
        }else{
            $chaperone_class = 'nav-link';
        }

        if($record_num=='parents'||$record_num=='parents_add'||$record_num1=='parents_edit'||$record_num=='import_parents_view'||$record_num1=='parents_view'||$record_num1=='add_child'||$record_num1=='edit_child'){
            $parents_class = 'nav-link active';
        }else{
            $parents_class = 'nav-link';
        }
        
         if($record_num1=='track'){
            $track_class = 'nav-link active';
        }else{
            $track_class = 'nav-link';
        }
         if($record_num=='trip_list'|| $record_num=='trip_add'||$record_num1=='import_parents_trip_view'||$record_num1=='trip_view'||$record_num1=='add_parents'||$record_num1=='edit_parents'||$record_num1=='edit_trip'||$record_num1=='trip_add_parents_child'||$record_num1=='edit_child_parents' ){
            $trip_class = 'nav-link active';
        }else{
            $trip_class = 'nav-link';
        }

        if($record_num=='bus'||$record_num=='bus_add'||$record_num1=='bus_edit'||$record_num=='driver'||$record_num=='driver_add'||$record_num1=='driver_edit'||$record_num=='chaperone'||$record_num=='chaperone_add'||$record_num1=='chaperone_edit'||$record_num=='parents'||$record_num=='parents_add'||$record_num1=='parents_edit'||$record_num=='import_bus_view'||$record_num=='import_parents_view'||$record_num=='import_chaperone_view'||$record_num=='import_driver_view'||$record_num=='trip_list'|| $record_num=='trip_add'||$record_num1=='import_parents_trip_view'||$record_num1=='trip_view'||$record_num1=='add_parents'||$record_num1=='edit_parents'||$record_num1=='edit_trip'||$record_num=='status'||$record_num=='map'||$record_num1=='parents_view'||$record_num1=='add_child'||$record_num1=='edit_child'||$record_num1=='trip_add_parents_child'||$record_num1=='edit_child_parents' ){
            $home = 'nav-link active';
        }else{
            $home = 'nav-link';
        }

        if($record_num=='how_to'){
            $how_to = 'nav-link active';
        }else{
            $how_to = 'nav-link';
        }

        if($record_num=='about_us'){
            $about_us = 'nav-link active';
        }else{
            $about_us = 'nav-link';
        }

        if($record_num=='contactUs'){
            $contactUs = 'nav-link active';
        }else{
            $contactUs = 'nav-link';
        }
    ?>




  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="<?= $home; ?>" href="<?php echo site_url('subadmin/bus');?>"><?php echo $this->lang->line('home'); ?> </a>
      </li>
      <li class="nav-item">
        <a class="<?= $how_to; ?>" href="<?php echo site_url('subadmin/how_to');?>"><?php echo $this->lang->line('how_to'); ?> </a>
      </li>
    
      <li class="nav-item">
        <a class="<?= $about_us; ?>" href="<?php echo site_url('subadmin/about_us');?>"><?php echo $this->lang->line('about_us'); ?></a>
      </li>
      <li class="nav-item">
        <a class="<?= $contactUs; ?>" href="<?php echo site_url('subadmin/contactUs');?>"><?php echo $this->lang->line('contact_us'); ?></a>
      </li>
    </ul>
    <!-- <div  class="my-2 my-lg-0 ml-auto">
       
      <ul class="navbar-nav justify-content-center d-flex align-items-center">
      <li class="nav-item">
          <a class="nav-link">
             
             English
          </a>  
      </li> 
      <li class="nav-item">
          <a class="nav-link">
             
             Arabic
          </a>  
      </li> 
      </ul>  
    </div> -->

    <div  class="my-2 my-lg-0 ml-auto">
       
      <ul class="navbar-nav justify-content-center d-flex align-items-center">
      <li class="nav-item">
          <p class="mb-0 my-1">
              <!--<span class="active mr-2 english">English</span>-->
              <!--<span class="arabic"> عربي  </span>-->
                <span class="mr-2 english <?php if(!empty($this->session->userdata('site_lang'))){ if($this->session->userdata('site_lang') == 'english'){ echo "active";}}else{echo "active";}?>" ><a onclick="changeLang('english')">English</a></span>
              <span class="arabic <?php if($this->session->userdata('site_lang') == 'arabic'){ echo "active";}?>"><a onclick="changeLang('arabic')">عربي</a></span>  
          </p>
          <?php if(!empty($getSubAdminData)){?>
          <p class="mb-0 my-0"><?php echo $getSubAdminData->username; ?></p>
           <p class="mb-0 my-0"><?php echo $getSubAdminData->client_name; ?></p>
          <!-- <p class="mb-0 text-warning text-right">Sign Out</p> -->
          <p class="mb-0">
            <a class="text-warning" href="<?php echo base_url().'subadmin/logout'?>">
              <?php echo $this->lang->line('signu_out'); ?>
            </a>
          </p>
          <?php }?>
      </li>
      <?php if(!empty($getSubAdminData)){
         if(!empty($getSubAdminData->logo_image))
           {
             $subadmin_img = CLIENT_IMG.$getSubAdminData->logo_image;
           }else{
             $subadmin_img =  COMMON_IMG; 
           }  
      ?>
      
      <li class="nav-item">
         <a class="d-block mr-2 ml-5 profile-img" ><img class="uers-img" src="<?php echo $subadmin_img; ?>" ></a>
       </li>
      
        <?php }?>
      </ul>  
      <style type="text/css">
     
      </style>
    </div>
  </div>
</div>
</nav>

<? if($record_num !='how_to' && $record_num !='about_us'  && $record_num !='contactUs') { ?>
  <div class="client-portal">
    <!-- if($record_num=='about_us'){ -->
    <div class="container-fluid">
         <div class="filter-menu mb-3 px-3">
            <ul class="nav">
            
                <li class="nav-item">
                   
                    <a class="<?= $bus_class; ?>" href="<?php echo site_url('subadmin/bus');?>"><?php echo $this->lang->line('bus'); ?> </a>
                </li>  
                <li class="nav-item">
                    <a class="<?= $driver_class; ?>" href="<?php echo site_url('subadmin/driver');?>"><?php echo $this->lang->line('driver'); ?> </a>
                </li>  
                <li class="nav-item">
                    <a class="<?= $chaperone_class; ?>" href="<?php echo site_url('subadmin/chaperone');?>"><?php echo $this->lang->line('chaperone'); ?></a>
                </li>  
                <li class="nav-item">
                    <a class="<?= $parents_class; ?>" href="<?php echo site_url('subadmin/parents');?>"><?php echo $this->lang->line('parent'); ?></a>
                </li>  
                <li class="nav-item">
                    <a class="<?= $trip_class; ?>" href="<?php echo site_url('subadmin/trip_list');?>">Trip</a>
                </li>
                 <li class="nav-item">
                    <a class="<?= $track_class; ?>" href="<?php echo site_url('subadmin/track/status');?>">Track</a>
                </li>        
             </ul>
         </div>
    <?php } ?>



