<?php
   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         $task = "Create new record";
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         var_dump($data);
         break;

      case "PUT":
         $task = "Update a record.";
         break;

      case "GET":
         var_dump($_GET); //['data'];
         break;

      case "DELETE":
         $task = "Purge record/s";
         break;

      default:
         $task = "Task unknown";
         break;
   }

?>
