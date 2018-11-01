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
            Lembar Pendapatan PDAM Finnet
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
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                        <th>Biaya Admin</th>
                        <th>Fee Mitra</th>
                        <th>Jumlah Fee Mitra</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $server = "localhost";
                    $user = "root";
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

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                    {
                    $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where pdam.tanggal = '$tampil_date' or pdam.tanggal is NULL group by lokasi.lokasi, fee_admin,bill");

                    
                    }
                    else
                    {
                        $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where (pdam.tanggal between '$tampil_date' AND '$tampil_date2') or pdam.tanggal is NULL group by lokasi.lokasi, fee_admin,bill");
                    }

                    while($row=mysql_fetch_array($query)){
                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar3 =  number_format($row['pdbill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar =  number_format($row['pdpendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['pdfee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

if ($row['pdfee']==2000)
{
    $fee_mitra = 1000;
    $jumlah_fee_mitra = $fee_mitra * $row['pdbill'];
}
else if ($row['pdfee']==2800)
{
    $fee_mitra = 800;
    $jumlah_fee_mitra = $fee_mitra * $row['pdbill'];
}
else if ($row['pdfee']==2500)
{
    $fee_mitra = 1500;
    $jumlah_fee_mitra = $fee_mitra * $row['pdbill'];
}
else
{
    $fee_mitra=0;
    $jumlah_fee_mitra = 0;
}

$tampildatabayar4 =  number_format($fee_mitra, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($jumlah_fee_mitra, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            
                            <td><?php echo $row['pdlokasi'];?></td>

                            <td><?php echo $row['pdloket'];?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>                       
                            <td align="right"><?php echo $tampildatabayar4;?></td>
                            <td align="right"><?php echo $tampildatabayar5;?></td>  
                        </tr>                       
                        <?php
                        $jumlah1 = $jumlah1 + $row['pdbill'];
                        $jumlah2 = $jumlah2 + $row['pdpendapatan'];
                        $jumlah3 = $jumlah3 + $row['pdfee'];
                        $jumlah4 = $jumlah4 + $fee_mitra;
                        $jumlah5 = $jumlah5 + $jumlah_fee_mitra;
                    }               
                    $tampil1 =  number_format($jumlah1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil2 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil3 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil4 =  number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil5 =  number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr><td colspan="3" align="center">Jumlah</td><td align="right"><?php echo "$tampil1";?></td><td align="right"><?php echo "$tampil2";?></td><td align="right"><?php echo "$tampil3";?></td>
                <td align="right"><?php echo "$tampil4";?></td>
                <td align="right"><?php echo "$tampil5";?></td>
                </tr>
            </table>
                
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