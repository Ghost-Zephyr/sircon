<?php

function genSalt($length = 6) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

$json = json_decode(file_get_contents('php://input'));
if ($json->nick == null or $json->pass == null) {
  $return(400, array('error' => 'Nick and password must be set.'));
}

require 'helpers/mongo.php';
require 'helpers/jwt.php';
$users = $db->user;

foreach($users->find([ 'nick' => $json->nick ]) as $user) {
  $return(400, array('error' => 'User '.$user->nick.' exists.'));
  exit();
}

if (!preg_match("/^#([0-9a-f]{3}){1,2}$/i", $json->color)) {
  $return(400, array('error' => 'Invalid hexcode for color'));
  exit();
}
$salt = genSalt();
$users->insertOne([
  'nick' => $json->nick,
  'color' => $json->color,
  'pass' => hash('sha512', $salt.$json->pass),
  'salt' => $salt
]);

setcookie('jwt', jwtGen([
  'nick' => $json->nick,
  'color' => $json->color
]), 'Session','/');
setcookie('color', $json->color, 'Session','/');
$return(200, array('success' => 'Created user '.$json->nick.'.'))

?>
