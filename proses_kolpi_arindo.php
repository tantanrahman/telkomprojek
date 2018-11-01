 <?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

header("Content-type: application/msword");

 


header("Content-Disposition: attachment; filename=Kolpi-Arindo-$tahun-$bulan.doc");


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


$sql = 	"
			Select arindo_tempat.user, arindo_tempat.kode_user, IFNULL(sum(pln_lembar),0) as pln_lembar,IFNULL(sum(pln_trx),0) as pln_trx,IFNULL(sum(telepon_lembar),0) as telepon_lembar,IFNULL(sum(telepon_trx),0) as telepon_trx,IFNULL(sum(indovision_lembar),0) as indovision_lembar,IFNULL(sum(indovision_trx),0) as indovision_trx,IFNULL(sum(halo_lembar),0) as halo_lembar,IFNULL(sum(halo_trx),0) as halo_trx,IFNULL(sum(pulsa_lembar),0) as pulsa_lembar,IFNULL(sum(pulsa_trx),0) as pulsa_trx,IFNULL(sum(pdam_lembar),0) as pdam_lembar,IFNULL(sum(pdam_trx),0) as pdam_trx,IFNULL(sum(adira_lembar),0) as adira_lembar,IFNULL(sum(adira_trx),0) as adira_trx,IFNULL(sum(baf_lembar),0) as baf_lembar,IFNULL(sum(baf_trx),0) as baf_trx,IFNULL(sum(fif_lembar),0) as fif_lembar,IFNULL(sum(fif_trx),0) as fif_trx,IFNULL(sum(bpjs_lembar),0) as bpjs_lembar,IFNULL(sum(bpjs_trx),0) as bpjs_trx, IFNULL(sum(plnp_trx),0) as plnp_trx, IFNULL(sum(plnp_lembar),0) as plnp_lembar, IFNULL(sum(wom_lembar),0) as wom_lembar, IFNULL(sum(wom_trx),0) as wom_trx
			from arindo_tempat left join arindo_trx on arindo_tempat.kode_user=arindo_trx.kode_user and tanggal between '$tahun-$bulan-1' and '$tahun-$bulan-31' group by user
			";
			
?>
<html>
<head>
	<style>
	table.atas {
		font-family: "TIMES NEW ROMAN";
font-size:7pt;
margin:0px;
	}
	table.ttd {
		font-family: "TIMES NEW ROMAN";
font-size:10pt;
margin:0px;

	}
