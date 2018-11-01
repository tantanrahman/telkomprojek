

<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
// The function header by sending raw excel
$tanggal1 = $_POST['nilai'];
$tanggal2 = $_POST['nilai2'];
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
if ($tanggal1==$tanggal2)
{

header("Content-Disposition: attachment; filename=RekapPendapatanLoket-$tanggal1.xls");
}
else
{
header("Content-Disposition: attachment; filename=RekapPendapatanLoket-$tanggal1-$tanggal2.xls");	
} 
// Add data table

echo "<b>REKAP PENDAPATAN LOKET</b><br>";
if ($tanggal1==$tanggal2)
{
	echo "Tgl : $tanggal1";
}
	else
	{
		echo "Tgl : $tanggal1-$tanggal2";
	}

/*
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}





if ($tanggal1==$tanggal2)
{
	$sql = "Select A.loket,A.lokasi,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.feenonadmin is NULL then '0' else A.feenonadmin END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.feepln,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal, sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket  group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket, pdam.tanggal as tanggal,sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket  group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi group by lokasi.loket) as E on (D.loket=E.loket)

where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL) AND (E.tanggal='$tanggal1' OR E.tanggal is NULL)";

$pecah = explode('-', $tanggal1);

if (($pecah[0]==31 && $pecah[1]==1) || ($pecah[0]==31 && $pecah[1]==3) || ($pecah[0]==30 && $pecah[1]==4) || ($pecah[0]==31 && $pecah[1]==5) || ($pecah[0]==30 && $pecah[1]==6) || ($pecah[0]==31 && $pecah[1]==7) || ($pecah[0]==31 && $pecah[1]==8) || ($pecah[0]==30 && $pecah[1]==9) || ($pecah[0]==31 && $pecah[1]==10) || ($pecah[0]==30 && $pecah[1]==11))
{
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==29 && $pecah[1]==2 && $pecah[2]%4==0)) {
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==28 && $pecah[1]==2 && $pecah[2]%4<>0))
{
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==31 && $pecah[1]==12))
{
	$pecah[0]=0;
	$pecah[1]=0;
	$pecah[0]=$pecah[0]+1;
	$pecah[1]=$pecah[1]+1;
	$pecah[2]=$pecah[2]+1;
	$tampil = implode("-", $pecah);
}
else 
{
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}


}
else {
$sql = "Select A.loket,A.lokasi,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.feenonadmin is NULL then '0' else A.feenonadmin END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.feepln,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal, sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket  group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket, pdam.tanggal as tanggal,sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket  group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi group by lokasi.loket) as E on (D.loket=E.loket)
where ((A.tanggal between '$tanggal1' AND '$tanggal2') OR A.tanggal is NULL) AND ((B.tanggal between '$tanggal1' AND '$tanggal2') OR B.tanggal is NULL) AND ((C.tanggal between '$tanggal1' AND '$tanggal2') OR C.tanggal is NULL) AND ((D.tanggal between '$tanggal1' AND '$tanggal2') OR D.tanggal is NULL) ";
 }
mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}


?>
<table border="" class="table-responsive table-bordered table">
	<tr>
		<td rowspan="2">No</td>
		<td rowspan="2"> User/Loker SOPP</td>
		<td colspan="4" align="center" valign="center">Jastel</td>
		<td colspan="2" align="center" valign="center">PLN</td>
		<td colspan="2" align="center" valign="center">PDAM</td>
		<td colspan="2" align="center" valign="center">Voucher</td>
		<td colspan="2" align="center" valign="center">Transaksi Arindo</td>
		<td rowspan="2" align="center" valign="center">Total Transaksi</td>
		<?php
		if ($tanggal1 == $tanggal2)
		{
		?>
		<td rowspan="2" align="center" valign="center"><?php echo "RK Tanggal $tampil ";?></td>
		<td colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tampil";?></td>
		<?php
		}
		else
		{
		?>
		<td rowspan="2" align="center" valign="center"><?php echo "RK Total $tanggal1 dan $tanggal2 ";?></td>
		<td colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tanggal1 dan $tanggal2";?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee non Admin</td>
		<td align="center" valign="center">Admin Jastel</td>
		<td align="center" valign="center">Jumlah Jastel</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Fee Arindo</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Titipan</td>
		<td align="center" valign="center">Tagihan</td>
		
	</tr>

<?php
$i=1;
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	if ($i % 2 ==1)
	{
	echo "	<tr bgcolor='#e1e1e1'>";
	}
	else
	{
	echo "	<tr>";
	}
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampilamount =  $row['amount'];
$tampilfeenonadmin =  $row['feenonadmin'];
$tampiladminjastel =  $row['adminjastel'];
$tampilpenpln =  $row['penpln'];
$tampilfeepln =  $row['feepln'];
$tampilpenpdam =  $row['penpdam'];
$tampilfeepdam =  $row['feepdam'];
$tampilpenvoucher =  $row['penvoucher'];
$tampilfeevoucher =  $row['feevoucher'];
$tampiljumlah =  $row['jumlah'];
$tampiljumlahjastel =  $row['jumlahjastel'];
$rk =  $row['jumlah_rk'];
$selisih = $row['jumlah_rk'] - $row['jumlah'];
$tampilselisih =  $selisih;

	
	echo "

				<td align='center'>$i</td>
				<td>{$row['lokasi']}</td>
				<td align='right'>$tampilamount</td>
				<td align='right'>$tampilfeenonadmin</td>
				<td align='right'>$tampiladminjastel</td>
				<td align='right'>$tampiljumlahjastel</td>
				<td align='right'>$tampilpenpln</td>
				<td align='right'>$tampilfeepln</td>
				<td align='right'>$tampilpenpdam</td>
				<td align='right'>$tampilfeepdam</td>
				<td align='right'>$tampilpenvoucher</td>
				<td align='right'>$tampilfeevoucher</td>
				<td align='right'></td>
				<td align='right'></td>
				<td align='right'>$tampiljumlah</td>
				<td align='right'>$rk</td>
					
				
			";

			if ($selisih >= 0)
			{
				echo "<td align='right'>$tampilselisih</td>
				<td align='right'>0</td>";
				$jumlahselisihpositif = $jumlahselisihpositif + $selisih;
			}
			else
			{
				$pecah = explode('-', $tampilselisih);
				echo "<td align='right'>0</td>
				<td align='right'>($pecah[1])</td>";
				$jumlahselisihnegatif = $jumlahselisihnegatif + $selisih;
			}
			echo "</tr>";
			
$i++;
}
?>
	<tr  bgcolor='#e1e1e1'>
		
<?php
if ($tanggal1==$tanggal2)
{

$sql2 = "Select sum(A.amount) as jum1,sum(A.feenonadmin)as jum2,sum(A.adminjastel)as jum3,sum(B.penpln)as jum4,sum(B.feepln)as jum5,sum(C.penpdam)as jum6,sum(C.feepdam)as jum7,sum(D.penvoucher)as jum8,sum(D.feevoucher)as jum9, sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as jumlah, sum(E.jumlah10) as jumlah_rk, sum(E.jumlah10)-sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as selisih
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi, sum(sopp.amount) as amount,sopp.tanggal as tanggal, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket,pdam.tanggal as tanggal, sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket,voucher.tanggal as tanggal, sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.jumlah as jumlah10, rk_input.tanggal as tanggal from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi  group by lokasi.loket) as E on (D.loket=E.loket)
where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL) AND (E.tanggal='$tanggal1' OR E.tanggal is NULL)";
}
else
{
$sql2 = "Select sum(A.amount) as jum1,sum(A.feenonadmin)as jum2,sum(A.adminjastel)as jum3,sum(B.penpln)as jum4,sum(B.feepln)as jum5,sum(C.penpdam)as jum6,sum(C.feepdam)as jum7,sum(D.penvoucher)as jum8,sum(D.feevoucher)as jum9, sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as jumlah, sum(E.jumlah10) as jumlah_rk, sum(E.jumlah10)-sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as selisih
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi, sum(sopp.amount) as amount,sopp.tanggal as tanggal, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket,pdam.tanggal as tanggal, sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket,voucher.tanggal as tanggal, sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.jumlah as jumlah10, rk_input.tanggal as tanggal from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi  group by lokasi.loket) as E on (D.loket=E.loket)
where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL)";
}
$ambildata2 = mysql_query( $sql2, $koneksi);
while($row2 = mysql_fetch_array($ambildata2, MYSQL_ASSOC))
{


$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampiljum1 =  $row2['jum1'];
$tampiljum2 =  $row2['jum2'];
$tampiljum3 =  $row2['jum3'];
$tampiljum4 =  $row2['jum4'];
$tampiljum5 =  $row2['jum5'];
$tampiljum6 =  $row2['jum6'];
$tampiljum7 =  $row2['jum7'];
$tampiljum8 =  $row2['jum8'];
$tampiljum9 =  $row2['jum9'];
$tampiljumlah =  $row2['jumlah'];
$tampiljumlahrk =  $row2['jumlah_rk'];
$selisih =  $row2['selisih'];
$positif =  $jumlahselisihpositif;
$negatif =  $jumlahselisihnegatif;
	
$pecah = explode('-', $negatif);
				

	echo "	
				<td colspan='2' align='center'>Total</td>
				<td align='right'>$tampiljum1</td>
				<td align='right'>$tampiljum2</td>
				<td align='right'>$tampiljum3</td>
				<td align='right'></td>
				<td align='right'>$tampiljum4</td>
				<td align='right'>$tampiljum5</td>
				<td align='right'>$tampiljum6</td>
				<td align='right'>$tampiljum7</td>
				<td align='right'>$tampiljum8</td>
				<td align='right'>$tampiljum9</td>
				
				<td align='right'></td>
				<td align='right'></td>
				<td align='right'>$tampiljumlah</td>
				<td align='right'>$tampiljumlahrk</td>
				<td align='right'>$positif</td>
				<td align='right'>($pecah[1])</td>
			";
			
}
*/


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
if ($tanggal1==$tanggal2)
{
	$sql = "Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.bagi,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.bagi is NULL then '0' else B.bagi end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk,F.arindo_pen, B.bill
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal,  sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sum(sopp.trx)*1650 when lokasi.loket='lembong2' then sum(sopp.trx)*1650 when lokasi.loket='lembong3' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi2' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi2' then sum(sopp.trx)*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal='$tampil_date' group by lokasi.tempat) as A 
left join 


