<?php
$context = new ZMQContext();

$receiver = new ZMQSocket($context, ZMQ::SOCKET_PULL);
$receiver->connect("tcp://localhost:5555");

$sender = new ZMQSocket($context, ZMQ::SOCKET_PUSH);
$sender->connect("tcp://localhost:5556");

while(true) {
    $string = $receiver->recv();
    if ($string == "a") {
        sleep(1);
        $sender->send("replya");
    } else if ($string == "b") {
        sleep(2);
        $sender->send("replyb");
    }
}
