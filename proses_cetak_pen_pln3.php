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
            Lembar Pendapatan PLN Finnet
            </h2>
            <h2 align="center">
                <?php 
                $tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];
                
                
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
            <div id="pen_pln">

                    <table class="table-responsive table-bordered table" id="datatable" border="1">
                <thead>
                    <tr>
                        
                        <th>No</th>
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
                    $date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                    {
                    $query=mysql_query("select lokasi.lokasi, lokasi.loket,pln.tanggal, sum(pln.bill) as bill, sum(pln.total_kopeg) as total_kopeg, ceiling(pln.fee_admin/pln.bill) as bagi,tanggal from lokasi left join pln on lokasi.loket=pln.loket where pln.tanggal = '$tampil_date' or pln.tanggal is NULL  group by lokasi.lokasi, bagi");
                    }
                    else
                    {
                        $query=mysql_query("sselect lokasi.lokasi, lokasi.loket,pln.tanggal, sum(pln.bill) as bill, sum(pln.total_kopeg) as total_kopeg, ceiling(pln.fee_admin/pln.bill) as bagi,tanggal from lokasi left join pln on lokasi.loket=pln.loket where (pln.tanggal between '$tampil_date' AND '$tampil_date2') or pln.tanggal is NULL group by lokasi.lokasi, bagi");
                    }
                    

                    while($row=mysql_fetch_array($query)){
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['total_kopeg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['bagi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['bill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                           
                            
                            <td><?php echo $c=$c+1;?></td>
                            
                            <td><?php echo $row['lokasi'];?></td>
                            
                            <td><?php echo $row['loket'];?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            
                        </tr>
                        <?php
                        $jumlah = $jumlah + $tampildatabayar3;
                        $jumlah2 = $jumlah2 + $row['total_kopeg'];
                        $jumlah3 = $jumlah3 + $row['bagi'];
                        
                    }
                    $tampildatabayar4 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampildatabayar5 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr><td colspan="3" align="center">Jumlah</td><td align="right"><?php echo "$jumlah";?></td><td align="right"><?php echo "$tampildatabayar4";?></td><td align="right"><?php echo "$tampildatabayar5";?></td>
                </tr>
                </tr>
                    </table>
                </form>
            </div>
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