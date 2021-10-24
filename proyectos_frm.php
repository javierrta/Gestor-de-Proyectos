<?php
require_once("controladores/controlador.php");

//echo $_POST['input_accion'] . " - " . $_POST['input_proy_id'];
if(isset($_POST['input_accion'])){
    if ($_POST['input_accion'] == 'm'){
        $proy_id = $_POST['proy_id_frm'];
        $sql = "SELECT *  
                    FROM proyectos as p, usuarios as u, situaciones as s
                    WHERE proy_id = $proy_id AND usu_id = proy_usu_id AND sit_id = proy_sit_id
                    ORDER BY proy_id";
        $datos_recibidos = controlador::select($sql);
        $datos = json_decode($datos_recibidos);

        $sql_usu = "SELECT * FROM usuarios ORDER BY usu_id";
        $datos_recibidos_usu = controlador::select($sql_usu);
        $datos_usu = json_decode($datos_recibidos_usu);

        $sql_sit = "SELECT * FROM situaciones ORDER BY sit_id";
        $datos_recibidos_sit = controlador::select($sql_sit);
        $datos_sit = json_decode($datos_recibidos_sit);
/*
        echo "<pre>";
        var_export($datos);
        echo "</pre>";
        echo "<br><br>";
        echo "<pre>";
        var_export($datos_usu);
        echo "</pre>";
        echo "<br>";
*/

        // Paso a variables los valores que han venido en el json       
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


    }

    if ($_POST['input_accion'] == 'b'){        
            $proy_id_borrar = $_POST['proy_id_frm'];
            $sql = "DELETE FROM proyectos WHERE proy_id = $proy_id_borrar";
            controlador::delete($sql);
            header("Location: proyectos_rel.php");
    }

    if ($_POST['input_accion'] == 'c'){
        echo $_POST['input_accion'];
        echo $_POST['proy_id_frm'];
        //echo $_POST['proy_id'];
        header("Location: proyectos_rel.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de proyectos</title>

    <script>
        function fCancelar(){
            document.location = "proyectos_rel.php";
        }
    </script>

    <style>
        .div_form{
            width: 500px;
            margin: 0 auto;
            background-color: #FDEBD0;
        }
        input[type=text], input[type=date], select {
            width: 100%;
            padding: 5px 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            cursor: pointer;
        }
        .div_form {
            border-radius: 5px;
            background-color: #FDEBD0;
            padding: 20px;
        }
        .botones{
            text-align: center;
            margin-top: 20px;
        }
        .botones input[type=button]{
            margin: 0 50px;
            width: 150px;
            height: 35px;
            font-size: 15px;
            font-weight: 700;
            background-color: IndianRed;
            color: white;
            cursor: pointer;
        }
        .botones input[type=button]:hover{
            background-color:#FFC5BE;
            color: black;
        }
        #text_modi_alta{
            display: block;
            margin: 0 auto;
        }
    </style>

</head>
<body>

        <header>        
            <h1 style="color:IndianRed;text-align:center;">GESTOR DE PROYECTOS</h1>            
            <h2 style="color:IndianRed;text-align:center;">
                <?php
                if ($_POST['input_accion'] == 'm'){
                    echo "Modificar los datos del proyecto";
                }
                if ($_POST['input_accion'] == 'b'){
                    echo "Borrar el proyecto";
                }
                if ($_POST['input_accion'] == 'a'){
                    echo "Crear un nuevo proyecto";
                }
                    
                
                ?>
            </h2>
        </header>
    
        <div class="div_form">
            <form action="" id="frm_modi_alta" method="POST">

                <label for="nom__modi_alta">Nombre del proyecto</label>  
                <input type="text" name="nom__modi_alta" id="nom__modi_alta" value="<?= $proy_nombre ?>"><br>

                <label for="fech_real_ini_modi_alta">Fecha real de inicio</label>
                <input type="date" name="fech_real_ini_modi_alta" id="fech_real_ini_modi_alta" value="<?= $proy_fr_inicio ?>"><br>

                <label for="fech_real_fin_modi_alta">Fecha real de finalización</label>
                <input type="date" name="fech_real_fin_modi_alta" id="fech_real_fin_modi_alta" value="<?= $proy_fr_fin ?>"><br>

                <label for="fech_teor_ini_modi_alta">Fecha teórica de inicio</label>
                <input type="date" name="fech_teor_ini_modi_alta" id="fech_teor_ini_modi_alta" value="<?= $proy_ft_inicio ?>"><br>

                <label for="fech_teor_fin_modi_alta">Fecha teórica de finalización</label>
                <input type="date" name="fech_teor_fin_modi_alta" id="fech_teor_fin_modi_alta" value="<?= $proy_ft_fin ?>"><br>

                <label for="usu_mod_alta">Propietario</label>
                <select name="usu_modi_alta" id="usu_mod_alta">
                    <?php 
                        foreach ($datos_usu as $registro) :
                            echo "<option value='$registro->usu_id'>  $registro->usu_nombre</option>";
                        endforeach;
                    ?>                           
                </select><br>

                <label for="durac_modi_alta">Duración</label>
                <input type="text" name="durac_modi_alta" id="durac_modi_alta" value="<?= $proy_duracion ?>"><br>

                <label for="sit_mod_alta">Situación</label>
                <select name="sit_modi_alta" id="sit_mod_alta">
                    <?php 
                        foreach ($datos_sit as $registro) :
                            echo "<option value='$registro->sit_id'>  $registro->sit_nombre</option>";
                        endforeach;
                    ?>                           
                </select><br>

                
                <textarea name="text_modi_alta" id="text_modi_alta" cols="60" rows="10" value="<?php $proy_obs ?>"></textarea><br>            
        </div>
        <div class="botones">
                <input type="button" value="Cancelar" onclick="fCancelar()">
                <input type="button" value="Modificar">
        </div>  
        </form>  
    
</body>
</html>