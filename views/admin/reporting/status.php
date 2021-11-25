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
                             <label class="col-sm-2 mb-0 align-items-center d-flex">Client</label>
                             <div class="col-sm-10">
                                <!-- <select class="form-control mb-0">
                                    <option>The International School</option>
                                    <option>The New School</option>
                                </select> -->
                                <select class="form-control mb-0" data-live-search="true" name="client_id" id="client_id" onchange="getClient(this.value);">
                                <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                                <option data-tokens="0" value="0"><?php echo $this->lang->line('all_client'); ?> </option>
                                 <?php foreach ($getAllClient as $key) { ?>
                                    <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['client_name']; ?></option>

                                 <?php } ?>
                            </select> 
                             </div>
                        </div>
                      </li>  
                      
                   <?php
                    if($record_num=='chaperone_list' ){
                        $reporting_chaperone = 'nav-link';
                    }else{
                        $reporting_chaperone = 'nav-link';
                    }

                     if($record_num=='parents_list' ){
                        $reporting_parents = 'nav-link';
                    }else{
                        $reporting_parents = 'nav-link';
                    }

                    if($record_num=='bus_list' ){
                        $reporting_bus = 'nav-link ';
                    }else{
                        $reporting_bus = 'nav-link';
                    }

                    if($record_num=='driver_list' ){
                        $reporting_driver = 'nav-link';
                    }else{
                        $reporting_driver = 'nav-link';
                    }

                    if($record_num=='status_list' ){
                        $reporting_status = 'nav-link active';
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
                ?>

                  <li class="nav-item">
                      <a class="<?= $reporting_map;?>" href="<?php echo site_url('admin/reporting/map');?>"><?php echo $this->lang->line('map'); ?> </a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_status;?>" href="<?php echo site_url('admin/reporting/status_list');?>"><?php echo $this->lang->line('status'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_trip;?>" href="<?php echo site_url('admin/reporting/trip_list');?>"><?php echo $this->lang->line('trip'); ?></a>
                  </li>   
                  <li class="nav-item">
                      <a class="<?= $reporting_bus;?>" href="<?php echo site_url('admin/reporting/bus_list');?>"><?php echo $this->lang->line('bus'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_driver;?>" href="<?php echo site_url('admin/reporting/driver_list');?>"><?php echo $this->lang->line('driver'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_chaperone;?>" href="<?php echo site_url('admin/reporting/chaperone_list');?>"><?php echo $this->lang->line('chaperone_users'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_parents;?>" href="<?php echo site_url('admin/reporting/parents_list');?>"><?php echo $this->lang->line('parent'); ?></a>
                      
                  </li>  
                  <li class="nav-item">
                      <a class="nav-link" href="">Analytics</a>
                  </li>  
                      

                 </ul>
               </div>
               
                    <div class="d-flex w-100">
                       <!--  <div class="mt-4 mr-auto">
                            <h5>Notifications (112)</h5>
                         </div> -->
                        <!-- <div class="ml-auto">
                        <a class="btn-outline-warning btn btn-sm waves-effect waves-light" href="">Import <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                        </a>
                        <a class="btn-outline-warning btn btn-sm waves-effect waves-light" href="">Add New <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                        </a>
                        </div> -->
                         
                    </div>

                    <div class="d-flex mb-3">
                        <!--<a class="text-warning mr-3" href="">Delete</a>-->
                        <!--<a class="text-warning mr-3" href="">Export</a>-->
                         <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnPdf" onclick="checkpdf()">
   <?php echo $this->lang->line('pdf'); ?>   
  </button> 
<button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()">
    <?php echo $this->lang->line('export'); ?> 
</button> 
                    </div>       

                    <div class="row">
                          <div class="col-sm-8 table-responsive">
                            <table class="table border-right border-bottom border-top"  id="example">
                                <thead class="">
                                  <tr>
                                    <!--<th scope="col">Bus Number</th>-->
                                    <!--<th scope="col">Driver</th>-->
                                    <!--<th scope="col">Chaperone</th>-->
                                    <!--<th scope="col">Status</th>-->
                                    <!--<th scope="col">Tripe start Time</th>-->
                                    <!--<th scope="col">Tripe End Time</th>-->
                                     <th scope="col">
                                      <!--<input id="" type="checkbox" name="" class="form-control-custom" onchange="">-->
                                       <input id="checkbox1" type="checkbox" name="tripId[]" class="form-control-custom" onchange="checkAllTrip(this)">
                                    </th>
                                     <th scope="col"><?php echo $this->lang->line('trip_id'); ?>
                                     <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                     </th>
                                     <th scope="col"><?php echo $this->lang->line('bus_number'); ?> 
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                     </th>
                                    <th scope="col"><?php echo $this->lang->line('driver'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('chaperone'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('status'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('date'); ?></th>-->
                                    <th scope="col"><?php echo $this->lang->line('estimated_start_time'); ?>
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
                                        <!--<input id="" type="checkbox" name="" class="form-control-custom" onchange="">-->
                                        <input id="<?=$value['trip_id']?>" type="checkbox" value="<?=$value['trip_id']?>" name="trip_id[]" class="form-control-custom"  data-id ="<?=$value['trip_id']?>" data-parsley-required="true" data-parsley-trigger="click"  onclick="checkBox();">
                                      <label for="<?=$value['trip_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </td>
                                    <td><?=$value['tridID']?></td>
                                    <td><?=$value['bus_number']?></td>
                                    <td><?=$value['driver_name']?></td>
                                    <td><?=$value['chaperone_name']?></td>
                                    
                                    <td><button class="my-btn bg-transparent btn-sm">
                                        <?php 
                                        if($value['status'] == 1){
                                          echo "LIVE";
                                        }else{
                                          echo "No Live";
                                        }
                                        
                                        ?>
                                        
                                        </button> 
                                    </td>
                                    <td><?=$value['trip_start']?></td>
                                    <td><?=$value['trip_end']?></td>
                                  </tr>
                                  <?php $i++; } }?>
                                </tbody>
                            </table>
                          </div>
                          <div class="col-sm-4">
                       <div class="py-3">
                         <div class="chaperone-add">
                              

                              <div class="row">
                                   <div class="col-sm-12 ">
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                              <label class="col-sm-4"><?php echo $this->lang->line('trip_id'); ?></label>
                                               <div class="col-sm-8">
                                                   <select class="form-control mb-0" data-live-search="true" name="client_id" id="trip_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllStatus as $key) { ?>
                                                          <option data-tokens="<?php echo $key['trip_id']; ?>" value="<?php echo $key['trip_id']; ?>"><?php echo $key['tridID']; ?></option>

                                                       <?php } ?>
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4">Find By Bus</label>
                                               <div class="col-sm-8">
                                                  <!-- <select class="form-control mb-0">
                                                      <option>All</option>
                                                      <option>LIVE</option>
                                                      <option>OFF</option>
                                                  </select> -->
                                                  <select class="form-control mb-0" data-live-search="true" name="client_id" id="bus_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllBus as $key) { ?>
                                                          <option data-tokens="<?php echo $key['bus_id']; ?>" value="<?php echo $key['bus_id']; ?>"><?php echo $key['bus_number']; ?></option>
                                                       <?php } ?>
                                                       
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4">Find By  Driver</label>
                                               <div class="col-sm-8">
                                                  <!-- <select class="form-control mb-0">
                                                      <option>All</option>
                                                      <option>LIVE</option>
                                                      <option>OFF</option>
                                                  </select> -->
                                                  <select class="form-control mb-0" data-live-search="true" name="driver_id" id="driver_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllDriver as $key) { ?>
                                                          <option data-tokens="<?php echo $key['driver_id']; ?>" value="<?php echo $key['driver_id']; ?>"><?php echo $key['driver_name']; ?></option>

                                                       <?php } ?>
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4">Find By Chaperon</label>
                                               <div class="col-sm-8">
                                                  <select class="form-control mb-0" data-live-search="true" name="chaperone_id" id="chaperone_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllChaperone as $key) { ?>
                                                          <option data-tokens="<?php echo $key['chaperone_id']; ?>" value="<?php echo $key['chaperone_id']; ?>"><?php echo $key['chaperone_name']; ?></option> <?php } ?>
                                                       
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4">Find By Status</label>
                                               <div class="col-sm-8">
                                                  <select class="form-control mb-0" onchange="getBus();" id="status">
                                                      <option>All</option>
                                                      <option value="1">LIVE</option>
                                                      <option value="2">OFF</option>
                                                  </select>
                                               </div>
                                          </div>  
                                       </div>
                                       
                                   </div>
                              </div> 
                         </div>
                       </div> 
                   </div>  
                        
                    </div>
               </div>
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
                            <a href="<?= base_url() ?>admin/reporting/status_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div> 
         
      <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/TrackController/exportTrack" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="tripId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_track'); ?> </p>
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

    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/TrackController/pdfTrack" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="tripId" id="txtPdf" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('pdf'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_pdf_selected_track'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" id="submitPdf"><?php echo $this->lang->line('yes'); ?> </button>
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
        $('#bus_id').select2();
        $('#chaperone_id').select2();
        $('#driver_id').select2();
         $('#trip_id').select2();

    });
