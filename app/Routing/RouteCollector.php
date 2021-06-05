<?php

namespace App\Routing;

class RouteCollector
{

  /**
   * An array of the routes.
   *
   * @var array
   */
  protected static $routes = [];

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
}
