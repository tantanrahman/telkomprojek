<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->
            
            <h2 align="center">
            Lembar Pendapatan SOPP Finnet
            </h2>
                    
            <center>
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="index.php?id=5"><span aria-hidden="true">&larr;</span> Back</a></li>
                    <li class="next disabled"><a href="#"> Next <span aria-hidden="true">&rarr;</span></a></li>
                  </ul>
                </nav>
            </center>
            
            
            <br></br>
                    <table class="table-responsive table-bordered table" border="1" width=100%>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah L11</th>
                        <th>Pendapatan</th>
                        <th>Admin</th>
                        <th>JUMLAH</th>
                    </tr>

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    if (isset($_POST['filter'])) {

                        $nilai = $_POST['nilai'];
                        $nilai2 = $_POST['nilai2'];

                        $tanggal_awal=$_POST['nilai'];
                        $tanggal_akhir=$_POST['nilai2'];
                                                
                    }

                    ini_set('display_errors',TRUE);

                                            
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    $kolom = $_POST["kolom"];
                    $nilai = $_POST["nilai"];
                    $query=mysql_query("select * from (select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sopp.user as psuser, sum(bill) as psl11, sum(amount) as pspendapatan, sum(bill)*kaliuser.xadmin as psadmin, sum(amount)+sum(bill)*kaliuser.xadmin as psjumlah from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as pensopp where pstanggal between '$tanggal_awal' AND '$tanggal_akhir'");

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pstanggal'];?></td>
                            <td><?php echo $row['pslokasi'];?></td>
                            <td><?php echo $row['psuser'];?></td>
                            <td><?php echo $row['psl11'];?></td>
                            <td><?php echo $row['pspendapatan'];?></td>
                            <td><?php echo $row['psadmin'];?></td>
                            <td><?php echo $row['psjumlah'];?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <th colspan="4">TOTAL TRANSAKSI</th>
                    <?php
                        $query_total=mysql_query("select sum(pensopp.psl11) as sum_psl11, sum(pensopp.pspendapatan) as sum_pspendapatan, sum(pensopp.psadmin) as sum_psadmin, sum(pensopp.psjumlah) as sum_psjumlah from (select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sopp.user as psuser, sum(bill) as psl11, sum(amount) as pspendapatan, sum(bill)*kaliuser.xadmin as psadmin, sum(amount)+sum(bill)*kaliuser.xadmin as psjumlah from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as pensopp where pstanggal between '$tanggal_awal' AND '$tanggal_akhir'");
                        $row2=mysql_fetch_array($query_total);
                    ?>
                        <td><?php echo $row2['sum_psl11'];?></td>
                        <td><?php echo $row2['sum_pspendapatan'];?></td>
                        <td><?php echo $row2['sum_psadmin'];?></td>
                        <td><?php echo $row2['sum_psjumlah'];?></td>
                    </tr>
                    </table>
                    </div>
                    
                <div class="center">
                    <a href="pdf/pdf_pen_sopp.php?kolom=<?php echo $kolom ?>&nilai=<?php echo $nilai ?>&nilai2=<?php echo $nilai2 ?>" button type="submit" class="btn btn-default">Export To PDF</button></a>
                    <a href="index.php?id=3" button type="submit" class="btn btn-default">Rekap Pendapatan</button></a>
                    <a href="pdf/pdf_srt_permohonan.php" button type="submit" class="btn btn-default">Surat Permohonan</button></a>
                </div>
</body>

</html>
