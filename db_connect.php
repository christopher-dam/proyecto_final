<?php
//Función que se conecta a la BD y devuelve el link
define("DB_HOST", "localhost");
define("DB_NAME", "justvoley");
define("DB_CHARSET", "utf8");
define("DB_USER", "myjustvole");
define("DB_PASSWORD", "admin123+");
function conectar(){
    if(!($link=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME))){
        $_SESSION["error"]="Imposible conectar con servidor MySQL o la base de datos";
        exit();
        }
   return $link;    
}
?>