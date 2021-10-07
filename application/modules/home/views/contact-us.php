<div class="CLayout-contentInner">
<!-- promo text -->                  
<div class='PromotionBanner promo-background'>
   <ul class='PromotionBanner-list'>
      <li class='PromotionBanner-listItem'>
         <?php
           $data = get_promotions();
           foreach ($data as $promoObj){ ?>
            <span class='PromotionBanner-listItem-text'>
               <a target='_blank' class='PromotionBanner-link' href='<?php echo $promoObj->promo_link; ?>'><?php echo $promoObj->promo_text; ?></a>
            </span>
           <?php  } ?>
      </li>
   </ul>
</div>
<!-- promo text -->

  <!--  <div class="PromotionBanner promo-background">
      <ul class="PromotionBanner-list">
         <li class="PromotionBanner-listItem">
            <span class="PromotionBanner-listItem-text">
            <a class="PromotionBanner-link" href="https://www.bikeexchange.com.co/promo/seleccion-especial-madres">¡Este mes celébrale cada día a mamá, conoce nuestra variedad de productos ideales para ella!</a>
            </span>
         </li>
      </ul>
   </div> -->
   <div class="Layout Layout--hero ContentBlock ContentBlock--TextBlock">
      <div class="CLayout-contentInner">
         <div class="Layout Layout--hero ContentBlock ContentBlock--TextBlock">
            <div class="pagebuilder">
               <section class="be-call-to-actions be-bg-light-grey text-center be-pt-60 be-pt-lg-100 be-pb-40 be-pb-lg-80" id="Formular">
                  <div class="container">
                     
                     <!-- <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-lg-6">
                           <h1 class="be-mb-40"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contáctanos</font></font></h1>
                           <i class="far fa-calendar-check" style="padding-right: 12px;"></i>
                           <span class="lead-calendly-retailer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Concertar una cita</font></font></span>
                        </div>
                     </div> -->
                     
                     <!-- <h3 class="be-mb-20 be-mb-sm-40 icon-telefon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a href="https://wa.me/573053668258" target="_blank">(+57) 305 366 8258</a></font></font></h3> -->


                     <div class="be-forms">
                        <p class="be-striked-header be-mb-60" id="kontakt"><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">o déjanos un mensaje</font></font></span></p>
                        <form action="<?php echo base_url()?>contactus" method="post" role="form" id="contactForm" class="contact-form shake BE-container-inner" data-toggle="validator">
                           <div class="row">
                              <div class="col-12 col-sm-6 be-mb-20">
                                 <div class="be-form-group">
                                    <div class="controls">
                                       <input type="text" name="fname" id="fname" class="be-form-control" placeholder="fname" required="" style="font-size: 14px;">
                                    </div>
                                    <p></p>
                                 </div>
                                 <div class="be-form-group">
                                    <div class="controls">
                                       <input type="text" name="lname" id="lname" class="be-form-control" placeholder="lname" required=""  style="font-size: 14px;">
                                    </div>
                                    <p></p>
                                 </div>
                              </div>
                              <div class="col-12 col-sm-6 be-mb-20">
                                 <div class="be-form-group">
                                    <div class="controls">
                                       <input type="text" name="contact" id="contact" class="be-form-control" placeholder="contact" required="" data-error="Por favor ingresa tu número de contacto" style="font-size: 14px;">
                                    </div>
                                    <p></p>
                                 </div>
                                 <div class="be-form-group">
                                    <div class="controls">
                                       <input type="email" name="email" class="email be-form-control" id="email" placeholder="E-Mail" required="" style="font-size: 14px;">
                                    </div>
                                    <p></p>
                                 </div>
                              </div>
                           </div>
                           <div class="be-form-group" style="margin: 10px 0 40px;">
                              <div class="controls">
                                 <textarea name="message" id="message" rows="3" placeholder="message" class="be-form-control" required=""style="font-size: 14px;"></textarea>
                                 <div class="help-block with-errors"></div>
                              </div>
                              <p></p>
                           </div>
                           <div class="buttonHolder">
                              <button type="submit" name="submit" class="be-btn btn-primary lead-email-retailer"><i class="fa fa-envelope" style="padding-right: 12px;"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Solicita más información</font></font></button>
                           </div>
                        </form>
                     </div>
                  </div>
               </section>
            </div>
            <p></p>
         </div>
      </div>
   </div>
</div>
