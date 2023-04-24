<?php

   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         ProcessPOST($data);
         //var_dump($data);
         //echo $data->mrn;
         break;

      case "PUT":
         $task = "Update a record.";
         break;

      case "GET":
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         var_dump($data);
         echo "GET";
         break;

      case "DELETE":
         $task = "Purge record/s";
         break;

      default:
         $task = "Task unknown";
         break;
   }


?>
