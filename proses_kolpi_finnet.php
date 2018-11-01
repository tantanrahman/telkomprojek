 <?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

//header("Content-type: application/vnd-ms-excel");
header("Content-type: application/msword");

 
// Defines the name of the export file "codelution-export.xls"

header("Content-Disposition: attachment; filename=Kolpi-finnet-$tahun-$bulan.doc");
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
@page Section1 {size:595.45pt 841.7pt; margin:1.0in 1.0in 1.0in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
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

<table id="mytable" class="table table-bordered table-striped table-fixed-header">
	

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
<center><h3>
BERITA ACARA TRANSAKSI PEMBAYARAN REKENING JASTEL<br>
COLLECTING AGENT KOPERASI JASA DADALI BANDUNG<br>
PERIODE BULAN 
<?php

switch ($bulan) {
		case '1':
		echo "JANUARI";
		break;
		case '2':
		echo "FEBRUARI";
		break;
		case '3':
		echo "MARET";
		break;
		case '4':
		echo "APRIL";
		break;
		case '5':
		echo "MEI";
		break;
		case '6':
		echo "JUNI";
		break;
		case '7':
		echo "JULI";
		break;
		case '8':
		echo "AGUSTUS";
		break;
		case '9':
		echo "SEPTEMBER";
		break;
		case '10':
		echo "OKTOBER";
		break;
		case '11':
		echo "NOPEMBER";
		break;
		case '12':
		echo "DESEMBER";
		break;
	default:
		echo "Input Salah";
		break;
}
echo " $tahun";
?>
</h3></center>
<hr>
Pada Hari ini&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tahun&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
<br>Kami yang bertanda tangan di bawah ini:
<table>
	<tr>
		<td rowspan="3"  style="vertical-align:top;width:1cm;">1</td>
		<td>Nama</td>
		<td>:</td>
		<td>MAMAN AGUS ROKHMAN</td>
	</tr>
	<tr>
		
		<td>Jabatan</td>
		<td>:</td>
		<td>GENERAL MANAGER</td>
	</tr>
	<tr>
		
		<td>Perusahaan</td>
		<td>:</td>
		<td>KOPERASI JASA DADALI BANDUNG</td>
	</tr>
	<tr>
		<td rowspan="3"  style="vertical-align:top;width:1cm;">2</td>
		<td>Nama</td>
		<td>:</td>
		<td>ZAINUDDIN</td>
	</tr>
	<tr>
		
		<td>Jabatan</td>
		<td>:</td>
		<td>SENIOR MANAGER DATA RECONCILIATION</td>
	</tr>
	<tr>
		
		<td>Perusahaan</td>
		<td>:</td>
		<td>PT. FINNET INDONESIA</td>
	</tr>
</table>
<p style="text-align: justify;">
Dengan ini menyatakan telah mengadakan Rekonsiliasi terhadap jumlah transaksi pembayara Jasa Telekomunikasi di Collection Agent KOPERASI JASA DADALI BANDUNG UNTUK PERIODE 
<?php
switch ($bulan) {
		case '1':
		echo "JANUARI";
		break;
		case '2':
		echo "FEBRUARI";
		break;
		case '3':
		echo "MARET";
		break;
		case '4':
		echo "APRIL";
		break;
		case '5':
		echo "MEI";
		break;
		case '6':
		echo "JUNI";
		break;
		case '7':
		echo "JULI";
		break;
		case '8':
		echo "AGUSTUS";
		break;
		case '9':
		echo "SEPTEMBER";
		break;
		case '10':
		echo "OKTOBER";
		break;
		case '11':
		echo "NOPEMBER";
		break;
		case '12':
		echo "DESEMBER";
		break;
	default:
		echo "Input Salah";
		break;
}
echo " $tahun sebagai berikut :";
?>
</p>
<table border="1" id="mytable" class="table table-bordered table-striped table-fixed-header">
<tr>
	<th rowspan="2">No</th>
	<th rowspan="2">NAMA COLLECT AGENT</th>
	<th rowspan="2">KODE LOKET</th>
	<th colspan="2">TRANSAKSI PENYETORAN</th>
</tr>
<tr>
	<th>LEMBAR</th>
	<th>JUMLAH</th>
</tr>
<?php
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	$tampillembar = number_format($row['trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiljumlah = number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	$jumlahlembar = $jumlahlembar + $row['trx'];
	$jumlahtotal = $jumlahtotal + $row['trx']*1650;
	$jumlahamount = $jumlahamount + $row['amount'];

	echo "<tr>";
	echo "<td>$no</td>";
	echo "<td>LOKET {$row['tempat']} </td>";
	echo "<td align=center>{$row['kode_loket']} </td>";
	echo "<td align=center>$tampillembar</td>";
	echo "<td align=right>$tampiljumlah</td>";
	echo "</tr>";
	$no++;
}
	$tampillembar = number_format($jumlahlembar, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampiljumlah = number_format($jumlahtotal, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	$tampilamount = number_format($jumlahamount, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
?>
	<tr>
		<th colspan="3">
			Jumlah
		</th>
		<th>
			<?php echo "$tampillembar"; ?>
		</th>
		<th>
			<?php echo "$tampilamount"; ?>
		</th>
	</tr>
	<tr>
		<th colspan="3">
			Jumlah Collection Fee
		</th>
		<th>
		</th>
		<th>
			<?php echo number_format($jumlahtotal*90/100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?>
		</th>
	</tr>
	<tr>
		<th colspan="3">
			PPN 10%
		</th>
		<th>
		</th>
		<th>
			<?php echo number_format($jumlahtotal*10/100, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?>
		</th>
	</tr>
	<tr>
		<th colspan="3">
			Total Tagihan
		</th>
		<th>
		</th>
		<th>
			<?php echo number_format($jumlahtotal, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?>
		</th>
	</tr>
</table>
<p style="text-align: justify;">
Pembayaran ditransfer melalui <b>BANK MANDIRI CAB BRAGA BANDUNG </b> no rekening <b>132.0088.0000.55</b> atas nama <b>KOPERASI JASA DADALI BANDUNG.</b>
</p>
<p style="text-align: justify;">
Demikian Berita Acara ini dibuat dengan sebenarnya untuk dipergunakan sebagai dasar pembayaran collection fee.
</p>
<br>
<table style="width:16cm;">
	<tr>
		<td colspan="3" align="center" width="50%">
		PT. FINNET INDONESIA
		<br>
		<br>
		<br>
		<br>
		<br>
		</td>
		<td colspan="2" align="center" width="50%">
		KOPERASI JASA DADALI BANDUNG
		<br>
		<br>
		<br>
		<br>
		<br>
		</td>
	</tr>
	<tr><td></td></tr>
	
	<tr>
		<td colspan="3" align="center">
		<u>ZAINUDDIN</u>
		</td>
		<td colspan="2" align="center">
		<u>MAMAN A ROKHMAN</u>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		SM DATA RECONCILIATION
		
		</td>
		<td colspan="2" align="center">
		GENERAL MANAGER
		</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<table>
	<tr>
		<td colspan="3">
			Nomor :
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Bandung,
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Kepada Yth.<br>
			PT.FINNET INDONESIA<br>
			Menara Bidakara Lt.6 & 21 <br>
			Jl. Gatot Subroto Kav.71-73<br>
			JAKARTA SELATAN
		</td>
	</tr>
	<tr>
		<td colspan="3">
		<br>
			Perihal : Permohonan Pembayaran
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Dengan Hormat
		</td>
	</tr>
	<tr>
		<td colspan="2" style="vertical-align:top;width:2cm;">
			1.
		</td>
		<td colspan="3" style="text-align: justify;">
			Menunjuk Perjanjian Kerja Sama (PKS) No. 0200/PKS-001/FINNET-01/2012 tanggal 24 Juni 2010 Tentang Penyediaan Layanan Transaksi Elektronik Untuk Penerimaan Pembayaran Jasa Telekomunikasi TELKOM dan Biller Lainnya. <br>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="vertical-align:top;width:2cm;">
			2.
		</td>
		<td colspan="3" style="text-align: justify;">
			Dengan ini kami mengajukan permohonan Pembayaran Pekerjaan Collection Fee JASTEL Periode Bulan 
			<?php
switch ($bulan) {
		case '1':
		echo "JANUARI";
		break;
		case '2':
		echo "FEBRUARI";
		break;
		case '3':
		echo "MARET";
		break;
		case '4':
		echo "APRIL";
		break;
		case '5':
		echo "MEI";
		break;
		case '6':
		echo "JUNI";
		break;
		case '7':
		echo "JULI";
		break;
		case '8':
		echo "AGUSTUS";
		break;
		case '9':
		echo "SEPTEMBER";
		break;
		case '10':
		echo "OKTOBER";
		break;
		case '11':
		echo "NOPEMBER";
		break;
		case '12':
		echo "DESEMBER";
		break;
	default:
		echo "Input Salah";
		break;
}
require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang1 = $moneyFormat->terbilang($jumlahtotal);
echo " $tahun sebesar Rp. $tampiljumlah ( $terbilang1 rupiah ) sudah termasuk PPN 10% dan mohon pembayaran tersebut dapat ditransfer melalui :";
?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			
		</td>
		<td colspan="">
			BANK
		</td>
		<td>
			:
		</td>
		<td>
			BANK MANDIRI CAB BRAGA BANDUNG
		</td>
	</tr>
	<tr>
		<td colspan="2">
			
		</td>
		<td colspan="">
			Nomor Rekening
		</td>
		<td>
			:
		</td>
		<td>
			132.0088.0000.55
		</td>
	</tr>
	<tr>
		<td colspan="2">
			
		</td>
		<td colspan="">
			Atas Nama
		</td>
		<td>
			:
		</td>
		<td>
			KOPERASI JASA DADALI BANDUNG
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="vertical-align:top;width:2cm;">
			3.
		</td>
		<td colspan="3">
			Demikian kami sampaikan, terima kasih atas perhatian dan kerjasamanya.
		</td>
		
	</tr>
	<tr>
		<td colspan="5">
		<br>
		<br>
		Hormat Kami,
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="5">
		KOPERASI JASA DADALI BANDUNG
		<br>
		<br>
		<br>
		<br>
		<br>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr>
		<td colspan="5">
		<u>MAMAN AGUS ROKHMAN</u>
		</td>
	</tr>
	<tr>
		<td colspan="5">
		<u>GENERAL MANAGER</u>
		</td>
	</tr>
	<tr>
		<td colspan="5">
		<br>Tembusan : Arsip
		</td>
	</tr>
</table>
</table>
</td>
				</tr>
			</table>



