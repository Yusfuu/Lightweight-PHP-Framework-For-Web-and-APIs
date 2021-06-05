<?php

namespace App\Http;

class HttpException
{
  public static function HttpNotFoundException()
  {
    http_response_code(404);

    return [
      "code" => 404,
      "message" => "404 Not Found",
      "description" => "The requested resource could not be found."
    ];
  }

  public static function HttpMethodNotAllowedException()
  {
    http_response_code(405);

    return [
      "code" => 405,
      "message" => "Method not allowed.",
      "description" => "The request method is not supported for the requested resource."
    ];
  }


  public static function HttpUnauthorizedException()
  {
    http_response_code(401);

    return [
      "code" => 401,
      "message" => "Unauthorized.",
      "description" => "The request requires valid user authentication."
    ];
  }

  public static function HttpForbiddenException()
  {
    http_response_code(403);

    return [
      "code" => 403,
      "message" => "Forbidden.",
      "description" => "You are not permitted to perform the requested operation."
    ];
  }

  public static function HttpBadRequestException()
  {
    http_response_code(400);

    return [
      "code" => 400,
      "message" => "Bad request.",
      "description" => "The server cannot or will not process the request due to an apparent client error."
    ];
  }
}
