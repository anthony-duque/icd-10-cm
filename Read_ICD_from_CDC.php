<?php

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
      }
   }  // Product{}

   $file = fopen('./files/icd10cm-order-2023.txt', 'r');

   $icd_codes[] = array();

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

      $icd_Record = new ICD_Record($icd_OrderNo, $icd_Code, $icd_header, $icd_ShortDesc, $icd_LongDesc);
      $icd_Record->print();

   }

   fclose($file);
      echo("reached here");
?>
