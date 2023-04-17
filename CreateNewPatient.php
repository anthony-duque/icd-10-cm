<?php

   $firstName = $_POST["firstName"];
   $mrn = $_POST["mrn"];
   $lastName = $_POST["lastName"];
   $birthDate = $_POST["birthDate"];
   $gender = $_POST["gender"];

   require("./includes/db_open.php");

   $tsql = "INSERT INTO tblPatient " .
            "(mrn, firstName, lastName, gender, birthDate) " .
            "VALUES ($mrn, $firstName, $lastName, $gender, $birthDate)";

   // Executes the Query
   $result = sqlsrv_query($conn, $tsql);
   //$result = TRUE;
   if($result === FALSE){
     die( print_r(sqlsrv_errors(), TRUE));
   } else {
     //echo "Submission successful!";
     sqlsrv_free_stmt($result);
   }

   require ("./includes/db_close.php");
?>
