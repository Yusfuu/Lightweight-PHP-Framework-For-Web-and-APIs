<?php

namespace App\Config;

use PDO;

class Database
{
  private static $dbh = null;

  /**
   * Create a new PDO connection instance.
   *
   * @return \PDO
   */

  public static function connect()
  {
    if (is_null(self::$dbh)) {
      self::$dbh = new PDO($_ENV["DSN"], $_ENV["USERNAME"], $_ENV["PASSWORD"]);
      self::$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return self::$dbh;
  }
}
