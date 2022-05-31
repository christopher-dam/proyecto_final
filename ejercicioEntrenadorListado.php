<?php
session_start();
include("db_connect.php");
//Conectamos con la BD
$nombre = $_POST['nombre']??"";
$tiempo = $_POST['tiempo']??"";
$participantes = $_POST['participantes']??"";
$extraTiempo = $tiempo?'and tiempo = ?':"";
$extraParticipantes = $participantes?'and participantes = ?':"";
$query = "SELECT * FROM ejercicio WHERE nombre like ? $extraTiempo $extraParticipantes;";

//Ejecutar consulta
$data = ["%$nombre%"];
if ($extraTiempo) $data[]=$tiempo;
if ($extraParticipantes) $data[]=$participantes;
$result = ejecutar($query, $data);
if (!$result){
    echo 'Hubo un problema';
    return;
}
while ($fila = $result->fetch()) {
    echo '
                        <div class="card" style="max-width:30%;">
                            <img class="card-img-top" src=img/' . utf8_encode($fila['foto']) . '>
                            <div class="card-body">
                                <h5 class="card-title">' . $fila['nombre'] . '</h5>
                                <p class="card-text">' . $fila['descripcion'] . '</p>
                                </div>
                                </div>';
}

function ejecutar($sql, $data = null)
{
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER,
            DB_PASSWORD,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    } catch (Exception $ex) {
        $error = $ex->getMessage();
        echo $error;
        return false;
    }
}
