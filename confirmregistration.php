<?php
$passkey=$_GET['passkey'];
$userid=$_GET['userid'];
$query  ="SELECT * FROM temp_verification WHERE passkey ='$passkey'";

$mysqlhost='localhost';
$mysqluser='id1519032_shahtaj';
$mysqlpass='blackparade7';
 $mysqlcon=mysqli_connect($mysqlhost,$mysqluser,$mysqlpass,'id1519032_martify') or die('Could not connect');

$result=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);

if($result){

$count=mysqli_num_rows($result);

if($count==1)
{
$query="SELECT brand_name FROM temp_verification where passkey='$passkey'";
$result==mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
if($userid=="cust")
{
$query="SELECT * from temp_verification where passkey='$passkey'";
    $result=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
    $row=mysqli_fetch_row($result);
     $query="INSERT INTO customer VALUES ('', '".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."','".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."','".''."')";
     $run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
    $query="DELETE FROM temp_verification WHERE code = '$passkey'";
    $run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);  
}
else
{ $query="SELECT * from temp_verification where passkey='$passkey'";
    $result=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
    $row=mysqli_fetch_row($result);
    $n='NULL';
     $query="INSERT INTO retailer VALUES ('', '".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."','".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."','".$row[10]."','".''."')";
    $run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
    $query="DELETE FROM temp_verification WHERE code = '$passkey'";
    $run=mysqli_query($mysqlcon,$query, MYSQLI_STORE_RESULT);
 }

}
}

else {
echo "Wrong Confirmation code";
}
    
?>