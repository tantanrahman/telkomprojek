<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
        <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Pendapatan PDAM Finnet
            </h2>
                    <table class="table" border="1" width=100%>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>

                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                    $nilai = $_GET['nilai'];
                    $nilai2 = $_GET['nilai2'];
                        if ($nilai2==null)
                        {
                            $nilai2=$nilai;
                        }
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database) or die("Database tidak bisa dibuka");
                    $c = 0;
                    $query=mysql_query("select * from (select pdam.tanggal as pdtanggal, lokasi.lokasi as pdlokasi, pdam.loket as pdloket, pdam.bill as pdbill, pdam.total_kopeg as pdpendapatan from pdam inner join lokasi on lokasi.loket = pdam.loket) as penpdam where pdtanggal between $nilai AND $nilai2");
                    

                    while($row=mysql_fetch_array($query)){


                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['pdbill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['pdpendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pdlokasi'];?></td>
                            <td><?php echo $row['pdloket'];?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>                       
                        </tr>						
                        <?php
                    }					
                    ?>
						<tr>
                        <th colspan=3>TOTAL TRANSAKSI</th>
                    <?php
						$query_total=mysql_query("select sum(penpdam.pdbill) as sum_pdbill, sum(penpdam.pdpendapatan) as sum_pdpendapatan from (select pdam.tanggal as pdtanggal, lokasi.lokasi as pdlokasi, pdam.loket as pdloket, pdam.bill as pdbill, pdam.total_kopeg as pdpendapatan from pdam inner join lokasi on lokasi.loket = pdam.loket) as penpdam where pdtanggal between $nilai AND $nilai2");
						$row2=mysql_fetch_array($query_total);
        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row2['sum_pdbill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row2['sum_pdpendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?>
						<td align="right"><?php echo $tampildatabayar;?></td>
                        <td  align="right"><?php echo $tampildatabayar2;?></td>				
                    </tr>
                    </table>
			</div>                    
</body>

</html>
