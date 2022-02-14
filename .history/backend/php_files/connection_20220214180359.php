<?php 
define("host", "localhost:3306");
define("user", "root");
define("password","");
define("database","harvel_electric");

function connectToDB(){
    return new PDO("mysql:host=" . host . ";dbname=" . database, user, password);
}
?>