<?php

//host 
define("HOST" , "localhost");

//dbname
define("DBNAME" , "forum");

//username
define("USER" , "root");

//password
define("PASS" , "");

$conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";", USER , PASS );

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if($conn == true){
//     echo "connected";
// }
// else{
//     echo "not connected";
// }