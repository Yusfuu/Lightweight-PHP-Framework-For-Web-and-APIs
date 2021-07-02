<?php

namespace App\lib;

class CSRF
{
  public function __construct()
  {
  }

  public static function generateCsrfToken()
  {
    session_start();
    if (empty($_SESSION['_token'])) {
      $_SESSION['_token'] = bin2hex(random_bytes(16));
    }
    $token = $_SESSION['_token'];
    return "<input type='hidden' name='_token' value='$token'>";
  }

  public static function VerifyCsrfToken($token)
  {
    if ($token === $_SESSION['_token']) {
      # code...
    }
  }
}
