 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($bus_count->bus_total)){ echo 0; }else{echo $bus_count->bus_total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                              <!--<a class="btn-outline-warning btn btn-sm" href=""  data-toggle="modal" data-target="#importBus">-->
                              <!--  <?php echo $this->lang->line('import'); ?> -->
                              <!--  <i class="fa fa-plus ml-1" aria-hidden="true"></i>-->
                              <!--</a>-->
                              <a class="my-btn mr-3" href="<?php echo site_url('subadmin/import_bus_view');?>"> 
                                 <?php echo $this->lang->line('import'); ?>
                                <i class="fa fa-plus ml-2" aria-hidden="true"></i>
                              </a>
                              <a class="my-btn" href="<?php echo site_url('subadmin/bus_add');?>"> 
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

                    <div class="row">
                      <div class="col-sm-12 px-0"> 
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">
                                      <input id="checkbox1" type="checkbox" name="bus[]" class="form-control-custom" onchange="checkAllBus(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('bus_id_number'); ?>
                                        <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"style="display: none;" >
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('bus_plate_number'); ?> 
                                        <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>" >
                                        </span>
                                    </th>
                                      <th scope="col"><?php echo $this->lang->line('modify'); ?>
                                         <span>
                                            <img class="arrowUp"  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>"  style="display: none;">
                                             <img class="arrowDown"  width="18" src="<?php echo base_url().'assest/img/up-arrow.svg';?>">
                                        </span>
                                      </th>
                                    <th scope="col"><?php echo $this->lang->line('note'); ?>
                                    <!--<span><img class=""  width="18" src="<?php echo base_url().'assest/img/down-arrow.svg';?>" ></span>-->
                                    </th>
                                  
                                    <!--<th scope="col"><?php echo $this->lang->line('status'); ?> </th>-->
                                    <!-- <th scope="col"><?php echo $this->lang->line('action'); ?> </th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;

                                    if(!empty($getAllBus)){
                                        foreach ($getAllBus as $key => $value) { 
                                ?>
                                  <tr>
                                    <th scope="row">
                                      <?php
                                        $condition = array(
                                            "bus_id" => $value['id']
                                        );

                                        $driver  = $this->CommonModel->countDataWithCondition('driver',$condition); 
                                    
                                    ?>
                                      <!-- <input type="checkbox" name=""> -->
                                      <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="bus_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                      <label for="<?=$value['id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                     

                                    </th>
                                     <td><?=$value['bus_number']?></td>
                                     <td><?=$value['bus_plate_number']?></td>
                                     
                                     <td>
                                        <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                                     </td>
                                     <td><?=$value['bus_note']?></td>
                                    <!--<td>-->
                                    <!--    <?php if($value['bus_status'] == 1) { ?>-->
                                    <!--        <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>-->
                                    <!--    <?php } else { ?>-->
                                    <!--       <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['id']?>')" onclick="change_status('<?=$value['id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>-->
                                    <!--    <?php }  ?>-->
                                    <!--</td>-->
                                   <!--  <td>
                                       <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/bus_edit/'.$value['id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>
                                      <?php  if($driver == 0) { ?>
                                       <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'subadmin/BusController/delete/'.$value['id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>
                                      <?php  } ?>
                                    </td> -->
                                  </tr>
                                 <?php $i++; } }?>
                                 <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                </tbody>
                            </table>
                        
                    </div> 
                  </div>

                   <!--  <div class="row">
                         <div class="col-sm-12">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination justify-content-center align-items-center">
                                <li class="page-item disabled">
                                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li> 
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#">Next</a>
                                </li> 
                              </ul>
                            </nav>
                         </div> 
                    </div>   --> 
               </div>
             </div> 
         </div>

  <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/delete_bus');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="busId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('bus'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_delete_selected_bus'); ?> </p>
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
            <!--<form method="post" action="<?= base_url() ?>subadmin/BusController/exportCSV" enctype="multipart/form-data" data-parsley-validate>-->
            <form method="post" action="<?= base_url() ?>subadmin/BusController/excelBusList" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="busId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_bus'); ?> </p>
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
            <form method="post" action="<?= base_url() ?>subadmin/BusController/editBus" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_edit_selected_bus'); ?> </p>
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

 <div class="modal fade" id="selectOnlyOneBusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><?php echo $this->lang->line('sorry_slect_only_one_bus'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelOneBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>subadmin/bus" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
                            <!--<button class="my-btn bg-transparent" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>-->
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

 <div class="modal fade" id="selectAtleastOneBusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_bus'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="my-btn bg-transparent" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>subadmin/bus" class="my-btn bg-transparent"><?php echo $this->lang->line('ok'); ?></a>
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




<script type="text/javascript">

  function deleteBus(){
        var result = confirm("Are sure delete this Bus ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var bus_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this Bus")){
            $.ajax({
                url: '<?php echo site_url("subadmin/changeStatus"); ?>',
                type: "POST",
                data: {
                    "bus_id" : bus_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.bus_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {

                        $('#change_status_'+data.bus_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
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
       function checkAllBus(ele) {
          $('input[name ="bus_id[]"]').each( function() {
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
        $.each($("input[name='bus_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
           // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bus'); ?>");
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');
             $('#selectAtleastOneBusModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }


    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="bus_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });


//------------Export Pdf and Excel----------------------------
  function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="bus_id[]"]:checked').each(function() {
           selected_id.push(this.value);
        });

            $('.textIddss').val(selected_id);
    }

    // $('form').submit(function () {
    //     var name = $('.textIddss').val();
    //     if (name === '') {
    //         $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
    //         return false;
    //     }else{
    //        $('#errmsg').html('');
    //     }
    // });

//------------------Import (Choose and select)-------------------
$( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
            url:"<?php echo base_url(); ?>subadmin/import_bus",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('bus_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('bus_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
 
        e.preventDefault();
 
    });
 
});

// $(document).on('submit', 'form', function() {
//   setTimeout(function() {
//     window.location = "/bus_tracking/subadmin/bus";
//   }, 1000);
// });

//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='bus_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
           // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#exportModal').modal('hide');
             $('#selectAtleastOneBusModal').modal('show');

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
            // window.location = "/bus_tracking/subadmin/bus";
            window.location = "<?php echo site_url('subadmin/bus');?>";
          }, 2000);
      });

  });


  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="bus_id[]"]:checked').each(function() {

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
        $.each($("input[name='bus_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
          // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#editModal').modal('hide');
            $('#selectAtleastOneBusModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneBusModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }


  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="bus_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });

//Confirmation Modal close Funtion
     $("#modelAlteastBus").click(function(){
        $('#selectAtleastOneBusModal').modal('hide');
    });


     $("#modelOneBus").click(function(){
        $('#selectOnlyOneBusModal').modal('hide');
    });

</script>