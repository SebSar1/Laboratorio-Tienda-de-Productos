<?php
// 1. Incluimos el archivo que contiene la CLASE
require_once 'ConexionBDD.php';

// 2. CREAMOS UN OBJETO (instancia) de la clase
// Al hacer "new", se ejecuta el __construct() y se conecta a la BDD
$db = new ConexionBDD(); 

// 3. Decidimos el idioma (esto ya lo tenías)
$idioma_actual = $_GET['lang'] ?? 'es'; 
?>

<p>
    <a href="PanelPrincipal.php?lang=es">Español</a> | 
    <a href="PanelPrincipal.php?lang=en">English</a>
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
        echo "<a href='Producto.php?id=" . $producto['idProducto'] . "&lang=" . $idioma_actual . "'>";
        echo $producto['nombreProducto'];
        echo "</a>";
        echo "</li>";
    }
    echo "</ul>";
}
    
$db->cerrarConexion();

?>