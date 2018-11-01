<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
//if(isset($_POST["submit"]))
//	{
/*		
define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","kopeg"); // set database name
*/
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$databasetable = "pln";

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




//      setelah data dibaca, masukkan ke tabel pegawai sql
      

$tanggal = trim($allDataInSheet[$i]["A"]);
$date = explode("-", $tanggal);
      $arr = array("$date[2]","$date[1]","$date[0]");
      $tampil_date = implode("-", $arr);

$divre = trim($allDataInSheet[$i]["B"]);
$kode_kopegtel = trim($allDataInSheet[$i]["C"]);
$kopegtel = trim($allDataInSheet[$i]["D"]);
$loket = trim($allDataInSheet[$i]["E"]);
$nomor = trim($allDataInSheet[$i]["F"]);
$trx = trim($allDataInSheet[$i]["G"]);
$bill = trim($allDataInSheet[$i]["H"]);
$amount = trim($allDataInSheet[$i]["I"]);
$fee_admin = trim($allDataInSheet[$i]["J"]);
$total_kopeg = trim($allDataInSheet[$i]["K"]);


$sql = "INSERT into pln values('$tampil_date','$divre','$kode_kopegtel','$kopegtel','$loket','$nomor',$trx,$bill,$amount,$fee_admin,$total_kopeg);";
$insertTable= mysql_query($sql);



$msg = 'Data PLN Sudah Ditambahkan';
 
}
echo "<i class='glyphicon glyphicon-ok'></i>".$msg."<br>";
//}

?>