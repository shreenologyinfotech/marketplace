     
 <div class="CLayout-fixedWidth clearfix">
   <div class="container">
      
    <?php
      if(count($data_page) > 0){
         echo $data_page[0]->description;
      }else{
       echo "Page Not Found";
      }
    ?>
   </div>
 </div>
   