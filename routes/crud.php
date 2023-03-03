<?php
require_once 'utils/verifyToken.php';
require_once 'database/getFromDB.php';
require_once 'database/postToDB.php';

$getCards = function($user) {
  isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
  $validToken = verify($token);
  if($validToken) {
      $sql = "SELECT * FROM cards_cards WHERE user_name='$user'";
      $result = getFromDB($sql);
      echo json_encode($result, JSON_NUMERIC_CHECK);
  }
};

$newCard = function() {  
  isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
  $validToken = verify($token);
  if($validToken) {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->collection)) $collection = $data->collection;
    else $collection = "Collection";
    $sql = "INSERT INTO cards_cards (user_name, de, eng, lang, collection)
    VALUES ('$data->user', '$data->de', '$data->eng', 'eng', '$collection')";
    postToDB($sql);
  } else {
    http_response_code(401);
  }
};

$deleteCard = function() { 
  isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
  $validToken = verify($token);
  if($validToken) {
    $data = json_decode(file_get_contents("php://input"));
    $sql = "DELETE FROM cards_cards WHERE id=$data->id";
    postToDB($sql);
  } else {
    http_response_code(401);
  }
};
?>