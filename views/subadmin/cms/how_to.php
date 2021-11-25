<div class="client-portal how_to">

    <div class="container">
         <h2 class="mb-3 text-uppercase">
           <b>
           <?php 
                if(!empty($this->session->userdata('site_lang'))){
                    if($this->session->userdata('site_lang') == 'english'){
                        echo html_entity_decode($howToDetail->title); 
                    }else{
                        echo html_entity_decode($howToDetail->ar_title); 
                    }
                }else{
                    echo html_entity_decode($howToDetail->title); 
                }
           ?>
           </b> 
        </h2>
        <p class="">
          <?php 
                if(!empty($this->session->userdata('site_lang'))){
                    if($this->session->userdata('site_lang') == 'english'){
                        echo html_entity_decode($howToDetail->description); 
                    }else{
                        echo html_entity_decode($howToDetail->ar_description); 
                    }
                }else{
                    echo html_entity_decode($howToDetail->description); 
                }
           ?>
        </p>
        <div class="row">
          <?php foreach($getHowToImg as $value) {?>
            <div class="col-sm-3">
              <div class="conten">
                <img width="100%" src="<?php echo  HOW_TO_IMG.$value['img'];?>">
                <p class="mt-3">
                      <?php 
                if(!empty($this->session->userdata('site_lang'))){
                    if($this->session->userdata('site_lang') == 'english'){
                        echo html_entity_decode($value['description']); 
                    }else{
                        echo html_entity_decode($value['ar_description']); 
                    }
                }else{
                    echo html_entity_decode($value['description']); 
                }
           ?>
                </p>
              </div>
            </div> 
          <?php }?>      
            <!-- <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>       
            <div class="col-sm-3">
              <img width="100%" src="img/ab-1.jpg">
              <p class="mt-3">Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>    -->     
        </div>      
   </div>  

 </div> 

