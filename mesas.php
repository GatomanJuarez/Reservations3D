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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>3D with WebGL</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        #html{
            background-color: #26c6da;

        }
        
        #usuario{
            text-aling: left;
        }
        
        .table{
            width: 80%;
        }
    </style>
</head>

<body>
    <div id="container"></div>
    <div id="html">
        <center>
            
    <img src="pictures/logo.jpg" width="150">
    <div id="usuario" style="font-weight: bold;">
    <?php
    session_start();
    echo  "Hola a: ".$_SESSION['usuarioNombre'] ;
    ?>
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
    </div>
    </center>
    </div>
    <script src="JS/three.min.js"></script>
    <script src="JS/physi.js"></script>
    <script src="js/TrackballControls.js"></script>
    <script src="JS/threex.domevents.js"></script>

    <script>
        Physijs.scripts.worker = 'JS/physijs_worker.js';
        Physijs.scripts.ammo = 'ammo.js';
        var camera, controls, silla, silla_material, scene, renderer, ground_material, ground, mesa, mesa_material;
        var domEvents, silla_material_alt, setMousePosition, object, mouse_position;
        var posicionX, posicionY = 6,
            posicionZ, rotacionY, identificadorSilla;
        var posicionXMesa, posicionZMesa, posicionYMesa;
        posicionXValor = [-25, -45, -35, -45, -25, -35, -17, -17, -17, -57, -57, -57, 35, 25, 45, 25, 45, 35, 55, 55, 55, 15, 15, 15];
        posicionZValor = [5, 5, 5, 55, 55, 55, 30, 20, 40, 20, 40, 30, 5, 5, 5, 55, 55, 55, 30, 20, 40, 20, 40, 30];
        rotacionYValor = [0, 0, 0, 185.35, 185.35, 185.35, -190.1, -190.1, -190.1, 190.1, 190.1, 190.1, 0, 0, 0, 185.35, 185.35, 185.35, -190.1, -190.1, -190.1, 190.1, 190.1, 190.1];
        identificadorSillaValor = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        posicionYMesaValor = [6, 6];
        posicionXMesaValor = [-37, 35];
        posicionZMesaValor = [30, 30];
        identificadoVector = [];
        ponerSilla = [];
        var reservadoSilla1, reservadoSilla2, reservadoSilla3, reservadoSilla4, reservadoSilla5, reservadoSilla6;
        var reservadoSilla7, reservadoSilla8, reservadoSilla9, reservadoSilla10, reservadoSilla11, reservadoSilla12;
        var reservadoSilla13, reservadoSilla14, reservadoSilla15, reservadoSilla16, reservadoSilla17, reservadoSilla18;
        var reservadoSilla19, reservadoSilla20, reservadoSilla21, reservadoSilla22, reservadoSilla23, reservadoSilla24;

        function guardarReservaciones(){
            var mensaje3 = confirm("¿Deseas guardar tus reservaciones?");
                    if (mensaje3) {
                        location.href = "guardar.php?identificador=" + identificadoVector;
                    }
        }

        function leeArchivo1(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla1 = Texto;
                        ponerSilla[0] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo2(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla2 = Texto;
                        ponerSilla[1] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo3(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla3 = Texto;
                        ponerSilla[2] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo4(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla4 = Texto;
                        ponerSilla[3] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo5(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla5 = Texto;
                        ponerSilla[4] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo6(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla6 = Texto;
                        ponerSilla[5] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo7(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla7 = Texto;
                        ponerSilla[6] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo8(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla8 = Texto;
                        ponerSilla[7] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo9(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla9 = Texto;
                        ponerSilla[8] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo10(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla10 = Texto;
                        ponerSilla[9] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo11(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla11 = Texto;
                        ponerSilla[10] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo12(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla12 = Texto;
                        ponerSilla[11] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo13(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla13 = Texto;
                        ponerSilla[12] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo14(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla14 = Texto;
                        ponerSilla[13] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo15(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla15 = Texto;
                        ponerSilla[14] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo16(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla16 = Texto;
                        ponerSilla[15] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo17(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla17 = Texto;
                        ponerSilla[16] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo18(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla18 = Texto;
                        ponerSilla[17] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo19(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla19 = Texto;
                        ponerSilla[18] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo20(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla20 = Texto;
                        ponerSilla[19] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo21(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla21 = Texto;
                        ponerSilla[20] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo22(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla22 = Texto;
                        ponerSilla[21] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo23(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla23 = Texto;
                        ponerSilla[22] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        function leeArchivo24(file) {
            var archivo = new XMLHttpRequest();
            archivo.open("GET", file, false);
            archivo.onreadystatechange = function() {
                if (archivo.readyState === 4) {
                    if (archivo.status === 200 || archivo.status == 0) {
                        var Texto = archivo.responseText;
                        //alert(Texto);
                        reservadoSilla24 = Texto;
                        ponerSilla[23] = Texto;
                    }
                }
            }
            archivo.send(null);
        }

        init = function() {
            leeArchivo1("txt/reservados1.txt");
            leeArchivo2("txt/reservados2.txt");
            leeArchivo3("txt/reservados3.txt");
            leeArchivo4("txt/reservados4.txt");
            leeArchivo5("txt/reservados5.txt");
            leeArchivo6("txt/reservados6.txt");
            leeArchivo7("txt/reservados7.txt");
            leeArchivo8("txt/reservados8.txt");
            leeArchivo9("txt/reservados9.txt");
            leeArchivo10("txt/reservados10.txt");
            leeArchivo11("txt/reservados11.txt");
            leeArchivo12("txt/reservados12.txt");
            leeArchivo13("txt/reservados13.txt");
            leeArchivo14("txt/reservados14.txt");
            leeArchivo15("txt/reservados15.txt");
            leeArchivo16("txt/reservados16.txt");
            leeArchivo17("txt/reservados17.txt");
            leeArchivo18("txt/reservados18.txt");
            leeArchivo19("txt/reservados19.txt");
            leeArchivo20("txt/reservados20.txt");
            leeArchivo21("txt/reservados21.txt");
            leeArchivo22("txt/reservados22.txt");
            leeArchivo23("txt/reservados23.txt");
            leeArchivo24("txt/reservados24.txt");
            
            var container = document.getElementById('container');
            camera = new THREE.PerspectiveCamera(
                15,
                window.innerWidth / window.innerHeight,
                1,
                1000
            );


            scene = new Physijs.Scene();
            scene.setGravity(new THREE.Vector3(0, -30, 0));
            scene.addEventListener(
                'update',
                function() {
                    //applyForce();
                    controls.update();
                    scene.simulate(undefined, 1);
                }
            );


            var light;
            var ambientLight = new THREE.AmbientLight(0xcccccc, 0.4);
            scene.add(ambientLight);

            var material = new THREE.MeshBasicMaterial({
                color: 0xffaa00,
                wireframe: true
            });


            renderer = new THREE.WebGLRenderer({
                antialias: true
            });

            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);

            domEvents = new THREEx.DomEvents(camera, renderer.domElement);

            container.appendChild(renderer.domElement);

            controls = new THREE.TrackballControls(camera, container);
            controls.rotateSpeed = 4.0;
            controls.zoomSpeed = 4.2;
            controls.panSpeed = 4.8;

            controls.noZoom = false;
            controls.noPan = false;

            controls.staticMoving = true;
            controls.dynamicDampingFactor = 0.3;

            controls.key = [65, 83, 68];

            camera.position.set(5, 90, 300);
            camera.lookAt(scene.position);
            scene.add(camera);

            ground_material = Physijs.createMaterial(
                new THREE.MeshLambertMaterial({
                    map: new THREE.TextureLoader().load('TEXTURES/floor.jpg')
                }),
                0.8, //Friccion
                0.4 //Restitucion
            );

            ground_material.map.wrapS = ground_material.map.wrapT = THREE.RepeatWrapping;
            ground_material.map.repeat.set(3, 3);

            silla_material = new Physijs.createMaterial(
                new THREE.MeshLambertMaterial({
                    map: new THREE.TextureLoader().load('TEXTURES/madera.jpg'),
                }),
                .6,
                .2
            );
            silla_material.map.wrapS = silla_material.map.wrapT = THREE.RepeatWrapping;
            silla_material.map.repeat.set(0.25, 0.25);

            silla_material_alt = new Physijs.createMaterial(
                new THREE.MeshLambertMaterial({
                    map: new THREE.TextureLoader().load('TEXTURES/madera2.jpg'),
                }),
                .6,
                .2
            );
            silla_material_alt.map.wrapS = silla_material_alt.map.wrapT = THREE.RepeatWrapping;
            silla_material_alt.map.repeat.set(0.25, 0.25);

            ground = new Physijs.BoxMesh(
                new THREE.BoxGeometry(400, 2, 600),
                ground_material,
                0
            );

            ground.receiveShadow = true;
            scene.add(ground);

            mesa_material = new Physijs.createMaterial(
                new THREE.MeshLambertMaterial({
                    map: new THREE.TextureLoader().load('TEXTURES/madera.jpg'),
                }),
                .6,
                .2
            );
            mesa_material.map.wrapS = mesa_material.map.wrapT = THREE.RepeatWrapping;
            mesa_material.map.repeat.set(0.25, 0.25);
            ////////////////////////////////////////////////////////////////////////////////
            console.log(ponerSilla[20] );
            for (var aux = 0; aux < posicionXValor.length; aux++) {
                if(reservadoSilla1 == 1 && aux == 0){}
                else if(reservadoSilla2 == 1 && aux == 1){}
                else if(reservadoSilla3 == 1 && aux == 2){}
                else if(reservadoSilla4 == 1 && aux == 3){}
                else if(reservadoSilla5 == 1 && aux == 4){}
                else if(reservadoSilla6 == 1 && aux == 5){}
                else if(reservadoSilla7 == 1 && aux == 6){}
                else if(reservadoSilla8 == 1 && aux == 7){}
                else if(reservadoSilla9 == 1 && aux == 8){}
                else if(reservadoSilla10 == 1 && aux == 9){}
                else if(reservadoSilla11 == 1 && aux == 10){}
                else if(reservadoSilla12 == 1 && aux == 11){}
                else if(reservadoSilla13 == 1 && aux == 12){}
                else if(reservadoSilla14 == 1 && aux == 13){}
                else if(reservadoSilla15 == 1 && aux == 14){}
                else if(reservadoSilla16 == 1 && aux == 15){}
                else if(reservadoSilla17 == 1 && aux == 16){}
                else if(reservadoSilla18 == 1 && aux == 17){}
                else if(reservadoSilla19 == 1 && aux == 18){}
                else if(reservadoSilla20 == 1 && aux == 19){}
                else if(reservadoSilla21 == 1 && aux == 20){}
                else if(reservadoSilla22 == 1 && aux == 21){}
                else if(reservadoSilla23 == 1 && aux == 22){}
                else if(reservadoSilla24 == 1 && aux == 23){}

               else{
                    posicionX = posicionXValor[aux];
                    posicionZ = posicionZValor[aux];
                    rotacionY = rotacionYValor[aux];
                    identificadorSilla = identificadorSillaValor[aux];
                    construirSilla();
               }
            }
            for (var aux = 0; aux < posicionXMesaValor.length; aux++) {
                posicionXMesa = posicionXMesaValor[aux];
                posicionZMesa = posicionZMesaValor[aux];
                posicionYMesa = posicionYMesaValor[aux];
                construirMesa();
            }
            construirGuardado();
            ////////////////////////////////////////////////////////////////////////////////

            requestAnimationFrame(render);
            scene.simulate();
        }

        function render() {
            requestAnimationFrame(render);
            renderer.render(scene, camera);
        };

        construirMesa = (function() {
            var construirRespaldo, construirPatas, esamblar;

            construirRespaldo = function() {
                var respaldo, objeto;

                respaldo = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(30, 1, 30),
                    mesa_material
                );
                respaldo.position.y = 2;
                respaldo.position.z = 2.5;
                respaldo.castShadow = true;
                respaldo.receiveShadow = true;
                return respaldo;
            };

            construirPatas = function() {
                var pata, _pata;
                //atras izquierda
                pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(.1, .1, .1),
                    mesa_material
                );
                pata.position.x = .25;
                pata.position.z = 2.25;
                pata.position.y = -2.5;
                pata.castShadow = true;
                pata.receiveShadow = true;

                //atras derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(2, 9, 2),
                    mesa_material
                );
                _pata.position.x = 11;
                _pata.position.z = -11;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);


                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(2, 9, 2),
                    mesa_material
                );
                _pata.position.x = -11;
                _pata.position.z = -11;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente izqueirda
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(2, 9, 2),
                    mesa_material
                );

                _pata.position.z = 11;
                _pata.position.x = -11;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(2, 9, 2),
                    mesa_material
                );

                _pata.position.x = 11;
                _pata.position.z = 11;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                return pata;
            }

            ensamblar = function() {
                var mesa, respaldo, patas;

                //asiento
                mesa = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(.1, .1, .1),
                    mesa_material
                );
                mesa.castShadow = true;
                mesa.receiveShadow = true;

                //respaldo
                respaldo = construirRespaldo();
                mesa.add(respaldo);

                patas = construirPatas();
                mesa.add(patas);

                //Coloca la silla;
                mesa.position.y = 8;
                mesa.position.x = posicionXMesa;
                mesa.position.z = posicionZMesa;
                scene.add(mesa);
            };
            return ensamblar;
        })();
        //////////////////////////////////////////////////////
        construirGuardado = (function() {
            var construirRespaldo, construirPatas, esamblar;

            construirRespaldo = function() {
                var respaldo, objeto;

                respaldo = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(20, 1, 10),
                    mesa_material
                );
                respaldo.position.y = 2;
                respaldo.position.z = 2.5;
                respaldo.castShadow = true;
                respaldo.receiveShadow = true;
                return respaldo;
            };

            construirPatas = function() {
                var pata, _pata;
                //atras izquierda
                pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(.1, .1, .1),
                    mesa_material
                );
                pata.position.x = 2.25;
                pata.position.z = 2.25;
                pata.position.y = -2.5;
                pata.castShadow = true;
                pata.receiveShadow = true;

                //atras derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 9, 1),
                    mesa_material
                );
                _pata.position.x = 5.2;
                _pata.position.z = -2;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);


                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 9, 1),
                    mesa_material
                );
                _pata.position.x = -9.2;
                _pata.position.z = -2;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente izqueirda
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 9, 1),
                    mesa_material
                );

                _pata.position.z = 4;
                _pata.position.x = -9;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 9, 1),
                    mesa_material
                );

                _pata.position.x = 5;
                _pata.position.z = 3;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                return pata;
            }

            ensamblar = function() {
                var mesa, respaldo, patas;

                //asiento
                mesa = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(.1, .1, .1),
                    mesa_material
                );
                mesa.castShadow = true;
                mesa.receiveShadow = true;

                //respaldo
                respaldo = construirRespaldo();
                mesa.add(respaldo);

                patas = construirPatas();
                mesa.add(patas);

                //Coloca la silla;
                mesa.position.y = 8;
                mesa.position.x = 0;
                mesa.position.z = 100;
                scene.add(mesa);
                domEvents.addEventListener(mesa, 'click', function(event) {
                    console.log(mesa);
                    var mensaje2 = confirm("¿Deseas guardar tus reservaciones?");
                    if (mensaje2) {
                        location.href = "guardar.php?identificador=" + identificadoVector;
                    }
                }, false)
            };

            return ensamblar;
        })();

        ////////////////////////////////////////////////////////////////////
        construirSilla = (function() {
            var construirRespaldo, construirPatas, esamblar;

            construirRespaldo = function() {
                var respaldo, objeto;

                respaldo = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(5, 1, 0.5),
                    silla_material
                );

                respaldo.position.y = 5;
                respaldo.position.z = -2.5;
                respaldo.castShadow = true;
                respaldo.receiveShadow = true;

                objeto = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 5, 0.5),
                    silla_material
                );

                objeto.position.y = -3;
                objeto.position.x = -2;
                objeto.castShadow = true;
                objeto.receiveShadow = true;
                respaldo.add(objeto);

                objeto = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 5, 0.5),
                    silla_material
                );

                objeto.position.y = -3;
                objeto.position.x = 2;
                objeto.castShadow = true;
                objeto.receiveShadow = true;
                respaldo.add(objeto);

                objeto = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(1, 5, 0.5),
                    silla_material
                );

                objeto.position.y = -3;
                objeto.position.x = 0;
                objeto.castShadow = true;
                objeto.receiveShadow = true;
                respaldo.add(objeto);

                return respaldo;
            };

            construirPatas = function() {
                var pata, _pata;

                //atras izquierda
                pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(0.5, 4, 0.5),
                    silla_material
                );
                pata.position.x = 2.25;
                pata.position.z = -2.25;
                pata.position.y = -2.5;
                pata.castShadow = true;
                pata.receiveShadow = true;

                //atras derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(0.5, 4, 0.5),
                    silla_material
                );
                _pata.position.x = -4.5;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente izqueirda
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(0.5, 4, 0.5),
                    silla_material
                );

                _pata.position.z = 4.5;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                //enfrente derecha
                _pata = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(0.5, 4, 0.5),
                    silla_material
                );

                _pata.position.x = -4.5;
                _pata.position.z = 4.5;
                _pata.castShadow = true;
                _pata.receiveShadow = true;
                pata.add(_pata);

                return pata;
            }

            ensamblar = function() {
                var silla, respaldo, patas;

                //asiento
                silla = new Physijs.BoxMesh(
                    new THREE.BoxGeometry(5, 1, 5),
                    silla_material
                );
                silla.castShadow = true;
                silla.receiveShadow = true;

                //respaldo
                respaldo = construirRespaldo();
                silla.add(respaldo);

                patas = construirPatas();
                silla.add(patas);

                //Coloca la silla;
                silla.position.y = posicionY;
                silla.position.x = posicionX;
                silla.position.z = posicionZ;
                silla.rotation.y = rotacionY;
                silla.identificador = identificadorSilla;
                scene.add(silla);




                domEvents.addEventListener(silla, 'click', function(event) {
                    console.log(silla);
                    var mensaje = confirm("¿Deseas reservar este lugar?");
                    if (mensaje) {
                        cambiarMaterial(silla);
                        identificadoVector.push(silla.identificador);
                        //console.log(identificadoVector[identificadoVector.length-1]);
                        //console.log(identificadoVector[0] + " " +identificadoVector[2]);
                    }
                }, false)
            };

            cambiarMaterial = function(objeto) {
                objeto.material = silla_material_alt;
                objeto.material.needsUptade = true;

                if (objeto.children.length > 0) {
                    objeto.children.forEach(function(hijo) {
                        cambiarMaterial(hijo);
                    });
                }
            };


            return ensamblar;
        })();


        window.onload = init;

    </script>
</body>

</html>
