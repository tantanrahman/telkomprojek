
					
<?php
$tanggal1 = $_POST['nilai'];
$tanggal2 = $_POST['nilai2'];
$date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
//header("Content-type: application/msword");

 
// Defines the name of the export file "codelution-export.xls"

header("Content-Disposition: attachment; filename=Surat-permohonan-$tanggal1.xls");
?>


<?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}


	$sql = "Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.bagi,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.bagi is NULL then '0' else B.bagi end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk,F.arindo_pen, B.bill,B.hasil,B.hasil2,G.fee_indovision,G.pen_indovision
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal,  sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then 0 when lokasi.loket='lembong2' then 0 when lokasi.loket='lembong3' then 0  END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal between '$tampil_date' and '$tampil_date2' group by lokasi.tempat) as A 
left join 


(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi, sum(pln.total_kopeg)-sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil, sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil2 from lokasi left join pln on lokasi.loket=pln.loket AND  tanggal between '$tampil_date' and '$tampil_date2'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(select lokasi.lokasi as pdlokasi,lokasi.tempat as tempat, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg)- (pdam.trx*sum((case when pdam.fee_admin/pdam.bill=2800 then 800 when pdam.fee_admin/pdam.bill=2000 then 1000 when pdam.fee_admin/pdam.bill=2500 then 1000 END))) as penpdam, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1000 end) as feepdam from lokasi left join pdam on lokasi.loket = pdam.loket AND 
	((tanggal between '$tampil_date' and '$tampil_date2') or tanggal is NULL)  group by lokasi.tempat) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal between '$tampil_date' and '$tampil_date2'  group by lokasi.tempat) as D on (C.tempat=D.tempat)
left join
(Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND tanggal between '$tampil_date' and '$tampil_date2'  group by lokasi.tempat) as E on (D.tempat=E.tempat)
left join
(Select arindo_tempat.tempat as tempat, arindo_trx.tanggal as tanggal, sum(arindo_trx.total_trx) as arindo_pen from arindo_tempat left join arindo_trx on arindo_tempat.kode_user = arindo_trx.kode_user AND tanggal between '$tampil_date' and '$tampil_date2'  group by arindo_tempat.tempat) as F on (E.tempat=F.tempat)
left join
(SELECT lokasi.tempat as tempat, sum(indovision.fee_finnet) as fee_indovision, sum(indovision.kewajiban) as pen_indovision from lokasi left join indovision on lokasi.loket=indovision.loket AND tanggal between '$tampil_date' and '$tampil_date2' group by lokasi.tempat) AS G on (F.tempat=G.tempat)
";


mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}


?>

