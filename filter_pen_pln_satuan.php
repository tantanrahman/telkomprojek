<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Pendapatan PLN Finnet
            </h2>
			<hr width="50%">
            <center>
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="index.php?id=2"><span aria-hidden="true">&larr;</span> Back</a></li>
                    <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </center>
			<br></br>
                <div class="dataTable_wrapper" id="pen_pln">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
						<th>Fee</th>
                    </tr>

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    if (isset($_POST['filter'])) {

                        $tanggal_awal=$_POST['nilai'];
                        $tanggal_akhir=$_POST['nilai2'];
                        $lokasi =$_POST['nilai3'];
                        $usser =$_POST['nilai4'];
                        $fee =$_POST['nilai5'];
                        $tanggal_filter = $_POST['nilai6'];
                        
                     }

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
					$kolom = $_POST["kolom"];
					$nilai = $_POST["nilai"];
                    $query=mysql_query("select lokasi.lokasi, pln.tanggal, pln.loket, pln.bill, pln.total_kopeg, ceiling(pln.fee_admin/pln.bill) from pln inner join lokasi on lokasi.loket = pln.loket where (pln.tanggal between '$tanggal_awal' AND '$tanggal_akhir') OR (pln.tanggal = '$tanggal_filter') AND ((lokasi.lokasi = '$lokasi') OR pln.loket = '$usser') OR (pln.fee_admin/pln.bill) = '$fee'");
                    

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

                    <tr>
                        <th colspan="4">TOTAL TRANSAKSI</th>
                    <?php
                        $query_total=mysql_query("select SUM(bill) as sum_lembar, SUM(total_kopeg) as sum_pendapatan FROM pln where (pln.tanggal between '$tanggal_awal' AND '$tanggal_akhir') AND (loket = '$lokasi') OR pln.loket = '$usser'");
                        $row2=mysql_fetch_array($query_total);
                    ?>
                        <td><?php echo $row2['sum_lembar'];?></td>
                        <td><?php echo $row2['sum_pendapatan'];?></td>
    
                    </tr>

                    </table>
                </div>

                </div>
                <div class="center">
                    <button id="cetak" class="btn pull-center">Cetak</button>
                </div>
</body>

</html>
