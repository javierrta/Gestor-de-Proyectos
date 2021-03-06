<!--
    TODO: El formulario de registro no es funcional, es un simple escaparate.
-->
<?php
require_once 'sessions.php';
require_once 'validation.php'
?>

<?php if ($action === 'acceso') : ?>
    <form id="login" method="post" action="" name="login-form">
        <header>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
            </svg>
            <h2>Identificarse</h2>
        </header>

        <div class="form-group">
            <div class="form-field">
                <label>Usuario</label>
                <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Usuario" required />
            </div>

            <div class="form-field">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña" required />
            </div>
        </div>

        <button name="login" value="login">Iniciar sesión</button>
    </form>

<?php elseif ($action === 'registro') : ?>
    <form id="register" method="post" action="" name="register-form">
        <header>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
            </svg>
            <h2>Registrarse</h2>
        </header>

        <div class="form-group">
            <div class="form-field">
                <label>Nombre</label>
                <input type="text" name="name" placeholder="Nombre" required />
            </div>

            <div class="form-field">
                <label>Apellido</label>
                <input type="text" name="surname" placeholder="Apellido" required />
            </div>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label>Usuario</label>
                <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Usuario" required />
            </div>

            <div class="form-field">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña" required />
            </div>
        </div>

        <div class="form-field">
            <label>Categoría</label>
            <select id="category" name="category" placeholder="Categoría" required>
                <option value="proyect">Jefe de proyecto</option>
                <option value="action">Responsable de acción</option>
                <option value="task">Responsable de tarea</option>
                <option value="user">Usuario sin privilegios</option>
            </select>
        </div>

        <button name="login" value="login">Iniciar sesión</button>
    </form>

<?php else : ?>
    <h2 class="e404">Error 404: página no encontrada</h2>
<?php endif ?>
