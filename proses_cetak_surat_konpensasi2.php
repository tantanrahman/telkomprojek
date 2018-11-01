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

header("Content-Disposition: attachment; filename=Rincian-Surat-permohonan-$tanggal1.xls");
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


(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi, sum(pln.total_kopeg)-sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil, sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil2 from lokasi left join pln on lokasi.loket=pln.loket AND tanggal between '$tampil_date' and '$tampil_date2'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(select lokasi.lokasi as pdlokasi,lokasi.tempat as tempat, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg)- (pdam.trx*sum((case when pdam.fee_admin/pdam.bill=2800 then 800 when pdam.fee_admin/pdam.bill=2000 then 1000 when pdam.fee_admin/pdam.bill=2500 then 1000 END))) as penpdam, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1000 end) as feepdam from lokasi left join pdam on lokasi.loket = pdam.loket and ((tanggal between '$tampil_date' and '$tampil_date2') or pdam.tanggal is NULL)  group by lokasi.tempat) as C on (B.tempat=C.tempat)
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



	
	

			$jumlah1 =  $jumlah1 + $row['amount'];
			$jumlah2 =  $jumlah2 + $row['feenonadmin'];
			$jumlah3 =  $jumlah3 + $row['adminjastel'];
			
			$jumlah5 =  $jumlah5 + $hasil;
			$jumlah6 =  $jumlah6 + $fee_mitra;
			$jumlah7 =  $jumlah7 + $row['penpdam'];
			$jumlah8 =  $jumlah8 + $row['feepdam'];
			$jumlah9 =  $jumlah9 + $row['penvoucher'];
			$jumlah10 =  $jumlah10 + $row['feevoucher'];
			$jumlahpenindovision =  $jumlahpenindovision + $row['pen_indovision'];
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

$carikonpensasi = "Select voucher_arindo,pln_arindo,pdam_arindo,adira_arindo,baf_arindo,fif_arindo,wom_arindo,indovision_arindo,toptv_arindo,bigtv_arindo,adiratv_arindo,bpjs_arindo, pln_finnet,pdam_finnet, sopp_finnet,voucher_finnet,fee_akses,adira_finnet,baf_finnet,fif_finnet,wom_finnet,indovision_finnet,toptv_finnet,bigtv_finnet,adiratv_finnet,bpjs_finnet from konpensasi where tanggal_konpensasi between '$tampil_date' AND '$tampil_date2'";

$eksekusikonpensasi = mysql_query($carikonpensasi,$koneksi);
while ($konpensasi = mysql_fetch_array($eksekusikonpensasi,MYSQL_ASSOC))
{
	$voucher_arindo = $konpensasi['voucher_arindo'];
	$pln_arindo = $konpensasi['pln_arindo'];
	$pdam_arindo = $konpensasi['pdam_arindo'];
	$adira_arindo = $konpensasi['adira_arindo'];
	$baf_arindo = $konpensasi['baf_arindo'];
	$fif_arindo = $konpensasi['fif_arindo'];
	$wom_arindo = $konpensasi['wom_arindo'];
	$indovision_arindo = $konpensasi['indovision_arindo'];
	$toptv_arindo = $konpensasi['toptv_arindo'];
	$bigtv_arindo = $konpensasi['bigtv_arindo'];
	$adiratv_arindo = $konpensasi['adiratv_arindo'];
	$bpjs_arindo = $konpensasi['bpjs_arindo'];

	

	$pln_finnet = $konpensasi['pln_finnet'];
	$pdam_finnet = $konpensasi['pdam_finnet'];
	$sopp_finnet = $konpensasi['sopp_finnet'];
	$voucher_finnet = $konpensasi['voucher_finnet'];
	$fee_akses = $konpensasi['fee_akses'];
	$adira_finnet = $konpensasi['adira_finnet'];
	$baf_finnet = $konpensasi['baf_finnet'];
	$fif_finnet = $konpensasi['fif_finnet'];
	$wom_finnet = $konpensasi['wom_finnet'];
	$indovision_finnet = $konpensasi['indovision_finnet'];
	$toptv_finnet = $konpensasi['toptv_finnet'];
	$bigtv_finnet = $konpensasi['bigtv_finnet'];
	$adiratv_finnet = $konpensasi['adiratv_finnet'];
	$bpjs_finnet = $konpensasi['bpjs_finnet'];
}


$koneksi = mysqli_connect('localhost','root','','kopeg');
$cari = "select sum(fee_akses) as fee_akses from fee_akses where tanggal between '$tampil_date' and '$tampil_date2'";
						$eksekusi = mysql_query($cari);
						
$row=mysql_fetch_array($eksekusi,MYSQL_ASSOC);
$tot = $row['fee_akses']+$fee_akses;

