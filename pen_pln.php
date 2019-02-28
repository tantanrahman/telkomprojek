<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
?>
<style type="text/css">
   
   table td
   {    
    font-size: 12px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<?php
$tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];
?>
<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

    <!-- CSS and JS for table fixed header -->
    <link rel="stylesheet" href="table-fixed-header.css">
    <script src="table-fixed-header.js"></script>

</head>
<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
    $('.table-fixed-header').fixedHeader();
    });
  </script>
<body>
        <div class="container-fluid">
                <!-- /.row -->
            
            <h2 align="center">
            Lembar Pendapatan PLN Finnet
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
	<hr>
            <nav aria-label="...">
              <ul class="pager">
                <li class="previous"><a href="index.php?id=2"><span aria-hidden="true">&larr;</span> Pilih Tanggal</a></li>
              </ul>
            </nav>
            <form action="?id=66" method="POSt">
<center>
            <table>
                <tr>
                    <td>Lokasi</td><td>:</td><td><input type="text" name="lokasi" class="form-control"></td>
                    <td class="col-md-3"></td>
                    <td>Fee</td><td>:</td><td><input type="text" name="fee" class="form-control"></td>
                </tr>
            </table>
            <input type="hidden" name="nilai" value="<?php echo "$tanggal1";?>">
            <input type="hidden" name="nilai2" value="<?php echo "$tanggal2";?>">
            <input type="submit" value="Filter" class="btn btn-default">
            </form>
            <hr>
</center>
            </form>
        
        <form method="post" action="pen_pln_edit.php">

            <div id="pen_pln">

                    <table id="mytable" class="table table-bordered table-striped table-fixed-header">
<thead class="header">
                    <tr>
                        
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                        <th>Biaya Admin</th>
                        <th>Fee Mitra</th>
                        <th>Fee Finnet</th>						
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
                    ini_set('display_errors',TRUE);
                    $date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);

                    $tanggal=date("d/m/Y");
                    $koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                    {
                    $query=mysql_query("SELECT lokasi.lokasi, lokasi.loket, pln.tanggal, sum(pln.bill) as bill, sum(pln.total_kopeg) as total_kopeg, ceiling(pln.fee_admin/pln.bill) as bagi,tanggal from lokasi left join pln on lokasi.loket=pln.loket where pln.tanggal = '$tampil_date' or pln.tanggal is NULL  group by lokasi.lokasi, bagi");
                    }
                    else
                    {
                        $query=mysql_query("sselect lokasi.lokasi, lokasi.loket,pln.tanggal, sum(pln.bill) as bill, sum(pln.total_kopeg) as total_kopeg, ceiling(pln.fee_admin/pln.bill) as bagi,tanggal from lokasi left join pln on lokasi.loket=pln.loket where (pln.tanggal between '$tampil_date' AND '$tampil_date2') or pln.tanggal is NULL group by lokasi.lokasi, bagi");
                    }
                    

                    while($row=mysql_fetch_array($query)){
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

//$cari_konpensasipln         = "SELECT nominal as nominal from  k_pln  where loket='{$row['loket']}' and tanggal='$tampil_date'";
//$eksekusipln                = mysql_query($cari_konpensasipln,$koneksi);
//$hasilkonpensasipln         = mysql_fetch_array($eksekusipln,        MYSQL_ASSOC);


if ($row['bagi']==2750)
{
    $fee_mitra = 2000 * $row['bill'];
    $fee_finnet = 800 * $row['bill'];
}
else if ($row['bagi']==3000)
{
    $fee_mitra = 2000 * $row['bill'];
    $fee_finnet = 1000 * $row['bill'];
}
else if ($row['bagi']==5000)
{
    $fee_mitra = 3300 * $row['bill'];
    $fee_finnet = 1700 * $row['bill'];
}
else
{
    $fee_mitra=0;
    $fee_finnet = 0;
}


$tampildatabayar =  number_format($row['total_kopeg'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['bagi'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['bill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($fee_mitra, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($fee_finnet, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


                       ?>
                        <tr>
                           
                            
                            <td><?php echo $c=$c+1;?></td>
                            
                            
                           
                            <td class="tx"><?php echo $row['lokasi'];?></td>
                            <td class="tx"><?php echo $row['loket'];?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            <td align="right"><?php echo $tampildatabayar4;?></td>
                            <td align="right"><?php echo $tampildatabayar5;?></td>

							
                        </tr>
                        <?php
                        $jumlah = $jumlah + $tampildatabayar3;
                        $jumlah2 = $jumlah2 + $row['total_kopeg']+$hasilkonpensasipln['nominal'];
                        $jumlah3 = $jumlah3 + $row['bagi'];
                        $jumlah4 = $jumlah4 + $fee_mitra;
                        $jumlah5 = $jumlah5 + $fee_finnet;
                        
                    }
                    $tampildatabayar4 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampildatabayar5 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampildatabayar6 =  number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampildatabayar7 =  number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr><td colspan="3" align="center" class="tx">Jumlah</td><td align="right" class="tx"><?php echo "$jumlah";?></td><td align="right" class="tx"><?php echo "$tampildatabayar4";?></td><td align="right" class="tx"><?php echo "$tampildatabayar5";?></td>
                <td align="right" class="tx"><?php echo "$tampildatabayar6";?></td><td align="right" class="tx"><?php echo "$tampildatabayar7";?></td>
                </tr>
                </tr>
                    </table>
                </form>
            </div>
			</div>
    
</body>

</html>
