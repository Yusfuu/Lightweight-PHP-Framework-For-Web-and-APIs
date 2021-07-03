<?php

namespace App\Routing;

use App\Http\HttpException;
use App\Http\Request;
use App\Http\Response;

class Route extends RouteCollector
{

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
   * The args names for the route.
   * 
   * @var object
   */
  protected $args;

  /**
   * All of the verbs supported by the router.
   *
   * @var string[]
   */
  protected $verbs = ["GET", "POST", "PUT", "DELETE"];

  public function __construct()
  {
    $this->args = $this->request_url();
  }

  public function call()
  {
    $routes = $this->filter_routes_by_method(self::$routes, $this->args->method);

    foreach ($routes as $value) {
      if ($this->matches($value["uri"], $this->args->path ?? "/")) {
        $this->currentRoute = (object) $value;
        break 1;
      }
    }

    if (!$this->currentRoute) {
      return Response::json(HttpException::HttpNotFoundException());
    }
    $this->args->params = $this->params;
    return call_user_func($this->currentRoute->callback, (new Request($this->args)));
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
    $regex = "~^" . preg_replace("/\{(.*?)\}/", "(?<$1>[a-zA-Z0-9_\-\@\.]+)", $uri) . "$~";

    if (preg_match($regex, $path, $parameter)) {

      $this->params = (object) array_filter($parameter, function ($k) {
        return is_string($k);
      }, ARRAY_FILTER_USE_KEY);

      return true;
    }

    return false;
  }

  private function request_url()
  {
    $httpMethod = $_SERVER["REQUEST_METHOD"] ?? null;

    if (!in_array(strtoupper($httpMethod), $this->verbs)) {
      return Response::json(HttpException::HttpMethodNotAllowedException());
    }

    $URL = preg_replace('/%20/', '', (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $URL = rtrim($URL, '/\\');
    $URL = filter_var($URL, FILTER_SANITIZE_URL);

    if (!filter_var($URL, FILTER_VALIDATE_URL)) {
      return Response::json(HttpException::HttpBadRequestException());
    }

    parse_str($_SERVER["QUERY_STRING"] ?? "", $qs);

    return (object) array_merge(parse_url($URL), [
      "url" => $URL,
      "method" => $httpMethod,
      "query" => (object)$qs,
    ]);
  }
}
