<?php
    require_once("controladores/controlador.php");

    if (!isset($_SESSION['usuario'])) {
        //header("Location:index.php");
        //exit();
    //} else {
        //$usu_id = $_SESSION['usuario']->usu_id;
        $usu_id = "1";
        //$usu_nombre = $_SESSION['usuario']->usu_nombre;
        $usu_nombre = "Jefe de proyecto 1";

        $sql = "SELECT p.*, u.usu_nombre, s.sit_nombre 
                FROM proyectos as p, usuarios as u, situaciones as s
                WHERE usu_id = proy_usu_id AND sit_id = proy_sit_id
                ORDER BY proy_id";
        $datos_recibidos = controlador::select($sql);
        $datos = json_decode($datos_recibidos);
    }

/*
    echo "<pre>";
    var_export($datos);
    echo "</pre>";
    echo "<br>";
*/    


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relación de Proyectos</title>

    <style>
        *{
            box-sizing: border-box;
        }
        th {
            padding: 10px 1px;
            background-color:#FFC5BE;
        }
        td {
            padding: 10px 1px;
        }
        .anadir {
            text-align:center;
            font-size:20px;
            font-weight:800;
            letter-spacing: 2px;
            word-spacing: 7px;
            background-color:IndianRed;
            color:white;
            cursor:pointer;
            height:30px;
        }
        .anadir:hover{
            background-color:#FFC5BE;
            color: black;
        }
        .accion {
            width:90px;
            text-align:center;
            border:1px IndianRed solid;
            cursor:pointer;
            background-color:#FDEBD0;
        }
        .accion:hover{
            background-color: IndianRed;
        }
        .accion_otros{
            width: 270px;
            text-align:center;
            border:1px IndianRed solid;
            cursor:pointer;
            background-color:#FDEBD0;
        }
        .accion_otros:hover{
            background-color: IndianRed;
        }
        .accion_otros_titulo{
            width: 270px;
            text-align:center;
            border:1px IndianRed solid;
            background-color:#FFC5BE;
        }
        .button{
            background-color:#FDEBD0;
            width: 100%;
            border: none;
        }
        .button:hover{
            background-color: IndianRed;
        }
    </style>

    <script>

        function fAccion(accion, id){
            //console.log(accion + " - " + id);
            document.getElementById("input_accion").value = accion;
            document.getElementById("input_id").value = id;
            document.getElementById("frm_envio").submit();
            document.getElementById("proy_acc_id").value = id;
            //document.getElementById("frm_envio_acc").submit();
        }
    </script>

</head>

