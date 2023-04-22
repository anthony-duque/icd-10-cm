<?php
   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         $task = "Create new record";
         break;

      case "PUT":
         $task = "Update a record.";
         break;

      case "GET":
         $task = "Get record\/s";
         break;

      case "DELETE":
         $task = "Purge record\/s";
         break;

      default:
         $task = "Task unknown";
         break;
   }

   echo $task;
?>
