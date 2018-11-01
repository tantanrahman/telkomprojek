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
			<hr>
            <center>
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="index.php?id=2"><span aria-hidden="true">&larr;</span> Back</a></li>
                    <li class="next disabled"><a href="#"> Next <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </center>
			<br></br>
                <div class="dataTable_wrapper" id="pen_pln">
                    <table class="table-responsive table-bordered table" id="dataTables-example">
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
					$nilai = $_POST["nilai"];
                    $nilai2 = $_POST["nilai2"];
                    $query=mysql_query("select lokasi.lokasi, pln.tanggal, pln.loket, pln.bill, pln.total_kopeg, ceiling(pln.fee_admin/pln.bill) as fee from pln inner join lokasi on lokasi.loket = pln.loket where (pln.tanggal between '$tanggal_awal' AND '$tanggal_akhir') OR (pln.tanggal = '$tanggal_filter') AND ((lokasi.lokasi = '$lokasi') OR pln.loket = '$usser') OR (pln.fee_admin/pln.bill) = '$fee'");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['tanggal'];?></td>
                            <td><?php echo $row['lokasi'];?></td>
                            <td><?php echo $row['loket'];?></td>
                            <td><?php echo $row['bill'];?></td>
                            <td><?php echo $row['total_kopeg'];?></td>
							<td><?php echo $row['fee'];?></td>
                       
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
                    <a href="pdf/pdf_pen_pln.php?kolom=<?php echo $kolom ?>&nilai=<?php echo $nilai ?>&nilai2=<?php echo $nilai2;?>" button type="submit" class="btn btn-default">Export To PDF</button></a>
                    <a href="index.php?id=3" button type="submit" class="btn btn-default">Rekap Pendapatan</button></a>
                    <a href="pdf/pdf_srt_permohonan.php" button type="submit" class="btn btn-default">Surat Permohonan</button></a>
                </div>
</body>

</html>
