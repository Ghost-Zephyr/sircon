<?php
chdir(dirname(__DIR__));
require_once '../../vendor/autoload.php';
use \Firebase\JWT\JWT;

function jwtGen($data) {
  $key = file_get_contents('/opt/jwt-keys/jwtRS256.key');
  return JWT::encode(
    ['data' => $data],
    $key,
    'HS512'
  );
}

function jwtGet($jwt) {
  try {
    $key = file_get_contents('/opt/jwt-keys/jwtRS256.key');
    return JWT::decode($jwt, $key, array('HS512'))->data;
  } catch (UnexpectedValueException $e) { # Cookie for JWT::decode is null
    http_response_code(401);
    echo json_encode([ 'error' => 'Unauthorized' ]);
    exit();
  }
}
?>
