<?php

echo("here");
$serverName = "localhost";
$connectOptions = array(
    "database"  => "ICD_DB",
    "uid"       => "SA",
    "pwd"       => "Al@d5150"
);

function exceptionHandler($exception){
  echo "<h1>Failure</h1>";
  echo "Uncaught exception: ", $exception->getMessage();
  // echo "<h1>PHP info for troubleshooting.</h1>"
}

set_exception_handler('exceptionHandler');

// Establishes the connection.

$conn = sqlsrv_connect($serverName, $connectOptions);
if ($conn == false){
  die(formatErrors(sqlsrv_errors()));
}

function formatErrors($errors)
{
    // Display errors
    echo "<h1>SQL Error:</h1>";
    echo "Error information: <br/>";
    foreach ($errors as $error) {
        echo "SQLSTATE: ". $error['SQLSTATE'] . "<br/>";
        echo "Code: ". $error['code'] . "<br/>";
        echo "Message: ". $error['message'] . "<br/>";
    }
}

require('db_write.php');

?>
