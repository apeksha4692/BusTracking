
 <div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-3">
                <div class="mr-auto">
                    <h4><? echo $title;?></h4>
                 </div>
                 <div class="ml-auto">
                    <a class="text-dark" href="<?php echo site_url('admin/clientuser');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                 </div> 
            </div>
            <form class="" action="<?php echo site_url('admin/clientuser_update');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                 <input type="hidden" name="id" value="<?php echo $getclientUserData->client_user_id?>">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    <?php echo $this->lang->line('client_name'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="client_name" type="text" placeholder="User Name" name="client_name" required data-parsley-required data-parsley-required-message="User Name" value="<?php echo $getclientUserData->client_name?>" readonly>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">
                                    <?php echo $this->lang->line('client_user_name'); ?>
                                 </label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="username" type="text" placeholder="<?php echo $this->lang->line('client_user_name'); ?> " name="username" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_user_name'); ?>" value="<?php echo $getclientUserData->username?>">
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('client_email_id'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="email" type="text" placeholder="<?php echo $this->lang->line('client_email_id'); ?>" name="email" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_email_id'); ?>" type="email" data-parsley-type="email"  value="<?php echo $getclientUserData->email?>">
                                 </div>
                            </div>  
                         </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('client_mobile_number'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control phoneno" id="mobile_number" type="text" placeholder="<?php echo $this->lang->line('client_mobile_number'); ?>" name="mobile_number" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_mobile_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?> "  data-id="phone_number" data-parsley-minlength="10" data-parsley-maxlength="10"  data-parsley-maxlength-message=""data-parsley-minlength-message="" onblur="mustBeValidMobile(this,'errmsg_phoneno')" value="<?php echo $getclientUserData->mobile_number?>">
                                    <span id="errmsg_phoneno" style="color: red"></span>
                                 </div>
                            </div>  
                         </div>
                        
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('login_user_name'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="login_username" type="text" placeholder="<?php echo $this->lang->line('login_user_name'); ?>" name="login_username" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_login_user_name'); ?>" onblur="check_loginUserName(this.value)" value="<?php echo $getclientUserData->login_username?>">
                                    <span id="errmsg_login_username" style="color: red"></span>
                                 </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('login_password'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="login_password" type="text" placeholder="Login Password" name="login_password" readonly value="<?php echo $getclientUserData->login_password?>">
                                 </div>
                                 <!-- <a class="btn-outline-warning btn btn-sm">Regene</a> -->
                                  <!-- <input type="button" class="btn-outline-warning btn btn-sm" value="Generate" onClick="randomPassword(8);"> -->
                            </div>  
                         </div>
                        

                    </div>
                </div> 

                <div class="col-sm-12">
                    <div class="row flex-row-reverse">
                        <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                         <button class="btn-outline-warning btn btn-sm" type="submit"><?php echo $this->lang->line('save'); ?></button>
                    </div>  
                </div>  

            </form>
        </div>
    </div> 
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#client_id').select2();

    });

  /*  $("#condimentForm").validate({
        rules: { condiment: "required" }
    });*/

    function randomPassword(length) 
    {
      // alert(length);
         // chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
         // chars = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" ;
        chars = '@&%ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }

        myform.login_password.value = pass;
    }

    //check valid number   
    $('.phoneno').each(function(){
        $(this).mask('9999999999');
    });

    // ------check mobile number validation----
    function mustBeValidMobile(el, msgEl) {
        if( el.value === '' || el.value === null || el.value === undefined ) {
            return;
        }

        if((el.value).length < 10) {
            $(`#${msgEl}`).text('<?php echo $this->lang->line("enter_10_number")?>'); 
        } else {
            $(`#${msgEl}`).text(''); 
        }
    }

//Check login User name available
    function check_loginUserName(login_username)
    {
        // alert(login_username);
        if(login_username != ''){

             $.ajax({
                url: '<?php echo site_url("admin/clientuser/check_loginUserName"); ?>',
                type: "POST",
                data: {
                    "login_username" : login_username
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_login_username').html('');
                    } else {
                        
                        // $('#errmsg_login_username').html('User Name ALready Exit');
                        $('#errmsg_login_username').html("<?php echo $this->lang->line('user_name_already_exit'); ?>");
                        $('#login_username').val('');
                    }
                }
            });
        }

    }
</script>