<?php 
$email    = "";
$password = "";


if(sizeof($post) > 0){
  if(isset($post["email"])){
    $email = $post["email"];
  }
}

?>
<div class="innerpages bg-light">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col col-md-5 col-12">
         <div class="bg-white shadow-sm p-5 mt-5 mb-5 rounded">
          <div class="mb-5 text-center">
           <h4 class="mb-4"><strong>Login</strong></h4>
           <p class="mb-0">New to CashVertise? </p>
           <p><a href="<?php echo base_url()?>signup"> Sign up here.</a></p>  
             </div>    
            <form autocomplete="off" method="post" action="">
              <div class="form-group">                
                <input value="<?php echo $email; ?>"  required="" name="email" type="email" class="form-control radius" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                
              </div>
              <div class="form-group">                
                <input autocomplete="new-password"  value="<?php echo $password;?>" name="password" type="password" class="form-control radius" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-check">
                <a class="center" href="<?php echo base_url()?>forgotpassword">Forgot Password</a>
              </div>
              <div align="center">
              <button type="submit" class="btn text-white pl-5 pr-5 mt-5 mb-5 radius green-bg">Log In</button> </div>
            </form>           
         </div>
       </div>
     </div>


     <!-- Activities -->
    <div class="text-center advertise-whyus pt-5 mb-5 ">
      <div class="container">        
        <h2 class="text-uppercase mt-5 mb-4">Why Us?</h2>
                
        <div class="row mt-5">
          <div class="col col-md-4 col-12">
           <div class="advertise-main bg-white">
            <div class="icon-advertise-middle"> <span class="add-why-icon1"></span> </div>
            <h5>Better Return on Investment</h5>
            <p>You pay only when your target audience 
have viewed your CashVertisements. 
Excess credits from un-viewed 
CashVertisements can be refunded or 
reused for the next marketing campaign</p>            
          </div>
          </div>
          <div class="col col-md-4 col-12">
          <div class="advertise-main bg-white">
          <div class="icon-advertise-middle"> <span class="add-why-icon2"></span> </div>
            <h5>Greater Effectiveness</h5>
            <p>Your target audience are more inclined to 
view your CashVertisements as they 
are incentivised to do so</p>            
          </div>
          </div>
          <div class="col col-md-4 col-12">
          <div class="advertise-main bg-white">
          <div class="icon-advertise-middle"> <span class="add-why-icon3"></span> </div>
            <h5>Radius Targeting Approach</h5>
            <p>On top of being able to advertise by postal
sectors, you are able to choose a radius 
around a location of your choice</p>    
            </div>        
          </div>
        </div>   
             
        <div class="row mt-5">
          <div class="col col-md-4 col-12">
           <div class="advertise-main bg-white">
            <div class="icon-advertise-middle"> <span class="add-why-icon4"></span> </div>
            <h5>No Delay</h5>
            <p>You may choose to distribute your
CashVertisements any day</p>            
          </div>
          </div>
          <div class="col col-md-4 col-12">
          <div class="advertise-main bg-white">
          <div class="icon-advertise-middle"> <span class="add-why-icon5"></span> </div>
            <h5>Create a Better Impression</h5>
            <p>Your target audience tend to feel positive
when they see your CashVertisements as it
provides some form of remuneration for them</p>            
          </div>
          </div>
          <div class="col col-md-4 col-12">
          <div class="advertise-main bg-white">
          <div class="icon-advertise-middle"> <span class="add-why-icon6"></span> </div>
            <h5>Eco-Friendly</h5>
            <p>No wastage as CashVertisements are
distributed digitally</p>    
            </div>        
          </div>
        </div>
      </div>
      
    </div><br>


   </div>
 </div>
 