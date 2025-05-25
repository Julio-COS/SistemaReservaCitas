<?php
include("config/database.php");

$id_paciente = $_POST['id_paciente'];
$id_enfermera = $_POST['id_enfermera'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];

$sql = "INSERT INTO citas (id_paciente, id_enfermera, fecha, hora, motivo, estado)
        VALUES ('$id_paciente', '$id_enfermera', '$fecha', '$hora', '$motivo', 'pendiente')";

if ($conexion->query($sql) === TRUE) {
    echo "Cita guardada correctamente";
} else {
    echo "Error: " . $conexion->error;
}
?>