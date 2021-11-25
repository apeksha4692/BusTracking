
         <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo base_url().'subadmin/trip_view/'.$trip_add_parents->tripId;?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('subadmin/trip/update_trip_parents');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <div class="row">
                        <!-- <input type="hidden" name="trip_date" value="<?php echo $trip_add_parents->trip_date; ?>"> -->
                        <input type="hidden" name="trip_id" value="<?php echo $trip_add_parents->tripId; ?>">
                        <!--<input type="hidden" name="trip_date" value="<?php echo $trip_add_parents->trip_date; ?>">-->
                        <input type="hidden" name="trip_status" value="<?php echo $trip_add_parents->complete_status; ?>">
                        <input type="hidden" name="trip_add_parents_id" value="<?php echo $trip_add_parents->trip_add_parents_id; ?>">
                         <div class="col-sm-12 ">
                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('parent'); ?></label>
                                     <div class="col-sm-9">
                                        <!-- <select class="form-control" data-live-search="true" name="parents_id" id="parents_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >
                                            <option value=""><?php echo $this->lang->line('select_parents'); ?></option>
                                             <?php foreach ($getAllParent as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['parents_name']; ?></option>
                                             <?php } ?>
                                        </select> -->

                                       <select class="form-control" data-live-search="true" name="parents_id" id="parents_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >
                                        <option value="">Select Client</option>
                                        <?php foreach ($getAllParent as $key) { ?>
                                            <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $trip_add_parents->parents_id ? 'selected' : '' ?>><?php echo $key['parents_name']; ?></option>
                                         <?php } ?>
                                    </select>
                                     </div>
                                </div>  
                             </div>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('note'); ?></label>
                                     <div class="col-sm-9">
                                         <!-- <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" required data-parsley-required-message="<?php echo $this->lang->line('enter_note'); ?>"> -->
                                         <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" value="<?php echo $trip_add_parents->note; ?>">
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
        $('#parents_id').select2();

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
</script>