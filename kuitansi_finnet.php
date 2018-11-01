<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];


 	if ($bulan == 1 ) 
 		{ $bulan2 = "Januari"; }
    if ($bulan == 2 ) 
    	{ $bulan2 = "Februari"; }
    if ($bulan == 3 ) 
    	{ $bulan2 = "Maret"; }
    if ($bulan == 4 ) 
    	{ $bulan2 = "April"; }
    if ($bulan == 5 ) 
    	{ $bulan2 = "Mei"; }
    if ($bulan == 6 ) 
    	{ $bulan2 = "Juni"; }
    if ($bulan == 7 ) 
    	{ $bulan2 = "Juli"; }
    if ($bulan == 8 ) 
    	{ $bulan2 = "Agustus"; }
    if ($bulan == 9 ) 
    	{ $bulan2 = "September"; }
    if ($bulan == 10) 
    	{ $bulan2 = "Oktober"; }
    if ($bulan == 11) 
    	{ $bulan2 = "November"; }
    if ($bulan == 12) 
    	{ $bulan2 = "Desember"; }

//header("Content-type: application/vnd-ms-excel");
header("Content-type: application/msword");

 
// Defines the name of the export file "codelution-export.xls"

header("Content-Disposition: attachment; filename=-Kuitansi-Kolpi-finnet-$tahun-$bulan.doc");
?>
<html moznomarginboxes mozdisallowselectionprint>
<head>
	<style type="text/css">
@media print
    {               
      @page port { size: portrait; }
      .portrait { page: port; }

                  

      .break { page-break-before: always; }
    }
    body 
    {
    	
    }
</style>
<style>
table td
{
	font-size: 10pt;
	font-family: "TIMES NEW ROMAN";
}
table th
{
	font-size: 14pt;
	font-weight: bold;
	font-family: "TIMES NEW ROMAN";
}
@page Section1 {size:21.59cm 35.56cm; margin:0.1in 0.1in 0.1in 0.5in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
div.Section1 {page:Section1;}
@page Section2 {size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
div.Section2 {page:Section2;}
</style>
</head>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');



$sql = 	"
			select lokasi.tempat,kode_loket, sum(trx) as trx,sum(amount) as amount from lokasi left join sopp on lokasi.loket=sopp.user where (sopp.user like '%lembong%' or sopp.user like '%setiabudi%') and (tanggal between '$tahun-$bulan-1' and '$tahun-$bulan-31') group by tempat
			";
?>
<body>
<div class="Section1">
<script type="text/javascript">


	window.print();
	window.close();
</script>


<?php
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
$no=1;

$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
?>

<?php
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	$tampillembar = number_format($row['trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiljumlah = number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	$jumlahlembar = $jumlahlembar + $row['trx'];
	$jumlahtotal = $jumlahtotal + $row['trx']*1650;
	$jumlahamount = $jumlahamount + $row['amount'];

	
}
require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang1 = $moneyFormat->terbilang($jumlahtotal);

	$tampillembar = number_format($jumlahlembar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiljumlah = number_format($jumlahtotal, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilamount = number_format($jumlahamount, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
?>

<table style="height:24cm;width:25cm;">
<tr style="height:9cm;"><td>
<table>
	<tr><th align="center" colspan="3"><br><br>KUITANSI</th></tr>
	<tr><td>Nomor</td><td>:</td><td></td></tr>
	<tr><td>Telah Terima Dari</td><td>:</td><td>PT. FINNET INDONESIA</td></tr>
	<tr><td>Jumlah</td><td>:</td><td>Rp <?=$tampiljumlah ?></td></tr>
	<tr><td>Terbilang</td><td>:</td><td>#<?=$terbilang1 ?> rupiah#</td></tr>
	<tr><td>Uraian</td><td>:</td><td>Pekerjaan Coll FEE SOPP Periode <?=$bulan2?> <?=$tahun?> PKS No.0200/PKS-001/FINNET-01/2010 tertanggal 24 Juni 2010</td></tr>
</table>
<table border="1"><tr><td style="width:5cm;" align="center">Rp <?=$tampiljumlah ?></td></tr></table>
<table style="width:20cm">
	<tr><td style="width:13cm;"></td><td align="left" style="padding-left:2.5cm;">Bandung, <br><br><br></td></tr>
	<tr><td></td><td align="center"><b><u>MAMAN AGUS ROKHMAN</u></b></td></tr>
	<tr><td></td><td align="center">GENERAL MANAGER</td></tr>
	<tr><td>Lembar 1/ASLI</td></tr>
</table>
</td></tr>
<tr style="height:9cm;"><td>
<table>
<tr><td style="height:2cm;"></td></tr>
	<tr><th align="center" colspan="3"><br><br>KUITANSI</th></tr>
	<tr><td>Nomor</td><td>:</td><td></td></tr>
	<tr><td>Telah Terima Dari</td><td>:</td><td>PT. FINNET INDONESIA</td></tr>
	<tr><td>Jumlah</td><td>:</td><td>Rp <?=$tampiljumlah ?></td></tr>
	<tr><td>Terbilang</td><td>:</td><td>#<?=$terbilang1 ?> rupiah#</td></tr>
	<tr><td>Uraian</td><td>:</td><td>Pekerjaan Coll FEE SOPP Periode <?=$bulan2?> <?=$tahun?> PKS No.0200/PKS-001/FINNET-01/2010 tertanggal 24 Juni 2010</td></tr>
</table>

<table border="1"><tr><td style="width:5cm;" align="center">Rp <?=$tampiljumlah ?></td></tr></table>
<table style="width:20cm">
	<tr><td style="width:13cm;"></td><td align="left" style="padding-left:2.5cm;">Bandung, <br><br><br></td></tr>
	<tr><td></td><td align="center"><b><u>MAMAN AGUS ROKHMAN</u></b></td></tr>
	<tr><td></td><td align="center">GENERAL MANAGER</td></tr>
	<tr><td>Lembar 2/ARSIP</td></tr>
</table>
</td></tr>
<tr style="height:9cm;"><td>
<table>
<tr><td style="height:3cm;"></td></tr>
	<tr><th align="center" colspan="3"><br><br>KUITANSI</th></tr>
	<tr><td>Nomor</td><td>:</td><td></td></tr>
	<tr><td>Telah Terima Dari</td><td>:</td><td>PT. FINNET INDONESIA</td></tr>
	<tr><td>Jumlah</td><td>:</td><td>Rp <?=$tampiljumlah ?></td></tr>
	<tr><td>Terbilang</td><td>:</td><td>#<?=$terbilang1 ?> rupiah#</td></tr>
	<tr><td>Uraian</td><td>:</td><td>Pekerjaan Coll FEE SOPP Periode <?=$bulan2?> <?=$tahun?> PKS No.0200/PKS-001/FINNET-01/2010 tertanggal 24 Juni 2010</td></tr>
</table>

<table border="1"><tr><td style="width:5cm;" align="center">Rp <?=$tampiljumlah ?></td></tr></table>
<table style="width:20cm">
	<tr><td style="width:13cm;"></td><td align="left" style="padding-left:2.5cm;">Bandung, <br><br><br></td></tr>
	<tr><td></td><td align="center"><b><u>MAMAN AGUS ROKHMAN</u></b></td></tr>
	<tr><td></td><td align="center">GENERAL MANAGER</td></tr>
	<tr><td>Lembar 3/COPY</td></tr>
</table>
</td></tr>
	
</table>
</div>