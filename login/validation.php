<?php

/**
 * #TODO:
 * - Control de errores
 */

require_once 'sessions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($users as $user) {
        if (
            $_SESSION['usu_nombre'] === $user['usu_nombre'] &&
            $_SESSION['usu_password'] === $user['usu_password']
        ) {
            header('Location: login/success.php');
        }
    }
}
