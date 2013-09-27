<?php
$context = new ZMQContext();

/**
  * send task first
  */
$sender = new ZMQSocket($context, ZMQ::SOCKET_PUSH);
$sender->bind("tcp://*:5555");

echo "start async \n";
$bt = time();

$sender->send(0);
$sender->send("a");
$sender->send("b");

/**
  * get the response
  */

$context = new ZMQContext();
$receiver = new ZMQSocket($context, ZMQ::SOCKET_PULL);
$receiver->bind("tcp://*:5556");

for ($i=0; $i<2; $i++) {
    $string = $receiver->recv();
    echo $string . "\n";
}

echo "async use time:" . (time() - $bt) . " seconds\n";

function aps_microtime() {
    return round(microtime(true) * 1000000);
}
