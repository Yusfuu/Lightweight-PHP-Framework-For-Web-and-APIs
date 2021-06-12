# Lightweight-PHP-Framework-For-APIs.
Simple PHP framework that helps you quickly understand and write simple APIs.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install required files

Install dependencies
```bash
composer install
```

## Run Your Application With PHP’s Webserver
Environment Variables
```bash
  composer run env
```

Start the server

```bash
  composer run serve
```
Voila! Enjoy development.

Example Controller
-------
```php
<?php

namespace App\Controllers;

use App\Http\Request;

class ExampleController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public function index(Request $request)
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \Http\Request  $request
   */
  public function show(Request $request)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public function update(Request $request)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public function destroy(Request $request)
  {
    //
  }
}
```
## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
