<?php
include 'utils/vendor/autoload.php';
include 'utils/vendor/DevCoder.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use DevCoder\DotEnv;

(new DotEnv('utils/.env'))->load(); 

function verify($token) {
  if ($token) {
    try {
      $jwt = $_COOKIE["token"]; 
      $secret_key = getenv('SECRET');
      $user=JWT::decode($jwt, new Key($secret_key, 'HS256'));
      if($user->exp-time() <= 2 * 3600 ) {
        $new_data = [
          'iss' => $user->iss,
          'aud' => $user->aud,
          'exp' => time() + 24 * 3600, 
          'data' => $user->data,
        ];
        $new_jwt = JWT::encode($new_data, $secret_key, 'HS256');
        setcookie("token", $new_jwt, time()+ 24 * 3600, "/", "", false, true); // secure false, httpOnly true
      }  return true;  
    } catch(Exception $e) {
     return false;
    }
  } else {
    return false;
  }
}

?>