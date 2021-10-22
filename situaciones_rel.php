<?php

require_once("controladores/controlador.php");

$txt = "";
$sql = "SELECT * FROM situaciones";
$situaciones = json_decode(controlador::select($sql), true);
var_dump($situaciones);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacion de Situaciones</title>
    <script>
        function fInicio() {

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
                //$txt="<tr><td>";
                $txt .= "<tr><td>" . $value['sit_id'] . "</td><td>" . $value['sit_nombre'] . "</td>";
                $txt .= "<td><input type='submit' value='MODIFICAR'><input type='submit' value='ELIMINAR'></tr>";
            }
            echo $txt;
            ?>

        </table>
        <div class="div_insertar">
            <input type="submit" value='AÑADIR SITUACION'>
        </div>
        </form>
    </div>
</body>

</html>