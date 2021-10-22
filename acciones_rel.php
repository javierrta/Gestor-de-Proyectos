<?php
require_once("controladores/controlador.php");
if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
    exit();
}
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
    $usu_id_v = $_POST['usu_id'];
    $duracion_v = $_POST['duracion'];
    $situaciones_id_v = $_POST['id_sit'];
    $proyecto_id_v = $_POST['id_proy'];
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
</head>

<body>
    <div id="datos">
        <?php
        // $id_proyecto = $_POST['proyecto'];
        // $sql = "SELECT * FROM acciones WHERE acc_proy_id = $id_proyecto ORDER BY acc_nombre";
        $sql = "SELECT * FROM acciones ORDER BY acc_nombre";
        $lista = json_decode(controlador::select($sql), true);
        $t = "<table><tr><th>ID</th><th>ACCIÓN</th><th>FECHA REAL INICIO</th><th>FECHA REAL FIN</th><th>FECHA TEÓRICA INICIO</th><th>FECHA TEÓRICA FIN</th><th>ID USUARIO</th><th>DURACIÓN</th><th>ID SITUACIÓN</th><th>ID PROYECTO</th><th>OBSERVACIONES</th><th>ACCIONES</th></tr>";
        for ($i = 0; $i < count($lista); $i++) {
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
            $t .= "<td>" . $lista[$i]["acc_proy_id"] . "</td>";
            $t .= "<td>" . $lista[$i]["acc_obs"] . "</td>";
            $t .= "<td>";
            $accion_id = $lista[$i]["acc_id"];
            $t .= "<form action='acciones_frm.php' method='POST'>" .
                "<input type='hidden' name='modificar' value='$accion_id'><input type='submit' value='Modificar'>
                    </form>" .
                "<form action='' method='POST'>" .
                "<input type='hidden' name='borrar' value='$accion_id'><input type='submit' value='Borrar'>
                    </form>";
            $t .= "</td>";
            // if ($lista[$i]["acc_usu_id"] == $_SESSION['usuario']['usu_id']) {
            //     $t .= "<td>";
            //     $accion_id = $lista[$i]["acc_id"];
            //     $t .= "<form action='acciones_frm.php' method='POST'>" .
            //                 "<input type='hidden' name='modificar' value='$accion_id'><input type='submit' value='Modificar'>
            //             </form>" . 
            //             "<form action='' method='POST'>" .
            //                 "<input type='hidden' name='borrar' value='$accion_id'><input type='submit' value='Borrar'>
            //             </form>";
            //     $t .= "</td>";
            // }else {
            //     $t .= "<td></td>";
            // }

            $t .= "</tr>";
        }
        $t .= "<form action='acciones_frm.php' method='POST'>" .
            "<input type='hidden' name='agregar'><input type='submit' value='Agregar'>
                    </form>";
        $t .= "</table>";
        echo $t;
        ?>
    </div>
</body>

</html>