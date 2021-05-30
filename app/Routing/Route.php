<?php

namespace App\Routing;

use App\Http\HttpException;
use App\Http\Request;
use App\Http\Response;
use Exception;

class Route
{
  /**
   * An array of the routes.
   *
   * @var array
   */
  protected static $routes = [];

  /**
   * The parameter names for the route.
   *
   * @var array
   */
  protected $params;

  /**
   * The currently matches route.
   *
   * @var array|null
   */
  protected $currentRoute = null;

  /**
   * The query names for the route.
   *
   * @var string[]
   */
  private  $query = [];

  /**
   * All of the verbs supported by the router.
   *
   * @var string[]
   */
  protected $verbs = ['GET', 'POST', 'PUT', 'DELETE'];

  public function __construct($method, $path)
  {
    $this->method = $method;
    $this->path = $path;
  }

  /**
   * Adds a route to the collection.
   *
   * @param string $method
   * @param string $uri
   * @param mixed  $callback
   */
  private static function addRoute(string $method, string $uri, $callback)
  {
    $group = ["method" => $method, "uri" => $uri, "callback" => $callback];
    array_push(self::$routes, $group);
  }

  /**
   * Adds a GET route to the collection
   *
   * @param string $uri
   * @param mixed  $callable
   */
  public static function get(string $uri, $callable)
  {
    self::addRoute("GET", $uri, $callable);
  }

  /**
   * Adds a POST route to the collection
   *
   * @param string $uri
   * @param mixed  $callable
   */
  public static function post(string $uri, $callable)
  {
    self::addRoute("POST", $uri, $callable);
  }

  /**
   * Adds a PUT route to the collection
   *
   * @param string $uri
   * @param mixed  $callable
   */
  public static function put(string $uri, $callable)
  {
    self::addRoute("PUT", $uri, $callable);
  }

  /**
   * Adds a DELETE route to the collection
   *
   * @param string $uri
   * @param mixed  $callable
   */
  public static function delete(string $uri, $callable)
  {
    self::addRoute("DELETE", $uri, $callable);
  }

  public function call()
  {

    if (!in_array(strtoupper($this->method), $this->verbs)) {
      return Response::json(HttpException::HttpMethodNotAllowedException());
    }

    $routes = $this->filter_routes_by_method(self::$routes, $this->method);

    foreach ($routes as $value) {
      if ($this->matches($value["uri"], $this->path)) {
        $this->currentRoute = (object) $value;
        break 1;
      }
    }

    if (!$this->currentRoute) {
      return Response::json(HttpException::HttpNotFoundException());
    }

    $args = (object)["params" => $this->params, "query" => (object) $this->query];

    return call_user_func($this->currentRoute->callback, (new Request($args)));
  }

  /**
   * Filter routes by method
   *
   * @param array $routes
   * @param string $method
   *
   * @return array
   */
  protected function filter_routes_by_method(array $routes, string $method)
  {
    return array_filter($routes, function ($value) use ($method) {
      return $method === $value["method"];
    });
  }

  /**
   * Tests whether this route matches the given string.
   *
   * @param string $uri
   * @param string $path
   *
   * @return bool
   */
  private function matches(string $uri, string $path)
  {
    $url = parse_url($path);
    $path = $url["path"];

    $regex = '~^' . preg_replace('/\{(.*?)\}/', '(?<$1>[a-zA-Z0-9_\-\@\.]+)', $uri) . '$~';

    if (preg_match($regex, $path, $parameter)) {

      parse_str($url["query"] ?? '',   $this->query);
      $this->params = (object) array_filter($parameter, function ($k) {
        return is_string($k);
      }, ARRAY_FILTER_USE_KEY);

      return true;
    }
    return false;
  }
}
