<?php
echo"SITUACIONES REL";
    require_once("controladores/controlador.php");
    $sqlp="SELECT p.proy_nombre,s.sit_nombre FROM proyectos p,situaciones s WHERE p.proy_sit_id=s.sit_id";
    $sqlt="SELECT t.tar_nombre,s.sit_nombre FROM tareas t,situaciones s WHERE t.tar_sit_id=s.sit_id";
    $sqla="SELECT a.acc_nombre,s.sit_nombre FROM acciones a,situaciones s WHERE a.acc_sit_id=s.sit_id";
    echo"<br>PROYECTOS<br>";
    var_dump( ($proyectos=controlador::select($sqlp)));
    echo"<br>TAREAS<br>";
    var_dump( ($tareas=controlador::select($sqlt)));
    echo"<br>ACCIONES<br>";
    var_dump( ($acciones=controlador::select($sqla)));
    

?>