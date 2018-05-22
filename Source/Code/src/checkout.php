  
<html>
<body>

  <?php
  include 'utils.php';
  
  $obj=new utils();
  $obj->includeHeader();
  if (session_status() == PHP_SESSION_NONE) {
    session_name("OnlineCakeDelivery");
    session_start();
  }
  if(!isset($_SESSION["userEmail"])){
    header("Location:logout.php");
  }elseif(!isset($_SESSION["userType"])){
    header("Location:logout.php");
  }elseif($_SESSION["userType"]!='customer'){ 
    header("Location:logout.php");
  }
  ?>



  <form class="form-horizontal" role="form" method="post" action="buy.php">

   <!-- <form  method="post" target="_top" action="payments.php"> -->
    <!-- action="payments.php" -->
    <!-- </form> -->

    <section id="checkout">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
          <div class="checkout-area">
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
                      <div id="collapseFour" style=" display: block;" class="panel-collapse collapse">
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
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="Email_Address" placeholder="Email Address" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required="required">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="Phone" pattern="\d{10}" required="required" min=10 placeholder="Phone">
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
                        </div>
                        <div class="col-md-6">
                          <div class="aa-checkout-single-bill">
                            <input type="text" name="state"  placeholder="State">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="aa-checkout-single-bill">
                            <input type="text" name="city"  placeholder="City / Town*">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="aa-checkout-single-bill">
                            <input type="text" name="zip" min=5 pattern="\d{5}" required="required" placeholder="Postcode / ZIP*">
                          </div>
                        </div>
                      </div>                           
                    </div>              
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="submit"  value="Place Order" class="aa-browse-btn">
          </div>
        </div>
      </div>
    </div>
  </section>
</form>


<?php
  $obj->includeFooter();
  ?>
</body>
</html>