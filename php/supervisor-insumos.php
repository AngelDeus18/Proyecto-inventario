<?php
include "../ConexionSQL/new-insumo-supervisor.php";
include "../ConexionSQL/edit-insumo-supervisor.php";
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
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/admi-insumos.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/menu-abajo.css">
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
    <nav class="menu_abajo">
        <ul class="lista_abajo">
            <li><a href="supervisor-insumos.php">Insumos</a></li>
            <li><a href="supervisor-reservas.php">Reservas</a></li>
            <li><a href="../fpdf/ReporteInsumos.php" class="btn-reporte" target="_blank"><i
                        class="fa-solid fa-download"></i> Generar reporte</a></li>
        </ul>
    </nav>
    <main>
        <div class="formulario">
            <h1>Ingresar Insumos</h1>
            <form method="post">
                <div class="cotainer">
                    <div class="congrup">
                        <input type="hidden" id="id" class="form_input" name="id">
                    </div>
                    <div class="congrup">
                        <input type="text" id="name" class="form_input" placeholder=" " name="nombre">
                        <label for="name" class="form_label">Nombre Insumo</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <input type="text" id="description" class="form_input" placeholder=" " name="descripcion">
                        <label for="description" class="form_label">Descripcion</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <select id="estado" class="form_input" placeholder=" " name="estado">
                            <option value="1"></option>
                            <option value="Disponible">Disponible</option>
                            <option value="No disponibe">No disponible</option>
                            <option value="Averiado">Averiado</option>
                        </select>
                        <label for="estado" class="form_label">Estado</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="congrup">
                        <input type="datetime-local" id="fecha-registro" class="form_input" placeholder=" "
                            name="fecha-registro">
                        <label for="fecha-registro" class="form_label">Fecha registro</label>
                        <span class="form_line"></span>
                    </div>
                    <input class="form_submit" type="submit" value="Registrar">
                </div>
            </form>
        </div>
        <div class="container-form">
            <div class="crud">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre Insumo</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM insumos";
                        $result = $conn->query($sql);

                        if ($result === false) {
                            echo "Error en la consulta: " . $conn->error;
                        } else {
                            if ($result->num_rows > 0) {
                                while ($datos = $result->fetch_object()) {
                                    echo "<tr>";
                                    echo "<td>" . $datos->id . "</td>";
                                    echo "<td>" . $datos->NomInsumo . "</td>";
                                    echo "<td class='descripcion'>" . $datos->Descripcion . "</td>";
                                    echo "<td>" . $datos->Estado . "</td>";
                                    echo "<td>" . $datos->FechaRegistro . "</td>";
                                    echo "<td><a id='editar-" . $datos->id . "' class='my-button-editar'>Editar</a>";
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
    </main>
    <script>
        document.querySelectorAll('.my-button-editar').forEach((button, index) => {
            button.addEventListener('click', () => {
                const form = document.querySelector('.formulario form');
                const rowData = button.closest('tr').querySelectorAll('td');
                form['id'].value = rowData[0].innerText;
                form.nombre.value = rowData[1].innerText;
                form.descripcion.value = rowData[2].innerText;
                form.estado.value = rowData[3].innerText;
                form['fecha-registro'].value = rowData[4].innerText;
                form.action = '../ConexionSQL/edit-insumo-supervisor.php';
                const submitButton = document.querySelector('.form_submit');
                submitButton.value = 'Editar Valores';
            });
        });
    </script>
</body>

</html>