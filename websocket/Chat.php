<?php declare(strict_types=1);

namespace App\websocket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "new connection| ({$conn->resourceId}) \n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "connection ({$conn->resourceId}) has disconnection \n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurd: ({$e->getMessage()}) \n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }
}
