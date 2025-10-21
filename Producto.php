<?php
// Validacion del inicio de sesion
session_start();
if(!isset($_SESSION['nombre']) || !isset($_SESSION["clave"])){
 header("Location:Login.php");    
}
// 1. Incluimos el archivo que contiene la CLASE
require_once 'ConexionBDD.php';

// 2. CREAMOS UN OBJETO (instancia) de la clase
// Esto ejecuta el __construct() y se conecta a la BDD
$db = new ConexionBDD(); 

$producto = null; // Variable para guardar el producto encontrado

if(isset($_COOKIE["c_idioma"])){
    $idioma_actual = $_COOKIE["c_idioma"];
}else{
$idioma_actual = $_GET["idioma"]??'es';
}

// 3. Verificamos que tengamos un ID y un Idioma en la URL
if ( isset($_GET['id']) && is_numeric($_GET['id']) ) {
    
    $id_producto = $_GET['id'];
    
    // 4. LLAMAMOS AL MÉTODO para buscar UN producto
    // (Asegúrate de haber corregido este método en tu clase)
    $producto = $db->leerProductosPorId($id_producto, $idioma_actual);
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma_actual; ?>">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Producto</title>
</head>
<body>
    <p>
    <a href="PanelPrincipal.php?idioma=<?php echo $idioma_actual; ?>">
         &laquo; Volver a la lista</a> | 
    <a href="CerrarSesion.php">Cerrar Sesión</a></p>

    <hr>

    <?php
    // 6. Verificamos si la función encontró el producto
    if ($producto !== null) {
        
        // ¡SÍ! Mostramos el nombre...
        echo "<h1>" . $producto['nombreProducto'] . "</h1>";
        echo "<p>ID de referencia: " . $producto['idProducto'] . "</p>";
        
        // ...y aquí cargamos la IMAGEN (no el enlace)
        echo "<img 
                src='" . $producto['enlaceFoto'] . "' 
                alt='Imagen de " . $producto['nombreProducto'] . "' 
                width='300' 
              >";
        
    } else {
        // No... (sea porque no hay ID o el ID no existe)
        echo "<h1>Producto no encontrado</h1>";
        echo "<p>El ID solicitado no existe o no se especificó un idioma.</p>";
    }
    
    // 7. Cerramos la conexión
    $db->cerrarConexion();
    ?>

    <hr>

    <form action="CarroCompra.php" method="post">
       <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">
       <input type="hidden" name="nombreProducto" value="<?php echo $producto['nombreProducto']; ?>">
       <input type="hidden" name="enlaceFoto" value="<?php echo $producto['enlaceFoto']; ?>">
       <input type="hidden" name="idioma" value="<?php echo $_GET['idioma']; ?>">
       <button type="submit">Añadir al Carrito 🛒</button>
    </form>
    <br>
    <a href="CarroCompra.php?idioma=<?php echo $idioma_actual; ?>">Ver Carrito</a>
    

</body>
</html>