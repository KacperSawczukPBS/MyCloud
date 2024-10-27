<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
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
</head>

<body>
<?php include 'scripts/sql_connection.php';

$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");  
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");                             // hasło z formularza 
$rep_pass = htmlentities ($_POST['rep_pass'], ENT_QUOTES, "UTF-8"); 

  if($rep_pass !== $pass){
    echo "Hasła są niezgodne!";
    echo "<div class=\"row mt-1\">
            <div class=\"col\">
            <a href=\"zarejestruj.php\" class=\"w-100 btn btn-lg btn-primary\">Rejestracja</a>  
            </div>
        </div>";
    exit();
  }

  $target_dir = "media/user_avatars/";
  $defaultAvatarFile = $target_dir . "default.svg";

  $avatar =  getUserAvatar($defaultAvatarFile, $target_dir);

  echo $avatar;

  $connection = get_sql_connection();                  // połączenie z BD – wpisać swoje dane 
  
  if(!$connection) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }        // obsługa błędu połączenia z BD
   
  mysqli_query($connection, "SET NAMES 'utf8'"); 

  $result = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'");  // wiersza, w którym login=login z formularza 
  $rekord = mysqli_fetch_array($result); 

  if($rekord)              //Jeśli brak, to nie ma użytkownika o podanym loginie 
  { 
     mysqli_close($connection);              // zamknięcie połączenia z BD 
     header('Location: register_error.php');
  } 

  $sql = "INSERT INTO users (username, password, avatar_image) VALUES ('$user', '$pass', '$avatar');"; // wiersza, w którym login=login z formularza           // wiersza z BD, struktura zmiennej jak w BD  
  
  if(!mysqli_query($connection, $sql)){
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<div class=\"row mt-1\">
    <div class=\"col\">
    <a href=\"zarejestruj.php\" class=\"w-100 btn btn-lg btn-primary\">Rejestracja</a>  
    </div>
</div>";
    exit();
  }

  mysqli_close($connection);

  $avatarAdded = addUserAvatar($avatar, $target_dir, $defaultAvatarFile);

  if(!$avatarAdded){
    echo "<br />Nie udało się dodać avataru";
  }

    echo "<br />Pomyślnie utworzono użytkownika {$user}";
    echo "<div class=\"row mt-1\">
    <div class=\"col\">
    <a href=\"zaloguj.php\" class=\"w-100 btn btn-lg btn-primary\">Logowanie</a>  
    </div>
    </div>";


  function addUserAvatar($target_file, $target_dir, $defaultAvatarFile){
    if($target_file == $defaultAvatarFile){
      return true;
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], strtolower($target_file))) {
      echo "<br />Plik ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " został dodany.";
      return true;
    }

    echo "<br />Wystąpił problem z dodaniem avatara.";
    return false;
  }

  function getUserAvatar($defaultAvatarFile, $target_dir){
    $fileName = $_FILES["fileToUpload"]["name"];
    if(empty($fileName)){
      return $defaultAvatarFile;
    }
    
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    if (file_exists($target_file)) {
      echo "<br />Avatar o takiej nazwie już istnieje.";
      exit();
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "Podany avatar jest zbyt duży. Maksymalnie dopuszczalny jest rozmiar 5MB";
      exit();
    }

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "svg") {
        echo "<br />Dozwolone formaty pliku to jpg,png,jpeg,svg";
        exit();
    }
    return $target_file;
  }
  
 
?> 
</body>

</html>

