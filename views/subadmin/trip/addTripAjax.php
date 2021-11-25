<div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('select_bus'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <select class="form-control" data-live-search="true" name="bus_id" id="bus_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_bus'); ?>" >
                                            <option value=""><?php echo $this->lang->line('select_bus'); ?></option>
                                             <?php foreach ($getAllBus as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['bus_number']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>

                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('select_driver'); ?>
                                    </label>
                                    <div class="col-sm-9">

                                        <select class="form-control" data-live-search="true" name="driver_id" id="driver_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_driver'); ?>" >
                                            <option value=""><?php echo $this->lang->line('select_driver'); ?></option>
                                             <?php foreach ($getAllDriver as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['driver_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>


                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('chaperone'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <select class="form-control" data-live-search="true" name="chaperone_id" id="chaperone_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_chaperone'); ?>" >
                                            <option value=""><?php echo $this->lang->line('select_chaperone'); ?></option>
                                             <?php foreach ($getAllChaperone as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['chaperone_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>


<script type="text/javascript">
    $( document ).ready(function() {
        $('#bus_id').select2();
        $('#client_user_id').select2();
        // $('#parents_id').select2();
        $('#driver_id').select2();
        $('#chaperone_id').select2();
        $('#child_id').select2();
    });

    function getParentName(child_id)
    {
        $.ajax({
            url: '<?php echo site_url("subadmin/TripController/getParentName"); ?>',
            type: "POST",
            data: {
                "child_id" : child_id
            },
            success: function (response) 
            {
                console.log(response);
                var obj = JSON.parse(response);
                // alert(obj);

                $('#parents_id').val(obj['parents_id']).attr('readonly',true);
                $('#parents_name').val(obj['parents_name']).attr('readonly',true);
        
        
                
            }
        });

    }
</script>