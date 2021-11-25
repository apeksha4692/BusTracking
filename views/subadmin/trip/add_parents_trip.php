<div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo base_url().'subadmin/trip_view/'.$tripDetail->id;?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('subadmin/trip/insert_trip_parents');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <div class="row">
                        <!--<input type="hidden" name="trip_date" value="<?php echo $tripDetail->trip_date; ?>">-->
                        <input type="hidden" name="trip_id" value="<?php echo $tripDetail->id; ?>">
                        <input type="hidden" name="trip_status" value="<?php echo $tripDetail->complete_status; ?>">
                        <div class="col-md-12">
                        <!--    <div class="add_input_item">-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-md-5 col-sm-3">-->
                        <!--                 <div class="form-group ">-->
                        <!--                 <label class="w-100"><?php echo $this->lang->line('parent'); ?></label>-->
                        <!--                    <select class="form-control" data-live-search="true" name="parents_id[]" id="parents_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >-->
                        <!--                        <option value=""><?php echo $this->lang->line('select_parents'); ?></option>-->
                        <!--                         <?php foreach ($getAllParent as $key) { ?>-->
                        <!--                            <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['parents_name']; ?></option>-->
                        <!--                         <?php } ?>-->
                        <!--                    </select>-->
                        <!--                 </div>-->
                        <!--            </div>-->
                              
                        <!--          <div class="col-sm-3">-->
                        <!--             <div class="form-group ">-->
                        <!--                <label class="w-100"><?php echo $this->lang->line('note'); ?></label>-->
                        <!--               <input class="form-control" type="text" name="note[]"  placeholder="<?php echo $this->lang->line('note'); ?>">-->
                        <!--             </div>-->
                        <!--          </div>-->

                        <!--        <div class="col-sm-4 add-btn">-->
                        <!--             <label class="w-100">Action</label>-->
                        <!--             <input type="button" class="item_add btn-block my-btn bg-transparent" value="Add">-->
                                   <!-- <button class="btn btn-primary w-100 item_add" type="submit"> <i class="fa fa-plus fa-3x" aria-hidden="true"></i> &nbsp; Add</button> -->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="">
                                <div class="row">
                                    <div class="col-sm-1">
                                       <div class="form-group ">
                                        <label class="w-100"></label>
                                            <!-- <button type="button" class="p-0 btn-sm text-warning mr-3 bg-transparent border-0 remove_field_div"  title="Remove row"><i class="fa fa-times" aria-hidden="true"></i></button> -->
                                         </div>
                                      </div>
                                    <div class="col-md-5 col-sm-3">
                                         <div class="form-group ">
                                         <label class="w-100"><?php echo $this->lang->line('parent'); ?></label>
                                            <!-- <select class="form-control" data-live-search="true" name="parents_id[]" id="parents_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >
                                                <option value=""><?php echo $this->lang->line('select_parents'); ?></option>
                                                 <?php foreach ($getAllParent as $key) { ?>
                                                    <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['parents_name']; ?></option>
                                                 <?php } ?>
                                            </select> -->
                                         </div>
                                    </div>
                              
                                  <div class="col-sm-3">
                                     <div class="form-group ">
                                        <label class="w-100"><?php echo $this->lang->line('note'); ?></label>
                                       <!-- <input class="form-control" type="text" name="note[]"  placeholder="<?php echo $this->lang->line('note'); ?>"> -->
                                     </div>
                                  </div>

                                <div class="col-sm-3 add-btn">
                                     <label class="w-100">Action</label>
                                     <!-- <input type="button" class="item_add btn-block my-btn bg-transparent" value="Add"> -->
                                   <!-- <button class="btn btn-primary w-100 item_add" type="submit"> <i class="fa fa-plus fa-3x" aria-hidden="true"></i> &nbsp; Add</button> -->
                                </div>
                            </div>
                            <div class="add_input_item">
                                <div class="row">
                                    <div class="col-md-5 col-sm-3">
                                         <div class="form-group ">
                                         <!-- <label class="w-100"><?php echo $this->lang->line('parent'); ?></label> -->
                                            <select class="form-control parentsId_1" data-live-search="true" name="parents_id[]" id="parents_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >
                                                <option value=""><?php echo $this->lang->line('select_parents'); ?></option>
                                                 <?php foreach ($getAllParent as $key) { ?>
                                                    <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['parents_name']; ?></option>
                                                 <?php } ?>
                                            </select>
                                         </div>
                                    </div>
                              
                                  <div class="col-sm-3">
                                     <div class="form-group ">
                                        <!-- <label class="w-100"><?php echo $this->lang->line('note'); ?></label> -->
                                       <input class="form-control" type="text" name="note[]"  placeholder="<?php echo $this->lang->line('note'); ?>" id="note_1">
                                     </div>
                                  </div>

                                <div class="col-sm-3 add-btn ">
                                     <!-- <label class="w-100">Action</label> -->
                                     <button type="button" class="btn-sm text-warning mr-3 bg-transparent border-0  showCrossAfterAdd"  title="Remove row" style="display: none;" ><i class="fa fa-times" aria-hidden="true"></i></button>
                                     <input type="button" class="item_add btn-sm  my-btn bg-transparent showAddBtn" value="Add">
                                     <!--<button type="button" class="btn-sm text-warning mr-3 bg-transparent border-0 item_add showAddBtn"  title="Add row" ><i class="fa fa-plus ml-2" aria-hidden="true"></i></button>-->
                                     
                                     
                                     
                                    
                                   <!-- <button class="btn btn-primary w-100 item_add" type="submit"> <i class="fa fa-plus fa-3x" aria-hidden="true"></i> &nbsp; Add</button> -->
                                </div>
                            </div>
                        </div>
                     </div>
                     </div>



                    </div> 

                    <div class="col-sm-12">
                        <div class="row flex-row-reverse">
                             <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                              <button class="my-btn bg-transparent" type="submit"><?php echo $this->lang->line('save'); ?></button>
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

        var wrapper1         = $(".add_input_item"); //Fields wrapper
        var add_button1      = $(".item_add"); //Add button ID
        
        var y = 1; //initlal text box count
        var yy = 1;
        $(add_button1).click(function(e){ //on add input button click
            e.preventDefault();
            y++; //text box increment
            yy= yy+1; 
             $('.showCrossAfterAdd').show();
            $(wrapper1).append(`
                <div class="row">
                   
                    <div class="col-md-5 col-sm-3">
                         <div class="form-group ">
                       
                            <select class="form-control" data-live-search="true" name="parents_id[]" id="parents_id_`+yy+`"data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_parents'); ?>" >
                                <option value=""><?php echo $this->lang->line('select_parents'); ?></option>
                                 <?php foreach ($getAllParent as $key) { ?>
                                    <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['parents_name']; ?></option>
                                 <?php } ?>
                            </select>
                         </div>
                      </div>
                  
                      <div class="col-sm-3">
                         <div class="form-group ">
                           
                           <input class="form-control" type="text" name="note[]" placeholder="<?php echo $this->lang->line('note'); ?>">
                         </div>
                      </div>
                      <div class="col-sm-3 add-btn">
                        <button type="button" class="btn-sm text-warning mr-3 bg-transparent border-0  remove_field"  title="Remove row"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>

                </div>
            `); //add input box
            
            $('#parents_id_'+yy).select2();
        });


        $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); 
            y--;
        })
        $(wrapper1).on("click",".remove_field_div", function(e){ //user click on remove text
            // alert('helo');
            e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); 
            y--;
            yy--;
            // alert(y);
            if(y == '1')
            {
                // alert('yes');
                $('.showCrossAfterAdd').hide();
                $('.showDeleteBtn').hide();
                $('.showAddBtn').show();
            }
                // alert('no');
        })
    });
    
     $(".showCrossAfterAdd").click(function()
     {
        //  alert('hi');
        $('#note_1').val('');
        $('#parents_id').val(null).trigger('change');
        $('.showCrossAfterAdd').hide();
     });
    
    $(document).ready(function(){
        $('#parents_id').on('change',function(){
           $('.showCrossAfterAdd').show();
        });
        
        $('#note_1').on('blur', function() {
            $('.showCrossAfterAdd').show();
        });
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