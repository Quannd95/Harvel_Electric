<?php 
define("host", "localhost:3310");
define("user", "root");
define("password","");
define("database","harvel_electric");

function connectToDB(){
    return new PDO("mysql:host=" . host . ";dbname=" . database, user, password);
}
?>