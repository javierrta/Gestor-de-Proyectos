<?php
require_once("controladores/controlador.php");
$t = "";
if (isset($_POST['modificar'])) {
    $accion_id = $_POST['modificar'];
    $sql = "SELECT * FROM acciones WHERE acc_id = $accion_id";
    $accion = json_decode(controlador::select($sql), true);
    $t = "<form action='' method='POST'>";
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
        $t .= "<label>Nombre<input type='text' name='accion' id='accion' value='$nombre'></label>";
        $t .= "<label>Fecha real inicio<input type='date' name='f_r_ini' id='f_r_ini' value='$f_r_ini'></label>";
        $t .= "<label>Fecha real fin<input type='date' name='f_r_fin' id='f_r_fin' value='$f_r_fin'></label>";
        $t .= "<label>Fecha teórica inicio<input type='date' name='f_t_ini' id='f_t_ini' value='$f_t_ini'></label>";
        $t .= "<label>Fecha teórica fin<input type='date' name='f_t_fin' id='f_t_fin' value='$f_t_fin'></label>";
        $t .= "<label>ID del usuario<input type='number' name='usu_id' id='usu_id' value='$usu_id' readonly></label>";
        $t .= "<label>Duración<input type='number' name='duracion' id='duracion' value='$duracion'></label>";
        $t .= "<label>ID situaciones<input type='number' name='situaciones_id' id='situaciones_id' value='$situaciones_id'></label>";
        $t .= "<label>ID del proyecto<input type='text' name='proyecto_id' id='proyecto_id' value='$proyecto_id'></label>";
        $t .= "<label>Observaciones<textarea name='obs' id='obs' cols='30' rows='10'>$observaciones</textarea></label>";
        $t .= "<input type='hidden' name='modificado'>";
        $t .= "<input type='submit' value='Modificar'>";
    }
    $t .= "</form>";

    if (isset($_POST['modificado'])) {
        $nombre_v = $_POST['accion'];
        $f_r_ini_v = $_POST['f_r_ini'];
        $f_r_fin_v = $_POST['f_r_fin'];
        $f_t_ini_v = $_POST['f_t_ini'];
        $f_t_fin_v = $_POST['f_t_fin'];
        $usu_id_v = $_POST['usu_id'];
        $duracion_v = $_POST['duracion'];
        $situaciones_id_v = $_POST['situaciones_id'];
        $proyecto_id_v = $_POST['proyecto_id'];
        $observaciones_v = $_POST['obs'];
        $sql = "UPDATE acciones WHERE acc_id = $accion_id SET acc_nombre = '$nombre_v', acc_fr_inicio = $f_r_ini_v, acc_fr_fin = $f_r_fin_v, acc_ft_inicio = $f_t_ini_v, acc_ft_fin = $f_t_fin_v, acc_usu_id = $usu_id_v, acc_duracion = $duracion_v, acc_sit_id = $situaciones_id_v, acc_proy_id = $proyecto_id_v, acc_obs = '$observaciones_v')";
        $afectados = controlador::update($sql);
        header("Location:acciones_rel.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario acciones</title>
</head>

<body>
    <?php
    echo $t;

    if (isset($_POST['agregar'])) {
    ?>
        <form action="" method="POST">
            <label for="accion">Acción</label>
            <input type="text" name="accion" id="accion">
            <label for="fecha_real_inicio">Fecha real inicio</label>
            <input type="date" name="fecha_real_inicio" id="fecha_real_inicio">
            <label for="fecha_real_fin">Fecha real fin</label>
            <input type="date" name="fecha_real_fin" id="fecha_real_fin">
            <label for="fecha_teorica_inicio">Fecha teórica inicio</label>
            <input type="date" name="fecha_teorica_inicio" id="fecha_teorica_inicio">
            <label for="fecha_teorica_fin">Fecha teórica fin</label>
            <input type="date" name="fecha_teorica_fin" id="fecha_teorica_fin">
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
        </form>
    <?php
        if (isset($_POST['agregado'])) {

            $nombre_v = $_POST['accion'];
            $f_r_ini_v = $_POST['fecha_real_inicio'];
            $f_r_fin_v = $_POST['fecha_real_fin'];
            $f_t_ini_v = $_POST['fecha_teorica_inicio'];
            $f_t_fin_v = $_POST['fecha_teorica_fin'];
            $usu_id_v = $_POST['usu_id'];
            $duracion_v = $_POST['duracion'];
            $situaciones_id_v = $_POST['id_sit'];
            $proyecto_id_v = $_POST['id_proy'];
            $observaciones_v = $_POST['obs'];
            $sql = "INSERT INTO acciones VALUES (null, '$nombre_v', $f_r_ini_v, $f_r_fin_v, $f_t_ini_v, $f_t_fin_v, $usu_id_v, $duracion_v, $situaciones_id_v, $proyecto_id_v, '$observaciones_v')";
            $id_agregado = controlador::insert($sql);
            header("Location:acciones_rel.php");
        }
    }
    ?>
</body>

</html>