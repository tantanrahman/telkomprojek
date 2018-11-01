<!DOCTYPE html>
<html lang="en">
<body>
<?php


?>
            <div class="container-fluid">
                <!-- /.row -->

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");
                    $nilai = $_GET['nilai'];
                    $nilai2 = $_GET['nilai2'];
                    if ($nilai2==null)
                    {
                        $nilai2=$nilai;
                    }

                    mysql_select_db($database) or die("Database tidak bisa dibuka");
                    $c = 0;
                    
                        $query_tanggal=mysql_query("select tanggal FROM pln where tanggal between '$nilai' AND '$nilai2'");
                        $row3=mysql_fetch_array($query_tanggal);
                    ?>

            <h3>PENDAPATAN PLN FINNET</h3>
            <h3>Transaksi Tanggal <?php echo $nilai;
            
            if ($nilai2<>null)
            { echo " sampai $nilai2";}
            ?></h3>

                    <table border="1" cellpadding="1">
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>

                    <?php
                    
                    $query=mysql_query("select lokasi.lokasi, pln.loket, pln.bill, pln.total_kopeg, ceiling(pln.fee_admin/pln.bill) from pln inner join lokasi on lokasi.loket = pln.loket where tanggal between '$nilai' AND '$nilai2'");
                    


                    while($row=mysql_fetch_array($query)){
                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['total_kopeg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['bill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>

                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['lokasi'];?></td>
                            <td><?php echo $row['loket'];?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>

                    <tr>
                        <th colspan="3" border="2">TOTAL TRANSAKSI</th>
                    <?php
                        $query_total=mysql_query("select SUM(bill) as sum_lembar, SUM(total_kopeg) as sum_pendapatan FROM pln where tanggal between '$nilai' AND '$nilai2'");
                        $row2=mysql_fetch_array($query_total);
                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row2['sum_lembar'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row2['sum_pendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                        <td border="2" align="right"><?php echo $tampildatabayar;?></td>
                        <td border="2" align="right">Rp<?php echo $tampildatabayar2;?></td>
    
                    </tr>
                    
                </table>

                <br />

                <p align="center">Bandung <?php echo $row3['tanggal'];?></p>
                <table border="1" width="100%">
                    <tr>
                        <td width="50%">Mengetahui,</td>
                        <td width="50%">Yang membuat</td>
                    </tr>
                </table>

                </div>
</body>

</html>
