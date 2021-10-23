<?php
require_once("controladores/controlador.php");
$t = "";
if (isset($_POST['modificar'])) {
    $accion_id = $_POST['modificar'];
    $sql = "SELECT * FROM acciones WHERE acc_id = $accion_id";
    $accion = json_decode(controlador::select($sql), true);
    $t = "<table class='frm_modificar'><form action='acciones_rel.php' method='POST'>";
    for ($i = 0; $i < count($accion); $i++) {
        $nombre = $accion[$i]["acc_nombre"];
        $f_r_ini = $accion[$i]["acc_fr_inicio"];
        $f_r_fin = $accion[$i]["acc_fr_fin"];
        $f_t_ini = $accion[$i]["acc_ft_inicio"];
        $f_t_fin = $accion[$i]["acc_ft_fin"];
        $usu_id = $accion[$i]["acc_usu_id"];
        $duracion = $accion[$i]["acc_duracion"];
        $situaciones_id = $accion[$i]["acc_sit_id"];
        $proyecto_id = $accion[$i]["acc_proy_id"];
        $observaciones = $accion[$i]["acc_obs"];
        $t .= "<tr><td><label>ID<input type='number' name='id' id='id' value='$accion_id' readonly></label></td>";
        $t .= "<td><label>Nombre<input type='text' name='accion' id='accion' value='$nombre'></label></td></tr>";
        $t .= "<tr><td><label>Fecha real inicio<input type='date' name='f_r_ini' id='f_r_ini' value='$f_r_ini'></label></td>";
        $t .= "<td><label>Fecha real fin<input type='date' name='f_r_fin' id='f_r_fin' value='$f_r_fin'></label></td></tr>";
        $t .= "<tr><td><label>Fecha teórica inicio<input type='date' name='f_t_ini' id='f_t_ini' value='$f_t_ini'></label></td>";
        $t .= "<td><label>Fecha teórica fin<input type='date' name='f_t_fin' id='f_t_fin' value='$f_t_fin'></label></td></tr>";
        $t .= "<tr><td><label>ID del usuario<input type='number' name='usu_id' id='usu_id' value='$usu_id' readonly></label></td>";
        $t .= "<td><label>Duración<input type='number' name='duracion' id='duracion' value='$duracion'></label></td></tr>";
        $t .= "<tr><td><label>ID situaciones<input type='number' name='id_sit' id='situaciones_id' value='$situaciones_id'></label></td>";
        $t .= "<td><label>ID del proyecto<input type='text' name='id_proy' id='proyecto_id' value='$proyecto_id'></label></td></tr>";
        $t .= "<tr><td colspan='2'><label>Observaciones<textarea name='obs' id='obs' cols='30' rows='10'>$observaciones</textarea></label></td></tr>";
        $t .= "<input type='hidden' name='modificado'>";
        $t .= "<tr><td class='btn_modificar' colspan='2'><input type='submit' value='Modificar'></td></tr>";
    }
    $t .= "</form></table>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario acciones</title>
    <style>
        label {
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 5px 40px;
            text-transform: uppercase;
            font-weight: bolder;
        }
        table input[type=text], table input[type=date], table input[type=number]{
            padding: 2px 8px;
            font-size: 14px;
            text-align: center;
        }
        .btn_modificar {
            text-align: center;
        }
        table input[type=submit] {
            width: 85%;
            background-color: hsl(9, 100%, 64%);
            border: none;
            box-shadow: 0 2px 2px rgb(0 0 0 / 0.2);
            color: white;
            padding: 8px 10px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.25s ease;
        }
        table input[type=submit]:hover {
            background-color: hsl(9, 100%, 60%);
            box-shadow: none;
            transform: translate(0, 2px);
            transition: 0.25s ease;
        }
    </style>        
</head>

<body>
    <?php
    echo $t;

    // if (isset($_POST['agregar'])) {
    ?>
        <!-- <form action="acciones_rel.php" method="POST">
            <label for="accion">Acción</label>
            <input type="text" name="accion" id="accion">
            <label for="fecha_real_inicio">Fecha real inicio</label>
            <input type="date" name="f_r_ini" id="fecha_real_inicio">
            <label for="fecha_real_fin">Fecha real fin</label>
            <input type="date" name="f_r_fin" id="fecha_real_fin">
            <label for="fecha_teorica_inicio">Fecha teórica inicio</label>
            <input type="date" name="f_t_ini" id="fecha_teorica_inicio">
            <label for="fecha_teorica_fin">Fecha teórica fin</label>
            <input type="date" name="f_t_fin" id="fecha_teorica_fin">
            <label for="usu_id">ID usuario</label>
            <input type="number" name="usu_id" id="usu_id">
            <label for="duracion">Duración</label>
            <input type="number" name="duracion" id="duracion">
            <label for="id_sit">ID situaciones</label>
            <input type="number" name="id_sit" id="id_sit">
            <label for="id_proy">ID proyecto</label>
            <input type="number" name="id_proy" id="id_proy">
            <label>Observaciones<textarea name="obs" id="obs" cols="30" rows="10"></textarea></label>
            <input type="hidden" name='agregado'>
            <input type="submit" value="Agregar">
        </form> -->
    <?php
    //}
    ?>

</body>

</html>