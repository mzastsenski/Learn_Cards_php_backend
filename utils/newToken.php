<?php
require_once 'utils/vendor/autoload.php';
require_once 'utils/vendor/DevCoder.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use DevCoder\DotEnv;

(new DotEnv('utils/.env'))->load(); 

function newToken($username) {
  $payload = [
    'iss' => "asdf",
    'aud' => "sdfg",
    'exp' => time() + 24 * 3600, 
    'data' => [
        'user' => $username
    ],
  ];      
  $secret_key = getenv('SECRET');
  $jwt = JWT::encode($payload, $secret_key, 'HS256');      
  setcookie("token", $jwt, time() + 24 * 3600, "/", "", false, true); // secure false, httpOnly true
  echo '200';
 
}

?>