
 <div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-3">
                <div class="mr-auto">
                    <h4><? echo $title;?></h4>
                 </div>
                 <div class="ml-auto">
                    <a class="text-dark" href="<?php echo site_url('admin/client');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                 </div> 
            </div>
            <!-- <form class="row" action="<?php echo site_url('admin/client/update');?>" enctype="multipart/form-data" method="post" data-parsley-validate=""> -->
                <input type="hidden" name="id" value="<?php echo $getclientData->id;?>"> 
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    <?php echo $this->lang->line('client_name'); ?>
                                </label>
                                <div class="col-sm-9">
                                     <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('client_name'); ?>" name="client_name" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_client_name'); ?> " value="<?php echo $getclientData->client_name; ?>" readonly>
                                </div>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">
                                     <?php echo $this->lang->line('focal_point_name'); ?>
                                 </label>
                                 <div class="col-sm-9">
                                     <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('focal_point_name'); ?>" name="focal_point_name" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_name'); ?> "  value="<?php echo $getclientData->focal_point_name; ?>" readonly>
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('focal_point_number'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('focal_point_number'); ?>" name="focal_point_number" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php echo $getclientData->focal_point_number; ?>" readonly>
                                 </div>
                            </div>  
                         </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('focal_point_email'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="focal_point_email" type="text" placeholder="<?php echo $this->lang->line('focal_point_email'); ?>" name="focal_point_email" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_focal_point_email'); ?>" type="email"data-parsley-type="email"  value="<?php echo $getclientData->focal_point_email; ?>" readonly>
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('max_chaperone_user'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="max_chaperone" type="text" placeholder="<?php echo $this->lang->line('max_chaperone_user'); ?>" name="max_chaperone" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_max_chaperone_user'); ?> " data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php echo $getclientData->max_chaperone; ?>" readonly>
                                 </div>
                            </div>  
                         </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('max_portal_user'); ?></label>
                                 <div class="col-sm-9">
                                     <input class="form-control" id="max_parent" type="text" placeholder="<?php echo $this->lang->line('max_portal_user'); ?>" name="max_parent" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_max_portal_user'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?>"  min="1" value="<?php echo $getclientData->max_parent; ?>" readonly>
                                 </div>
                            </div>  
                         </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('logo'); ?></label>
                                 <div class="col-sm-5">
                                     <!-- <input class="form-control" type="" name=""> -->

                                     <img width="100" id="img_add" name="img" src="<?php echo CLIENT_IMG.$getclientData->logo_image;?>">
                                 </div>
                                 <!-- <a class="btn-outline-warning btn btn-sm">Regene</a> -->
                                <!-- <input type='file' name="profile_pic" id="imgadd" class="btn-outline-warning btn btn-sm" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('select_img'); ?>"/> -->
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('status'); ?></label>
                                 <div class="col-sm-5">
                                    <select class="form-control mb-0" name="status" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('select_status'); ?>">
                                        <option value=""><?php echo $this->lang->line('select_status')?></option>
                                        <option value="1" <?php echo $getclientData->status == '1' ? 'selected' : ''?> ><?php echo $this->lang->line('active')?></option>
                                        <option value="0" <?php echo $getclientData->status == '0' ? 'selected' : ''?> ><?php echo $this->lang->line('deactive')?></option>
                                    </select>
                                 </div>

                            </div>  
                         </div>


                    </div>
                </div> 

                <!-- <div class="col-sm-12">
                    <div class="row flex-row-reverse">
                        <a class="btn-outline-warning btn btn-sm">Save</a>
                         <button class="btn-outline-warning btn btn-sm" type="submit"><?php echo $this->lang->line('update'); ?></button>
                    </div>  
                </div>   -->

            <!-- </form> -->
        </div>
    </div> 
</div>

<script type="text/javascript">
   // -------------Add Image Preview------------------------------
   function read(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_add').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgadd").change(function(){
        read(this);
    }); 


</script>