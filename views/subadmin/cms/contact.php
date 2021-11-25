<div class="client-portal about-us contactpage">
    <div class="container">
        <div class="">
             <div class="row">
                 <div class="col-sm-6">
             <div class=" p-3 z-depth-0 bg-white">
                <form class="login-form" action="<?php echo site_url('subadmin/send_contact');?>" method="POST" data-parsley-validate>
                   <div class="">
                        <div class="d-flex mb-5">
                            <div class=" text-center w-100 mt-3">
                                <h4><?php echo $this->lang->line('something_in_your_mind'); ?> </h4>
                                <h5 class="text-warning"><?php echo $this->lang->line('lets_get_in_touch_now'); ?></h5>
                             </div>
                             
                        </div>

                        <div class="row">
                             <div class="col-sm-6 ">
                                 <div class="form-group">
                                    <div class="row align-items-center">
                                         <label class="col-sm-12"><?php echo $this->lang->line('first_name'); ?></label>
                                         <div class="col-sm-12">
                                             <input class="form-control" type="text" name="first_name" placeholder="<?php echo $this->lang->line('first_name'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_first_name'); ?>">
                                         </div>
                                    </div>  
                                 </div>
                                
                             </div>
                             <div class="col-sm-6 ">
                                 <div class="form-group">
                                    <div class="row align-items-center">
                                         <label class="col-sm-12"><?php echo $this->lang->line('last_name'); ?></label>
                                         <div class="col-sm-12">
                                             <input class="form-control" type="text" name="last_name" placeholder="<?php echo $this->lang->line('last_name'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_last_name'); ?>">
                                         </div>
                                    </div>  
                                 </div>
                                
                             </div>
                        </div> 
                        <div class="row">

                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="row align-items-center">
                                         <label class="col-sm-12"><?php echo $this->lang->line('your_email_address'); ?> </label>
                                         <div class="col-sm-12">
                                             <input class="form-control" type="text" name="email" placeholder="<?php echo $this->lang->line('your_email_address'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_your_email_address'); ?>" type="email" data-parsley-type="email" data-parsley-type-message="<?php echo $this->lang->line('type_valid_email'); ?>">
                                         </div>
                                    </div>  
                                 </div>
                                
                             </div>
                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="row align-items-center">
                                         <label class="col-sm-12"><?php echo $this->lang->line('topic'); ?></label>
                                         <div class="col-sm-12">
                                             <input class="form-control" type="text" name="topic" placeholder="<?php echo $this->lang->line('what_is_the_topic'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_your_topic'); ?>">
                                         </div>
                                    </div>  
                                 </div>
                                
                             </div>
                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="row align-items-center">
                                         <label class="col-sm-12"><?php echo $this->lang->line('type_your_message'); ?> </label>
                                         <div class="col-sm-12">
                                             <input class="form-control" type="text" name="message" placeholder="<?php echo $this->lang->line('write'); ?> " required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_your_message'); ?>">
                                         </div>
                                    </div>  
                                 </div>
                                
                             </div>
                        </div>  

                        <div class="col-sm-12">
                            <div class="row ">
                                 <!-- <a class="btn-warning btn btn-sm waves-effect waves-light">Save</a> -->
                                 <button class="btn-login"><?php echo $this->lang->line('save'); ?></button> 
                            </div>  
                        </div>  
                   </div>
                </form>
             </div> 
         </div>  

                 <div class="col-sm-6 align-self-end">
                      <div class=" w-100">
                         <h5>
                             
                             
                              <?php 
                                if(!empty($this->session->userdata('site_lang'))){
                                    if($this->session->userdata('site_lang') == 'english'){
                                        echo $contactInformation->name; 
                                    }else{
                                      echo  $contactInformation->ar_name; 
                                    }
                                }else{
                                    echo $contactInformation->name;
                                }
                              ?>
                         </h5> 
                         <p>
                              <?php 
                                if(!empty($this->session->userdata('site_lang'))){
                                    if($this->session->userdata('site_lang') == 'english'){
                                        echo $contactInformation->address; 
                                    }else{
                                      echo  $contactInformation->ar_address; 
                                    }
                                }else{
                                    echo $contactInformation->address;
                                }
                              ?>
                            <!-- Zaina Center. 6th floor <br> 44 Queen Nour Street <br>  PO. Box 2389 <br> Amman 1 1181 Jordan -->
                         </p> 
                         <p class="mb-0">Tel  <a href="tel:<?= $contactInformation->mobile_number?>"><?= $contactInformation->mobile_number?></a> </p>
                          <p class="mb-0"> 
                            <a href="mailto:<?= $contactInformation->email_id?>">
                                <?php 
                                if(!empty($this->session->userdata('site_lang'))){
                                    if($this->session->userdata('site_lang') == 'english'){
                                        echo $contactInformation->email_id; 
                                    }else{
                                      echo  $contactInformation->ar_email_id; 
                                    }
                                }else{
                                    echo $contactInformation->email_id;
                                }
                              ?>
                            </a> 
                          </p>
                          <p class="mb-0"><?= $contactInformation->website; ?></p>
                      </div> 
                 </div>   
             </div>   
        </div>      
   </div>  
</div> 
