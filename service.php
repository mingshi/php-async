<?php
function fork_and_exec($cmd, $args=array()) {
    $pid = pcntl_fork();
    if ($pid > 0) {
        return $pid;
    } else if ($pid == 0) {
        pcntl_exec($cmd, $args);
        exit(0);
    } else {
        // TODO:
        die('could not fork');
    }
}


if (isset($argv[1])) {
    $c = $argv[1];
} else {
    $c = 5;
}

$worker = dirname(__FILE__) . '/worker.php';
for ($i = 0; $i < $c; $i++) {
    $pids[] = fork_and_exec('/usr/bin/env', array('php', $worker));
}


