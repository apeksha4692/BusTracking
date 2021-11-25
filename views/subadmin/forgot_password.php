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

    <link rel="stylesheet" href="https://fontawesome.com/v4.7.0/assets/font-awesome/css/font-awesome.css">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>assest/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->

    <link href="<?php echo base_url(); ?>assest/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      .navbar {
            box-shadow: none;
            border-bottom: none !important;
        }
        body {
        height: 100vh;
        background-image: url(http://sliceledger.com/bus_tracking/assest/img/loginbg.png);
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: bottom;
        position: relative;
        }
    </style>
</head>



<body>
<nav class="navbar navbar-expand-lg navbar-blue bg-white">
  <div class="container-fluid">
  <a class="navbar-brand mt-3" href="#"><img width="300px" src="<?php echo base_url(); ?>assest/img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">Homepage </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">About Us</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="faq.html">F.A.Q</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact-us.html">Cantact Us</a>
      </li>
    </ul> -->
    <div  class="my-2 my-lg-0 ml-auto">
       
      <ul class="navbar-nav justify-content-center d-flex align-items-center">
      <li class="nav-item english">
          <a <?php if(!empty($this->session->userdata('site_lang'))){ if($this->session->userdata('site_lang') == 'english'){?>class="nav-link active"<?php } else{?>class="nav-link" <?php }}else{?>class="nav-link active"<?php } ?> onclick="changeLang('english')">
             
             English
          </a>  
      </li> 
      <li class="nav-item arabic">
          <a <?php if($this->session->userdata('site_lang') == 'arabic'){?>class="nav-link active"<?php } else{?>class="nav-link" <?php } ?>  onclick="changeLang('arabic')">
            ععربي
          </a>  
      </li> 
      </ul>  
    </div>
  </div>
</div>
</nav>

<div class="login">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <h4><?php echo $this->lang->line('forgot_password'); ?> </h4>
                <form class="login-form" action="<?php echo site_url('subadmin/send_mail');?>" method="POST" data-parsley-validate>

                    <div class="form-group">
                       <input placeholder="<?php echo $this->lang->line('email_id'); ?>" class="form-control" type="text" name="email" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_email_id'); ?>" type="email" data-parsley-type="email" >
                    </div> 
                    <div class="flex-row-reverse d-flex">
                        <div class="">  
                          <button class="btn-login"><?php echo $this->lang->line('submit'); ?></button> 
                        </div>
                    </div> 
                </form> 
            </div>  
        </div>
    </div>  
    <div class="copyright text-center ">

     <ul class="nav d-flex justify-content-center">
       <li class="nav-item"> <a href="" class="nav-link"><?php echo $this->lang->line('about_us'); ?> </a></li>
       <li class="nav-item"> <a href="" class="nav-link"><?php echo $this->lang->line('contact_us'); ?></a> </li>
     </ul>  
   <p> © <?php echo date("Y");  ?> <?php echo $this->lang->line('copyright'); ?> <?php echo $this->lang->line('zamqan'); ?>. <?php echo $this->lang->line('all_right_reserved'); ?></p> 
</div> 
</div>

   

<!-- <footer>
    <div class="container-fluid">
       <div class="pl-2">
            <img width="128" src="img/logo.png">
       </div> 
       <div class="col-sm-12">
             <div class="row pl-5">
                 <div class="col-sm-3">
                     <a class="nav-link" href="">About Us</a>   
                     <a class="nav-link" href="">F.A.Q</a>   
                     <a class="nav-link" href="">Contact Us</a>   
                     
                 </div>   
                 <div class="col-sm-3">
                     <a class="nav-link" href="">Privacy Policy </a>   
                     <a class="nav-link" href="">Terms & Conditions</a>   
                     <a class="nav-link" href="">Cookie Policy</a>   
                     
                 </div>   
                 <div class="col-sm-3 text-center">
                    <a class="nav-link" href="">Follow Us on Social Media</a>   
                     <a class="nav-link social-media" href="">
                       <img src="img/fb.svg">
                       <img src="img/insta.svg">
                       
                       
                    </a>
                 </div>   
                 <div class="col-sm-3">
                     <a class="nav-link" href="">Downlode The Footy app</a>   
                     <div class="d-flex justify-content-between mt-2">
                         <a href=""> <img width="124px" src="img/btn-android.png"></a>     
                         <a href=""> <img width="124px" src="img/btn-ios.png"></a>
                     </div>     
                 </div>   
               </div> 
       </div>           
    </div>    
</footer> 
 -->





    <!-- SCRIPTS -->

    <!-- JQuery -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap tooltips -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/mdb.min.js"></script>

    <!-- my core JavaScript -->
    

     <script type="text/javascript">
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });

        $('.alert-danger').delay(7000).fadeOut();    
        $('.alert').delay(5000).fadeOut(); 


        <?php if($this->session->flashdata('success')){ ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php }else if($this->session->flashdata('error')){  ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php }else if($this->session->flashdata('warning')){  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php }else if($this->session->flashdata('info')){  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>

         //----------change language------------

    function changeLang(lang)
    {
        // alert(lang);
        // var lang = this.value;
        $.ajax({
            url: '<?php echo site_url("LanguageSwitcher/switchLang"); ?>',
            type: "POST",
            data: {
            "lang"     : lang,
            },
            success: function (response) 
            {
                // alert(response);
                // console.log(response);
                if (response == 1) 
                {
                    location.reload();
                } 

            }
        });
    }
    </script>
</body>
</html>

