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
                 </div> 
            </div>
            <form action="<?php echo site_url('admin/client_portal_content/ContactController/update_contact_information');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                <div class="row">
                    <input type="hidden" name="id" value="<?= $contactInformation->id;?>">
                    <div class="col-sm-12 ">
                       <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Name in English
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Name in English" name="name" required data-parsley-required data-parsley-required-message="Enter name in english" value="<?= $contactInformation->name;?>">
                                </div>
                            </div>  
                        </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Name in Arabic
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Name in arabic" name="ar_name" required data-parsley-required data-parsley-required-message="Enter name in arabic" value="<?= $contactInformation->ar_name;?>">
                                </div>
                            </div>  
                        </div>
                        
                       <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Address in English
                                </label>
                                <div class="col-sm-8">
                                      <textarea required="" id="address" class="form-control ckeditor" name="address" required data-parsley-required data-parsley-required-message="Enter address in english"><?= $contactInformation->address;?></textarea>
                                </div>
                            </div>  
                        </div>
                        
                         <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Address in Arabic
                                </label>
                                <div class="col-sm-8">
                                     <textarea required="" id="ar_address" class="form-control ckeditor" name="ar_address" required data-parsley-required data-parsley-required-message="Enter address in arabic"><?= $contactInformation->ar_address;?></textarea>
                                </div>
                            </div>  
                        </div>
                        
                         <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Telephone
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Telephone" name="mobile_number" required data-parsley-required data-parsley-required-message="Enter Telephone" value="<?= $contactInformation->mobile_number;?>">
                                </div>
                            </div>  
                        </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Email Id in English
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Email Id in English" name="email_id" required data-parsley-required data-parsley-required-message="Enter Email Id in English" type="email" data-parsley-type="email" value="<?= $contactInformation->email_id;?>">
                                </div>
                            </div>  
                        </div>
                        
                         <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                    Email Id in Arabic
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Email Id in Arabic" name="ar_email_id" required data-parsley-required data-parsley-required-message="Enter Email Id in Arabic" type="email" data-parsley-type="email" value="<?= $contactInformation->ar_email_id;?>">
                                </div>
                            </div>  
                        </div>
                         <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                   Website
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Website" name="website" required data-parsley-required data-parsley-required-message="Enter Website" value="<?= $contactInformation->website;?>">
                                </div>
                            </div>  
                        </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                   Forwarding Mail 1
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Forwarding Mail 1" name="forwardingmail_one" required data-parsley-required data-parsley-required-message="Enter Forwarding Mail 1" value="<?= $contactInformation->forwardingmail_one;?>" type="email" data-parsley-type="email">
                                </div>
                            </div>  
                        </div>
                        
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-3">
                                   Forwarding Mail 2
                                </label>
                                <div class="col-sm-8">
                                     <input class="form-control" type="text" placeholder="Forwarding Mail 2" name="forwardingmail_two" required data-parsley-required data-parsley-required-message="Enter Forwarding Mail 2" value="<?= $contactInformation->forwardingmail_two;?>" type="email" data-parsley-type="email">
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
  CKEDITOR.on('instanceReady', function () {
        $('#address').attr('required', '');
        $('#ar_address').attr('required', '');
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