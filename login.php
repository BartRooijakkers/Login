<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
// Database Instellingen
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "";
$username = $_POST['username'];
$password = $_POST['password'];
// Connectie variabele
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
// Password vergelijken
$password = hash("sha256",$password);
// SQL: alles van de gebruikers
$sql = "SELECT user.* WHERE user.email = '{$username}' AND user.password = '{$password}'";
// Query de database
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
// Als er meer dan 0 resulta(a)t(en) zijn.
if($resultCheck > 0){
  // Stop de column als array in het variabele $row.
  if($row = mysqli_fetch_assoc($result)){
    // Laat de achternaam zien
	$_SESSION['user'] = [$row['initials'];
	header('Location: ../php/profiel.php');
  }
// Als login is mislukt wordt je terug verwezen
}
else{
	header('Location:../php/index.php?error');
}
?>
