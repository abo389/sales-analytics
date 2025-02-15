<?php

function analytics($db) {

  // Get total revenue
  $result = $db->query(
    "SELECT SUM(price * quantity) 
    as total_revenue 
    FROM Orders"
  );
  $totalRevenue = $result->fetchArray(SQLITE3_ASSOC)["total_revenue"];

  // Get top-selling products
  $result = $db->query(
    "SELECT product_id, SUM(quantity) 
    as total_sold 
    FROM Orders 
    GROUP BY product_id 
    ORDER BY total_sold DESC LIMIT 3"
  );
  $topProducts = [];
  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $topProducts[] = $row;
  }

  // Get recent orders (last 1 minute)
  $result = $db->query(
    "SELECT COUNT(*) 
    as order_count, SUM(price * quantity) 
    as last_minute_revenue 
    FROM Orders 
    WHERE date >= datetime('now', '-1 minutes')"
  );
  $recentData = $result->fetchArray(SQLITE3_ASSOC);

  return [
    "total_revenue" => $totalRevenue,
    "top_products" => $topProducts,
    "last_minute_revenue" => $recentData["last_minute_revenue"],
    "order_count_last_minute" => $recentData["order_count"]
  ];
}