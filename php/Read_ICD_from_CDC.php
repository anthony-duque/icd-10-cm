<?php

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   class ICD_Record{
                           //  Record position
      private $order_no;   //    1 - 5    (5)
      private $code;       //    7 - 13   (7)
      private $header;     //    15       (1)
      private $short_desc; //    17 - 76  (60)
      private $long_desc;  //    78 - end;

      public function __construct($_order_no, $_code, $_header, $_short_desc, $_long_desc){
         $this->order_no = $_order_no;
         $this->code = $_code;
         $this->header = $_header;
         $this->short_desc = $_short_desc;
         $this->long_desc = $_long_desc;
      }

      public function print(){
         echo("$this->order_no - $this->code - $this->header - $this->short_desc - $this->long_desc<br>");
         //echo("$this->order_no + <br>");
      }

      public function writeToDB($dbConn){

         $this->short_desc = str_replace("'", "''", $this->short_desc);
         $this->long_desc = str_replace("'", "''", $this->long_desc);

//         echo("Processing $this->code<br>");
//         $tsql = "INSERT INTO CDC_ICD_CM_Dump (order_no, code, header, short_desc, long_desc) " .
         $tsql = "INSERT INTO CDC_ICD_CM_Dump " .
                  "VALUES ($this->order_no, '$this->code', $this->header, '$this->short_desc', '$this->long_desc')";

         $result = sqlsrv_query($dbConn, $tsql);
         //$result = TRUE;
         if($result === FALSE){
           die( print_r(sqlsrv_errors(), TRUE));
         } else {
           //echo "Submission successful!";
           sqlsrv_free_stmt($result);
         }

      }
   }  // ICD_Record{}

  $fileName = '/var/www/html/icd-10-cm/files/icd10cm-order-2023.txt';
//   $fileName = $_POST["icdFile"];

   $file = fopen($fileName, 'r');
   $currDate = date('d-m-y h:i:s');

   echo("Processing $fileName ($currDate) <br>");
   echo "<br>It may take a few minutes...Please wait...<br>";

   $icd_records = array();

   while ($line = fgets($file)){

      //echo("$line<br/>");

      // 00001 A00     0 Cholera
         // id
      $strStart = 0;
      $strLength = 5;
      $icd_OrderNo = (int)substr($line, $strStart, $strLength);

         // code
      $strStart = 6;
      $strLength = 7;
      $icd_Code = substr($line, $strStart, $strLength);
      $icd_Code = trim($icd_Code);

         // header
      $strStart = 14;
      $strLength = 1;
      $icd_header = (int)substr($line, $strStart, $strLength);

         // Short Description
      $strStart = 16;
      $strLength = 60;
      $icd_ShortDesc = substr($line, $strStart, $strLength);
      $icd_ShortDesc = trim($icd_ShortDesc);

         // Long Description
      $strStart = 77;
      $strLength = 100;
      $icd_LongDesc = substr($line, $strStart, $strLength);
      $icd_LongDesc = trim($icd_LongDesc);

      $icd_Rec = new ICD_Record($icd_OrderNo, $icd_Code, $icd_header, $icd_ShortDesc, $icd_LongDesc);
      $icd_records[] = $icd_Rec;

   }

   fclose($file);

   require('db_open.php');

   $tsql = "DELETE FROM CDC_ICD_CM_Dump";

   // Executes the Query
   $result = sqlsrv_query($conn, $tsql);
   //$result = TRUE;
   if($result === FALSE){
     die( print_r(sqlsrv_errors(), TRUE));
   } else {
     //echo "Submission successful!";
     sqlsrv_free_stmt($result);
   }

   foreach($icd_records as $icd_rec){
      $icd_rec->writeToDB($conn);
   }
   echo '<br>';
   $currDate = date('d-m-y h:i:s');
   echo("Finished processing ICD file: $fileName ($currDate)");
   sqlsrv_close($conn);

?>
