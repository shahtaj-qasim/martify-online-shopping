<?php

class LoginMethods {

function VerifyLoginCus($user_c, $pass_c)
{
    require 'connect.inc.php';
    require 'core.inc.php';
    $connect= new DbConnection();
    $mysqlcon=$connect->DbConnection();
    $query="select username,pass,cust_id from customer where username='".$user_c."' AND pass='".$pass_c."' ";
        
        if($query_run=mysqli_query($mysqlcon,$query)){
            
            $num_rows=mysqli_num_rows($query_run);
            if($num_rows==0){
                echo "Invalid username/password";
            }else if($num_rows==1){

                while($row=mysqli_fetch_assoc($query_run)){
                    $cust_id=$row['cust_id'];
                    
                    $_SESSION['cust_id']=$cust_id;
                    
                   header('LOCATION: index.php');
                }
            }
        }
    else{
        echo "Please fill all the fields";
    }
    }
     
function VerifyLoginRet($user_r, $pass_r){
     require'connect.inc.php';
    require 'core.inc.php';
    $connect= new DbConnection();
    $mysqlcon=$connect->DbConnection();
     $query="select username,pass,ret_id from retailer where username='".$user_r."' AND pass='".$pass_r."' ";
        if($query_run=mysqli_query($mysqlcon,$query)){
            
            $num_rows=mysqli_num_rows($query_run);
            if($num_rows==0){
                echo "Invalid username/password";
            }else if($num_rows==1){

                while($row=mysqli_fetch_assoc($query_run)){
                    $ret_id=$row['ret_id'];
                    
                    $_SESSION['ret_id']=$ret_id;

                   
                   header('LOCATION: retailer.php');
                }
            }
        }
    else{
        echo "Please fill all the fields";
    }
}
    
}


?>