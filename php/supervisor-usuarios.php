<?php
include "../ConexionSQL/new-user-supervisor.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/administrador.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu.css">
    <link rel="stylesheet" href="../fontawesome/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Phudu:wght@500&family=Prompt:ital,wght@1,900&family=Rubik:wght@500&family=Urbanist&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="toogle">
        <div class="logo"> Software 4U</div>
        <ul class="list">
            <li><a href="supervisor-inicio.php">Inicio</a></li>
            <li><a href="supervisor-usuarios.php">Usuarios</a></li>
            <li><a href="supervisor-insumos.php">Insumos</a></li>
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

    <div class="boton-modal">
        <label for="btn-modal" class="boton-new">Nuevo</label>
    </div>
    <input type="checkbox" id="btn-modal">
    <div class="container-form">
        <div class="crud">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cedula</th>
                        <th>Contraseña</th>
                        <th>Id_roles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM usuarios";
                    $result = $conn->query($sql);

                    if ($result === false) {
                        echo "Error en la consulta: " . $conn->error;
                    } else {
                        if ($result->num_rows > 0) {
                            while ($datos = $result->fetch_object()) {
                                echo "<tr>";
                                echo "<td>" . $datos->id . "</td>";
                                echo "<td>" . $datos->nombre . "</td>";
                                echo "<td>" . $datos->email . "</td>";
                                echo "<td>" . $datos->cedula . "</td>";
                                echo "<td>" . $datos->contraseña . "</td>";
                                echo "<td>" . $datos->id_roles . "</td>";
                            }
                        } else {
                            echo "No se encontraron resultados.";
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-modal">
        <div class="content-modal">
            <div class="modal-header">
                <h2><span id="modal-title">Nueva</span> Persona</h2>
            </div>
            <div id="modal-message"></div>
            <div class="formulario">
                <form method="post">
                    <div class="cotainer">
                        <div class="congrup">
                            <input type="hidden" id="id" class="form_input" name="id">
                        </div>
                        <div class="congrup">
                            <input type="text" id="user" class="form_input" placeholder=" " name="nombre">
                            <label for="user" class="form_label">Nombre</label>
                            <span class="form_line"></span>
                        </div>
                        <div class="congrup">
                            <input type="text" id="mail" class="form_input" placeholder=" " name="email">
                            <label for="mail" class="form_label">Email</label>
                            <span class="form_line"></span>
                        </div>
                        <div class="congrup">
                            <input type="text" id="cedula" class="form_input" placeholder=" " name="cedula">
                            <label for="cedula" class="form_label">Cedula</label>
                            <span class="form_line"></span>
                        </div>
                        <div class="congrup">
                            <input type="text" id="contraseña" class="form_input" placeholder=" " name="contraseña">
                            <label for="contraseña" class="form_label">Contraseña</label>
                            <span class="form_line"></span>
                        </div>
                        <div class="congrup">
                            <input type="text" id="olr" class="form_input" placeholder=" " name="rol">
                            <label for="rol" class="form_label">Rol</label>
                            <span class="form_line"></span>
                </form>
            </div>
            <div class="btn-cerrar">
                <label for="btn-modal">Cerrar</label>
                <input class="form_submit" type="submit" value="Guardar">
            </div>
        </div>
        <label for="btn-modal" class="cerrar-modal"></label>
    </div>
</body>

</html>