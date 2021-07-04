<?php

namespace App\lib;

// Forms csrf and methods

if (!function_exists('csrf_field')) {
  function csrf_field()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (empty($_SESSION['_token'])) {
      $_SESSION['_token'] = base64_encode(random_bytes(16));
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
  return hash_equals($token, $_SESSION['_token'] ?? null);
}

function unsetCsrfToken()
{
  if (isset($_SESSION['_token'])) {
    unset($_SESSION['_token']);
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


  function replacer($x, $y, $z)
  {
    return str_replace($x, sprintf('%s', $y), $z);
  }

  function view($view = null, $data = [])
  {
    if (func_num_args() === 0) {
      return;
    }

    $path = dirname(__DIR__, 2) . "/public/resources/views/$view.php";

    ob_start();
    include_once $path;
    $layout = ob_get_clean();

    if (preg_match_all("/{{(.*?)}}/", $layout, $m)) {
      foreach ($m[1] as $key => $value) {
        if (str_starts_with($value, '@')) {
          if (preg_match('/@([a-z]+)/', $value, $output_matches)) {
            $naming = $output_matches[1];

            if ($naming === "csrf") {
              $layout = replacer($m[0][$key], csrf_field(), $layout);
            }

            if ($naming === "method") {
              if (preg_match("!\(([^\)]+)\)!", $value, $match)) {
                $action = strtoupper(substr($match[1], 1, -1));
                $layout = replacer($m[0][$key], method_field($action), $layout);
              }
            }

            if ($naming === "asset") {
              if (preg_match("!\(([^\)]+)\)!", $value, $match)) {
                $file = substr($match[1], 1, -1);
                $folder = explode('.', $file)[1];
                $ddir = "resources/$folder/$file";
                $layout = replacer($m[0][$key], $ddir, $layout);
              }
            }
          }
        } else {
          $layout = replacer($m[0][$key], $data[$value], $layout);
        }
      }
    }
    return exit($layout);
  }
}
