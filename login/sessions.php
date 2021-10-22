<?php

/**
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
    require_once 'controladores/conexion_alvaro.php';

    // Conexión temporal a la tabla de usuarios para pruebas de rendimiento
    // TODO: Asegurar la consulta y modificarla con los datos introducidos
    $conn = new conexion();
    $sql = "SELECT * FROM usuarios";
    $query = $conn->conectar()->query($sql);
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    // Variables de sesión comunes en formulario de acceso/registro
    $_SESSION['usu_nombre'] = trim($_POST['username']) ?? null;
    $_SESSION['usu_password'] = trim($_POST['password']) ?? null;

    // Variables de sesión solo en formulario de registro
    if ($action === 'registro') {
        $_SESSION['usu_apellido'] = trim($_POST['surname']) ?? null;
        $_SESSION['usu_cat_id'] = trim($_POST['category']) ?? null;
    }

    foreach ($users as $user) {
        // TODO: qué pasa con el id de dos usuarios con mismo nombre y contraseña?
        if (
            $_SESSION['usu_nombre'] === $user['usu_nombre'] &&
            $_SESSION['usu_password'] === $user['usu_password']
        ) {
            $_SESSION['usu_id'] = $user['usu_id'];
        }
    }
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
