<?php
include 'database/postToDB.php';
include 'utils/verify.php';

isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
$validToken = verify($token);
if($validToken) {
  $data = json_decode(file_get_contents("php://input"));
  if (isset($data->collection)) $collection = $data->collection;
  else $collection = "Collection";
  $sql = "INSERT INTO cards_cards (user_name, rus, eng, lang, collection)
  VALUES ('$data->user', '$data->rus', '$data->eng', 'eng', '$collection')";
  postToDB($sql);
} else {
  http_response_code(401);
}
?>