<body>
    <main>
        <header>        
            <h1 style="color:IndianRed;text-align:center;">GESTOR DE PROYECTOS</h1>
            <br>
            <h2 style="color:IndianRed;text-align:center;"><?=$usu_nombre?></h2>
        </header>
    
    <div>
        <table border=1 style="margin:0 auto;">
            <tr>
                <!-- <th>Id del proyecto</th> -->
                <th>Proyecto</th>
                <th>Propietario</th>
                <th>Fecha prevista inicio</th>
                <th>Fecha prevista fin</th>
                <th>Fecha real inicio</th>
                <th>Fecha real fin</th>
                <th>Duración</th>
                <th>Situación</th>
                <!-- <th>Observaciones</th> -->
                <th colspan="3">Acciones</th>
            </tr>

            <?php foreach ($datos as $registro) : 
                $proy_id = $registro->proy_id;
                ?>
                

            <?php if (($registro->proy_usu_id) == $usu_id) : ?>           
                
            <tr class="fila_tabla">

                    <td style="width:150px;text-align:center;">
                        <?php echo($registro->proy_nombre) ?>
                    </td>

                    <td style="width:150px;text-align:center;">
                        <?php echo($registro->usu_nombre) ?>
                    </td>

                    <td style="width:150px;text-align:center;">
                        <?php 
                            if (($registro->proy_ft_inicio) != "0000-00-00"){
                                echo($registro->proy_ft_inicio);
                            } else {
                                echo "hola";
                            }
                        ?>                                
                    </td>

                    <td style="width:150px;text-align:center;">
                        <?php 
                            if (($registro->proy_ft_fin) != "0000-00-00"){
                                echo($registro->proy_ft_fin);
                            } else {
                                echo "";
                            }
                        ?>
                    </td>

                    <td style="width:150px;text-align:center;">
                        <?php 
                            if (($registro->proy_fr_inicio) != "0000-00-00"){
                                echo($registro->proy_fr_inicio);
                            } else {
                                echo "";
                            }
                        ?>
                    </td>

                    <td style="width:150px;text-align:center;">
                        <?php 
                            if (($registro->proy_fr_fin) != "0000-00-00"){
                                echo($registro->proy_fr_fin);
                            } else {
                                echo "";
                            }
                        ?>
                    </td>

                    <td style="width:90px;text-align:center;">
                        <?php echo($registro->proy_duracion) ?>
                    </td>

                    <td style="width:90px;text-align:center;">
                        <?php echo($registro->sit_nombre) ?>
                    </td>
                
                    <td class="accion" onclick="fAccion('m', <?=$proy_id?>)">Modificar</td>
                    <td class="accion" onclick="fAccion('b', <?=$proy_id?>)">Borrar</td>
                    <td class="accion" onclick="fAccion('c', <?=$proy_id?>)">Consultar</td>                    
            </tr>
                
            <?php endif; ?>
            
            <?php endforeach; ?>

            <tr>
                <td colspan="13" class="anadir">Añadir un nuevo proyecto</td>
            </tr>
        </table>

        <?php
            echo "<form action='proyectos_frm.php' method='POST' id='frm_envio'>";
                echo "<input type='hidden' id='input_accion' name='input_accion' value=''>";
                echo "<input type='hidden' id='input_id' name='proy_id_frm' value=''>";
            echo "</form>";

            echo "<form action='acciones_rel.php' method='POST' id='frm_envio_acc'>";
                echo "<input type='hidden' id='proy_acc_id' name='proy_id' value=''>";
            echo "</form>";
        ?>
    </div>

    <br><br><br>

    <div>
        <h2 style="color:IndianRed;text-align:center;">Otros proyectos</h2>
    </div>

    <div>
        <table border=1 style="margin:0 auto;">
            <tr>
                <th>Proyecto</th>
                <th>Propietario</th>
                <th>Fecha prevista inicio</th>
                <th>Fecha prevista fin</th>
                <th>Fecha real inicio</th>
                <th>Fecha real fin</th>
                <th>Duración</th>
                <th>Situación</th>
                <th colspan="3" class="accion_otros_titulo">Acciones</th>
            </tr>

            <?php foreach ($datos as $registro) : ?>

            <?php if (($registro->proy_usu_id) != $usu_id) : ?>           
                
            <tr class="fila_tabla">
                
                <td style="width:150px;text-align:center;">
                    <?php echo($registro->proy_nombre) ?>
                </td>

                <td style="width:150px;text-align:center;">
                    <?php echo($registro->usu_nombre) ?>
                </td>

                <td style="width:150px;text-align:center;">
                    <?php 
                        if (($registro->proy_ft_inicio) != "0000-00-00"){
                            echo($registro->proy_ft_inicio);
                        } else {
                            echo "hola";
                        }
                    ?>                                
                </td>

                <td style="width:150px;text-align:center;">
                    <?php 
                        if (($registro->proy_ft_fin) != "0000-00-00"){
                            echo($registro->proy_ft_fin);
                        } else {
                            echo "";
                        }
                    ?>
                </td>

                <td style="width:150px;text-align:center;">
                    <?php 
                        if (($registro->proy_fr_inicio) != "0000-00-00"){
                            echo($registro->proy_fr_inicio);
                        } else {
                            echo "";
                        }
                    ?>
                </td>

                <td style="width:150px;text-align:center;">
                    <?php 
                        if (($registro->proy_fr_fin) != "0000-00-00"){
                            echo($registro->proy_fr_fin);
                        } else {
                            echo "";
                        }
                    ?>
                </td>

                <td style="width:90px;text-align:center;">
                    <?php echo($registro->proy_duracion) ?>
                </td>

                <td style="width:90px;text-align:center;">
                    <?php echo($registro->sit_nombre) ?>
                </td>                  
        
                <td colspan="3" class="accion_otros" onclick="fAccion('c', <?=$proy_id?>)">Consultar</td>              
            </tr>
                
            <?php endif; ?>
    
            <?php endforeach; ?>

        </table>
    </div>

        
    </main>


</body>

</html>