<?php

namespace App;

use App\Routing\Route;

class Application
{

  public function __construct()
  {
    $this->route = new Route();
  }

  public function run()
  {
    $this->boot();
    $this->route->call();
  }

  public function boot()
  {
    $uri = ltrim($_SERVER['REQUEST_URI'], "/");
    [$uri] = explode("/", $uri);
    $uri === "api" ? require_once __DIR__ . "/../routes/api.php" : require_once __DIR__ . "/../routes/web.php";
  }
}
