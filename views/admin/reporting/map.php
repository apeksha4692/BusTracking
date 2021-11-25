 <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);
    ?>
         

 <div class="col-sm-12">
    <div class="border bg-white">
       <div class="">
        <div class="filter-menu my-3">
            
          <ul class="nav">
              <li class="nav-item">
                <div class="row">
                     <label class="col-sm-2 mb-0 align-items-center d-flex">Client</label>
                     <div class="col-sm-10">
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
                        $reporting_trip = 'nav-link active';
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
                  <!--</li>  -->
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
              

         </ul>
       </div>
       
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
                    <!-- <img width="100%" src="img/map.jpg">  -->
                    <div id="checkmap"> <div id="map" style="width: 100%; height: 500px;"></div></div>
                  </div>
                  <div class="col-sm-4 pl-0">
               <div class="pr-3">
                 <div class="chaperone-add">
                      

                      <div class="row">
                           <div class="col-sm-12 ">
                               <!--<div class="form-group">-->
                               <!--   <div class="row align-items-center">-->
                               <!--        <label class="col-sm-4"><?php echo $this->lang->line('date'); ?></label>-->
                               <!--        <div class="col-sm-8">-->
                                          <!-- <input type="date" id="trip_date"value="<?php echo $today; ?>"  name="trip_date" class="form-control" /> -->
                               <!--           <input type="text" id="trip_date"value="<?php echo date('Y-m-d'); ?>"  name="trip_date" class="form-control mb-0" readonly/>-->
                               <!--        </div>-->
                               <!--   </div>  -->
                               <!--</div>-->
                               
                               <div class="form-group">
                                  <div class="row align-items-center">
                                      <label class="col-sm-4">Find By Trip</label>
                                       <div class="col-sm-8">
                                           <select class="form-control mb-0 checkStaus" data-live-search="true" name="client_id" id="trip_id" onchange="getBus();">
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
                                       <label class="col-sm-4"><?php echo $this->lang->line('find_bus'); ?></label>
                                        <div class="col-sm-8">
                                            <select class="form-control mb-0 checkStaus" data-live-search="true" name="client_id" id="bus_id">
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
                                          <select class="form-control mb-0 checkStaus" data-live-search="true" name="driver_id" id="driver_id">
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
                                          <select class="form-control mb-0 checkStaus" data-live-search="true" name="chaperone_id" id="chaperone_id" >
                                              <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                              <?php foreach ($getAllChaperone as $key) { ?>
                                              <option data-tokens="<?php echo $key['chaperone_id']; ?>" value="<?php echo $key['chaperone_id']; ?>"><?php echo $key['chaperone_name']; ?></option>
                                              <?php } ?>
                                          </select>
                                       </div>
                                  </div>  
                               </div>
                               <div class="form-group">
                                  <div class="row align-items-center">
                                       <label class="col-sm-4"><?php echo $this->lang->line('find_parent'); ?></label>
                                            <div class="col-sm-8">
                                               <select class="form-control mb-0 checkStaus" data-live-search="true" name="parents_id" id="parents_id" >
                                                  <option data-tokens="0" value="0"><?php echo $this->lang->line('all'); ?> </option>
                                                  <?php foreach ($getAllParent as $key) { ?>
                                                  <option data-tokens="<?php echo $key['parents_id']; ?>" value="<?php echo $key['parents_id']; ?>"><?php echo $key['parents_name']; ?></option>
                                                  <?php } ?>
                                               </select>
                                            </div>
                                  </div>  
                               </div>
                               <div class="form-group">
                                  <div class="row align-items-center">
                                       <label class="col-sm-4"><?php echo $this->lang->line('find_status'); ?></label>
                                        <div class="col-sm-8">
                                           <select class="form-control mb-0 checkStaus" id="status">
                                              <option value=""><?php echo $this->lang->line('status'); ?></option>
                                              <option value="1"><?php echo $this->lang->line('live'); ?> </option>
                                              <option value="2">Not Live </option>
                                           </select>
                                        </div>
                                  </div>  
                               </div>
                               
                           </div>
                           <div class="col-sm-12 reporting_map_table">
                               <table class="table table-bordered">
                                     <tr>
                                        <th colspan=""><?php echo $this->lang->line('bus_number'); ?> </th>
                                        <th colspan="2"><p class="mb-0" id="busNumber"><?php echo $this->lang->line('n_a'); ?></p></th>
                                     </tr>
                                     <tr>
                                        <td><?php echo $this->lang->line('driver'); ?></td>
                                        <td><p class="mb-0" id="driverName"><?php echo $this->lang->line('n_a'); ?></p></td>
                                        <td><p class="mb-0" id="driverMob"><?php echo $this->lang->line('n_a'); ?></p></td>
                                     </tr>
                                     <tr>
                                        <td><?php echo $this->lang->line('chaperone'); ?> </td>
                                       <td><p class="mb-0" id="chaperoneName"><?php echo $this->lang->line('n_a'); ?></p></td>
                                        <td><p class="mb-0" id="chaperoneMob"><?php echo $this->lang->line('n_a'); ?></p></td>
                                     </tr>
                                     <tr>
                                        <td>Chaperone App Live</td>
                                        <td colspan="2">Yes</td>
                                     </tr>
                                  </table>
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

