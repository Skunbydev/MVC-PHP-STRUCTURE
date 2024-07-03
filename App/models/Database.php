<?php

class Database
{
  public function getConnection()
  {
    try {
      $pdo = new PDO("mysql:dbname=forum;host=127.0.0.1", "root", "@ROOT@ROOT4438");
      return $pdo;
    } catch (PDOException $err) {
    }
  }
}
