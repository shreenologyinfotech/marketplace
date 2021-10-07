

        </div>
 <!-- /.container-fluid -->
            <footer class="footer text-center"> <?php get_meta_value("copy_right_content"); ?> </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>assets/admin/js/waves.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/dashboard1.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>


    <script src="<?php echo base_url()?>assets/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="<?php echo base_url()?>assets/admin/js/dataTables.buttons.min.js"></script>
    
    
    <script src="<?php echo base_url()?>assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/ckeditor/samples/js/sample.js"></script>
   
    <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    
    <script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script> 
    <script src="<?php echo base_url()?>assets/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/lightslider.js"></script>
  <script type="text/javascript">

<?php 
    if($this->session->userdata(GLOBAL_MSG)!='') {
    $message = $this->session->userdata(GLOBAL_MSG); 
    $this->session->set_userdata(GLOBAL_MSG,'');
    ?>  
        swal({
          title: "",
          text: '<?php echo $message;?>',
          type: "info",
          confirmButtonText: "Ok"
        });
        
   <?php } ?>



   /*function verifyRecaptchaCallback() {
      console.log("here comes callback ");

   }*/

    $(document).ready(function() {
    
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop:true,
            slideMargin: 0,
            adaptiveHeight:true,
            thumbItem: 4
        }); 
  });

   
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      startDate: new Date()
    });

    $(".select2").select2();
  </script>
  
   
<?php if($useEditor){?>
   <script type="text/javascript">
    initSample();    
   </script>
<?php }?>   
<?php if($useDataTables){?>
<script>
$(document).ready(function() {
    $(".main-datatable").DataTable({
        
        "order": [ parseInt('<?php echo $default_order_col ?>'), "<?php echo $default_order_dir;?>" ],
        "pageLength": parseInt('<?php echo $default_page_length?>'),
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": '<?php echo current_url() ?>?ajax=1',
            "dataType": "json",
            "type": "GET"
        },
        <?php if(count($columns)){?>
        "columns": [
            <?php
            $colString = '';
            $i = 0;
            foreach($columns as $column){
                $colString .= '{ "data": "'.$column.'" }' ;
                if($i<count($columns)-1){
                    $colString .= ',';  
                }   
                $i++;
            }
            echo $colString;
            ?>
        ],
        <?php }?>
        <?php /* if(count($colDef)){?>
        "columnDefs": [
            <?php 
            $colDefString = '';
            $i=0;
            foreach($colDef as $column){
                $colDefString .= "{'targets': [".$column['target']."],'visible': ".$column['visible'].",'searchable': ".$column['searchable']."}";
                if($i<count($colDef)-1){
                    $colDefString .= ',';   
                }   
                $i++;
            } 
            echo $colDefString;
            ?>
            
        ],
        <?php  } */?>   

       <?php $currentURL = current_url(); 
       if( basename($currentURL) == 'refunds'){
       ?>
        columnDefs: [
                        { orderable: false, targets: 0,searchable:0 },
                        { orderable: false, targets: 8,searchable:0 }
                    ],
        <?php }else{?>
          columnDefs: [{ orderable: false, targets: -1 }],
        <?php } ?>
    });
})
</script>   
<?php }?>   




<script type="text/javascript">
    $("#banner_image").click(function(e) {
        $("#imageUpload").click();
    });

   

 function validate(){
      var inp = document.getElementById('imageUpload');
      if(inp.files.length === 0){
            swal({
              title: "",
              text: 'Please select image',
              type: "info",
              confirmButtonText: "Ok"
            });
          inp.focus();
          return false;
      }
 }


function readURL(input,element) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+element).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}



function categoryCheck(cb) {
    var id_key = "category_id";    
    var id_value = cb.value;    
    var table = "tbl_home_category";    
    var visible_to_home = "N"; 
    if(cb.checked){
         visible_to_home = "Y";
    }
       
      var formdata = {
         "table":table,
         "visible_to_home":visible_to_home,
         "id_key":id_key,
         "id_value":id_value
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/updateHomeStatus",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $(".error-signup-store").html(data.Message); 
              
           }
       });



}

function storeCheck(cb) {
    var id_key = "store_id";    
    var id_value = cb.value;    
    var table = "tbl_stores";    
    var visible_to_home = "N"; 
    if(cb.checked){
         visible_to_home = "Y";
    }
       
      var formdata = {
         "table":table,
         "visible_to_home":visible_to_home,
         "id_key":id_key,
         "id_value":id_value
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/updateHomeStatus",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $(".error-signup-store").html(data.Message); 
              
           }
       });



}



function productCheck(cb) {
    var id_key = "product_id";    
    var id_value = cb.value;    
    var table = "tbl_products";    
    var visible_to_home = "N"; 
    if(cb.checked){
         visible_to_home = "Y";
    }
       
      var formdata = {
         "table":table,
         "visible_to_home":visible_to_home,
         "id_key":id_key,
         "id_value":id_value
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/updateHomeStatus",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $(".error-signup-store").html(data.Message); 
              
           }
       });



}

    
function brandCheck(cb) {
    var id_key = "brand_id";    
    var id_value = cb.value;    
    var table = "tbl_brands";    
    var visible_to_home = "N"; 
    if(cb.checked){
         visible_to_home = "Y";
    }
       
      var formdata = {
         "table":table,
         "visible_to_home":visible_to_home,
         "id_key":id_key,
         "id_value":id_value
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/updateHomeStatus",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $(".error-signup-store").html(data.Message); 
              
           }
       });



}


</script>




    
</body>

</html>