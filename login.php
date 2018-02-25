<?php
$CLAVE = $_POST["clave"];
$USUARIO = $_POST["usuario"];
$servidor = "localhost";
$usuario = "root";
$contra = "";
$bd = "reservations";

// Creando la conexion a la bd
$conexion = new mysqli($servidor, $usuario, $contra, $bd);
$conexion->set_charset("utf8");
// Checando la conexion
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}else{
    $sql_alumnos = "SELECT * FROM usuarios WHERE usuario =\"".$USUARIO."\" and clave = \"".$CLAVE."\"";
    $res_alumnos = $conexion->query($sql_alumnos);
    $usuario = mysqli_fetch_array($res_alumnos);
    session_start();
    $_SESSION['usuarioNombre']  = ($usuario[1]);

    if ($res_alumnos->num_rows > 0) {
        header('Location: obtener.php');
    } else {
        echo "¡Tu Clave de Acceso es inválida!";
        header('Location: error.html');
    }

    $conexion->close();
}
