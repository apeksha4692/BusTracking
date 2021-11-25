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
               <div class="row">
                   
                 </div>
            <div class="d-flex w-100">
                <div class="mt-4 mr-auto">
                    <!-- <h5></h5> -->
                    <h4><?= $title;?></h4>
                 </div>
                <div class="ml-auto">
                    <!--<a class="my-btn" href="<?php echo site_url('admin/client_portal_content/addHow_To_Img');?>"> -->
                    <!--  <?php echo $this->lang->line('add_new'); ?>-->
                    <!--  <i class="fa fa-plus ml-2" aria-hidden="true"></i>-->
                    <!--</a>-->
                </div>
                 
            </div>

            <div class="d-flex mb-3">
               <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                       <?php echo $this->lang->line('delete'); ?>
                </button> 
            </div>   
            <div class="">        
                <table class="table table-borderless border-top border-bottom" id="example">
                    <thead>
                        <tr>
                            <th scope="col">
                              <input id="checkbox1" type="checkbox" name="contactId[]" class="form-control-custom" onchange="checkAllContact(this)">
                            </th>
                            <th scope="col">Name
                              <span>
                                    <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                     <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                </span>
                            </th>
                            <th scope="col">Email-Id
                              <span>
                                    <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                     <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                </span>
                             </th>
                            <th scope="col">Topic 
                            <span>
                                <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                 <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                            </span>
                          </th>
                          <th scope="col">Message 
                            <span>
                                <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                 <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                            </span>
                          </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                            if(!empty($contact_list)){
                                foreach ($contact_list as $value) { 
                        ?>

                        <tr>
                            <th scope="row">
                                      <!-- <input type="checkbox" name=""> -->
                                <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="contact_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                <label for="<?=$value['id']?>"></label><br>
                                <span id="errmsg" style="color: red;"></span>
                            </th>
                            <td> <?=$value['name']?></td>
                            <td> <?=$value['email']?></td>
                            <td> <?=$value['topic']?></td>
                            <td>
                                <style>
                                    .show-read-more .more-text{
                                        display: none;
                                    }
                                </style>
                                <p class="show-read-more mb-0"><?php 
                                   echo $value['message']; 
                                  ?></p>
                            </td>
                            
                        </tr>
                        <?php } }?>
                        <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                    </tbody>
                </table>                       
            </div>  
        </div>
    </div> 
</div>


         <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/client_portal_content/delete_contact_list');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="contact_id" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> How To Image </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure want to delet selected contact? </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>admin/client_portal_content/editHow_toImg" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="howToImgId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure want to edit this how to image? </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" ><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="selectAtleastOneTripModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Sorry, you select atleast one contact. </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>admin/client_portal_content/contact" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

<div class="modal fade" id="selectOnlyOneTripModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p>Sorry, you select only one contact. </p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>admin/client_portal_content/contact" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>
<script type="text/javascript">
     $(document).ready(function() {
        $('#example').DataTable( {
        });
    });
   

   
   //Delete Button Function
  function checkAllContact(ele) {
    $('input[name ="contact_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="contact_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });

     function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='contact_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $('#deleteAllModal').modal('hide');
            $('#selectAtleastOneTripModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }

//Edit Button Funtion
     function checkEdit()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='howImg_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
          // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#editModal').modal('hide');
            $('#selectAtleastOneTripModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneTripModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }
  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="howImg_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });
   
    
    $(document).ready(function(){
  var maxLength = 100;
  $(".show-read-more").each(function()
  {
        var myStr = $(this).text();
        // alert(myStr);
        if($.trim(myStr).length > maxLength)
        {
          // alert('hi');
          var newStr = myStr.substring(0, maxLength);
          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
          $(this).empty().html(newStr);
          $(this).append('<br> <a href="javascript:void(0);" class="read-more" style="color:blue;">read more...</a>');
          $(this).append('<span class="more-text">' + removedStr + '</span>');
          // alert(removedStr);
        }
        // else{
        //   alert('no');
        // }
  });
  $(".read-more").click(function()
  {
    $(this).siblings(".more-text").contents().unwrap();
    $(this).remove();
  });
});
</script>
