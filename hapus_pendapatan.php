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

	$query3 = "DELETE from voucher where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from voucher_tri where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from transvision where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from pln where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from pdam where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from sopp where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from indovision where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from arindo_trx where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
	$query3 = "DELETE from fee_akses where tanggal='$tampil_date'";
	$eksekusi3 = mysql_query($query3,$konek);
}

if (isset($_POST['saldo1']))
{
	$query4 = "TRUNCATE TABLE saldo";
	$eksekusi4 = mysql_query($query4,$konek);
}

?>