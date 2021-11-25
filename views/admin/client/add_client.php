<div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-4">
                <div class="mr-auto">
                    <h4><? echo $title;?></h4>
                 </div>
                 <div class="ml-auto">
                    <a class="text-dark" href="<?php echo site_url('admin/client');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                 </div> 
            </div>
            <form action="<?php echo site_url('admin/client/insert');?>" enctype="multipart/form-data" method="post" data-parsley-validate="">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    <?php echo $this->lang->line('client_name'); ?>
                                </label>
                                <div class="col-sm-9">
                                     <input class="form-control checkEmail" type="text" placeholder="<?php echo $this->lang->line('client_name'); ?>" name="client_name" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_client_name'); ?> " value="<?php if(!empty($post['client_name'])){echo $post['client_name'];}else{"";}?>">
                                </div>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">
                                     <?php echo $this->lang->line('focal_point_name'); ?>
                                 </label>
                                 <div class="col-sm-9">
                                     <input class="form-control checkEmail" type="text" placeholder="<?php echo $this->lang->line('focal_point_name'); ?>" name="focal_point_name" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_name'); ?>" value="<?php if(!empty($post['focal_point_name'])){echo $post['focal_point_name'];}else{"";}?>">
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('focal_point_number'); ?></label>
                                 <div class="col-sm-9">
                                     <!--<input class="form-control checkEmail" type="text" placeholder="<?php echo $this->lang->line('focal_point_number'); ?>" name="focal_point_number" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php if(!empty($post['focal_point_number'])){echo $post['focal_point_number'];}else{"";}?>">-->
                                     <input class="form-control checkEmail" type="text" placeholder="<?php echo $this->lang->line('focal_point_number'); ?>" id="focal_point_number" name="focal_point_number" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" onKeyUp="check_Usernumber(this.value)">
                                     <span id="errmsg_userNumber" style="color: red"></span>
                                 </div>
                            </div>  
                         </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('focal_point_email'); ?></label>
                                 <div class="col-sm-9">
                                      <input class="form-control checkEmail mail" id="focal_point_email" type="text" placeholder="<?php echo $this->lang->line('focal_point_email'); ?>" name="focal_point_email" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_email'); ?>" type="email"data-parsley-type="email" onKeyUp="check_Useremail(this.value)">
                                     <span id="errmsg_userEmail" style="color: red"></span>
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('max_chaperone_user'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control checkEmail" id="max_chaperone" type="text" placeholder="<?php echo $this->lang->line('max_chaperone_user'); ?>" name="max_chaperone" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_max_chaperone_user'); ?> " data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php if(!empty($post['max_chaperone'])){echo $post['max_chaperone'];}else{"";}?>">
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('max_portal_user'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control checkEmail" id="max_parent" type="text" placeholder="<?php echo $this->lang->line('max_portal_user'); ?>" name="max_parent" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_max_portal_user'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php if(!empty($post['max_parent'])){echo $post['max_parent'];}else{"";}?>">
                                 </div>
                            </div>  
                         </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('logo'); ?></label>
                                 <div class="col-sm-5">
                                      <!--<input class="form-control" type="" name=""> -->
                                     <img width="100" id="img_add" name="img">
                                     <div class="upload-btn-wrapper">
                                      <button class="btn2">Select File</button>
                                      
                                      <input type='file' name="profile_pic" id="imgadd" class="" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('select_img'); ?>"/>
                                      <span id="errmsg_file_type" style="color: red"></span>
                                    </div>
                                 </div>
                                 <!-- <a class="btn-outline-warning btn btn-sm">Regene</a> -->
                                  
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('status'); ?></label>
                                 <div class="col-sm-9">
                                    <select class="form-control mb-0 checkEmail" name="status" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('select_status'); ?>">
                                        <option value=""><?php echo $this->lang->line('select_status')?></option>
                                        <option value="1" <?php if(!empty($post['status'])){echo $post['status'] == '1' ? 'selected' : '';}else{"";}?>><?php echo $this->lang->line('active')?></option>
                                        <option value="0" <?php if(!empty($post['status'])){echo $post['status'] == '1' ? 'selected' : '';}else{"";}?>><?php echo $this->lang->line('deactive')?></option>
                                    </select>
                                 </div>
                            </div>  
                         </div>

                    </div>
                </div> 

                <div class="col-sm-12">
                    <div class="row flex-row-reverse">
                        <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                         <button class="my-btn" type="submit" ><?php echo $this->lang->line('save'); ?></button>
                    </div>  
                </div>  

            </form>
        </div>
    </div> 
</div>

<script type="text/javascript">
   // -------------Add Image Preview------------------------------
   function read(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_add').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgadd").change(function(){
        read(this);
    }); 

//---------------Check Image Type ------------------
    var fileNode = document.querySelector('#imgadd');
    fileNode.addEventListener('change', function( event ) 
    {
        // alert('hi');
        var reader = new FileReader();

        reader.onload = function() {
            // $('#image-preview').css("background-image", "url("+reader.result+")");
            $('#img_add').attr('src', e.target.result);
        }

        reader.readAsDataURL(event.target.files[0]);

        var form = new FormData();
        var xhr  = new XMLHttpRequest();
        var file = this.files[0];
        // var csrfToken = "{{ csrf_token() }}";
// 
        if ( ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'].indexOf(file.type) == -1 ) {
             toastr.error("<?php echo $this->lang->line('file_type_not_allow'); ?>");
            $('#errmsg_file_type').html('<?php echo $this->lang->line('file_type_allow'); ?>');
             return false;
        }
        $('#errmsg_file_type').html('');
    });
//Check User Email available
    function check_Useremail(focal_point_email)
    {
        // alert(focal_point_email);
        if(focal_point_email != ''){

             $.ajax({
                url: '<?php echo site_url("admin/ClientController/check_UserFocalemail"); ?>',
                type: "POST",
                data: {
                    "focal_point_email" : focal_point_email,
                     "client_id"         : 0,
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_userEmail').html('');
                    } else {
                        
                        // $('#errmsg_login_username').html('User Name ALready Exit');
                        $('#errmsg_userEmail').html("Focal Point Email Already Exit");
                        $('#focal_point_email').val('');
                    }
                }
            });
        }
    }
    
    function check_Usernumber(focal_point_number)
    {
        // alert(focal_point_email);
        if(focal_point_number != ''){

             $.ajax({
                url: '<?php echo site_url("admin/ClientController/check_UserFocalNumber"); ?>',
                type: "POST",
                data: {
                    "focal_point_number" : focal_point_number,
                     "client_id"         : 0,
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_userNumber').html('');
                    } else {
                        
                        // $('#errmsg_login_username').html('User Name ALready Exit');
                        $('#errmsg_userNumber').html("Focal Point Number Already Exit");
                        $('#focal_point_number').val('');
                    }
                }
            });
        }
    }
    

    
    
    // $('.checkEmail').on('input', function() 
    // {
    //     // alert('o');
    //      $('#focal_point_email').prop('required',true).prop('data-parsley-required',true).attr('data-parsley-required-message','Email is required');
    // });
    
    // $('#focal_point_email').on('input', function() 
    // {
    //     // alert(1);
    //       var focal_point_email = $('#focal_point_email').val();
    //     //  alert(text);
    //      if(focal_point_email != ''){
    //          $.ajax({
    //             url: '<?php echo site_url("admin/ClientController/check_UserFocalemail"); ?>',
    //             type: "POST",
    //             data: {
    //                 "focal_point_email" : focal_point_email
    //             },
    //             success: function (response) 
    //             {
    //                 console.log(response);

    //                 if (response == '0') {
    //                     $('#errmsg_userEmail').html('');
    //                 } else {
                        
    //                     // $('#errmsg_login_username').html('User Name ALready Exit');
    //                         $('#focal_point_email').prop('required',true).prop('data-parsley-required',true).attr('data-parsley-required-message','Email is required');
    //                     $('#errmsg_userEmail').html("Focal Point Email Already Exit");
    //                     $('#focal_point_email').val('');
    //                     // $('#focal_point_email').prop('data-parsley-required',true).prop('data-parsley-required-message','Email already exit');
    //                     // $('#focal_point_email').prop('required',true).prop('data-parsley-required',true).attr('data-parsley-required-message','Email is required');

    //                     //  $('#focal_point_email').prop('disabled', true);
    //                 }
    //             }
    //         });
    //     }else{
    //         $('#focal_point_email').prop('required',true).prop('data-parsley-required',true).attr('data-parsley-required-message','Email already exit');
    //     }
    // });

</script>