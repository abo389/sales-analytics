<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../../functions/calcTemp.php';

$db = new SQLite3('../../database/sales.db');

$method = @$_SERVER['REQUEST_METHOD'];
$city = @substr($_SERVER['QUERY_STRING'],5);

if ($method == "GET") {
  $temp = temp($city);
  // $temp = 13;
  if($temp < 25) $condition = "WHERE p.sub_category_id = 1 OR p.sub_category_id = 4";
  else $condition = "WHERE p.sub_category_id = 2 OR p.sub_category_id = 3";
  $result = $db->query(
    "SELECT p.product_id, p.name, p.price+1 AS price, p.description, c.name as 'category'
    FROM Product p
    JOIN SubCategory c ON p.sub_category_id = c.sub_category_id
    ".$condition);
  $products = [];

  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $products[] = $row;
  }

  echo json_encode($products);
}