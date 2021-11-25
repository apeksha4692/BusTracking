 <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);
    ?>
 <div class="col-sm-12 track_status">
             <div class="border pb-3  bg-white">
               <div class="">
               
               
                    <!-- <div class="d-flex w-100">
                        <div class="mt-4 mr-auto">
                            <h5>Notifications (112)</h5>
                         </div>
                        <div class="ml-auto">
                        <a class="btn-outline-warning btn btn-sm waves-effect waves-light" href="">Import <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                        </a>
                        <a class="btn-outline-warning btn btn-sm waves-effect waves-light" href="">Add New <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                        </a>
                        </div>
                         
                    </div> -->

                    

                    <div class="row">
                          <div class="col-sm-8">
                              <div class="d-flex p-3 border-right">
 <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnPdf" onclick="checkpdf()">
   <?php echo $this->lang->line('pdf'); ?>   
  </button> 
<button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()">
    <?php echo $this->lang->line('export'); ?> 
</button> 
<!--  <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()">-->
<!--    Edit    -->
<!--  </button>-->

<!--  <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()">-->
<!--   Export -->
<!--</button> -->
</div>
                            <table class="table border-right border-bottom border-top"  id="example">
                                <thead class="">
                                  <tr>
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
                                    <th scope="col"><?php echo $this->lang->line('trip_start'); ?>
                                        <span>
                                        	<img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                        	<img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('trip_end'); ?>
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
                                    <!--<td>-->
                                    <!--    <?= date("d/m/Y", strtotime($value['trip_date']))?>-->
                                    <!--</td>-->
                                    <td><?=$value['trip_start']?></td>
                                    <td><?=$value['trip_end']?></td>
                                  </tr>
                                  <?php $i++; } }?>
                                  
                                </tbody>
                            </table>
                          </div>
                          <div class="col-sm-4 pl-0">
                       <div class="pt-3 pr-3">
                         <div class="chaperone-add">
                                <?php
                                  if($record_num=='status' ){
                                      $track_status = 'nav-link active';
                                  }else{
                                      $track_status = 'nav-link';
                                  }

                                  if($record_num=='map' ){
                                      $track_map = 'nav-link active';
                                  }else{
                                      $track_map = 'nav-link';
                                  }
                              ?>
                              <div class="filter-menu mb-3">
                                <ul class="nav justify-content-center d-flex">
                                    <!--<li class="nav-item">-->
                                    <!--    <a class="nav-link" href="">Map</a>-->
                                    <!--</li>  -->
                                    <!--<li class="nav-item">-->
                                    <!--    <a class="nav-link active" href="<?php echo site_url('subadmin/track/status');?>">Status</a>-->
                                    <!--</li> -->
                                     <li class="nav-item">
                                        <a class="<?= $track_map;?>" href="<?php echo site_url('subadmin/track/map');?>"><?php echo $this->lang->line('map'); ?></a>
                                    </li>  
                                    <li class="nav-item">
                                        <a class="<?= $track_status?>" href="<?php echo site_url('subadmin/track/status');?>"><?php echo $this->lang->line('status'); ?></a>
                                    </li> 
                                </ul>
                             </div>
                              <div class="row">

                                   <div class="col-sm-12 ">
                                       <!--<div class="form-group">-->
                                       <!--   <div class="row align-items-center">-->
                                       <!--       <label class="col-sm-4"><?php echo $this->lang->line('date'); ?></label>-->
                                       <!--        <div class="col-sm-8">-->
                                      <!--            <?php 
                                    //   <!--               $month = date('m');-->
                                    //   <!--               $day = date('d');-->
                                    //   <!--               $year = date('Y');-->
                                    //   <!--               $today = $year . '-' . $month . '-' . $day;-->
                                    //   <!--           ?>
                                       <!--          <input type="date" id="trip_date" value="<?php echo $today; ?>"  name="trip_date" class="form-control mb-0" onchange="getBus();"/>-->
                                                 <!-- <select class="form-control mb-0">-->
                                                 <!--     <option>12/6/2020</option>-->
                                                 <!--</select>-->
                                       <!--        </div>-->
                                       <!--   </div>  -->
                                       <!--</div>-->
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                              <label class="col-sm-4"><?php echo $this->lang->line('trip_id'); ?></label>
                                               <div class="col-sm-8">
                                                   <select class="form-control mb-0" data-live-search="true" name="client_id" id="trip_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllTrip as $key) { ?>
                                                          <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['trip_id']; ?></option>

                                                       <?php } ?>
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                              <label class="col-sm-4"><?php echo $this->lang->line('find_bus'); ?></label>
                                               <div class="col-sm-8">
                                                  <!-- <select class="form-control mb-0">
                                                      <option>All</option>
                                                      <option>LIVE</option>
                                                      <option>OFF</option>
                                                  </select> -->
                                                  <select class="form-control mb-0" data-live-search="true" name="client_id" id="bus_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllBus as $key) { ?>
                                                          <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['bus_number']; ?></option>

                                                       <?php } ?>
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4"><?php echo $this->lang->line('find_driver'); ?></label>
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
                                                <label class="col-sm-4"><?php echo $this->lang->line('find_chaperon'); ?></label>
                                               <div class="col-sm-8">
                                                 <!--  <select class="form-control mb-0">
                                                      <option>All</option>
                                                      <option>LIVE</option>
                                                      <option>OFF</option>
                                                  </select> -->
                                                  <select class="form-control mb-0" data-live-search="true" name="chaperone_id" id="chaperone_id" onchange="getBus();">
                                                    <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                       <?php foreach ($getAllChaperone as $key) { ?>
                                                          <option data-tokens="<?php echo $key['chaperone_id']; ?>" value="<?php echo $key['chaperone_id']; ?>"><?php echo $key['chaperone_name']; ?></option>

                                                       <?php } ?>
                                                  </select> 
                                               </div>
                                          </div>  
                                       </div>
                                       <!-- <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4">Find By Parent</label>
                                               <div class="col-sm-8">
                                                  <select class="form-control mb-0">
                                                      <option>All</option>
                                                      <option>LIVE</option>
                                                      <option>OFF</option>
                                                  </select>
                                               </div>
                                          </div>  
                                       </div> -->
                                       <div class="form-group">
                                          <div class="row align-items-center">
                                               <label class="col-sm-4"><?php echo $this->lang->line('find_status'); ?></label>
                                               <div class="col-sm-8">
                                                  <select class="form-control mb-0" onchange="getBus();" id="status">
                                                      <option>All</option>
                                                      <option value="1">LIVE</option>
                                                      <option value="2">NO LIVE</option>
                                                  </select>
                                               </div>
                                          </div>  
                                       </div>
                                       
                                   </div> 
                              </div> 


                              <!-- <div class="col-sm-12">
                                  <div class="row flex-row-reverse">
                                       <a class="btn-outline-warning btn btn-sm waves-effect waves-light">Save</a>
                                  </div>  
                              </div>   -->
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
                            <a href="<?= base_url() ?>subadmin/track/status" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
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
    
    $(document).ready(function() {
        $('#example').DataTable( {
        });
    });
    
    //----------------------
