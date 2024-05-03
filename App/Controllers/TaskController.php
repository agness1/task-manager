<?php
namespace App\Controllers;
use App\Models\TaskModel;
use App\Routing\Request;
use App\Routing\Application;
use Dompdf\Dompdf;

Class TaskController extends TaskModel {

    public $tasks = [];

    public function showTasks () 
    {
     $tasks= $this->getTasks();
    return json_encode($tasks);
    }

    public function deleteTasks(Request $request) {
   
        $body = $request->getBody();
            var_dump($body);
        if (isset($body['taskId'])) {
            $taskId = $body['taskId'];

            $this->deleteTask($taskId);

           return "Ok";
        } else {
            return "Task ID not provided";
        }
    }

    public function createTask(Request $request) {
        $body = $request->getBody();
        if (isset($body["title"]) && isset($body["deadline"]) && isset($body["description"])) {
           $title = $body["title"];
           $deadline = $body["deadline"];
           $description = $body["description"];
  
           $this->createTasks($title, $deadline, $description);
  
           return "Task created successfully.";
        } else {
           return "Error: Incomplete data provided.";
        }
     }

     public function getPdfTask () 

     {
        $tasks = $this->getTasks();

        $html = '<!DOCTYPE html>';
        $html .= '<html lang="en">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $html .= '<title>Tasks</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>Tasks</h1>';
        foreach ($tasks as $task) {
            $html .= '<div>';
            $html .= '<p>Title: ' . $task['title'] . '</p>';
            $html .= '<p>Description: ' . $task['description'] . '</p>';
            $html .= '<p>Deadline: ' . $task['deadline'] . '</p>';
            $html .= '</div>';
        }
    
        $html .= '</body>';
        $html .= '</html>';
    
        $dompdf = new Dompdf();
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'landscape');
    
        $dompdf->render();
    
        $dompdf->stream('tasks.pdf');

    }
}