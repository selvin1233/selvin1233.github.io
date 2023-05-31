<?php

class database {

    private $hostname="localhost";
    private $database="tienda_online";
    private $username="root";
    private $password="";
    private $charset="utf8";

    function conectar()
    {
        try{
        $conexion= "mysql:host=" . $this->hostname . "; dbname=" . $this->database. "; charset=".$this->charset;
        $options=[
            pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION,
            pdo::ATTR_EMULATE_PREPARES => false
        ];

        $pdo=new pdo($conexion, $this->username, $this->password, $options);

        return $pdo;
        } catch(PDOException $e){
          echo 'error conexion: ' . $e->getMessage();
          exit;
        }
    }
}