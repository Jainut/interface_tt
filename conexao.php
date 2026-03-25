<?php
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $db = 'projetof1';
    $port = 3306;

    $mysqli = new mysqli ($host, $user, $pass, $db, $port);

    if ($mysqli->connect_error) {
        die("Erro de conexão (". $mysqli->connct_error ."): " . $mysqli->connct_error);
    }
?>