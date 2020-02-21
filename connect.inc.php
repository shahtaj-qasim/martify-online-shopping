<?php

class DbConnection {    
function DbConnection(){
$mysqlhost='localhost';
$mysqluser='root';
$mysqlpass='';
    
@$mysqlcon=mysqli_connect($mysqlhost,$mysqluser,$mysqlpass,'martify') or die('Could not connect');
mysqli_select_db($mysqlcon, 'martify') or die('No such database exists');
return $mysqlcon;
}
}
?>