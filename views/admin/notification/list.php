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
                  <ul class="nav row">
                    <?php
                    if($record_num=='notification' ){
                        $notification = 'nav-link active';
                    }else{
                        $notification = 'nav-link ';
                    }

                    if($record_num=='notification_new' ){
                        $notification_new = 'nav-link';
                    }else{
                        $notification_new = 'nav-link';
                    }
                    
                    $checked_arr = explode(",",$getAdminData->role);
                ?>
                
                  <li class="nav-item">
                      <a class="<?= $notification_new; ?> " href="<?php echo site_url('admin/notification_new');?>"><?php echo $this->lang->line('new_notification'); ?></a>
                  </li>
                  <li class="nav-item">
                      <a class="<?= $notification; ?>" href="<?php echo site_url('admin/notification');?>"><?php echo $this->lang->line('notification_log'); ?></a>
                  </li>
                 
                      

                 </ul>
               </div>
               
                    <div class="d-flex w-100">
                        <div class="mt-4 mb-3">
                            <h5><?=$title; ?> (<?= $notification_count->total;?>)</h5>
                         </div>
                         
                    </div>

                    <div class="d-flex mb-3">
                       
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()" >
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 
                        
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                               <?php echo $this->lang->line('export'); ?>
                        </button>
                        
                    </div>      

                    <div class="">
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">
                                       <input id="checkbox1" type="checkbox" name="notification[]" class="form-control-custom" onchange="checkAllNotification(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('date_time'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('clients'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('user'); ?>
                                         <span>
                                              <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                              <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                            </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('based_on_app_version'); ?>
                                         <span>
                                              <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                              <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                            </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('all_app_version'); ?>
                                         <span>
                                              <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                              <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('platform'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('msg'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;
                                    if(!empty($getAllNotification)){
                                        foreach ($getAllNotification as $key => $value) { 
                                  ?>
                                  <tr>
                                    <th scope="row">
                                         <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="notification_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                          <label for="<?=$value['id']?>"></label><br>
                                          <span id="errmsg" style="color: red;"></span>
                                    </th>
                                    
                                     <td><?=  date("d/m/Y h:s A", strtotime($value['updated_at']));?></td>
                                     <td><?=$value['client']?></td>
                                     <td><?=$value['app_user']?></td>
                                     <td><?=$value['based_app']?></td>
                                     <td><?=$value['version']?></td>
                                     <td><?=$value['platform']?></td>
                                     <td><?=$value['msg']?></td>
                                  </tr>
                                  <?php $i++; } }?>                          
                                  <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                  
                                </tbody>
                            </table>
                        
                    </div> 
  
               </div>
             </div> 
         </div>

 <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/notification/delete');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="notificationId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('notification'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_you_sure_want_delete_notification'); ?> </p>
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


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>admin/NotificationController/excelNotificaitonList" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="notificationId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p>
                              <!-- <?php echo $this->lang->line('are_sure_export_selected_client'); ?>  -->
                              Are You Sure want to Export Selected Notification
                          </p>
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


 <div class="modal fade" id="selectAtleastOneNotificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="cliendId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>
                            Sorry, you need select at least one notification
                          </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/notification" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


<script type="text/javascript">
  $(document).ready(function() {
        $('#example').DataTable( {
        });
    });

//select all checkbox
       function checkAllNotification(ele) {
          $('input[name ="notification_id[]"]').each( function() {
              if (ele.checked) {
                  $(this).prop('checked',true);
              } else {
                  $(this).prop('checked',false);
              } 
          });
       }
//Delete Button Funtion
    function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='notification_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $('#deleteAllModal').modal('hide');
             $('#selectAtleastOneNotificationModal').modal('show');
        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }
    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="notification_id[]"]:checked').each(function() {
         selected_id.push(this.value);
      });
      $('#txtDelete').val(selected_id);
    });

//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='notification_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
         
            $('#exportModal').modal('hide');
             $('#selectAtleastOneNotificationModal').modal('show');

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
            // window.location = "/bus_tracking/admin/client";
            window.location = "<?php echo site_url('admin/notification');?>";
          }, 2000);
      });
  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="notification_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });

</script>