<?php

/**
 * #TODO:
 * - Control de errores
 */

require_once 'sessions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    foreach ($userData as $data) {
        if (
            $_SESSION['usu_nombre'] === $data['usu_nombre'] &&
            md5($_SESSION['usu_password']) === $data['usu_password']
        ) {
            header('Location: proyectos_rel.php');
        } else {
            $errors = 'Usuario o contraseña incorrecto';
        }
    }
}
