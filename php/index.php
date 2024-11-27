<?php
include "../ConexionSQL/validar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="http://localhost/proyectofinal/assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Phudu:wght@500&family=Prompt:ital,wght@1,900&family=Rubik:wght@500&family=Urbanist&display=swap"
        rel="stylesheet">
    <title>Software 4U</title>
</head>

<body>
    <div class="formulario">
        <h1>Inicia Sesíon</h1>
        <form method="post">
            <div class="cotainer">
                <div class="congrup">
                    <input type="text" id="user" class="form_input" placeholder=" " name="codigo">
                    <label for="user" class="form_label">Codigo</label>
                    <span class="form_line"></span>
                </div>
                <div class="congrup">
                    <input type="password" id="contra" class="form_input" placeholder=" " name="contraseña">
                    <label for="contra" class="form_label">Contraseña</label>
                    <span class="form_line"></span>
                </div>
                <input class="form_submit" type="submit" value="Iniciar">
            </div>
        </form>
    </div>
</body>

</html>