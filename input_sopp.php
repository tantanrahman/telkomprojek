<html lang="en">



<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Rincian SOPP Finnet
            </h2>
					<form method="POST" action="?id=58">
			
                    <table class="table-responsive table-bordered table" id="datatable">
                    <thead>
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
						$arr = array("$date[2]","$date[1]","$date[0]");
						$tampil_date = implode("-", $arr);
	                    ini_set('display_errors',TRUE);

	                    $tanggal=date("d/m/Y");
	                        
	                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

	                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
	                    $c = 0;
	                    
	                    

	                     $query=mysql_query("select A.lokasi,B.rpfee,B.rpppn,B.rpfeeakses,B.rptitipan,B.rpadmin,C.jumlah from 
(select lokasi.lokasi as lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user and (tanggal ='$tampil_date' or tanggal is null) group by lokasi.lokasi) as A 
left join
(select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user and (tanggal ='$tampil_date' or tanggal is null)   group by sopp.user) as B 
on A.lokasi = B.rplokasi
left join
(Select lokasi.lokasi,lokasi.loket, rincian_sopp_input.tanggal as tanggal, rincian_sopp_input.fee_finnet as jumlah from lokasi left join rincian_sopp_input on lokasi.lokasi = rincian_sopp_input.lokasi and (tanggal ='$tampil_date' or tanggal is null) group by lokasi.loket) as C on (B.rplokasi=C.lokasi)

");
	                    

	                    while($row=mysql_fetch_array($query)){

	                    	$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['rpfee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['rpppn'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['rpfeeakses'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row['rptitipan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($row['rpadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	                        ?>
	                        <tr>
	                            <td><?php echo $c=$c+1;?></td>
	                            
	                            
	                            <td><?php echo $row['lokasi'];?></td>
	                            <td align="right"><?php echo $tampildatabayar;?></td>
								<td align="right"><?php echo $tampildatabayar2;?></td>
								<td align="right"><?php echo $tampildatabayar3;?></td>
								<td align="right"><?php echo $tampildatabayar4;?></td>
								<td align="right"><?php echo $tampildatabayar5;?></td>
								
								<td>
								<?php
									echo 
									"<td><input type=text name='jumlah[]' onkeypress='return isNumberKey(event)' value='{$row['jumlah']}'>
									<input type=hidden name='tanggal[]' value='$tampil_date.{$row['lokasi']}'>
									";
									$ppn = 0.1 * $row['jumlah'];
								?>
								</td>
								<td><?php echo ceil($ppn);?></td>
								
	                       
	                        </tr>
	                        <?php
	                    }
	                    ?>
					</tbody>

					
	                    </table>
<input type="submit" value="SIMPAN">
	              </form>
				</div>
</body>

</html>
