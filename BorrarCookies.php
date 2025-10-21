<?php

if( $_GET["borrar"]== 1 && isset($_COOKIE)){
    //borro las cookies y navego hacia el login.php
    foreach($_COOKIE as $name => $value){
        setcookie($name, '', 1); 
    } 
}

header("Location: Login.php");

?>