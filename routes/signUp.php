<?php
include 'database/getFromDB.php';
include 'database/postToDB.php';
include 'utils/bcrypt.php';

$data = json_decode(file_get_contents("php://input"));
$sql = "SELECT * FROM users_cards WHERE name='$data->user'";
$result = getFromDB($sql);
if (count($result)) echo '401';
else { 
  $bcrypt = new Bcrypt(12);
  $hash = $bcrypt->hash($data->pass);
  $sql = "INSERT INTO users_cards (name, password)
  VALUES ('$data->user','$hash')";  
  postToDB($sql);
}
?>