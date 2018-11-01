<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
?>
<html moznomarginboxes mozdisallowselectionprint>
<body>
<script type="text/javascript">


	window.print();
	window.close();
</script>
<table style="border-collapse:collapse;  width:210mm;">
	<tr>
		<td style="border:solid 1px  width:210mm; word-wrap:break-word;">
			<table>
				<tr>
					<td>
					




        
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
            <table border="1">
                    <thead class="header">
                    <tr>
                        
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Denom</th>
                        <th>Jumlah Lembar</th>
                        <th>Pendapatan</th>
                        <th>Jumlah Pendapatan</th>
                        <th>Fee</th>
                        
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
                    $query=mysql_query("select lokasi.lokasi,lokasi.loket as looket, voucher.tanggal, voucher.loket,  voucher.denom as denom, 
                        sum(voucher.total_kopeg) as total_kopeg1, voucher.total_kopeg as total_kopeg2, count(voucher.denom) as hitung  ,  voucher.user, fee_ca*count(voucher.denom) as fee_ca from lokasi left join voucher on voucher.user=lokasi.loket where tanggal='$tampil_date' or tanggal is NULL group by lokasi, denom");
                        }
                        else
                        {
                         $query=mysql_query("select lokasi.lokasi,lokasi.loket as looket, voucher.tanggal, voucher.loket,  voucher.denom as denom, 
                        sum(voucher.total_kopeg) as total_kopeg1, voucher.total_kopeg as total_kopeg2, count(voucher.denom) as hitung  ,  voucher.user, fee_ca*count(voucher.denom) as fee_ca from lokasi left join voucher on voucher.user=lokasi.loket where ((tanggal  between '$tampil_date' AND '$tampil_date2') or tanggal is NULL) group by lokasi,denom");   
                        }

                    while($row=mysql_fetch_array($query)){
                         $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

$tampildatabayar2 =  number_format($row['total_kopeg1'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['denom'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row['total_kopeg2'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($row['fee_ca'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                           
                            
                            <td><?php echo $c=$c+1;?></td>
                            
                            <td><?php echo $row['lokasi'];?></td>
                            <td><?php echo $row['looket'];?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $row['hitung'];?></td>
                            <td align="right"><?php echo $tampildatabayar4;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            <td align="right"><?php echo $tampildatabayar5;?></td>
                            
                        </tr>
                        <?php
                        $jumlah = $jumlah + $row['hitung'];
                        $jumlah2 = $jumlah2 + $row['total_kopeg1'];
                        $jumlah3 = $jumlah3 + $row['fee_ca'];
                    }
                    $tampil =  number_format($jumlah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil2 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil3 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr>
                        <td align="center" colspan="4">Jumlah</td>
                        <td align="right"><?php echo "$tampil";?></td       >
                        <td></td>
                        <td align="right"><?php echo "$tampil2";?></td>
                        <td align="right"><?php echo "$tampil3";?></td>
                        
                        
                    </tr>
                    </table>

                </form>
            </div>
            
			<table>
            <tr><td height="30px"></td></tr>
            <tr><td colspan="4"></td><td>Bandung, ....................</td></tr>
            <tr><td>Mengetahui</td><td></td><td></td><td></td><td>Yang Membuat</td></tr>
            <tr><td height="125px"></td></tr>
            
            <tr><td colspan="4"></td><td>...............................</td></tr>
            </table>  







					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>