<?php
include 'utils/verify.php';

isset($_COOKIE["token"]) ? $token = ($_COOKIE["token"]): $token = false;
$validToken = verify($token);
if($validToken) {
  echo '200';
} else {
  echo '401';
}
?>