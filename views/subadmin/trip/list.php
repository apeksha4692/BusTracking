<div class="col-sm-12 trip-list">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($trip_count->total)){ echo 0; }else{echo $trip_count->total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                              <!-- <a class="my-btn" href=""  data-toggle="modal" data-target="#importBus">
                                <?php echo $this->lang->line('import'); ?> 
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a> -->
                               <a class="my-btn mr-3" href="<?php echo site_url('subadmin/import_trip_view');?>"> 
                                 <?php echo $this->lang->line('import'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                              <a class="my-btn" href="<?php echo site_url('subadmin/trip_add');?>"> 
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
                                       <input id="checkbox1" type="checkbox" name="tripId[]" class="form-control-custom" onchange="checkAllTrip(this)">
                                    </th>
                                   <th style="width:59px" scope="col"> <?php echo $this->lang->line('trip_id'); ?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                   </th>
                                   <th scope="col" style="width: 61px">
                                        <?php echo $this->lang->line('bus_id'); ?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                   </th>
                                    <th style="width: 97px" scope="col"><?php echo $this->lang->line('driver_name'); ?> 
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th style="width: 88px" scope="col"><?php echo $this->lang->line('chaperone'); ?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('status'); ?> </th>-->
                                    <!--<th scope="col"><?php echo $this->lang->line('trip_date'); ?></th>-->
                                    <th scope="col"><?= $this->lang->line('estimated_start_time');?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('estimated_end_time'); ?>
                                         <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <?php echo $this->lang->line('modify'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col" style="width: 170px !important"><?php echo $this->lang->line('note'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('parent'); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
                                        $i = 1;
                                        if(!empty($getAllStatus)){
                                          foreach ($getAllStatus as $key => $value) { 
                                    ?>

                                  <tr>
                                    <td>
                                      <input id="<?=$value['trip_id']?>" type="checkbox" value="<?=$value['trip_id']?>" name="trip_id[]" class="form-control-custom"  data-id ="<?=$value['trip_id']?>" data-parsley-required="true" data-parsley-trigger="click"  onclick="checkBox();">
                                      <label for="<?=$value['trip_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </td>
                                    <td><?=$value['tridID']?></td>
                                    <td><?=$value['bus_number']?></td>
                                    <td><?=$value['driver_name']?></td>
                                    <td><?=$value['chaperone_name']?></td>
                                    
                                    <!--<td>-->
                                    <!--    <button class="btn btn-sm btn-warning">-->
                                        <?php 
                                        // if($value['status'] == 1){
                                        //   echo "LIVE";
                                        // }else{
                                        //   echo "No Live";
                                        // }
                                        
                                         ?>
                                    <!--    </button> -->
                                    <!--</td>-->
                                     <!--<td><?=  date("d/m/Y", strtotime($value['trip_date']));?></td>-->
                                    <td><?=$value['trip_start']?></td>
                                    <td><?=$value['trip_end']?></td>
                                    <td><?=  date("d/m/Y", strtotime($value['updated_at']));?></td>
                                    <td>
                                          <style>
    .show-read-more .more-text{
        display: none;
    }
</style>
                                        <!--<?=$value['note']?>-->
                                        <p class="show-read-more mb-0"><?=$value['note']?></p>

                                    </td>
                                    
                                    <td>
                                      <span class="mr-2">
                                        <?php
                                          $parent_count = $this->CommonModel->select_single_row("Select count(*) as total from trip_add_parents where trip_id =".$value['trip_id']."");

                                          if(empty($parent_count->total)){
                                            echo "0";
                                          }else{
                                            echo $parent_count->total;
                                          } 
                                        ?>
                                        </span>
                                        <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/trip_view/'.$value['trip_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('view')?></a>
                                         <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/edit_trip/'.$value['trip_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a> 
                                    </td>
                                  </tr>
                                  <?php $i++; } }?>
                                </tbody>
                            </table>
                          </div>
                    </div> 
               </div>
             </div> 
         </div>

         <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/delete_trip');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="tripId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('bus'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_delete_selected_trip'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>subadmin/TripController/editTrip" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="tripId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_edit_selected_trip'); ?> </p>
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

    <div class="modal fade" id="selectAtleastOneTripModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_trip'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>subadmin/trip_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

<div class="modal fade" id="selectOnlyOneTripModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><?php echo $this->lang->line('sorry_slect_only_one_trip'); ?> </p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>subadmin/trip_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/TripController/exportTripCSV" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="tripId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_trip'); ?> </p>
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
<script type="text/javascript">



     $(document).ready(function() {
        $('#example').DataTable( {
      });
    });


//Delete Button Function
  function checkAllTrip(ele) {
    $('input[name ="trip_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="trip_id[]"]:checked').each(function() {

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
        $.each($("input[name='trip_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');
            $('#selectAtleastOneTripModal').modal('show');

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
        $.each($("input[name='trip_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
          // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#editModal').modal('hide');
            $('#selectAtleastOneTripModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneTripModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }
  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="trip_id[]"]:checked').each(function() {

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
        $.each($("input[name='trip_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
           // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#exportModal').modal('hide');
             $('#selectAtleastOneTripModal').modal('show');

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
            window.location = "<?php echo site_url('subadmin/trip_list');?>";
          }, 2000);
      });

  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="trip_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });
    
    
$(document).ready(function(){
  var maxLength = 20;
  $(".show-read-more").each(function()
  {
        var myStr = $(this).text();
        // alert(myStr);
        if($.trim(myStr).length > maxLength)
        {
          // alert('hi');
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