<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

function isJson($string) {
  json_decode($string);
  return (json_last_error() == JSON_ERROR_NONE);
}

class Chat implements MessageComponentInterface {
  protected $clients;

  public function __construct() {
    $this->clients = new \SplObjectStorage;
  }

  public function onOpen(ConnectionInterface $conn) {
    $this->clients->attach($conn);
    echo "New connection {$conn->resourceId}\n";
  }

  public function onMessage(ConnectionInterface $from, $msg) {
    $numRecv = count($this->clients)-1;
    if (isJson($msg)) {
      echo "Message is valid, sending.\n";
      foreach ($this->clients as $client) {
        if ($from !== $client) {
          $client->send($msg);
        }
      }
      echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        , $from->resourceId, trim(preg_replace('/\s\s+/', ' ', $msg)), $numRecv, $numRecv == 1 ? '' : 's');
    } else {
      echo sprintf('Connection %d sent invalid message, not sending.', $from->resourceId);
    }
  }

  public function onClose(ConnectionInterface $conn) {
    $this->clients->detach($conn);
    echo "Connection {$conn->resourceId} has disconnected\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {
    echo "An error has occurred: {$e->getMessage()}\n";
    $this->clients->detach($conn);
    $conn->close();
  }
}

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new Chat()
    )
  ),
  6969
);

$server->run();
?>
