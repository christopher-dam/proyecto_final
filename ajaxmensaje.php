<?php
session_start();
include("db_connect.php");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JustApp</title>
  
  <!-- Hoja de estilos -->
  <link type="text/css" href="css/sydebar.css" rel="stylesheet" />
  <link type="text/css" href="css/estilo.css" rel="stylesheet" />

  <!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">

  <!-- Bootstrap de CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
    <button onclick="curl_init()"><p>Enviar</p></button>
</body>
<?php 
    $token = "5308297051:AAGzm_cGt0MQYBQOGXMuyH5BZ7hfa4hX2l4";
    $id = "-793336326";
    $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
    $msg = "Chris amore"."\n"."hola";
     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlMsg);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
    $server_output = curl_exec($ch);
    curl_close($ch); 
?>