//----------------------
function getBus(){
    var trip_date = $('#trip_date').val();
       var trip_id = $('#trip_id').val();

  var bus_id = $('#bus_id').val();
  var driver_id = $('#driver_id').val();
  var chaperone_id = $('#chaperone_id').val();
  var status = $('#status').val();
  // alert(bus_id);
  // alert(driver_id);
  // alert(chaperone_id);
  // alert(status);
  var buildSearchData =     
        
        {    
             "trip_date" : trip_date,
              "trip_id" : trip_id,
              "bus_id" : bus_id,
              "driver_id" : driver_id,
              "status" : status,
              "chaperone_id" : chaperone_id,
        };

        table = $('#example').DataTable({ 
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/reporting/StatusController/getStatusReport"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );
}
//----------------------
    $(document).ready(function() {
        $('#example').DataTable( {
        });
    });
    
    function getClient(client_id)
    {
      // alert(client_id);die;

       var buildSearchData =     
        
        {            
              "client_id" : client_id,
        };

        table = $('#example').DataTable({ 
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/reporting/StatusController/getStatusReportByClient"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );
    }
//-------------CHecked all trip---------
  function checkAllTrip(ele) {
    $('input[name ="trip_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }
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
          setTimeout(function() {
            window.location = "<?php echo site_url('admin/reporting/status_list');?>";
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

//PDF Button Funtion
     function checkpdf()
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
            $('#pdfModal').modal('show');
        }
    }
  $(document).ready(function(){
      $("#submitPdf").click(function(){        
          setTimeout(function() {
            window.location = "<?php echo site_url('admin/reporting/status_list');?>";
          }, 2000);
      });

  });


  $("#btnPdf").click(function(){
      var selected_id = new Array();
      $('input[name="trip_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtPdf').val(selected_id);
    });
</script>