@page Section1 {size:595.45pt 841.7pt; margin:1.0in 1.25in 1.0in 1.25in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
div.Section1 {page:Section1;}
@page Section2 {size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:0.2in 0.3in 0.1in 0.3in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;font-size: 10pt!important;}
div.Section2 {page:Section2;}
</style>
</head>
<body>
<div class="Section2">
<table id="mytable" class="atas" border="1" >
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">User</th>
		<th rowspan="2">Kode User</th>
		<th colspan="2">PLN (POSTPAID)</th>
		<th colspan="2">PLN </th>
		<th colspan="2">Telepon </th>
		<th colspan="2">Indovision </th>
		<th colspan="2">Kartu Halo </th>
		<th colspan="2">Pulsa </th>
		<th colspan="2">PDAM </th>
		<th colspan="2">WOM </th>
		<th colspan="2">ADIRA </th>
		<th colspan="2">BAF </th>
		<th colspan="2">BPJS </th>
		<th colspan="2">FIF </th>
		<th colspan="2">Total </th>
		
	</tr>
	<tr>
		<th>Lbr</th>
		<th>Fee 1700</th>
		<th>Lbr</th>
		<th>Fee 1700</th>
		<th>Lbr</th>
		<th>Fee 1600</th>
		<th>Lbr</th>
		<th>Fee 1100</th>
		<th>Lbr</th>
		<th>Fee 1100</th>
		<th>Lbr</th>
		<th>Fee 10</th>
		<th>Lbr</th>
		<th>Fee 850</th>
		<th>Lbr</th>
		<th>Fee 2100</th>
		<th>Lbr</th>
		<th>Fee 2100</th>
		<th>Lbr</th>
		<th>Fee 2100</th>
		<th>Lbr</th>
		<th>Fee 1200</th>
		<th>Lbr</th>
		<th>Fee 1350</th>
		<th>Lbr</th>
		<th>Fee</th>
	</tr>

<?php
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
$no=1;
$hasil = $row['hasil'];
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	$tampilpln =  number_format($row['pln_lembar']*1700, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiltelepon =  number_format($row['telepon_lembar']*1600, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilindovision =  number_format($row['indovision_lembar']*1100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilhalo =  number_format($row['halo_lembar']*1100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilpulsa =  number_format($row['pulsa_lembar']*10, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilpdam =  number_format($row['pdam_lembar']*850, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiladira =  number_format($row['adira_lembar']*2100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilbaf =  number_format($row['baf_lembar']*2100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilbpjs =  number_format($row['bpjs_lembar']*1200, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilfif =  number_format($row['fif_lembar']*1350, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilwom =  number_format($row['wom_lembar']*1350, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilplnp =  number_format($row['plnp_lembar']*1700, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$jumlahlbr=$row['plnp_lembar']+$row['pln_lembar']+$row['telepon_lembar']+$row['indovision_lembar']+$row['halo_lembar']+$row['pulsa_lembar']+$row['pdam_lembar']+$row['adira_lembar']+$row['baf_lembar']+$row['bpjs_lembar']+$row['fif_lembar']+$row['wom_lembar'];
	$jumlahfee= $row['plnp_lembar']*1700+$row['pln_lembar']*1700 + $row['telepon_lembar']*1600 + $row['indovision_lembar']*1100 + $row['pulsa_lembar']*10 + $row['pdam_lembar']*850 + $row['adira_lembar']*2100 +  $row['baf_lembar']*2100+$row['bpjs_lembar']*1200+$row['fif_lembar']*1350+$row['wom_lembar']*2100;

	$tampiljumlahfee = number_format($jumlahfee, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	echo "<tr>";
	echo "<td align=center>$no</td>";
	echo "<td align=left>{$row['user']}</td>";
	echo "<td align=left>{$row['kode_user']}</td>";
	echo "<td align=right>{$row['plnp_lembar']}</td>";
	echo "<td align=right>$tampilplnp</td>";
	echo "<td align=right>{$row['pln_lembar']}</td>";
	echo "<td align=right>$tampilpln</td>";
	echo "<td align=right>{$row['telepon_lembar']}</td>";
	echo "<td align=right>$tampiltelepon</td>";
	echo "<td align=right>{$row['indovision_lembar']}</td>";
	echo "<td align=right>$tampilindovision</td>";
	echo "<td align=right>{$row['halo_lembar']}</td>";
	echo "<td align=right>$tampilhalo</td>";
	echo "<td align=right>{$row['pulsa_lembar']}</td>";
	echo "<td align=right>$tampilpulsa</td>";
	echo "<td align=right>{$row['pdam_lembar']}</td>";
	echo "<td align=right>$tampilpdam</td>";
	echo "<td align=right>{$row['wom_lembar']}</td>";
	echo "<td align=right>$tampilwom</td>";
	echo "<td align=right>{$row['adira_lembar']}</td>";
	echo "<td align=right>$tampiladira</td>";
	echo "<td align=right>{$row['baf_lembar']}</td>";
	echo "<td align=right>$tampilbaf</td>";
	echo "<td align=right>{$row['bpjs_lembar']}</td>";
	echo "<td align=right>$tampilbpjs</td>";
	echo "<td align=right>{$row['fif_lembar']}</td>";
	echo "<td align=right>$tampilfif</td>";
	echo "<td align=right>$jumlahlbr</td>";
	echo "<td align=right>$tampiljumlahfee</td>";
	echo "</tr>";

	$jumlahpln= $jumlahpln + $row['pln_lembar'];
	$jumlahtelepon= $jumlahtelepon + $row['telepon_lembar'];
	$jumlahindovsion= $jumlahindovsion + $row['indovision_lembar'];
	$jumlahhalo= $jumlahhalo + $row['halo_lembar'];
	$jumlahpulsa= $jumlahpulsa + $row['pulsa_lembar'];
	$jumlahpdam= $jumlahpdam + $row['pdam_lembar'];
	$jumlahadira= $jumlahadira + $row['adira_lembar'];
	$jumlahbaf= $jumlahbaf + $row['baf_lembar'];
	$jumlahbpjs= $jumlahbpjs + $row['bpjs_lembar'];
	$jumlahfif= $jumlahfif + $row['fif_lembar'];
	$jumlahplnp= $jumlahplnp + $row['plnp_lembar'];
	$jumlahwom= $jumlahwom + $row['wom_lembar'];





	$jumlahlbr2 = $jumlahlbr2 + $jumlahlbr;
	$jumlahfee2 = $jumlahfee2 + $jumlahfee;
	$tampilfee =  number_format($jumlahfee2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	$no++;
}
$tampilpln =  number_format($jumlahpln*1700, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilplnp =  number_format($jumlahplnp*1700, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiltelepon =  number_format($jumlahtelepon*1600, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilindovision =  number_format($jumlahindovsion*1100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilhalo =  number_format($jumlahhalo*1100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilpulsa =  number_format($jumlahpulsa*10, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilpdam =  number_format($jumlahpdam*850, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiladira =  number_format($jumlahadira*2100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilbaf =  number_format($jumlahbaf*2100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilbpjs =  number_format($jumlahbpjs*1200, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilfif =  number_format($jumlahfif*1350, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilwom =  number_format($jumlahwom*2100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
echo "<tr>";
echo "<td colspan=3 align=center>TOTAL</td>";
echo "<td align=right>$jumlahplnp</td>";
	echo "<td align=right>$tampilplnp</td>";
	echo "<td align=right>$jumlahpln</td>";
	echo "<td align=right>$tampilpln</td>";
	echo "<td align=right>$jumlahtelepon</td>";
	echo "<td align=right>$tampiltelepon</td>";
	echo "<td align=right>$jumlahindovsion</td>";
	echo "<td align=right>$tampilindovision</td>";
	echo "<td align=right>$jumlahhalo</td>";
	echo "<td align=right>$tampilhalo</td>";
	echo "<td align=right>$jumlahpulsa</td>";
	echo "<td align=right>$tampilpulsa</td>";
	echo "<td align=right>$jumlahpdam</td>";
	echo "<td align=right>$tampilpdam</td>";
	echo "<td align=right>$jumlahwom</td>";
	echo "<td align=right>$tampilwom</td>";
	echo "<td align=right>$jumlahadira</td>";
	echo "<td align=right>$tampiladira</td>";
	echo "<td align=right>$jumlahbaf</td>";
	echo "<td align=right>$tampilbaf</td>";
	echo "<td align=right>$jumlahbpjs</td>";
	echo "<td align=right>$tampilbpjs</td>";
	echo "<td align=right>$jumlahfif</td>";
	echo "<td align=right>$tampilfif</td>";
	echo "<td align=right>$jumlahlbr2</td>";
	echo "<td align=right>$tampilfee</td>";
	echo "</tr>";
echo "</tr>";
require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang1 = $moneyFormat->terbilang($jumlahfee2);
?>

</table>
<table class="ttd">
	<tr>
		<td colspan="2">Keterangan</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Mohon di transfer Sebesar</td>
		<td colspan="15">Rp. <?php echo $tampilfee; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Terbilang</td>
		<td colspan="15">Rp. <?php echo $terbilang1; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Ke Nomor Rekening</td>
		<td colspan="15">132.0088.0000.55</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Bank</td>
		<td colspan="15">BANK MANDIRI CAB BRAGA BANDUNG</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Atas Nama</td>
		<td colspan="15">KOPERASI JASA DADALI BANDUNG</td>
	</tr>
	<tr>
		<td colspan="4">Bandung,</td>
	</tr>
	<tr>
		<td colspan="4">KOPERASI JASA DADALI BANDUNG<br><br><br><br></td>
	</tr>
	
	<tr><td colspan="4"><u>MAMAN AGUS ROKHMAN</u></td></tr>
	<tr><td colspan="4">GM KKOPERASI JASA DADALI BANDUNG</td></tr>
</table>
</div>
</body></html>