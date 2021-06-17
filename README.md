# Lightweight-PHP-Framework-For-APIs.
Simple PHP framework that helps you quickly understand and write simple APIs.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install required files

Install dependencies
```bash
composer install
```

## Environment Variables
```bash
  composer run env
```


## Hello World
File: `public/index.php`

```php
<?php

use App\Application;
use App\Routing\Route;
use App\Http\Response;
use App\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Instantiate App
$app = new Application();

// Add routes
Route::get('/hello/{name}', function (Request $request) {
  $name = $request->params->name;
  echo ("Hello, $name");
});

$app->run();

```

## PHP built-in server
Run the following command in terminal to start localhost web server, assuming `./public/` is public-accessible directory with `index.php` file:

```bash
cd public/
php -S localhost:8080
```
Or you may quickly test this using :
```bash
php -S localhost:8000 -t public
```
##### Going to http://localhost:8080/hello/world will now display "Hello, world".

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
  public static function index(Request $request)
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \Http\Request  $request
   */
  public static function show(Request $request)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function update(Request $request)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public static function destroy(Request $request)
  {
    //
  }
}

```
Example Model
-------
```php

<?php

namespace App\Models;

class ExampleModel extends Model
{
  /**
   * @var array
   */
  protected $fillable = [];
}

```
## Documentation
[Documentation](https://yusfuu.github.io/Lightweight-PHP-Framework-For-APIs/)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
