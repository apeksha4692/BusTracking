 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                <div class="row">
                    <!-- <h4><?= $title?> (<? if(empty($parents_count->parents_total)){ echo 0; }else{ echo $parents_count->parents_total;}?>)</h4> -->
                     <div class="col-sm-12"> <h4 class="mb-3"> <?php echo $this->lang->line('trip_id'); ?> : <?= $tripDetail->trip_id; ?></h4></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('bus_number'); ?></p> <p class="mb-1"> <?= $tripDetail->bus_number; ?></p></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('driver_name'); ?></p> <p class="mb-1"> <?= $tripDetail->driver_name; ?></p></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('chaperone'); ?></p> <p class="mb-1"> <?= $tripDetail->chaperone_name; ?></p></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('estimated_start_time'); ?></p> <p class="mb-1"> <?= $tripDetail->trip_start; ?></p></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('estimated_end_time'); ?></p> <p class="mb-1"> <?= $tripDetail->trip_end; ?></p></div>
                     <div class="col"> <p class="mb-1"> <?php echo $this->lang->line('note'); ?></p> <p class="mb-1"> <?= $tripDetail->note; ?></p></div>
                 </div>
                    <div class="d-flex mt-3">
                        
                         <div class="ml-auto">
                              <!--<a class="my-btn mr-3" href="<?php echo base_url().'subadmin/import_parents_trip_view/'.$tripDetail->tripId;?>"> -->
                              <!--  <?php echo $this->lang->line('import'); ?>-->
                              <!--  <i class="fa fa-plus ml-1" aria-hidden="true"></i>-->
                              <!--</a>-->
                              <!--<a class="my-btn" href="-->
                              <!--  <?php echo base_url().'subadmin/trip/add_parents/'.$tripDetail->tripId;?>"> -->
                              <!--  Add New Parents-->
                                <!--<?php echo $this->lang->line('add_new'); ?>-->
                              <!--  <i class="fa fa-plus ml-1" aria-hidden="true"></i>-->
                              <!--</a>-->
                              
                              <a class="my-btn" href="
                                <?php echo base_url().'subadmin/trip/trip_add_parents_child/'.$tripDetail->tripId;?>"> 
                                Add New Parents
                                <!--<?php echo $this->lang->line('add_new'); ?>-->
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
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
                                       <input id="checkbox1" type="checkbox" name="trip_add_parents[]" class="form-control-custom" onchange="checkAllTripParents(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('child_name'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('child_image'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('parents_name'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('parent_number'); ?> 
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('note'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('modify'); ?> </th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                    $i = 1;

                                    if(!empty($getAllParent)){
                                        foreach ($getAllParent as $key => $value) { 
                                ?>
                                  <tr>
                                    <th scope="row">
                                      <!-- <input type="checkbox" name=""> -->
                                      <input id="<?=$value['trip_add_parents_id']?>" type="checkbox" value="<?=$value['trip_add_parents_id']?>" name="trip_add_parents_id[]" class="form-control-custom"  data-id ="<?=$value['trip_add_parents_id']?>" data-parsley-required="true" data-parsley-trigger="click"  onclick="checkBox();">
                                      <label for="<?=$value['parents_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </th>
                                     <td><?=$value['child_name']?></td>
                                     <td>
                                         <img src="<?php echo base_url().'uploads/child_image/'.$value['child_image']; ?>" width="50px" height="50px">
                                    </td>
                                     <td><?=$value['parents_name']?></td>
                                     <td><?=$value['phone_number']?></td>
                                     <td><?=$value['note']?></td>
                                     <td>
                                        <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                                     </td>
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
         </div>

         <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/trip/delete_trip_parents');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="trip_add_parents_id" id="txtTripParent" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete_trip'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?= $this->lang->line('are_you_sure_want_delete_trip');?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!--<form method="post" action="<?= base_url() ?>subadmin/TripController/editTripParents" enctype="multipart/form-data" data-parsley-validate>-->
            <form method="post" action="<?= base_url() ?>subadmin/trip/editChildParents" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="trip_add_parents_id" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_edit_selected_trip_parent'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn" type="submit" ><?php echo $this->lang->line('yes'); ?> </button>
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
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_trip_parents'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?php echo base_url().'subadmin/trip_view/'.$tripDetail->tripId;?>" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
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
                            <p><?php echo $this->lang->line('sorry_slect_only_one_trip_parents'); ?> </p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?php echo base_url().'subadmin/trip_view/'.$tripDetail->tripId;?>" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/TripController/exportTripParentsCSV" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="trip_add_parents_id" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_parents'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn" type="submit" id="submitExcel"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="importTripParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">

  function deleteBus(){
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_parents');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var parents_id = id;
            // alert(user_id);
        if(confirm("<?= $this->lang->line('are_you_sure_want');?> "+value+" <?= $this->lang->line('this_parents');?>")){
            $.ajax({
                url: '<?php echo site_url("subadmin/parents/changeStatus"); ?>',
                type: "POST",
                data: {
                    "parents_id" : parents_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.parents_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                      $('#change_status_'+data.parents_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }

    // $("#btnDelete").click(function(){
    //   var selected_id = new Array();
    //   $('input[name="parents_id[]"]:checked').each(function() {

    //      selected_id.push(this.value);

    //   });
    //   // alert(selected_id);

    //   $('#txtDelete').val(selected_id);
    // });

    $(document).ready(function() {
        $('#example').DataTable({
        });
    });

    //  function checkValue()
    // {
    //     // alert('h');
    //     var selected_id = new Array();
    //     var counting = $('#counting').val();
    //     // for(var i=0 ; i<counting)
    //     $.each($("input[name='parents_id[]']:checked"), function(){            
    //         selected_id.push($(this).val());
    //     });
    //     if(selected_id.length == 0)
    //     {
    //       $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
    //         // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
    //         $('#deleteAllModal').modal('hide');

    //     }else
    //     {
    //       $('#errmsg').html('');
    //         $('#deleteAllModal').modal('show');
    //     }
    // }

//------------Export Pdf and Excel----------------------------
  function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="parents_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });

            $('.textIddss').val(selected_id);
       
    }

    $('form').submit(function () {
        var name = $('.textIddss').val();
        if (name === '') {
            $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            return false;
        }else{
           $('#errmsg').html('');
        }
    });

//------------------Import (Choose and select)-------------------
  $( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
             url:"<?php echo base_url(); ?>subadmin/import_trip_parents",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('trip_parents_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('trip_parents_not_add_successfully')?>");
                }
                // 
                // location.reload();
            }
        })
        e.preventDefault();
    });
 
});


//Delete Button Function
  function checkAllTripParents(ele) {
    $('input[name ="trip_add_parents_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="trip_add_parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtTripParent').val(selected_id);
    });

     function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='trip_add_parents_id[]']:checked"), function(){            
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
        $.each($("input[name='trip_add_parents_id[]']:checked"), function(){            
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
      $('input[name="trip_add_parents_id[]"]:checked').each(function() {

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
        $.each($("input[name='trip_add_parents_id[]']:checked"), function(){            
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
            window.location = "<?php echo base_url(); ?>/subadmin/trip_view/<?= $tripDetail->tripId; ?>";
          }, 2000);
      });

  });

  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="trip_add_parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });
</script>