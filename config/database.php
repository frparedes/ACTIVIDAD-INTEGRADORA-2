<?php
class Database{

private $host = "localhost";
private $db_name = "claseecotect";
private $user='root';
private $pass='';
private $charset = 'utf8mb4';

public function connect(): PDO{
        $dns = "mysql:host=$this->host;dbname=$this->db_name;charset=$this->charset";

        $options = [

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Modo de error: Excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Modo de obtención de datos: Asociativo
            PDO::ATTR_EMULATE_PREPARES => false,//  Desactivar emulación de sentencias preparadas para mayor seguridad
            ];


        return new PDO($dns, $this->user, $this->pass, $options);
}
}

?>