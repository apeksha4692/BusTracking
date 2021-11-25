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
                    if($record_num=='about_us' ){
                        $aboutUs = 'nav-link active';
                    }else{
                        $aboutUs = 'nav-link';
                    }
                    
                    if($record_num=='how_to' ){
                        $howTo = 'nav-link active';
                    }else{
                        $howTo = 'nav-link';
                    }
                    
                    if($record_num=='contact' ){
                        $contact = 'nav-link active';
                    }else{
                        $contact = 'nav-link';
                    }
                    
                     if($record_num=='contact_information' ){
                        $contact_information = 'nav-link active';
                    }else{
                        $contact_information = 'nav-link';
                    }
                    
                ?>
                  <li class="nav-item">
                      <a class="<?= $aboutUs;?>"  href="<?php echo site_url('admin/client_portal_content/about_us');?>">About</a>
                  </li> 
                  <li class="nav-item">
                      <a class="<?= $howTo;?>" href="<?php echo site_url('admin/client_portal_content/how_to');?>">How To</a>
                  </li>
                  <li class="nav-item">
                      <a class="<?= $contact;?>" href="<?php echo site_url('admin/client_portal_content/contact');?>">Contact</a>
                  </li> 
                  <li class="nav-item">
                      <a class="<?= $contact_information;?>" href="<?php echo site_url('admin/client_portal_content/contact_information');?>">Contact Information</a>
                  </li> 
             </ul>
           </div>
               
            <div class="d-flex w-100">
                <div class="mt-4 mr-auto">
                    <!-- <h5></h5> -->
                 </div>
                <div class="ml-auto">
                     <!-- <a class="my-btn mr-3" href="<?php echo site_url('admin/reporting/import_bus_view');?>"> 
                         <?php echo $this->lang->line('import'); ?>
                        <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                      </a> -->
                    <!--<a class="my-btn" href="<?php echo site_url('admin/reporting/busAdd');?>"> -->
                    <!--  <?php echo $this->lang->line('add_new'); ?>-->
                    <!--  <i class="fa fa-plus ml-2" aria-hidden="true"></i>-->
                    <!--</a>-->
                </div>
                 
            </div>

            <div class="d-flex mb-3">
               
            </div>      
           <!--<div class="row"> 	-->
           <!-- <div class="col-sm-12 p-0">        -->
                                     
           <!-- </div> -->
           <!--</div>           -->
           
            <div class="col-sm-7 m-auto">
    <div class="border p-3 bg-white">
        <div class="chaperone-add">
            <div class="d-flex mb-4">
                <div class="mr-auto">
                    <!--<h4><? echo $title;?></h4>-->
                 </div>
                 <div class="ml-auto">
                    <!--<a class="text-dark" href="<?php echo site_url('admin/clientuser');?>"><i class="fa fa-times" aria-hidden="true"></i></a>-->
                 </div> 
            </div>
            <form action="<?php echo site_url('admin/client_portal_content/AboutUsController/update_about');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $about_us->id;?>">
                    <div class="col-sm-12 ">
                       
                       <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">English Title</label>
                                 <div class="col-sm-12">
                                     
                                     <textarea required="" id="title" class="form-control ckeditor" name="title" required data-parsley-required data-parsley-required-message="Enter English Title"><?php if (!empty($about_us->title)) { echo $about_us->title; } ?></textarea>
                                     
                                 </div>
                            </div>  
                         </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">English Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="description" class="form-control ckeditor" name="description" required data-parsley-required data-parsley-required-message="Enter English Description "><?php if (!empty($about_us->description)) { echo $about_us->description; } ?></textarea>
                                 </div>
                            </div>  
                         </div>
                         
                         <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">Arabic Title</label>
                                 <div class="col-sm-12">
                                    <textarea required="" id="ar_title" class="form-control ckeditor" name="ar_title"required data-parsley-required data-parsley-required-message="Enter Arabic Title "><?php if (!empty($about_us->ar_title)) { echo $about_us->ar_title; } ?></textarea>
                                 </div>
                            </div>  
                         </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                 <label class="col-sm-3">Arabic Description</label>
                                 <div class="col-sm-12">
                                      <textarea required="" id="ar_description" class="form-control ckeditor" name="ar_description" required data-parsley-required data-parsley-required-message="Enter Arabic Description " ><?php if (!empty($about_us->ar_description)) { echo $about_us->ar_description; } ?></textarea>
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
        </div>
    </div> 
</div>



<script src="<?php echo base_url() ;?>assest/ckeditor/ckeditor.js">  </script>
<script type="text/javascript">
    // CKEDITOR.replace( 'title', {
    //     fullPage: true,
    //     allowedContent: true,
    //     extraPlugins: 'wysiwygarea'
    // });
    
    // CKEDITOR.replace( 'ar_title', {
    //     fullPage: true,
    //     allowedContent: true,
    //     extraPlugins: 'wysiwygarea'
    // });
    
    // CKEDITOR.replace( 'description', {
    //     fullPage: true,
    //     allowedContent: true,
    //     extraPlugins: 'wysiwygarea'
    // });
    
    // CKEDITOR.replace( 'ar_description', {
    //     fullPage: true,
    //     allowedContent: true,
    //     extraPlugins: 'wysiwygarea'
    // });
    
    CKEDITOR.on('instanceReady', function () {
        $('#description').attr('required', '');
        $('#ar_title').attr('required', '');
        $('#title').attr('required', '');
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