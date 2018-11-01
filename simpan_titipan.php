

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
//$tanggal1 = "26-01-2016";

	$sql = "Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.feepln,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk,F.arindo_fee,F.arindo_pen
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal, sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sum(sopp.trx)*1650 when lokasi.loket='lembong2' then sum(sopp.trx)*1650 when lokasi.loket='lembong3' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi2' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi2' then sum(sopp.trx)*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal='$tanggal1' group by lokasi.tempat) as A 
left join 
(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket AND tanggal='$tanggal1'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(SELECT lokasi.tempat as tempat, lokasi.loket, pdam.tanggal as tanggal,sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket AND tanggal='$tanggal1'  group by lokasi.tempat) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal='$tanggal1'  group by lokasi.tempat) as D on (C.tempat=D.tempat)
left join
(Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND tanggal='$tanggal1'  group by lokasi.tempat) as E on (D.tempat=E.tempat)
left join
(Select lokasi.tempat as tempat,lokasi.loket, arindo_input.tanggal as tanggal, arindo_input.fee as arindo_fee, arindo_input.pen as arindo_pen from lokasi left join arindo_input on lokasi.tempat = arindo_input.tempat AND tanggal='$tanggal1'  group by lokasi.tempat) as F on (E.tempat=F.tempat)
";
//where (A.tanggal='$tanggal1' OR A.tanggal is NULL) AND (B.tanggal='$tanggal1' OR B.tanggal is NULL) AND (C.tanggal='$tanggal1' OR C.tanggal is NULL) AND (D.tanggal='$tanggal1' OR D.tanggal is NULL) AND (E.tanggal='$tanggal1' OR E.tanggal is NULL) AND (F.tanggal='$tanggal1' OR F.tanggal is NULL)";

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
	
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampilamount =  number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeenonadmin =  number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladminjastel =  number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpln =  number_format($row['penpln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepln =  number_format($row['feepln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
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

			if ($selisih >= 0)
			{
				$insert = "INSERT INTO `kopeg`.`titipan` 
					(tanggal,tempat,titipan,talangan)
					VALUES ('$tampil', '$row[tempat]', $selisih,0)";
			$sql=mysqli_query($konek,$insert);
				
				
			}
			else
			{
				$insert = "INSERT INTO `kopeg`.`titipan` 
					(tanggal,tempat,titipan,talangan)
					VALUES ('$tampil', '$row[tempat]', 0,$selisih)";
				$sql=mysqli_query($konek,$insert);
				$pecah = explode('-', $tampilselisih);
				

			}
			echo "</tr>";

			
			

			
$i++;
}


?>
	
