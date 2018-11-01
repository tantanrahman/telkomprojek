<html>

<body>
        <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Pendapatan PLN Finnet
            </h2>
			<hr>
        <center>
            <form action="index.php?id=20" method="post">
                <table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="hapuspln" placeholder="Tanggal Laporan">
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" class="btn btn-danger" name="hapus" value="Hapus Laporan">
                <br>
            </form>
        </center>

			<br></br>
        
        <form method="post" action="pen_pln_edit.php">
            <div id="pen_pln">
                    <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                    <tr>
                        
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
						<th>Fee</th>
                    </tr>
                </thead>

                <tbody>
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
                    $query=mysql_query("select pln.id, lokasi.lokasi, pln.tanggal, pln.loket, pln.bill, pln.total_kopeg, ceiling(pln.fee_admin/pln.bill) from pln inner join lokasi on lokasi.loket = pln.loket");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                           
                            
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['tanggal'];?></td>
                            <td><?php echo $row['lokasi'];?></td>
                            <td><?php echo $row['loket'];?></td>
                            <td><?php echo $row['bill'];?></td>
                            <td><?php echo $row['total_kopeg'];?></td>
							<td><?php echo $row['ceiling(pln.fee_admin/pln.bill)'];?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                    </table>
                </form>
            </div>
			</div>
    
</body>

</html>
