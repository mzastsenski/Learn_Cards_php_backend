<?php
include 'database/postToDB.php';
include 'utils/verify.php';

isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
$validToken = verify($token);
if($validToken) {
  $data = json_decode(file_get_contents("php://input"));
  $sql = "DELETE FROM cards_cards WHERE id=$data->id";
  postToDB($sql);
} else {
  http_response_code(401);
}
?>