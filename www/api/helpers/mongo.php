<?php
require_once '../../vendor/autoload.php';

try {
  $client = new MongoDB\Client('mongodb+srv://sircon:NgjL3e5U3wiIpEiT@cluster0.hadwe.azure.mongodb.net/sircon?retryWrites=true&w=majority');
  $db = $client->sircon;
} catch ( MongoConnectionException $e ) {
  echo '<p>Couldn\'t connect to mongodb atlas</p>';
  exit();
}

$return = function($status, $message) {
  http_response_code($status);
  echo json_encode($message);
  exit();
};

?>
