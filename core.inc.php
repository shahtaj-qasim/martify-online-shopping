<?php
ob_start(); //Cannot modify header information
session_start();
$current_file= $_SERVER['SCRIPT_NAME'];
if(isset($_SERVER['HTTP_REFERER'])&& !empty($_SERVER['HTTP_REFERER'])){
$http_referer= $_SERVER['HTTP_REFERER'];
}
function loggedin_cust(){
    if(isset($_SESSION['cust_id']) && !empty($_SESSION['cust_id'])){
        return true;
    }else{
        return false;
    }
}
function loggedin_ret(){
   
     if(isset($_SESSION['ret_id']) && !empty($_SESSION['ret_id'])){
        return true;
    }else{
        return false;
    }
}
function getuserfield($field){
    global $mysqlcon;
    $query="SELECT $field from retailer where ret_id='".$_SESSION['ret_id']."'";
  
    if($query_run=mysqli_query($mysqlcon,$query,MYSQLI_STORE_RESULT)){
        while($row=mysqli_fetch_assoc($query_run)){
            $field=$row[$field];
            echo $field." ";
        }
    }
}
function getuser($field){
    
    global $mysqlcon;
    $query="SELECT $field from customer where cust_id='".$_SESSION['cust_id']."'";
  
    if($query_run=mysqli_query($mysqlcon,$query,MYSQLI_STORE_RESULT)){
        while($row=mysqli_fetch_assoc($query_run)){
            $field=$row[$field];
            echo $field." ";
        }
    }
}
?>