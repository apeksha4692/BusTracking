<?php $checked_arr = explode(",",$getAdminData->role);?>

<div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                <div class="d-flex">
                    <label class="mt-2"><?php echo $this->lang->line('client_name'); ?></label>
                    <div class="col-sm-3">
                      <select class="form-control" data-live-search="true" name="client_id" id="client_id" onchange="getClient(this.value);">
                            <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                            <option data-tokens="0" value="0"><?php echo $this->lang->line('all_client'); ?> </option>
                             <?php foreach ($getAllClient as $key) { ?>
                                <!--<option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php if(!empty($client_id)){echo $client_id == $key['id'] ? 'selected' : '';}else{"";}?>><?php echo $key['client_name']; ?></option>-->
                                <option data-tokens="<?php echo $key['client_name']; ?>" value="<?php echo $key['client_name']; ?>" <?php if(!empty($client_id)){echo $client_id == $key['client_name'] ? 'selected' : '';}else{"";}?>><?php echo $key['client_name']; ?></option>

                             <?php } ?>
                        </select>
                    </div>
                    <div>
                       <a class="text-warning mr-3" href="<?php echo site_url('admin/clientuser');?>"> <?php echo $this->lang->line('refresh'); ?></a>
                    </div>
                </div>  
                    <div class="d-flex">
                        <div class="mr-auto my-3">
                            <h5 class="mb-0"><?= $title; ?> (<?php echo $clientuser_count->client_user_total?>)</h5>
                         </div>
                         <div class="ml-auto">
                            <?php if(in_array("12", $checked_arr)) {?>
                              <a class="my-btn mr-3" href="<?php echo site_url('admin/import_clientUser_view');?>"> 
                                 <?php echo $this->lang->line('import'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                            <?php } if(in_array("13", $checked_arr)) {?>
                              <a class="my-btn" href="<?php echo site_url('admin/clientuser_add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                            <?php } ?>
                         </div> 
                    </div>

                    <div class="d-flex mb-3">
                    <?php if(in_array("9", $checked_arr)) {?>
                      <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()" >
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 
                    <?php } if(in_array("10", $checked_arr)) {?>
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                               <?php echo $this->lang->line('edit'); ?>
                        </button>
                    <?php } if(in_array("11", $checked_arr)) {?>
                        <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                               <?php echo $this->lang->line('export'); ?>
                        </button> 
                    <?php } ?>
                    </div>      

                    <div class="row">
                       <div class="col-sm-12 px-0">
                            <table class="table table-borderless border-top border-bottom"  id="example">
                                <thead>
                                  <tr>
                                     <th scope="col">
                                       <input id="checkbox1" type="checkbox" name="clientUser[]" class="form-control-custom" onchange="checkAllClientUser(this)">
                                     </th>
                                    <th scope="col"><?php echo $this->lang->line('client_name'); ?>
                                        <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('client_user_name'); ?>
                                      <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('client_email_id'); ?>
                                      <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('client_mobile_number'); ?>
                                      <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('login_user_name'); ?>
                                        <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('login_password'); ?>
                                        <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('last_login_date'); ?>
                                      <span>
                                          <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                           <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                      </span>
                                    </th>

                                    <!-- <th scope="col"><?php echo $this->lang->line('status'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('action'); ?></th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php
                                    $i = 1;
                                    if(!empty($getAllClientUser)){
                                        foreach ($getAllClientUser as $key => $value) { 
                                  ?>

                                  <tr>
                                    <th scope="row">
                                         <input id="<?=$value['client_user_id']?>" type="checkbox" value="<?=$value['client_user_id']?>" name="clientuser_id[]" class="form-control-custom"  data-id ="<?=$value['client_user_id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                      <label for="<?=$value['client_user_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                      <!-- <input type="checkbox" name=""> -->
                                    </th>
                                    <td><?=$value['client_name']?></td>
                                     <td><?=$value['username']?></td>
                                     <td><?=$value['email']?></td>
                                     <td><?=$value['mobile_number']?></td>
                                     <td><?=$value['login_username']?></td>
                                     <td><?=$value['login_password']?></td>
                                     <td><?=$value['last_login_date']?></td>
                                    <!--  <td>
                                        <?php if($value['status'] == 1) { ?>
                                            <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['client_user_id']?>')" onclick="change_status('<?=$value['client_user_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                        <?php } else { ?>
                                           <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['client_user_id']?>')" onclick="change_status('<?=$value['client_user_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                        <?php }  ?>

                                     </td> -->
                                     <!-- <td>
                                       <a  title="<?php echo $this->lang->line('view'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_view/'.$value['client_user_id'];?>"><?php echo $this->lang->line('view'); ?></a>

                                        <a  title="<?php echo $this->lang->line('edit'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_edit/'.$value['client_user_id'];?>"><?php echo $this->lang->line('edit'); ?></a>

                                        <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_delete/'.$value['client_user_id'];?>" onclick="return deleteclientUser()" ><?php echo $this->lang->line('delete'); ?></a>
                                          
                                     </td> -->
                                  </tr>

                                  <?php $i++; } }?>  
                                  <input type="hidden" id="counting" name="counting" value="{{$i-1}}">                        
                            
                                </tbody>
                            </table>
                        </div> 
                    </div> 
               </div>
             </div> 
         </div>

  <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/delete_clientuser');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendUserId" id="txtDelete" >
                <input type="hidden" name="client_id" id="clientId" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('clients'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_delete_selected_client_user'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>admin/ClientUserController/excelClientUserList" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendUserId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('are_sure_export_selected_client_user'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>admin/ClientUserController/editClientUser" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendUserId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('are_sure_edit_selected_client_user'); ?> </p>
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

 <div class="modal fade" id="selectOnlyOneClientUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="cliendUserId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('sorry_slect_only_one_client_user'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelOneBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/clientuser" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

 <div class="modal fade" id="selectAtleastOneClientUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="cliendUserId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_client_user'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/clientuser" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

<div class="modal fade" id="importBus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/import_bus');?>" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('import'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><label><?php echo $this->lang->line('select_excel_file'); ?> </label>
                                <div id="file-wrap">
                                <p><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>





<div class="modal fade" id="importClientUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('import'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><label><?php echo $this->lang->line('select_excel_file'); ?> </label>
                                <div id="file-wrap">
                                <p><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript">

   $( document ).ready(function() {
        $('#client_id').select2();

    });

  function deleteclientUser(){
        var result = confirm("Are sure delete this Client User ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var client_user_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this Client User")){
            $.ajax({
                url: '<?php echo site_url("admin/clientuser/status"); ?>',
                type: "POST",
                data: {
                    "client_user_id" : client_user_id
                },
                success: function(response) { 
                    var data = response;
                    console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.client_user_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {

                        $('#change_status_'+data.client_user_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }


    function getClient(client_name)
    {
    //   alert(client_name);die;
       var buildSearchData =     
        
        {            
              "client_name" : client_name,
        };

        table = $('#example').DataTable({ 
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/ClientUserController/getClientUserData"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );
    }

    $(document).ready(function() {
        $('#example').DataTable( {
        });
    });

//select all checkbox
       function checkAllClientUser(ele) {
          $('input[name ="clientuser_id[]"]').each( function() {
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
        var client_id =  $('#client_id').val();
        
        $('#clientId').val(client_id);
        
        // alert(client_id);
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='clientuser_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $('#deleteAllModal').modal('hide');
             $('#selectAtleastOneClientUserModal').modal('show');
        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }
    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="clientuser_id[]"]:checked').each(function() {
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
        $.each($("input[name='clientuser_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
         
            $('#exportModal').modal('hide');
             $('#selectAtleastOneClientUserModal').modal('show');

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
            window.location = "<?php echo site_url('admin/clientuser');?>";
          }, 2000);
      });

  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="clientuser_id[]"]:checked').each(function() {

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
        $.each($("input[name='clientuser_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
            $('#editModal').modal('hide');
            $('#selectAtleastOneClientUserModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
           $('#editModal').modal('hide');
           $('#selectOnlyOneClientUserModal').modal('show');
        }
    }

  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="clientuser_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });

//Confirmation Modal close Funtion
     $("#modelAlteastBus").click(function(){
        $('#selectAtleastOneClientUserModal').modal('hide');
    });

     
//------------------Import (Choose and select)-------------------
$( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
            url:"<?php echo base_url(); ?>admin/import_clientUser",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('clientUser_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('clientUser_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
 
        e.preventDefault();
 
    });
 
});
</script>
