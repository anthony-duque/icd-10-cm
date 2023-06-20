<?php

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   require('db_open.php');

   $tsql = "SELECT TOP 200 code, short_desc FROM tbl_ICD_Lookup";

   $result = sqlsrv_query($conn, $tsql);
   if($result === FALSE OR $result === NULL){
      echo "failed";
      print_r(sqlsrv_errors();
      die(print_r(sqlsrv_errors(), TRUE));
   } else {
      echo "succeed";
      //sqlsrv_free_stmt($result);
   }

   $arrayResult = array();

   while(($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) != NULL){
      //echo($row['order_no'] . "<br>");
      $arrayResult[] = $row;
   }

   echo json_encode($arrayResult);

   sqlsrv_free_stmt($result)
   sqlsrv_close($conn);
   //require('./php/db_close.php');
?>
