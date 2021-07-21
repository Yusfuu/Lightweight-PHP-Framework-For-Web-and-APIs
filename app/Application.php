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
    $dir = dirname(__DIR__);
    $uri === "api" ? require_once "$dir/routes/api.php" : require_once "$dir/routes/web.php";
  }

  public function cors($enable = false)
  {
    if ($enable === true) {
      header('Access-Control-Allow-Origin: *');
    }
  }
}
