<?php
// TODO: La sesión se pierde al actualizar la página. ob_start() no funciona.
require_once 'sessions.php'
?>

<style>
    body {
        display: flex;
        place-items: center;
        place-content: center;
        text-align: center;
        color: green;
        font-size: 1.75rem;
    }

    img {
        border-radius: 20px;
        box-shadow: 0 0 0 10px green;
        border: 5px solid white;
        width: 50vw;
    }
</style>

<body>
    <div>
        <img src="../img/login/login-success.gif" alt="success">
        <h1>Usuario identificado correctamente</h1>
        <a href="../">Regresar</a>
    </div>
</body>

<?php

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
