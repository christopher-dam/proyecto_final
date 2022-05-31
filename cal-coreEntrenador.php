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

  // (D) SAVE EVENT
  function save($start, $end, $txt, $detalles, $color, $id_equipo ,$id = null)
  {
    // (D1) START & END DATE QUICK CHECK
    $uStart = strtotime($start);
    $uEnd = strtotime($end);
    if ($uEnd < $uStart) {
      $this->error = "La fecha de fin no puede ser antes que la fecha de inicio";
      return false;
    }

    // (D2) SQL - INSERT OR UPDATE
    if ($id == null) {
      $sql = "INSERT INTO `events` (`evt_start`, `evt_end`, `evt_text`, `detalles`, `evt_color`, `id_equipo`) VALUES (?,?,?,?,?,?)";
      $data = [$start, $end, $txt, $detalles, $color, $id_equipo];
    } else {
      $sql = "UPDATE `events` SET `evt_start`=?, `evt_end`=?, `evt_text`=?, `detalles`=?, `evt_color`=?, `id_equipo`=? WHERE `evt_id`=?";
      $data = [$start, $end, $txt, $detalles, $color, $id_equipo, $id];
    }

    // (D3) EXECUTE
    return $this->exec($sql, $data);
  }

  // (E) DELETE EVENT
  function del($id)
  {
    return $this->exec("DELETE FROM `events` WHERE `evt_id`=?", [$id]);
  }

  // (F) GET EVENTS FOR SELECTED MONTH
  function get($month, $year)
  {
    // (F1) FIST & LAST DAY OF MONTH
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dayFirst = "{$year}-{$month}-01 00:00:00";
    $dayLast = "{$year}-{$month}-{$daysInMonth} 23:59:59";
    $id = $_SESSION["id_entrenador"];

    // (F2) GET EVENTS
    if (!$this->exec($query=
      "SELECT * FROM `events` WHERE (
        (`evt_start` BETWEEN ? AND ?)
        OR (`evt_end` BETWEEN ? AND ?)
        OR (`evt_start` <= ? AND `evt_end` >= ?)
      ) AND id_equipo in (select id from equipo where id_entrenador = ?)",
      [$dayFirst, $dayLast, $dayFirst, $dayLast, $dayFirst, $dayLast, $id]
    )) {
      return false;
    }
  
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
