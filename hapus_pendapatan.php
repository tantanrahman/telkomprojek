<?php

$server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");

if(isset($_POST['hapus']))
{
	$tanggal = $_POST['nilai'];
$pen = $_POST['pen'];

$date = explode("-", $tanggal);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);
$pen = $_POST['pen'];

	$query3 = "DELETE from fee_arindo where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);

$query = "Delete from $pen where tanggal='$tampil_date'";
$query2 = "delete from upload where tanggal='$tampil_date' and pen like '%$pen%'";
	if ($pen=='arindo_trx') 
		{
			$query = "Delete from arindo_trx where tanggal='$tampil_date'";
			$query2 = "delete from upload where tanggal='$tampil_date' and pen like '%arindo%'";

			$query3="DELETE FROM fee_arindo where tanggal='$tampil_date'";
			$eksekusi3 = mysql_query($query3,$konek);
		}

}

$eksekusi = mysql_query($query,$konek);
$eksekusi2 = mysql_query($query2,$konek);

if ($eksekusi)
{
	echo "Hapus Data berhasil";
}
else
{
	echo "Hapus Data gagal";
}

if (isset($_POST['semua']))
{
	$tanggal = $_POST['nilai1'];
	$date = explode("-", $tanggal);
	$arr = array("$date[2]","$date[1]","$date[0]");
	$tampil_date = implode("-", $arr);

	$query3 = "TRUNCATE TABLE aora;
TRUNCATE TABLE arindo_input;
TRUNCATE TABLE arindo_trx;
TRUNCATE TABLE fee_admin;
TRUNCATE TABLE fee_arindo;
TRUNCATE TABLE indovision;
TRUNCATE TABLE k_aoratv;
TRUNCATE TABLE k_arindo;
TRUNCATE TABLE k_arindo_adira;
TRUNCATE TABLE k_arindo_adiratv;
TRUNCATE TABLE k_arindo_baf;
TRUNCATE TABLE k_arindo_bigtv;
TRUNCATE TABLE k_arindo_bpjs;
TRUNCATE TABLE k_arindo_fif;
TRUNCATE TABLE k_arindo_indovision;
TRUNCATE TABLE k_arindo_pdam;
TRUNCATE TABLE k_arindo_pln;
TRUNCATE TABLE k_arindo_toptv;
TRUNCATE TABLE k_arindo_voucher;
TRUNCATE TABLE k_arindo_wom;
TRUNCATE TABLE k_indovision;
TRUNCATE TABLE k_pdam;
TRUNCATE TABLE k_pln;
TRUNCATE TABLE k_sopp;
TRUNCATE TABLE k_transvision;
TRUNCATE TABLE k_voucher_smart;
TRUNCATE TABLE k_voucher_tri;
TRUNCATE TABLE k_voucher_tsel;
TRUNCATE TABLE kinerja_user;
TRUNCATE TABLE loket;
TRUNCATE TABLE pdam;
TRUNCATE TABLE pengawasan;
TRUNCATE TABLE pln;
TRUNCATE TABLE rk_input;
TRUNCATE TABLE saldo;
TRUNCATE TABLE sopp;
TRUNCATE TABLE titipan;
TRUNCATE TABLE titipan2;
TRUNCATE TABLE total_trx;
TRUNCATE TABLE transvision;
TRUNCATE TABLE upload;
TRUNCATE TABLE voucher;
TRUNCATE TABLE voucher_tri;
TRUNCATE TABLE voucher_smart;
TRUNCATE TABLE voucher_tsel;'";
	$eksekusi3 = mysql_query($query3,$konek);
	
}

?>