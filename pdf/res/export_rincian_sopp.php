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
</body>

</html>
