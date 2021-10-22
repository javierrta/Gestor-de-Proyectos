<?php
require_once("controladores/controlador.php");
// if (!isset($_SESSION['usuario'])) {
//     header("Location:index.php");
//     exit();
// }else {
//     $usuario_id_logueado = $_SESSION['usuario']->usu_id;
// }
if (isset($_POST['borrar'])) {
    $id_acc = $_POST['borrar'];
    $sql = "DELETE FROM acciones WHERE acc_id = $id_acc";
    controlador::delete($sql);
}
if (isset($_POST['agregado']) || isset($_POST['modificado'])) {
    $nombre_v = $_POST['accion'];
    $f_r_ini_v = $_POST['f_r_ini'];
    $f_r_fin_v = $_POST['f_r_fin'];
    $f_t_ini_v = $_POST['f_t_ini'];
    $f_t_fin_v = $_POST['f_t_fin'];
    $usu_id_v = 15;
    $duracion_v = $_POST['duracion'];
    $situaciones_id_v = $_POST['id_sit'];
    $proyecto_id_v = 2;
    $observaciones_v = $_POST['obs'];
    if (isset($_POST['agregado'])) {
        $sql = "INSERT INTO acciones VALUES (null, '$nombre_v', '$f_r_ini_v', '$f_r_fin_v', '$f_t_ini_v', '$f_t_fin_v', $usu_id_v, $duracion_v, $situaciones_id_v, $proyecto_id_v, '$observaciones_v')";
        $id_agregado = controlador::insert($sql);
    }
    if (isset($_POST['modificado'])) {
        $id_v = $_POST['id'];

        $sql = "UPDATE acciones SET acc_nombre = '$nombre_v', acc_fr_inicio = $f_r_ini_v, acc_fr_fin = $f_r_fin_v, acc_ft_inicio = $f_t_ini_v, acc_ft_fin = $f_t_fin_v, acc_usu_id = $usu_id_v, acc_duracion = $duracion_v, acc_sit_id = $situaciones_id_v, acc_proy_id = $proyecto_id_v, acc_obs = '$observaciones_v' WHERE acc_id = $id_v";
        $afectados = controlador::update($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acciones</title>
    <style>
        tr {
            border: 1px solid black;
        }
        input[type=number] {
            width: 40px;
        }
    </style>
</head>

<body>
    <div id="datos">
        <?php
        if (isset($_POST['proyecto'])) {
            $id_proyecto = $_POST['proyecto'];
        } else {
            $id_proyecto = 2;
        }
        $sql = "SELECT * FROM acciones WHERE acc_proy_id = $id_proyecto";
        $lista = json_decode(controlador::select($sql), true);
        $sql_proy = "SELECT proy_nombre FROM proyectos WHERE proy_id = $id_proyecto";
        $proyecto = json_decode(controlador::select($sql_proy), true);
        for ($k=0; $k<count($proyecto); $k++) {
            $t = "<h2>". $proyecto[$k]['proy_nombre'] ."</h2>";
        }
        $t .= "<table><tr><th>ID</th><th>ACCIÓN</th><th>FECHA REAL INICIO</th><th>FECHA REAL FIN</th><th>FECHA TEÓRICA INICIO</th><th>FECHA TEÓRICA FIN</th><th>ID USUARIO</th><th>DURACIÓN</th><th>ID SITUACIÓN</th><th>OBSERVACIONES</th><th>ACCIONES</th></tr>";
        $ids = array();
        for ($i = 0; $i < count($lista); $i++) {
            $ids[] = $lista[$i]["acc_id"];
            $t .= "<tr>";
            $t .= "<td>" . $lista[$i]["acc_id"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_nombre"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_fr_inicio"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_fr_fin"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_ft_inicio"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_ft_fin"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_usu_id"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_duracion"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_sit_id"] . "</td>";
            // $t .= "<td>" . $lista[$i]["acc_proy_id"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_obs"] . "</td>";
            $t .= "<td>";
            $accion_id = $lista[$i]["acc_id"];

            if (isset($_SESSION['usuario']['usu_id'])) {
                $usu = $_SESSION['usuario']['usu_id'];
            }else {
                $usu = 15;
            }
            if ($lista[$i]["acc_usu_id"] == $usu) {
                $t .= "<form action='acciones_frm.php' method='POST'>" .
                "<input type='hidden' name='modificar' value='$accion_id'><input type='submit' value='Modificar'>
                    </form>" .
                "<form action='' method='POST'>" .
                "<input type='hidden' name='borrar' value='$accion_id'><input type='submit' value='Borrar'>
                    </form>" . 
                    "<form action='' method='POST'>" .
                "<input type='hidden' name='acciones' value='$accion_id'><input type='submit' value='Consultar'>
                    </form>";
            $t .= "</td>";
            }else {
                $t .= "<form action='' method='POST'>" .
                "<input type='hidden' name='acciones' value='$accion_id'><input type='submit' value='Consultar'>
                    </form>";
            }

            $t .= "</tr>";
        }
        $t .= "<tr>";
        $num = max($ids) +1;
        $t .= "<form method='POST'>";
        $t .= "<td><label><input type='number' name='id' id='id' value='$num' disabled></label></td>";
        $t .= "<td><label><input type='text' name='accion' id='accion'></label></td>";
        $t .= "<td><label><input type='date' name='f_r_ini' id='f_r_ini'></label></td>";
        $t .= "<td><label><input type='date' name='f_r_fin' id='f_r_fin'></label></td>";
        $t .= "<td><label><input type='date' name='f_t_ini' id='f_t_ini'></label></td>";
        $t .= "<td><label><input type='date' name='f_t_fin' id='f_t_fin'></label></td>";
        $t .= "<td><label><input type='number' name='usu_id' id='usu_id' value='$usu' disabled></label></td>";
        $t .= "<td><label><input type='number' name='duracion' id='duracion'></label></td>";
        $t .= "<td><label><select name='id_sit'>";
        $sql2 = "SELECT * FROM situaciones";
        $situaciones = json_decode(controlador::select($sql2), true);
        for ($j = 0; $j <count($situaciones); $j++) {
            $sit_nombre = $situaciones[$j]['sit_nombre'];
            $sit_id = $situaciones[$j]['sit_id'];
            $t .= "<option name='id_sit' value='$sit_id'>" . $sit_nombre . "</option>";
        }
        $t .= "</select></label></td>";
        // $t .= "<td><label><input type='number' name='id_proy' id='proyecto_id' value='$id_proyecto' disabled></label></td>";
        $t .= "<td><label><textarea name='obs' id='obs' cols='10' rows='2'></textarea></label></td>";
        $t .= "<td><input type='hidden' name='agregado'>";
        $t .= "<input type='submit' value='Agregar'></td>";
        $t .= "</form>";
        $t .= "</tr>";
        $t .= "</table>";
        
        echo $t;
        ?>
    </div>
</body>

</html>