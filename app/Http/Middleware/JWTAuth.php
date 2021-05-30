<?php

namespace App\Http\Middleware;

use App\Http\Response;
use Firebase\JWT\JWT;

class JWTAuth
{

  public static function create($body)
  {
    $iat = time();

    $payload = array(
      "iat" => $iat,
      "exp" => $iat + 6000000,
      "data" => $body
    );

    return (object)["type" => "Bearer", "token" => JWT::encode($payload, $_ENV['APP_KEY'])];
  }


  public static function verify(?string $jwt = null, $bearer = false)
  {
    if ($bearer === true) {
    }
    // if (!preg_match('/Bearer\s/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    //   header('HTTP/1.0 400 Bad Request');
    //   echo 'Token not found in request';
    //   exit;
    // }
    // Response::json($matches);
    try {
      $decoded = JWT::decode($jwt, $_ENV['APP_KEY'], array('HS256'));
      return $decoded;
    } catch (\Throwable $th) {
      return null;
    }
  }
}
