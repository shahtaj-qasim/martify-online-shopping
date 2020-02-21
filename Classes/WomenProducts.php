<?php
class WomenProducts {
function GetWomenProducts(){
require'connect.inc.php';
$connect= new DbConnection();
$mysqlcon=$connect->DbConnection();
$query="SELECT name,price,size,color,pro_image,pro_id from products where gender=2";
if($query_run= mysqli_query($mysqlcon, $query, MYSQLI_STORE_RESULT)){
    if(mysqli_num_rows($query_run)==NULL){
                echo 'No result found';
            }
            else{
           
                return $query_run;
                
}                        
}
}
}
?>