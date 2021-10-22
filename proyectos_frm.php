<?php
require_once("controladores/controlador.php");

//echo $_POST['input_accion'] . " - " . $_POST['input_proy_id'];
if(isset($_POST['input_accion'])){
    if ($_POST['input_accion'] == 'm'){
        $proy_id = $_POST['input_proy_id'];
        $sql = "SELECT * FROM proyectos, usuarios, situaciones, acciones
                            WHERE proy_id = $proy_id AND usu_id = proy_usu_id AND sit_id = proy_sit_id AND acc_proy_id = $proy_id
                            ORDER BY proy_id";
        $datos_recibidos = controlador::select($sql);
        $datos = json_decode($datos_recibidos);

        echo "<pre>";
        var_export($datos);
        echo "</pre>";
        echo "<br>";

        foreach ($datos as $registro) : 
            $proy_nombre = $registro->proy_nombre;
            $proy_fr_inicio = $registro->proy_fr_inicio;
            $proy_fr_fin = $registro->proy_fr_fin;
            $proy_ft_inicio = $registro->proy_ft_inicio;
            $proy_ft_fin = $registro->proy_ft_fin;
            $proy_usu_id = $registro->proy_usu_id;
            $proy_duracion = $registro->proy_duracion;
            $proy_sit_id = $registro->proy_sit_id;
            $proy_obs = $registro->proy_obs;
        endforeach;
        echo $proy_nombre;echo "<br>";
        echo $proy_fr_inicio;echo "<br>";
        echo $proy_fr_fin;echo "<br>";
        echo $proy_ft_inicio;echo "<br>";
        echo $proy_ft_fin;echo "<br>";
        echo $proy_usu_id;echo "<br>";
        echo $proy_duracion; echo "<br>";
        echo $proy_sit_id; echo "<br>";
        echo $proy_obs;echo "<br>";            

        $frm = "<form action='acciones_rel.php' method='POST' id='frm_envio_acciones'>";
        $frm .= `<input type='text' id='input_envio_acciones_proy_nombre' name='input_envio_acciones_proy_nombre' value="$proy_nombre"`;


        // $frm .= "</form>";
        // echo $frm;
    }

    if ($_POST['input_accion'] == 'b'){

    }

    if ($_POST['input_accion'] == 'c'){

    }
}