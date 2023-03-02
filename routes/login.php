<?php
include 'database/getFromDB.php';
include 'utils/bcrypt.php';
include 'utils/newToken.php';

$data = json_decode(file_get_contents("php://input"));
$sql = "SELECT * FROM users_cards WHERE name='$data->user'";

$result = getFromDB($sql);
if (!count($result)) echo '401';
else {
  $bcrypt = new Bcrypt();
  $hash = $result[0]["password"];
  $compare = $bcrypt->verify($data->pass, $hash);
  if ($compare) newToken($result[0]["name"]);
  else echo '401';
}
?>