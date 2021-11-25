<style type="text/css">
	
	.client-portal table {
    text-align: left !important;
}
.add-table .table td, .table th {
    padding: 5px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.f-0 .form-group {
     margin-bottom: 0px; 
}
.f-0 .form-group {
    margin-bottom: 0px;
    display: flex;
    justify-content: space-between;
}
.f-0 .table th{
  font-weight: bold;
}
.d-b .table tr label:first-child {
   display: flex !important;
    justify-content: space-between !important;
}
.d-b .table tr label{
  margin-bottom: 0px !important;
}

/*
.fancy-chack .form-group {
  display: block;
  margin-bottom: 1px;
}

.fancy-chack .form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.fancy-chack .form-group label {
  position: relative;
  cursor: pointer;
}

.fancy-chack .form-group label:before {
    content: '';
    -webkit-appearance: none;
    background-color: transparent;
    border: 1px solid #ff8800;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
    padding: 5px;
    display: inline-block;
    position: relative;
    vertical-align: middle;
    cursor: pointer;
    margin-right: 5px;
}

.fancy-chack .form-group input:checked + label:after {
    content: '';
    display: block;
    position: absolute;
    top: -1px;
    left: 5px;
    width: 6px;
    height: 14px;
    border: solid #f8ab35;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}*/
</style>
<div class="col-sm-12">

    <div class="border p-3 bg-white">

        <div class="chaperone-add">

            <div class="d-flex mb-4">

                <div class="mr-auto">

                    <h4><? echo $title;?></h4>

                 </div>

                 <div class="ml-auto">

                    <a class="text-dark" href="<?php echo site_url('admin/admin_portal_user/user_list');?>"><i class="fa fa-times" aria-hidden="true"></i></a>

                 </div> 

            </div>

            <form action="<?php echo site_url('admin/AdminPortalUser/insertAdminPortal');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">

                <div class="row">

                    <div class="col-sm-4">

                        <div class="form-group">

                            <div class="row align-items-center">

                                <label class="col-sm-3">

                                   First Name

                                </label>

                                <div class="col-sm-8">

                                     <input class="form-control" type="text" placeholder="First Name" name="f_name" required data-parsley-required data-parsley-required-message="Enter First Name" >

                                </div>

                            </div>  

                        </div>

                        <div class="form-group">

                            <div class="row align-items-center">

                                 <label class="col-sm-3">

                                     Family Name

                                 </label>

                                 <div class="col-sm-8">

                                     <input class="form-control" type="text" placeholder="Family Name" name="l_name" >

                                 </div>

                            </div>  

                         </div>

                         

                         <div class="form-group">

                            <div class="row align-items-center">

                                 <label class="col-sm-3">

                                     Email

                                 </label>

                                 <div class="col-sm-8">

                                     <input class="form-control" type="text" placeholder="Email" name="email" required data-parsley-required data-parsley-required-message="Enter Email-Id" id="email" onblur="check_adminPortalEmail(this.value)" type="email" data-parsley-type="email">
                                     <span id="errmsg_emailAdminPortal" style="color: red"></span>
                                     

                                 </div>

                            </div>  

                         </div>

                         

                        <div class="form-group">

                            <div class="row ">

                                 <label class="col-sm-3 align-items-center">Password</label>

                                 <div class="col-sm-5 align-items-center">

                                     <input class="form-control" id="password" type="text" placeholder="Password" name="password" required data-parsley-required data-parsley-required-message="Enter Password">

                                 </div>

                                 <!-- <a class="btn-outline-warning btn btn-sm">Regene</a> -->

                                    <input type="button" class="my-btn bg-transparent" value="Generate" onClick="randomPassword(8);">
                            </div>  
                         </div>
                         
                        
                         <div class="form-group">

                            <div class="row align-items-center">

                                 <label class="col-sm-3">

                                     Note

                                 </label>

                                 <div class="col-sm-8">

                                     <input class="form-control" type="text" placeholder="Note" name="note" >

                                 </div>

                            </div
                             </div>
                             </div> 
                            <!--</div>-->
                            
                            
                    </div>
   <div class="col-sm-8">
 <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="well" >
     <div class="table-responsive add-table f-0 d-b" style="border: 1px solid #ccc;">
    <table class="table fancy-chack" style="overflow-x:auto;" width="100%">
      <thead>
        <tr>
          <th width="20%">Table</th>
          <th width="15%">Sub table</th>
          <th>Function</th>
         
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding-right: 17px;"> <div class="form-group">
            <label for="html">Client</label>
      <input type="checkbox" id="html" value="1" name="client[]" required data-parsley-required data-parsley-required-message="Please check atleast one function">
      
       </div></td>
          <td>  <div class="form-group">
      <!--<input type="checkbox" id="html" >-->
      <!--<label for="html">HTML fksdfkfj</label>-->
       </div>
       </td>
            <td>    <div class="form-group">
                <label for="html"> Delete</label>
      <input type="checkbox" id="html" value="2" name="client[]">
    

       </div>
       </td>
         <td>  <div class="form-group">
             <label for="html">Edit</label>
   
      <input type="checkbox" id="html" value="3" name="client[]">
       </div>
       </td>
            
          <td>  <div class="form-group">
             <label for="html">Export</label>
     
      <input type="checkbox" id="html" value="4" name="client[]">
       </div>
       </td>
       <td>  <div class="form-group">
         <label for="html">Import</label>
    
      <input type="checkbox" id="html" value="5 name="client[]">
        </div>
       </td>
            <td>  <div class="form-group">
                  <label for="html">Add New</label>
      <input type="checkbox" id="html" value="6" name="client[]">
       </div>
       </td>
       
       <td>  <div class="form-group">
          <label for="html">Active/Not Active</label>
   
      <input type="checkbox" id="html" value="7" name="client[]">
        </div>
       </td>
       
        </tr>
         <tr>
          <td style="padding-right: 17px;">  <div class="form-group">
            <label for="html">Client Portal User</label>
      <input type="checkbox" id="html" value="8" name="client[]">
   </td>
          <td> 
       </div>
       </td>
            <td>  <div class="form-group">
                <label for="html">Delete</label>
   
      <input type="checkbox" id="html" value="9" name="client[]">
        </div>
       </td>
         <td>  <div class="form-group">
           <label for="html">Edit</label>
     
      <input type="checkbox" id="html" value="10" name="client[]">
       </div>
       </td>
            <td>  <div class="form-group">
                 <label for="html">Export</label>
   
      <input type="checkbox" id="html" value="11" name="client[]">
       </div>
       </td>
          <td>  <div class="form-group">
               <label for="html">Import</label>
   
      <input type="checkbox" id="html" value="12" name="client[]">
       </div>
       </td>
            <td>  <div class="form-group">
                <label for="html">Add New</label>
    
      <input type="checkbox" id="html" value="13" name="client[]">
       </div>
       </td>
       
        <td>  <div class="form-group">
           <label for="html">Active/Not Active</label>
     
      <input type="checkbox" id="html" value="14" name="client[]">
       </div>
       </td>
        </tr>
        <tr>
          <td style="padding-right: 17px;">
          	 <div class="form-group">
               <label for="html">REPORTING</label>
     
      <input type="checkbox" id="html" value="15" name="client[]" class="reporting">
       </div>
</td>
        <td style="padding-right: 27px;padding-left: 13px;">	 <div class="form-group">
            <label for="html">MAP</label>
    
      <input type="checkbox" id="html" value="16" name="client[]" class="reporting">
       </div>
        
       </td>
       <td colspan="9"> 
         <span id="errmsg_reporting" style="color: red"></span>
        </td>
          
        </tr>
        <tr>
        	<td style="border-top: 0;"> </td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: none;"> <div class="form-group">
               <label for="html">Trip</label>
   
      <input type="checkbox" id="html" value="17" name="client[]" class="reporting">
       </div> </td>
       <td colspan="10" style="border-top: 0;"></td>


          
         <!--  <td>
              <a href="user.html"><i class="icon-pencil"></i></a>
              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
          </td> -->
        </tr>
      
        <tr>
          <td style="border-top: 0;"> </td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;"><div class="form-group">
              <label for="html">Driver</label>
    
      <input type="checkbox" id="html" value="18" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"><div class="form-group">
               <label for="html">Delete</label>
   
      <input type="checkbox" id="html" value="19" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"><div class="form-group">
              <label for="html">Edit</label>
    
      <input type="checkbox" id="html" value="20" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;">
             <div class="form-group">
               <label for="html">Export</label>
     
      <input type="checkbox" id="html" value="21" name="client[]" class="reporting">
       </div>
          </td>
           <td style="border-top: 0;">
             <div class="form-group">
               <label for="html">Import</label>
     
      <input type="checkbox" id="html" value="22" name="client[]" class="reporting">
       </div>
          </td>
           <td style="border-top: 0;">
             <div class="form-group">
                <label for="html">Add New</label>
     
      <input type="checkbox" id="html" value="23" name="client[]" class="reporting">
      </div>
          </td>
        </tr>
        <tr>
          <td style="border-top: 0;"></td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;"> <div class="form-group">
             <label for="html">Bus</label>
    
      <input type="checkbox" id="html" value="24" name="client[]" class="reporting">
        </div></td>
          <td style="border-top: 0;"> <div class="form-group">
             <label for="html">Delete</label>
     
      <input type="checkbox" id="html" value="25" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
              <label for="html">Edit</label>
    
      <input type="checkbox" id="html" value="26" name="client[]" class="reporting">
       </div></td>
        <td style="border-top: 0;"> <div class="form-group">
            <label for="html">Export</label>
    
      <input type="checkbox" id="html" value="27" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
             <label for="html">Import</label>
     
      <input type="checkbox" id="html" value="28" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
             <label for="html">Add New</label>
     
      <input type="checkbox" id="html" value="29" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;">
              <a href="user.html"><i class="icon-pencil"></i></a>
              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
          </td>
        </tr>
        <tr>
          <td style="border-top: 0;"></td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;"> <div class="form-group">
             <label for="html">Chaperone</label>
    
      <input type="checkbox" id="html" value="30" name="client[]" class="reporting">
        </div></td>
          <td style="border-top: 0;"> <div class="form-group">
             <label for="html">Delete</label>
     
      <input type="checkbox" id="html" value="31" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
             <label for="html">Edit</label>
    
      <input type="checkbox" id="html" value="32" name="client[]" class="reporting">
        </div></td>
        <td style="border-top: 0;"> <div class="form-group">
            <label for="html">Export</label>
    
      <input type="checkbox" id="html" value="33" name="client[]"class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
               <label for="html">Import</label>
   
      <input type="checkbox" id="html" value="34" name="client[]"class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
              <label for="html">Add New</label>
    
      <input type="checkbox" id="html" value="35" name="client[]"class="reporting">
       </div></td>
          <td style="border-top: 0;">
              <a href="user.html"><i class="icon-pencil"></i></a>
              <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
          </td>
        </tr>
        <tr>
          <td style="border-top: 0;"></td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;"> <div class="form-group">
              <label for="html">Parents</label>
    
      <input type="checkbox" id="html" value="36" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
              <label for="html">Delete</label>
    
      <input type="checkbox" id="html" value="37" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
              <label for="html">Edit</label>
   
      <input type="checkbox" id="html" value="38" name="client[]" class="reporting">
        </div></td>
        <td style="border-top: 0;"> <div class="form-group">
           <label for="html">Export</label>
     
      <input type="checkbox" id="html" value="39" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;"> <div class="form-group">
            <label for="html">Import</label>
     
      <input type="checkbox" id="html" value="40" name="client[]" class="reporting">
        </div></td>
          <td style="border-top: 0;"> <div class="form-group">
              <label for="html">Add New</label>
    
      <input type="checkbox" id="html" value="41" name="client[]" class="reporting">
       </div></td>
          <td style="border-top: 0;">   </td>
        </tr>
        <tr>
          <td style="border-top: 0;"></td>
          <td style="padding-right: 27px;padding-left: 13px; border-top: 0;"> <div class="form-group">
              <label for="html">Analityic</label>
    
      <input type="checkbox" id="html" value="42" name="client[]" class="reporting">
       </div></td>
          <td colspan="19" style="border-top: 0;"> </td>
         
        </tr>
        <tr>
          <td style="padding-right: 17px;"> <div class="form-group">
             <label for="html">Notification</label>
     
      <input type="checkbox" id="html" value="43" name="client[]">
       </div></td>
       <td colspan="19"></td>
   </tr> <tr>
          <td style="padding-right: 17px;"> <div class="form-group">
              <label for="html">App</label>
    
      <input type="checkbox" id="html" value="44" name="client[]">
       </div></td>
        <td colspan="19"></td>
        </tr> <tr>
            <td style="padding-right: 17px;"> <div class="form-group">
               <label for="html">Admin Portal Users</label>
     
      <input type="checkbox" id="html" value="45" name="client[]">
       </div>
        <td colspan="19"></td>

     </td> </tr> <tr>
          <td style="padding-right: 17px;"> <div class="form-group">
             <label for="html">Client Portal Content</label>
    
      <input type="checkbox" id="html" value="46" name="client[]">
        </div></td> 
         <td colspan="19"></td>
           
       
        </tr>
      </tbody>
    </table>
</div></div> </div>
                    </div>




                </div> 

<div class="container">
 <div class="row">
                <div class="col-sm-10">
                      <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                        

                    </div> 
                     <div class="col-sm-2 d-flex justify-content-right "> 
                      <button class="my-btn bg-transparent" type="submit" >
                        <?php echo $this->lang->line('save'); ?></button></div> 

                </div>  

          

            </form>
</div>
        </div>

    </div> 

</div>
<script type="text/javascript">
function randomPassword(length) 
    {
      // alert(length);
         // chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
         // chars = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" ;
        chars = '@&%ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }

        myform.password.value = pass;
    }
 

 function check_adminPortalEmail(email)
    {
      // alert('hi');
        // alert(bus_plate_number);
        if(email != ''){
             $.ajax({
                url: '<?php echo site_url("admin/AdminPortalUser/check_adminPortalEmail"); ?>',
                type: "POST",
                data: {
                    "email" : email
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_emailAdminPortal').html('');
                    } else {
                        
                        $('#errmsg_emailAdminPortal').html("Email Id already exit");
                        $('#email').val('');
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        $('.reporting').click(function () 
        {
            var selected_id = new Array();
            
                $.each($("input[name='client[]']:checked"), function(){
                    selected_id.push($(this).val());
                });
            // alert(selected_id)

            if(selected_id == '15'){
               // alert('1');
                $('#errmsg_reporting').html("select atleast one subtab of reporting");
            }else{
                 //alert('0');
                $('#errmsg_reporting').html("");
            }
        
          
        });
    });


</script>