<?php
include "conexion.php";

$cedula = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

$consulta = $conn->prepare("SELECT * FROM usuarios WHERE cedula = ? AND contraseña = ?");
$consulta->bind_param("ss", $cedula, $contraseña);
$consulta->execute();

$resultado = $consulta->get_result();

if ($fila = $resultado->fetch_assoc()) {
    $idRol = $fila['id_roles'];
    $idUsuario = $fila['id']; 
    $nombreUsuario = $fila['nombre']; // Ajusta el nombre del campo según tu base de datos

    session_start(); 
    $_SESSION['usuario_id'] = $idUsuario; 
    $_SESSION['nombre'] = $nombreUsuario; // Configura el nombre del usuario

    if ($idRol == 1) {
        header("location: admin-inicio.php");
    } else if ($idRol == 2) {
        header("location: supervisor-inicio.php");
    } else if ($idRol == 3) {
        header("location: profesor-inicio.php");
    } else if ($idRol == 4) {
        header("location: estudiante-inicio.php");
    }
}

$consulta->close();
$conn->close();
?>
