 <div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-3">
                <div class="mr-auto">
                    <h4><? echo $title;?></h4>
                 </div>
                 <div class="ml-auto">
                    <a class="text-dark" href="<?php echo site_url('admin/app_list');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                 </div> 
            </div>
            <form action="<?php echo site_url('admin/app_update');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                <input type="hidden" name="app_id" value="<?= $getappData->id;?>">
                <div class="row">
                    <div class="col-sm-12 ">
                         <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('app_version'); ?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control" type="text" id="app_version"  placeholder="<?php echo $this->lang->line('app_version'); ?>"name="app_version" required data-parsley-required-message="<?php echo $this->lang->line('enter_app_version'); ?>"  value="<?= $getappData->app_version;?>">
                                         
                                     </div>
                                </div>  
                             </div>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('release_date'); ?></label>
                                     <div class="col-sm-9">
                                        <input class="form-control" type="text"  id="release_date"  placeholder="<?php echo $this->lang->line('release_date'); ?>"name="release_date" required data-parsley-required-message="<?php echo $this->lang->line('enter_release_date'); ?>"  value="<?= $getappData->release_date;?>">
                                         
                                     </div>
                                </div>  
                             </div>


                            <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('android_ready'); ?></label>
                                     <div class="col-sm-9">
                                       <select class="form-control" data-live-search="true" name="android_ready" id="android_ready" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_android_ready'); ?>">
                                            <option value=""><?php echo $this->lang->line('select_android_ready'); ?></option>
                                            <option value="yes" <?php echo $getappData->android_ready == 'yes' ? 'selected' : '' ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="no" <?php echo $getappData->android_ready == 'no' ? 'selected' : '' ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                     </div>
                                </div>  
                             </div>

                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('ios_ready'); ?></label>
                                     <div class="col-sm-9">
                                        <select class="form-control" data-live-search="true" name="ios_ready" id="ios_ready" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_ios_ready'); ?>">
                                            <option value=""><?php echo $this->lang->line('select_ios_ready'); ?></option>
                                           <option value="yes" <?php echo $getappData->ios_ready == 'yes' ? 'selected' : '' ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="no" <?php echo $getappData->ios_ready == 'no' ? 'selected' : '' ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                     </div>
                                </div>  
                             </div> 
                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?php echo $this->lang->line('note'); ?></label>
                                     <div class="col-sm-9">
                                         <input class="form-control"  type="text" id="notes" placeholder="<?php echo $this->lang->line('note'); ?>" name="notes"  value="<?= $getappData->notes;?>">

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript">
    $( function() {
        // $( "#release_date" ).datepicker();
        $("#release_date").datepicker({
                dateFormat: 'dd/mm/yy'
        });
    });

</script>