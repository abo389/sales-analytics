<?php

require_once 'functions/socketFunctions.php';
require_once 'functions/calcAnalytics.php';

$db = new SQLite3(__DIR__ . '/database/sales.db');


$address = "127.0.0.1";
$port = "8060";
$null = null;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($sock, $address, $port);

socket_listen($sock);

echo "listening for connection... port: $port \n";

$members = [];
$connections = [];
$connections[] = $sock;

$last_checked_time = time();

while (true) {
  $current_time = time();
  $reads = $connections;
  $writes = $exceptions = $null;

  socket_select($reads, $writes, $exceptions, 0);


  if ($current_time - $last_checked_time >= 5) {
    $data = [
      "type" => "analytic",
      "data" => analytics($db)
    ];
    $analytics = pack_data(json_encode($data));
    foreach ($connections as $ckey => $cvalue) {
      if ($ckey == 0) continue; // Skip the server socket
      @socket_write($cvalue, $analytics, strlen($analytics));
    }

    // Update the last checked time
    $last_checked_time = $current_time;
  }

  // welcome message
  if (in_array($sock, $reads)) {
    $new_connections = socket_accept($sock);
    $header = socket_read($new_connections, 1024);
    handshake($header, $new_connections);
    $connections[] = $new_connections;
    $reply = json_encode([
      "type" => "welcome",
      "data" => "Welcome to the amazing chat socket server ;)"
    ]);
    $reply = pack_data($reply);
    socket_write($new_connections, $reply, strlen($reply));

    $sock_index = array_search($sock, $reads);
    unset($reads[$sock_index]);
  }

  foreach ($reads as $key => $value) {
    $data = @socket_read($value, 1024);

    // Client disconnected
    if ($data === false || $data === '') {
      echo "disconnection client $key \n";
      unset($connections[$key]);
      socket_close($value);
      continue;
    }

    // new message
    if (!empty($data)) {
      $message = unmask($data);
      $packed_message = pack_data($message);
      foreach ($connections as $ckey => $cvalue) {
        if ($ckey == 0) continue; // Skip the server socket
        @socket_write($cvalue, $packed_message, strlen($packed_message));
      }
    }
  }
}

socket_close($sock);
