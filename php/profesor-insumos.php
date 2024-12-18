<?php
include "../ConexionSQL/conexion.php";
session_start();
$usuarioID = $_SESSION['usuario_id'];
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
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/profe-insumos.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu-abajo.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu.css">
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
            <li><a href="profesor-inicio">Inicio</a></li>
            <li><a href="profesor-insumos.php">Insumos</a></li>
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
            <li><a href="profesor-insumos.php">Insumos</a></li>
            <li><a href="profesor-prestado.php"><i class="fa-solid fa-plus"></i> Prestado</a></li>
        </ul>
    </nav>
    <main>
        <div class="formulario">
            <h1>Prestamo Insumos</h1>
            <form method="post">
                <div class="cotainer">
                    <div class="congrup">
                        <input type="text" id="name" class="form_input" placeholder=" " name="insprestado">
                        <label for="name" class="form_label">Insumo Prestado</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <input type="text" id="descripcion" class="form_input" placeholder=" " name="descripcion">
                        <label for="descripcion" class="form_label">Descripcion</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <input type="datetime-local" id="fecha-registro" class="form_input" placeholder=" "
                            name="fecha-prestamo">
                        <label for="fecha-registro" class="form_label">Fecha Inicio</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <input type="datetime-local" id="fecha-registro" class="form_input" placeholder=" "
                            name="fecha-entrega">
                        <label for="fecha-registro" class="form_label">Fecha Entrega</label>
                        <span class="form_line"></span>
                    </div>
                    <input type="hidden" name="UsuarioID" value="<?php echo $usuarioID; ?>">
                    <input type="hidden" name="InsumoID" value="<?php echo $insumoID; ?>">
                    <input class="form_submit" type="submit" value="Prestar Insumo">
                </div>
            </form>
        </div>
        <div class="container-form">
            <div class="crud">
                <table>
                    <thead>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM insumos WHERE Estado = 'Disponible'";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error en la consulta: " . $conn->error;
                        } else {
                            if ($result->num_rows > 0) {
                                while ($datos = $result->fetch_object()) {
                                    echo "<tr>";
                                    echo "<td>" . $datos->NomInsumo . "</td>";
                                    echo "<td class='descripcion'>" . $datos->Descripcion . "</td>";
                                    echo "<td>" . $datos->Estado . "</td>";
                                    echo "<td><a data-insumoid='" . $datos->id . "' class='my-button-prestar'>Prestar</a>";
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
        <script>
            document.querySelectorAll('.my-button-prestar').forEach((button, index) => {
                button.addEventListener('click', () => {
                    const form = document.querySelector('.formulario form');
                    const rowData = button.closest('tr').querySelectorAll('td');
                    form.insprestado.value = rowData[0].innerText;
                    form.descripcion.value = rowData[1].innerText;
                    const insumoID = button.getAttribute('data-insumoid');
                    form.InsumoID.value = insumoID;
                    form.action = '../ConexionSQL/prestar-insumo-profesor.php';
                });
            });
        </script>
        <script src="https://kit.fontawesome.com/69aa482bca.js" crossorigin="anonymous"></script>
    </main>
</body>

</html>