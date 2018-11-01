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

$databasetable = "voucher";

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



$pecah = explode(" ",$tanggal);
$pecah2 = explode("/", $pecah[0]);

$tampil = implode("-",$pecah2);
$date = explode("-", $tampil);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);
      $divre        	= trim($allDataInSheet[$i]["B"]);
      $kode_kopegtel  	= trim($allDataInSheet[$i]["C"]);
      $kopegtel       	= trim($allDataInSheet[$i]["D"]);
      $kodeloket  	 	= trim($allDataInSheet[$i]["E"]);
      $loket        	= trim($allDataInSheet[$i]["F"]);
      $user       		= trim($allDataInSheet[$i]["G"]);
      $denom        	= trim($allDataInSheet[$i]["H"]);
      $no_telp          = trim($allDataInSheet[$i]["I"]);
      $nama_cust        = trim($allDataInSheet[$i]["J"]);
      $amount       	= trim($allDataInSheet[$i]["K"]);
      $surcharge       	= trim($allDataInSheet[$i]["L"]);
      $fee_ca       	= trim($allDataInSheet[$i]["M"]);
      $total_kopeg      = trim($allDataInSheet[$i]["N"]);
      $kode_biller      = trim($allDataInSheet[$i]["O"]);

      if (stripos($file, "ThreeDet")) 
      {
            $query = "INSERT into voucher_tri values('$divre','$tampil_date','$kode_kopegtel','$kopegtel','$kodeloket',
        '$loket','$user',$denom,'$no_telp','$nama_cust',$amount,$surcharge,$fee_ca,$total_kopeg,$kode_biller)";
      }
      else if (stripos($file, "SmartDET")) 
      {
            $query = "INSERT into voucher_smart values('$divre','$tampil_date','$kode_kopegtel','$kopegtel','$kodeloket',
        '$loket','$user',$denom,'$no_telp','$nama_cust',$amount,$surcharge,$fee_ca,$total_kopeg,$kode_biller)";
      }
      else if (stripos($file, "TselDet"))
      {
            $query = "INSERT into voucher values('$divre','$tampil_date','$kode_kopegtel','$kopegtel','$kodeloket',
        '$loket','$user',$denom,'$no_telp','$nama_cust',$amount,$surcharge,$fee_ca,$total_kopeg,$kode_biller)";
      }
      
      

$insertTable= mysql_query($query);



$msg = 'Data Voucher Sudah Ditambahkan';
 
}
echo "<i class='glyphicon glyphicon-ok'></i>".$msg."<br>";


?>