<?php

namespace App\Models;

class Model
{

  public function __construct()
  {
    //
  }

  public static function all()
  {
    $table = substr(strrchr(get_called_class(), "\\"), 1);;
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT * FROM $table;");
    $sth->execute();
    return $sth->fetchAll();
  }

  public static function create(object $qq)
  {
    $dbh = Database::connect();
    $table = substr(strrchr(get_called_class(), "\\"), 1);

    $columns = implode(',', array_keys((array)$qq));
    $values = implode(',', array_map(function ($val) {
      return is_string($val) ? "'$val'" : $val;
    }, array_values((array)$qq)));
    $query = "INSERT INTO $table ($columns) VALUES ($values);";
    print_r($query);
    exit;
    $sth = $dbh->prepare($query);
    $sth->execute();
  }

  public static function delete(int $id)
  {
    $table = substr(strrchr(get_called_class(), "\\"), 1);
    $dbh = Database::connect();
    $dbh->prepare("DELETE FROM $table where id = ?;")->execute([$id]);
  }

  public static function find(int $id)
  {
    $table = substr(strrchr(get_called_class(), "\\"), 1);
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT * FROM $table WHERE id = ?;");
    $sth->execute([$id]);
    return $sth->fetchAll();
  }

  public static function update(object $qq, int $id)
  {
    $table = substr(strrchr(get_called_class(), "\\"), 1);
    $dbh = Database::connect();
    $value = (array) ($qq);

    $values = implode(',', array_map(
      function ($v, $k) {
        $v = is_numeric($v) ? (int)$v : "'$v'";
        return "$k=$v";
      },
      $value,
      array_keys($value)
    ));

    $query = "UPDATE $table SET $values WHERE id = $id;";
    $sth = $dbh->prepare($query);
    $sth->execute();
  }
}
