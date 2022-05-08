<?php
include_once("db_connect.php");
$link=conectar();
// $queryJugador="SELECT id_entrenador FROM jugador WHERE id=".$_SESSION['id_jugador'].";";
// $resultJugador=mysqli_query($link, $queryJugador);
// $idEntrenador = mysqli_fetch_array($resultJugador);
// $queryFallida= "SELECT id, tipo, start_date, end_date FROM evento WHERE id_entrenador=".$idEntrenador['id_entrenador'].";";
$query="SELECT id, tipo, start_date, end_date FROM evento";

$result = mysqli_query($link, $query);
$calendar = array();
while( $rows = mysqli_fetch_assoc($result) ) {	
	// convert  date to milliseconds
	$start = strtotime($rows['start_date']) * 1000;
	$end = strtotime($rows['end_date']) * 1000;	
	$calendar[] = array(
        'id' =>$rows['id'],
        'tipo' => $rows['tipo'],
        'url' => "#",
		"class" => 'event-important',
        'start' => "$start",
        'end' => "$end"
    );
}
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
exit;
