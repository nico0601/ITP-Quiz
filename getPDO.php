<?php
function getPDO()
{
//    $host = "localhost";
//    $db = "quiz_db";
//    $user = "quiz_admin";
//    $passwd = "quiz";
//
//    try {
//        $pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$passwd");
//    } catch (PDOException $e) {
//        echo 'Verbindung fehlgeschlagen';
//    }
//    return $pdo;

    $host = "localhost";
    $db = "quiz";
    $user = "root";
    $passwd = "root";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$passwd");
    } catch (PDOException $e) {
        echo 'Verbindung fehlgeschlagen';
    }
    return $pdo;
}