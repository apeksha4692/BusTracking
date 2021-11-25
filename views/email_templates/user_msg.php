<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enquiry User</title>
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
      <tr style="color: #000;">
      <!-- <td style="text-align: center; background: rgb(109, 102, 102) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-size: 22px; font-family: sans-serif;"> -->
      <td style="text-align: center; background: #f8ab3b;color: #fff; font-size: 22px; font-family: sans-serif;">
        <p>Enquiry User </p>
      </td>
    </tr>
     <tr  bgcolor="" style="">
            <td>
               <table width="100%">
                  <tr>
                     <td style="padding:15px; width: 30%;">Name</td>
                     <td style="padding:15px; width: 1%;">:</td>
                     <td style="padding:15px; width: 65%; color: #878787;"><?= $name?> </td>
                  </tr>
                  <tr>
                     <td style="padding:15px; width: 30%;">Email</td>
                     <td style="padding:15px; width: 1%;">:</td>
                     <td style="padding:15px; width: 65%; color: #878787;"><?= $email?></td>
                  </tr>
                  <tr>
                     <td style="padding:15px; width: 30%;">Subject</td>
                     <td style="padding:15px; width: 1%;">:</td>
                     <td style="padding:15px; width: 65%; color: #878787;"><?= $topic?></td>
                  </tr>
                  <tr>
                     <td style="padding:15px; width: 30%;">Message</td>
                     <td style="padding:15px; width: 1%;">:</td>
                     <td style="padding:15px; width: 65%; color: #878787;"><?= $message?></td>
                  </tr>
                 
               </table>
            </td>
         </tr>
      <tr>
      <tr>
        <td style="font-family: sans-serif; width: 100%; padding: 0 2rem; color: #000; font-size: 16PX; text-align: left;">

          <p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;"><b><?php echo $this->lang->line('beste_regards'); ?>  </b></p>

          <p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;"><?php echo $this->lang->line('wasalo'); ?></p>

          <p style="font-size: 14px;"><b><?php echo $this->lang->line('email_id'); ?>:</b>info@wasalo.com</p>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>