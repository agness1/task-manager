<?php
namespace App\Database;
use PDO;

class DatabaseConnection 
{

   public function connect() 
    {

        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=task_manager', 'root');
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $db;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
      
    }
}
