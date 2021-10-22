<?php

require_once("controladores/controlador.php");
$txt = "";
$sql = "SELECT * FROM situaciones";
$situaciones = json_decode(controlador::select($sql), true);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situaciones FRM</title>
</head>

<body>

    <form action="" method="get">
        <label for="sesl_situaciones">Situacion</label>
        <select name="sel_situaciones" id="sel_situaciones">
            <?php
            $texto = "";
            for ($i = 0; $i < count($situaciones); $i++) {
                $id = $situaciones[$i]['sit_id'];
                $nombre = $situaciones[$i]['sit_nombre'];
                $texto .= "<option value=$id>$nombre</option>";
            }

            echo $texto;
            ?>

        </select>
            <input type="submit" value="Aceptar">
    </form>

</body>

</html>