 <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><? echo $title;?></h4>
                         </div>
                         <div class="ml-auto">
                              <a class="text-dark" href="<?php echo site_url('subadmin/bus');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                              
                         </div> 
                    </div>
                <form method="post" action="<?php echo site_url('subadmin/bus_insert');?>" enctype="multipart/form-data" data-parsley-validate>
                    <div class="row">
                        <div class="col-sm-12 ">
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('bus_number'); ?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control" type="text" id="bus_number"  placeholder="<?php echo $this->lang->line('bus_number'); ?>"name="bus_number" required data-parsley-required-message="<?php echo $this->lang->line('enter_bus_number'); ?>" onblur="check_busNumber(this.value)">
                                         <span id="errmsg_bus_number" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>

                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('bus_plate_number'); ?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control" type="text" id="bus_plate_number"  placeholder="<?php echo $this->lang->line('bus_plate_number'); ?>"name="bus_plate_number" required data-parsley-required-message="<?php echo $this->lang->line('enter_bus_plate_number'); ?>" onblur="check_busPlateNumber(this.value)">
                                         <span id="errmsg_bus_plate_number" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('note'); ?></label>
                                     <div class="col-sm-9">
                                         <input class="form-control"  type="text" id="bus_note" placeholder="<?php echo $this->lang->line('note'); ?>" name="bus_note">
                                         <!-- <input class="form-control"  type="text" id="bus_note" placeholder="<?php echo $this->lang->line('note'); ?>" name="bus_note" required data-parsley-required-message="<?php echo $this->lang->line('enter_note'); ?>"> -->

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

         
<script type="text/javascript">

    function check_busPlateNumber(bus_plate_number)
    {
      // alert('hi');
        // alert(bus_plate_number);
        if(bus_plate_number != ''){

             $.ajax({
                url: '<?php echo site_url("subadmin/check_busPlateNumber"); ?>',
                type: "POST",
                data: {
                    "bus_plate_number" : bus_plate_number
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
        if(bus_number != ''){

             $.ajax({
                url: '<?php echo site_url("subadmin/BusController/check_busNumber"); ?>',
                type: "POST",
                data: {
                    "bus_number" : bus_number
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

        