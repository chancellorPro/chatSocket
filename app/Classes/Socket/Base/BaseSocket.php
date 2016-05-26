<?php

namespace App\Classes\Socket\Base;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class BaseSocket implements  MessageComponentInterface
{

    #open connect
    public function onOpen (ConnectionInterface $conn){

    }

    #message on server
    public function onMessage (ConnectionInterface $from, $msg){

    }

    public function onClose (ConnectionInterface $conn){

    }

    public function onError (ConnectionInterface $conn, \Exception $e){

    }


}