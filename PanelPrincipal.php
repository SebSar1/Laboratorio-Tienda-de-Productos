<?php

session_start();

// 1. Incluimos el archivo que contiene la CLASE
require_once 'ConexionBDD.php';

// 2. CREAMOS UN OBJETO (instancia) de la clase
// Al hacer "new", se ejecuta el __construct() y se conecta a la BDD
$db = new ConexionBDD(); 

if (isset($_GET['idioma'])) {
    // usuario acaba de hacer clic en un enlace.
    $idioma_actual = $_GET['idioma'];
    
} elseif (isset($_COOKIE["c_idioma"])) {
    // No hizo clic, pero ya tenía una cookie.
    $idioma_actual = $_COOKIE["c_idioma"];
    
} else {
    // primera visita (no hay GET y no hay COOKIE).
    $idioma_actual = 'es';
}

if (isset($_COOKIE["c_recordarme"]) && $_COOKIE["c_recordarme"]){
    
    setcookie("c_idioma", $idioma_actual, 0);
}




?>

<p>
    <a href="PanelPrincipal.php?idioma=es">Español</a> | 
    <a href="PanelPrincipal.php?idioma=en">English</a>
</p>
<hr>

<?php
// 4. LLAMAMOS AL MÉTODO de nuestro objeto $db
// (Antes era: leerProductos($idioma_actual);)
$listaDeProductos = $db->leerProductos($idioma_actual);
    
// 5. Tu lógica de 'foreach' sigue EXACTAMENTE IGUAL.
// No necesita cambiar porque sigue recibiendo un array.
if (empty($listaDeProductos)) {
    echo "<p>No hay productos para mostrar.</p>";
} else {
    echo "<ul>";
    foreach ($listaDeProductos as $producto) {
        // Pasamos el ID y el idioma al detalle
        echo "<li>";
        echo "<a href='Producto.php?id=" . $producto['idProducto']."&idioma=" . $idioma_actual . "'>";
        echo $producto['nombreProducto'];
        echo "</a>";
        echo "</li>";
    }
    echo "</ul>";
}
    
$db->cerrarConexion();

?>
<hr>
    <a href="CerrarSesion.php">Cerrar Sesión</a> | <a href="CarroCompra.php?idioma=<?php echo $idioma_actual; ?>">Ver Carrito</a>
