<?php
$mysqlhost='localhost';
$mysqluser='root';
$mysqlpass='';
    
@$mysqlcon=mysqli_connect($mysqlhost,$mysqluser,$mysqlpass,'martify') or die('Could not connect');
mysqli_select_db($mysqlcon, 'martify') or die('No such database exists');
require 'core.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link>
	<title></title>

  <script src="jquery-3.0.0.js"></script>
 <link rel="stylesheet" type="text/css" href="header.css">
    
    <link rel="stylesheet" type="text/css" href="css/retailer.css">

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
<?php

if(loggedin_ret()){
echo '<div class="name">';
$first=getuserfield('f_name');
$last=getuserfield('l_name');
   echo $first.' '.$last.'<a href="logout.php">Log out</a><br></div>';
}
?>

<!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>!-->
<div class="pop-outer">
  <div class="pop-inner">
    
    <h2 style="margin-top:1px;">Product's Form<button class="close" id="close">X</button></h2> 
   <form action="retailer.php" method="post">
     <input type="text" name="name" placeholder="Name"><br><br>
     <input type="text" name="price" placeholder="Price"><br><br>
     <input type="text" name="size" placeholder="Size"><br><br>
     <input type="text" name="color" placeholder="Color"><br><br>
      <input type="text" name="quantity" placeholder="Quantity"><br><br>
     <input type="text" class="gender" name="gender" list="gender" placeholder="Gender">
     <datalist id='gender'>
  <option value="F">
  <option value="M">
</datalist>
<input type="file" name="file" id="file"><br><br>
<select name="category" id="gender" class="gender">
<option value="Clothes">Clothes
<option value="Shoes">Shoes
<option value="Accessory">Accessory</option><input type="submit" name="submit" id="submit">
   </form>
  </div>
</div>
<?php 
if(loggedin_ret()){
if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['size']) && isset($_POST['category']) && isset($_POST['color']) && isset($_POST['gender']) && isset($_POST['file']) && isset($_POST['quantity'])){
  $name=$_POST['name'];
  $price=$_POST['price'];
  $size=$_POST['size'];
  $color=$_POST['color'];
  $gender=$_POST['gender'];
  $file=$_POST['file'];
   $category=$_POST['category'];
     $quantity=$_POST['quantity'];

  if(!empty($name) && !empty($price) && !empty($color) && !empty($gender) && !empty($file) && !empty($size) && !empty($category) ){
    if($_POST['category']=='Clothes'){
      $category=1;
    }
    if($_POST['category']=='Shoes'){
      $category=2;
    }
    if($_POST['category']=='Accessory'){
      $category=3;
    }
    if($_POST['gender']=='F'){
      $gender=2;
    }
      if($_POST['gender']=='M'){
      $gender=1;
    }
  
    $query="INSERT INTO products values('', '".mysqli_real_escape_string($mysqlcon, $category)."', '".mysqli_real_escape_string($mysqlcon, $_SESSION['ret_id'])."', '".mysqli_real_escape_string($mysqlcon, $name)."', '".mysqli_real_escape_string($mysqlcon, $price)."','".mysqli_real_escape_string($mysqlcon, $size)."', '".mysqli_real_escape_string($mysqlcon, $color)."','".mysqli_real_escape_string($mysqlcon, $gender)."','".mysqli_real_escape_string($mysqlcon, $quantity)."', '".mysqli_real_escape_string($mysqlcon,file_get_contents("picture/".$file))."')";
     if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
      echo "<div class='try'>Product Inserted</div>";
     }
  }else{
    echo "Fill all fields";
  }
}
}else{
  echo '<div class="log">Please <a href="login.php">Login</a> or <a href="register.php">Register</a> to add in cart.</div>';
}

?>
<script src="jquery-3.0.0.js"></script>
<script>
  $(document).ready(function(){
    $(".open").click(function(){
      $('.pop-outer').fadeIn('slow');
    });
    $(".close").click(function(){
      $('.pop-outer').fadeOut('slow');
    });
  });
</script>
   <script src="jquery-3.0.0.js"></script>
    <script>
  $(document).ready(function(){
    $(".update").click(function(){
      $('.pop-outer3').fadeIn('slow');
    });
    $(".close").click(function(){
      $('.pop-outer3').fadeOut('slow');
    });
  });
</script>

