<?php $checked_arr = explode(",",$getAdminData->role);?>

 <div class="col-sm-12">

             <div class="border p-3 bg-white">

               <div class="">

                    <div class="d-flex">

                        <div class="mr-auto">

                            <h4><?php echo $this->lang->line('clients'); ?> (<?php echo $client_count->client_total?>)</h4>

                         </div>

                         <div class="ml-auto">
                            <?php if(in_array("5", $checked_arr)) {?>
                              <a class="my-btn mr-3" href="<?php echo site_url('admin/import_client_view');?>"> 
                                 <?php echo $this->lang->line('import'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                            <?php } if(in_array("6", $checked_arr)) {?>
                              <a class="my-btn" href="<?php echo site_url('admin/client/add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                             <?php }?>
                         </div> 

                    </div>

                    <div class="d-flex mb-3">
                        <?php if(in_array("2", $checked_arr)) {?>
                            <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()" >
                                   <?php echo $this->lang->line('delete'); ?>
                            </button> 
                        <?php } if(in_array("3", $checked_arr)) {?>

                            <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                                   <?php echo $this->lang->line('edit'); ?>
                            </button>
                        <?php } if(in_array("4", $checked_arr)) {?>
                            <button class="p-0 btn-sm text-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                                   <?php echo $this->lang->line('export'); ?>
                            </button> 
                        <?php } ?>
                    </div>      
   

                    <div class="row"> 
                    <div class="col-sm-12 px-0">                     

                            <table class="table table-borderless border-top border-bottom" id="example">

                                <thead>

                                  <tr>

                                    <th scope="col">
                                       <input id="checkbox1" type="checkbox" name="client[]" class="form-control-custom" onchange="checkAllClient(this)">
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('client_name'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('focal_point_name'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('focal_point_number'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('focal_point_email'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('logo'); ?>
                                        <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('max_chaperone_user'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>

                                    <th scope="col"><?php echo $this->lang->line('max_portal_user'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                <?php if(in_array("7", $checked_arr)) {?>
                                    <th scope="col"><?php echo $this->lang->line('status'); ?>
                                       <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                <?php }?>

                                   <!--  <th scope="col"><?php echo $this->lang->line('action'); ?></th> -->

                                  </tr>

                                </thead>

                                <tbody>

                                  <?php

                                    $i = 1;

                                    if(!empty($getAllClient)){

                                        foreach ($getAllClient as $key => $value) { 

                                  ?>



                                  <tr>

                                    <th scope="row">
                                      <?php

                                        $condition = array(

                                            "client_id" => $value['id']

                                        );

                                        $client_user  = $this->CommonModel->countDataWithCondition('client_user',$condition); 
                                    ?>

                                      <!-- <input type="checkbox" name=""> -->

                                      <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="client_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">

                                      <label for="<?=$value['id']?>"></label><br>

                                      <span id="errmsg" style="color: red;"></span>

                                

                                    </th>

                                     <td><?=$value['client_name']?></td>

                                     <td><?=$value['focal_point_name']?></td>

                                     <td><?=$value['focal_point_number']?></td>

                                     <td><?=$value['focal_point_email']?></td>

                                     <td>

                                        <?php if(!empty($value['logo_image'])){?>

                                             <img widhth="50px" height="50px" src="<?php echo CLIENT_IMG.$value['logo_image'];?>">

                                        <?php }else{ echo "No Logo";}?>  

                                     </td>

                                     <td><?=$value['max_chaperone']?></td>

                                     <td><?=$value['max_parent']?></td>
                                <?php if(in_array("7", $checked_arr)) {?>
                                     <td>

                                        <?php if($value['status'] == 1) { ?>

                                            <button title="<?php echo $this->lang->line('change_staus')?> " class="my-btn" value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>

                                        <?php } else { ?>

                                           <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>

                                        <?php }  ?>



                                     </td>
                                <?php }?>

                                    <!--  <td>
                                       <a  title="<?php echo $this->lang->line('view'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/client/view/'.$value['id'];?>"><?php echo $this->lang->line('view'); ?></a>

                                        <a  title="<?php echo $this->lang->line('edit'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/client/edit/'.$value['id'];?>"><?php echo $this->lang->line('edit'); ?></a>

                                        <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/client/delete/'.$value['id'];?>" onclick="return deleteclient()" ><?php echo $this->lang->line('delete'); ?></a>

                                          

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
            <form method="post" action="<?php echo site_url('admin/delete_client');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('clients'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_delete_selected_client'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>admin/ClientController/excelClientList" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('are_sure_export_selected_client'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>admin/ClientController/editClient" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('are_sure_edit_selected_client'); ?> </p>
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
                            <p><?php echo $this->lang->line('sorry_slect_only_one_client'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelOneBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/client" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

 <div class="modal fade" id="selectAtleastOneClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_client'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/client" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
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



<div class="modal fade" id="importClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

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

                            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('upload'); ?> </button>

                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

</div>

   

   

<script type="text/javascript">

  function change_status(id,value)
  {
      var client_id = id;
      if(confirm("Are you sure want "+value+" this Client")){

          $.ajax({
              url: '<?php echo site_url("admin/client/status"); ?>',
              type: "POST",
              data: {
                  "client_id" : client_id
              },

              success: function(response) { 

                  var data = response;
                  // console.log(data);
                  if(data.status == 1)
                  {
                      $('#change_status_'+data.client_id).removeClass("btn-info").addClass('btn-success').text('Active')
                  }
                  else 
                  {
                    $('#change_status_'+data.client_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                  }
                  location.reload();
              }
          });
      }
  }

    $(document).ready(function() {
        $('#example').DataTable( {
        });
    });

//select all checkbox
       function checkAllClient(ele) {
          $('input[name ="client_id[]"]').each( function() {
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
        $.each($("input[name='client_id[]']:checked"), function(){            
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
      $('input[name="client_id[]"]:checked').each(function() {
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
        $.each($("input[name='client_id[]']:checked"), function(){            
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
            window.location = "<?php echo site_url('admin/client');?>";
          }, 2000);
      });

  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="client_id[]"]:checked').each(function() {

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
        $.each($("input[name='client_id[]']:checked"), function(){            
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
      $('input[name="client_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });

//Confirmation Modal close Funtion
     $("#modelAlteastBus").click(function(){
        $('#selectAtleastOneClientModal').modal('hide');
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
          url:"<?php echo base_url(); ?>admin/import_client",
          method:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          success:function(data)
          {
             $("#file-wrap p").html('Drag and drop file here'); // change wrap message

              if(data == 1){

                  toastr.success("<?= $this->lang->line('client_add_successfully')?>");

              }else{
                  toastr.error("<?= $this->lang->line('client_not_add_successfully')?>");
              }
              location.reload();
          }
      })
      e.preventDefault();
  });
});

</script>

