<?php
session_start();
include("db_connect.php");

    $token = "5308297051:AAGzm_cGt0MQYBQOGXMuyH5BZ7hfa4hX2l4";
    $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";

    $link = conectar();
    $jugadores = implode(",", $_POST["jugadores"]);
    $query = "SELECT * FROM jugador where id in ($jugadores)";
    $msg = empty($_POST["cabecera"])?"":$_POST["cabecera"]."\n\n";

    //Ejecutar consulta
    $result = mysqli_query($link, $query);

    while ($fila = mysqli_fetch_array($result)) {
      $msg .= "{$fila['nombre']} {$fila['apellidos']} \n";
    }

    $query = "SELECT * FROM equipo where id = {$_POST['id_equipo']}";
    $result = mysqli_query($link, $query);
    $id = mysqli_fetch_array($result)["chat"];

    mysqli_close($link);
     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlMsg);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
    $server_output = curl_exec($ch);
    curl_close($ch);
    header("Location: convocatoria.php?resultado=ok"); 
