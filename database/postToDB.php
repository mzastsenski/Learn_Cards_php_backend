<?php
function postToDB($sql) {
  require_once "database/db.php";
  try {
    $conn = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
    http_response_code(200);
    echo '200';
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage() . "<br/>";
      die();
    }
}
?>