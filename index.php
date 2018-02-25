<?php
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
}
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8" />
        <title>Ingresar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>

    <body background="images/first.jpg">

        <div class="jumbotron boxlogin fullscreen">
            <center>
                <form method="POST" name="flogin" id="flogin" action="login.php" id="form-graduacion" autocomplete="off">
                    <img src="pictures/Puertaa2.png" alt="Puerta">
                    <input type="user" name="usuario" id="usuario" class="form-control" placeholder="Usuario" style="width: 80%" required>
                    <br>
                    <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" style="width: 80%" required>
                    <br>
                    <input type="submit" class="btn btn-success" value="Ingresar">
                    <br>
                    <br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Número de Mesa</th>
                                <th>Reservado por</th>
                            </tr>
                        </thead>
                        <?php foreach ($conexion->query('SELECT * from datos WHERE estado = 1') as $row){ // aca puedes hacer la consulta e iterarla con each. ?>
                        <tr>
                            <td>
                                <?php echo $row['mesa'] ?>
                            </td>
                            <td>
                                <?php echo $row['usuario'] ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                    </table>
            </center>
            </form>
        </div>
    </body>

    </html>
