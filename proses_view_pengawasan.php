<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

    <!-- CSS and JS for table fixed header -->
    <link rel="stylesheet" href="table-fixed-header.css">
    <script src="table-fixed-header.js"></script>

</head>
<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
    $('.table-fixed-header').fixedHeader();
    });
  </script>

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

echo "<center><h2>Laporan Pengawasan Tanggal $tanggal1</h2></center><hr>";
$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);





                    $date2 = date('d-m-Y', strtotime('-1 days', strtotime($tanggal1)));
                    
                    $date3 = explode("-", $date2);
                    $arr_date = array("$date3[2]","$date3[1]","$date3[0]");
                    $tanggal_akhir = implode("-", $arr_date);
                        

                    
                    $c = 0;
                    
                    $query=mysql_query("select status from status_tanggal where tanggal='$tanggal_akhir'");
                    $baris = mysql_fetch_array($query,MYSQL_ASSOC);

                    while ($baris['status']=="libur") {

                    $date3 = explode("-", $tanggal_akhir);
                    $arr_date = array("$date3[2]","$date3[1]","$date3[0]");
                    $tanggal_akhir = implode("-", $arr_date);
                    $date2 = date('d-m-Y', strtotime('-1 days', strtotime($tanggal_akhir)));
                    
                    $date3 = explode("-", $date2);
                    $arr_date = array("$date3[2]","$date3[1]","$date3[0]");
                    $tanggal_akhir = implode("-", $arr_date);
                    $query=mysql_query("select status from status_tanggal where tanggal='$tanggal_akhir'");
                    $baris = mysql_fetch_array($query,MYSQL_ASSOC);
                    	
                    }


                    



	$sql = "Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.feepln,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) ) as jumlah, E.jumlah_rk,F.arindo_fee,F.arindo_pen,G.titipan,G.talangan,H.total
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal, sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sum(sopp.trx)*0 when lokasi.loket='lembong2' then sum(sopp.trx)*0 when lokasi.loket='lembong3' then sum(sopp.trx)*0 when lokasi.loket='setiabudhi1' then sum(sopp.trx)*0 when lokasi.loket='setiabudhi2' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi1' then sum(sopp.trx)*0 when lokasi.loket='setiabudi2' then sum(sopp.trx)*0 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal='$tampil_date' group by lokasi.tempat) as A 
left join 
(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket AND tanggal='$tampil_date'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(SELECT lokasi.tempat as tempat, lokasi.loket, pdam.tanggal as tanggal,sum(pdam.total_kopeg)- (pdam.trx*sum((case when pdam.fee_admin/pdam.bill=2800 then 800 when pdam.fee_admin/pdam.bill=2000 then 1000 when pdam.fee_admin/pdam.bill=2500 then 1000 END))) AS penpdam, sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1000 end)as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket AND tanggal='$tampil_date'  group by lokasi.tempat) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal='$tampil_date'  group by lokasi.tempat) as D on (C.tempat=D.tempat)
left join
(Select lokasi.tempat as tempat, lokasi.loket, rk_input.tanggal as tanggal, rk_input.jumlah as jumlah_rk from lokasi left join rk_input on lokasi.tempat = rk_input.tempat AND tanggal='$tampil_date'  group by lokasi.tempat) as E on (D.tempat=E.tempat)
left join
(Select lokasi.tempat as tempat,lokasi.loket, arindo_input.tanggal as tanggal, arindo_input.fee as arindo_fee, arindo_input.pen as arindo_pen from lokasi left join arindo_input on lokasi.tempat = arindo_input.tempat AND tanggal='$tampil_date'  group by lokasi.tempat) as F on (E.tempat=F.tempat)
left join
(Select lokasi.tempat as tempat,lokasi.loket,  titipan.titipan as titipan, titipan.talangan as talangan from lokasi left join titipan on lokasi.tempat = titipan.tempat AND titipan.tanggal='$tampil_date' group by lokasi.tempat) as G on (F.tempat=G.tempat)
left join
(SELECT lokasi.tempat as tempat, total_trx.total as total FROM lokasi left join total_trx on lokasi.tempat = total_trx.tempat AND total_trx.tanggal='$tampil_date' GROUP BY lokasi.tempat 
) as H on (G.tempat=H.tempat)
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



mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}


?>
<table id="mytable" class="table table-bordered table-striped table-fixed-header">
                    <thead class="header">
	<tr>
		<th rowspan="4">No</th>
		<th rowspan="4"> Loket</th>
		<th colspan="2" align="center" valign="center">Selisih Tanggal <?php echo "$tanggal1"; ?></th>
		<th colspan="3" align="center" valign="center">Pendapatan</th>
		<th rowspan="3" align="center" valign="center">Sisa Setoran</th>
		<th rowspan="3" align="center" valign="center"><?php echo "RK Tanggal $tampil ";?> </th>
		<th colspan="2" align="center" valign="center"><?php echo "Selisih Tanggal $tampil ";?> </th>
		<th rowspan="4" align="center" valign="center">SALDO BANK</th>		
	</tr>
	<tr>
		<th rowspan="2" align="center" valign="center">Titpan</th>
		<th rowspan="2" align="center" valign="center">Talangan</th>
		<th rowspan="2" align="center" valign="center"><?php echo "$tanggal1"; ?></th>
		<th rowspan="" align="center" valign="center"><?php echo "$tampil"; ?></th>
		<th rowspan="" align="center" valign="center">Jumlah</th>
		<th rowspan="2" align="center" valign="center">Titpan</th>
		<th rowspan="2" align="center" valign="center">Talangan</th>
		
		
		
	</tr>
	<tr>
		<th></th>
		<th></th>
	</tr>
	<tr>
