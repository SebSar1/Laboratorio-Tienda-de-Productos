<?php
// Validacion del inicio de sesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['nombre']) || !isset($_SESSION["clave"])){
 header("Location:Login.php");    
}
class ConexionBDD {
    private $host = 'localhost';
    private $usuario = 'root';
    private $clave = '';
    private $baseDeDatos = 'tienda';
     private $conexion;

     
        public function __construct() {
        $this->conexion = new mysqli(
            $this->host,
            $this->usuario,
            $this->clave,
            $this->baseDeDatos
        );
        if ($this->conexion->connect_errno) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }


    /**
    * Filtro de seguridad para obtener el nombre de la tabla
    * Esto previene Inyección SQL.
    */
    private function getTablaPorIdioma($idioma) {
       if ($idioma === 'en') {
           return 'productosen'; // Si es 'en', devuelve la tabla en inglés
       }
       // Si es 'es', o cualquier otra cosa, devuelve español por defecto
       return 'productoses'; 
    }
    // ####################
    // ## FUNCIONES CRUD ##
    // ####################

    /**
     * CREAR (Create)
     * Inserta un nuevo producto.
     */
    public function crearProducto($nombre, $enlace, $idioma) {
        $tabla = $this->getTablaPorIdioma($idioma); // <--Obtiene el nombre seguro de la tabla
        $query = "INSERT INTO $tabla (nombreProducto, enlaceFoto) VALUES (?, ?)";
        $sentencia = $this->conexion->prepare($query); //prepara el script y se queda esperando los "ingredientes" ? ?
        $sentencia->bind_param("ss", $nombre, $enlace); // vincula los ingredientes a la receta $nombre y $enlace, ss es que son dos strings

        if ($sentencia->execute()) {
        echo "Producto creado con éxito.<br>";
        return $this->conexion->insert_id; // Devolvemos el ID por si se necesita
         } else {
        echo "Error al crear el registro.<br>";
        return false;
    }
    }

    /**
     * LEER (Read)
     * Lee y muestra todos los productos.
     */
    public function leerProductos( $idioma) {
        $tabla = $this->getTablaPorIdioma($idioma); // <--Obtiene el nombre seguro de la tabla

        $query = "SELECT idProducto, nombreProducto FROM $tabla"; //pregunta a bdd
        $canal = $this->conexion->query($query); // $canal es un paquete que tiene los datos dentro
                                            // $this->conexion-->query($query) pasa la pregunta a la bdd
        $productos = [];

        if ($canal->num_rows === 0) {
            echo "No existen registros.<br>";
        } else {
            while ($producto = $canal->fetch_assoc()) {
                $productos[] = $producto;

            }
        }
        return $productos;
    }

    /**
     * ACTUALIZAR (Update)
     * Actualiza el nombre y foto de un producto.
     */
    public function actualizarProducto( $id, $nuevoNombre, $nuevoEnlace, $idioma) {
        $tabla = $this->getTablaPorIdioma($idioma); // <--Obtiene el nombre seguro de la tabla

        $query = "UPDATE $tabla SET nombreProducto = ?, enlaceFoto = ? WHERE idProducto = ?";
        $sentencia = $this->conexion->prepare($query);
        // CAMBIO: "ssi" (string, string, integer)
        $sentencia->bind_param("ssi", $nuevoNombre, $nuevoEnlace, $id);

        if ($sentencia->execute()) {
            echo "Producto actualizado con éxito.<br>";
        } else {
            echo "Error al actualizar el registro: " . $sentencia->error . "<br>";
        }
    }

    /**
 * OBTENER POR ID (Read Single)
 * Busca y devuelve un solo producto usando su ID.
 */
    public function leerProductosPorId($id, $idioma) {
        $tabla = $this->getTablaPorIdioma($idioma); // <--Obtiene el nombre seguro de la tabla

        $query = "SELECT  * FROM $tabla WHERE idProducto = ?"; //pregunta a bdd
        $sentencia = $this->conexion->prepare($query);
        $sentencia->bind_param("i", $id);
    
         if ($sentencia->execute()) {
         $resultado = $sentencia->get_result();
            if ($resultado->num_rows === 1) {
            return $resultado->fetch_assoc(); 
        }
        }
    return null; 
}
public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>