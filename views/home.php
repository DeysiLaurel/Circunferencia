<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../controller/CircunferenciaController.php';
$controlador = new CircunferenciaController();

// Procesar registro si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar'])) {
    $controlador->registrar();
}

$resultado = $controlador->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal - Circunferencia</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/icono.ico">
    <link rel="stylesheet" href="../assetes/css/style_home.css">
</head>
<body>
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 12px;">
            <img src="../imagenes/logo.png" alt="Logo Circunferencia" style="height: 40px; width: auto;">
            <h1 style="margin: 0; font-size: 20px;">Gestión de Circunferencias</h1>
        </div>
        <p style="margin: 0;">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?> | <a href="logout.php">Cerrar Sesión</a></p>
    </div>

    <div class="container">
        <h3>Registrar Nueva Circunferencia</h3>
        <form action="home.php" method="POST">
            <input type="text" name="detalle" placeholder="Detalle o descripción" required>
            <input type="number" step="any" name="radio" placeholder="Radio de la circunferencia" required>
            <button type="submit" name="guardar">Calcular y Guardar</button>
        </form>

        <h3>Historial de Circunferencias Registradas</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Detalle</th>
                    <th>Radio</th>
                    <th>Diámetro</th>
                    <th>Área</th>
                    <th>Longitud</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id_circunferencia']; ?></td>
                    <td><?php echo htmlspecialchars($row['detalle']); ?></td>
                    <td><?php echo $row['radio']; ?></td>
                    <td><?php echo $row['diametro']; ?></td>
                    <td><?php echo number_format($row['area'], 4); ?></td>
                    <td><?php echo number_format($row['longitud'], 4); ?></td>
                    <td><?php echo $row['fecha_registro']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>