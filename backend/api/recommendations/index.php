<?php
header('Content-Type: application/json');

$db = new SQLite3('../../database/sales.db');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET") {
  // Fetch last 10 orders
  $result = $db->query("SELECT * FROM Orders ORDER BY date DESC LIMIT 10");
  $orders = [];

  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $orders[] = $row;
  }

  // Set up DeepSeek API
  $deepSeekKey = "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";
  $prompt = "Given this sales data: " . json_encode($orders) . " which products should we promote for higher revenue?";

  // cURL request to DeepSeek
  $ch = curl_init("https://models.github.ai/inference/chat/completions");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $deepSeekKey",
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

  echo json_encode(['data' => $content]);
}
