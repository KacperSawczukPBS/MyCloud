<?php declare(strict_types=1);  /* Ta linia musi być pierwsza */ 

session_start();
$loggedIn = isset($_SESSION['loggedin']);

if(!$loggedIn){
header('Location: zaloguj.php');
exit("koniec");
}

?>