function getBus(){
  // alert('hi');
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
               "url"        : '<?php echo site_url("subadmin/TrackController/getStatuUser"); ?>',
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
            window.location = "<?php echo site_url('subadmin/track/status');?>";
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
            window.location = "<?php echo site_url('subadmin/track/status');?>";
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
//----------------------
// function getBus(){
//   // alert('hi');
//   var trip_date = $('#trip_date').val();
//   var bus_id = $('#bus_id').val();
//   var driver_id = $('#driver_id').val();
//   var chaperone_id = $('#chaperone_id').val();
//   var status = $('#status').val();
//   // alert(bus_id);
//   // alert(driver_id);
//   // alert(chaperone_id);
//   // alert(status);
//   var buildSearchData =    
//         {  
//             "trip_date" : trip_date,
//               "bus_id" : bus_id,
//               "driver_id" : driver_id,
//               "status" : status,
//               "chaperone_id" : chaperone_id,
//         };

//         table = $('#example').DataTable({ 
//             "dom"           : 'Bfrtip',
//             "buttons"       : [
//                                 {
//                                     'extend': 'pdfHtml5',
//                                     'orientation': 'landscape',
//                                     'pageSize': 'LEGAL',
//                                     'columns': ':visible',
//                                     'exportOptions': {                    
//                                         'columns':  [0,1,2,3,4,5,6,7,8]                        
//                                     },
                 
//                                 },
//                                 // 'excel',
//                                 {
//                                     'extend': 'excel',
//                                     'orientation': 'landscape',
//                                     'pageSize': 'LEGAL',
//                                     'columns': ':visible',
//                                      'exportOptions': {                    
//                                         'columns': [0,1,2,3,4,5,6,7,8]               
//                                     },
//                                  },
//                                  // 'print',
//                                 {
//                                     'extend': 'print',
//                                     'orientation': 'landscape',
//                                     'pageSize': 'LEGAL',
//                                     'columns': ':visible',
//                                      'exportOptions': {                    
//                                         'columns':[0,1,2,3,4,5,6,7,8]                
//                                     },
//                                  },
//                             ],
//             "ajax"          :  {
//               "url"        : '<?php echo site_url("subadmin/TrackController/getStatuUser"); ?>',
//               "type"       : 'POST',
//               "data"       : buildSearchData
//           },
//             "bDestroy": true 
//         } );
// }
//----------------------

//   $(document).ready(function() {
//         $('#example').DataTable( {
//             dom: 'Bfrtip',
//             buttons: [
//                     {
//                         extend: 'pdfHtml5',
//                         orientation: 'landscape',
//                         pageSize: 'LEGAL',
//                         columns: ':visible',
//                         exportOptions: {                    
//                             columns: [0,1,2,3,4,5,6,7,8]                
//                         },
     
//                     },
//                     {
//                         extend: 'excel',
//                         orientation: 'landscape',
//                         pageSize: 'LEGAL',
//                         columns: ':visible',
//                          exportOptions: {                    
//                             columns: [0,1,2,3,4,5,6,7,8]                
//                         },
//                      },
//                     {
//                         extend: 'print',
//                         orientation: 'landscape',
//                         pageSize: 'LEGAL',
//                         columns: ':visible',
//                          exportOptions: {                    
//                             columns: [0,1,2,3,4,5,6,7,8]                
//                         },
//                      },

//                 ],
//         });
//     });
</script>