$cari2 = "select sum(pln_trx) as pln_trx,sum(telepon_trx) as telepon_trx,sum(indovision_trx) as indovision_trx,sum(halo_trx) as halo_trx,sum(pulsa_trx) as pulsa_trx,sum(pdam_trx) as pdam_trx,sum(adira_trx) as adira_trx,sum(baf_trx) as baf_trx,sum(fif_trx) as fif_trx,sum(bpjs_trx) as bpjs_trx, sum(plnp_trx) as plnp_trx, sum(wom_trx) as wom_trx,sum(total_trx) as total_trx from arindo_trx where tanggal between '$tampil_date' and '$tampil_date2'";
$eksekusi2 = mysql_query($cari2);
$row2=mysql_fetch_array($eksekusi2,MYSQL_ASSOC);

$tampilplnarindo = number_format($row2['pln_trx']+$row2['plnp_trx']+$pln_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpdamarindo = number_format($row2['pdam_trx']+$pdam_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilteleponarindo = number_format($row2['telepon_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilindovisionarindo = number_format($row2['indovision_trx']+$indovision_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilhaloarindo = number_format($row2['halo_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpulsaarindo = number_format($row2['pulsa_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladiraarindo = number_format($row2['adira_trx']+$adira_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilbafarindo = number_format($row2['baf_trx']+$baf_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfifarindo = number_format($row2['fif_trx']+$fif_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilbpjsarindo = number_format($row2['bpjs_trx']+$bpjs_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiltotalarindo = number_format($row2['total_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$tampilwomarindo = number_format($row2['wom_trx']+$wom_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$tampilvoucherarindo = number_format($row2['telepon_trx']+$row2['halo_trx']+$row2['pulsa_trx']+$voucher_arindo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


$total1= $jumlah1 +  $jumlah9 + $row['fee_akses']+$pln_finnet;
$total2= $jumlah5  +$jumlah7;


$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$jumlah9 = $jumlah9; 
$tampiljumlah1 =  number_format($jumlah1+$sopp_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah9 =  number_format($jumlah9+$voucher_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiltot =  number_format($tot+$fee_akses, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenindovision =  number_format($jumlahpenindovision+$indovision_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah5 =  number_format($jumlah5+$pln_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah16 =  number_format($jumlah16, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$tampil1 =  number_format($total1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil2 =  number_format($total2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$terbilang1 = $moneyFormat->terbilang($total1);
$terbilang2 = $moneyFormat->terbilang($total2);
?>




<br><br><br><br><br><br>
<table>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr><tr><td></td></tr>
<tr><td></td></tr>
<tr><td colspan="5">RINCIAN ATAS TRANSFER PENDAPATAN SOPP</td></tr>
<tr><td colspan="5">TGL <?php echo "$tanggal1";?></td></tr></table>
<table border="1">
	<tr>
		<td rowspan="2" align="center">NO</td>
		<td colspan="3">Transaksi</td>
		<td rowspan="2">Total</td>
	</tr>
	<tr>
		<td></td>
		<td>PT. FINNET</td>
		<td>PT. ARINDO</td>
		
	</tr>
	<tr>
		<td>1</td>
		<td>SOPP JASTEL</td>
		<td align="right">Rp <?php echo " $tampiljumlah1"; ?></td>
		<td align="right">Rp -</td>
		<td align="right"><?php echo "Rp $tampiljumlah1"; ?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Voucher</td>
		<td align="right"><?php echo "Rp $tampiljumlah9"; ?></td>
		<td align="right"><?php if ($tampilvoucherarindo==0) 
		{echo "Rp -";}
		else
		{
		echo "Rp $tampilvoucherarindo";} ?></td>
		<?php
		$jumlahvoucher = $jumlah9+  $row2['telepon_trx']+$row2['halo_trx']+$row2['pulsa_trx'];
		$tampilhasilvoucher =  number_format($jumlahvoucher, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo "Rp $tampilhasilvoucher"; ?></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Fee Akses</td>
		<td align="right"><?php echo "Rp $tampiltot"; ?></td>
		<td align="right">Rp -</td>
		<td align="right"><?php echo "Rp $tampiltot"; ?></td>
	</tr>
	<tr>
		<td>4</td>
		<td>PLN</td>
		<td align="right"><?php echo "Rp $tampiljumlah5"; ?></td>
		<td align="right"><?php 
		if ($tampilplnarindo==0)
		{echo "Rp -";}
	else { echo "Rp $tampilplnarindo"; } ?></td>
		<?php $hasilpln = $jumlah5  + $row2['pln_trx'] +$pln_finnet +$pdam_arindo;
		$tampilhasilpln =  number_format($hasilpln, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo "Rp $tampilhasilpln"; ?></td>
	</tr>
	<tr>
		<td>5</td>
		<td>PDAM</td>
		<?php
		$tampiljumlah7 =  number_format($jumlah7+$pdam_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		$jumlahpdam = $jumlah7+  $row2['pdam_trx'] +$pdam_finnet +$pdam_arindo;
		$tampilhasilpdam =  number_format($jumlahpdam, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo "Rp $tampiljumlah7"; ?></td>
		<td align="right"><?php 
		if ($tampilpdamarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilpdamarindo";} ?></td>
		<td align="right">Rp
		<?=$tampilhasilpdam
		
	 ?></td>
	</tr>
	<tr>
		<td>6</td>
		<td>ADIRA</td>
		<td align="right">Rp. - </td>
		<td align="right"><?php 
		if ($tampiladiraarindo==0)
		{echo "Rp -";}
	else{
		echo "Rp $tampiladiraarindo"; }?></td>
		<td align="right"><?php
if ($tampiladiraarindo==0)
		{echo "Rp -";}
	else{
		echo "Rp $tampiladiraarindo"; }?>
		</td>
	</tr>
	<tr>
		<td>7</td>
		<td>BAF</td>
		<td align="right">Rp. - </td>
		<td align="right"><?php 
		if ($tampilbafarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilbafarindo";} ?></td>
	<td align="right"><?php 
		if ($tampilbafarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilbafarindo";} ?></td>
		
	</tr>
	<tr>
		<td>8</td>
		<td>FIF</td>
		<td align="right">Rp. - </td>
		<td align="right"><?php 
		if ($tampilfifarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilfifarindo";} ?></td>
	<td align="right"><?php 
		if ($tampilfifarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilfifarindo";} ?></td>
		
	</tr>
	<tr>
		<td>9</td>
		<td>WOM</td>
		<td align="right">Rp. - </td>
		<td align="right"><?php 
		if ($tampilwomarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilwomarindo";} ?></td>
	<td align="right"><?php 
		if ($tampilwomarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilwomarindo";} ?></td>
	</tr>
	<tr>
		<td>10</td>
		<td>INDOVISION</td>
		<td align="right">Rp<?php if ($tampilpenindovision==0)
		{
			echo "Rp -";
		}
		else
		{
			echo "$tampilpenindovision";
		}
		 ?> </td>
		}
		}
		<td align="right"><?php 
		if ($tampilindovisionarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilindovisionarindo";} ?></td>
	<td align="right">Rp
	<?php 
		echo number_format($row2['indovision_trx']+$jumlahpenindovision, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?></td>
	</tr>
	<tr>
		<td>11</td>
		<td>TOPTV</td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
	</tr>
	<tr>
		<td>12</td>
		<td>BIGTV</td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
	</tr>
	<tr>
		<td>13</td>
		<td>ADIRATV</td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
		<td align="right">Rp. - </td>
	</tr>
	<tr>
		<td>14</td>
		<td>BPJS</td>
		<td align="right">Rp. - </td>
		<td align="right"><?php 
		if ($tampilbpjsarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilbpjsarindo";} ?></td>
	<td align="right"><?php 
		if ($tampilbpjsarindo==0)
		{
			echo "Rp -";
		}
		else

		{echo "Rp $tampilbpjsarindo";} ?></td>
	</tr>
	<tr>
		<td colspan="2">Total</td>
		<?php
		$akhir1 = $jumlah1 + $jumlah9 + $tot + $jumlah5 + $jumlah7 +$jumlahpenindovision +$sopp_finnet+$fee_akses+$voucher_finnet+$pln_finnet+$pdam_finnet+$indovision_finnet;
		$akhir2 = $jumlah16 + $voucher_arindo +$pdam_arindo+$pln_arindo+$indovision_arindo+$adira_arindo+$baf_arindo+$fif_arindo+$wom_arindo+$toptv_arindo+$bigtv_arindo+$adiratv_arindo+$bpjs_arindo;
		$akhir3 = $akhir1 +$akhir2;
		$tampilakhir1 =  number_format($akhir1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		$tampilakhir2 =  number_format($akhir2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		$tampilakhir3 =  number_format($akhir3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo "Rp $tampilakhir1"; ?></td>
		<td align="right"><?php echo "Rp $tampilakhir2"; ?></td>
		<td align="right"><?php echo "Rp $tampilakhir3"; ?></td>
	<tr>
</table>
<table>
	<tr>
		<td colspan=5>Bandung, ..................</td>
		</tr>
		<tr>
		<td colspan=5>an. PENGURUS KOPEGTEL KANDATEL BANDUNG</td>
	</tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
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
		<td>Manager JASTEL & SDM</td>
	</tr>
</table>