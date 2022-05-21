<?php
session_start();
include("db_connect.php");

$link = conectar();
$query = "SELECT * FROM jugador where id_equipo = {$_POST['id_equipo']};";
$jugadores = "";

//Ejecutar consulta
$result = mysqli_query($link, $query);

while ($fila = mysqli_fetch_array($result)) {
  $jugadores .= "
        <tr>
        <td><a href='editarJugadorEntrenadorForm.php?id_jugador=" . $fila["id"] . "'>
        <img src='img/edit.png' width='20'></a></td>
        <td>" . $fila['nombre'] . "</td>
        <td>" . $fila['observaciones'] . "</td>
        <td>" . $fila['lesiones'] . "</td>
        </tr>";
}

mysqli_close($link);

echo $jugadores;