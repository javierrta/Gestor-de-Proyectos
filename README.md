# Gestor-de-Proyectos

Este es un proyecto a realizar en común.

El reparto de trabajos es
  Jose Luis     - Proyectos
  Alvaro        - Front + usuarios
  Alberto       - Categorías
  Adrián        - Acciones
  Jorge - Angel - Tareas
  Jose Ignacio  - Situaciones

Las conexiones a la BBDD serán PDO
  Métodos
    select .- Recibe un SQL y devuelve en un JSON los datos
    update.-  Recibe el SQL y devuelve el nº de registros modificados
    delete.-  Recibe el SQL y devuelve el nº de registros modificados
    insert.-  Recibe el SQL y devuelve el id del registro generado
    
  Todos los procesos son síncronos
  
  Se debe de controlar si el usuario ha pasado por login (existirá la variable de sesión)
  Si no es así, le enviaré al index.php
