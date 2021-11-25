<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $this->lang->line('reset_password'); ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assest/parsley.min.js"></script>
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

</head>

<body style="margin:0; background-color: #f4f4f4">
  <style type="text/css">
    
            @media only screen and (min-width: 767px){
                .tableFull, .tableHAlf {
                  width:320px !important;
                }
            }
  </style>
  <table style="width: 50%; background: #fff; max-width: 90%; margin: 0 auto; font-size: 14px; color: gray; padding-top: 0rem; box-shadow: 0 0 30px rgba(37,45,51,.1)!important;">
    
    <tbody>
    <tr style="color: #000;">
      <td>
        <table style="width: 100%; padding: 2rem;">
          <tr>
            <td width="" style="width: 100%; text-align:center;">
              <a href="#" style="text-decoration: none; font-family: sans-serif;">
                <strong style="font-size: 50px; color: #333;">
                  <img src="<?php echo base_url(); ?>assest/img/logo.png" alt="logo" width="200px">
                </strong>
              </a>              
            </td>
          </tr>
        </table>    
      </td>
    </tr> 
    <tr style="color: #000;">
      <!-- <td style="text-align: center; background: rgb(109, 102, 102) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-size: 22px; font-family: sans-serif;"> -->
      <td style="text-align: center; background: #f8ab3b;color: #fff; font-size: 22px; font-family: sans-serif;">
        <p><?php echo $this->lang->line('reset_your_password'); ?> </p>
      </td>
    </tr>
  <tr>
    <td style="font-family: sans-serif; width: 100%; padding: 0 2rem; color: #000; font-size: 16PX; text-align: left;">

      <p style="color: #666; font-size: 18px; text-align: left;"><?php echo $this->lang->line('hello'); ?>, 
        <span style="color: #333;"><?=$username?></span>
      </p>

      <form style="margin: 50px 0;" method="post" action="<?=base_url();?>auth/verify_subamdinresetpassword?id=<?=$client_user_id?>" data-parsley-validate>
        <input style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #f8ab3b;outline: none;width: 60%;margin: 0 auto 20px;" type="password" name="new_password" placeholder="<?php echo $this->lang->line('new_password'); ?>" required data-parsley-required-message="<?php echo $this->lang->line('enter_new_password'); ?> " id="new_password" data-parsley-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" data-parsley-pattern-message="<?php echo $this->lang->line('password_validation'); ?> " data-parsley-required>
        <!-- <span id="validate-status1"></span> -->

        <input style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #f8ab3b;outline: none;width: 60%;margin: 0 auto 20px;" type="password" name="confirm_password" placeholder="<?php echo $this->lang->line('confirm_password'); ?>" required data-parsley-required-message="<?php echo $this->lang->line('enter_confirm_password'); ?>" data-parsley-equalto="#new_password" data-parsley-equalto-message="<?php echo $this->lang->line('new_confirm_password_shoul_be_same'); ?> " id="confirm_password">

        <p id="validate-status"></p>

       <input id="forget_password" type="submit" value="submit" style="width: 63%;display: block;height: 40px;text-transform: uppercase;margin: 0 auto;border-radius: 50px;border: 2px solid #f8ab3b;background: transparent;outline: none;text-align: center;color: #333;font-weight: 600;cursor: pointer;">

      </form>

 
       <p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;">
       	<b><?php echo $this->lang->line('beste_regards'); ?>  </b>
       </p>

      <p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;"><?php echo $this->lang->line('wasalo'); ?></p>

      <p style="font-size: 14px;"><b><?php echo $this->lang->line('email_id'); ?>:</b>info@wasalo.com</p>

</td>
  </tr>

  </tbody>      
  </table>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">
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

</script>
