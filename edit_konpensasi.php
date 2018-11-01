<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from konpensasi where tanggal_masalah='$edit'";
$eksekusi = mysql_query($query,$koneksi);
$row=mysql_fetch_array($eksekusi,MYSQL_ASSOC);

?>
<style type="text/css">
	table td,th 
	{
		font-size: 12pt!important;
	}
</style>
<?php 
if (isset($_POST['submit']))
	{
	}
	else
	{
		?>
<form method="POST">
	<table  class="table-responsive table-bordered table" >
		<tr style="font-size:12pt!important;">
			<td>Tanggal Masalah</td>
			<td>:</td>
			<td><input type="text" name="nilai" value="<?=$row['tanggal_masalah'] ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td>Tanggal Konpensasi</td>
			<td>:</td>
			<td><input type="text" name="nilai2"  value="<?=$row['tanggal_konpensasi'] ?>" readonly="readonly"></td>
		</tr>
		
					<tr><td>SOPP FINNET</td><td>:</td><td><input type="text" name="sopp_finnet" value="<?=$row['sopp_finnet'] ?>"></td></tr>
					<tr><td>VOUCHER FINNET</td><td>:</td><td><input type="text" name="voucher_finnet" value="<?=$row['voucher_finnet'] ?>"></td></tr>
					<tr><td>FEE AKSES FINNET</td><td>:</td><td><input type="text" name="fee_akses_finnet" value="<?=$row['fee_akses'] ?>"></td></tr>
					<tr><td>PLN FINNET</td><td>:</td><td><input type="text" name="pln_finnet" value="<?=$row['pln_finnet'] ?>"></td></tr>
					<tr><td>PDAM FINNET</td><td>:</td><td><input type="text" name="pdam_finnet" value="<?=$row['pdam_finnet'] ?>"></td></tr>
					<tr><td>ADIRA FINNET</td><td>:</td><td><input type="text" name="adira_finnet" value="<?=$row['adira_finnet'] ?>"></td></tr>
					<tr><td>BAF FINNET</td><td>:</td><td><input type="text" name="baf_finnet" value="<?=$row['baf_finnet'] ?>"></td></tr>
					<tr><td>FIF FINNET</td><td>:</td><td><input type="text" name="fif_finnet" value="<?=$row['fif_finnet'] ?>"></td></tr>
					<tr><td>WOM FINNET</td><td>:</td><td><input type="text" name="wom_finnet" value="<?=$row['wom_finnet'] ?>"></td></tr>
					<tr><td>INDOVISION FINNET</td><td>:</td><td><input type="text" name="indovision_finnet" value="<?=$row['indovision_finnet'] ?>"></td></tr>
					<tr><td>TOPTV FINNET</td><td>:</td><td><input type="text" name="toptv_finnet" value="<?=$row['toptv_finnet'] ?>"></td></tr>
					<tr><td>BIGTV FINNET</td><td>:</td><td><input type="text" name="bigtv_finnet" value="<?=$row['bigtv_finnet'] ?>"></td></tr>
					<tr><td>ADIRATV FINNET</td><td>:</td><td><input type="text" name="adiratv_finnet" value="<?=$row['adiratv_finnet'] ?>"></td></tr>
					<tr><td>BPJS FINNET</td><td>:</td><td><input type="text" name="bpjs_finnet" value="<?=$row['bpjs_finnet'] ?>"></td></tr>
					<tr><td>VOUCHER ARINDO</td><td>:</td><td><input type="text" name="voucher_arindo" value="<?=$row['voucher_arindo'] ?>"></td></tr>
					<tr><td>PLN ARINDO</td><td>:</td><td><input type="text" name="pln_arindo" value="<?=$row['pln_arindo'] ?>"></td></tr>
					<tr><td>PDAM ARINDO</td><td>:</td><td><input type="text" name="pdam_arindo" value="<?=$row['pdam_arindo'] ?>"></td></tr>
					<tr><td>ADIRA ARINDO</td><td>:</td><td><input type="text" name="adira_arindo" value="<?=$row['adira_arindo'] ?>"></td></tr>
					<tr><td>BAF ARINDO</td><td>:</td><td><input type="text" name="baf_arindo" value="<?=$row['baf_arindo'] ?>"></td></tr>
					<tr><td>FIF ARINDO</td><td>:</td><td><input type="text" name="fif_arindo" value="<?=$row['fif_arindo'] ?>"></td></tr>
					<tr><td>WOM ARINDO</td><td>:</td><td><input type="text" name="wom_arindo" value="<?=$row['wom_arindo'] ?>"></td></tr>
					<tr><td>INDOVISION ARINDO</td><td>:</td><td><input type="text" name="indovision_arindo" value="<?=$row['indovision_arindo'] ?>"></td></tr>
					<tr><td>TOPTV ARINDO</td><td>:</td><td><input type="text" name="toptv_arindo" value="<?=$row['toptv_arindo'] ?>"></td></tr>
					<tr><td>BIGTV ARINDO</td><td>:</td><td><input type="text" name="bigtv_arindo" value="<?=$row['bigtv_arindo'] ?>"></td></tr>
					<tr><td>ADIRATV ARINDO</td><td>:</td><td><input type="text" name="adiratv_arindo" value="<?=$row['adiratv_arindo'] ?>"></td></tr>
					<tr><td>BPJS ARINDO</td><td>:</td><td><input type="text" name="bpjs_arindo" value="<?=$row['bpjs_arindo'] ?>"></td></tr>
		<tr>
			<td>Ketarangan</td>
			<td>:</td>
			<td><textarea name="ket" ><?=$row['keterangan'] ?></textarea></td>
		</tr>
		
		<tr><td colspan="3"><input type="submit" name="submit"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{
	
    $tanggal_masalah = $_POST['nilai'];
    $tanggal_konpensasi = $_POST['nilai2'];

    $sopp_finnet = $_POST['sopp_finnet'];
    $voucher_finnet = $_POST['voucher_finnet'];
    $fee_akses_finnet = $_POST['fee_akses_finnet'];
    $pln_finnet = $_POST['pln_finnet'];
    $pdam_finnet = $_POST['pdam_finnet'];
    $adira_finnet = $_POST['adira_finnet'];
    $baf_finnet = $_POST['baf_finnet'];
    $fif_finnet = $_POST['fif_finnet'];
    $wom_finnet = $_POST['wom_finnet'];
    $indovision_finnet = $_POST['indovision_finnet'];
    $toptv_finnet = $_POST['toptv_finnet'];
    $bigtv_finnet = $_POST['bigtv_finnet'];
    $adiratv_finnet  = $_POST['adiratv_finnet'];
    $bpjs_finnet  = $_POST['bpjs_finnet'];
    $voucher_arindo = $_POST['voucher_arindo'];
    $pln_arindo = $_POST['pln_arindo'];
    $pdam_arindo = $_POST['pdam_arindo'];
    $adira_arindo = $_POST['adira_arindo'];
    $baf_arindo  = $_POST['baf_arindo'];
    $fif_arindo = $_POST['fif_arindo'];
    $wom_arindo = $_POST['wom_arindo'];
    $indovision_arindo = $_POST['indovision_arindo'];
    $toptv_arindo = $_POST['toptv_arindo'];
    $bigtv_arindo = $_POST['bigtv_arindo'];
    $adiratv_arindo = $_POST['adiratv_arindo'];
    $bpjs_arindo = $_POST['bpjs_arindo'];
    $ket = $_POST['ket'];
    
       if ($sopp_finnet  == null ) { $sopp_finnet=0;}
    if ($voucher_finnet  == null ) {$voucher_finnet =0;}
    if ($fee_akses_finnet  == null ) { $fee_akses_finnet=0;}
    if ($pln_finnet  == null ) { $pln_finnet=0;}
    if ($pdam_finnet  == null ) { $pdam_finnet=0;}
    if ($adira_finnet  == null ) { $adira_finnet=0;}
    if ($baf_finnet  == null ) { $baf_finnet=0;}
    if ($fif_finnet == null ) { $fif_finnet =0;}
    if ($wom_finnet  == null ) { $wom_finnet=0;}
    if ($indovision_finnet  == null ) { $indovision_finnet=0;}
    if ($toptv_finnet  == null ) { $toptv_finnet=0;}
    if ($bigtv_finnet  == null ) { $bigtv_finnet=0;}
    if ($adiratv_finnet   == null ) { $adiratv_finnet=0;}
    if ($bpjs_finnet   == null ) { $bpjs_finnet =0;}
    if ($voucher_arindo  == null ) { $voucher_arindo=0;}
    if ($pln_arindo  == null ) { $pln_arindo=0;}
    if ($pdam_arindo  == null ) { $pdam_arindo=0;}
    if ($adira_arindo  == null ) {$adira_arindo =0;}
    if ($baf_arindo   == null ) { $baf_arindo=0;}
    if ($fif_arindo  == null ) { $fif_arindo=0;}
    if ($wom_arindo  == null ) { $wom_arindo=0;}
    if ($indovision_arindo  == null ) { $indovision_arindo=0;}
    if ($toptv_arindo  == null ) { $toptv_arindo=0;}
    if ($bigtv_arindo == null ) { $bigtv_arindo=0;}
    if ($adiratv_arindo  == null ) { $adiratv_arindo=0;}
    if ($bpjs_arindo  == null ) { $bpjs_arindo=0;}

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		$hapus = "DELETE from konpensasi where tanggal_masalah='$tanggal_masalah'";
		
		$eksekusihapus = mysqli_query($konek,$hapus);
	$insert = " INSERT INTO `kopeg`.`konpensasi` 
				VALUES ('$tanggal_masalah','$tanggal_konpensasi',$sopp_finnet,$voucher_finnet,$fee_akses_finnet,$pln_finnet,$pdam_finnet,$adira_finnet,$baf_finnet
				,$fif_finnet,$wom_finnet,$indovision_finnet,$toptv_finnet,$bigtv_finnet,$adiratv_finnet,$bpjs_finnet,$voucher_arindo,$pln_arindo,$pdam_arindo,$adira_arindo,$baf_arindo,$fif_arindo,$wom_arindo,$indovision_arindo,$toptv_arindo,$bigtv_arindo,$adiratv_arindo,$bpjs_arindo,'$ket')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		include 'view_konpensasi.php';
	}
	else
	{
		echo "Data Gagal Disimpan.";
		
	}
	
}

?>