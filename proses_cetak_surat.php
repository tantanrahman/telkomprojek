				
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
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Surat-permohonan-$tanggal1.xls");

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


$sql = " Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel 
		FROM
		(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal,  sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then 0 when lokasi.loket='lembong2' then 0 when lokasi.loket='lembong3' then 0  END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal BETWEEN '$tampil_date' AND '$tampil_date2' group by lokasi.tempat) AS A";


$sql2 = "SELECT lokasi.tempat as tempat, lokasi.loket loket,pln.tanggal as tanggal, sum(pln.total_kopeg) as penpln,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi, sum(pln.total_kopeg)-sum(case when pln.fee_admin/pln.bill=2750 then 2000*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil, sum(case when pln.fee_admin/pln.bill=2750 then 2000*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil2 from lokasi left join pln on lokasi.loket=pln.loket  AND pln.tanggal BETWEEN '$tampil_date' AND '$tampil_date2'  group by lokasi.tempat";

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


while ($row = mysql_fetch_array($ambildata) AND $row2 = mysql_fetch_array($ambildata2) AND $row3 = mysql_fetch_array($ambildata3) AND $row4 = mysql_fetch_array($ambildata4) AND $row5 = mysql_fetch_array($ambildata5) AND $row6 = mysql_fetch_array($ambildata6) AND $row7 = mysql_fetch_array($ambildata7) AND $row8 = mysql_fetch_array($ambildata8) AND $row9 = mysql_fetch_array($ambildata9) AND $row10 = mysql_fetch_array($ambildata10) AND $row11 = mysql_fetch_array($ambildata11) AND $row12 = mysql_fetch_array($ambildata12) ) 
{	
	

$cari_konpensasipdam 		= "SELECT SUM(nominal) as nominal from  k_pdam 		 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasipln 		= "SELECT SUM(nominal) as nominal from  k_pln 		 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchertsel	= "SELECT SUM(nominal) as nominal from  k_voucher_tsel 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchertri	= "SELECT SUM(nominal) as nominal from  k_voucher_tri 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasivouchersmart= "SELECT SUM(nominal) as nominal from  k_voucher_smart where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasisopp 		= "SELECT SUM(nominal) as nominal from  k_sopp 		 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiindovision 	= "SELECT SUM(nominal) as nominal from  k_indovision 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiarindo 		= "SELECT SUM(nominal) as nominal from  k_arindo 	 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasiaoratv	 	= "SELECT SUM(nominal) as nominal from  k_aoratv	 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$cari_konpensasitransvision	= "SELECT SUM(nominal) as nominal from  k_transvision 	where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";

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


$carikonpensasipdam2 		= "SELECT SUM(nominal)*-1 as nominal from  k_pdam 		 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasipln2 		= "SELECT SUM(nominal)*-1 as nominal from  k_pln 		 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchertsel2	= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_tsel 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchertri2	= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_tri 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasivouchersmart2= "SELECT SUM(nominal)*-1 as nominal from  k_voucher_smart where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasisopp2 		= "SELECT SUM(nominal)*-1 as nominal from  k_sopp 		 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiindovision2 	= "SELECT SUM(nominal)*-1 as nominal from  k_indovision 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiarindo2 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo 	 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasiaoratv2	 	= "SELECT SUM(nominal)*-1 as nominal from  k_aoratv	 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$carikonpensasitransvision2	= "SELECT SUM(nominal)*-1 as nominal from  k_transvision 	where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";

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

	$jumlahamount = $jumlahamount + $row['amount']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'];
	$jumlahfeenonadmin = $jumlahfeenonadmin + $row['feenonadmin'];
	$jumlahadminjastel = $jumlahadminjastel + $row['adminjastel'];
	$jumlahjastel = $jumlahjastel + $row['amount']+ $hasilkonpensasisopp['nominal']+ $hasilkonpensasisopp2['nominal'];
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

$cari2 = "select sum(pln_trx) as pln_trx,sum(telepon_trx) as telepon_trx,sum(indovision_trx) as indovision_trx,sum(halo_trx) as halo_trx,sum(pulsa_trx) as pulsa_trx,sum(pdam_trx) as pdam_trx,sum(adira_trx) as adira_trx,sum(baf_trx) as baf_trx,sum(fif_trx) as fif_trx,sum(bpjs_trx) as bpjs_trx, sum(plnp_trx) as plnp_trx, sum(wom_trx) as wom_trx,sum(total_trx) as total_trx from arindo_trx where tanggal between '$tampil_date' and '$tampil_date2'";
$eksekusi2 = mysql_query($cari2);
$row2=mysql_fetch_array($eksekusi2,MYSQL_ASSOC);



$cariarindopln 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_pln where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindopln 	= mysql_query($cariarindopln,$koneksi);
$hasilarindopln		= mysql_fetch_array($eksekusiarindopln,	MYSQL_ASSOC);
$cariarindopln2 		= "SELECT SUM(nominal) as nominal from  k_arindo_pln where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindopln2 	= mysql_query($cariarindopln2,$koneksi);
$hasilarindopln2		= mysql_fetch_array($eksekusiarindopln2,	MYSQL_ASSOC);


$cariarindopdam 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_pdam where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindopdam 	= mysql_query($cariarindopdam,$koneksi);
$hasilarindopdam		= mysql_fetch_array($eksekusiarindopdam,	MYSQL_ASSOC);
$cariarindopdam2 		= "SELECT SUM(nominal) as nominal from  k_arindo_pdam where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindopdam2 	= mysql_query($cariarindopdam2,$koneksi);
$hasilarindopdam2		= mysql_fetch_array($eksekusiarindopdam2,	MYSQL_ASSOC);

$cariarindoindovision 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_indovision where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindoindovision 	= mysql_query($cariarindoindovision,$koneksi);
$hasilarindoindovision		= mysql_fetch_array($eksekusiarindoindovision,	MYSQL_ASSOC);
$cariarindoindovision2 		= "SELECT SUM(nominal) as nominal from  k_arindo_indovision where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindoindovision2 	= mysql_query($cariarindoindovision2,$koneksi);
$hasilarindoindovision2		= mysql_fetch_array($eksekusiarindoindovision2,	MYSQL_ASSOC);

$cariarindoadira 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_adira where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindoadira 	= mysql_query($cariarindoadira,$koneksi);
$hasilarindoadira		= mysql_fetch_array($eksekusiarindoadira,	MYSQL_ASSOC);
$cariarindoadira2 		= "SELECT SUM(nominal) as nominal from  k_arindo_adira where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindoadira2 	= mysql_query($cariarindoadira2,$koneksi);
$hasilarindoadira2		= mysql_fetch_array($eksekusiarindoadira2,	MYSQL_ASSOC);

$cariarindobaf 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_baf where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindobaf 	= mysql_query($cariarindobaf,$koneksi);
$hasilarindobaf		= mysql_fetch_array($eksekusiarindobaf,	MYSQL_ASSOC);
$cariarindobaf2 		= "SELECT SUM(nominal) as nominal from  k_arindo_baf where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindobaf2 	= mysql_query($cariarindobaf2,$koneksi);
$hasilarindobaf2		= mysql_fetch_array($eksekusiarindobaf2,	MYSQL_ASSOC);

$cariarindobpjs 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_bpjs where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindobpjs 	= mysql_query($cariarindobpjs,$koneksi);
$hasilarindobpjs		= mysql_fetch_array($eksekusiarindobpjs,	MYSQL_ASSOC);
$cariarindobpjs2 		= "SELECT SUM(nominal) as nominal from  k_arindo_bpjs where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindobpjs2 	= mysql_query($cariarindobpjs2,$koneksi);
$hasilarindobpjs2		= mysql_fetch_array($eksekusiarindobpjs2,	MYSQL_ASSOC);

$cariarindofif 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_fif where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindofif 	= mysql_query($cariarindofif,$koneksi);
$hasilarindofif		= mysql_fetch_array($eksekusiarindofif,	MYSQL_ASSOC);
$cariarindofif2 		= "SELECT SUM(nominal) as nominal from  k_arindo_fif where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindofif2 	= mysql_query($cariarindofif2,$koneksi);
$hasilarindofif2		= mysql_fetch_array($eksekusiarindofif2,	MYSQL_ASSOC);

$cariarindowom 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_wom where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindowom 	= mysql_query($cariarindowom,$koneksi);
$hasilarindowom		= mysql_fetch_array($eksekusiarindowom,	MYSQL_ASSOC);
$cariarindowom2 		= "SELECT SUM(nominal) as nominal from  k_arindo_wom where  tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindowom2 	= mysql_query($cariarindowom2,$koneksi);
$hasilarindowom2		= mysql_fetch_array($eksekusiarindowom2,	MYSQL_ASSOC);

$cariarindovoucher 		= "SELECT SUM(nominal)*-1 as nominal from  k_arindo_voucher where  tanggal_masalah BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindovoucher 	= mysql_query($cariarindovoucher,$koneksi);
$hasilarindovoucher		= mysql_fetch_array($eksekusiarindovoucher,	MYSQL_ASSOC);
$cariarindovoucher2 		= "SELECT SUM(nominal) as nominal from  k_arindo_voucher where tanggal_konpensasi BETWEEN '$tampil_date' and '$tampil_date2'";
$eksekusiarindovoucher2 	= mysql_query($cariarindovoucher2,$koneksi);
$hasilarindovoucher2		= mysql_fetch_array($eksekusiarindovoucher2,	MYSQL_ASSOC);

$arindotelepon		= $row2['telepon_trx'] ;
$arindopulsa 		= $row2['halo_trx']+$row2['pulsa_trx'] + $hasilarindovoucher['nominal'] + $hasilarindovoucher2['nominal'];
$arindopln   		= $row2['pln_trx']+$row2['plnp_trx'] + $hasilarindopln2['nominal'] + $hasilarindopln['nominal'];
$arindopdam 		= $row2['pdam_trx']+ $hasilarindopdam['nominal'] + $hasilarindopdam2['nominal'];
$arindoindovision 	= $row2['indovision_trx']+$hasilarindoindovision['nominal'] + $hasilarindoindovision2['nominal'];
$arindoadira		= $row2['adira_trx']+$hasilarindoadira['nominal'] + $hasilarindoadira2['nominal'];
$arindobaf			= $row2['baf_trx']+$hasilarindobaf['nominal'] + $hasilarindobaf2['nominal'];
$arindobpjs			= $row2['bpjs_trx']+$hasilarindobpjs['nominal'] + $hasilarindobpjs2['nominal'];
$arindofif			= $row2['fif_trx']+$hasilarindofif['nominal'] + $hasilarindofif2['nominal'];
$arindowom			= $row2['wom_trx']+$hasilarindowom['nominal'] + $hasilarindowom2['nominal'];
$jumlaharindo 		= $row2['total_trx']+ $hasilarindovoucher['nominal'] + $hasilarindovoucher2['nominal']+ $hasilarindopln2['nominal'] + $hasilarindopln['nominal']+ $hasilarindopdam['nominal'] + $hasilarindopdam2['nominal']+$hasilarindoindovision['nominal'] + $hasilarindoindovision2['nominal']+$hasilarindoadira['nominal'] + $hasilarindoadira2['nominal']+$hasilarindobaf['nominal'] + $hasilarindobaf2['nominal']+$hasilarindobpjs['nominal'] + $hasilarindobpjs2['nominal']+$hasilarindofif['nominal'] + $hasilarindofif2['nominal']+$hasilarindowom['nominal'] + $hasilarindowom2['nominal'];


$koneksi = mysqli_connect('localhost','root','','kopeg');
$cari = "select sum(fee_akses) as fee_akses from fee_akses where tanggal between '$tampil_date' and '$tampil_date2'";
$eksekusi = mysql_query($cari);
$row=mysql_fetch_array($eksekusi,MYSQL_ASSOC);
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

$total1 = $jumlahjastel +$totalpenvoucher + $jumlahpentransvision + $jumlahpenindovision + $jumlahpenaora + $row['fee_akses'];
$total2 = $jumlahpenpdam + $jumlahpenpln ;
$total3 = $jumlaharindo;

require ('moneyFormat.php');
$moneyFormat = new moneyFormat();

$tampil1 = number_format($total1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil2 = number_format($total2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampil3 = number_format($total3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


$terbilang1 = $moneyFormat->terbilang($total1);
$terbilang2 = $moneyFormat->terbilang($total2);
$terbilang3 = $moneyFormat->terbilang($total3);

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
	<tr>
		<td colspan="2">Nomor : &nbsp;&nbsp;&nbsp;&nbsp;/DADALI/<?php echo "&nbsp;&nbsp;&nbsp;/$tahun"; ?></td><td colspan="1"></td>
	</tr>
	<tr>
		<td colspan="2">Bandung : </td><td></td>

	</tr>
	</table>
	<table border="">
	<tr></tr>		
	<tr>
		<td>Kepada,</td>
	</tr>
	
	<tr>
		<td colspan="3">Yth.Pimpinan BANK BNI 46</td>
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
		
		<td  style="text-align: center;vertical-align: top;">1.</td>
		
		
		<td colspan="4">Diinformasikan bahwa <b>KOPERASI JASA DADALI BANDUNG</b>, memiliki rekening Giro pada BANK BNI 46 cab Asia Afrika Bandung dengan nomor rekening a/c 244.692.71.</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		
		<td  style="text-align: center;vertical-align: top;">2.</td>
		
		
		<td colspan="4">Sehubungan dengan hal tersebut di atas, dengan ini mohon untuk melakukan pendebetan dari rekening 244.692.71 an KOPERASI JASA DADALI BANDUNG untuk dipindahbukukan ke rekening</td>
	</tr>
	<tr>
		<th align="right">a.</th>
		<td><b>Virtual Account </b></td><th colspan="">: 988 000 271 069 528 3</b></th>
	</tr>
	<tr>
		<td></td>
		
		
		<td colspan="4"> atas transaksi JASTEL, Voucher TELKOM GROUP dan Fee Akses</td>
	</tr>	
	
	<tr><td></td><td colspan="4" align=center><i>Sebesar : Rp <?php echo "$tampil1"; ?></i></td></tr>
	<tr><td></td><td colspan="4">Terbilang : <?php  echo "$terbilang1"; ?> Rupiah</td></tr>
	<tr><td></td></tr>
	
	<tr>
		<th align="right">b.</th>
		<td width="125px"><b>Virtual Account </b></td><th colspan="1">: 988 000 282 031 503 3</th>
	</tr>
	<tr>
		<td></td>
		
		
		<td colspan="4"> atas transaksi SOPP PLN</td>
	</tr>	
	
	<tr><td></td><td colspan="4" align=center><i>Sebesar : Rp <?php echo "$tampil2";?></i></td></tr>
	<tr><td></td><td colspan="4">Terbilang : <?php  echo "$terbilang2"; ?> Rupiah</td></tr>
</table>
</table>
	<table>
	<tr></tr>
	<tr>
		
		<td style="text-align: center;vertical-align: top;">3.</td><td colspan="4"> Dan Mohon Untuk Melakukan Transfer ke atas nama PT ARINDO PRATAMA (dilaksanakan sebelum pukul 12.00 WIB) dengan No</td>
	</tr>
	<tr>
	<th align="right">a.</th>
		<td><b>Virtual Account </b></td><td><b>: 4994994954</b></td>
	</tr>
	<tr>
		<td></td><td colspan="4"> atas Transaksi KOPEGTEL DADALI 185</td>
	</tr>
	<tr><td></td><td colspan="4" align=center><i>Sebesar : Rp <?php echo "$tampil3";?></i></td></tr>
	<tr><td></td><td colspan="4">Terbilang : <?php  echo "$terbilang3"; ?> Rupiah</td></tr>
	<tr><td></td></tr>
	<!-- <tr><td></td><td colspan="4">dari rekening nomor a/c 244.692.71 atas nama <b>KOPERASI JASA DADALI BANDUNG</b></td></tr> -->	
	<tr><td></td></tr>
		
		<tr><td  style="text-align: center;vertical-align: top;">4</td>
		<td colspan="4">Demikian disampaikan, atas kerjasamanya diucapkan terima kasih.</b></td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td></td>
		<td colspan="2">A.n PENGURUS KOPERASI JASA DADALI BANDUNG</td>
	</tr>
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