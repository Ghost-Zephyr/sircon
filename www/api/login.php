<?php

require 'helpers/mongo.php';

$json = json_decode(file_get_contents('php://input'));

if ($json->nick == null or $json->pass == null) {
  $return(400, array('error' => 'Nick and password must be set.'));
}

require 'helpers/jwt.php';
$users = $db->user;

foreach($users->find([ 'nick' => $json->nick ]) as $user) {
  if ($user->pass == hash('sha512', $user->salt.$json->pass)) {
    setcookie('jwt', jwtGen([
      'nick' => $json->nick,
      'color' => $user->color
    ]), 'Session','/');
    setcookie('color', $user->color, 'Session','/');
    $return(200, array('success' => 'Logged in as '.$json->nick.'.'));
  } else {
    $return(400, array('error' => 'Incorrect password for user '.$user->nick.'.'));
  }
}
$return(400, array('error' => 'User '.$json->nick.' does not exist.'));

?>
