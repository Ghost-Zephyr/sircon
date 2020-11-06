<?php

require 'helpers/mongo.php';
$colors = $db->color;

switch($_SERVER['REQUEST_METHOD']) {

case 'GET':
  $data = array();
  foreach($colors->find([]) as $color) {
    array_push($data, [
      'x' => $color->x,
      'y' => $color->y,
      'color' => $color->color
    ]);
  }
  $return(200, array('success' => $data));
break;

case 'POST':
  require 'helpers/jwt.php';
  $json = json_decode(file_get_contents('php://input'));
  if ($json->x == null or $json->y == null) {
    $return(400, array('error' => 'x and y must be set.'));
  }
  $jwt = jwtGet($_COOKIE['jwt']); # What happens with invalid token?
  $colors->deleteOne([
    'x' => $json->x,
    'y' => $json->y
  ]);
  $colors->insertOne([
    'x' => $json->x,
    'y' => $json->y,
    'color' => $jwt->color,
    'user' => $jwt->nick
  ]);
  $return(200, array('success' => 'Added box with coords: x: '.$json->x.', y: '.$json->y.' and color: '.$jwt->color.'.'));
break;

default:
  $return(405, array('error' => 'Method not allowed'));
break;
}

?>
