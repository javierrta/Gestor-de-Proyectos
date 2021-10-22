<?php
require_once("controladores/controlador.php");

if(isset($_POST['accion'])){
    if ($_POST['accion'] == 'm'){
        $proy_id = $_POST['proy_id'];
        $sql = "SELECT * FROM proyectos, usuarios, situaciones, acciones
                            WHERE proy_id = $proy_id AND usu_id = proy_usu_id AND sit_id = proy_sit_id AND acc_proy_id = $proy_id
                            ORDER BY proy_id";
        $datos_recibidos = controlador::select($sql);
        $datos = json_decode($datos_recibidos);
        echo "<pre>";
    var_export($datos);
    echo "</pre>";
    echo "<br>";
    }

    if ($_POST['accion'] == 'b'){

    }

    if ($_POST['accion'] == 'c'){

    }
}