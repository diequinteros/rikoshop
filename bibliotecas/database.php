<?php
class Database
{
    public static $connection;

    public static function connect() 
    {
        //Servidor donde esta alojada la base de datos
        $server = 'localhost';
        //Nombre de la base de datos
        $database = 'rikoshop';
        //Usuario con permisos para manipular la base de datos
        $username = 'admin_rikoshop';
        //Contraseña del usuario
        $password = '666';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        self::$connection = null;
        try
        {
            //Se guardan los valores en la clase PDO
            $PDO = new PDO("mysql:host=".$server."; dbname=".$database, $username, $password, $options);
            self::$connection = new PDO("mysql:host=".$server."; dbname=".$database, $username, $password, $options);
            //Y se ponen los atributos en connection
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            die($exception->getMessage());
        }
    }

    public static function desconnect()
    {
        self::$connection = null;
    }

    public static function executeRow($query, $values)
    {
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
    }

    public static function getRow($query, $values)
    {
        self::connect();
        //Se prepara la sentencia
        $statement = self::$connection->prepare($query);
        //Se ejecuta
        $statement->execute($values);
        self::desconnect();
        return $statement->fetch(PDO::FETCH_BOTH);
    }

    public static function getRows($query, $values)
    {
        self::connect();
        //Se prepara la sentencia
        $statement = self::$connection->prepare($query);
        //Se ejecuta
        $statement->execute($values);
        self::desconnect();
        return $statement->fetchAll(PDO::FETCH_BOTH);
    }
}
?>