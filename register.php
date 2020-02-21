<?php
require'connect.inc.php';
require 'core.inc.php';
?>
<html>
    <title></title>
    <script src="jquery-3.0.0.js"></script>

    <link rel="stylesheet" type="text/css" href="css/register.css">
<body>
    <header>
	<ul>
		<li id="logo"><img src="logo.png"></div></li>
		<li id="head"><a href="index.php">HOME</a></li>
		  <li id="head"><select onchange="location = this.value;"><option value="Dropdown" SELECTED>PRODUCTS</option>
            <option value="men.php">Men's</option>
            <option value="women.php">Women's</option></select></li>
		<li id="head"><a href="contact.php">CONTACT</a></li>
		<li><a href="login.php"><img src="login.gif"></a></li>
		<li><a href="register.php"><img src="register.png"></a></li>
		<li><a href="cart.php"><img src="cart.png"></a></li>
	</ul>
</header>
<div class="logpage">
<h2>Hello!</h2>
<p>We make sure our customers and retailers are completely satisfied with our service!
</p>
<button id="custlogin">REGISTER AS CUSTOMER</button>
<button id="retlogin">REGISTER AS RETAILER</button>
<div id="custlogin">
    <form action="register.php"  method="POST"  id="form1">
        <input name="first_c" type="text" placeholder="Firstname" size="30" >
        <input name="last_c" type="text" placeholder="Lastname"  size="30" ><br><br>
        <input name="dob_c" type="date" placeholder="Date of Birth" size="30" >
        <input name="email_c" type="text" placeholder="Email"  size="30" ><br><br>
        <input name="con_c" type="text" placeholder="Contact" size="30" >
        <input name="city_c" type="text" placeholder="City"  size="30" ><br><br>
        <input name="coun_c" type="text" placeholder="Country" size="30" >
        <input name="user_c" type="text" placeholder="Username"  size="30" ><br><br>
        <input name="pass_c" type="password" placeholder="Password" size="30" ><br><br>
        <input class="btn" type="submit" value="REGISTER" name="clog">
    </form>
</div>
    <div id="retlogin">
    <form action="register.php"  method="POST"  id="form2">
        <input name="first_r" type="text" placeholder="Firstname" size="30" >
        <input name="last_r" type="text" placeholder="Lastname"  size="30" ><br><br>
        <input name="dob_r" type="date" placeholder="Date of Birth" size="30" >
        <input name="email_r" type="text" placeholder="Email"  size="30" ><br><br>
        <input name="con_r" type="text" placeholder="Contact" size="30" >
        <input name="city_r" type="text" placeholder="City"  size="30" ><br><br>
        <input name="coun_r" type="text" placeholder="Country" size="30" >
        <input name="user_r" type="text" placeholder="Username"  size="30" ><br><br>
        <input name="pass_r" type="password" placeholder="Password" size="30" >
        <input name="brand_r" type="text" placeholder="Brand name"  size="30" ><br><br>
        <input class="btn" type="submit" value="REGISTER" name="rlog">
    </form>
</div>
</div>

<script>
$(document).ready( function() {
  $( "#retlogin" ).click( function() {
    $( "#form2" ).toggle('slow');
  });
});
</script>
<script>
$(document).ready( function() {
  $( "#custlogin" ).click( function() {
    $( "#form1" ).toggle('slow');
  });
});
</script>
</body>
</html>
<?php

