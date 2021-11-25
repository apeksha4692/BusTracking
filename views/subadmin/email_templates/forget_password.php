<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $this->lang->line('forgot_password_mail'); ?></title>
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
                <a href="" style="text-decoration: none; font-family: sans-serif;">
                  <strong style="font-size: 50px; color: #333;">
                    <!-- <img src="<?php echo base_url()?>" alt="logo"> -->
                    <img  src="<?php echo base_url(); ?>assest/img/logo.png" alt="logo" width="200px">
                  </strong>
                </a>
                
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="font-family: sans-serif; width: 100%; padding: 0 2rem; color: #000; font-size: 16PX; text-align: left;">
          <p style="color: #666; font-size: 18px; text-align: left;">
          	<?php echo $this->lang->line('hello'); ?>, 
            <span style="color: #333;">
            	<?= $username?>
            </span>
          </p>
          <P style="color: #666; font-size: 15px;">
          	<?php echo $this->lang->line('did_you_forgot_password'); ?>
          </p>
          <p>
            <a href="<?=base_url();?>auth/subadmin_reset_verify?token=<?=$id?>" style="padding: 10px 15px;background: #f8ab3b;color: #fff;border-radius: 50px;width: 50%;margin: 40px auto;text-align: center;text-decoration: none;display: block;"><?php echo $this->lang->line('reset_password'); ?></a>
          </p>

          <p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;"><b><?php echo $this->lang->line('beste_regards'); ?>  </b></p>

          <p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;"><?php echo $this->lang->line('wasalo'); ?></p>

          <p style="font-size: 14px;"><b><?php echo $this->lang->line('email_id'); ?>:</b>info@wasalo.com</p>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>