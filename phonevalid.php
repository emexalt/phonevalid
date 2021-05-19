<?php
/*
phonevalid.php
A phone number validator based on code from the Codecademy PHP exercises,
but including slightly more strenuous validation than "uhhh, is it ten digits?"
because the North American Numbering Plan is important and has slightly more complicated rules.
(copyleft) 2021, em cariglino
*/
$message = "";
$validation_error = "<div id=\"error\">* Please enter a 10-digit North American phone number.</div>";
$number = "";
$npa_list = file("areacode.txt"); //source: https://nationalnanpa.com/enas/geoAreaCodeNumberReport.do


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $number  = $_POST["number"];
   $npa = substr($number, 0, 3); //first three digits of a NANP number are the area code, or NPA
   $exk = substr($number, 3, 3); //next three digits are the exchange or office key
   
   /*Validate exchange key (4th to 6th digit):
    NANP exchange numbers can't start with 0 (operator) or 1 (thrown out by mechanical switches as operator error).
    The second digit may sometimes be 1, but only in the case that the second digit of the NPA is not also 1.
    See https://en.wikipedia.org/wiki/North_American_Numbering_Plan#Central_office_codes for more details
    TODO: Refactor NPA test as its own if block
   */
   if ($exk[0] === "0"){
     $valid_exk = False;
   } elseif ($exk[0] === "1" || ($exk[1] === "1" && $npa[1] === "1")){
     $valid_exk = False;
   } else {
     $valid_exk = True;
   }

   if (strlen($number) > 12){  //Probably not going to see > 10 digit phone numbers, we'll throw out any that are
     $message = $validation_error;
   } else {
     $number = preg_replace("/[^0-9\-]/", "-", $number); //This is a very lazy regex for phone numbers, 
     if (strlen($number) === 10 && substr($number, 0, 1) != "1" && in_array(intval($npa), $npa_list) && $valid_exk) {
       $message = "Thanks, we'll be in touch with you at $number, a totally valid phone number.";
     } else {
       $message = $validation_error;
     }
   }
 }
?>