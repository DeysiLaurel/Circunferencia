<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Sistema de Circunferencia</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/icono.ico">
    <link rel="stylesheet" href="../assetes/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Acceso al Sistema</h2>
        <?php if(isset($_GET['error'])): ?>
            <p style="color: red; text-align: center;">Correo o contraseña incorrectos</p>
        <?php endif; ?>
        <form action="../controller/AuthController.php" method="POST">
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" required>
            </div>
            <button type="submit" class="btn-submit">Ingresar</button>
        </form>
    </div>
</body>
</html>