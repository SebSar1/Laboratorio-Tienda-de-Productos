<?php
// Iniciar sesión para guardar el carrito
session_start();
if(!isset($_SESSION['nombre']) || !isset($_SESSION["clave"])){
 header("Location:Login.php");    
}

//Si se envio un producto desde producto.php Este producto se manda como POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProducto'])) {
    $producto = [
        'id' => $_POST['idProducto'],
        'nombre' => $_POST['nombreProducto'],
        'imagen' => $_POST['enlaceFoto']
    ];

    // Si no existe el carrito, lo creamos
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agregamos el producto al carrito
    $_SESSION['carrito'][] = $producto;
     //Redirigir al mismo archivo (evita reenvío del formulario)
    header("Location: CarroCompra.php");
    exit;
}

// Eliminar producto individual
if (isset($_GET['eliminar'])) {
    $indice = $_GET['eliminar'];
    unset($_SESSION['carrito'][$indice]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reordenar índices
}

// Vaciar carrito completo
if (isset($_GET['vaciar'])) {
    unset($_SESSION['carrito']);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <p><a href="PanelPrincipal.php">Panel Principal</a> |  
       <a href="CerrarSesion.php">Cerrar Sesión</a></p>
    <hr>

    <?php
    
    // Mostrar el carrito
    if (empty($_SESSION['carrito'])) {
        echo "<p>Tu carrito está vacío</p>";
    } else {
        echo "<ul>";
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            echo "<li>";
            echo "<img src='" . $producto['imagen'] . "' width='60' alt=''>";
            echo " " . htmlspecialchars($producto['nombre']);
            echo " <a href='?eliminar=$indice'>(Eliminar)</a>";
            echo "</li>";
        }
        echo "</ul>";
        echo "<a href='?vaciar=1'>Vaciar carrito</a>";
    }
    ?>
</body>
</html>
