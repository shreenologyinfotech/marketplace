<div class="bg-white">
 <div class="innerpages pt-5 pb-4">
   <div class="container">
     <div class="row">
      <div class="col col-12">
      <h3 class="text-uppercase mb-4">Frequently Asked Questions (FAQ)</h3>
      <div class="faq-questions">
      <div id="accordion">
      
      <?php foreach ($data as $result) { ?>
       <div class="card">    
       <a data-toggle="collapse" data-target="#<?php echo $result->id;?>" aria-expanded="true" aria-controls="<?php echo $result->id;?>">
         <h5> <?php echo $result->faq_title;?></h5> </a> 
           <div id="<?php echo $result->id;?>" class="collapse show" aria-labelledby="headingOne" data-parent="#<?php echo $result->id;?>">
              <div class="card-body"><?php echo $result->faq_description;?></div>
            </div>
      </div>
      
      <?php } ?>
     
       
       
    </div>
       </div>
       </div>
     </div>
   </div>
 </div>
</div>    
    
    
