<?php

namespace App\lib;


// Forms csrf and methods

if (!function_exists('csrf_field')) {
  function csrf_field()
  {
    session_start();
    if (empty($_SESSION['_token'])) {
      $_SESSION['_token'] = bin2hex(random_bytes(16));
    }
    return ('<input type="hidden" name="_token" value="' . $_SESSION['_token'] . '">');
  }
}

if (!function_exists('method_field')) {
  function method_field($method)
  {
    return ('<input type="hidden" name="_method" value="' . $method . '">');
  }
}

function verifyCsrfToken($token)
{
  if ($token === $_SESSION['_token']) {
    # code...
  }
}


if (!function_exists('view')) {

  /**
   * Render a view file
   *
   * @param string $view  The view file
   * @param array $data  data to display in the view 
   *
   * @return void
   */

  function view($view = null, $data = [])
  {
    if (func_num_args() === 0) {
      return;
    }

    $path = dirname(__DIR__, 2) . "/public/resources/views/$view.php";

    ob_start();
    include_once $path;
    $layout = ob_get_clean();

    if (empty($data)) {
      return exit($layout);
    }

    if (preg_match_all("/{{(.*?)}}/", $layout, $m)) {
      foreach ($m[1] as $key => $value) {
        if (str_starts_with($value, '@')) {
          if ($value == "@csrf") {
            $layout = str_replace($m[0][$key], sprintf('%s', csrf_field()), $layout);
          } else {
            preg_match('/\'(.*)\'/', $value, $output_array);
            $layout = str_replace($m[0][$key], sprintf('%s', method_field(strtoupper($output_array[1]))), $layout);
          }
        } else {
          $layout = str_replace($m[0][$key], sprintf('%s', $data[$value]), $layout);
        }
      }
    }
    return exit($layout);
  }
}
