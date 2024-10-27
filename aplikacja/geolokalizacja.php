<?php include 'scripts/sql_connection.php';

    $ipaddress = $_SERVER["REMOTE_ADDR"];

    function ip_details($ip) { 
    $json = file_get_contents ("http://ipinfo.io/{$ip}?token=65df8a484bc078"); 
    $details = json_decode ($json); 
    return $details; 
    } 

    $connection = get_sql_connection();

// Sprawdź połączenie
    if ($connection->connection_error) {
        die("Połączenie nieudane: " . $connection->connection_error);
        echo "Błąd";
    }

    $browser = get_browser();
    $browserName = $browser->browser;

    $data = file_get_contents("php://input");
    $userInfo = json_decode($data, true);
    $screenResolution = $userInfo['screenResolution'];
    $windowResolution = $userInfo['windowResolution'];
    $colorDepth = $userInfo['colorDepth'];
    $cookiesEnabled = $userInfo['cookiesEnabled'];
    $javaEnabled = $userInfo['javaEnabled'];
    $browserLanguage = $userInfo['browserLanguage'];

// Przygotuj i wykonaj zapytanie SQL
    $sql = "INSERT INTO goscieportalu (ipaddress,browser,screenResolution, windowResolution, colorDepth, cookiesEnabled, javaEnabled, browserLanguage) VALUES ('$ipaddress','$browserName', '$screenResolution', '$windowResolution', '$colorDepth', '$cookiesEnabled', '$javaEnabled', '$browserLanguage')";

    if ($connection->query($sql) === TRUE) {
        echo "Adres IP zapisano pomyślnie";
    } else {
        echo "Błąd: " . $sql . "<br>" . $connection->error;
    }

// Zamknij połączenie
    $connection->close();
?> 