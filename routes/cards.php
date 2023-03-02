<?php
include 'database/getFromDB.php';
include 'utils/verify.php';

isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
$validToken = verify($token);
if($validToken) {
    $sql = "SELECT * FROM cards_cards WHERE user_name='$user'";
    $result = getFromDB($sql);
    echo json_encode($result, JSON_NUMERIC_CHECK);
}
?>