<?php
$CLAVE = "root";
$USUARIO = "GatomanJuarez";
$servidor = "localhost";
$usuario = "root";
$contra = "";
$bd = "reservations";

// Creando la conexion a la bd
$conexion = new mysqli($servidor, $usuario, $contra, $bd);
$conexion->set_charset("utf8");
// Checando la conexion
session_start();
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}else{
    $sql_alumnos = "SELECT * FROM datos ";
    $res_alumnos = $conexion->query($sql_alumnos);
    while ($fila = mysqli_fetch_array($res_alumnos)){
        if($fila != NULL){
            $estado= $fila['estado']; 
            $oracion="";
            $estadoValor = array($estado);
            
            for($x =0;$x<sizeof($estadoValor);$x++){
              echo $estadoValor[$x]."<br> ";
              
             $oraciona = array( $estadoValor[$x]) ;
             
             
            }
    }
}
}
$valor_sesion = $_SESSION["usuarioNombre"]; 

$conexion->close();
for($x =0;$x<sizeof($oraciona);$x++){
    echo $oraciona[$x]."<br> ";
    
   
   
      $_SESSION["oracionsao"]  = $oraciona[$x];
      echo $_SESSION["oracionsao"] ;
   
   
  }
//header("location:mesas.php");