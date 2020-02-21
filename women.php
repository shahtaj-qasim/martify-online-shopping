<?php
require 'core.inc.php';
require_once "Classes/WomenProducts.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link>
	<title></title>

  <link rel="stylesheet" type="text/css" href="css/women.css">
  <style type="text/css">
   
  </style>
	
</head>
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
<ul class="fly-in-text hidden">
	<li>W O M E N ' S</li>
</ul>

<script src="jquery-3.0.0.js"></script>
<script type="text/javascript">
	$(function(){
		setTimeout(function(){
			$('.fly-in-text').removeClass('hidden');
		},500);
	})();
</script>
<div class="main1">
<?php 

                $Women = new WomenProducts();
                $WomenProducts= $Women->GetWomenProducts();
                while ($query_row = mysqli_fetch_array( $WomenProducts)) {
                
                $name= $query_row['name'];
                $price= $query_row['price'];
                $size= $query_row['size'];
                $color= $query_row['color'];
                $pic= $query_row['pro_image'];
                $id= $query_row['pro_id'];
                //$pro_images= $query_row['pro_image'];
               // echo "<div class='title'><h2>$pro_images</h2></div>";
                echo '<li><img src="data:picture/jpeg;base64,'.base64_encode( $pic ).'"/>';
                 echo "<h2>$name</h2>";
               
                echo "<h5>Color: $color</h5>";
                
                echo "<h5>Size: $size</h5>";
                echo "<h5>Price: $price</h5>";
               
               echo '<a href="cart.php?add='.$id.'"><input type="submit" name="submit"
                 value="ORDER NOW" ></a>';
}

?>
</div>

<div class="copy" style="text-align: center; margin-top: 5vw;">© Copyrights. Created by k142156,k142039,k142841</div>
</body>
</html>