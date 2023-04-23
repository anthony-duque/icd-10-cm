<?php

   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         var_dump($data);
         //ProcessPOST($data);
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

   require('db_open.php');

      //  Process a POSTed data
   function ProcessPOST($newPatients){
      $tsql = "INSERT INTO tblPatient ";
      foreach($newPatients as $patient){
         $icd_rec->writeToDB($conn);
      }
   }

?>
