
<head>
    <title>Contact Us</title>
   
    <link rel="stylesheet" type="text/css" href="css/contact.css">
    <style type="text/css">
     
    </style>
   
    
</head>
<?php
require_once "Classes/HelpMail.php";
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['submit'])){

	$con_name=$_POST['name'];
	$con_email=$_POST['email'];
	$con_sub=$_POST['subject'];
	$con_text=$_POST['message'];
      if(!empty($con_name) && !empty($con_email) && !empty($con_sub) && !empty($con_text)){
		$Mail = new HelpMail();
        $Mail -> SendHelpMail($con_name,$con_email,$con_sub,$con_text);
} else{
	echo "Please try again.";
}
	} 

?>
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
<div class="contact">
  <h2>Contact Us</h2>
  <h6>Feel free to contact us if you have any query! We'll respond within minutes.</h6>
    <form action="contact.php" method="post" id="form">
       <div class="login-form"><input type="text" name="name" maxlength="30" required="required" placeholder="Name" /></div>
        <input type="text" name="email" maxlength="30" required="required" placeholder="Email" />
        <input type="text" name="subject" maxlength="30" required="required" placeholder="Subject" />
        <textarea type="text" name="message" rows="7" cols="95" maxlength="1000" placeholder="Message" id="text"></textarea>
        <div class="but2">
    <input type="submit" name="submit" value="SEND MESSAGE" class="login-button"></div>
    </form>
</div>
<div class="copy" style="text-align: center; margin-top: 5vw; font-family: Calibri">© Copyrights. Created by k142156,k142039,k142841</div>
<script src="jquery-3.0.0.js"></script>
</body>
</html>