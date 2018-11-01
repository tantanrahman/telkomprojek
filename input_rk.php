<style type="text/css">
   
   table td
   {    
    font-size: 12px!important;
   }
   .tx
   {    
    font-size: 14px!important;
    font-weight: bold;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<h2 align="center">
            	Input RK dan Transfer Finnet
            	<?php 
					$tanggal1 = $_POST['nilai'];
					$date = explode("-", $tanggal1);
					                    
					                    $arr = array("$date[2]","$date[1]","$date[0]");
					                    
					                    $tampil_date = implode("-", $arr);
					                    if ($tanggal1==$tanggal2)
						{
						echo "$tanggal1";
						}
						else
						{
						echo "$tanggal1";
						}
            	?>
</h2>
<hr>
<form method="POST" action="?id=33">

<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}

	$sql = "
	Select A.tempat,A.amount,A.feenonadmin,A.adminjastel,A.tanggal as tanggal,( Case when A.amount is NULL then '0' else A.amount END)+(Case when A.adminjastel is NULL then '0' else A.adminjastel END) as jumlahjastel ,B.penpln,B.feepln,C.penpdam,C.feepdam,D.penvoucher,D.feevoucher, ((case when A.amount is NULL then '0' else A.amount end) + (case when A.feenonadmin is NULL then '0' else A.feenonadmin end) + (case when A.adminjastel is NULL then '0' else A.adminjastel end) + (case when B.penpln is NULL then '0' else B.penpln end) + (case when B.feepln is NULL then '0' else B.feepln end) + (case when C.penpdam is NULL then '0' else C.penpdam end) + (case when C.feepdam is NULL then '0' else C.feepdam end) + (case when D.penvoucher is NULL then '0' else D.penvoucher end) + (case when D.feevoucher is NULL then '0' else D.feevoucher end) )+(case when F.arindo_pen is NULL then '0' else F.arindo_pen end) as jumlah, E.jumlah_rk
from 
(SELECT lokasi.tempat as tempat, lokasi.loket as loket,lokasi.lokasi as lokasi,sopp.tanggal as tanggal, sum(sopp.amount) as amount, CASE when lokasi.loket='lembong1' then sum(sopp.trx)*1650 when lokasi.loket='lembong2' then sum(sopp.trx)*1650 when lokasi.loket='lembong3' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudhi2' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi1' then sum(sopp.trx)*1650 when lokasi.loket='setiabudi2' then sum(sopp.trx)*1650 END as feenonadmin,sum(sopp.surcharge) as adminjastel from lokasi left join sopp on lokasi.loket=sopp.user AND tanggal='$tampil_date' group by lokasi.tempat) as A 
left join 
(SELECT lokasi.tempat as tempat, lokasi.loket,pln.tanggal as tanggal, round((sum(pln.total_kopeg)-sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END))) as penpln, round(sum(CASE pln.fee_admin when '2500' then '1700' when '3000' then '2000' when '5000' then '3300' END)) as feepln from lokasi left join pln on lokasi.loket=pln.loket AND tanggal='$tampil_date'  group by lokasi.tempat ) as B on (A.tempat=B.tempat)
left join
(SELECT lokasi.tempat as tempat, lokasi.loket, pdam.tanggal as tanggal,sum(pdam.total_kopeg)- (pdam.trx*(case pdam.fee_admin when '2800' then '800' END)) as penpdam, pdam.trx*(case pdam.fee_admin when '2800' then '800' when '2000' then '800' END) as feepdam from lokasi left join  pdam on lokasi.loket=pdam.loket AND tanggal='$tampil_date'  group by lokasi.tempat) as C on (B.tempat=C.tempat)
left join
(SELECT lokasi.tempat as tempat,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg)-sum(voucher.fee_ca) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal='$tampil_date'  group by lokasi.tempat) as D on (C.tempat=D.tempat)
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



mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}


?>
<table class="table table-bordered table-striped">
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">User/Loker SOPP</th>	
		<th rowspan="2">RK</th>
	</tr>
	<tr>
		
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
$tampilamount =  number_format($row['amount'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeenonadmin =  number_format($row['feenonadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiladminjastel =  number_format($row['adminjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpln =  number_format($row['penpln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepln =  number_format($row['feepln'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenpdam =  number_format($row['penpdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeepdam =  number_format($row['feepdam'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilpenvoucher =  number_format($row['penvoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeevoucher =  number_format($row['feevoucher'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlah =  number_format($row['jumlah'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampiljumlahjastel =  number_format($row['jumlahjastel'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	
	echo "

				<td align='center'  class='tx'>$i</td>
				<td class='tx'>{$row['tempat']}</td>
				
				
				
				<td><div class='col-lg-6'><input type=text class='form-control' name='rk[]' value='{$row[jumlah_rk]}'>
					<input type=hidden name='tanggalrk[]' value='$tampil_date.{$row['tempat']}'>
				</td>
					
				
			</tr>";
$i++;

echo "<script>

function isNumberKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode;
 if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
 return true;
}
</script>";

}
?>
	<tr  bgcolor='#e1e1e1'>
		

	</tr>
</table>


<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$tanggal1 = $_POST['nilai'];
$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);

$cari = "select * from pengawasan where tanggal='$tampil_date'";
					$eksekusi = mysql_query($cari);
					$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);
$carititipan = "SELECT nominal from titipan2 where tanggal='$tampil_date'";
$ekseskusititipan = mysql_query($carititipan,$koneksi);
$datatitipan = mysql_fetch_array($ekseskusititipan,MYSQL_ASSOC);

?>

	<table class="table table-bordered table-striped"	>
		
			<input type="hidden" name="tanggall" value="<?php echo $tampil_date ?>" readonly="readonly">
		<tr>
			<td class ="tx">Titipan Tambahan</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="titipantambahan" value="<?php echo "{$datatitipan[nominal]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Transfer Ke Finnet</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="finnet1" value="<?php echo "{$data[transfer1]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Transfer Ke Finnet</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="finnet2" value="<?php echo "{$data[transfer2]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Transfer Ke Arindo</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="finnet3" value="<?php echo "{$data[transfer3]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Transfer Ke Finnet</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="finnet4" value="<?php echo "{$data[transfer4]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Biaya</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="biaya" value="<?php echo "{$data[biaya]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Tarik Tunai</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="tarik_tunai" value="<?php echo "{$data[tarik_tunai]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Jasa Giro</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="jasa_giro" value="<?php echo "{$data['jasa giro']}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">PPH</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="pph" value="<?php echo "{$data[pph]}"; ?>"></td>
		</tr>
		<tr>
			<td class ="tx">Kel Giro</td>
			<td><div class='col-lg-4'><input type="text" class='form-control' name="kel_giro" value="<?php echo "{$data['kel giro']}"; ?>"></td>
		</tr>
	</table>
	<center>
		<input type="submit" value="Simpan" class="btn btn-primary">
	</center>
</form>