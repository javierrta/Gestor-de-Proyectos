<?php

require_once("controladores/controlador.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situaciones FRM</title>
    <script>
       function  fInicio(){
            
        }
        function fAñadir(){
            <?php
            
            ?>
        }
    </script>
</head>

<body onload="fInicio()">
<div class="div_situaciones">
    <form action="fAñadir()" method="get">
        <label for="frm_situaciones">Crear nueva Situacion ó Estado</label>
        <input type="text" name="situacion" id="situacion">
        <input type="submit" value="Añadir Situacion">
    </form>
</div>
</body>

</html>