<?php

namespace App;

use App\Http\Request;
use App\Routing\Route;

class Application
{
  public function __construct()
  {
    $this->route = new Route($_SERVER["REQUEST_METHOD"],  $_SERVER["REQUEST_URI"]);
  }

  public function run()
  {
    $this->route->call();
  }
}
