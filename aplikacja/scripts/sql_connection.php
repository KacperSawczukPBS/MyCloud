<?php
    function get_sql_connection(){
        $connection = mysqli_connect("mysql8", "38985040_zadanie5", "Zadanie5!", "38985040_zadanie5");  
        return $connection;
    }
?>