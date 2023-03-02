<?php
function getFromDB($sql) {
  include "database/db.php";
  try {
    $conn = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $response = $stmt->fetchAll();
    $conn = null;
    return $response;
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage() . "<br/>";
      die();
    }
}
?>