<th align="center">1</th>
		<th align="center">2</th>
		<th align="center">3</th>
		<th align="center">4</th>
		<th align="center">5=(3+4)</th>
		<th align="center">6=(5-1+2)</th>
		<th align="center">7</th>
		<th align="center">8=(7-6)</th>
		<th align="center">9</th>
	</tr>
	</thead>

<?php
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";





$k = "select saldo from saldo where tanggal='$tanggal_akhir'";
$queri = mysql_query($k);
$data = mysql_fetch_array($queri,MYSQL_ASSOC);

$i=1;
$saldo=$data['saldo'];
$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
echo "<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align='right'>$tampilsaldo</td>
	
	</tr>";
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

$tampilamount =  number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeenonadmin =  number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladminjastel =  number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpln =  number_format($row['penpln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepln =  number_format($row['feepln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpdam =  number_format($row['penpdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepdam =  number_format($row['feepdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenvoucher =  number_format($row['penvoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeevoucher =  number_format($row['feevoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$titipan = $row['titipan'];
$talangan = $row['talangan'];


$tampiljumlahjastel =  number_format($row['jumlahjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindofee =  number_format($row['arindo_fee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilarindopen =  number_format($row['arindo_pen'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$total = $row['total'];
$tampiljumlah =  number_format($total, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$rk =  number_format($row['jumlah_rk'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$selisih = $row['jumlah_rk'] - $total;
$tampilselisih =  number_format($selisih, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	
	
	echo "

				<td align='center'>$i</td>
				<td>{$row['tempat']}</td>

				
				
				
					
				
			";
$lima = $total - $titipan - $talangan;
$hasiltitipan = $hasiltitipan +$titipan;
$hasiltalangan = $hasiltalangan + $talangan;
			echo "<td>$titipan</td>
				<td>$talangan</td>";
			$tujuh=$row['jumlah_rk']-$lima;
			$tampillima =  number_format($lima, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			echo "<td align='right'>$tampiljumlah</td>

			<td></td>
			<td align='right'>$tampiljumlah</td>
			<td align='right'>$tampillima</td>
			<td align='right'>$rk</td>
			
			";
			$saldo = $saldo + $row['jumlah_rk'];
			$tampilsembilan =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			$tampiltujuh =  number_format($tujuh, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			
			if ($tujuh >=0)
			{
				$hapus = "DELETE FROM titipan WHERE tanggal=DATE_ADD('$tampil_date',INTERVAL 1 DAY) AND tempat='{$row['tempat']}'";
				$masuk = 	"	INSERT into titipan 
								VALUES (DATE_ADD('$tampil_date',INTERVAL 1 DAY),'{$row['tempat']}',$tujuh,0)
							";
				
				echo "<td align='right'>$tampiltujuh</td><td align='right'>0</td>";
				$jumlahtitipan = $tujuh + $jumlahtitipan;

			}
			else
			{
					$hapus = "DELETE FROM titipan WHERE tanggal=DATE_ADD('$tampil_date',INTERVAL 1 DAY) AND tempat='{$row['tempat']}'";
					$masuk = 	"	INSERT into titipan 
								VALUES (DATE_ADD('$tampil_date',INTERVAL 1 DAY),'{$row['tempat']}',0,$tujuh)
							";
					
				echo "<td align='right'>0</td><td align='right'>$tampiltujuh</td>";
				$jumlahtalangan = $tujuh + $jumlahtalangan;
			}
			mysqli_query($konek,$hapus);
			mysqli_query($konek,$masuk);
			echo "<td align='right'>$tampilsembilan</td>
			</tr>";
			

			$jumlah1 =  $jumlah1 + $row['amount'];
			$jumlah2 =  $jumlah2 + $row['feenonadmin'];
			$jumlah3 =  $jumlah3 + $row['adminjastel'];
			
			$jumlah5 =  $jumlah5 + $row['penpln'];
			$jumlah6 =  $jumlah6 + $row['feepln'];
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



$queri = mysql_query("select * from pengawasan where tanggal='$tampil_date'");
$data = mysql_fetch_array($queri,MYSQL_ASSOC);

$transfer1 =  number_format($data['transfer1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$transfer2 =  number_format($data['transfer2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$transfer3 =  number_format($data['transfer3'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$transfer4 =  number_format($data['transfer4'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$biaya =  number_format($data['biaya'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tarik_tunai =  number_format($data['tarik_tunai'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$jasagiro =  number_format($data['jasa giro'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$pph =  number_format($data['pph'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$kelgiro =  number_format($data['kel giro'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

$carititipan = mysql_query("select * from titipan2 where tanggal='$tampil_date'");
$datatitipan = mysql_fetch_array($carititipan,MYSQL_ASSOC);
?>
	
		

	</tr>
	<tr>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Titipan Tambahan</td>
		<?php 
		$cariadmin = "SELECT * from fee_admin where tanggal='$tampil_date'";
		$queryadmin = mysqli_query($konek,$cariadmin);
		$dataadmin = mysqli_fetch_array($queryadmin,MYSQLI_ASSOC);

		if ($dataadmin['fee_admin']>=1000000)
		{
			$tambah=1000000;
		}
		else
		{
			$tambah=0;
		}
		$jumlahtitipan2 = $datatitipan['nominal']+$tambah;
		?>
		<td align="right"><?php echo number_format($datatitipan['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo number_format($datatitipan['nominal']+$tambah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?></td>
		<?php
		 $saldo = $saldo;
		 $tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

		 $hapus = "DELETE FROM titipan2 WHERE tanggal=DATE_ADD('$tampil_date',INTERVAL 1 DAY)";
					$masuk = 	"	INSERT into titipan2
								VALUES (DATE_ADD('$tampil_date',INTERVAL 1 DAY),$datatitipan[nominal]+$tambah)
							";
		 mysqli_query($konek,$hapus);
			mysqli_query($konek,$masuk);
		?>
		<td></td>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr >
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Transfer Ke FINNET</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $transfer1; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['transfer1'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr bgcolor='#e1e1e1'>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Transfer Ke FINNET</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $transfer2; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['transfer2'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Transfer Ke FINNET</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $transfer3; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['transfer3'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr bgcolor='#e1e1e1'>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Transfer Ke FINNET</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $transfer4; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['transfer4'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<?php 
		$totalsetor = ($data['transfer1'] + $data['transfer2'] + $data['transfer3']+ $data['transfer4']) * -1;
		$tampiltotalsetor =  number_format($totalsetor, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
	<tr>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Biaya Transfer</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $biaya; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['biaya'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr bgcolor='#e1e1e1'>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Tarik TUnai Mahyar</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $tarik_tunai; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['tarik_tunai'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Jasa Giro Bunga</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $jasagiro; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['jasa giro'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr bgcolor='#e1e1e1'>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>PPh</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $pph; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['pph'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr>
		<td><?php echo "$i"; $i = $i + 1; ?></td>
		<td>Kel Giro</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right"><?php echo $kelgiro; ?></td>
		<td></td>
		<td></td>
		<?php 
		$saldo = $saldo + $data['kel giro'];
		$tampilsaldo =  number_format($saldo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
		<td align="right"><?php echo $tampilsaldo; ?></td>
	</tr>
	<tr>
		<td colspan=2>Total</td>
		<td><?php echo number_format($hasiltitipan+$datatitipan['nominal'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		<td><?php echo number_format($hasiltalangan, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		<td colspan=4></td>
		<td><?php echo number_format($jumlah12+$data['transfer1']+$data['transfer2']+$data['transfer3']+$data['transfer4'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		<td><?php echo number_format($jumlahtitipan+$jumlahtitipan2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		<td><?php echo number_format($jumlahtalangan, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		
	</tr>
</font>
<tr><td colspan="10"></td><td>rk</td><td align="right"><?php echo "$tampilsaldo"; ?></td></tr>
<tr><td colspan="7"></td><td>Harus Setor KE Finnet</td><td><?php echo "$tampiltotalsetor"; ?></td><td></td><td>titipan</td><td align="right"><?php echo number_format($jumlahtitipan+$jumlahtitipan2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?></td></tr>
<tr><td colspan="7"></td><td>Sudah Dieksekusi</td><td><?php echo "$tampiltotalsetor"; ?></td><td></td><td>saldo</td><td align="right"><?php echo number_format($saldo-$jumlahtitipan-$jumlahtitipan2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td></tr>
<tr><td colspan="7"></td><td>Saldo</td><td>0</td><td></td></tr>
<tr><td colspan="7"></td><td align="right">rk</td><td><?php echo "$tampilsaldo"; ?></td><td></td><td bgcolor="yellow">saldo surcharge</td><td align="right"><?php echo number_format($saldo-$jumlahtitipan-$jumlahtalangan-$jumlahtitipan2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);  ?></td></tr>
<tr><td colspan="7"></td><td>Kurang/lebih</td><td><?php  echo "$tampilsaldo"; ?></td><td></td></tr>


</table>
<?php


$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);



$cari = "select * from saldo where tanggal='$tampil_date'";
$eksekusi = mysql_query($cari);
$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

if($data == null)
{
	$insert = "INSERT INTO `kopeg`.`saldo` 
					(tanggal,saldo)
					VALUES ('$tampil_date', $saldo)";
			
}
else
{
	$insert = "UPDATE  `kopeg`.`saldo` 
					set saldo=$saldo where tanggal='$tampil_date'";
}
$sql=mysqli_query($konek,$insert);

?>



