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
	<hr>
            <nav aria-label="...">
              <ul class="pager">
                <li class="previous"><a href="index.php?id=47"><span aria-hidden="true">&larr;</span> Pilih Tanggal</a></li>
              </ul>
            </nav>
<form action="?id=69" method="POSt">
            <center>
            <table>
                <tr>
                    <td>Lokasi</td><td>:</td><td><input type="text" name="lokasi" class="form-control"></td>
                    <td class="col-md-3"></td>
                    <td>Denom</td><td>:</td><td><input type="text" name="fee" class="form-control"></td>
                </tr>
            </table>
            <input type="hidden" name="nilai" value="<?php echo "$tanggal1";?>">
            <input type="hidden" name="nilai2" value="<?php echo "$tanggal2";?>">
            <input type="submit" value="Filter" class="btn btn-default">
            </form>
            <hr>
            </center>
        <form method="post" action="pen_voucher_edit.php">
            <div>
                    <table id="mytable" class="table table-bordered table-striped table-fixed-header">
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
                           
                            
                            <td class="tx"><?php echo $c=$c+1;?></td>
                            
                            <td class="tx"><?php echo $row['lokasi'];?></td>
                            <td class="tx"><?php echo $row['looket'];?></td>
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
                        <td class="tx" align="center" colspan="4">Jumlah</td>
                        <td class="tx" align="right"><?php echo "$tampil";?></td       >
                        <td class="tx"></td>
                        <td class="tx" align="right"><?php echo "$tampil2";?></td>
                        <td class="tx" align="right"><?php echo "$tampil3";?></td>
                    </tr>
            </table>

                </form>
            </div>
			</div>

                  
</body>

</html>