(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi from lokasi left join pln on lokasi.loket=pln.loket AND tanggal='$tampil_date'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(select lokasi.lokasi as pdlokasi,lokasi.tempat as tempat, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg)- (pdam.trx*sum((case when pdam.fee_admin/pdam.bill=2800 then 800 when pdam.fee_admin/pdam.bill=2000 then 1000 when pdam.fee_admin/pdam.bill=2500 then 1500 END))) as penpdam, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1500 end) as feepdam from lokasi left join pdam on lokasi.loket = pdam.loket and pdam.tanggal = '$tampil_date' or pdam.tanggal is NULL  group by lokasi.tempat) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal='$tampil_date'  group by lokasi.tempat) as D on (C.tempat=D.tempat)
left join
(Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND tanggal='$tampil_date'  group by lokasi.tempat) as E on (D.tempat=E.tempat)
left join
(Select arindo_tempat.tempat as tempat, arindo_trx.tanggal as tanggal, sum(arindo_trx.total_trx) as arindo_pen from arindo_tempat left join arindo_trx on arindo_tempat.kode_user = arindo_trx.kode_user AND tanggal='$tampil_date'  group by arindo_tempat.tempat) as F on (E.tempat=F.tempat)
";

$pecah = explode('-', $tanggal1);

if (($pecah[0]==31 && $pecah[1]==1) || ($pecah[0]==31 && $pecah[1]==3) || ($pecah[0]==30 && $pecah[1]==4) || ($pecah[0]==31 && $pecah[1]==5) || ($pecah[0]==30 && $pecah[1]==6) || ($pecah[0]==31 && $pecah[1]==7) || ($pecah[0]==31 && $pecah[1]==8) || ($pecah[0]==30 && $pecah[1]==9) || ($pecah[0]==31 && $pecah[1]==10) || ($pecah[0]==30 && $pecah[1]==11))
{
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==29 && $pecah[1]==2 && $pecah[2]%4==0)) {
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==28 && $pecah[1]==2 && $pecah[2]%4<>0))
{
	$pecah[0]=0;
	$pecah[1]=$pecah[1]+1;
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}
else if (($pecah[0]==31 && $pecah[1]==12))
{
	$pecah[0]=0;
	$pecah[1]=0;
	$pecah[0]=$pecah[0]+1;
	$pecah[1]=$pecah[1]+1;
	$pecah[2]=$pecah[2]+1;
	$tampil = implode("-", $pecah);
}
else 
{
	$pecah[0]=$pecah[0]+1;
	$tampil = implode("-", $pecah);
}








}
else {
$sql = "Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.bagi,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.bagi is NULL then '0' else B.bagi end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk,F.arindo_pen, B.bill
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal,  sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sum(sopp.trx)*1650 when lokasi.loket='lembong2' then sum(sopp.trx)*1650 when lokasi.loket='lembong3' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi2' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi2' then sum(sopp.trx)*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND  (tanggal between '$tampil_date' AND '$tampil_date2') group by lokasi.tempat) as A 
left join 
(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi from lokasi left join pln on lokasi.loket=pln.loket AND  (tanggal between '$tampil_date' AND '$tampil_date2')  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(select lokasi.lokasi as pdlokasi,lokasi.tempat as tempat, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg)- (pdam.trx*sum((case when pdam.fee_admin/pdam.bill=2800 then 800 when pdam.fee_admin/pdam.bill=2000 then 1000 when pdam.fee_admin/pdam.bill=2500 then 1500 END))) as penpdam, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1500 end) as feepdam from lokasi left join pdam on lokasi.loket = pdam.loket and (tanggal between '$tampil_date' AND '$tampil_date2')  group by lokasi.tempat,fee_admin) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND (tanggal between '$tampil_date' AND '$tampil_date2')  group by lokasi.tempat) as D on (C.tempat=D.tempat)
left join
(Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND (tanggal between '$tampil_date' AND '$tampil_date2')  group by lokasi.tempat) as E on (D.tempat=E.tempat)
left join
(Select arindo_tempat.tempat as tempat, arindo_trx.tanggal as tanggal, sum(arindo_trx.total_trx) as arindo_pen from arindo_tempat left join arindo_trx on arindo_tempat.kode_user = arindo_trx.kode_user AND (tanggal between '$tampil_date' AND '$tampil_date2')  group by lokasi.tempat) as F on (E.tempat=F.tempat)";
 }
mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}






?>
<table border="1" class="table-responsive table-bordered table">
	<tr>
		<td rowspan="2">No</td>
		<td rowspan="2"> User/Loker SOPP</td>
		<td colspan="4" align="center" valign="center">Jastel</td>
		<td colspan="2" align="center" valign="center">PLN</td>
		<td colspan="2" align="center" valign="center">PDAM</td>
		<td colspan="2" align="center" valign="center">Voucher</td>
		<td colspan="2" align="center" valign="center">Transaksi Arindo</td>
		<td rowspan="2" align="center" valign="center">Total Transaksi</td>
		<?php
		if ($tanggal1 == $tanggal2)
		{
		?>
		<td rowspan="2" align="center" valign="center"><?php echo "RK Tanggal $tampil ";?></td>
		<td colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tampil";?></td>
		<?php
		}
		else
		{
		?>
		<td rowspan="2" align="center" valign="center"><?php echo "RK Total $tanggal1 dan $tanggal2 ";?></td>
		<td colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tanggal1 dan $tanggal2";?></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee non Admin</td>
		<td align="center" valign="center">Admin Jastel</td>
		<td align="center" valign="center">Jumlah Jastel</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Fee</td>
		<td align="center" valign="center">Fee Arindo</td>
		<td align="center" valign="center">Pendapatan</td>
		<td align="center" valign="center">Titipan</td>
		<td align="center" valign="center">Tagihan</td>
		
	</tr>

<?php
$i=1;
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	
	echo "	<tr>";
	




if ($row['bagi']==2500)
{
    $fee_mitra = 1700 * $row['bill'];
    $fee_finnet = 800 * $row['bill'];
}
else if ($row['bagi']==3000)
{
    $fee_mitra = 2000 * $row['bill'];
    $fee_finnet = 1000 * $row['bill'];
}
else if ($row['bagi']==5000)
{
    $fee_mitra = 3300 * $row['bill'];
    $fee_finnet = 1700 * $row['bill'];
}
else
{
    $fee_mitra=0;
    $fee_finnet = 0;
}
$hasil = $row['penpln']-$fee_mitra;
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampilamount =  number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeenonadmin =  number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladminjastel =  number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpln =  number_format($hasil, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepln =  number_format($fee_mitra, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpdam =  number_format($row['penpdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepdam =  number_format($row['feepdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenvoucher =  number_format($row['penvoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeevoucher =  number_format($row['feevoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


$tampiljumlahjastel =  number_format($row['jumlahjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindofee =  number_format($row['arindo_fee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindopen =  number_format($row['arindo_pen'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$total = $row['jumlahjastel'] + $row['penpln'] + $row['feepln'] + $row['penpdam'] + $row['feepdam'] + $row['penvoucher'] + $row['feevoucher'] + $row['arindo_fee'] + $row['arindo_pen'];
$tampiljumlah =  number_format($total, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$rk =  number_format($row['jumlah_rk'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$selisih = $row['jumlah_rk'] - $total;
$tampilselisih =  number_format($selisih, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


	
	echo "

				<td align='center'>$i</td>
				<td>{$row['tempat']}</td>
				<td align='right'>$tampilamount</td>
				<td align='right'>$tampilfeenonadmin</td>
				<td align='right'>$tampiladminjastel</td>
				<td align='right'>$tampiljumlahjastel</td>
				<td align='right'>$tampilpenpln</td>
				<td align='right'>$tampilfeepln</td>
				<td align='right'>$tampilpenpdam</td>
				<td align='right'>$tampilfeepdam</td>
				<td align='right'>$tampilpenvoucher</td>
				<td align='right'>$tampilfeevoucher</td>
				<td align='right'>
					$tampilarindofee
					</td>
				<td align='right'>
					$tampilarindopen
					
				</td>
				<td align='right'>$tampiljumlah</td>
				<td align='right'>$rk</td>
					
				
			";



$date3 = explode("-", $tampil);
$arr3 = array("$date3[2]","$date3[1]","$date3[0]");
$tampil_date3 = implode("-", $arr3);


			if ($selisih >= 0)
			{
				echo "<td align='right'>$tampilselisih</td>
				<td align='right'>0</td>";
				$jumlahselisihpositif = $jumlahselisihpositif + $selisih;


					if ($tanggal1==$tanggal2)
					{
					$cari = "select * from titipan where tanggal='$tampil_date' AND tempat='{$row[tempat]}'";
					$eksekusi = mysql_query($cari);
					$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

					if($data == null)
					{

						$insert = "INSERT INTO `kopeg`.`titipan` 
						(tanggal,tempat,titipan,talangan)
						VALUES ('$tampil_date', '$row[tempat]', $selisih,0)";
					}
					else
						{
							$insert = "UPDATE `kopeg`.`titipan` 
					set titipan=$selisih, $talangan=0, where tanggal='$tampil_date'";
						}
						$sql=mysqli_query($konek,$insert);
					}
			
			}
			else
			{
				$pecah = explode('-', $tampilselisih);
				echo "<td align='right'>0</td>
				<td align='right'>($pecah[1])</td>";
				$jumlahselisihnegatif = $jumlahselisihnegatif + $selisih;



				if ($tanggal1==$tanggal2)
					{
					$cari = "select * from titipan where tanggal='$tampil_date' AND tempat='{$row[tempat]}'";
					$eksekusi = mysql_query($cari);
					$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

					if($data == null)
					{

						$insert = "INSERT INTO `kopeg`.`titipan` 
						(tanggal,tempat,titipan,talangan)
						VALUES ('$tampil_date', '$row[tempat]', 0,$selisih)";
					}
					else
						{
							$insert = "UPDATE `kopeg`.`titipan` 
					set titipan=0, $talangan=$selisih, where tanggal='$tampil_date'";
						}
						$sql=mysqli_query($konek,$insert);
					}

			}
			echo "</tr>";

			$jumlah1 =  $jumlah1 + $row['amount'];
			$jumlah2 =  $jumlah2 + $row['feenonadmin'];
			$jumlah3 =  $jumlah3 + $row['adminjastel'];
			
			$jumlah5 =  $jumlah5 + $hasil;
			$jumlah6 =  $jumlah6 + $fee_mitra;
			$jumlah7 =  $jumlah7 + $row['penpdam'];
			$jumlah8 =  $jumlah8 + $row['feepdam'];
			$jumlah9 =  $jumlah9 + $row['penvoucher'];
			$jumlah10 =  $jumlah10 + $row['feevoucher'];
			//$jumlah11 = $jumlah11 + $row['jumlah'];
			$jumlah17 = $jumlah17 + $total;
			$jumlah12 =  $row['jumlah_rk'] + $jumlah12;
			/*
			if ($row['jumlah_rk'] - $jumlah17 > 0)
			{
			$jumlah13 = $jumlah13 + ($row['jumlah_rk'] - $jumlah17);
			}
			else
			{

			$jumlah14 = $jumlah14 + ($row['jumlah_rk'] - $jumlah17);
			}
			*/

			$jumlah15 = $jumlah15 + $row['arindo_fee'];
			$jumlah16 = $jumlah16 + $row['arindo_pen'];
			

			
$i++;
}
$jumlah4 =  $jumlah1+$jumlah3;
$tampil1 =  number_format($jumlah1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil2 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil3 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil4 =  number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil5 =  number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil6 =  number_format($jumlah6, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil7 =  number_format($jumlah7, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil8 =  number_format($jumlah8, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil9 =  number_format($jumlah9, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil10 =  number_format($jumlah10, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil11 =  number_format($jumlah11, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil12 =  number_format($jumlah12, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil13 =  number_format($jumlah13, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil14 =  number_format($jumlah14, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil15 =  number_format($jumlah15, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil16 =  number_format($jumlah16, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil17 =  number_format($jumlah17, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


$tampil18 =  number_format($jumlahselisihpositif, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil19 =  number_format($jumlahselisihnegatif, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
?>
	<tr  bgcolor='#e1e1e1'>
		
<?php
/*
if ($tanggal1==$tanggal2)
{

$sql2 = "Select sum(A.amount) as jum1,sum(A.feenonadmin)as jum2,sum(A.adminjastel)as jum3,sum(B.penpln)as jum4,sum(B.feepln)as jum5,sum(C.penpdam)as jum6,sum(C.feepdam)as jum7,sum(D.penvoucher)as jum8,sum(D.feevoucher)as jum9, sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as jumlah, sum(E.jumlah10) as jumlah_rk, sum(E.jumlah10)-sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as selisih
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi, sum(sopp.amount) as amount,sopp.tanggal as tanggal, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket,pdam.tanggal as tanggal, sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket,voucher.tanggal as tanggal, sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.jumlah as jumlah10, rk_input.tanggal as tanggal from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi  group by lokasi.loket) as E on (D.loket=E.loket)
where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL) AND (E.tanggal='$tanggal1' OR E.tanggal is NULL)";
}
else
{
$sql2 = "Select sum(A.amount) as jum1,sum(A.feenonadmin)as jum2,sum(A.adminjastel)as jum3,sum(B.penpln)as jum4,sum(B.feepln)as jum5,sum(C.penpdam)as jum6,sum(C.feepdam)as jum7,sum(D.penvoucher)as jum8,sum(D.feevoucher)as jum9, sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as jumlah, sum(E.jumlah10) as jumlah_rk, sum(E.jumlah10)-sum(((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end)  + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )) as selisih
from 
(SELECT lokasi.loket as loket,lokasi.lokasi as lokasi, sum(sopp.amount) as amount,sopp.tanggal as tanggal, CASE when lokasi.loket='lembong1' then sopp.trx*1650 when lokasi.loket='lembong2' then sopp.trx*1650 when lokasi.loket='lembong3' then sopp.trx*1650 when lokasi.loket='setiabudhi1' then sopp.trx*1650 when lokasi.loket='setiabudhi2' then sopp.trx*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user group by lokasi.loket) as A 
inner join 
(SELECT lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket group by lokasi.loket ) as B on (A.loket=B.loket) 
inner join
(SELECT lokasi.loket,pdam.tanggal as tanggal, sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket group by lokasi.loket) as C on (B.loket=C.loket)
inner join
(SELECT lokasi.loket,voucher.tanggal as tanggal, sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user group by lokasi.loket) as D on (C.loket=D.loket)
inner join
(Select lokasi.loket, rk_input.jumlah as jumlah10, rk_input.tanggal as tanggal from lokasi left join rk_input on lokasi.lokasi = rk_input.lokasi  group by lokasi.loket) as E on (D.loket=E.loket)
where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL)";
}
$ambildata2 = mysql_query( $sql2, $koneksi);
while($row2 = mysql_fetch_array($ambildata2, MYSQL_ASSOC))
{


$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampiljum1 =  number_format($row2['jum1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum2 =  number_format($row2['jum2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum3 =  number_format($row2['jum3'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum4 =  number_format($row2['jum4'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum5 =  number_format($row2['jum5'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum6 =  number_format($row2['jum6'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum7 =  number_format($row2['jum7'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum8 =  number_format($row2['jum8'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljum9 =  number_format($row2['jum9'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah =  number_format($row2['jumlah'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlahrk =  number_format($row2['jumlah_rk'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$selisih =  number_format($row2['selisih'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$positif =  number_format($jumlahselisihpositif, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$negatif =  number_format($jumlahselisihnegatif, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	
$pecah = explode('-', $negatif);
				

	echo "	
				<td colspan='2' align='center'>Total</td>
				<td align='right'>$tampiljum1</td>
				<td align='right'>$tampiljum2</td>
				<td align='right'>$tampiljum3</td>
				<td align='right'></td>
				<td align='right'>$tampiljum4</td>
				<td align='right'>$tampiljum5</td>
				<td align='right'>$tampiljum6</td>
				<td align='right'>$tampiljum7</td>
				<td align='right'>$tampiljum8</td>
				<td align='right'>$tampiljum9</td>
				
				<td align='right'></td>
				<td align='right'></td>
				<td align='right'>$tampiljumlah</td>
				<td align='right'>$tampiljumlahrk</td>
				<td align='right'>$positif</td>
				<td align='right'>($pecah[1])</td>
			";
}
*/
$pecah = explode('-', $tampil19);

echo "	
				<td colspan='2' align='center'>Total</td>
				<td align='right'>$tampil1</td>
				<td align='right'>$tampil2</td>
				<td align='right'>$tampil3</td>
				<td align='right'>$tampil4</td>
				<td align='right'>$tampil5</td>
				<td align='right'>$tampil6</td>
				<td align='right'>$tampil7</td>
				<td align='right'>$tampil8</td>
				<td align='right'>$tampil9</td>
				<td align='right'>$tampil10</td>
				
				<td align='right'>$tampil15</td>
				<td align='right'>$tampil16</td>
				<td align='right'>$tampil17</td>
				<td align='right'>$tampil12</td>
				<td align='right'>$tampil18</td>
				<td align='right'>($pecah[1])</td>
			";


?>
	</tr>
</table></font>


<table>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td colspan="2">Bandung, ....................</td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td colspan="2">Yang Menyerahkan</td><td></td><td></td><td></td><td>Yang Membuat</td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td colspan="2"><u>RIYADI DERAJAT</u></td><td></td><td></td><td></td><td>Mira Dewi K</td></tr>
            <tr><td colspan="2">Manager Jastel & SDM</td></tr>
            </table>  

