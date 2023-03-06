<?php
require_once 'database/getFromDB.php';
require_once 'database/postToDB.php';
require_once 'utils/bcrypt.php';
require_once 'utils/newToken.php';
require_once 'utils/verifyToken.php';

$login = function() {  
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
};

$signUp = function() {  
  $data = json_decode(file_get_contents("php://input"));
  $sql = "SELECT * FROM users_cards WHERE name='$data->user'";
  $result = getFromDB($sql);
  if (count($result)) echo '401';
  else {
    $bcrypt = new Bcrypt();
    $hash = $bcrypt->hash($data->pass);
    $sql = "INSERT INTO users_cards (name, password) VALUES ('$data->user','$hash')";
    postToDB($sql);
  }
};

$logout = function() {
  setcookie("token", "", time() + 1, "/", "", false, true);
  echo '200';
};

$checkUser = function() {
  isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
  $validToken = verify($token);
  if($validToken) {
    echo '200';
  } else {
    echo '401';
  }
};
?>