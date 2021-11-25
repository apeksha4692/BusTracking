  </div>  

 </div> 

      
 

<!-- <footer>
    <div class="container-fluid">
       <div class="pl-2">
            <img width="128" src="img/logo.png">
       </div> 
       <div class="col-sm-12">
             <div class="row pl-5">
                 <div class="col-sm-3">
                     <a class="nav-link" href="">About Us</a>   
                     <a class="nav-link" href="">F.A.Q</a>   
                     <a class="nav-link" href="">Contact Us</a>   
                     
                 </div>   
                 <div class="col-sm-3">
                     <a class="nav-link" href="">Privacy Policy </a>   
                     <a class="nav-link" href="">Terms & Conditions</a>   
                     <a class="nav-link" href="">Cookie Policy</a>   
                     
                 </div>   
                 <div class="col-sm-3 text-center">
                    <a class="nav-link" href="">Follow Us on Social Media</a>   
                     <a class="nav-link social-media" href="">
                       <img src="img/fb.svg">
                       <img src="img/insta.svg">
                       
                       
                    </a>
                 </div>   
                 <div class="col-sm-3">
                     <a class="nav-link" href="">Downlode The Footy app</a>   
                     <div class="d-flex justify-content-between mt-2">
                         <a href=""> <img width="124px" src="img/btn-android.png"></a>     
                         <a href=""> <img width="124px" src="img/btn-ios.png"></a>
                     </div>     
                 </div>   
               </div> 
       </div>           
    </div>    
</footer> 
 -->





    <!-- SCRIPTS -->

    <!-- JQuery -->

    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/jquery-3.2.1.min.js"></script> -->

    <!-- Bootstrap tooltips -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assest/js/mdb.min.js"></script>

    <!-- my core JavaScript -->
    
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assest/jquery.dataTables.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assest/dataTables.bootstrap.min.js"></script> -->

    <!------------------------ Data table For pdf,export-------------------------------->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <!------------------------ Select picker JS -------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</body>



</html>

<script type="text/javascript">
  // $(document).on('ready', function() {
    // $(function() {
    // alert('hi');
    $('.alert-danger').delay(7000).fadeOut();    
    $('.alert').delay(5000).fadeOut(); 
  // }); 

    <?php if($this->session->flashdata('success')){ ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php }else if($this->session->flashdata('error')){  ?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php }else if($this->session->flashdata('warning')){  ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php }else if($this->session->flashdata('info')){  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>


    function changeLang(lang)
    {
        // alert(lang);
        // var lang = this.value;
        $.ajax({
            url: '<?php echo site_url("LanguageSwitcher/switchLang"); ?>',
            type: "POST",
            data: {
            "lang"     : lang,
            },
            success: function (response) 
            {
                // alert(response);
                // console.log(response);
                if (response == 1) 
                {
                    location.reload();
                } 

            }
        });
    }
//---------Script Change arrow datatable----------------
    $(document).ready(function(){
        $(".arrowUp").click(function(){
            $(".arrowUp").hide();
            $(".arrowDown").show();
        });
        $(".arrowDown").click(function(){
            $(".arrowUp").show();
            $(".arrowDown").hide();
          });
    });
</script>

