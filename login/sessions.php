<?php

/**
 * Variables de sesión:
 * - $_SESSION['usu_id']
 * - $_SESSION['usu_nombre']
 * - $_SESSION['usu_password']
 * - $_SESSION['usu_apellido'] // Por si acaso
 * - $_SESSION['usu_cat_id']
 * 
 * Valores de opciones select del campo "categoría":
 * - proyect (Jefe de proyecto)
 * - action (Responsable de acción)
 * - task (Responsable de tarea)
 * - user (Usuario sin privilegios)
 * 
 * #TODO: Sin un username o alias único, el username tratado como nombre propio
 * del usuario (usu_nombre) coincide con usuarios que se llaman igual (Juan === Juan).
 */

session_start();

// Obtener la acción a realizar (acceder o registrarse) según la url
$action = $_GET['action'] ?? $_POST['action'] ?? 'acceso';

// No establecer las variables de sesión hasta enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'controladores/controlador.php';
    // Obtener el usuario de la bd
    $sql = "SELECT * FROM usuarios WHERE usu_nombre = '$username' AND usu_password = md5('$password')";
    $userData = json_decode(controlador::select($sql));
    if (count($userData) > 0) {
        $_SESSION['usuario'] = $userData[0];
        header('Location: proyectos_rel.php');
        exit();
    } else {
        // Control de errores
    }
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
