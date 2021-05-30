<?php

namespace App\Http;

class Response
{
  public static function json($body)
  {
    header('Content-Type: application/json');
    exit(json_encode($body));
  }

  public static function make($code, $type, $message)
  {
    return [
      "code" => $code,
      "type" => $type,
      "message" => $message
    ];
  }
}
