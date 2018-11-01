
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
$tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];

if ($tanggal1 == $tanggal2)
{
header("Content-Disposition: attachment; filename=PDAM-$tanggal1.xls");
}
else
{
header("Content-Disposition: attachment; filename=PDAM-$tanggal1-$tanggal2.xls");    
}
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
            <hr>
            <nav aria-label="...">
              <ul class="pager">
                <li class="previous"><a href="index.php?id=39"><span aria-hidden="true">&larr;</span> Pilih Tanggal</a></li>
              </ul>
            </nav>
            <form action="?id=67" method="POST">
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

                    <table id="mytable" class="table table-bordered table-striped table-fixed-header">
                    <thead class="header">
                    <tr>
                        <th>No</th>

                        
                        <th>Usser</th>
                        <th>Jumlah Lembar</th>
                        <th>Jumlah Pendapatan</th>
                        <th>Biaya Admin</th>
                        <th>Fee Mitra</th>
                        <th>Pendapatan Murni</th>
                        
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
                   
                    $query=mysql_query("SELECT pdam.loket AS pdloket, pdam.`bill`AS pdbill, pdam.`total_kopeg` AS pdpendapatan,fee_pdam.`biaya_admin` AS pdadmin, fee_pdam.`fee_mitra` AS pdfee
                FROM pdam JOIN fee_pdam ON pdam.`nama_area`=fee_pdam.`pdam` AND tanggal BETWEEN'$tampil_date' AND '$tampil_date2'");

                    
                   

                    while($row=mysql_fetch_array($query)){
                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";



$tampildatabayar3 =  number_format($row['pdbill'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar =  number_format($row['pdpendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['pdfee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);



$tampildatabayar4 =  number_format($row['pdadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($jumlah_fee_mitra, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar6 =  number_format($row['pdpendapatan']-$row['pdfee'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

                        ?>
                        <tr>
                            <td class="tx"><?php echo $c=$c+1;?></td>

                            <td class="tx"><?php echo $row['pdloket'];?></td>
                            <td align="right"><?php echo $tampildatabayar3;?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar4;?></td>                       
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                            <td align="right"><?php echo $tampildatabayar6;?></td>
                              
                        </tr>                       
                        <?php
                        $jumlah1 = $jumlah1 + $row['pdbill'];
                        $jumlah2 = $jumlah2 + $row['pdpendapatan'];
                        $jumlah3 = $jumlah3 + $row['pdfee'];
                        $jumlah4 = $jumlah4 + $row['pdadmin'];
                        $jumlah5 = $jumlah5 + $row['pdpendapatan']-$row['pdfee'];
                    }               
                    $tampil1 =  number_format($jumlah1, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil2 =  number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil3 =  number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil4 =  number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    $tampil5 =  number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                    ?>
                </tbody>
                <tr><td colspan="2" align="center" class="tx">Jumlah</td><td align="right" class="tx"><?php echo "$tampil1";?></td><td align="right" class="tx"><?php echo "$tampil2";?></td><td align="right" class="tx"><?php echo "$tampil4";?></td>
                <td align="right" class="tx"><?php echo "$tampil3";?></td>
                <td align="right" class="tx"><?php echo "$tampil5";?></td>
                </tr>
            </table>
                
            </div>                    
</body>

</html>
