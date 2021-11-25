         <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo site_url('subadmin/trip_list');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('subadmin/trip_update');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <div class="row">
                        <input type="hidden" name="tripId" value="<?= $tripDetail->tripId;?>">
                         <div class="col-sm-12 ">
                              <!--<div class="form-group">-->
                              <!--  <div class="row align-items-center">-->
                              <!--       <label class="col-sm-3"><?php echo $this->lang->line('trip_date'); ?></label>-->
                              <!--       <div class="col-sm-9">-->
                                        <?php 
                                            // $month = date('m');
                                            // $day = date('d');
                                            // $year = date('Y');
                                            // $today = $year . '-' . $month . '-' . $day;
                                        ?>
                             <!--           <input type="date" id="txtDate" value="<?php echo $tripDetail->trip_date; ?>" name="trip_date" class="form-control" onchange="getDate(this.value);"/>-->
                             <!--        </div>-->
                             <!--   </div>  -->
                             <!--</div>-->

                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('trip_id'); ?></label>
                                     <div class="col-sm-9">
                                        <input type="text" id="trip_id" name="trip_id" class="form-control" value="<?php echo $tripDetail->trip_id; ?>"  onkeyUp="check_tripId(this.value)"/>
                                        <span id="errmsg_trip_id" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>

                             <div id="dateItem">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('select_bus'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <select class="form-control" data-live-search="true" name="bus_id" id="bus_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_bus'); ?>" >
                                            <option value=""><?php echo $this->lang->line('select_bus'); ?></option>
                                             <?php foreach ($getAllBus as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $tripDetail->bus_id ? 'selected' : '' ?>><?php echo $key['bus_number']; ?></option>
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
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $tripDetail->driver_id ? 'selected' : '' ?>><?php echo $key['driver_name']; ?></option>
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
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $tripDetail->chaperone_id ? 'selected' : '' ?>><?php echo $key['chaperone_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                            
                            
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('trip_start');?></label>
                                    <div class="col-sm-9">
                                       <input id="trip_start" class="timepicker1" type="text" name="trip_start" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_trip_start'); ?>" value="<?php echo $tripDetail->trip_start; ?>" />
                                    </div>
                                </div>  
                                 
                             </div>

                            <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('trip_end'); ?></label>
                                    <div class="col-sm-9">
                                       <input id="" class="timepicker1" type="text" name="trip_end" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_trip_end'); ?>" value="<?php echo $tripDetail->trip_end; ?>"/>
                                    </div>
                                </div>  
                                   
                             </div>

                            <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-sm-9">
                                       <input type="text" name="note" class="form-control" value="<?php echo $tripDetail->note; ?>"/>
                                    </div>
                                </div>  
                             </div>
                         </div>
                    </div> 

                    <div class="col-sm-12">
                        <div class="row flex-row-reverse">
                             <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                              <button class="btn-outline-warning btn btn-sm" type="submit"><?php echo $this->lang->line('save'); ?></button>
                        </div>  
                    </div>  
                </form>    
               </div>
             </div> 
         </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
 <!-- <script src="<?php echo base_url(); ?>assest/timepicki.js"></script> -->

<script src="<?php echo base_url(); ?>assest/timer_picker/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assest/timer_picker/timepicki.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&libraries=places"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#bus_id').select2();
        $('#client_user_id').select2();
        // $('#parents_id').select2();
        $('#driver_id').select2();
        $('#chaperone_id').select2();
        $('#child_id').select2();

    });
   $('.timepicker1').timepicki({increase_direction:'up'});
    function randomPassword(length) 
    {
      // alert(length);
         // chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
         // chars = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" ;
        chars = '@&%ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }

        myform.secret_code.value = pass;
    }

    //check valid number   
    $('.phoneno').each(function(){
        $(this).mask('9999999999');
    });

    // ------check mobile number validation----
    function mustBeValidMobile(el, msgEl) {
        if( el.value === '' || el.value === null || el.value === undefined ) {
            return;
        }

        if((el.value).length < 10) {
            $(`#${msgEl}`).text('<?php echo $this->lang->line("enter_10_number")?>'); 
        } else {
            $(`#${msgEl}`).text(''); 
        }
    }

    function getClientUser(client_id){
        // alert(cat_id);
        $.ajax({
            url: '<?php echo site_url("admin/reporting/ParentsController/getClientUser"); ?>',
            type: "POST",
            data: {
                "client_id" : client_id
            },
            success: function (response) 
            {
                console.log(response);

                if (response == '0') {
                    $('#client_user_id').html('<option value="0">No Client User Found</option>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                    var html = '';
                    // html += '<option value="0">Other</option>'

                    for(var i=0; i<obj.length; i++){
                        // console.log(obj[i]['sub_category_id']);
                        // html += '<option value="'+obj[i]['sub_category_id']+'">'+obj[i]['sub_category_name']+'</option>'
                        html += '<option onchange="getClientUserBus(this.value);" data-tokens="'+obj[i]['id']+'" value="'+obj[i]['id']+'">'+obj[i]['username']+'</option>'
                    }

                    $('#client_user_id').html(html);
                }
            }
        });
    }

     //past date dispaly none
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#txtDate').attr('min', maxDate);
    });
    
    //auto address
    function initialize() 
    {
       console.log(1);
       var input = document.getElementById('pickup_address');
       var autocomplete = new google.maps.places.Autocomplete(input);
       google.maps.event.addListener(autocomplete, 'place_changed', function () {
           var place = autocomplete.getPlace();
           $('input[name="pickup_longitude"]').val(place.geometry.location.lat());
           $('input[name="pickup_latitude"]').val(place.geometry.location.lng());
       });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 


    function initialize_drop() 
    {
       console.log(1);
       var input = document.getElementById('drop_address');
       var autocomplete = new google.maps.places.Autocomplete(input);
       google.maps.event.addListener(autocomplete, 'place_changed', function () {
           var place = autocomplete.getPlace();
           $('input[name="drop_latitude"]').val(place.geometry.location.lat());
           $('input[name="drop_longitude"]').val(place.geometry.location.lng());
       });
    }
    google.maps.event.addDomListener(window, 'load', initialize_drop); 
    
    function getDate(date)
    {
        // alert(date);
            $.ajax({
               // url: '<?php echo site_url("CheckMapController/getbusAjax"); ?>',
               url: '<?php echo site_url("subadmin/TripController/addTripAjax"); ?>',
              type: "POST",
              data: {
                  "date" : date,
              },
                success: function (responce) 
                {
                    // console.log(responce);
                     $('#dateItem').html(responce);

                }
          });
        
    }

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
    
    function check_tripId(trip_id)
    {
      // alert('hi');
        // alert(bus_plate_number);
        if(trip_id != ''){

             $.ajax({
                url: '<?php echo site_url("subadmin/TripController/check_tripId"); ?>',
                type: "POST",
                data: {
                    "trip_id" : trip_id
                },
                success: function (response) 
                {
                    // console.log(response);
                    if (response == '0') {
                        $('#errmsg_trip_id').html('');
                    } else {
                        
                        $('#errmsg_trip_id').html("Trip Id Already Exit");
                        $('#trip_id').val('');
                    }
                }
            });
        }
    }
</script>