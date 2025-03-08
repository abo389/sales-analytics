<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../../Token.php';

$db = new SQLite3('../../database/sales.db');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
  // Fetch last 10 orders
  $result = $db->query("SELECT * FROM Orders ORDER BY date DESC LIMIT 10");
  $orders = [];

  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $orders[] = $row;
  }

  $Key = $API_KEY;
  $prompt = "Given this sales data: " . json_encode($orders) . " which products should we promote for higher revenue i want json respons only";

  // cURL request to DeepSeek
  $ch = curl_init("https://models.inference.ai.azure.com/chat/completions");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $Key",
    "Content-Type: application/json"
  ]);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "model" => "gpt-4o", 
    "messages" => [["role" => "user", "content" => $prompt]]
  ]));

  // Execute request
  $response = curl_exec($ch);
  curl_close($ch);

  // Output AI recommendations
  $response = json_decode($response,true);

  $content = $response['choices'][0]['message']['content'];

  $content = substr($content, 7);
  $content = substr($content, 0, -4);
  echo $content;
}
