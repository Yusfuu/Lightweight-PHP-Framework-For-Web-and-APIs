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


  public static function _404()
  {
    http_response_code(404);
    $resposne = [
      "code" => 404,
      "type" => "404 Not Found",
      "message" => "The requested resource could not be found but may be available again in the future."
    ];
    return self::json($resposne);
  }
}
