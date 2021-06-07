<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;

class Auth
{

  public static function create($body, string $strtime = "")
  {
    $iat = time();

    if (($timestamp = strtotime($strtime)) === false) {
      $timestamp = ($iat + 2629746);
    }

    $payload = [
      "iat" => $iat,
      "exp" => $timestamp,
      "dd" => $body
    ];

    return (object)["type" => "Bearer", "token" => JWT::encode($payload, $_ENV['APP_KEY'])];
  }


  public static function verify(?string $jwt = null)
  {
    if (preg_match('/Bearer\s(\S+)/', $jwt, $matches)) {
      try {
        $decoded = JWT::decode($matches[1], $_ENV['APP_KEY'], array('HS256'));
        return $decoded;
      } catch (\Throwable $th) {
        return null;
      }
    } else {
      return null;
    }
  }
}
