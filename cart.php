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
	<title></title>
	   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/cart.css">
<script>
function goback() {
    window.history.back();
}
</script>
<style type="text/css">
  table{
    position: relative;

    
  }
  footer{

bottom: -5vw;
  }
  .tot p{
   bottom: -5vw; 
  }
</style>
</head>
<body>
<style>
 
</style>

</body>
</html>

<?php

if(loggedin_cust()){
echo '<div class="name">';
$first=getuser('f_name');
$last=getuser('l_name');
   echo $first.' '.$last.'<a href="logout.php">Log out</a><br></div>';
}
?>
<?php

if(loggedin_cust()){
if(isset($_GET['add']) && !empty($_GET['add'])){
  $id=$_GET['add'];
  $q=mysqli_query($mysqlcon, "SELECT pro_id, quantity from products where pro_id='".$id."' and quantity>0", MYSQLI_STORE_RESULT);
  while($quantity=@mysqli_fetch_assoc($q)){
    if($quantity['quantity']!= @$_SESSION['cart_'.$id]){
      @$_SESSION['cart_'.$id]+=1;
    }
    //echo @$_SESSION['cart_'.$id]+=1; //user cannot add more quantity than given in database
       $query=mysqli_query($mysqlcon, "UPDATE products set quantity=quantity-1 where pro_id='".$id."' and quantity>0", MYSQLI_STORE_RESULT);
       while($quantity=@mysqli_fetch_assoc($query)){
         $quantity= $query_row['quantity'];
       
    //$quantity= $query_row['quantity']--;
  

}
}
}
if(isset($_GET['remove'])){
 $id=$_GET['remove'];
  $query=mysqli_query($mysqlcon, "UPDATE products set quantity=quantity+1 where pro_id='".$id."' and quantity>0", MYSQLI_STORE_RESULT);
  $_SESSION['cart_'.$_GET['remove']]--;
}

  $num=0;
  foreach ($_SESSION as $name => $value) {
     //echo $name.' '.$value.'<br/>';  //cart_1 1 value me quantity hai
    global $mysqlcon;
    $total=0;
     if($value>0){
      if(substr($name, 0,5)=='cart_'){
        $id=@substr($name, 5,(strlen($name-5)));
        $q=mysqli_query($mysqlcon, "SELECT pro_id, name,quantity,price from products where pro_id='".$id."'", MYSQLI_STORE_RESULT);
        while($get_row=mysqli_fetch_assoc($q)){
          $num++;
          echo '<input type="hidden" name="item_number_'.$num.'" value="'.$id.'">';
           echo '<input type="hidden" name="item_name_'.$num.'" value="'.$get_row['name'].'">';
            echo '<input type="hidden" name="amount_'.$num.'" value="'.$get_row['price'].'">';
            echo '<input type="hidden" name="quantity_'.$num.'" value="'.$get_row['quantity'].'">';
        }
      }
    }
  }

  $net_payment=0;
  echo'<button id="back" onclick="goback()"><footer><img src="back.png"/></button>';
 echo' <table class="table table-condensed"><thead><tr><th>Image</th><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th><thead>';
  foreach ($_SESSION as $name => $value) {
     //echo $name.' '.$value.'<br/>';  //cart_1 1 value me quantity hai
    global $mysqlcon;
    $total=0;
     if($value>0){
      if(substr($name, 0,5)=='cart_'){
        $id=@substr($name, 5,(strlen($name-5)));
        $q=mysqli_query($mysqlcon, "SELECT pro_id,pro_image, name,quantity,price from products where pro_id='".$id."'", MYSQLI_STORE_RESULT);
        while($get=mysqli_fetch_assoc($q)){
          $total=$value* $get['price'];
          
    
          echo '<tbody><tr><td><img class="img-responsive" width="80" height="50" src="data:picture/jpeg;base64,'.base64_encode( $get['pro_image'] ).'"/></td><td>'.$get['name'].' </td> <td>'.$value. ' </td> <td>'.$get['price'].'</td><td> '.$total.'</td><td><a href="cart.php?add='.$id.'"> [+]</a></td><td><a href="cart.php?remove='.$id.'"> [-]    </a></td></tr></tbody></br></br>';
        }
              }
             $net_payment+=$total;


     }
  }
  if($net_payment==0){
    echo '<div class="tot">Your cart is empty. Please add an item.</div>';
  } else{
    echo  '<div class="tot"><p>Your total is: '.$net_payment.'<a href="checkout.php">Checkout</a></p></div></footer>';
  }
} else{
	echo '<div class="log">Please <a href="login.php">Login</a> or <a href="register.php">Register</a> to add in cart.</div>';
}

?>