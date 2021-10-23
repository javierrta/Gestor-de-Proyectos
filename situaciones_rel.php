<?php

require_once("controladores/controlador.php");

$txt = "";
$sql = "SELECT * FROM situaciones";
$situaciones = json_decode(controlador::select($sql), true);
//var_dump($situaciones);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacion de Situaciones</title>
    <style>
        .div_frm_situaciones{
            display: none;
        }
    </style>
    <script>
        function fInicio() {
            //document.getElementById ("div_form_situaciones").innerHTML="Hola1"; 
        }
        function fModificarSituacion(id,nombre){
            //document.querySelector ("#div_form_situaciones").innerHTML="Hola2"+id+"Nombre"+nombre; 
        }
        function fEliminarSituacion(id,nombre) {
            //document.getElementById ("div_form_situaciones").innerHTML="Hola3"+id+"Nombre"+nombre;
        }
        function fInsertarSituacion(nombre) {
            
        }
        function fMostrarFrmSituacion() {
            document.getElementById("div_frm_situaciones").style.display="block";
        }
    </script>
</head>

<body onload="fInicio()">
    <div class="div_rel_situaciones">
        <form action="situaciones_frm.php" method="get">
        <table class="tb_situaciones" border='1'>
            <tr>
                <th>ID </th>
                <th>NOMBRE</th>
                <th colspan='2'>ACCIONES</th>
            </tr>
            <?php
            $txt = "";
            foreach ($situaciones as $key => $value) {
                $id=$value['sit_id'];
                $nombre=$value['sit_nombre'];
                $txt .= "<tr><td>" . $value['sit_id'] . "</td><td>" . $value['sit_nombre'] . "</td>";
                $txt .= "<td><input type='button' value='MODIFICAR' onclick='fModificarSituacion( \"$id\",\"$nombre\")' > ";
                $txt.="<input type='button' value='ELIMINAR' onclick='fEliminarSituacion(\"$id\",\"$nombre\")'></tr>";
            }
            echo $txt;
            ?>

        </table>
        <div class="div_insertar">
            <input type="button" value='AÑADIR SITUACION' onclick="fMostrarFrmSituacion()">
        </div>
        </form>
    </div>
    <div id="div_form_situaciones" class="div_form_situaciones">
            <?php
                include_once("situaciones_frm.php");
            ?>
            
    </div>
</body>

</html>