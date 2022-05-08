<?php

    session_start();
    
    unset($_SESSION["error"]);
    unset($_SESSION["id_alumno"]);
    
    session_destroy();
    header("Location:index.php");
