
         <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo site_url('admin/client_portal_content/how_to');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('admin/client_portal_content/HowToController/updateHowToImg');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <input type="hidden" name="id" value="<?= $how_to_img->id;?>">
                    <div class="row">
                         <div class="col-sm-12 ">
                             <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">English Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="description" class="form-control ckeditor" name="description" required data-parsley-required data-parsley-required-message="Enter English Description"><?php if (!empty($how_to_img->description)) { echo $how_to_img->description; } ?></textarea>
                                 </div>
                            </div>  
                         </div>
                         
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">Arabic Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="ar_description" class="form-control ckeditor" name="ar_description" required data-parsley-required data-parsley-required-message="Enter Arabic Description"><?php if (!empty($how_to_img->ar_description)) { echo $how_to_img->ar_description; } ?></textarea>
                                 </div>
                            </div>  
                         </div>

                            <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3"><?php echo $this->lang->line('logo'); ?></label>
                                 <div class="col-sm-5 text-center">
                                     <img width="100" id="img_add" name="img" src="<?php echo HOW_TO_IMG.$how_to_img->img;?>">
                                    <div class="upload-btn-wrapper">
                                       <button class="btn2">Select File</button>
                                      <input type='file' name="profile_pic" id="imgadd" class=""/>
                                     <spam style="color: red">(Image Size Should be Width is 235px and Height is 180px)</spam>
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
<script src="<?php echo base_url() ;?>assest/ckeditor/ckeditor.js">  </script>

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

// CKEDITOR.replace( 'description', {
//         fullPage: true,
//         allowedContent: true,
//         extraPlugins: 'wysiwygarea'
//     });
    
//     CKEDITOR.replace( 'ar_description', {
//         fullPage: true,
//         allowedContent: true,
//         extraPlugins: 'wysiwygarea'
//     });

    CKEDITOR.on('instanceReady', function () {
        $('#description').attr('required', '');
        $('#ar_description').attr('required', '');
        $.each(CKEDITOR.instances, function (instance) {
            CKEDITOR.instances[instance].on("change", function (e) {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                    $('form').parsley().validate();
                }
            });
        });
    });
</script>