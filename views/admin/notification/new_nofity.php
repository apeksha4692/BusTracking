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
                   <?php
                      if($record_num=='notification' ){
                          $notification = 'nav-link ';
                      }else{
                          $notification = 'nav-link ';
                      }
                      
                      if($record_num=='notification_new' ){
                          $notification_new = 'nav-link active';
                      }else{
                          $notification_new = 'nav-link';
                      }
                      ?>
                   <li class="nav-item">
                      <a class="<?= $notification_new; ?> " href="<?php echo site_url('admin/notification_new');?>"><?php echo $this->lang->line('new_notification'); ?></a>
                   </li>
                   <li class="nav-item">
                      <a class="<?= $notification; ?>" href="<?php echo site_url('admin/notification');?>"><?php echo $this->lang->line('notification_log'); ?></a>
                   </li>
                </ul>
            </div>
            <div >
                <form class="row" action="<?php echo site_url('admin/insert_nofication');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" >
                    <div class="col-sm-6">
                        <div class="border p-3">
                            <div class="chaperone-add">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <div class="form-group">
                                            <div class="row align-items-center">
                                                <label class="col-sm-4"><?php echo $this->lang->line('clients'); ?></label>
                                                <div class="col-sm-8">
                                                   <select class="form-control mb-0" data-live-search="true" name="client" id="client_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>">
                                                      <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                                                      <option data-tokens="all" value="all"><?php echo $this->lang->line('all_client'); ?> </option>
                                                      <?php foreach ($getAllClient as $key) { ?>
                                                      <option data-tokens="<?php echo $key['client_name']; ?>" value="<?php echo $key['client_name']; ?>"><?php echo $key['client_name']; ?></option>
                                                      <?php } ?>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>
                              <div class="form-group">
                                 <div class="row align-items-center">
                                    <label class="col-sm-4"><?php echo $this->lang->line('user'); ?></label>
                                    <div class="col-sm-8">
                                       <select class="form-control mb-0" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_user'); ?>" name="app_user">
                                            <option value=""><?php echo $this->lang->line('select_user'); ?></option>
                                          <option value="all"><?php echo $this->lang->line('all'); ?></option>
                                          <option value="chaperone"><?php echo $this->lang->line('chaperone_list'); ?></option>
                                          <option value="parent"><?php echo $this->lang->line('parent_list'); ?><option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row align-items-center">
                                    <label class="col-sm-4"><?php echo $this->lang->line('based_on_app_version'); ?> </label>
                                    <div class="col-sm-8">
                                       <select class="form-control mb-0" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_based_on'); ?>" name="based_app">
                                        <option value=""><?php echo $this->lang->line('select_based_on'); ?></option>
                                          <option value="yes"><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="no"><?php echo $this->lang->line('no'); ?></option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row align-items-center">
                                    <label class="col-sm-4"><?php echo $this->lang->line('all_app_version'); ?> </label>
                                    <div class="col-sm-8">
                                       <select class="form-control mb-0" data-live-search="true" name="version" id="version" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_version'); ?>" name="version">
                                          <option value=""><?php echo $this->lang->line('select_version'); ?></option>
                                          <option data-tokens="all" value="all"><?php echo $this->lang->line('all_version'); ?> </option>
                                          <?php foreach ($getAllApp as $key) { ?>
                                          <option data-tokens="<?php echo $key['app_version']; ?>" value="<?php echo $key['app_version']; ?>"><?php echo $key['app_version']; ?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row align-items-center">
                                    <label class="col-sm-4"><?php echo $this->lang->line('platform'); ?> </label>
                                    <div class="col-sm-8">
                                       <select class="form-control mb-0" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_platform'); ?>" name="platform">
                                            <option value=""><?php echo $this->lang->line('select_platform'); ?></option>
                                            <option value="all"><?php echo $this->lang->line('all'); ?></option>
                                            <option value="android"><?php echo $this->lang->line('android'); ?> </option>
                                            <option value="ios"><?php echo $this->lang->line('ios'); ?> </option>
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
               <div class="col-sm-6 justify-content-center align-items-center d-flex">
                  <div class="col-sm-10">
                     <div class="form-group">
                        <P><?php echo $this->lang->line('msg'); ?></P>
                        <textarea rows="5" cols="5" name="msg" required data-parsley-required-message="<?php echo $this->lang->line('enter_your_message'); ?>"></textarea>
                        <div class="d-flex flex-row-reverse">
                           <button class="btn btn-warning mt-3"><?php echo $this->lang->line('send_notification'); ?></button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#client_id').select2();
        $('#version').select2();

    });
</script>