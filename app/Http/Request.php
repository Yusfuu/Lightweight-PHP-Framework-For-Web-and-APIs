<?php

namespace App\Http;

class Request
{
  public $params;
  public $query;
  public $contentType;
  public $method;
  public $path;

  public function __construct($args)
  {
    $this->params = $args->params;
    $this->query = $args->query;
    $this->contentType = $_SERVER["CONTENT_TYPE"] ?? '';
    $this->method = $_SERVER["REQUEST_METHOD"];
    $this->path = $_SERVER["REQUEST_URI"];
  }

  public static function url()
  {
    return (object)["method" => $_SERVER["REQUEST_METHOD"], "path" => $_SERVER["REQUEST_URI"]];
  }

  public function json()
  {
    if ($this->method !== "POST" || $this->contentType !== "application/json") {
      return [];
    }
    return json_decode(trim(file_get_contents("php://input")));
  }

  public function input()
  {
    if ($this->method === "PUT") {
      parse_str(file_get_contents("php://input"), $body);
      return (object)$body;
    }

    if ($this->method !== "POST") {
      return [];
    }

    $body = [];
    foreach ($_POST as $key => $value) {
      $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    return (object)$body;
  }
}
