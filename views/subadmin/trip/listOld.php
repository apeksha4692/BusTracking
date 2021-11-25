 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($trip_count->total)){ echo 0; }else{echo $trip_count->total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                              <!-- <a class="btn-outline-warning btn btn-sm" href=""  data-toggle="modal" data-target="#importBus">
                                <?php echo $this->lang->line('import'); ?> 
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a> -->
                              <a class="btn-outline-warning btn btn-sm" href="<?php echo site_url('subadmin/trip_add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                         </div> 
                    </div>


                    <div class="d-flex mb-3">
                        <!-- <button class="text-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                        <form action="<?php echo site_url()?>subadmin/BusController/excelBusList" method="POST">
                          <input type="hidden" name="busId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="text-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('excel'); ?>" />  
                        </form>

                        <form action="<?php echo site_url()?>subadmin/BusController/pdfBusList" method="POST">
                           <input type="hidden" name="busId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="text-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('pdf'); ?>" />  
                        </form> -->
                    </div>      

                    <div class="">
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col"></th>
                                   <th scope="col"><?php echo $this->lang->line('bus_number'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('driver_name'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('chaperone'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('child_name'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('parents_name'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('status'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('trip_date'); ?></th>
                                    <th scope="col"><?= $this->lang->line('trip_start');?></th>
                                    <th scope="col"><?php echo $this->lang->line('trip_end'); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
                                        $i = 1;
                                        if(!empty($getAllStatus)){
                                          foreach ($getAllStatus as $key => $value) { 
                                    ?>

                                  <tr>
                                    <td><?= $i;?></td>
                                    <td><?=$value['bus_number']?></td>
                                    <td><?=$value['driver_name']?></td>
                                    <td><?=$value['chaperone_name']?></td>
                                    <td><?=$value['child_name']?></td>
                                    <td><?=$value['parents_name']?></td>
                                    
                                    <td><button class="btn btn-sm btn-warning">
                                        <?php 
                                        if($value['status'] == 1){
                                          echo "LIVE";
                                        }else{
                                          echo "No Live";
                                        }
                                        
                                        ?>
                                        
                                        </button> 
                                    </td>
                                     <td><?=  date("d/m/Y", strtotime($value['trip_date']));?></td>
                                    <td><?=$value['trip_start']?></td>
                                    <td><?=$value['trip_end']?></td>
                                  </tr>
                                  <?php $i++; } }?>
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
                            <p><?php echo $this->lang->line('are_you_sure_want_delete_bus'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
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
                            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
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

    $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="bus_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });

    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                    {
                        extend: 'pdfHtml5',
                        title: 'Bus List',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                        exportOptions: {                    
                            columns: [1,2,3,4,5]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        title: 'Bus List',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                             columns: [1,2,3,4,5]                
                        },
                     },
                    {
                        extend: 'print',
                        title: 'Bus List',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                             columns: [1,2,3,4,5]                
                        },
                     },

                ],
        });
    });

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
        $('input[name="bus_id[]"]:checked').each(function() {

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
                if(data == 11){
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

</script>