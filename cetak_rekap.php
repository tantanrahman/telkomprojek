

<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
// The function header by sending raw excel
$tanggal1 = $_POST['nilai'];
$tanggal2 = $_POST['nilai2'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap-$tanggal1.xls");
?>


<center>
<h2>

REKAP PENDAPATAN TANGGAL 
<?php  
if ($tanggal1==$tanggal2)
	{
	echo "$tanggal1";
	}
	else
	{
	echo "$tanggal1 - $tanggal2";
	}
?>

</h2>
</center>

<style type="text/css">
	table td, th
   {
    font-size: 10px!important;
   }
</style>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}
$tanggal1 = $_POST['nilai'];
$tanggal2 = $_POST['nilai2'];
$date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);
$tampil_date3 =  date('Y-m-d', strtotime($tampil_date . ' +1 Day'));


$sql = " Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel 
		FROM
		(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal,  sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then 0 when lokasi.loket='lembong2' then 0 when lokasi.loket='lembong3' then 0  END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' group by lokasi.tempat) AS A";


$sql2 = "SELECT lokasi.tempat as tempat, lokasi.loket loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi, sum(pln.total_kopeg)-sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil, sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil2 from lokasi left join pln on lokasi.loket=pln.loket  AND pln.tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";

$sql3 = "SELECT lokasi.lokasi AS pdlokasi,lokasi.tempat AS tempat, pdam.tanggal AS pdtanggal,  
lokasi.loket AS pdloket, SUM(pdam.bill) AS pdbill, 
SUM(pdam.total_kopeg)- 
SUM(fee_pdam.`fee_mitra`) AS penpdam, 

SUM(fee_pdam.`fee_mitra`) AS feepdam 

FROM lokasi LEFT JOIN pdam ON lokasi.loket = pdam.loket AND 
pdam.tanggal BETWEEN '$tampil_date' AND '$tampil_date2' LEFT JOIN fee_pdam ON pdam.nama_area=fee_pdam.pdam   GROUP BY lokasi.tempat
		";
$sql4 = "SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";

$sql5 = "SELECT lokasi.tempat as tempat,lokasi.loket, voucher_smart.tanggal as tanggal,sum(voucher_smart.total_kopeg) as penvouchersmart, sum(voucher_smart.fee_ca) as feevouchersmart from lokasi left join voucher_smart on lokasi.loket=voucher_smart.user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";

$sql6 = "SELECT lokasi.tempat as tempat,lokasi.loket, voucher_tri.tanggal as tanggal,sum(voucher_tri.total_kopeg) as penvouchertri, sum(voucher_tri.fee_ca) as feevouchertri from lokasi left join voucher_tri on lokasi.loket=voucher_tri.user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";
$sql7 = "SELECT lokasi.tempat as tempat, sum(indovision.fee_finnet) as fee_indovision, sum(indovision.kewajiban) as pen_indovision from lokasi left join indovision on lokasi.loket=indovision.loket AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' group by lokasi.tempat";
$sql8 = "SELECT lokasi.tempat as tempat, sum(transvision.fee_finnet) as fee_transvision, sum(transvision.kewajiban) as pen_transvision from lokasi left join transvision on lokasi.loket=transvision.loket AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' group by lokasi.tempat";
$sql9 = "SELECT lokasi.tempat as tempat, sum(aora.fee_finnet) as fee_aora, sum(aora.kewajiban) as pen_aora from lokasi left join aora on lokasi.loket=aora.loket AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' group by lokasi.tempat";
$sql10 = "SELECT lokasi.tempat AS tempat, arindo_trx.tanggal AS tanggal, SUM(arindo_trx.total_trx) AS arindo_pen FROM lokasi LEFT JOIN arindo_trx ON lokasi.user = arindo_trx.kode_user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  GROUP BY lokasi.tempat";
$sql11 = "SELECT S.tempat,SUM(R.fee_kopeg) AS fee_arindo
FROM lokasi AS S LEFT JOIN fee_arindo AS P ON(S.user=P.kode_user)
LEFT JOIN kode_awal AS Q ON (LEFT(id,3)=nomor_awal)
LEFT JOIN
harga_pulsa AS R ON Q.produk=R.produk
AND P.tagihan=R.harga_arindo AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' GROUP BY S.tempat";
$sql12 = "Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";

mysql_select_db('kopeg');
$ambildata  = mysql_query( $sql, $koneksi);
$ambildata2 = mysql_query( $sql2,$koneksi);
$ambildata3 = mysql_query( $sql3,$koneksi);
$ambildata4 = mysql_query( $sql4,$koneksi);
$ambildata5 = mysql_query( $sql5,$koneksi);
$ambildata6 = mysql_query( $sql6,$koneksi);
$ambildata7 = mysql_query( $sql7,$koneksi);
$ambildata8 = mysql_query( $sql8,$koneksi);
$ambildata9 = mysql_query( $sql9,$koneksi);
$ambildata10 = mysql_query( $sql10,$koneksi);
$ambildata11 = mysql_query( $sql11,$koneksi);
$ambildata12 = mysql_query( $sql12,$koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}






?>
<table id="mytable" class="table table-bordered table-striped table-fixed-header">
<thead class="header">

	<tr align="center" valign="middle">
		<th rowspan="2" align="center" valign="middle">No</th>
		<th rowspan="2" align="center" valign="center">User/Loker SOPP</th>
		<th colspan="4" align="center" valign="center">Jastel</th>
		<th colspan="2" align="center" valign="center">PLN</th>
		<th colspan="2" align="center" valign="center">PDAM</th>
		<th colspan="2" align="center" valign="center">Voucher ALL</th>
		<th colspan="2" align="center" valign="center">Indovision</th>
		<th colspan="2" align="center" valign="center">Transvision</th>
		<th colspan="2" align="center" valign="center">Aora TV</th>
		<th colspan="2" align="center" valign="center">Transaksi Arindo</th>
		<th rowspan="2" align="center" valign="center">Total Transaksi</th>
		<?php
		if ($tampil_date==$tampil_date2)
		{
		?>
		<th rowspan="2" align="center" valign="center"><?php echo "RK Tanggal $tampil_date3 ";?></th>
		<th colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tampil_date3";?></th>
		<?php
		}
		else
		{
			?>
		<th rowspan="2" align="center" valign="center"><?php echo "RK Tanggal $tampil_date - $tampil_date2 ";?></th>
		<th colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tampil_date - $tampil_date2";?></th>
			<?php
		}
		?>
	</tr>
	<tr>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee non Admin</th>
		<th align="center" valign="center">Admin Jastel</th>
		<th align="center" valign="center">Jumlah Jastel</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Fee</th>
		<th align="center" valign="center">Fee Arindo</th>
		<th align="center" valign="center">Pendapatan</th>
		<th align="center" valign="center">Titipan</th>
		<th align="center" valign="center">Tagihan</th>
		
	</tr>
</thead>
<?php
$i=1;
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
while ($row = mysql_fetch_array($ambildata) AND $row2 = mysql_fetch_array($ambildata2) AND $row3 = mysql_fetch_array($ambildata3) AND $row4 = mysql_fetch_array($ambildata4) AND $row5 = mysql_fetch_array($ambildata5) AND $row6 = mysql_fetch_array($ambildata6) AND $row7 = mysql_fetch_array($ambildata7) AND $row8 = mysql_fetch_array($ambildata8) AND $row9 = mysql_fetch_array($ambildata9) AND $row10 = mysql_fetch_array($ambildata10) AND $row11 = mysql_fetch_array($ambildata11) AND $row12 = mysql_fetch_array($ambildata12) ) 
{	
	

$cari_konpensasipdam 		= "SELECT SUM(nominal) as nominal from  k_pdam 		 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasipln 		= "SELECT SUM(nominal) as nominal from  k_pln 		 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchertsel	= "SELECT SUM(nominal) as nominal from  k_voucher_tsel 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchertri	= "SELECT SUM(nominal) as nominal from  k_voucher_tri 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchersmart= "SELECT SUM(nominal) as nominal from  k_voucher_smart where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasisopp 		= "SELECT SUM(nominal) as nominal from  k_sopp 		 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiindovision 	= "SELECT SUM(nominal) as nominal from  k_indovision 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiarindo 		= "SELECT SUM(nominal) as nominal from  k_arindo 	 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiaoratv	 	= "SELECT SUM(nominal) as nominal from  k_aoratv	 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasitransvision	= "SELECT SUM(nominal) as nominal from  k_transvision 	where lokasi='{$row['tempat']}' and tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";

$eksekusipdam 				= mysql_query($cari_konpensasipdam,$koneksi);
$eksekusipln 				= mysql_query($cari_konpensasipln,$koneksi);
$eksekusivouchertsel		= mysql_query($cari_konpensasivouchertsel,$koneksi);
$eksekusivouchertri			= mysql_query($cari_konpensasivouchertri,$koneksi);
$eksekusivouchersmart		= mysql_query($cari_konpensasivouchersmart,$koneksi);
$eksekusisopp 				= mysql_query($cari_konpensasisopp,$koneksi);
$eksekusiindovision 		= mysql_query($cari_konpensasiindovision,$koneksi);
$eksekusiarindo 			= mysql_query($cari_konpensasiarindo,$koneksi);
$eksekusiaoratv		 		= mysql_query($cari_konpensasiaoratv,$koneksi);
$eksekusitransvision 		= mysql_query($cari_konpensasitransvision,$koneksi);

$hasilkonpensasipdam 		= mysql_fetch_array($eksekusipdam, 		 	MYSQL_ASSOC);
$hasilkonpensasipln 		= mysql_fetch_array($eksekusipln, 		 	MYSQL_ASSOC);
$hasilkonpensasivouchertsel	= mysql_fetch_array($eksekusivouchertsel, 	MYSQL_ASSOC);
$hasilkonpensasivouchertri	= mysql_fetch_array($eksekusivouchertri, 	MYSQL_ASSOC);
$hasilkonpensasivouchersmart= mysql_fetch_array($eksekusivouchersmart, 	MYSQL_ASSOC);
$hasilkonpensasisopp 		= mysql_fetch_array($eksekusisopp, 		 	MYSQL_ASSOC);
$hasilkonpensasiindovision 	= mysql_fetch_array($eksekusiindovision, 	MYSQL_ASSOC);
$hasilkonpensasiarindo 		= mysql_fetch_array($eksekusiarindo, 	 	MYSQL_ASSOC);
$hasilkonpensasiaoratv	 	= mysql_fetch_array($eksekusiaoratv, 		MYSQL_ASSOC);
$hasilkonpensasitransvision = mysql_fetch_array($eksekusitransvision, 	MYSQL_ASSOC);


$carikonpensasipdam2 		= "SELECT SUM(nominal)*-1 as nominal from  k_pdam 		 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasipln2 		= "SELECT SUM(nominal)*-1 as nominal from  k_pln 		 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchertsel2	= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_tsel 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchertri2	= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_tri 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchersmart2= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_smart where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasisopp2 		= "SELECT SUM(nominal)*-1 as nominal from  k_sopp 		 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiindovision2 	= "SELECT SUM(nominal)*-1 as nominal from  k_indovision 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiarindo2 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo 	 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiaoratv2	 	= "SELECT SUM(nominal)*-1 as nominal from  k_aoratv	 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasitransvision2	= "SELECT SUM(nominal)*-1 as nominal from  k_transvision 	where lokasi='{$row['tempat']}' and tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";

$eksekusipdam2 				= mysql_query($carikonpensasipdam2,$koneksi);
$eksekusipln2				= mysql_query($carikonpensasipln2,$koneksi);
$eksekusivouchertsel2		= mysql_query($carikonpensasivouchertsel2,$koneksi);
$eksekusivouchertri2		= mysql_query($carikonpensasivouchertri2,$koneksi);
$eksekusivouchersmart2		= mysql_query($carikonpensasivouchersmart2,$koneksi);
$eksekusisopp2 				= mysql_query($carikonpensasisopp2,$koneksi);
$eksekusiindovision2 		= mysql_query($carikonpensasiindovision2,$koneksi);
$eksekusiarindo2 			= mysql_query($carikonpensasiarindo2,$koneksi);
$eksekusiaoratv2		 	= mysql_query($carikonpensasiaoratv2,$koneksi);
$eksekusitransvision2 		= mysql_query($carikonpensasitransvision2,$koneksi);

$hasilkonpensasipdam2			= mysql_fetch_array($eksekusipdam2, 		MYSQL_ASSOC);
$hasilkonpensasipln2 			= mysql_fetch_array($eksekusipln2, 		 	MYSQL_ASSOC);
$hasilkonpensasivouchertsel2	= mysql_fetch_array($eksekusivouchertsel2, 	MYSQL_ASSOC);
$hasilkonpensasivouchertri2		= mysql_fetch_array($eksekusivouchertri2, 	MYSQL_ASSOC);
$hasilkonpensasivouchersmart2	= mysql_fetch_array($eksekusivouchersmart2,	MYSQL_ASSOC);
$hasilkonpensasisopp2 			= mysql_fetch_array($eksekusisopp2, 		MYSQL_ASSOC);
$hasilkonpensasiindovision2 	= mysql_fetch_array($eksekusiindovision2, 	MYSQL_ASSOC);
$hasilkonpensasiarindo2 		= mysql_fetch_array($eksekusiarindo2, 	 	MYSQL_ASSOC);
$hasilkonpensasiaoratv2	 		= mysql_fetch_array($eksekusiaoratv2, 		MYSQL_ASSOC);
$hasilkonpensasitransvision2 	= mysql_fetch_array($eksekusitransvision2, 	MYSQL_ASSOC);





$total= $row['jumlahjastel']+$row2['hasil']+$row2['hasil2']+$row3['penpdam']+$row3['feepdam']+$row4['penvoucher']+$row4['feevoucher']+$row5['penvouchersmart']+$row5['feevouchersmart']+$row6['penvouchertri']+$row6['feevouchertri']+$row7['pen_indovision']+$row7['fee_indovision']+$row8['pen_transvision']+$row8['fee_transvision']+$row9['pen_aora']+$row9['fee_aora']+$row11['fee_arindo']+$row10['arindo_pen'] + $hasilkonpensasipdam['nominal'] + $hasilkonpensasipln['nominal'] + $hasilkonpensasivouchertsel['nominal']	+ $hasilkonpensasivouchertri['nominal'] + $hasilkonpensasivouchersmart['nominal'] + $hasilkonpensasisopp['nominal'] + $hasilkonpensasiindovision['nominal'] + $hasilkonpensasiarindo['nominal'] + $hasilkonpensasiaoratv['nominal'] + $hasilkonpensasitransvision['nominal'] + $hasilkonpensasipdam2['nominal'] + $hasilkonpensasipln2['nominal'] + $hasilkonpensasivouchertsel2['nominal']	+ $hasilkonpensasivouchertri2['nominal'] + $hasilkonpensasivouchersmart2['nominal']+ $hasilkonpensasisopp2['nominal'] + $hasilkonpensasiindovision2['nominal'] + $hasilkonpensasiarindo2['nominal'] + $hasilkonpensasiaoratv2['nominal'] + $hasilkonpensasitransvision2['nominal'] ;
	$selisih = $row12['jumlah_rk'] - $total;

	echo "<tr>";
	echo "<td align=center>$i</td>";
	echo "<td>{$row['tempat']}</td>";
	echo "<td align=right>".number_format($row['amount']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row['jumlahjastel']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row2['hasil']+$hasilkonpensasipln['nominal']+ $hasilkonpensasipln2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row2['hasil2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row3['penpdam']+$hasilkonpensasipdam['nominal']+$hasilkonpensasipdam2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row3['feepdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row4['penvoucher']+$row5['penvouchersmart']+$row6['penvouchertri']+ $hasilkonpensasivouchertsel['nominal']	+ $hasilkonpensasivouchertri['nominal'] + $hasilkonpensasivouchersmart['nominal']+ $hasilkonpensasivouchertsel2['nominal']	+ $hasilkonpensasivouchertri2['nominal'] + $hasilkonpensasivouchersmart2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row4['feevoucher']+$row5['feevouchersmart']+$row6['feevouchertri'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row7['pen_indovision']+ $hasilkonpensasiindovision['nominal']+ $hasilkonpensasiindovision2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row7['fee_indovision'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row8['pen_transvision']+ $hasilkonpensasitransvision['nominal']+ $hasilkonpensasitransvision2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row8['fee_transvision'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row9['pen_aora']+ $hasilkonpensasiaoratv['nominal']+ $hasilkonpensasiaoratv2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row9['fee_aora'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row11['fee_arindo'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($row10['arindo_pen']+ $hasilkonpensasiarindo['nominal']+ $hasilkonpensasiarindo2['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	echo "<td align=right>".number_format($total, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	$hapus  = "DELETE FROM total_trx WHERE tanggal='$tampil_date' AND tempat='{$row['tempat']}'";
	$simpan = "INSERT INTO total_trx VALUES('$tampil_date','{$row['tempat']}',$total)";
	if ($tampil_date != $tampil_date2) 
	{mysqli_query($konek,$hapus);
	mysqli_query($konek,$simpan);}
	
	echo "<td align=right>".number_format($row12['jumlah_rk'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
	if ($selisih >= 0)
		{
			echo "<td align=right>".number_format($selisih, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
			echo "<td align=right>0</td>";
			$jumlahtitipan = $jumlahtitipan + $selisih;
		}
	else
		{
			echo "<td align=right>0</td>";
			echo "<td align=right>".number_format($selisih, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
			$jumlahtalangan = $jumlahtalangan + $selisih;
		}
	echo "</tr>";


	$jumlahamount = $jumlahamount + $row['amount']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'];
	$jumlahfeenonadmin = $jumlahfeenonadmin + $row['feenonadmin'];
	$jumlahadminjastel = $jumlahadminjastel + $row['adminjastel'];
	$jumlahjastel = $jumlahjastel + $row['jumlahjastel']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'];
	$jumlahpenpln = $jumlahpenpln + $row2['hasil']+$hasilkonpensasipln['nominal']+ $hasilkonpensasipln2['nominal'];
	$jumlahfeepln = $jumlahfeepln + $row2['hasil2'];
	$jumlahpenpdam = $jumlahpenpdam + $row3['penpdam']+$hasilkonpensasipdam['nominal']+ $hasilkonpensasipdam2['nominal'];
	$jumlahfeepdam = $jumlahfeepdam + $row3['feepdam'];
	$jumlahpentsel = $jumlahpentsel + $row4['penvoucher'];
	$jumlahfeetsel = $jumlahfeetsel + $row4['feevoucher'];
	$jumlahpensmart = $jumlahpensmart + $row5['penvouchersmart'];
	$jumlahfeesmart = $jumlahfeesmart + $row5['feevouchersmart'];
	$jumlahpentri = $jumlahpentri + $row6['penvouchertri'];
	$jumlahfeetri = $jumlahfeetri + $row6['feevouchertri'];
	$jumlahpenindovision = $jumlahpenindovision + $row7['pen_indovision']+ $hasilkonpensasiindovision['nominal']+ $hasilkonpensasiindovision2['nominal'];
	$jumlahfeeindovision = $jumlahfeeindovision + $row7['fee_indovision'];
	$jumlahpentransvision = $jumlahpentransvision + $row8['pen_transvision']+ $hasilkonpensasitransvision['nominal']+ $hasilkonpensasitransvision2['nominal'];
	$jumlahfeetransvision = $jumlahfeetransvision + $row8['fee_transvision'];
	$jumlahpenaora = $jumlahpenaora + $row9['pen_aora']+ $hasilkonpensasiaoratv['nominal']+ $hasilkonpensasiaoratv2['nominal'];
	$jumlahfeeaora = $jumlahfeeaora + $row9['fee_aora'];
	$jumlahpenarindo = $jumlahpenarindo + $row10['arindo_pen']+ $hasilkonpensasiarindo['nominal']+ $hasilkonpensasiarindo2['nominal'];
	$jumlahfeearindo = $jumlahfeearindo + $row11['fee_arindo'];
	$jumlahrk = $jumlahrk + $row12['jumlah_rk'];
	$jumlahtotal = $jumlahtotal + $total;

	$totalpenvoucher = $jumlahpentsel + $jumlahpentri + $jumlahpensmart+ $hasilkonpensasivouchertsel['nominal']	+ $hasilkonpensasivouchertri['nominal'] + $hasilkonpensasivouchersmart['nominal']+ $hasilkonpensasivouchertsel2['nominal']	+ $hasilkonpensasivouchertri2['nominal'] + $hasilkonpensasivouchersmart2['nominal'];
	$totalfeevoucher = $jumlahfeetsel + $jumlahfeetri + $jumlahfeesmart;
	$i++;

	
}
?>
<tr>
	<td colspan="2">Jumlah</td>
	<td align=right><?=number_format($jumlahamount, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeenonadmin, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahadminjastel, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahjastel, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpenpln, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeepln, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpenpdam, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeepdam, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($totalpenvoucher, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($totalfeevoucher, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpenindovision, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeeindovision, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpentransvision, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeetransvision, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpenaora, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeeaora, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahfeearindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahpenarindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahtotal, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahrk, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahtitipan, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
	<td align=right><?=number_format($jumlahtalangan, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan) ?></td>
</tr>
</table>




<table>
<tr></tr>
<tr></tr>
            
            <tr><td colspan="2">Bandung, ....................</td></tr>
            <tr><td colspan="2">Yang Menyerahkan </td><td></td><td></td><td>Yang Membuat</td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
			<tr><td height="125px"></td></tr>
            <tr><td colspan="2"><u>RIYADI DERAJAT</u> </td><td></td><td></td><td>Mira Dewi K</td></tr>
            <tr><td colspan="2">Manager Jastel & SDM</td></tr>
            </table>  

</td>
				</tr>
			</table>
		</td>
	</tr>
</table>