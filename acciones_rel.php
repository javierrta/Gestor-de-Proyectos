<?php
require_once("controladores/controlador.php");
if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
    exit();
} else {
    $usuario_id_logueado = $_SESSION['usuario']->usu_id;
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
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            width: 100%;
            margin: 0;
        }
        .titulo_proy {
            text-transform: uppercase;
            text-align:center;
            color: #999;
            font-size: 30px ;
        }
        #datos table{
            margin: 0 auto;
            text-align: center;
        }
        #datos table, #datos table td {
            border: 2px solid hsl(221, 50%, 92%);
            border-collapse: collapse;
            padding: 5px 10px;
        }
        #datos table th {
            border: 2px solid hsl(221, 50%, 92%);
            padding: 10px 10px;
            font-size: 17px;
        }
        #datos table input[type=text], #datos table input[type=date], #datos table select{
            padding: 2px 8px;
            font-size: 14px;
        }

        .id_add {
            width: 40px;
            font-size: 14px;
        }
        .botonera {
            display: flex;
        }

        .btn {
            background-color: hsl(9, 100%, 64%);
            border: none;
            box-shadow: 0 2px 2px rgb(0 0 0 / 0.2);
            color: white;
            padding: 8px 10px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.25s ease;
        }
        .btn_full {
            width: 100%;
            display: flex;
            justify-content: space-around;
        }
        .btn:hover {
            background-color: hsl(9, 100%, 60%);
            box-shadow: none;
            transform: translate(0, 2px);
            transition: 0.25s ease;
        }

        .overlay {
            background: rgba(255, 255, 255, 0.77);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .global-modal {
            visibility: hidden;
        }

        .global-modal_contents {
            background: #FFF;
            box-shadow: 0 0 8px 2px rgba(182, 182, 182, 0.75);
            width: 600px;
            position: absolute;
            top:20%;
            left: 50%;
            transform: translate(-50%, 0%)!important;
        }

        .global-modal-header {
            border-bottom: 1px solid #ccc;
            text-align: center;
            font-size: 20px;
        }

        .cerrar {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            font-size: 30px;
        }

        .global-modal-body {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .global-modal-show {
            visibility: visible;
        }

        .global-modal-transition {
            transform: scale(0.7);
            opacity: 0;
            transition: all 0.3s;
        }

        .global-modal-show .global-modal-transition {
            transform: scale(1);
            opacity: 1;
        }

        #iframe-modal {
            width: 600px;
            height: 600px;
        }
    </style>

</head>

<body>
    <div id="datos">
        <?php
        if (isset($_POST['proy_id'])) {
            $id_proyecto = $_POST['proy_id'];
        } else {
            $id_proyecto = 2;
        }
        $sql = "SELECT * FROM acciones WHERE acc_proy_id = $id_proyecto ORDER BY acc_usu_id";
        $lista = json_decode(controlador::select($sql), true);
        $sql_proy = "SELECT proy_nombre FROM proyectos WHERE proy_id = $id_proyecto";
        $proyecto = json_decode(controlador::select($sql_proy), true);
        for ($k = 0; $k < count($proyecto); $k++) {
            $t = "<h2 class='titulo_proy'>" . $proyecto[$k]['proy_nombre'] . "</h2>";
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
            if ($lista[$i]["acc_usu_id"] == $usuario_id_logueado) {
                $t .= "<div class='botonera'>" .
                    "<form action='tareas_rel.php' method='POST'>" .
                    "<input type='hidden' name='acc_id' value='$accion_id'><button class='btn' type='submit' title='Consultar'><i class='fas fa-sign-in-alt'></i></button>
                    </form>&nbsp;" .
                    "<form action='acciones_frm.php' method='POST' target='form_mod'>" .
                    "<input type='hidden' name='modificar' value='$accion_id'><button class='btn' type='submit' onclick='formModal()' title='Modificar'><i class='fas fa-pen'></i></button>
                    </form>&nbsp;" . 
                    "<form action='' method='POST'>" .
                    "<input type='hidden' name='borrar' value='$accion_id'><button class='btn' type='submit' title='Borrar'><i class='fas fa-trash'></i></button>
                    </form></div>";
                $t .= "</td>";
            } else {
                $t .= "<form action='tareas_rel.php' method='POST'>" .
                    "<input type='hidden' name='acc_id' value='$accion_id'><button class='btn btn_full' type='submit'><i class='fas fa-sign-in-alt'></i>Consultar</button>
                    </form>";
            }

            $t .= "</tr>";
        }
        $t .= "<tr>";
        $num = max($ids) + 1;
        $t .= "<form method='POST'>";
        $t .= "<td><label><input type='text' name='id' class='id_add' value='$num' disabled></label></td>";
        $t .= "<td><label><input type='text' name='accion' id='accion'></label></td>";
        $t .= "<td><label><input type='date' name='f_r_ini' id='f_r_ini'></label></td>";
        $t .= "<td><label><input type='date' name='f_r_fin' id='f_r_fin'></label></td>";
        $t .= "<td><label><input type='date' name='f_t_ini' id='f_t_ini'></label></td>";
        $t .= "<td><label><input type='date' name='f_t_fin' id='f_t_fin'></label></td>";
        $t .= "<td><label><input type='text' name='usu_id' class='id_add' value='$usuario_id_logueado' disabled></label></td>";
        $t .= "<td><label><input type='number' name='duracion' id='duracion'></label></td>";
        $t .= "<td><label><select name='id_sit'>";
        $sql2 = "SELECT * FROM situaciones";
        $situaciones = json_decode(controlador::select($sql2), true);
        for ($j = 0; $j < count($situaciones); $j++) {
            $sit_nombre = $situaciones[$j]['sit_nombre'];
            $sit_id = $situaciones[$j]['sit_id'];
            $t .= "<option name='id_sit' value='$sit_id'>" . $sit_nombre . "</option>";
        }
        $t .= "</select></label></td>";
        // $t .= "<td><label><input type='number' name='id_proy' id='proyecto_id' value='$id_proyecto' disabled></label></td>";
        $t .= "<td><label><textarea name='obs' id='obs' cols='20' rows='1'></textarea></label></td>";
        $t .= "<td><input type='hidden' name='agregado'>";
        $t .= "<button class='btn btn_full' type='submit' title='Añadir'><i class='fas fa-plus'></i>Añadir</button></td>";
        $t .= "</form>";
        $t .= "</tr>";
        $t .= "</table>";

        echo $t;
        ?>
    </div>
    <div class="global-modal">
        <div class="overlay"></div>
        <div class="global-modal_contents global-modal-transition">
            <div class="global-modal-header">
                <i class="cerrar fas fa-times-circle"></i>
                <h3>Modificar acción</h3>
            </div>
            <div class="global-modal-body">
                <iframe id='iframe-modal' src='acciones_frm.php' frameborder='0' name='form_mod'></iframe>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    function formModal() {
        document.querySelector(".global-modal").classList.add('global-modal-show');
    }

    document.querySelector(".overlay").addEventListener("click", () => {
        document.querySelector(".global-modal").classList.remove('global-modal-show');
    });
    document.querySelector(".cerrar").addEventListener("click", () => {
        document.querySelector(".global-modal").classList.remove('global-modal-show');
    });
</script>