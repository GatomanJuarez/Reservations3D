<?php
$IDENTIFICADOR= $_GET["identificador"];
$SEPARADAS = explode (',', $IDENTIFICADOR);
foreach ($SEPARADAS as $imprimir){
    //echo $imprimir ."<br>"; 
}

$servidor = "localhost";
$usuario = "root";
$contra = "";
$bd = "reservations";

$conexion = new mysqli($servidor, $usuario, $contra, $bd);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
} else {
    session_start();
    $valor_sesion = $_SESSION["usuarioNombre"]; 
    //echo $valor_sesion;
    foreach ($SEPARADAS as $VALOR){
    $sql_insert = "UPDATE  datos SET estado = 1, usuario = \"".$valor_sesion."\" WHERE mesa = \"".$VALOR."\"" ;
    
    try {
        $alumnos_insert = $conexion->query($sql_insert);
        $sql_alumnos = "SELECT * FROM alumnos";
        $res_alumnos = $conexion->query($sql_alumnos);
        header('Location: obtener.php');
    } catch (Exception $e) {
        echo("Error al reservar. Lo sentimos");
    }
}
   
}
$conexion->close();