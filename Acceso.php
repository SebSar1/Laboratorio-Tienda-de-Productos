<?php
// Siempre asegurarse de que el motor esta encendido
session_start(); 

$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$recordarme =  isset( $_POST["chkRecordarme"] );

if($_POST["nombre"] == "test" && $_POST["clave"] == "test123"){
    // Crear las sesiones
    $_SESSION["nombre"] = $_POST["nombre"];
    $_SESSION["clave"] = $_POST["clave"];
    header("Location: PanelPrincipal.php");
}else{
    header("Location: Login.php");
}

if ($recordarme){
    //Seteo las cookies
    setcookie("c_nombre", $nombre, 0);
    setcookie("c_clave", $clave, 0);
    setcookie("c_recordarme", $recordarme, 0);
}else{
    //Borro cualquier Cookie que exista
    if (isset($_COOKIE)){
        foreach($_COOKIE as $name => $value){
            setcookie($name, '', 1);
        }
    }
}

?>