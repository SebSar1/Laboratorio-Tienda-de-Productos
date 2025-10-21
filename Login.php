<?php
$recuerdame = $nombre = $clave = false;

if ( isset( $_COOKIE["c_recordarme"]) && $_COOKIE["c_recordarme"]){
    $recuerdame = true;
    $nombre = $_COOKIE["c_nombre"];
    $clave = $_COOKIE["c_clave"]; 
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tienda de productos</title>
</head>
<body>
    <h1>Login</h1>
    <form action="Acceso.php" method="POST">
        <fieldset>
            Usuario: <br>
            <input type="text" name="nombre" value="<?php echo $nombre;?>"/><br>
            Clave: <br>
            <input type="password" name="clave" value="<?php echo $clave?>"/><br>
            <input type="checkbox" name="chkRecordarme" <?php echo ($recuerdame)?"checked":""  ?>>Recordar mis datos
            <br>
            <br>
            <input type="submit" value="Ingresar"/>
        </fieldset>
    </form>
</body>
</html>