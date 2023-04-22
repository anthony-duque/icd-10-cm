<?php

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   require('./php/db_open.php');

   $tsql = "SELECT TOP 100 order_no, code, header, short_desc FROM CDC_ICD_CM_Dump";

   $result = sqlsrv_query($conn, $tsql);
   if($result === FALSE OR $result === NULL){
      die(print_r(sqlsrv_errors(), TRUE));
   } else {
      //sqlsrv_free_stmt($result);
   }

   $arrayResult = array();

   while(($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) != NULL){
      //echo($row['order_no'] . "<br>");
      $arrayResult[] = $row;
   }

   echo json_encode($arrayResult);

   require('./php/db_close.php');
?>
