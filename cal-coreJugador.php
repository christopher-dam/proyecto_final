<?php
session_start();
include("db_connect.php");

$link = conectar();

class Calendar
{
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = "";
  function __construct()
  {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASSWORD,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } catch (Exception $ex) {
      exit($ex->getMessage());
    }
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct()
  {
    if ($this->stmt !== null) {
      $this->stmt = null;
    }
    if ($this->pdo !== null) {
      $this->pdo = null;
    }
  }

  // (C) HELPER - EXECUTE SQL QUERY
  function exec($sql, $data = null)
  {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }

  // (F) GET EVENTS FOR SELECTED MONTH
  function get($month, $year)
  {
    // (F1) FIST & LAST DAY OF MONTH
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dayFirst = "{$year}-{$month}-01 00:00:00";
    $dayLast = "{$year}-{$month}-{$daysInMonth} 23:59:59";
    $id = $_SESSION["id_equipo"];

    // (F2) GET EVENTS
    // $link = conectar();
    // $queryJugador = "SELECT id_entrenador FROM jugador WHERE id=" . $_SESSION['id_jugador'] . ";";
    // $resultJugador = mysqli_query($link, $queryJugador);
    // $idEntrenador = mysqli_fetch_array($resultJugador);
    // $queryFallida = "SELECT id, tipo, start_date, end_date FROM evento WHERE id_entrenador=" . $idEntrenador['id_entrenador'] . ";";
    // -- AND id_entrenador=" . $idEntrenador['id_entrenador'] . "

    // if (!$this->exec($query=
    //   "SELECT * FROM `evento` WHERE `fecha` BETWEEN ? AND ? and id_entrenador = ?",
    //   [$dayFirst, $dayLast, $id]
    // )) {
    //   return false;
    // }

    if (!$this->exec($query=
      "SELECT * FROM `events` WHERE (
        (`evt_start` BETWEEN ? AND ?)
        OR (`evt_end` BETWEEN ? AND ?)
        OR (`evt_start` <= ? AND `evt_end` >= ?)
      ) AND id_equipo = ?",
      [$dayFirst, $dayLast, $dayFirst, $dayLast, $dayFirst, $dayLast, $id]
    )) {
      return false;
    }

    // echo $query;
    // $events = [
    //  "e" => [ EVENT ID => [DATA], EVENT ID => [DATA], ... ],
    //  "d" => [ DAY => [EVENT IDS], DAY => [EVENT IDS], ... ]
    // ]
    $events = ["e" => [], "d" => []];
    while ($row = $this->stmt->fetch()) {
      $eStartMonth = substr($row["evt_start"], 5, 2);
      $eEndMonth = substr($row["evt_end"], 5, 2);
      $eStartDay = $eStartMonth == $month
        ? (int)substr($row["evt_start"], 8, 2) : 1;
      $eEndDay = $eEndMonth == $month
        ? (int)substr($row["evt_end"], 8, 2) : $daysInMonth;
      for ($d = $eStartDay; $d <= $eEndDay; $d++) {
        if (!isset($events["d"][$d])) {
          $events["d"][$d] = [];
        }
        $events["d"][$d][] = $row["evt_id"];
      }
      $events["e"][$row["evt_id"]] = $row;
      $events["e"][$row["evt_id"]]["first"] = $eStartDay;
    }
    return $events;
  }
}

// (H) NEW CALENDAR OBJECT
$_CAL = new Calendar();
