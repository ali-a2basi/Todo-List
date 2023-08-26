<?php
session_start();

include 'config.php';
include 'constant.php';
include basePath . 'vendor/autoload.php';
include basePath .'libs/helpers.php';

try {
    $pdo = new PDO("mysql:dbname=$dataBaseConfig->db;host={$dataBaseConfig->host}", $dataBaseConfig->user, $dataBaseConfig->pass);
} catch (PDOException $e) {
   echoAndDie('Connection failed: ' . $e->getMessage());
}

include basePath . 'libs/libAuth.php';
include basePath .'libs/libTasks.php';












