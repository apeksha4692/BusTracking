<div class="col-sm-7 m-auto">
   <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-4">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                              <a class="text-dark" href="<?php echo site_url('subadmin/parents');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                
                         </div> 
                    </div>
                    <!-- <h5 class="text-uppercase mb-4">Trip ID : Kg13 (240)</h5> -->
                    <p><?php echo $this->lang->line('import_multiple_parents_template'); ?></p>
                    <div class="d-flex flex-row-reverse row">
                        
                        <div class="col-sm-4">
                         <button class="my-btn btn-block bg-transparent" id="btnDelete" onclick="checkValue()" >
                           <?php echo $this->lang->line('download_parents_template'); ?>
                        </button> 
                      </div>

                    </div>  

                    <div class="d-flex mt-5">
                        <form class="w-100" method="post" action="<?php echo site_url('subadmin/import_bus');?>" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                
                                <div id="file-wrap" class="my-3">
                                <p class="text-uppercase"><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>
                                 <div class="d-flex flex-row-reverse row">
                                    <div class="col-sm-4">
                                        <button class="my-btn btn-block bg-transparent" type="submit"><?php echo $this->lang->line('import'); ?> </button>
                                  </div>    
                                </div>
                        </form>
                    </div>  
                
               </div>
             </div>
</div> 







   <!-- <a href="<?=base_url ()?>subadmin/BusController/donwload_bus_import/bus.csv" class="btn btn-primary">Download imp.zip</a>
 -->

 <div class="modal fade" id="confirmationDownload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?=base_url ()?>subadmin/ParentsController/donwload_parents_import" data-parsley-validate>
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirmation_download'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_want_confirm_download'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" id="submitDownload"><?php echo $this->lang->line('yes'); ?> </button>
                            <!-- <a href="<?=base_url ()?>subadmin/BusController/donwload_bus_import/bus.csv" class="btn btn-primary"><?php echo $this->lang->line('yes'); ?></a> -->
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
       <div class="modal fade" id="duplicateData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?=base_url ()?>subadmin/ParentsController/replaceParentsDuplicateData" data-parsley-validate>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('duplicateData'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                          <input type="hidden" name="id" id="total">
                          <input type="hidden" name="chaperoneName" id="chaperoneName">
                          <input type="hidden" name="chaperoneMobile" id="chaperoneMobile">
                          <input type="hidden" name="chaperoneNote" id="chaperoneNote">
                          <input type="hidden" name="secretCode" id="secretCode">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_upload'); ?> 
                            <span id="count"></span>
                            <?php echo $this->lang->line('duplicate_entires_you_want_overwrite_with_entries'); ?> 
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" id=""><?php echo $this->lang->line('yes'); ?> </button>
                            <a href="<?=base_url ()?>subadmin/parents" class="my-btn"><?php echo $this->lang->line('no'); ?></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
    function checkValue()
    {
        
        // $('#errmsg').html('');
        $('#confirmationDownload').modal('show');
        
    }

     $(document).ready(function(){
      $("#submitDownload").click(function(){        
          // $("#excelForm").submit(); // Submit the form

          setTimeout(function() {
            // window.location = "/bus_tracking/subadmin/parents";
            window.location = "<?php echo site_url('subadmin/parents');?>";
          }, 2000);
      });
  });


//------------------Import (Choose and select)-------------------
  $( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on import button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
             url:"<?php echo base_url(); ?>subadmin/import_parent",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                
                if(data == 1)
                {
                    toastr.success("<?= $this->lang->line('parent_add_successfully')?>");
                    // window.location = "/bus_tracking/subadmin/bus";
                    window.location = "<?php echo site_url('subadmin/parents');?>";
                }else if(data == 1)
                {
                   toastr.error("<?= $this->lang->line('parent_not_add_successfully')?>");
                }else if(data == 00)
                {
                    toastr.error("<?= $this->lang->line('max_parents')?>");
                    // window.location = "/bus_tracking/subadmin/bus";
                    window.location = "<?php echo site_url('subadmin/parents');?>";
                   
                }
                else
                {
                  
                  $('#duplicateData').modal('show');
                  var obj = JSON.parse(data);
                  console.log(obj);
                  $("#total").val(obj.id);

                  $("#count").text(obj.count);

                  $("#chaperoneName").val(obj.chaperoneName);
                  $("#chaperoneMobile").val(obj.chaperoneNumber);
                  $("#chaperoneNote").val(obj.chaperoneNote);
                  $("#secretCode").val(obj.chaperoneSecret);

                }
                // location.reload();
            }
        })
        e.preventDefault();
    });
 
});

</script>