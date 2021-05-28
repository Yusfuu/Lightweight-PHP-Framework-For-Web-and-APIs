<?php

namespace App;

use App\Http\Request;
use App\Routing\Route;

class Application
{
  public function __construct()
  {
    $this->request = Request::url();
    $this->route = new Route($this->request->method, $this->request->path);
  }

  public function run()
  {
    $this->route->call();
  }
}