<style type="text/css">
table {
font-size:11px;
}
</style>
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
$hasil = $row['hasil'];
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampilamount =  number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeenonadmin =  number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladminjastel =  number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpln =  number_format($row['hasil'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepln =  number_format($row['hasil2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpdam =  number_format($row['penpdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepdam =  number_format($row['feepdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenvoucher =  number_format($row['penvoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeevoucher =  number_format($row['feevoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


$tampiljumlahjastel =  number_format($row['jumlahjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindofee =  number_format(0, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindopen =  number_format($row['arindo_pen'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$total = $row['amount'] + $row['feenonadmin'] +$row['adminjastel'] + $row['hasil'] + $row['hasil2'] + $row['penpdam'] + $row['feepdam'] + $row['penvoucher'] + $row['feevoucher'] + $row['arindo_fee'] + $row['arindo_pen'];
$tampiljumlah =  number_format($total, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$rk =  number_format($row['jumlah_rk'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$selisih = $row['jumlah_rk'] - $total;
$tampilselisih =  number_format($selisih, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	
	
			$jumlahpenindovision = $jumlahpenindovision + $row['pen_indovision'];
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

$carikonpensasi = "Select sum(voucher_arindo+pln_arindo+pdam_arindo+adira_arindo+baf_arindo+fif_arindo+wom_arindo+indovision_arindo+toptv_arindo+bigtv_arindo+adiratv_arindo+bpjs_arindo) as konpensasi_arindo, sum(pln_finnet+pdam_finnet) as konpensasi_pln_pdam, sum(sopp_finnet+voucher_finnet+fee_akses+adira_finnet+baf_finnet+fif_finnet+wom_finnet+indovision_finnet+toptv_finnet+bigtv_finnet+adiratv_finnet+bpjs_finnet) as jumlahfinnet from konpensasi where tanggal_konpensasi between '$tampil_date' AND '$tampil_date2'";

$eksekusikonpensasi = mysql_query($carikonpensasi,$koneksi);
while ($konpensasi = mysql_fetch_array($eksekusikonpensasi,MYSQL_ASSOC))
{
	$konpensasi_arindo = $konpensasi['konpensasi_arindo'];
	$konpensasi_pln_pdam = $konpensasi['konpensasi_pln_pdam'];
	$jumlahfinnet = $konpensasi['jumlahfinnet'];
}


$koneksi = mysqli_connect('localhost','root','','kopeg');
$cari = "select sum(fee_akses) as fee_akses from fee_akses where tanggal between '$tampil_date' and '$tampil_date2'";
						$eksekusi = mysql_query($cari);
						
$row=mysql_fetch_array($eksekusi,MYSQL_ASSOC);


$total1= $jumlah1 +  $jumlah9 + $row['fee_akses'] + $jumlahpenindovision + $jumlahfinnet;
$total2= $jumlah5  +$jumlah7 + $konpensasi_pln_pdam;




$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$query=mysql_query("select A.lokasi,B.rpfee,B.rpppn,B.rpfeeakses,B.rptitipan,B.rpadmin,C.pdfee,D.bagi from 
(select lokasi.lokasi as lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user and (tanggal ='$tampil_date' or tanggal is null) group by lokasi.lokasi) as A 
left join
(select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user and ((tanggal between '$tampil_date' and '$tampil_date2') or tanggal is null)   group by sopp.user) as B 
on A.lokasi = B.rplokasi
Left join
(select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1500 end) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where ( pdam.tanggal between '$tampil_date' and '$tampil_date2') or pdam.tanggal is NULL group by lokasi.lokasi) as C 
on B.rplokasi=C.pdlokasi
Left join
(select lokasi.lokasi, sum(pln.bill) as bill, case when ceiling(pln.fee_admin/pln.bill)=2500 then sum(pln.bill)*1700 when ceiling(pln.fee_admin/pln.bill)=3000 then sum(pln.bill)*2000 when ceiling(pln.fee_admin/pln.bill)=5000 then sum(pln.bill)*3300 END as bagi from lokasi left join pln on lokasi.loket=pln.loket where (( pln.tanggal between '$tampil_date' and '$tampil_date2') or pln.tanggal is NULL)  group by lokasi.lokasi) as D
on C.pdlokasi=D.lokasi


");
while($row=mysql_fetch_array($query)){

if ($row['lokasi']=="SETIABUDI 1" || $row['lokasi']=="SETIABUDI 2" ||$row['lokasi']=="SETIABUDHI 1" || $row['lokasi']=="SETIABUDHI 2" || $row['lokasi']=="LEMBONG 1" || $row['lokasi']=="LEMBONG 2" || $row['lokasi']=="LEMBONG 3") 
	                            {
	                            	$row['rpfee']=0;
	                            	$row['rpppn']=0;
	                            	$row['rpfeeakses']=0;
	                            	$row['rptitipan']=0;
	                            	$row['rpadmin']=0;
	                            }

}	                            

$cari = mysql_query("select sum(total_trx) as jumlah_ariindo from arindo_trx where  tanggal between '$tampil_date' and '$tampil_date2'");
$data = mysql_fetch_array($cari,MYSQL_ASSOC);



$tampiljumlah1 =  number_format($jumlah1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah9 =  number_format($jumlah9, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$tampiljumlah5 =  number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah16 =  number_format($jumlah16, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$tampil1 =  number_format($total1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil2 =  number_format($total2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil3 =  number_format($data['jumlah_ariindo']+$konpensasi_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang1 = $moneyFormat->terbilang($total1);
$terbilang2 = $moneyFormat->terbilang($total2);
$terbilang3 = $moneyFormat->terbilang($data['jumlah_ariindo']+$konpensasi_arindo);

$tgl=date('d')+1;
$no_bulan=date('m');
$tahun = date('Y');
//tanggal +1 dari surat
switch ($no_bulan) {
		case '1':
		$bulan = "Januari";
		$ar = "I";
		break;
		case '2':
		$bulan = "Februari";
		$ar = "II";
		break;
		case '3':
		$bulan = "Maret";
		$ar = "III";
		break;
		case '4':
		$bulan = "April";
		$ar = "IV";
		break;
		case '5':
		$bulan = "Mei";
		$ar = "V";
		break;
		case '6':
		$bulan = "Juni";
		$ar = "VI";
		break;
		case '7':
		$bulan = "Juli";
		$ar = "VII";
		break;
		case '8':
		$bulan = "Agustus";
		$ar = "VIII";
		break;
		case '9':
		$bulan = "September";
		$ar = "IX";
		break;
		case '10':
		$bulan = "Oktober";
		$ar = "X";
		break;
		case '11':
		$bulan = "November";
		$ar = "XI";
		break;
		case '12':
		$bulan = "Desember";
		$ar = "XII";
		break;
	
}
?>




<table  style="border-collapse:collapse;  width:297mm; ">
<tr  style="border-collapse:collapse;  width:297mm; "><td  style="border-collapse:collapse;  width:297mm; ">
<table >
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr>
		<td colspan="2">Nomor : &nbsp;&nbsp;&nbsp;&nbsp;/KOPEGTEL/<?php echo "&nbsp;&nbsp;&nbsp;/$tahun"; ?></td><td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="2">Bandung : </td><td></td>

	</tr>
	</table>
	<table border="">
			
	<tr>
		<td>Kepada,</td>
	</tr>
	
	<tr>
		<td colspan="4">Yth.Pimpinan BANK BNI 46</td>
	</tr>	
	<tr>
		<td colspan="2">Cab. Asia Afrika</td>
	</tr>	
	<tr>
		<td colspan="2"><u>BANDUNG</u></td>
	</tr>
	</table>
	<table>
	<tr><td></td></tr>
	

	<tr>
		<td colspan="2">Perihal : Permohonan Transfer</td>
	</tr>
	</table>
	<table >
	<tr><td></td></tr>
	<tr>
		
		<td align="left" valign="center">1.</td>
		
		
		<td colspan="2">Diinformasikan bahwa <b>KOPERASI JASA DADALI BANDUNG, memiliki rekening Giro</b> pada <b>BANK BNI 46 cab Asia Afrika Bandung.</b></td>
	</tr>
	<tr><td></td></tr>
	<tr>
		
		<td align="left" valign="center">2.</td>
		
		
		<td colspan="2">Sehubungan dengan hal tersebut di atas, dengan ini mohon untuk melakukan <b>Transfer ke atas nama PT FINNET INDONESIA</b> dengan no</td>
	</tr>
	<tr>
		<td align="right">a.</td>
		<td><b>Virtual Account <td colspan="">: 988 000 271 069 528 3</b></td>
	</tr>
	<tr>
		<td></td>
		
		<td></td>
		<td colspan="3"> atas transaksi JASTEL, Voucher TELKOM GROUP dan Fee Akses</td>
	</tr>	
	
	<tr><td></td><td></td><td colspan="1"><i>Sebesar : Rp <?php echo "$tampil1"; ?></i></td></tr>
	<tr><td></td><td colspan="3">Terbilang : <?php  echo "$terbilang1"; ?> Rupiah</td></tr>
	<tr><td></td></tr>
	
	<tr>
		<td align="right">b.</td>
		<td width="125px"><b>Virtual Account </b></td><td colspan="1">: 988 000 282 031 503 3</td>
	</tr>
	<tr>
		<td></td>
		
		<td></td>
		<td colspan="3"> atas transaksi SOPP PLN dan PDAM</td>
	</tr>	
	
	<tr><td></td><td></td><td colspan="1"><i>Sebesar : Rp <?php echo "$tampil2";?></i></td></tr>
	<tr><td></td><td colspan="3">Terbilang : <?php  echo "$terbilang2"; ?> Rupiah</td></tr>
</table>
</table>
	<table>
	<tr><td></td></tr>
	<tr>
		
		<td align="left">3.</td><td colspan="2"> Dan Mohon Untuk Melakukan Transfer ke atas nama PT ARINDO PRATAMA dengan No</td>
	</tr>
	<tr>
	<td></td>
		<td>a. Virtual Account </td><td>: 4994994954</td>
	</tr>
	<tr>
		<td></td><td></td><td> atas Transaksi KOPEGTEL DADALI 185</td>
	</tr>
	<tr><td></td><td></td><td colspan="1"><i>Sebesar : Rp <?php echo "$tampil3";?></i></td></tr>
	<tr><td></td><td colspan="3">Terbilang : <?php  echo "$terbilang3"; ?> Rupiah</td></tr>
	<tr><td></td></tr>
	<tr><td></td><td colspan="2">dari rekening nomor a/c 244.692.71 atas nama <b>KOPERASI JASA DADALI BANDUNG</b></td></tr>	
	<tr><td></td></tr>
		
		<tr>
		<td colspan="3">Demikian disampaikan, atas kerjasamanya diucapkan terima kasih..</b></td>
	</tr>
	<tr>
		<td></td>
		<td>A.n PENGURUS KOPERASI JASA DADALI BANDUNG</td>
	</tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	
	</table>

<table>
	<tr>
		<td></td>
		<td>.....................................</td>
	</tr>
<tr>
		<td></td>
		<td>GENERAL MANAGER</td>
	</tr>
	<tr><td colspan="2">Tembusan :</td></tr>
	<tr><td></td><td>1. Arsip</td></tr>
</table>
</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</td></tr></table>