<div class="pop-outer1">
    <h1>Your Products<button class="open">(+)</button></h1>
    <?php
    @$query="SELECT name,price,size,color,pro_id from products where ret_id='".$_SESSION['ret_id']."'";

    if($query_run=mysqli_query($mysqlcon, $query, MYSQLI_STORE_RESULT)){
      echo "<table class='table' align='center'>";
      echo "<thead>
      <tr>
        <th>NAME</th>
        <th>SIZE</th>
        <th>COLOR</th>
        <th>PRICE</th>
        <th>OPTIONS</th>
       
      </tr>
    </thead>";

            while (@$query_row = mysqli_fetch_array($query_run)) {
                
                $name= $query_row['name'];
                $price= $query_row['price'];
                $size= $query_row['size'];
                $color= $query_row['color'];
                  $id= $query_row['pro_id'];

                 
 
                 
    
    echo'  <tr>
        <td>'.$name.'</td>
        <td>'.$size.'</td>
        <td>'.$color.'</td>
        <td>'.$price.'</td>
        <td><div class="but"><button class="update"><a href="retailer.php?update='.$query_row['pro_id'].'">Update</a></button><a href="retailer.php?add='.$query_row['pro_id'].'">Delete</a></form></div></td></tr>';


        if(isset($_GET['add']) && !empty($_GET['add'])){
  $id=$_GET['add'];
   $query="DELETE FROM products where pro_id='".$id."'";
      if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
        echo "Product deleted!"; 

       }
     }
       /* if(isset($_POST['delete'])){


    echo $query_row['pro_id'];
       $query="DELETE FROM products where pro_id='".$query_row['pro_id']."'";
      if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
        echo "Product deleted!"; 

       }

     }
    */
    }

  }
    
    ?>


  <div class='pop-outer3'>
  <div class='pop-inner3'>
    <button class='close' id='close'>X</button>
    <h2>Product's Form</h2>
   <form action='retailer.php' method='post'>
     <input type='text' name='name1' placeholder='Name'><br><br>
     <input type='text' name='price1' placeholder='Price'><br><br>
     <input type='text' name='size1' placeholder='Size'><br><br>
     <input type='text' name='color1' placeholder='Color'><br><br>
     <input type='text' name='quantity1' placeholder='Quantity'><br><br>
     <input type='text' class='gender' name='gender1' list='gender' placeholder='Gender'>
     <datalist id='gender'>
  <option value='F'>
  <option value='M'>
</datalist>
<input type='file' name='file1' id='file'><br><br>
<select name='category1' id='gender' class='gender'>
<option value='Clothes'>Clothes
<option value='Shoes'>Shoes
<option value='Accessory'>Accessory</option><input type='submit' name='submit' id='submit' value='Update'>
   </form>
  </div>
</div>
    <?php

    //this is update
    if(isset($_GET['update']) && !empty($_GET['update'])){
  $id=$_GET['update'];
  
}
if(isset($_POST['name1']) && isset($_POST['price1']) && isset($_POST['size1']) && isset($_POST['category1']) && isset($_POST['color1']) && isset($_POST['gender1']) && isset($_POST['file1']) && isset($_POST['quantity1'])){
  $name1=$_POST['name1'];
  $price1=$_POST['price1'];
  $size1=$_POST['size1'];
  $color1=$_POST['color1'];
  $gender1=$_POST['gender1'];
  $file1=$_POST['file1'];
   $category1=$_POST['category1'];
     $quantity1=$_POST['quantity1'];
   

  if(!empty($name1) && !empty($price1) && !empty($color1) && !empty($gender1) && !empty($file1) && !empty($size1) && !empty($category1) ){
    if($_POST['category1']=='Clothes'){
      $category1=1;
    }
    if($_POST['category1']=='Shoes'){
      $category1=2;
    }
    if($_POST['category1']=='Accessory'){
      $category1=3;
    }
    if($_POST['gender1']=='F'){
      $gender1=2;
    }
      if($_POST['gender1']=='M'){
      $gender1=1;
    }
  
    $query="UPDATE products SET name='".$name1."',price='".$price1."',size='".$size1."',color='".$color1."',gender='".$gender1."' WHERE pro_id='".$id."'";
     if($query_run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT)){
      echo "<div class='try'>Product Updated!</div>";
     }
  }else{
    echo "Fill all fields";
  }
  }


    ?>


</body>