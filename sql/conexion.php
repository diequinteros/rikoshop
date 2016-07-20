<?php
    $host = 'localhost';
    $username = 'rikoshop_admin';
    $clave = '666';
    $database = 'rikoshop';
    try{
        $PDO = new PDO("mysql:host=".$host."; dbname=".$database, $username, $clave);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
?>