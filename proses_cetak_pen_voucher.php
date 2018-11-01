
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
$tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];

if ($tanggal1 == $tanggal2)
{
header("Content-Disposition: attachment; filename=Voucher-$tanggal1.xls");
}
else
{
header("Content-Disposition: attachment; filename=Voucher-$tanggal1-$tanggal2.xls");    
}
?>
<html>

<body>
        <div class="container-fluid">
                <!-- /.row -->
			<h2 align="center">
            Lembar Pendapatan Voucher Finnet
            </h2>
            <h2 align="center">
                <?php 
                            if ($tanggal1==$tanggal2)
                            {
                               echo $tanggal1; 
                            }
                            else
                            {
                                echo "$tanggal1 - $tanggal2";
                            }
                            ?>
            </h2>
            
        <form method="post" action="pen_voucher_edit.php">
            <div>
                    <table class="table-responsive table-bordered table" id="datatable" border="1">
                <thead>
                    <tr>
                        
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                        
                    </tr>
                </thead>

                <tbody>
                <?php
                    $server   = "localhost";
                    $user     = "root";
                    $password = "";
                    $database = "kopeg";
                    $tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];

                    $date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);

                    ini_set('display_errors',TRUE);
                     
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                        {
                    $query=mysql_query("select lokasi.lokasi,lokasi.loket as looket, voucher.tanggal, voucher.loket,  sum(voucher.denom) as denom, 
                        sum(voucher.total_kopeg) as total_kopeg, count(voucher.denom) as hitung  ,  voucher.user from lokasi left join voucher on voucher.user=lokasi.loket where tanggal='$tampil_date' or tanggal is NULL group by lokasi");
                        }
                        else
                        {
                         $query=mysql_query("select lokasi.lokasi,lokasi.loket as looket, voucher.tanggal, voucher.loket,  sum(voucher.denom) as denom, 
                        sum(voucher.total_kopeg) as total_kopeg, count(voucher.denom) as hitung  , voucher.user from lokasi left join voucher on voucher.user=lokasi.loket where (tanggal  between '$tampil_date' AND '$tampil_date2') or tanggal is NULL group by lokasi");   
                        }

                    while($row=mysql_fetch_array($query)){
                         $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

$tampildatabayar2 =  number_format($row['total_kopeg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                           
                            
                            <td><?php echo $c=$c+1;?></td>
                            
                            <td><?php echo $row['lokasi'];?></td>
                            <td><?php echo $row['looket'];?></td>
                            
                            <td align="right"><?php echo $row['hitung'];?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            
                        </tr>
                        <?php
                        $jumlah = $jumlah + $row['hitung'];
                        $jumlah2 = $jumlah2 + $row['total_kopeg'];
                    }
                    $tampil =  number_format($jumlah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil2 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr>
                        <td align="center" colspan="3">Jumlah</td>
                        <td align="right"><?php echo "$tampil";?></td>
                        <td align="right"><?php echo "$tampil2";?></td>
                        
                        
                    </tr>
                    </table>
                </form>
            </div>
			</div>
            <table>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td colspan="4"></td><td>Bandung, ....................</td></tr>
            <tr><td>Mengetahui</td><td></td><td></td><td></td><td>Yang Membuat</td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td height="125px"></td></tr>
            <tr><td colspan="4"></td><td>...............................</td></tr>
            </table>

                  
</body>

</html>
