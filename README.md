# Lightweight PHP Framework For Web and APIs
PHP framework that helps you write quickly
simple but powerful web apps and APIs

## Installation

Use the package manager [composer](https://getcomposer.org/) to install required files

Install dependencies
```bash
composer install
```

## Hello World

file `routes/api.php`
```php
<?php

use App\Http\Request;
use App\Routing\Route;

/*
|------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------
|
| Here is where you can register API routes for your application. 
|
*/

Route::get('/hello/{name}', function (Request $request) {
  $name = $request->params->name;
  echo ("Hello, $name");
});

```
file `routes/web.php`
```php
<?php

use App\Http\Request;
use App\Routing\Route;
use function App\lib\view;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function (Request $request) {
  return view('welcome', ['lang' => 'PHP']);
});

```
## Available Router Methods

The router allows you to register routes that respond to any HTTP verb:
```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::delete($uri, $callback);
```
## PHP built-in server
Run the following command in terminal to start localhost web server, assuming `./public/` is public-accessible directory with `index.php` file:

```bash
cd public/
php -S localhost:8000
```
##### Going to http://localhost:8000/api/hello/world will now display "Hello, world".
##### Going to http://localhost:8000/ will render the welcome page.

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
[Documentation](https://yusfuu.github.io/Lightweight-PHP-Framework-For-Web-and-APIs/)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
