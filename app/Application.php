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
    $this->route->call();
  }
}
