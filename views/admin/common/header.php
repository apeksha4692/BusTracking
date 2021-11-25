<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $this->lang->line('school_bus_tracking'); ?>  </title>

    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assest/img/favicon.png">

    <!-- Font Awesome -->

    <!-- <link rel="stylesheet" href="https://fontawesome.com/v4.7.0/assets/font-awesome/css/font-awesome.css"> -->
    
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
     <!------------------------ Data table For pdf,export-------------------------------->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

</head>



<body>
<nav class="navbar navbar-expand-lg navbar-blue bg-white">
  <div class="container-fluid">
  <a class="navbar-brand mt-3" href="<?php echo site_url('admin/client');?>"><img width="300px" src="<?php echo base_url(); ?>assest/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link active" href="index.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">How To</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="faq.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact-us.html">Cantact</a>
      </li>
    </ul> -->
    <div  class="my-2 my-lg-0 ml-auto">
       
      <ul class="navbar-nav justify-content-center d-flex align-items-center">
      <li class="nav-item">
          <!-- <span class="text-warning mr-2">
             English
          </span> 
          <span>
            Arabic
          </span>   -->
          <p class="mb-0 my-1">USER: <?php if(!empty($getAdminData->username)){echo $getAdminData->username;}else{echo $getAdminData->name;}  ?></p>
          <!-- <p class="mb-0 text-warning text-right">Sign Out</p> -->
          <p class="mb-0  text-right">
            <a class="text-warning" href="<?php echo base_url().'admin/logout'?>">
              <?php echo $this->lang->line('signu_out'); ?>
            </a>
          </p>
      </li>
      <!-- <li class="nav-item">
         <a class="d-block ml-5 " ><img height="63" width="80" src="img/loginbg.png"></a>
       </li> -->
      </ul>  
    </div>
  </div>

  <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link active" href="index.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">How To</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="faq.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact-us.html">Cantact</a>
      </li>
    </ul>
    <div  class="my-2 my-lg-0 ml-auto">
       
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
    </div>
  </div> -->
</div>
</nav>
<div class="client-portal">
    <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);
    ?>
    
    <?php 
            $checked_arr = explode(",",$getAdminData->role);
            // print_r($checked_arr);
           ?>
    <div class="container-fluid">
         <div class="filter-menu mb-3 px-3">
            <ul class="nav">
                <?php if(in_array("1", $checked_arr)) {     ?>
                    <li class="nav-item">
                         <?php
                            if($record_num=='client'  || $record_num=='add'  || $record_num1=='view'|| $record_num1=='edit'|| $record_num=='import_client_view'){
                                $clientuser_class = 'nav-link active';
                            }else{
                                $clientuser_class = 'nav-link';
                            }
    
                        ?>
                        <a class="<?= $clientuser_class; ?>"  href="<?php echo site_url('admin/client');?>">
                            <?php echo $this->lang->line('clients'); ?>
                        </a>
                    </li> 
                <?php } if(in_array("8", $checked_arr)) {     ?>
                <li class="nav-item">
                    <?php
                        if($record_num=='clientuser'  || $record_num=='clientuser_add'  || $record_num1=='clientuser_view'|| $record_num1=='clientuser_edit'|| $record_num=='import_clientUser_view'|| $record_num=='delete_clientuser'){
                            $clientuser_class = 'nav-link active';
                        }else{
                            $clientuser_class = 'nav-link';
                        }
                    ?>
                   
                    <a class="<?= $clientuser_class; ?>" href="<?php echo site_url('admin/clientuser');?>">
                        <?php echo $this->lang->line('clients_portal_user'); ?>
                    </a>
                </li> 
                <?php } if(in_array("15", $checked_arr)) {     ?>
                <li class="nav-item">
                   <?php
                        if($record_num1=='reporting'|| $record_num=='chaperoneAdd'|| $record_num1=='chaperoneEdit'|| $record_num1=='busEdit'|| $record_num1=='driverEdit'|| $record_num1=='parentsEdit'|| $record_num1=='map'|| $record_num1=='trip_list'){
                            $reporting_class = 'nav-link active';
                        }else{
                            $reporting_class = 'nav-link';
                        }
                    ?>
                    <a class="<?= $reporting_class;?>" href="<?php echo site_url('admin/reporting/map');?>"><?php echo $this->lang->line('reportng'); ?></a>
                </li> 
                <?php } if(in_array("43", $checked_arr)) {     ?>
                 <li class="nav-item">
                     <?php
                        if($record_num=='notification'|| $record_num=='notification_new'){
                            $notification_class = 'nav-link active';
                        }else{
                            $notification_class = 'nav-link';
                        }

                    ?>
                    
                    <a class="<?= $notification_class;?>" href="<?php echo site_url('admin/notification');?>"><?php echo $this->lang->line('notification'); ?></a>
                </li> 
                <?php } if(in_array("44", $checked_arr)) {     ?>
                 <li class="nav-item">
                   <?php
                        if($record_num=='app_list'|| $record_num=='app_add'|| $record_num1=='app_edit'){
                            $app_class = 'nav-link active';
                        }else{
                            $app_class = 'nav-link';
                        }

                    ?>
                    <a class="<?= $app_class;?>" href="<?php echo site_url('admin/app_list');?>"><?php echo $this->lang->line('app'); ?></a>
                </li>
                <?php } if(in_array("45", $checked_arr)) {     ?>
            
                 <li class="nav-item">
                    <?php
                        if($record_num=='user_list'||$record_num=='add_user'||$record_num1=='edit_user'){
                            $admin_class = 'nav-link active';
                        }else{
                            $admin_class = 'nav-link';
                        }
                    ?>
                    <a class="<?= $admin_class;?>" href="<?php echo site_url('admin/admin_portal_user/user_list');?>"><?php echo $this->lang->line('admin_portal_users'); ?></a>
                </li>
                <?php }if(in_array("46", $checked_arr)) {     ?>
                
                 <li class="nav-item">
                     <?php
                    if($record_num=='about_us'||$record_num=='how_to'||$record_num1=='editHow_To'||$record_num=='addHow_To_Img'||$record_num1=='how_to_image_edit'||$record_num=='contact'||$record_num=='contact_information'){
                        $client_class = 'nav-link active';
                    }else{
                        $client_class = 'nav-link';
                    }

                ?>
                    <a class="<?= $client_class;?>" href="<?php echo site_url('admin/client_portal_content/about_us');?>"><?php echo $this->lang->line('client_portal_content'); ?></a>
                </li> 
                <?php } ?>
            </ul>
         </div>


