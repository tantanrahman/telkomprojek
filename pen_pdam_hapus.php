<!DOCTYPE html>
<html>

<body>
        <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Pendapatan PDAM Finnet
            </h2>
			<hr>
            <center>
            <form action="index.php?id=23" method="post">
                <table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="hapuspdam" placeholder="Tanggal Laporan">
                        </td>
                </table>
                <br>
                <input type="submit" class="btn btn-danger" name="hapus" value="Hapus Laporan">
            </form>

        </center>
			<br></br>
                    <table class="table-responsive table-bordered table" id="datatable">
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
                    $query=mysql_query("select * from (select pdam.tanggal as pdtanggal, lokasi.lokasi as pdlokasi, pdam.loket as pdloket, pdam.bill as pdbill, pdam.total_kopeg as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from pdam inner join lokasi on lokasi.loket = pdam.loket) as penpdam order by pdtanggal");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pdtanggal'];?></td>
                            <td><?php echo $row['pdlokasi'];?></td>
                            <td><?php echo $row['pdloket'];?></td>
                            <td><?php echo $row['pdbill'];?></td>
                            <td><?php echo $row['pdpendapatan'];?></td>
                            <td><?php echo $row['pdfee'];?></td>                       
                        </tr>						
                        <?php
                    }					
                    ?>
                </tbody>

                <tfoot>
						<tr>
                        <th colspan="4">TOTAL TRANSAKSI</th>
                    <?php
						$query_total=mysql_query("select sum(penpdam.pdbill) as sum_pdbill, sum(penpdam.pdpendapatan) as sum_pdpendapatan from (select pdam.tanggal as pdtanggal, lokasi.lokasi as pdlokasi, pdam.loket as pdloket, pdam.bill as pdbill, pdam.total_kopeg as pdpendapatan from pdam inner join lokasi on lokasi.loket = pdam.loket) as penpdam;");
						$row2=mysql_fetch_array($query_total);
					?>
						<td><?php echo $row2['sum_pdbill'];?></td>
                        <td><?php echo $row2['sum_pdpendapatan'];?></td>				
                    </tr>
                    </table>
                </tfoot>
			</div>                    
</body>

</html>
