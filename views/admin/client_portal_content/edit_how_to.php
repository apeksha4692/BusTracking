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
                 <form action="<?php echo site_url('admin/client_portal_content/HowToController/update_howto');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $how_to->id;?>">
                    <div class="col-sm-12 ">
                       
                       <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">English Title</label>
                                 <div class="col-sm-12">
                                     
                                     <textarea required="" id="title" class="form-control ckeditor" name="title" required data-parsley-required data-parsley-required-message="Enter English Title"><?php if (!empty($how_to->title)) { echo $how_to->title; } ?></textarea>
                                     
                                 </div>
                            </div>  
                         </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">English Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="description" class="form-control ckeditor" name="description" required data-parsley-required data-parsley-required-message="Enter English Description "><?php if (!empty($how_to->description)) { echo $how_to->description; } ?></textarea>
                                 </div>
                            </div>  
                         </div>
                         
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">Arabic Title</label>
                                 <div class="col-sm-12">
                                    <textarea required="" id="ar_title" class="form-control ckeditor" name="ar_title"required data-parsley-required data-parsley-required-message="Enter Arabic Title "><?php if (!empty($how_to->ar_title)) { echo $how_to->ar_title; } ?></textarea>
                                 </div>
                            </div>  
                         </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">Arabic Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="ar_description" class="form-control ckeditor" name="ar_description" required data-parsley-required data-parsley-required-message="Enter Arabic Description " ><?php if (!empty($how_to->ar_description)) { echo $how_to->ar_description; } ?></textarea>
                                 </div>
                            </div>  
                         </div>

                    </div>
                </div> 

                <div class="col-sm-12">
                    <div class="row flex-row-reverse">
                        <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                         <button class="btn-outline-warning btn" type="submit"><?php echo $this->lang->line('save'); ?></button>
                    </div>  
                </div>  

            </form>
               </div>
             </div> 
         </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ;?>assest/ckeditor/ckeditor.js">  </script>

<script type="text/javascript">

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