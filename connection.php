<?php

    // Connection to the database dll3B
    // Default host and user

    $host = 'localhost';
    $db = 'dll3B';
    $user = 'root';
    $password = '';
    function connect($host,$db,$user,$password){
        try {
            $conn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            //echo "Connected";
            return new PDO($conn, $user, $password, $options);
        } catch (PDOException $e) {
        die($e->getMessage());
        }
    }
    return connect($host,$db,$user,$password);
?>