<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;

class Route
{
  private static $routes = [];
  private $matches_route = null;
  private $wildcard = '/\{(.*?)\}/';
  private $parameters = [];
  private $query = [];

  public function __construct($method, $path)
  {
    $this->method = $method;
    $this->path = $path;
  }

  public static function get($uri, $fn)
  {
    self::make("GET", $uri, $fn);
  }

  public static function post($uri, $fn)
  {
    self::make("POST", $uri, $fn);
  }

  public static function put($uri, $fn)
  {
    self::make("PUT", $uri, $fn);
  }

  public static function delete($uri, $fn)
  {
    self::make("DELETE", $uri, $fn);
  }

  public function call()
  {
    $routes = $this->filter_routes_by_method(self::$routes, $this->method) ?: Response::_404();

    foreach ($routes as $value) {
      if ($this->matche($value["pattern"], $this->path) === true) {
        $this->matches_route = (object) $value;
        break 1;
      }
    }

    $this->matches_route ?: Response::_404();

    $callback = $this->matches_route->callback;
    $arg = (object)["params" => (object) $this->parameters, "query" => (object) $this->query];
    return call_user_func($callback, (new Request($arg)));
  }

  public static function make($method, $pattern, $callback)
  {
    $action = ["method" => $method, "pattern" => $pattern, "callback" => $callback];
    array_push(self::$routes, $action);
  }

  protected function filter_routes_by_method(array $routes, string $method)
  {
    $_ = [];
    foreach ($routes as $value) {
      if ($value["method"] === $method) {
        array_push($_, $value);
      }
    }
    return $_;
  }

  public function matche($pattern, $path)
  {
    $url = parse_url($path);
    $path = $url["path"];
    parse_str($url["query"] ?? '', $this->query);

    $parameters = preg_replace_callback($this->wildcard, function ($m) {
      return '(?<' . preg_replace($this->wildcard, '$1', $m[0]) . '>[a-zA-Z0-9_\-\@\.]+)';
    }, $pattern);

    $parameters =  ('@^' . $parameters . '$@');

    if (preg_match($parameters, $path, $params)) {
      foreach ($params as $key => $value) {
        if (is_string($key)) {
          $this->parameters[$key] = $value;
        }
      }
      return true;
    }
    return false;
  }
}
