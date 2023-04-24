<?php

   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         //ProcessPOST($data);
         var_dump($data);
         //echo $data->mrn;
         break;

      case "PUT":    // Could read from input and query string
      //         $qString = $_GET["id"];
      //         echo "PUT = " . $qString;
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         var_dump($data);
         break;

      case "GET":
         $qString = $_GET["id"];
         echo "GET = " . $qString;
         break;

      case "DELETE":
         $qString = $_GET["id"];
         echo "DELETE = " . $qString;
         break;

      default:
         $task = "Task unknown";
         break;
   }


      //  Process a POSTed data
   function ProcessPOST($patient){

      require('db_open.php');

      $tsql = "INSERT INTO tblPatient " .
               "(mrn, firstName, lastName, gender, birthdate) " .
               "VALUES ('$patient->mrn', '$patient->firstName', " .
                        "'$patient->lastName', '$patient->gender', " .
                        "CONVERT(SMALLDATETIME, '$patient->birthDate'))";

      //echo $tsql;

      $result = sqlsrv_query($conn, $tsql);

      if($result === FALSE){
        die( print_r(sqlsrv_errors(), TRUE));
      } else {
         echo "Submission successful!";
        sqlsrv_free_stmt($result);
        sqlsrv_close($conn);
      }

   }  // ProcessPOST()

?>