<script
  async
  defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&callback=initMap"
></script>
<script type="text/javascript">
   $( document ).ready(function() {
        $('#client_id').select2();
        $('#bus_id').select2();
        $('#chaperone_id').select2();
        $('#driver_id').select2();
        $('#parents_id').select2();
         $('#trip_id').select2();

    });


function initMap() {
    var locations = [
        <?php
           if(!empty($getAllStatus)){
                $sn = 4;
                foreach($getAllStatus as $key => $value)
                {
                    if(!empty($value['pickup_latitude']))
                    { 
                        $img_url = base_url('assest/bus_icon.png');
           
                        echo "['".$value['bus_number']."', ".$value['pickup_latitude'].", ".$value['pickup_longitude'].",'".$img_url."',  ".$sn."],";
                        $sn++;
                    }     
                } 
            }
            else
            {
              echo "[]";
            }   
        ?>
    ];
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: new google.maps.LatLng(22.7533,75.8937),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            content: "1",
            title: locations[i][0],
            icon:locations[i][3]
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    $(".checkStaus").change(function () 
      {

          var bus_id =  document.getElementById("bus_id").value; 
          var parents_id =  document.getElementById("parents_id").value; 
          var driver_id =  document.getElementById("driver_id").value; 
          var chaperone_id =  document.getElementById("chaperone_id").value; 
          var trip_id =  document.getElementById("trip_id").value; 
          //var parents_id =  document.getElementById("parents_id").value; 
      // $('#bus_id').on('change', function() {
        // alert(bus_id);
        // alert(parents_id);
        // alert(driver_id);
        // alert(chaperone_id);
            $.ajax({
               url: '<?php echo site_url("admin/reporting/MapController/getMapReportAjax"); ?>',
              type: "POST",
              data: {
                  "bus_id" : bus_id,
                  "parents_id" : parents_id,
                  "driver_id" : driver_id,
                  "chaperone_id" : chaperone_id,
                  "status" : status,
                  "trip_id" : trip_id,
              },
                success: function (responce) 
                {
                    // console.log(responce);
                     $('#checkmap').html(responce);

                }
          });
      });

    $(".checkStaus").change(function () 
      {
          var bus_id =  document.getElementById("bus_id").value; 
          var parents_id =  document.getElementById("parents_id").value; 
          var driver_id =  document.getElementById("driver_id").value; 
          var chaperone_id =  document.getElementById("chaperone_id").value; 
          var trip_id =  document.getElementById("trip_id").value; 

            $.ajax({
              url: '<?php echo site_url("admin/reporting/MapController/mapReportDetail"); ?>',
              type: "POST",
              data: {
                  "bus_id" : bus_id,
                  "parents_id" : parents_id,
                  "driver_id" : driver_id,
                  "chaperone_id" : chaperone_id,
                  "status" : status,
                  "trip_id" : trip_id,
              },
                success: function (responce) 
                {
                    console.log(responce);
                    // alert('h');
                    var obj = JSON.parse(responce);
                    // $('#GFG_DOWN').text($val); 
                    console.log(obj['track_id']);
                    // positions[0][bus_id]
                    $("#busNumber").text(obj['bus_number']);
                    $("#driverName").text(obj['driver_name']);
                    $("#driverMob").text(obj['drive_mobile_number']);
                    $("#chaperoneName").text(obj['chaperone_name']);
                    $("#chaperoneMob").text(obj['phone_number']);
                }
          });

      });
}

function getClient(client_id)
{
    $.ajax({
       url: '<?php echo site_url("admin/reporting/MapController/getClientMapReportAjax"); ?>',
      type: "POST",
      data: {
          "client_id" : client_id,
      },
        success: function (responce) 
        {
            // console.log(responce);
             $('#checkmap').html(responce);

        }
  });


}
</script>

