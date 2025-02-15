<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = new SQLite3('../../database/sales.db');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {

  // Read order data
  $data = json_decode(file_get_contents("php://input"), true);
  $product_id = $data["product_id"];
  $quantity = $data["quantity"];
  $price = $data["price"];
  $timestamp = date("Y-m-d H:i:s");

  // Insert order into DB
  $stmt = $db->prepare("INSERT INTO 
  Orders (product_id, quantity, price, date) 
  VALUES (?, ?, ?, ?)");
  $stmt->bindParam(1, $product_id);
  $stmt->bindParam(2, $quantity);
  $stmt->bindParam(3, $price);
  $stmt->bindParam(4, $timestamp);
  $stmt->execute();

  echo json_encode(["message" => "Order added successfully"]);
}
