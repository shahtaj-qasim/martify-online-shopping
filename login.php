<?php
    require_once "Classes/LoginMethods.php";

    if(isset($_POST['user_c']) && isset($_POST['pass_c'])){
        $user_c=$_POST['user_c'];
        $pass_c=$_POST['pass_c'];
        $LoginC = new LoginMethods();
        if(!empty($user_c) && !empty($pass_c)){
        $LoginC->VerifyLoginCus($user_c, $pass_c);
        }
    }


    if(isset($_POST['user_r']) && isset($_POST['pass_r'])){
        $user_r=$_POST['user_r'];
        $pass_r=$_POST['pass_r'];
        $LoginR = new LoginMethods();
        if(!empty($user_r) && !empty($pass_r)){
        $LoginR->VerifyLoginRet($user_r, $pass_r);
        }
    }
       

?>
<html>
    <title></title>
    <script src="jquery-3.0.0.js"></script>
   
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <style type="text/css">
     
    </style>
   
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
<button id="custlogin">LOGIN AS CUSTOMER</button>
<button id="retlogin">LOGIN AS RETAILER</button>
<div id="custlogin">
    <form action="login.php"  method="POST"  id="form1">
        <input name="user_c" type="text" placeholder="Username" size="30" ><br><br>
        <input name="pass_c" type="password" placeholder="Password"  size="30" ><br><br>
        <input class="btn" type="submit" value="LOGIN" name="clog">
    </form>
</div>
    <div id="retlogin">
    <form action="login.php"  method="POST"  id="form2">
        <input name="user_r" type="text" placeholder="Username" size="30" ><br><br>
        <input name="pass_r" type="password" placeholder="Password"  size="30" ><br><br>
        <input class="btn" type="submit" value="LOGIN" name="rlog">
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
<div class="copy" style="text-align: center; margin-top: 5vw; font-family: Calibri">© Copyrights. Created by k142156,k142039,k142841</div>
</body>
</html>