<?php

   header('Access-Allow-Control-Origin: *');
   $method = $_SERVER['REQUEST_METHOD'];

   $task = "";
   switch($method){

      case 'POST':
         echo 'POST';
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         ProcessPOST($data);
         //var_dump($data);
         //echo $data->mrn;
         break;

      case "PUT":    // Could read from input and query string
      //         $qString = $_GET["id"];
      //         echo "PUT = " . $qString;
         echo 'PUT';
         $json = file_get_contents('php://input');
         $data = json_decode($json);
         var_dump($data);
         break;

      case "GET":
//         echo 'GET';
//         $qString = $_GET["id"];
//         echo "DELETE = " . $qString;
         $patientList = ProcessGET();
         echo json_encode($patientList);
         break;

      case "DELETE":
         echo 'DELETE';
         $qString = $_GET["id"];
         echo "DELETE = " . $qString;
         break;

      default:
         $task = "Task unknown";
         break;
   }

   function ProcessGET(){

      require('db_open.php');

      $tsql = "SELECT mrn, firstName, lastName, gender, FORMAT(birthdate, 'yyyy-MM-dd') AS birthDate " .
               "FROM tblPatient";
      //echo $tsql;

      $result = sqlsrv_query($conn, $tsql);

      if($result === FALSE OR $result === NULL){
        die( print_r(sqlsrv_errors(), TRUE));
      } else {
         // echo "Patient fetch successful!";
      }

      $arrayResult = array();

      while(($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) != NULL){
         //echo($row['order_no'] . "<br>");
         $arrayResult[] = $row;
      }

      sqlsrv_free_stmt($result);
      sqlsrv_close($conn);

      return $arrayResult;

   }     // ProcessGET()


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
