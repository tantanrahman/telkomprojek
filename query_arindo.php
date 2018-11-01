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

$databasetable = "arindo_trx";

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


for($i=4;$i<=$arrayCount;$i++){



            $tanggal1 = $_GET['nilai'];

$date = explode("-", $tanggal1);

                    $arr = array("$date[2]","$date[1]","$date[0]");

                    $tampil_date = implode("-", $arr);

       $tanggal = $tampil_date;

      $kode_user              = trim($allDataInSheet[$i]["B"]);
      $pln_lembar             = trim($allDataInSheet[$i]["D"]);
      $pln_trx                = trim($allDataInSheet[$i]["E"]);
      $plnp_lembar            = trim($allDataInSheet[$i]["F"]);
      $plnp_trx               = trim($allDataInSheet[$i]["G"]);
      $telepon_lembar         = trim($allDataInSheet[$i]["J"]);
      $telepon_trx            = trim($allDataInSheet[$i]["K"]);
      $indovision_lembar      = trim($allDataInSheet[$i]["L"]);
      $indovision_trx         = trim($allDataInSheet[$i]["M"]);
      $halo_lembar            = trim($allDataInSheet[$i]["N"]);
      $halo_trx               = trim($allDataInSheet[$i]["O"]);
      $pulsa_lembar           = trim($allDataInSheet[$i]["R"]);
      $pulsa_trx              = trim($allDataInSheet[$i]["S"]);
      $pdam_lembar            = trim($allDataInSheet[$i]["T"]);
      $pdam_trx               = trim($allDataInSheet[$i]["U"]);
      $adira_lembar           = trim($allDataInSheet[$i]["AB"]);
      $adira_trx              = trim($allDataInSheet[$i]["AC"]);
      $baf_lembar             = trim($allDataInSheet[$i]["AR"]);
      $baf_trx                = trim($allDataInSheet[$i]["AS"]);
      $fif_lembar             = trim($allDataInSheet[$i]["AV"]);
      $fif_trx                = trim($allDataInSheet[$i]["AW"]);
      $bpjs_lembar            = trim($allDataInSheet[$i]["BB"]);
      $bpjs_trx               = trim($allDataInSheet[$i]["BC"]);
      $total_lembar           = trim($allDataInSheet[$i]["BD"]);
      $total_trx              = trim($allDataInSheet[$i]["BE"]);
      $wom_lembar             = trim($allDataInSheet[$i]["Z"]);
      $wom_trx                = trim($allDataInSheet[$i]["AA"]);

      


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT into arindo_trx 
      values('$kode_user','$tanggal',$pln_lembar,$pln_trx,
        $telepon_lembar,$telepon_trx,
        $indovision_lembar,$indovision_trx,$halo_lembar,
        $halo_trx,$pulsa_lembar,$pulsa_trx,
        $pdam_lembar,$pdam_trx,$adira_lembar,$adira_trx,
        $baf_lembar,$baf_trx,$fif_lembar,
        $fif_trx,$bpjs_lembar,$bpjs_trx,$plnp_lembar,$plnp_trx,$wom_lembar,$wom_trx,$total_lembar,
        $total_trx)";
        


$insertTable= mysql_query($query);


$msg = 'Data Arindo Sudah Ditambahkan';
}
echo "<i class='glyphicon glyphicon-ok'></i>".$msg."<br>";


?>