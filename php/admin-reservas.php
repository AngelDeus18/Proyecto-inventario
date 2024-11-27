<?php
include "../ConexionSQL/new-insumo.php";
include "../ConexionSQL/eliminar-reserva.php";
session_start();
if (isset($_SESSION['usuario_id']) && isset($_SESSION['nombre'])) {
    $nombreUsuario = $_SESSION['nombre'];
} else {
    $nombreUsuario = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu-abajo.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/reserva-admin.css">
    <link rel="stylesheet" href="../fontawesome/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Phudu:wght@500&family=Prompt:ital,wght@1,900&family=Rubik:wght@500&family=Urbanist&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <title>Document</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="toogle">
        <div class="logo"> Software 4U</div>
        <ul class="list">
            <li><a href="admin-inicio.php">Inicio</a></li>
            <li><a href="administrador.php">Usuarios</a></li>
            <li><a href="admin-insumos.php">Insumos</a></li>
            <i class="fa-solid fa-user"></i>
            <li>
                <?php echo $nombreUsuario . " "; ?>
            </li>
            <li><a href="../ConexionSQL/cerrar.php">Salir</a></li>
        </ul>

        <label for="toogle" class="icon-bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    <nav class="menu_abajo">
        <ul class="lista_abajo">
            <li><a href="admin-insumos.php">Insumos</a></li>
            <li><a href="admin-reservas.php">Reservas</a></li>
            <li><a href="../fpdf/ReporteReservas.php" class="btn-reporte" target="_blank"><i
                        class="fa-solid fa-download"></i> Generar reporte</a></li>
        </ul>
    </nav>
    <main>
        <div class="container-form">
            <div class="crud">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre </th>
                            <th>Cedula</th>
                            <th>Nom Insumo</th>
                            <th>Descripcion</th>
                            <th>Estado Insumo</th>
                            <th>Fecha inicio</th>
                            <th>Fecha entrega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT r.id, u.nombre AS NombreUsuario, u.cedula AS CedulaUsuario, i.NomInsumo, i.Descripcion,
                        i.Estado AS EstadoInsumo, r.FechaInicio, r.FechaFin
                        FROM reservas r
                        JOIN usuarios u ON r.UsuarioID = u.id
                        JOIN insumos i ON r.InsumoID = i.id";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error en la consulta: " . $conn->error;
                        } else {
                            while ($datos = $result->fetch_object()) {
                                echo "<tr>";
                                echo "<td>" . ($datos->NombreUsuario ?? '') . "</td>";
                                echo "<td>" . ($datos->CedulaUsuario ?? '') . "</td>";
                                echo "<td>" . ($datos->NomInsumo ?? '') . "</td>";
                                echo "<td>" . ($datos->Descripcion ?? '') . "</td>";
                                echo "<td>" . ($datos->EstadoInsumo ?? '') . "</td>";
                                echo "<td>" . ($datos->FechaInicio ?? '') . "</td>";
                                echo "<td>" . ($datos->FechaFin ?? '') . "</td>";
                                echo "<td><a href='admin-reservas.php?id=" . ($datos->id ?? '') . "'>
                                <button class='my-button-eliminar'>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>