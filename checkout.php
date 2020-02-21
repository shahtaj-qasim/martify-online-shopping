
<?php
require('AuthnetCIM.class.phps');
 
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['zip']) &&
	isset($_POST['phone']) && isset($_POST['fax']) && isset($_POST['country']) && isset($_POST['state']) && isset($_POST['credit']) && isset($_POST['email']) ) {
	$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$address=$_POST['address'];
$city=$_POST['city'];
$zip=$_POST['zip'];
$phone=$_POST['phone'];
$fax=$_POST['fax'];
$country=$_POST['country'];
$state=$_POST['state'];
$credit=$_POST['credit'];
$email=$_POST['email'];
if(!empty($firstname) && !empty($lastname) && !empty($address) && !empty($city) && !empty($zip) && !empty($phone) && !empty($fax) && !empty($country) &&!empty($state) && !empty($credit) && !empty($email) ){
	try
{
    // Create AuthnetCIM object. Set third parameter to "true" for developer account
    // or use the built in constant USE_DEVELOPMENT_SERVER for better readability.
    $cim = new AuthnetCIM('55WQ3hZTJs6', '73yGW5rm6F393n36',
                                               AuthnetCIM::USE_DEVELOPMENT_SERVER);
 
    // Step 1: create Customer Profile
    //55WQ3hZTJs6
    // Create unique fake email address, description, and customer ID
  
    $description   = 'Monthly Membership No. ' . md5(uniqid(rand(), true));
    $customer_id   = substr(md5(uniqid(rand(), true)), 16, 16);
 
    // Create the profile
    $cim->setParameter('email', $email);
    $cim->setParameter('description', $description);
    $cim->setParameter('merchantCustomerId', $customer_id);
    $cim->createCustomerProfile();
 
    // Get the profile ID returned from the request
    if ($cim->isSuccessful())
    {
        $profile_id = $cim->getProfileID();
    }
 
    // Print the results of the request
    echo '<strong>createCustomerProfileRequest Response Summary:</strong> ' .
                                          $cim->getResponseSummary() . '';
    echo '<strong>Profile ID:</strong> ' . $profile_id . '
 
';
 
    // Step 2: create Payment Profile
    //
    // Create fake user billing information
 
    $expiration     = (date("Y") + 1) . '-12';
 
    // Create the Payment Profile
    $cim->setParameter('customerProfileId', $profile_id);
    $cim->setParameter('billToFirstName', $firstname);
    $cim->setParameter('billToLastName', $lastname);
    $cim->setParameter('billToAddress', $address);
    $cim->setParameter('billToCity', $city);
    $cim->setParameter('billToState', $state);
    $cim->setParameter('billToZip', $zip);
    $cim->setParameter('billToCountry', $country);
    $cim->setParameter('billToPhoneNumber', $phone);
    $cim->setParameter('billToFaxNumber', $fax);
    $cim->setParameter('cardNumber', $credit);
    $cim->setParameter('expirationDate', $expiration);
    $cim->createCustomerPaymentProfile();
 
    // Get the payment profile ID returned from the request
    if ($cim->isSuccessful())
    {
        $payment_profile_id = $cim->getPaymentProfileId();
    }
 
    // Print the results of the request
    echo '<strong>createCustomerPaymentProfileRequest Response Summary:</strong> ' .
                                              $cim->getResponseSummary() . '';
    echo '<strong>Payment Profile ID:</strong> ' . $payment_profile_id . '
 
';
 
    // Step 3: create Shipping Profile
    //
    // Create fake user shipping information

 
    // Create the shipping profile
    $cim->setParameter('customerProfileId', $profile_id);
    $cim->setParameter('shipToFirstName', $firstname);
    $cim->setParameter('shipToLastName', $lastname);
    $cim->setParameter('shipToAddress', $address);
    $cim->setParameter('shipToCity', $city);
    $cim->setParameter('shipToState', $state);
    $cim->setParameter('shipToZip', $zip);
    $cim->setParameter('shipToCountry', $country);
    $cim->setParameter('shipToPhoneNumber', $phone);
    $cim->setParameter('shipToFaxNumber', $fax);
    $cim->createCustomerShippingAddress();
 
    // Get the payment profile ID returned from the request
    if ($cim->isSuccessful())
    {
        $shipping_profile_id = $cim->getCustomerAddressId();
    }
 
    // Print the results of the request
    echo '<strong>createCustomerShippingAddressRequest Response Summary:</strong> ' .
                                               $cim->getResponseSummary() . '';
    echo '<strong>Shipping Profile ID:</strong> ' . $shipping_profile_id . '
 
';
 
    // Step 4: Process a transaction
    //
    // Create fake transaction information
    $purchase_amount = '900.00';
 
    // Process the transaction
    $cim->setParameter('amount', $purchase_amount);
    $cim->setParameter('customerProfileId', $profile_id);
    $cim->setParameter('customerPaymentProfileId', $payment_profile_id);
    $cim->setParameter('customerShippingAddressId', $shipping_profile_id);
    $cim->setParameter('cardCode', '123');
    $cim->setLineItem('12', 'test item', 'it lets you test stuff', '1', '1.00');
    //$cim->createCustomerProfileTransaction();
 
    // Get the payment profile ID returned from the request
    if ($cim->isSuccessful())
    {
        $approval_code = $cim->getAuthCode();
    }
 
    // Print the results of the request
    echo '<strong>createCustomerProfileTransactionRequest Response Summary:</strong> ' .
                               $cim->getResponseSummary() . '';
    echo '<strong>Approval code:</strong> ' . $approval_code;
    echo"<br><br>Your product will be delivered soon!";
}
catch (AuthnetCIMException $e)
{
    echo $e;
    echo $cim;
}


}else{
	echo "Please fill in all the fields";
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>
<body>
  <h1>CHECKOUT</h1>
 <div id="content">
            <div class="container">
          

                <div class="row">

                    <div class="col-md-9 clearfix" id="checkout">

                        <div class="box">
                            <form method="post" action="checkout.php">

                            

                               
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lastname">Lastname</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- /.row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="company">Address</label>
                                                <input type="text" class="form-control" id="company" name="address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-sm-4">
                                            <div class="form-group">
                                                <label for="street">City</label>
                                                <input type="text" class="form-control" id="street" name="city">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="streetnr">ZIP</label>
                                                <input type="text" class="form-control" id="zip" name="zip">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Credit Card number</label>
                                                <input type="text" class="form-control" id="credit" name="credit" value="4111111111111111">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                                <label for="phone">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" >
                                            </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="zip">Phone number</label>
                                                <input type="text" class="form-control" id="num" name="phone" >
                                            </div>
                                        </div>
                                       <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="city">Fax number</label>
                                                <input type="text" class="form-control" id="fax" name="fax">
                                            </div>
                                        </div>
                                        </div>
                                       
                                         <div class="row">
                                        <div class="col-sm-6 col-md-3">
                                           <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="city" name="country">
                                            </div>
                                        </div>
                                       <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="city">State</label>
                                                <input type="text" class="form-control" id="state" name="state">
                                            </div>
                                        </div>
                                       
                                         
                                       

                                    
                                    </div>
                                    <!-- /.row -->
                                </div>

                                <div class="box-footer">
                                    
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-default" value="Pay"><i class="fa fa-chevron-right"></i>
                                        </input>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col-md-9 -->

                    

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
       </body>
</html>