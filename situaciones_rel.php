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
        frm_modificar_situaciones{
            display: none;
        }
    </style>
    <script>
        function fInicio() {
            //document.getElementById ("div_form_situaciones").innerHTML="Hola1"; 
        }
        function fInsertarSituacion() {
            var nombre=document.getElementById("situacion").value;
            if (nombre=="") {
                alert("Campo vacio");
            } else {
                alert("Insertar: "+nombre);

            }
        }
        function fModificarSituacion() {
            var nombre=document.getElementById("situacion2").value;
            if (nombre=="") {
                alert("Campo vacio");
            } else {
                alert("Modificar: "+nombre);
            }
            
        }
        function fEliminarSituacion() {
            var nombre=document.getElementById("situacion").value;
            if (nombre=="") {
                alert("Campo vacio");
            } else {
                alert("Eliminar: "+nombre); 
            }
            
        }
        function fMostrarModificarSituacion(id,nombre){
            //document.querySelector ("#div_form_situaciones").innerHTML="Hola2"+id+"Nombre"+nombre; 
            document.getElementById("frm_modificar_situaciones").style.display="block";
            document.getElementById("etiq_frm_situaciones").innerHTML="Modificar nombre situacion: ";
            document.getElementById("situacion").disabled=true;
            document.getElementById("situacion").value=nombre;
            document.getElementById("multivalor").value="Modificar"; 
            document.getElementById("multivalor").removeEventListener("click",fEliminarSituacion);
            document.getElementById("multivalor").removeEventListener("click",fInsertarSituacion);
            document.getElementById("multivalor").addEventListener("click",fModificarSituacion);  
            document.getElementById("div_frm_situaciones").style.display="block";
            document.getElementById("situacion2").focus();
            
        }
        function fMostrarEliminarSituacion(id,nombre) {
            //document.getElementById ("div_form_situaciones").innerHTML="Hola3"+id+"Nombre"+nombre;
            document.getElementById("frm_modificar_situaciones").style.display="none";
            document.getElementById("etiq_frm_situaciones").innerHTML=" Eliminar  situacion: ";
            document.getElementById("situacion").disabled=true;
            document.getElementById("situacion").value=nombre;
            document.getElementById("multivalor").value="Eliminar";
            document.getElementById("multivalor").removeEventListener("click",fModificarSituacion);
            document.getElementById("multivalor").removeEventListener("click",fInsertarSituacion);
            document.getElementById("multivalor").addEventListener("click",fEliminarSituacion);
            document.getElementById("div_frm_situaciones").style.display="block";
        }

        function fMostrarInsertarSituacion() {
            document.getElementById("frm_modificar_situaciones").style.display="none";
            document.getElementById("etiq_frm_situaciones").innerHTML="Insertar situacion: ";
            document.getElementById("situacion").disabled=false;
            document.getElementById("situacion").value="";
            document.getElementById("situacion").focus();
            //document.getElementById("situacion2").placeholder="";
            document.getElementById("multivalor").value="Insertar ";
            document.getElementById("multivalor").removeEventListener("click",fEliminarSituacion);
            document.getElementById("multivalor").removeEventListener("click",fModificarSituacion);
            document.getElementById("multivalor").addEventListener("click",fInsertarSituacion);
            document.getElementById("div_frm_situaciones").style.display="block";
        }
        function fCancelarFrmSituacion() {
            document.getElementById("div_frm_situaciones").style.display="none";
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
                $txt .= "<td><input type='button' value='MODIFICAR' onclick='fMostrarModificarSituacion( \"$id\",\"$nombre\")' > ";
                $txt.="<input type='button' value='ELIMINAR' onclick='fMostrarEliminarSituacion(\"$id\",\"$nombre\")'></tr>";
            }
            echo $txt;
            ?>

        </table>
        <div class="div_insertar">
            <input type="button" value='AÑADIR SITUACION' onclick="fMostrarInsertarSituacion()">
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