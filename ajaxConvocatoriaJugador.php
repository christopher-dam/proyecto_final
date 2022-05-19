<?php
session_start();
include("db_connect.php");

$link = conectar();
$query = "SELECT * FROM jugador where id_equipo = {$_POST['id_equipo']};";
$jugadores = "";

//Ejecutar consulta
$result = mysqli_query($link, $query);

while ($fila = mysqli_fetch_array($result)) {
  $jugadores .= "<input type='checkbox' style='margin-right:18px' name='jugadores[]' value='{$fila['id']}'>{$fila['nombre']} {$fila['apellidos']}</input><br>";
}
mysqli_close($link);


echo $jugadores;