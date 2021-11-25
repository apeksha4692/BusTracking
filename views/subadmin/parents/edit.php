
         <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo site_url('subadmin/parents');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('subadmin/parents_update');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <input type="hidden" name="parent_id" value="<?= $parentDetail->id;?>">
                    <div class="row">
                         <div class="col-sm-12 ">
                             <div class="form-group">
                                <!--<div class="row align-items-center">-->
                                <!--     <label class="col-sm-3"><?= $this->lang->line('parent_number'); ?> </label>-->
                                <!--     <div class="col-sm-9">-->
                                <!--         <input class="form-control" type="text" name="f_name" placeholder="<?= $this->lang->line('parent_number'); ?> " value="<?= $parentDetail->parents_unique_id;?>" readonly>-->
                                <!--     </div>-->
                                <!--</div>  -->
                             </div>
                             <?php 
                                $names = explode(' ', $parentDetail->parents_name, 2);
                                $f_name = $names[0];
                                // $family_name = $names[1];
                                 if(!empty($names[1])){
                                     $family_name = $names[1];
                                }else{
                                     $family_name = "";
                                }
                             ?>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('first_name'); ?> </label>
                                     <div class="col-sm-9">
                                         <input class="form-control" type="text" name="f_name" placeholder="<?= $this->lang->line('first_name'); ?> " required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_first_name'); ?>" value="<?= $f_name;?>">
                                     </div>
                                </div>  
                             </div>
                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('family_name'); ?> </label>
                                     <div class="col-sm-9">
                                         <input class="form-control" type="text" name="family_name" placeholder="<?= $this->lang->line('family_name'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_family_name'); ?>" value="<?= $family_name;?>">
                                     </div>
                                </div>  
                             </div>

                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('phone_number');?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control phoneno" type="text" name="phone_number" id="parnetns_phone_number" placeholder="<?= $this->lang->line('phone_number');?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_mobile_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?> "  data-id="phone_number" data-parsley-minlength="10" data-parsley-maxlength="10"  data-parsley-maxlength-message=""data-parsley-minlength-message="" onkeyUp="check_parnetsNumber(this.value)" value="<?= $parentDetail->phone_number;?>">
                                        <span id="errmsg_phoneno" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>
                             <!--<div class="form-group">-->
                             <!--   <div class="row align-items-center">-->
                             <!--        <label class="col-sm-3"><?php echo $this->lang->line('assigned_bus'); ?></label>-->
                             <!--        <div class="col-sm-9">-->
                             <!--            <select class="form-control" data-live-search="true" name="bus_id" id="bus_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_bus'); ?>">-->
                             <!--           <option value=""><?php echo $this->lang->line('select_bus'); ?></option>-->
                             <!--            <?php foreach ($getAllBus as $key) { ?>-->
                             <!--               <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $parentDetail->bus_id ? 'selected' : '' ?>><?php echo $key['bus_number']; ?></option>-->
                             <!--            <?php } ?>-->
                             <!--       </select>-->
                             <!--        </div>-->
                             <!--   </div>  -->
                             <!--</div>-->

                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('secret_code'); ?></label>
                                     <div class="col-sm-5">
                                         <input class="form-control" id="secret_code" type="text" placeholder="<?php echo $this->lang->line('secret_code'); ?>" name="secret_code" value= "<?= $parentDetail->secret_code;?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_secret_code'); ?>">
                                     </div>
                                     <!-- <a class="btn-outline-warning btn btn-sm">Regene</a> -->
                                      <input type="button" class="btn-outline-warning btn btn-sm" value="Generate" onClick="randomPassword(8);">
                                </div>  
                             </div>
                             
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3">Note</label>
                                     <div class="col-sm-9">
                                         <!-- <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" required data-parsley-required-message="<?php echo $this->lang->line('enter_note'); ?>" value="<?= $parentDetail->note;?>"> -->
                                         <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" value="<?= $parentDetail->note;?>">
                                     </div>
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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#bus_id').select2();

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
    
      function check_parnetsNumber(parnetns_phone_number)
    {
      // alert('hi');
        // alert(bus_plate_number);
        if(parnetns_phone_number != ''){

             $.ajax({
                url: '<?php echo site_url("subadmin/ParentsController/check_parnetsNumber"); ?>',
                type: "POST",
                data: {
                    "parnetns_phone_number" : parnetns_phone_number
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_phoneno').html('');
                    } else {
                        
                        $('#errmsg_phoneno').html("Parents number already exit");
                        $('#parnetns_phone_number').val('');
                    }
                }
            });
        }
    }
</script>