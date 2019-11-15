<?php

class Manager{

	protected function dbConnect(){
		try{
            $pdo = new PDO("mysql:host=localhost; dbname=projectIcyLight; charset=utf8", 'root', 'mysql');
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(Exception $e){
            echo 'Echec de la connexion:'.$e->getMessage();
        }
    }
}