<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require('../../functions/calcAnalytics.php');

$db = new SQLite3('../../database/sales.db');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
  echo json_encode(analytics($db));
}
