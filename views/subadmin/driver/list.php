 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($driver_count->driver_total)){ echo 0; }else{ echo $driver_count->driver_total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                               <a class="my-btn mr-3" href="<?php echo site_url('subadmin/import_driver_view');?>"> 
                                 <?php echo $this->lang->line('import'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                              <a class="my-btn" href="<?php echo site_url('subadmin/driver_add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                         </div> 
                    </div>

                    <div class="d-flex mb-3">
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                               <?php echo $this->lang->line('edit'); ?>
                        </button>
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                               <?php echo $this->lang->line('export'); ?>
                        </button> 
                    </div>      

                    <div class="row">
                      <div class="col-sm-12 px-0"> 
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">
                                      <input id="checkbox1" type="checkbox" name="driver[]" class="form-control-custom" onchange="checkAllDirver(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('driver_name'); ?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('driver_phone_number'); ?> 
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('assigned_bus'); ?> </th>-->
                                    
                                    <th scope="col">
                                        <?php echo $this->lang->line('modify'); ?> 
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('note'); ?></th>
                                    <!--<th scope="col"><?php echo $this->lang->line('status'); ?> </th>-->
                                    <!--<th scope="col"><?php echo $this->lang->line('action'); ?> </th>-->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;

                                    if(!empty($getAllDriver)){
                                        foreach ($getAllDriver as $key => $value) { 
                                ?>
                                  <tr>
                                    <th scope="row">
                                      <!-- <input type="checkbox" name=""> -->
                                      <input id="<?=$value['driver_id']?>" type="checkbox" value="<?=$value['driver_id']?>" name="driver_id[]" class="form-control-custom"  data-id ="<?=$value['driver_id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                      <label for="<?=$value['driver_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </th>
                                     <td><?=$value['driver_name']?></td>
                                     <!--<td><?=$value['driver_unique_id']?></td>-->
                                     <td><?=$value['drive_mobile_number']?></td>
                                     <!-- <td><?=$value['bus_unique_id']?></td> -->
                                     <!--<td><?=$value['bus_number']?></td>-->
                                    
                                     <td>
                                        <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                                     </td>
                                     <td>
                                         <style>
                                            .show-read-more .more-text{
                                                display: none;
                                            }
                                        </style>
                                        <p class="show-read-more mb-0"><?=$value['note']?></p>
                                     </td>
                                    <!--<td>-->
                                    <!--    <?php if($value['driver_status'] == 1) { ?>-->
                                    <!--        <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['driver_id']?>')" onclick="change_status('<?=$value['driver_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>-->
                                    <!--    <?php } else { ?>-->
                                    <!--       <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['driver_id']?>')" onclick="change_status('<?=$value['driver_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>-->
                                    <!--    <?php }  ?>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                    <!--   <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/driver_edit/'.$value['driver_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>-->

                                    <!--   <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'subadmin/DriverController/delete/'.$value['driver_id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>-->
                                    <!--</td>-->
                                  </tr>
                                 <?php $i++; } }?>
                                 <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                </tbody>
                            </table>
                      </div>  
                    </div> 
               </div>
             </div> 
         </div>

  <!--<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
  <!--      <div class="modal-dialog">-->
  <!--          <form method="post" action="<?php echo site_url('subadmin/delete_driver');?>" enctype="multipart/form-data" data-parsley-validate>-->
  <!--              <input type="hidden" name="driverId" id="txtDelete" >-->
  <!--              <div class="modal-dialog" role="document">-->
  <!--                  <div class="modal-content">-->
                        
  <!--                      <div class="modal-header">-->
  <!--                          <h5 class="modal-title"> -->
  <!--                              <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('driver'); ?> </h5>-->
  <!--                          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>-->
  <!--                      </div>-->
  <!--                      <div class="modal-body" style="text-align: center;">-->
                         <!-- <div class="form-group"> -->
  <!--                          <p><?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_driver');?> </p>-->
                        <!-- </div> -->
  <!--                      </div>-->
  <!--                      <div class="modal-footer">-->
  <!--                          <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('yes'); ?> </button>-->
  <!--                          <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>-->
  <!--                      </div>-->
  <!--                  </div>-->
  <!--              </div>-->
  <!--          </form>-->
  <!--      </div>-->
  <!--  </div>-->

 <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/delete_driver');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="driverId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                             <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('driver'); ?> 
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                         
                            <p><?= $this->lang->line('are_sure_delete_selected_driver');?>  </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/driverController/editDriver" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_edit_selected_driver'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" ><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="selectAtleastOneDriverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_driver'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>subadmin/driver" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


 <div class="modal fade" id="selectOnlyOneDriverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('sorry_slect_only_one_Driver'); ?> </p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>subadmin/driver" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/driverController/exportDriverCSV" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="driverId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_driver'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" id="submitExcel"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="importDriver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('import'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><label><?php echo $this->lang->line('select_excel_file'); ?> </label>
                                <div id="file-wrap">
                                <p><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>

                        </div>
                        <div class="modal-footer">
                            <button class="my-btn" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="my-btn" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">

  function deleteBus(){
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_driver');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var driver_id = id;
            // alert(user_id);
        if(confirm("<?= $this->lang->line('are_you_sure_want');?> "+value+" <?= $this->lang->line('this_driver');?>")){
            $.ajax({
                url: '<?php echo site_url("subadmin/driver/changeStatus"); ?>',
                type: "POST",
                data: {
                    "driver_id" : driver_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.driver_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {

                        $('#change_status_'+data.driver_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }

    $(document).ready(function() {
        $('#example').DataTable( {
        });
    });


   
//------------Export Pdf and Excel----------------------------
  function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="driver_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });

        // alert(selected_id);
        $('.textIddss').val(selected_id);
       
    }
//------------------Import (Choose and select)-------------------
$( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
            url:"<?php echo base_url(); ?>subadmin/import_driver",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('driver_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('driver_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
        e.preventDefault();
    });
});
//Delete Button Function
  function checkAllDirver(ele) {
    $('input[name ="driver_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="driver_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });

     function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='driver_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');
            $('#selectAtleastOneDriverModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }
//Edit Button Funtion
     function checkEdit()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='driver_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
          // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#editModal').modal('hide');
            $('#selectAtleastOneDriverModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneDriverModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }
  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="driver_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });
//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='driver_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
           // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#exportModal').modal('hide');
             $('#selectAtleastOneDriverModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#exportModal').modal('show');
        }
    }
    
  $(document).ready(function(){
      $("#submitExcel").click(function(){        
          // $("#excelForm").submit(); // Submit the form
          setTimeout(function() {
            // window.location = "/bus_tracking/subadmin/driver";
            window.location = "<?php echo site_url('subadmin/driver');?>";
          }, 2000);
          
     });
  });

  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="driver_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });

$(document).ready(function(){
  var maxLength = 5;
//   alert(maxLength);
  $(".show-read-more").each(function()
  {
        var myStr = $(this).text();
        // alert(myStr);
        if($.trim(myStr).length > maxLength)
        {
        //   alert('hi');
          var newStr = myStr.substring(0, maxLength);
          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
          $(this).empty().html(newStr);
          $(this).append('<br> <a href="javascript:void(0);" class="read-more" style="color:blue;">read more...</a>');
          $(this).append('<span class="more-text">' + removedStr + '</span>');
          // alert(removedStr);
        }
        // else{
        //   alert('no');
        // }
  });
  $(".read-more").click(function()
  {
    $(this).siblings(".more-text").contents().unwrap();
    $(this).remove();
  });
});
</script>