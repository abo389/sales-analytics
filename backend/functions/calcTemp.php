<?php

function temp($city)
{
  $apiKey = "e406e379c44bea2226902963cc98b7dc";
  $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

  $response = @file_get_contents($url);
  $data = json_decode($response, true);
  $temp = @$data["main"]["temp"];

  return ($temp);
}