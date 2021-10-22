<?php
require_once("controladores/controlador.php");
if (isset ($_POST['borrar'])) {
    $id_acc = $_POST['borrar'];
    $sql = "DELETE FROM acciones WHERE acc_id = $id_acc";
    controlador::delete($sql);
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
        for ($i = 0; $i<count($lista); $i++) {
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
            //     $t .= "<td><frm method='POST'><input type='hidden' name='modificar' value='$lista[$i][\"acc_id\"]'><input type='submit' value='Modificar'></form>" . "<frm method='POST'><input type='hidden' name='borrar' value='$lista[$i][\"acc_id\"]'><input type='submit' value='Borrar'></form></td>";
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
