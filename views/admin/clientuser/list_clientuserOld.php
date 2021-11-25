  <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                <div class="d-flex">
                    <label class="mt-2"><?php echo $this->lang->line('client_name'); ?></label>
                    <div class="col-sm-3">
                      <!-- <select class="form-control">
                          <option>The International School</option>
                          <option>The New School</option>
                      </select> -->

                      <select class="form-control" data-live-search="true" name="client_id" id="client_id" onchange="getClient(this.value);">
                            <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                            <option data-tokens="0" value="0"><?php echo $this->lang->line('all_client'); ?> </option>
                             <?php foreach ($getAllClient as $key) { ?>
                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['client_name']; ?></option>

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
                              <a class="btn-outline-warning btn btn-sm" href=""  data-toggle="modal" data-target="#importClientUser">
                                <?php echo $this->lang->line('import'); ?> 
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                              <a class="btn-outline-warning btn btn-sm" href="<?php echo site_url('admin/clientuser_add');?>">
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                         </div> 
                    </div>

                    <div class="d-flex mb-3">
                      <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                         <form action="<?php echo site_url()?>admin/ClientUserController/excelClientUserList" method="POST">
                          <input type="hidden" name="cliendId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('excel'); ?>" />  
                        </form>

                        <form action="<?php echo site_url()?>admin/ClientUserController/pdfClientUserList" method="POST">
                           <input type="hidden" name="cliendId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('pdf'); ?>" />  
                        </form>

                        <!-- <a class="text-warning mr-3" href="<?php echo site_url('admin/clientuser');?>"> <?php echo $this->lang->line('refresh'); ?></a> -->
                        <!-- <a class="text-warning mr-3" href="">Edit</a> -->
                        <!-- <a class="text-warning mr-3" href="">Export</a> -->
                    </div>      

                    <div class="">
                        
                            <table class="table table-borderless border-top border-bottom"  id="example">
                                <thead>
                                  <tr>
                                     <th scope="col"></th>
                                    <th scope="col"><?php echo $this->lang->line('client_name'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('client_user_name'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('client_email_id'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('client_mobile_number'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('login_user_name'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('login_password'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('last_login_date'); ?></th>

                                    <th scope="col"><?php echo $this->lang->line('status'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('action'); ?></th>
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
                                     <td>
                                        <?php if($value['status'] == 1) { ?>
                                            <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['client_user_id']?>')" onclick="change_status('<?=$value['client_user_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                        <?php } else { ?>
                                           <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['client_user_id']?>')" onclick="change_status('<?=$value['client_user_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                        <?php }  ?>

                                     </td>
                                     <td>
                                       <a  title="<?php echo $this->lang->line('view'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_view/'.$value['client_user_id'];?>"><?php echo $this->lang->line('view'); ?></a>

                                        <a  title="<?php echo $this->lang->line('edit'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_edit/'.$value['client_user_id'];?>"><?php echo $this->lang->line('edit'); ?></a>

                                        <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/clientuser_delete/'.$value['client_user_id'];?>" onclick="return deleteclientUser()" ><?php echo $this->lang->line('delete'); ?></a>
                                          
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
            <form method="post" action="<?php echo site_url('admin/delete_clientuser');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="cliendUserId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('clients'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_you_sure_want_delete_client'); ?> </p>
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


    function getClient(client_id)
    {
      // alert(client_id);die;

       var buildSearchData =     
        
        {            
              "client_id" : client_id,
        };

        table = $('#example').DataTable({ 
            "dom"           : 'Bfrtip',
            "buttons"       : [
                                {
                                    'extend': 'pdfHtml5',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                    'exportOptions': {                    
                                        'columns':  [0,1,2,3,4,5,6,7,8]                        
                                    },
                 
                                },
                                // 'excel',
                                {
                                    'extend': 'excel',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                     'exportOptions': {                    
                                        'columns': [0,1,2,3,4,5,6,7,8]               
                                    },
                                 },
                                 // 'print',
                                {
                                    'extend': 'print',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                     'exportOptions': {                    
                                        'columns':[0,1,2,3,4,5,6,7,8]                
                                    },
                                 },
                            ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/ClientUserController/getClientUserData"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );

    }

    $(document).ready(function() {
        //   var table = $('#example').DataTable( {
        //     // scrollY:        "300px",
        //     // scrollX:        true,
        //     scrollCollapse: true,
        //     paging:         false,
        //     fixedColumns:   true
        // } );
     
        // new $.fn.dataTable.FixedColumns( table );
        $('#example').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //             {
        //                 extend: 'pdfHtml5',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                 exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
     
        //             },
        //             {
        //                 extend: 'excel',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                  exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
        //              },
        //             {
        //                 extend: 'print',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                  exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
        //              },

        //         ],
        });
    });

      $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="clientuser_id[]"]:checked').each(function() {

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
        $.each($("input[name='clientuser_id[]']:checked"), function(){            
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
//------------------Export PDF and Excel-------------------
    function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="clientuser_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });

        // alert(selected_id);
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
