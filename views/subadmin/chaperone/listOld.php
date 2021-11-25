 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($chaperone_count->chaperone_total)){ echo 0; }else{echo $chaperone_count->chaperone_total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                              <a class="btn-outline-warning btn btn-sm" href=""  data-toggle="modal" data-target="#importChaperone">
                                <?php echo $this->lang->line('import'); ?> 
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                              <a class="btn-outline-warning btn btn-sm" href="<?php echo site_url('subadmin/chaperone_add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                         </div> 
                    </div>

                    <div class="d-flex mb-3">
                       <!-- <a class="text-warning mr-3" href=""><?php echo $this->lang->line('delete'); ?></a> -->
                        <!-- <button class="text-warning mr-3" id="btnDelete" data-toggle="modal" data-target="#deleteAllModal"> -->
                        <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                         <form action="<?php echo site_url()?>subadmin/ChaperoneController/excelChaperoneList" method="POST">
                          <input type="hidden" name="chaperoneId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('excel'); ?>" />  
                        </form>

                        <form action="<?php echo site_url()?>subadmin/ChaperoneController/pdfChaperoneList" method="POST">
                           <input type="hidden" name="chaperoneId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('pdf'); ?>" />  
                        </form>
                        <!-- <a class="text-warning mr-3" href=""><?php echo $this->lang->line('edit'); ?></a> -->
                        <!-- <a class="text-warning mr-3" href=""><?php echo $this->lang->line('emport'); ?></a> -->
                    </div>      

                    <div class="">
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><?php echo $this->lang->line('chaperone_name'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('chaperone_number'); ?> </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('assigned_bus'); ?> </th>-->
                                    <th scope="col"><?php echo $this->lang->line('note'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('secret_code'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('modify'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('status'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('action'); ?> </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;

                                    if(!empty($getAllChaperone)){
                                        foreach ($getAllChaperone as $key => $value) { 
                                ?>
                                  <tr>
                                    <th scope="row">
                                      <!-- <input type="checkbox" name=""> -->
                                      <input id="<?=$value['chaperone_id']?>" type="checkbox" value="<?=$value['chaperone_id']?>" name="chaperone_id[]" class="form-control-custom"  data-id ="<?=$value['chaperone_id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                      <label for="<?=$value['chaperone_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </th>
                                     <td><?=$value['chaperone_name']?></td>
                                     <td><?=$value['chaperone_unique_id']?></td>
                                     <!--<td><?=$value['bus_unique_id']?></td>-->
                                     <td><?=$value['note']?></td>
                                     <td><?=$value['secret_code']?></td>
                                     <td>
                                        <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                                     </td>
                                    <td>
                                        <?php if($value['chaperone_status'] == 1) { ?>
                                            <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                        <?php } else { ?>
                                           <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                        <?php }  ?>
                                    </td>
                                    <td>
                                       <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/chaperone_edit/'.$value['chaperone_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>

                                       <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'subadmin/ChaperoneController/delete/'.$value['chaperone_id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>
                                    </td>
                                  </tr>
                                 <?php $i++; } }?>
                                 <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                </tbody>
                            </table>
                        
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
            <form method="post" action="<?php echo site_url('subadmin/delete_chaperone');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="chaperoneId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('bus'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_chaperone');?></p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="importChaperone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/import_chaperone');?>" enctype="multipart/form-data" data-parsley-validate  id="my-form">
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
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_chaperone');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var chaperone_id = id;
            // alert(user_id);
        if(confirm("<?= $this->lang->line('are_you_sure_want');?> "+value+" <?= $this->lang->line('this_chaperone');?>")){
            $.ajax({
                url: '<?php echo site_url("subadmin/chaperone/changeStatus"); ?>',
                type: "POST",
                data: {
                    "chaperone_id" : chaperone_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.chaperone_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                      $('#change_status_'+data.chaperone_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }

    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="chaperone_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });

    $(document).ready(function() {
        // var table = $('#example').DataTable( {
        //     // scrollY:        "300px",
        //     // scrollX:        true,
        //     scrollCollapse: true,
        //     paging:         false,
        //     fixedColumns:   true
        // } );
        $('#example').DataTable( {
            // dom: 'Bfrtip',
            // buttons: [
            //         {
            //             extend: 'pdfHtml5',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //             exportOptions: {                    
            //                 columns: [1,2,3,4,5,6]                
            //             },
     
            //         },
            //         {
            //             extend: 'excel',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //              exportOptions: {                    
            //                  columns: [1,2,3,4,5,6]                
            //             },
            //          },
            //         {
            //             extend: 'print',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //              exportOptions: {                    
            //                  columns: [1,2,3,4,5,6]                
            //             },
            //          },

            //     ],
        });
    });

     function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='chaperone_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
          $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }

//------------Export Pdf and Excel----------------------------
  function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="chaperone_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });

            $('.textIddss').val(selected_id);       
    }

    $('form').submit(function () {
        var name = $('.textIddss').val();
        if (name === '') {
            $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            return false;
        }else{
           $('#errmsg').html('');
        }
    });

//------------------Import (Choose and select)-------------------   

  $( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
        // $("#result").html('<img src="http://qass.im/drag-and-drop-upload-on-submit/ajax-loader.GIF">'); // display image loader in #result element
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
            url:"<?php echo base_url(); ?>subadmin/import_chaperone",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('chaperone_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('chaperone_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
        e.preventDefault();
 
    });
 
});


</script>