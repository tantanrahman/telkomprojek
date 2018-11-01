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
            <table class="table" border="1" width=100%>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>User</th>
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

                    $nilai = $_GET['nilai'];
                    $nilai2 = $_GET['nilai2'];

                    if ($nilai2==null)
                    {
                        $nilai2= $nilai;
                    }

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    $query=mysql_query("select * from (select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sopp.user as psuser, sum(bill) as psl11, sum(amount) as pspendapatan, sum(bill)*kaliuser.xadmin as psadmin, sum(amount)+sum(bill)*kaliuser.xadmin as psjumlah from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as pensopp where pstanggal between '$nilai' AND '$nilai2'");

                    while($row=mysql_fetch_array($query)){
                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['psl11'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['pspendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['psadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row['psjumlah'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pslokasi'];?></td>
                            <td><?php echo $row['psuser'];?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
							<td align="right"><?php echo $tampildatabayar3;?></td>
							<td align="right"><?php echo $tampildatabayar4;?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>
					<tr>
                        <th colspan=3>TOTAL TRANSAKSI</th>
                    <?php
						$query_total=mysql_query("select sum(pensopp.psl11) as sum_psl11, sum(pensopp.pspendapatan) as sum_pspendapatan, sum(pensopp.psadmin) as sum_psadmin, sum(pensopp.psjumlah) as sum_psjumlah from (select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sopp.user as psuser, sum(bill) as psl11, sum(amount) as pspendapatan, sum(bill)*kaliuser.xadmin as psadmin, sum(amount)+sum(bill)*kaliuser.xadmin as psjumlah from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as pensopp where pstanggal between '$nilai' AND '$nilai2'");
						$row2=mysql_fetch_array($query_total);
                $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row2['sum_psl11'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row2['sum_pspendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row2['sum_psadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row2['sum_psjumlah'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?>
						<td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $tampildatabayar4;?></td>
                    </tr>
                    </table>
					</div>

</body>

</html>
