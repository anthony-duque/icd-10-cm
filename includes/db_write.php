<?php

// Sets the query
$tsql = "INSERT INTO CDC_ICD_CM_Dump (order_no, code, header, short_desc, long_desc) " .
    "VALUES (00000, 'SAMPLE', 1, 'Sample short description.', 'Sample long description.')";

echo $tsql;

// Executes the Query
$result = sqlsrv_query($conn, $tsql);
//$result = TRUE;
if($result === FALSE){
  die( print_r(sqlsrv_errors(), TRUE));
} else {
  echo "Submission successful!";
}

?>
