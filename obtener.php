<?php
$servidor = "localhost";
$usuario = "root";
$contra = "";
$bd = "reservations";

// Creando la conexion a la bd
$conexion = new mysqli($servidor, $usuario, $contra, $bd);
$conexion->set_charset("utf8");
// Checando la conexion
file_put_contents('reservados.txt',"");
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
}else{
    $sql_alumnos = "SELECT * FROM datos ";
    $res_alumnos = $conexion->query($sql_alumnos);
    $estadoValor=array();
    while ($fila = mysqli_fetch_array($res_alumnos)){
        if($fila != NULL){
            $estado= $fila['estado']; 
            array_push($estadoValor, $estado);
            file_put_contents('txt/reservados.txt', $estado."\r\n", FILE_APPEND);
    }
}
file_put_contents('txt/reservados1.txt', $estadoValor[0]."\r\n");
file_put_contents('txt/reservados2.txt', $estadoValor[1]."\r\n");
file_put_contents('txt/reservados3.txt', $estadoValor[2]."\r\n");
file_put_contents('txt/reservados4.txt', $estadoValor[3]."\r\n");
file_put_contents('txt/reservados5.txt', $estadoValor[4]."\r\n");
file_put_contents('txt/reservados6.txt', $estadoValor[5]."\r\n");
file_put_contents('txt/reservados7.txt', $estadoValor[6]."\r\n");
file_put_contents('txt/reservados8.txt', $estadoValor[7]."\r\n");
file_put_contents('txt/reservados9.txt', $estadoValor[8]."\r\n");
file_put_contents('txt/reservados10.txt', $estadoValor[9]."\r\n");
file_put_contents('txt/reservados11.txt', $estadoValor[10]."\r\n");
file_put_contents('txt/reservados12.txt', $estadoValor[11]."\r\n");
file_put_contents('txt/reservados13.txt', $estadoValor[12]."\r\n");
file_put_contents('txt/reservados14.txt', $estadoValor[13]."\r\n");
file_put_contents('txt/reservados15.txt', $estadoValor[14]."\r\n");
file_put_contents('txt/reservados16.txt', $estadoValor[15]."\r\n");
file_put_contents('txt/reservados17.txt', $estadoValor[16]."\r\n");
file_put_contents('txt/reservados18.txt', $estadoValor[17]."\r\n");
file_put_contents('txt/reservados19.txt', $estadoValor[18]."\r\n");
file_put_contents('txt/reservados20.txt', $estadoValor[19]."\r\n");
file_put_contents('txt/reservados21.txt', $estadoValor[20]."\r\n");
file_put_contents('txt/reservados22.txt', $estadoValor[21]."\r\n");
file_put_contents('txt/reservados23.txt', $estadoValor[22]."\r\n");
file_put_contents('txt/reservados24.txt', $estadoValor[23]."\r\n");
}
$conexion->close();
var_dump($estadoValor);
header("location:mesas.php");
