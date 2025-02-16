<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ApiTest extends TestCase
{
  private $client;

  protected function setUp(): void
  {
    parent::setUp();
    $this->client = new Client(['base_uri' => 'http://localhost:8000/backend']);
  }

  public function test_api_product_return_success()
  {
    $response = $this->client->get("/api/products");
    $this->assertEquals(200, $response->getStatusCode());
  }

  public function test_api_recommendations_return_success()
  {
    $response = $this->client->get("/api/recommendations");
    $this->assertEquals(200, $response->getStatusCode());
  }

  public function test_api_analytics_return_success()
  {
    $response = $this->client->get("/api/analytics");
    $this->assertEquals(200, $response->getStatusCode());
  }

  public function test_api_orders_return_success()
  {
    $response = $this->client->post("/api/orders", [
      'json' => [
        'product_id' => 1,
        'quantity' => 3,
        'price' => 15
      ]
    ]);
    $this->assertEquals(200, $response->getStatusCode());
  }

}
