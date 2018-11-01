<style type="text/css">
   
   table td
   {    
    font-size: 12px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<?php
$tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];
?>
<html lang="en">
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
<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Rincian SOPP Finnet
            </h2>
	<hr>
	<a href="?id=55">pilih Tanggal</a>
	<hr>
	<br>		
			
                    <table id="mytable" class="table table-bordered table-striped table-fixed-header">
                    <thead class="header">
	                    <tr>
	                        <th>No</th>
	                        
	                        <th>Lokasi</th>
	                        <th>Fee</th>
							<th>PPN</th>
							<th>Fee Akses</th>
							<th>Titipan</th>
							<th>Admin</th>
							<th>Fee Pulsa ARINDO</th>
							<th>Fee FINNET</th>
							<th>PPN FINNET</th>
	                    </tr>
	                </thead>

	                <tbody>
	                    <?php
	                    $server   = "localhost";
	                    $user 	  = "root";
	                    $password = "";
	                    $database = "kopeg";
	                    $tanggal1 = $_POST['nilai'];
                    	$tanggal2 = $_POST['nilai2'];
                    	$date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);
	                    ini_set('display_errors',TRUE);
	                    $koneksi = mysqli_connect('localhost','root','','kopeg');
	                    $tanggal=date("d/m/Y");
	                        
	                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

	                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
	                    $c = 0;
	                    if ($tanggal1==$tanggal2)
                        {
	                    $query=mysql_query("select A.lokasi,B.rpfee,B.rpppn,B.rpfeeakses,B.rptitipan,B.rpadmin,C.pdfee,D.bagi,D.hasil,E.feevoucher from 
(select lokasi.lokasi as lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user and tanggal ='$tampil_date' group by lokasi.lokasi) as A 
left join
(select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user and tanggal ='$tampil_date'  group by sopp.user) as B 
on A.lokasi = B.rplokasi
Left join
(select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan,  sum(case when pdam.fee_admin/pdam.bill=2000 then pdam.bill*1000 when pdam.fee_admin/pdam.bill=2800 then pdam.bill*800 when pdam.fee_admin/pdam.bill=2500 then pdam.bill*1500 end) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket and pdam.tanggal = '$tampil_date' group by lokasi.lokasi) as C 
on B.rplokasi=C.pdlokasi
Left join
(select lokasi.lokasi,sum(case when pln.fee_admin/pln.bill=2500 then 1700*pln.bill when pln.fee_admin/pln.bill=3000 then 2000*pln.bill when pln.fee_admin/pln.bill=5000 then 3300*pln.bill end) as hasil ,sum(pln.bill) as bill, ceiling(pln.fee_admin/pln.bill) as bagi from lokasi left join pln on lokasi.loket=pln.loket and pln.tanggal = '$tampil_date'  group by lokasi.lokasi) as D
on C.pdlokasi=D.lokasi
left join
(SELECT lokasi.tempat as tempat,lokasi.lokasi,lokasi.loket, voucher.tanggal as tanggal,sum(voucher.total_kopeg) as penvoucher, sum(voucher.fee_ca) as feevoucher from lokasi left join voucher on lokasi.loket=voucher.user AND tanggal='$tampil_date'  group by lokasi.lokasi) as E on (D.lokasi=E.lokasi)


");

	                    }
	                    else
	                    {
	                    $query=mysql_query("select A.lokasi,B.rpfee,B.rpppn,B.rpfeeakses,B.rptitipan,B.rpadmin from 
(select lokasi.lokasi as lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user AND ((tanggal between '$tampil_date' AND $tampil_date2 )or tanggal is null) group by lokasi.lokasi) as A 
left join
(select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user ((tanggal between '$tampil_date' AND $tampil_date2 )or tanggal is null) group by sopp.user) as B 
on A.lokasi = B.rplokasi


");	
	                    }

	                    while($row=mysql_fetch_array($query)){

if ($row['lokasi']=="SETIABUDI 1" || $row['lokasi']=="SETIABUDI 2" ||$row['lokasi']=="SETIABUDHI 1" || $row['lokasi']=="SETIABUDHI 2" || $row['lokasi']=="LEMBONG 1" || $row['lokasi']=="LEMBONG 2" || $row['lokasi']=="LEMBONG 3") 
	                            {
	                            	$row['rpfee']=0;
	                            	$row['rpppn']=0;
	                            	$row['rpfeeakses']=0;
	                            	$row['rptitipan']=0;
	                            	$row['rpadmin']=0;
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


	                    	$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$ppn = ($row['pdfee']+$row['hasil']+$row['feevoucher']) /1.1;
$tampildatabayar =  number_format($row['rpfee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['rpppn'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['rpfeeakses'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row['rptitipan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($row['rpadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar6 = number_format($ppn, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar7 = number_format(ceil($ppn*0.1), $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                        ?>
	                        <tr>
	                            <td><?php echo $c=$c+1;?></td>
	                            
	                            
	                            <td><?php echo $row['lokasi'];?></td>
	                            <td align="right"><?php 	echo $tampildatabayar;?></td>
								<td align="right"><?php echo $tampildatabayar2;?></td>
								<td align="right"><?php echo $tampildatabayar3;?></td>
								<td align="right"><?php echo $tampildatabayar4;?></td>
								<td align="right"><?php echo $tampildatabayar5;?></td>
								<td><?php echo $row[''];?></td>
								<td align="right"><?php echo $tampildatabayar6;?></td>
								<td align="right"><?php echo $tampildatabayar7;?></td>
	                       
	                        </tr>
	                        <?php
	                        $jumlah = $jumlah + $ppn;
	                        $jumlah2= $jumlah2 + round($ppn*0.1,PHP_ROUND_HALF_UP);

	                        $jumlah3 = $jumlah3 + $row['rpfee'];
	                        $jumlah4 = $jumlah4 + $row['rpppn'];
	                        $jumlah5 = $jumlah5 + $row['rpfeeakses'];
	                        $jumlah6 = $jumlah6 + $row['rptitipan'];
	                        $jumlah7 = $jumlah7 + $row['rpadmin'];
	                    }
	                    $tampil = number_format($jumlah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    $tampil2 = number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

	                    $tampil3 = number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    $tampil4 = number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    $tampil5 = number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    $tampil6 = number_format($jumlah6, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    $tampil7 = number_format($jumlah7, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                    
	                    $cari = "select * from fee_akses where tanggal='$tampil_date'";
						$eksekusi = mysql_query($cari);
						$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);
						if($data == null)
						{

						$insert = "INSERT INTO `kopeg`.`fee_akses` 
						(tanggal,fee_akses)
						VALUES ('$tampil_date', $jumlah5)";
						}
						else
						{
							$insert = "UPDATE `kopeg`.`fee_akses` 
						set fee_akses=$jumlah5 where tanggal='$tampil_date'";
						}
						$sql=mysqli_query($koneksi,$insert);


						$cari2 = "select * from fee_admin where tanggal='$tampil_date'";
						$eksekusi2 = mysql_query($cari2);
						$data2 = mysql_fetch_array($eksekusi2,MYSQL_ASSOC);
						if($data2 == null)
						{

						$insert2 = "INSERT INTO `kopeg`.`fee_admin` 
						(tanggal,fee_admin)
						VALUES ('$tampil_date', $jumlah7)";
						}
						else
						{
							$insert2 = "UPDATE `kopeg`.`fee_admin` 
						set fee_admin=$jumlah7 where tanggal='$tampil_date'";
						
						}
						$sql2=mysqli_query($koneksi,$insert2);

						
	                    ?>
					</tbody>
					<tr>
					<td class="tx" colspan="2"  align="center">Jumlah</td>
					<td class="tx" align="right"><?php echo "$tampil3";?></td>
					<td class="tx" align="right"><?php echo "$tampil4";?></td>
					<td class="tx" align="right"><?php echo "$tampil5";?></td>
					<td class="tx" align="right"><?php echo "$tampil6";?></td>
					<td class="tx" align="right"><?php echo "$tampil7";?></td>
					<td class="tx" ></td>
					<td class="tx" align="right"><?php echo "$tampil";?></td>
					<td class="tx" align="right"><?php echo "$tampil2";?></td>
					</tr>

					</table>
				</div>
</body>

</html>
