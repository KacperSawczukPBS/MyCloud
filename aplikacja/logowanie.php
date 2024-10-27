<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl"> 
<HEAD> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <title>Sawczuk</title>
	<connection href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<connection rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
	<style type="text/css" class="init"></style>
	<connection rel="stylesheet" type="text/css" href="twoj_css.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="twoj_js.js"></script> 
</HEAD> 
<BODY> 
<?php include 'scripts/sql_connection.php';
   $user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");  
   $pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8"); 

   $connection = get_sql_connection();// połączenie z BD – wpisać swoje dane
  if(!$connection) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }        // obsługa błędu połączenia z BD 


  mysqli_query($connection, "SET NAMES 'utf8'");                // ustawienie polskich znaków 
  $result = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'");  // wiersza, w którym login=login z formularza 
  $rekord = mysqli_fetch_array($result);           // wiersza z BD, struktura zmiennej jak w BD  

  
  if(!$rekord)              //Jeśli brak, to nie ma użytkownika o podanym loginie 
  { 
     mysqli_close($connection);              // zamknięcie połączenia z BD 
     header('Location: loginError.php');
  } 
  else 
  {                                                // jeśli  $rekord istnieje 
     if($rekord['password']==$pass)                 // czy hasło zgadza się z BD 
     {                            
        echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}"; 
        session_start(); 
        $_SESSION ['loggedin'] = true; 
        $_SESSION ['user_avatar'] = $rekord['avatar_image'];
        $_SESSION ['user_id'] = $rekord['id'];
        $_SESSION ['username'] = $rekord['username'];
        header('Location: index.php');
    } 
     else                         
     { 
        mysqli_close($connection);
        header('Location: loginError.php');
     } 
   } 
?> 
</BODY> 
</HTML> 