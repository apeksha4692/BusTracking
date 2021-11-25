<?php $checked_arr = explode(",",$getAdminData->role);?>
 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                             <h4><?php echo $this->lang->line('app'); ?> (<?php echo $app_related_count->total?>)</h4>
                         </div>
                         <div class="ml-auto">
                             
                              <a class="my-btn" href="<?php echo site_url('admin/app_add');?>">
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
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
                                        <input id="checkbox1" type="checkbox" name="app[]" class="form-control-custom" onchange="checkAllApp(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('app_version'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('release_date'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('android_ready'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('ios_ready'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('note'); ?>
                                         <span>
                                          <img class="arrowUp" height="49" width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                          <img class="arrowDown" height="49" width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('status'); ?></th>-->
                                    <!--<th scope="col"><?php echo $this->lang->line('action'); ?></th>-->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;
                                    if(!empty($getAllApp)){
                                        foreach ($getAllApp as $key => $value) {
                                  ?>

                                  <tr>
                                    <th scope="row">
                                     <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="app_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                      <label for="<?=$value['id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </th>
                                     <td><?=$value['app_version']?></td>
                                     <td><?=$value['release_date']?></td>
                                     <td><?=$value['android_ready']?></td>
                                     <td><?=$value['ios_ready']?></td>
                                     <td><?=$value['notes']?></td>
                                     <!--<td>-->
                                     <!--   <?php if($value['app_status'] == 1) { ?>-->
                                     <!--       <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>-->
                                     <!--   <?php } else { ?>-->
                                     <!--      <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>-->
                                     <!--   <?php }  ?>-->

                                     <!--</td>-->
                                     <!--<td>                                       -->
                                     <!--   <a  title="<?php echo $this->lang->line('edit'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/app_edit/'.$value['id'];?>"><?php echo $this->lang->line('edit'); ?></a>-->
                                     <!--   <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/app_delete/'.$value['id'];?>" onclick="return deleteAppVersion()" ><?php echo $this->lang->line('delete'); ?></a>-->
                                          
                                     <!--</td>-->
                                  </tr>
                                  <?php $i++; } }?>                          
                                  <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                  
                                </tbody>
                            </table>
                    </div> 
               </div>
             </div> 
         </div>
         
         
  <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('admin/AppController/delete_app');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="appId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure that you want to delete selected app(s)? </p>
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
            <form method="post" action="<?= base_url() ?>admin/AppController/excelAppist" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="appId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure want to export selected app(s)? </p>
                        <!-- </div> -->
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
            <form method="post" action="<?= base_url() ?>admin/AppController/editAppId" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="appId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Are you sure want to edit selected App Detail?</p>
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

 <div class="modal fade" id="selectOnlyOneAppModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Sorry, you can’t edit multiple app at once. Please select one app only </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelOneBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>admin/app_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

 <div class="modal fade" id="selectAtleastOneAppModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p>Sorry, you need select at least one app </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>admin/app_list" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>




<script type="text/javascript">

  function deleteAppVersion(){
        var result = confirm("<?php echo $this->lang->line('are_sure_delete'); ?> <?php echo $this->lang->line('this_app_version'); ?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var app_id = id;
            // alert(user_id);
        if(confirm("<?php echo $this->lang->line('are_sure_delete'); ?> "+value+"  <?php echo $this->lang->line('this_app_version'); ?>")){
            $.ajax({
                url: '<?php echo site_url("admin/app_status"); ?>',
                type: "POST",
                data: {
                    "app_id" : app_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.app_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {

                        $('#change_status_'+data.app_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }
    
    //Delete Button Function
  function checkAllApp(ele) {
    $('input[name ="app_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="app_id[]"]:checked').each(function() {

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
        $.each($("input[name='app_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $('#deleteAllModal').modal('hide');
            $('#selectAtleastOneAppModal').modal('show');

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
        $.each($("input[name='app_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
            $('#editModal').modal('hide');
            $('#selectAtleastOneChaperoneModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneAppModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }
  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="app_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });

//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='app_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
            $('#exportModal').modal('hide');
             $('#selectAtleastOneAppModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#exportModal').modal('show');
        }
    }
  $(document).ready(function(){
      $("#submitExcel").click(function(){        
          setTimeout(function() {
            window.location = "<?php echo site_url('admin/app_list');?>";
          }, 2000);
      });

  });

  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="app_id[]"]:checked').each(function() {
         selected_id.push(this.value);
      });
      $('#txtExport').val(selected_id);
    });

    // $("#btnDelete").click(function(){
    //   var selected_id = new Array();
    //   $('input[name="bus_id[]"]:checked').each(function() {

    //      selected_id.push(this.value);

    //   });
    //   // alert(selected_id);

    //   $('#txtDelete').val(selected_id);
    // });

    // $(document).ready(function() {
    //     $('#example').DataTable({
    //     });
    // });

    //  function checkValue()
    // {
    //     // alert('h');
    //     var selected_id = new Array();
    //     var counting = $('#counting').val();
    //     // for(var i=0 ; i<counting)
    //     $.each($("input[name='bus_id[]']:checked"), function(){            
    //         selected_id.push($(this).val());
    //     });
    //     if(selected_id.length == 0)
    //     {
    //       $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
    //         // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
    //         $('#deleteAllModal').modal('hide');

    //     }else
    //     {
    //       $('#errmsg').html('');
    //         $('#deleteAllModal').modal('show');
    //     }
    // }

//------------Export Pdf and Excel----------------------------
//   function checkBox()
//     {
//         // alert('hi');
//         var selected_id = new Array();
//         $('input[name="bus_id[]"]:checked').each(function() {

//           selected_id.push(this.value);

//         });

//             $('.textIddss').val(selected_id);
        
       
//     }

//     $('form').submit(function () {
//         var name = $('.textIddss').val();
//         if (name === '') {
//             $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
//             return false;
//         }else{
//           $('#errmsg').html('');
//         }
//     });

// //------------------Import (Choose and select)-------------------
// $( function() {
 
//     $("#my-file").on('change', function (e) { // if file input value
//         $("#file-wrap p").html('Now click on Upload button'); // change wrap message
//     });
 
//     $("#my-form").on('submit', function (e) { // if submit form
 
//         var eventType = $(this).attr("method"); // get method type for #my-form
 
//         var eventLink = $(this).attr("action"); // get action link for #my-form
        
//         $.ajax({
//             url:"<?php echo base_url(); ?>subadmin/import_bus",
//             method:"POST",
//             data:new FormData(this),
//             contentType:false,
//             cache:false,
//             processData:false,

//             success:function(data)
//             {
//                 $("#file-wrap p").html('Drag and drop file here'); // change wrap message
//                 if(data == 11){
//                     toastr.success("<?= $this->lang->line('bus_add_successfully')?>");
//                 }else{

//                     toastr.error("<?= $this->lang->line('bus_not_add_successfully')?>");
//                 }
                
//                 location.reload();
//             }
//         })
 
//         e.preventDefault();
 
//     });
 
// });

</script>