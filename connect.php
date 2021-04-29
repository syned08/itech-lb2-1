<?php
  $db_driver = 'mysql';
  $host = 'localhost';
  $db_name = 'iteh2lb1var4';
  $user = 'root';
  $password = '';

  $dsn = "$db_driver:host=$host;dbname=$db_name";

  try {
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $ex) {
    die("Connection error! " . $ex->GetMessage() . "<br/>");
  }
?>