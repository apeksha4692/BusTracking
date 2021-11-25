<div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo site_url('admin/reporting/bus_list');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('admin/reporting/bus_insert');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <div class="row">
                         <div class="col-sm-12 ">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <!--<?php echo $this->lang->line('client_name'); ?>-->
                                        <?php echo $this->lang->line('clients'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                        <select class="form-control" data-live-search="true" name="client_id" id="client_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>" onchange="getClientUser(this.value);">
                                            <option value="">Select Client</option>
                                             <?php foreach ($getAllClient as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php if(!empty($post['client_id'])){echo $post['client_id'] == $key['id'] ? 'selected' : '';}else{"";}?>><?php echo $key['client_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>

                           
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('clients_portal_user'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <!--<select class="form-control" data-live-search="true" name="client_user_id" id="client_user_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>" onchange="getClientUserBus(this.value);">-->
                                         <select class="form-control" data-live-search="true" name="client_user_id" id="client_user_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>">
                                             <?php if(!empty($post['client_user_id'])){?> 
                                            <?php foreach ($getAllClientUser as $k) { ?>
                                                <option data-tokens="<?php echo $k['id']; ?>" value="<?php echo $k['id']; ?>" <?php if(!empty($post['client_user_id'])){echo $post['client_user_id'] == $k['id'] ? 'selected' : '';}else{"";}?>><?php echo $k['username']; ?></option>
                                             <?php } ?>
                                        <?php }else{?>  
                                             <option value="0">Select Client User</option>
                                        <?php }?>    
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('bus_number'); ?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control" type="text" id="bus_number"  placeholder="<?php echo $this->lang->line('bus_number'); ?>"name="bus_number" required data-parsley-required-message="<?php echo $this->lang->line('enter_bus_number'); ?>" onKeyUp="check_busNumber(this.value)" >
                                         <span id="errmsg_bus_number" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>

                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3"><?php echo $this->lang->line('bus_plate_number'); ?></label>
                                     <div class="col-sm-9">
                                        <!--<input class="form-control" type="text" id="bus_plate_number"  placeholder="<?php echo $this->lang->line('bus_plate_number'); ?>"name="bus_plate_number" required data-parsley-required-message="<?php echo $this->lang->line('enter_bus_plate_number'); ?>" onblur="check_busPlateNumber(this.value)" value="<?php if(!empty($post['f_name'])){echo $post['f_name'];}else{"";}?>">-->
                                        <!-- <span id="errmsg_bus_plate_number" style="color: red"></span>-->
                                         
                                         <input class="form-control" type="text" id="bus_plate_number"  placeholder="<?php echo $this->lang->line('bus_plate_number'); ?>"name="bus_plate_number" required data-parsley-required-message="<?php echo $this->lang->line('enter_bus_plate_number'); ?>"  value="<?php if(!empty($post['bus_plate_number'])){echo $post['bus_plate_number'];}else{"";}?>">
                                         <span id="errmsg_bus_plate_number" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('note'); ?></label>
                                     <div class="col-sm-9">
                                         <input class="form-control"  type="text" id="bus_note" placeholder="<?php echo $this->lang->line('note'); ?>" name="bus_note" value="<?php if(!empty($post['bus_note'])){echo $post['bus_note'];}else{"";}?>">
                                         <!-- <input class="form-control"  type="text" id="bus_note" placeholder="<?php echo $this->lang->line('note'); ?>" name="bus_note" required data-parsley-required-message="<?php echo $this->lang->line('enter_note'); ?>"> -->

                                     </div>
                                </div>  
                             </div>
                             
                         </div>
                    </div> 

                    <div class="col-sm-12">
                        <div class="row flex-row-reverse">
                             <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                              <button class="my-btn" type="submit"><?php echo $this->lang->line('save'); ?></button>
                        </div>  
                    </div>  
                </form>    
               </div>
             </div> 
         </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#client_id').select2();
        $('#client_user_id').select2();

    });

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

        myform.secret_code.value = pass;
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

    function getClientUser(client_id){
        // alert(cat_id);
        $.ajax({
            url: '<?php echo site_url("admin/reporting/BusController/getClientUser"); ?>',
            type: "POST",
            data: {
                "client_id" : client_id
            },
            success: function (response) 
            {
                console.log(response);

                if (response == '0') {
                    $('#client_user_id').html('<option value="0">No Client User Found</option>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                    var html = '';
                    // html += '<option value="0">Other</option>'

                    for(var i=0; i<obj.length; i++){
                        // console.log(obj[i]['sub_category_id']);
                        // html += '<option value="'+obj[i]['sub_category_id']+'">'+obj[i]['sub_category_name']+'</option>'
                        html += '<option data-tokens="'+obj[i]['id']+'" value="'+obj[i]['id']+'">'+obj[i]['username']+'</option>'
                    }

                    $('#client_user_id').html(html);
                }
            }
        });
    }


    function getClientUserBus(client_user_id)
    {
        // alert('hi');
         $.ajax({
            url: '<?php echo site_url("admin/reporting/BusController/getClientUserBus"); ?>',
            type: "POST",
            data: {
                "client_user_id" : client_user_id
            },
            success: function (response) 
            {
                console.log(response);

                if (response == '0') {
                    $('#bus_id').html('<option value="0">Bus User Found</option>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                    var html = '';
                    // html += '<option value="0">Other</option>'

                    for(var i=0; i<obj.length; i++){
                        html += '<option data-tokens="'+obj[i]['id']+'" value="'+obj[i]['id']+'">'+obj[i]['bus_number']+'</option>'
                    }

                    $('#bus_id').html(html);
                }
            }
        });

    }
    
      function check_busPlateNumber(bus_plate_number)
    {
    //   alert('hi');
        // alert(bus_plate_number);
        var client_user_id = $('#client_user_id').val();
        if(bus_plate_number != ''){

             $.ajax({
                url: '<?php echo site_url("admin/reporting/BusController/check_busPlateNumber"); ?>',
                type: "POST",
                data: {
                    "bus_plate_number" : bus_plate_number,
                    "client_user_id" : client_user_id,
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_bus_plate_number').html('');
                    } else {
                        
                        $('#errmsg_bus_plate_number').html("<?php echo $this->lang->line('plz_number_already_exit'); ?>");
                        $('#bus_plate_number').val('');
                    }
                }
            });
        }
    }

    function check_busNumber(bus_number)
    {
      // alert('hi');
        // alert(bus_plate_number);
        // var e = document.getElementById("client_user_id");
        var client_user_id = $('#client_user_id').val();
        // alert(e);
        if(bus_number != ''){

             $.ajax({
                url: '<?php echo site_url("admin/reporting/BusController/check_busNumber"); ?>',
                type: "POST",
                data: {
                    "bus_number" : bus_number,
                    "client_user_id" : client_user_id,
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_bus_number').html('');
                    } else {
                        
                        $('#errmsg_bus_number').html("<?php echo $this->lang->line('bus_number_alerady'); ?>");
                        $('#bus_number').val('');
                    }
                }
            });
        }
    }
</script>