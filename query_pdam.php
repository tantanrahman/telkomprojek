<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
	
/*          
define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","kopeg"); // set database name
*/
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$databasetable = "pdam";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
//include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'uploads/'.$file;

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=2;$i<=$arrayCount;$i++){
$tanggal = trim($allDataInSheet[$i]["A"]);
$pecah2 = explode("/", $tanggal);

      $tampil = implode("-",$pecah2);
      $date = explode("-", $tampil);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);




      
      $jam        = trim($allDataInSheet[$i]["B"]);
      $kopegtel       = trim($allDataInSheet[$i]["C"]);
      $loket        = trim($allDataInSheet[$i]["D"]);
      $virtual_account        = trim($allDataInSheet[$i]["E"]);
      $nama_area        = trim($allDataInSheet[$i]["F"]);
      $fee_admin        = trim($allDataInSheet[$i]["G"]);
      $no_pdam        = trim($allDataInSheet[$i]["H"]);
      $trx          = trim($allDataInSheet[$i]["I"]);
      $bill  = trim($allDataInSheet[$i]["J"]);
      $amount       = trim($allDataInSheet[$i]["K"]);
      $total_fee       = trim($allDataInSheet[$i]["L"]);
      $total_kopeg         = trim($allDataInSheet[$i]["M"]);


     if ($bill==1)
     {
      $query = "INSERT into pdam values('$tampil_date','$jam','$kopegtel','$loket',
        $virtual_account,'$nama_area',$fee_admin,$no_pdam,$trx,$bill,$amount,$total_fee,$total_kopeg)";
        $insertTable= mysql_query($query);
      
     }
     else
     {
      $bill2 = 1;
      $amount2 = $amount/$bill;
      $total_fee2 = $total_fee/$bill;
      $total_kopeg2 = $total_kopeg/$bill;
      $query = "INSERT into pdam values('$tampil_date','$jam','$kopegtel','$loket',
        $virtual_account,'$nama_area',$fee_admin,$no_pdam,$trx,1,$amount2,$total_fee2,$total_kopeg2)";
        for($x=1;$x<=$bill;$x++)
             {
        $insertTable= mysql_query($query);
            }
      }




$msg = 'Data PDAM Sudah Ditambahkan';
 
}
echo "<i class='glyphicon glyphicon-ok'></i>".$msg."<br>";


?>