<?php
namespace App\Models;
use App\Database\DatabaseConnection;

class TaskModel extends DatabaseConnection
{
   protected function getTasks() 
   {
      $sql = "SELECT * FROM tasks";
      $stmt = $this->connect()->query($sql);
      return $stmt->fetchAll();
   }

   protected function getTask ($taskID) 
   {
      $sql = "SELECT * FROM tasks WHERE id = :id";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([':id' => $taskID]);
      return $stmt->fetchAll();
   }

   public function createTasks($title, $deadline, $description) 
   {
      try {
   
         $sql = "INSERT INTO tasks (title, deadline, description) VALUES (:title, :deadline, :description)";
 
         $stmt = $this->connect()->prepare($sql);
 
         $stmt->bindParam(':title', $title);
         $stmt->bindParam(':deadline', $deadline);
         $stmt->bindParam(':description', $description);
 
         $stmt->execute();
 
         return $this->connect()->lastInsertId();
     } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
     }

   }
   public function deleteTask($taskID) 
   {
      try {
         $sql = "DELETE FROM tasks WHERE id = :id";
         $stmt = $this->connect()->prepare($sql);
         $stmt->bindParam(':id', $taskID);
         $stmt->execute();
         return true; 
      } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
      
   }
}