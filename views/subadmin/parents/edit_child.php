<div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-3">
                <div class="mr-auto">
                    <h4><? echo $title;?></h4>
                 </div>
                 <div class="ml-auto">
                    <a class="text-dark" href="<?php echo base_url().'subadmin/parents_view/'.$childDetail->parents_id;?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                 </div> 
            </div>
            <form action="<?php echo site_url('subadmin/parent/update_child');?>" enctype="multipart/form-data" method="post" data-parsley-validate="">
                <input type="hidden" name="id" value="<?php echo $childDetail->id;?>"> 
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    <?php echo $this->lang->line('child_name'); ?>
                                </label>
                                <div class="col-sm-9">
                                     <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('child_name'); ?>" name="child_name" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_client_name'); ?> " value="<?php echo $childDetail->child_name; ?>" >
                                </div>
                            </div>  
                         
    
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('logo'); ?></label>
                                 <div class="col-sm-5 text-center">
                                     <!-- <input class="form-control" type="" name=""> -->

                                     <img width="100" id="img_add" name="img" src="<?php echo base_url().'uploads/child_image/'.$childDetail->child_image; ?>">
                                    <div class="upload-btn-wrapper">
                                      
                                       <button class="btn2">Select File</button>
                                      <input type='file' name="profile_pic" id="imgadd" class=""/>
                                      
                                    </div>
                                 </div>

                            </div>  
                        </div>


                    </div>
                </div> 

                <div class="col-sm-12">
                    <div class="row flex-row-reverse">
                        <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                         <button class="btn-outline-warning btn btn-sm" type="submit"><?php echo $this->lang->line('update'); ?></button>
                    </div>  
                </div>  

            </form>
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
    //---------------Check Image Type ------------------
    var fileNode = document.querySelector('#imgadd');
        fileNode.addEventListener('change', function( event ) 
        {
            // alert('hi');
            var reader = new FileReader();

            reader.onload = function() {
                $('#img_add').attr('src', e.target.result);
            }

            reader.readAsDataURL(event.target.files[0]);

            var form = new FormData();
            var xhr  = new XMLHttpRequest();
            var file = this.files[0];

            if ( ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'].indexOf(file.type) == -1 ) {
                 toastr.error("<?php echo $this->lang->line('file_type_not_allow'); ?>");
                $('#errmsg_file_type').html('<?php echo $this->lang->line('file_type_allow'); ?>');
                 return false;
            }
            $('#errmsg_file_type').html('');
        });

</script>