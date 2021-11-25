<?php $checked_arr = explode(",",$getAdminData->role);?>
 <div class="col-sm-12">

             <div class="border p-3 bg-white">

               <div class="">

                    <div class="d-flex">

                        <div class="mr-auto">

                            <h4><?php echo $title; ?> (<?= $user->total;?>)</h4>

                         </div>

                         <div class="ml-auto">
                              <a class="my-btn" href="<?php echo site_url('admin/admin_portal_user/add_user');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                         </div> 

                    </div>

                    <div class="d-flex mb-3">
                           <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()" >
                                   <?php echo $this->lang->line('delete'); ?>
                            </button> 
                            <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                                   <?php echo $this->lang->line('edit'); ?>
                            </button>
                        
                            <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                                   <?php echo $this->lang->line('export'); ?>
                            </button> 
                    </div>      
   

                    <div class="">                     

                            <table class="table table-borderless border-top border-bottom" id="example">

                                <thead>

                                  <tr>

                                    <th scope="col">
                                       <input id="checkbox1" type="checkbox" name="adminPortal[]" class="form-control-custom" onchange="checkAllAdminPortal(this)">
                                    </th>

                                    <th scope="col">Admin Portal User Name
                                       <span>
                                            <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col">Email
                                       <span>
                                            <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col">Last Date/Time Loginin
                                       <span>
                                            <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col">Note</th>
                                  </tr>

                                </thead>

                                <tbody>
                                    <?php
                                        if(!empty($getAllAdminUser)){
                                            foreach($getAllAdminUser as $value)
                                        {
                                    ?>

                                  <tr>

                                    <th scope="row"> 
                                        <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="adminPortal_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">

                                      <label for="<?=$value['id']?>"></label><br>

                                      <span id="errmsg" style="color: red;"></span>    
                                    </th>
                                     <td><?=$value['name']?></td>
                                     <td><?=$value['email']?></td>
                                     <td><?=$value['last_login']?></td>
                                     <td><?=$value['note']?></td>
                                  </tr>
                                  <?php }}?>

                                </tbody>

                            </table>

                          

                    </div> 

               </div>

             </div> 

         </div>




  <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/admin_portal_user/delete_user');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="adminPortalId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('clients'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure want to delete selected admin portal user? </p>
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


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>admin/AdminPortalUser/exportAdminPortal" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="adminPortalId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p>Are you sure want to export selected admin portal user? </p>
                        </div>
                        <div class="modal-footer">
                            <button class="my-btn bg-transparent" type="submit" id="submitExcel"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>admin/AdminPortalUser/editAdminPortal" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="adminPortalId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p>Are you sure want to edit selected admin portal user? </p>
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

 <div class="modal fade" id="selectOnlyOneClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="cliendId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Sorry, you select only one admin portal user. </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelOneBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/admin_portal_user/user_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

 <div class="modal fade" id="selectAtleastOneClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="cliendId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Sorry, you select  atleast one admin portal user.</p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/admin_portal_user/user_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>






<script type="text/javascript">
//select all checkbox
       function checkAllAdminPortal(ele) {
          $('input[name ="adminPortal_id[]"]').each( function() {
              if (ele.checked) {
                  $(this).prop('checked',true);
              } else {
                  $(this).prop('checked',false);
              } 
          });
       }
//Delete Button Funtion
    function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='adminPortal_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $('#deleteAllModal').modal('hide');
             $('#selectAtleastOneClientModal').modal('show');
        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }
    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="adminPortal_id[]"]:checked').each(function() {
         selected_id.push(this.value);
      });
      $('#txtDelete').val(selected_id);
    });

//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='adminPortal_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
         
            $('#exportModal').modal('hide');
             $('#selectAtleastOneClientModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#exportModal').modal('show');
        }
    }
  $(document).ready(function(){
      $("#submitExcel").click(function(){        
          // $("#excelForm").submit(); // Submit the form
          setTimeout(function() {
            // window.location = "/bus_tracking/admin/client";
            window.location = "<?php echo site_url('admin/admin_portal_user/user_list');?>";
          }, 2000);
      });

  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="adminPortal_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });

//Edit Button Funtion
     function checkEdit()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='adminPortal_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
            $('#editModal').modal('hide');
            $('#selectAtleastOneClientModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
           $('#editModal').modal('hide');
           $('#selectOnlyOneClientModal').modal('show');
        }
    }


  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="adminPortal_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });

//Confirmation Modal close Funtion
     $("#modelAlteastBus").click(function(){
        $('#selectAtleastOneClientModal').modal('hide');
    });

</script>

