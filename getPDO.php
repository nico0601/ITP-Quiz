<?php
function getPDO()
{
//    $host = "localhost";
//    $db = "quiz_db";
//    $user = "quiz_admin";
//    $passwd = "quiz";
//
//    try {
//        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
//    } catch (PDOException $e) {
//        echo 'Verbindung fehlgeschlagen';
//    }
//    return $pdo;

    $host = "localhost";
    $db = "quiz";
    $user = "root";
    $passwd = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
    } catch (PDOException $e) {
        echo 'Verbindung fehlgeschlagen';
    }
    return $pdo;
}