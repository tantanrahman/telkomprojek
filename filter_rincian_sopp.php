<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Rincian SOPP Finnet
            </h2>
					
			<form action="filter_rincian_sopp.php" method="post">
			Field : <select name="kolom" Size="1">
				<option value = "rpsopp.rptanggal"> Tanggal </option>
				<option value = "rpsopp.rplokasi"> Lokasi </option>
				<option value = "rpsopp.rpl11"> Jumlah L11 </option>
				<option value = "rpsopp.rpfee"> Fee </option>
				<option value = "rpsopp.rpppn"> PPN </option>
				<option value = "rpsopp.rpfeeakses"> Fee Akses</option>
				<option value = "rpsopp.rptitipan"> Titipan </option>
				<option value = "rpsopp.rpadmin"> Admin </option>
			</select>
			
			Value : <input type="text" name="nilai"><br>
			<input type="submit">
			</form>
			
			
			<br></br>
                    <table class="table" border="1" width=100%>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Jumlah L11</th>
						<th>Fee</th>
						<th>PPN</th>
						<th>Fee Akses</th>
						<th>Titipan</th>
						<th>Admin</th>
						<th>Fee Pulsa ARINDO</th>
                    </tr>

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
					$kolom = $_POST["kolom"];
					$nilai = $_POST["nilai"];
                    $query=mysql_query("select * from (select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as rpsopp where $kolom = '$nilai';");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['rplokasi'];?></td>
                            <td><?php echo $row['rpl11'];?></td>
                            <td><?php echo $row['rpfee'];?></td>
							<td><?php echo $row['rpppn'];?></td>
							<td><?php echo $row['rpfeeakses'];?></td>
							<td><?php echo $row['rptitipan'];?></td>
							<td><?php echo $row['rpadmin'];?></td>
							<td><?php echo "-";?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>
					
					<tr>
                        <th colspan=2>TOTAL TRANSAKSI</th>
                    <?php
						$query_total=mysql_query("select sum(rpsopp.rpl11) as sum_rpl11, sum(rpsopp.rpfee) as sum_rpfee, sum(rpsopp.rpppn) as sum_rpppn, sum(rpsopp.rpfeeakses) as sum_rpfeeakses, sum(rpsopp.rptitipan) as sum_rptitipan, sum(rpsopp.rpadmin) as sum_rpadmin from (select sopp.tanggal as rptanggal, kaliuser.lokasi as rplokasi, sum(bill) as rpl11, sum(bill)*kaliuser.xfee as rpfee, sum(bill)*kaliuser.xfee*0.1 as rpppn, sum(bill)*500 as rpfeeakses, sum(bill)*kaliuser.xtitip as rptitipan, sum(bill)*kaliuser.xfee+sum(bill)*kaliuser.xfee*0.1+sum(bill)*500+sum(bill)*kaliuser.xtitip as rpadmin from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as rpsopp where $kolom = '$nilai';");
						$row2=mysql_fetch_array($query_total);
					?>
						<td><?php echo $row2['sum_rpl11'];?></td>
                        <td><?php echo $row2['sum_rpfee'];?></td>
						<td><?php echo $row2['sum_rpppn'];?></td>
						<td><?php echo $row2['sum_rpfeeakses'];?></td>
						<td><?php echo $row2['sum_rptitipan'];?></td>
						<td><?php echo $row2['sum_rpadmin'];?></td>						
                    </tr>
                    </table>
					</div>
				
				<div class="center">
                    <a href="pdf/pdf_rincian_sopp.php?kolom=<?php echo $kolom ?>&nilai=<?php echo $nilai ?>" button type="submit" class="btn btn-default">Export To PDF</button></a>
                    <a href="index.php?id=3" button type="submit" class="btn btn-default">Rekap Pendapatan</button></a>
                    <a href="pdf/pdf_srt_permohonan.php" button type="submit" class="btn btn-default">Surat Permohonan</button></a>
                </div>
</body>

</html>
