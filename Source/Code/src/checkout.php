<!DOCTYPE html>
<html>
<body>
<?php include"header.php";
if( isset($_SESSION['Error']) )
{
        echo $_SESSION['Error'];

        unset($_SESSION['Error']);

}
 ?>
<form class="form-horizontal" role="form" method="post" action="buy.php">

<input type="hidden" name="cakeId" value="<?php
	echo ($_GET["cakeId"]);
 ?>" />
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Shippping Address
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                         <div class="row">
						     <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label>Date Of Delivery</label>
                              </div>   
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="date" name="Date_Of_Delivery" placeholder="Date Of Delivery*">
                              </div>
							 <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label>Time Of Delivery</label>
                              </div>                           							  
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="time" name="Time_Of_Delivery" placeholder="Time Of Delivery">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                           <!-- <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Company name">
                              </div> -->                   
                            </div>                            
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="Email_Address" placeholder="Email Address">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="Phone" placeholder="Phone">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="Address" placeholder="Address"></textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select name ="country">
                                  <option value="0">Select Your Country</option>
                                  <option value="1">Australia</option>
                                  <option value="2">Afganistan</option>
                                  <option value="3">Bangladesh</option>
                                  <option value="4">Belgium</option>
                                  <option value="5">Brazil</option>
                                  <option value="6">Canada</option>
                                  <option value="7">China</option>
                                  <option value="8">Denmark</option>
                                  <option value="9">Egypt</option>
                                  <option value="10">India</option>
                                  <option value="11">Iran</option>
                                  <option value="12">Israel</option>
                                  <option value="13">Mexico</option>
                                  <option value="14">UAE</option>
                                  <option value="15">UK</option>
                                  <option value="16">USA</option>
                                </select>
                              </div>                             
                            </div>                            
                          </div>
                          <!--<div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="Aparrtment" placeholder="Appartment, Suite etc.">
                              </div>-->                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city"  placeholder="City / Town*">
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <!--<div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="district" placeholder="District*">
                              </div>-->                             
                            </div>
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="zip" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div> 
                           <div class="row">
                            <!--<div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3">Special Notes</textarea>
                              </div> -->
 						  
                            </div>                            
                          </div>              
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  <input type="submit" name="submit" value="Place Order" class="aa-browse-btn">                
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section></form>
<?php include"footer.php" ?>
</body>
</html>