if(!loggedin_cust()){

    if(isset($_POST['first_c']) && isset($_POST['last_c']) && isset($_POST['dob_c']) && isset($_POST['email_c']) && isset($_POST['con_c'])
        && isset($_POST['city_c']) && isset($_POST['coun_c']) && isset($_POST['user_c']) && isset($_POST['pass_c'])){
        $fname=$_POST['first_c'];
        $lname=$_POST['last_c'];
        $dob=$_POST['dob_c'];
        $email=$_POST['email_c'];
        $_SESSION['email'] = $email;
        $contact=$_POST['con_c'];
        $city=$_POST['city_c'];
        $count=$_POST['coun_c'];
        $user=$_POST['user_c'];
        $pass=$_POST['pass_c'];
        $mysqlhost='localhost';
$mysqluser='id1519032_shahtaj';
$mysqlpass='blackparade7';
       $mysqlcon=mysqli_connect($mysqlhost,$mysqluser,$mysqlpass,'id1519032_martify') or die('Could not connect');
        if(!empty($fname) && !empty($lname) && !empty($dob)&& !empty($email) && !empty($contact) && !empty($city) && !empty($count)
            && !empty($user) && !empty($pass)){
            $query="select username,pass from customer where username='".$user."'";
            $query_run=mysqli_query($mysqlcon, $query,MYSQLI_STORE_RESULT);
            $num_rows=mysqli_num_rows($query_run);
            if($num_rows==1){
                echo "Username already exists!";
            }else{
                    $confirm_code=md5(uniqid(rand())); 
                      $userid="cust";
                    $link= "https://thecatcodes.000webhostapp.com/confirmregistration.php?passkey=$confirm_code&user=$user&userid=$userid";
$t="no";
                     $query="INSERT INTO temp_verification VALUES ('', '". $fname."', '".$lname."', '".$dob."', '".$email."','".$contact."', '".$city."', '".$count."', '".$user."', '".$pass."','".$t."','".''."','".$confirm_code."')";
                 if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
                            
                     if(mail($email,"Registration Verification",' Click on this link to complete the registration process: '.$link ,'From: teammartify@gmail.com')){
                     echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Mail Sent!')
                    window.location.href='checkmail.php'
                    </SCRIPT>");
                 }
                } 
            }

        }else{
            echo "Please fill all the fields";
        }
    }
}

if(!loggedin_ret()){

    if(isset($_POST['first_r']) && isset($_POST['last_r']) && isset($_POST['dob_r']) && isset($_POST['email_r']) && isset($_POST['con_r'])
        && isset($_POST['city_r']) && isset($_POST['coun_r']) && isset($_POST['user_r']) && isset($_POST['pass_r']) && isset($_POST['brand_r'])){
        $fname=$_POST['first_r'];
        $lname=$_POST['last_r'];
        $dob=$_POST['dob_r'];
        $email=$_POST['email_r'];
        $_SESSION['email'] = $email;
        $contact=$_POST['con_r'];
        $city=$_POST['city_r'];
        $count=$_POST['coun_r'];
        $user=$_POST['user_r'];
        $pass=$_POST['pass_r'];
        $brand=$_POST['brand_r'];
   $mysqlhost='localhost';
$mysqluser='id1519032_shahtaj';
$mysqlpass='blackparade7';
       $mysqlcon=mysqli_connect($mysqlhost,$mysqluser,$mysqlpass,'id1519032_martify') or die('Could not connect');
        if(!empty($fname) && !empty($lname) && !empty($dob)&& !empty($email) && !empty($contact) && !empty($city) && !empty($count)
            && !empty($user) && !empty($pass)){
            $query="select username,pass from retailer where username='".$user."'";
            $query_run=mysqli_query($mysqlcon, $query,MYSQLI_STORE_RESULT);
            $num_rows=mysqli_num_rows($query_run);
            if($num_rows==1){
                echo "Username already exists!";
            }else{
                    $confirm_code=md5(uniqid(rand())); 
                     $userid="ret";
                    $link= "https://thecatcodes.000webhostapp.com/confirmregistration.php?passkey=$confirm_code&user=$user&userid=$userid";
                     $query="INSERT INTO temp_verification VALUES ('', '".$fname."', '".$lname."', '".$dob."', '".$email."','".$contact."', '".$city."', '".$count."', '".$user."', '".$pass."','".$brand."','".''."','".$confirm_code."')";
                 if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
                           
                     if(mail($email,"Registration Verification",' Click on this link to complete the registration process: '.$link ,'From: teammartify@gmail.com')){
                     echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Mail Sent!')
                    window.location.href='checkmail.php'
                    </SCRIPT>");
                 }
                } 
            }

        }else{
            echo "Please fill all the fields";
        }
    }
}

echo'<div class="copy" style="text-align: center; margin-top: 5vw; font-family:Calibri;">© Copyrights. Created by k142156,k142039,k142841</div>';
?>