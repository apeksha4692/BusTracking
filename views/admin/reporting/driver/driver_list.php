  <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);
    ?>

 <div class="col-sm-12">
    <div class="border p-3 bg-white">
        <div class="">
            <div class="filter-menu mb-3">
                <ul class="nav">
                  <li class="nav-item">
                    <div class="row">
                         <label class="col-sm-5 mb-0 align-items-center d-flex "><?php echo $this->lang->line('client_name'); ?></label>
                         <div class="col-sm-7">
                            <!-- <select class="form-control mb-0">
                                <option>The International School</option>
                                <option>The New School</option>
                            </select> -->
                            <select class="form-control mb-0" data-live-search="true" name="client_id" id="client_id" onchange="getClient(this.value);">
                                <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                                <option data-tokens="0" value="0"><?php echo $this->lang->line('all_client'); ?> </option>
                                 <?php foreach ($getAllClient as $key) { ?>
                                     <option data-tokens="<?php echo $key['client_name']; ?>" value="<?php echo $key['client_name']; ?>" <?php if(!empty($client_id)){echo $client_id == $key['client_name'] ? 'selected' : '';}else{"";}?>><?php echo $key['client_name']; ?></option>

                                 <?php } ?>
                            </select> 
                         </div>
                    </div>
                  </li> 
                  
                   <?php
                    if($record_num=='chaperone_list' || $record_num=='delete_chaperone'){
                        $reporting_chaperone = 'nav-link';
                    }else{
                        $reporting_chaperone = 'nav-link';
                    }

                     if($record_num=='parents_list' ){
                        $reporting_parents = 'nav-link';
                    }else{
                        $reporting_parents = 'nav-link';
                    }

                    if($record_num=='bus_list' || $record_num=='delete_bus'){
                        $reporting_bus = 'nav-link ';
                    }else{
                        $reporting_bus = 'nav-link';
                    }

                    if($record_num=='driver_list' || $record_num=='delete_driver'){
                        $reporting_driver = 'nav-link active';
                    }else{
                        $reporting_driver = 'nav-link';
                    }
                    if($record_num=='status_list' ){
                        $reporting_status = 'nav-link';
                    }else{
                        $reporting_status = 'nav-link';
                    }
                    if($record_num=='trip_list' ){
                        $reporting_trip = 'nav-link ';
                    }else{
                        $reporting_trip = 'nav-link';
                    }
                    if($record_num=='map' ){
                        $reporting_map = 'nav-link active';
                    }else{
                        $reporting_map = 'nav-link';
                    }
                    
                    $checked_arr = explode(",",$getAdminData->role);
                ?>
                <?php if(in_array("16", $checked_arr)) {?>
                   <li class="nav-item">
                      <a class="<?= $reporting_map;?>" href="<?php echo site_url('admin/reporting/map');?>"><?php echo $this->lang->line('map'); ?> </a>
                  </li>   
                  <!--<li class="nav-item">-->
                  <!--    <a class="<?= $reporting_status;?>" href="<?php echo site_url('admin/reporting/status_list');?>"><?php echo $this->lang->line('status'); ?></a>-->
                  <!--</li> -->
                <?php } if(in_array("17", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="<?= $reporting_trip;?>" href="<?php echo site_url('admin/reporting/trip_list');?>"><?php echo $this->lang->line('trip'); ?></a>
                  </li>   
                  <?php } if(in_array("24", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="<?= $reporting_bus;?>" href="<?php echo site_url('admin/reporting/bus_list');?>"><?php echo $this->lang->line('bus'); ?></a>
                  </li>  
                  <?php } if(in_array("18", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="<?= $reporting_driver;?>" href="<?php echo site_url('admin/reporting/driver_list');?>"><?php echo $this->lang->line('driver'); ?></a>
                  </li> 
                  <?php } if(in_array("30", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="<?= $reporting_chaperone;?>" href="<?php echo site_url('admin/reporting/chaperone_list');?>"><?php echo $this->lang->line('chaperone_users'); ?></a>
                  </li>  
                  <?php } if(in_array("36", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="<?= $reporting_parents;?>" href="<?php echo site_url('admin/reporting/parents_list');?>"><?php echo $this->lang->line('parent'); ?></a>
                      
                  </li>
                  <?php } if(in_array("42", $checked_arr)) {?>
                  <li class="nav-item">
                      <a class="nav-link" href="">Analytics</a>
                  </li>  
                  <?php } ?>
                  <!-- <li class="nav-item">
                      <a class="nav-link" href=""></a>
                  </li>  
                  <li class="nav-item">
                      <a class="nav-link" href=""></a>
                  </li>  -->                     

             </ul>
           </div>
               
            <div class="d-flex w-100">
                <div class="mr-auto">
                    <h5><?= $title; ?> (<?= $driver_count->total; ?>)</h5>
                 </div>
                <div class="ml-auto">
                    <?php  if(in_array("22", $checked_arr)) {?>
                    <a class="my-btn mr-3" href="<?php echo site_url('admin/reporting/import_driver_view');?>"> 
                         <?php echo $this->lang->line('import'); ?>
                        <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                      </a>
                     <?php } if(in_array("23", $checked_arr)) {?>

                      <a class="my-btn" href="<?php echo site_url('admin/reporting/driverAdd');?>"> 
                          <?php echo $this->lang->line('add_new'); ?>
                          <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                        </a>
                    <?php } ?>
                </div>
                 
            </div>

            <div class="d-flex mb-3">
                <?php if(in_array("19", $checked_arr)) {?>
                 <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                         <?php echo $this->lang->line('delete'); ?>
                  </button> 
                <?php } if(in_array("20", $checked_arr)) {?>

                  <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                         <?php echo $this->lang->line('edit'); ?>
                  </button>
                <?php } if(in_array("21", $checked_arr)) {?>
                  <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                         <?php echo $this->lang->line('export'); ?>
                  </button> 
                <?php } ?>
            </div>      

            <div class="row">  
              <div class="col-sm-12 p-0">      
                <table class="table table-borderless border-top border-bottom" id="example">
                    <thead>
                        <tr>
                            <th scope="col">
                               <input id="checkbox1" type="checkbox" name="driver[]" class="form-control-custom" onchange="checkAllDirver(this)">
                            </th>
                            <th scope="col"><?php echo $this->lang->line('client_name'); ?>
                                 <span>
                                  <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                  <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                </span>
                            </th>
                            <th scope="col"><?php echo $this->lang->line('driver_name'); ?>
                               <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                            </th>
                            <th scope="col"><?php echo $this->lang->line('driver_number'); ?> 
                             <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                          </th>
                          <!--  <th scope="col"><?php echo $this->lang->line('assigned_bus'); ?> -->
                          <!--   <span>-->
                          <!--                <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >-->
                          <!--                <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >-->
                          <!--              </span>-->
                          <!--</th>-->
                            <th scope="col"><?php echo $this->lang->line('modify'); ?> 
                             <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                          </th>
                            <th scope="col"><?php echo $this->lang->line('note'); ?>
                                 <span>
                                  <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                  <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                </span>
                            </th>
                            <!-- <th scope="col"><?php echo $this->lang->line('status'); ?> </th> -->
                            <!-- <th scope="col"><?php echo $this->lang->line('action'); ?> </th> -->
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
                            <td><?=$value['client_name']?></td>
                            <td><?=$value['driver_name']?></td>
                            <td><?=$value['drive_mobile_number']?></td>
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
                                <!--<?=$value['note']?>-->
                            </td>
                            <!-- <td>
                                <?php if($value['chaperone_status'] == 1) { ?>
                                    <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                <?php } else { ?>
                                   <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                <?php }  ?>
                            </td> -->
                            <!-- <td>
                               <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'admin/reporting/driverEdit/'.$value['driver_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>

                               <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/reporting/DriverController/delete/'.$value['driver_id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>
                            </td> -->
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


<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/reporting/delete_driver');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="driverId" id="txtDelete" >
                <input type="hidden" name="client_id" id="clientId" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('driver'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_delete_selected_driver'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>admin/reporting/DriverController/editDriver" enctype="multipart/form-data" data-parsley-validate>
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
                            <a href="<?= base_url() ?>admin/reporting/driver_list" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
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
                            <a href="<?= base_url() ?>admin/reporting/driver_list" class="my-btn"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>admin/reporting/DriverController/excelDriverList" enctype="multipart/form-data" data-parsley-validate>
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




<script type="text/javascript">
  $( document ).ready(function() {
        $('#client_id').select2();

    });
   function deleteBus(){
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_driver');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function getClient(client_name)
    {
      // alert(client_id);die;

       var buildSearchData =     
        
        {            
              "client_name" : client_name,
        };

        table = $('#example').DataTable({ 
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/reporting/DriverController/getDriverReport"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );

    }

    $(document).ready(function() {
        $('#example').DataTable( {
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
        var client_id =  $('#client_id').val();
        $('#clientId').val(client_id);
        
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
            // window.location = "/bus_tracking/admin/reporting/driver_list";
            window.location = "<?php echo site_url('admin/reporting/driver_list');?>";
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



//------------------Import (Choose and select)-------------------
    $( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
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
                if(data == 11){
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
