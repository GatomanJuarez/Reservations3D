<?php
 session_start();
 $valor_sesion = $_SESSION["oracionsao"]; 
 foreach($valor_sesion as $vv){
     echo $vv."<br>";
 }
 ?>