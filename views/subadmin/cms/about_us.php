<div class="client-portal about-us">
    <div class="container">
        <div class="">
             <div class="row">
                 <div class="col-sm-6 conten">
                    <h2 class="mb-3 text-uppercase"> 
                      <b>
                      <?php 
                        if(!empty($this->session->userdata('site_lang'))){
                            if($this->session->userdata('site_lang') == 'english'){
                                echo html_entity_decode($aboutDetail->title); 
                            }else{
                                echo html_entity_decode($aboutDetail->ar_title); 
                            }
                        }else{
                            echo html_entity_decode($aboutDetail->title); 
                        }
                      ?>
                    </b>
                    </h2>
                        <p>
                            <?php 
                                if(!empty($this->session->userdata('site_lang'))){
                                    if($this->session->userdata('site_lang') == 'english'){
                                        echo html_entity_decode($aboutDetail->description); 
                                    }else{
                                        echo html_entity_decode($aboutDetail->ar_description); 
                                    }
                                }else{
                                    echo html_entity_decode($aboutDetail->description); 
                                }
                              ?>
                        </p>
                 </div>  

                 <div class="col-sm-6">
                      <div class="row">
                         <div class="col-sm-6 pr-0">
                            <img class="mb-4" width="100%" src="<?php echo base_url(); ?>assest/img/ab-2.jpg"> 
                            <img width="100%" src="<?php echo base_url(); ?>assest/img/ab-1.jpg"> 
                         </div>
                         <div class="col-sm-6">
                            <img height="100%" width="100%" src="<?php echo base_url(); ?>assest/img/ab-3.jpg">
                         </div>   
                      </div> 
                 </div>   
             </div>   
        </div>      
   </div>  

 </div> 
