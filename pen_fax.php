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
            Lembar Pendapatan FAX Finnet
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
                <li class="previous"><a href="index.php?id=51"><span aria-hidden="true">&larr;</span> Pilih Tanggal</a></li>
              </ul>
            </nav>
            <br>
            <table id="mytable" class="table table-bordered table-striped table-fixed-header">
                <thead class="header">
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Usser</th>
                        <th>Fax</th>
                        <th>Lain-lain</th>
	       </tr>
                </thead>

                <tbody>
                    <?php
                    $server     = "localhost";
                    $user       = "root";
                    $password   = "";
                    $database   = "kopeg";
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

                    mysql_select_db($database) or die("Database tidak bisa dibuka");
                    $c = 0;
                     if ($tanggal1==$tanggal2)
                        {
                    $query=mysql_query("select  lokasi.lokasi, fax.tanggal, lokasi.loket, sum(fax.fax) as fax, sum(fax.lainlain) as lainlain from lokasi left join fax on lokasi.lokasi = fax.lokasi where tanggal = '$tampil_date' or tanggal is null group by lokasi");
                        }
                    else
                    {
                        $query=mysql_query("select  lokasi.lokasi, fax.tanggal, lokasi.loket, sum(fax.fax) as fax, sum(fax.lainlain) as lainlain from lokasi left join fax on lokasi.lokasi = fax.lokasi where (tanggal between '$tampil_date' AND '$tampil_date2') or tanggal is null group by lokasi");
                    }
                    while($row=mysql_fetch_array($query)){

                        $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['fax'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['lainlain'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                        <tr>
                                                     
                            <td class="tx"><?php echo $c=$c+1;?></td>
                            <td class="tx"><?php echo $row['lokasi'];?></td>
                            <td class="tx"><?php echo $row['loket'];?></td>
                            <td align="right"><?php echo $tampildatabayar;?></td>
                            <td align="right"><?php echo $tampildatabayar2;?></td>
                        </tr>
                        <?php
                        $jumlah = $jumlah + $row['fax'];
                        $jumlah2 = $jumlah2 + $row['lainlain'];
                    }
                    $tampil = number_format($jumlah,$jumlah_desimal,$pemisah_desimal,$pemisah_ribuan);
                        $tampil2 = number_format($jumlah2,$jumlah_desimal,$pemisah_desimal,$pemisah_ribuan);
                    ?>
                </tbody>
                <tr>
                        <td class="tx" align="center" colspan="3">Jumlah</td>
                        <td class="tx" align="right"><?php echo "$tampil";?></td>
                        <td class="tx" align="right"><?php echo "$tampil2";?></td>
                    </tr>
                    </table>
    
            </div>
    
</body>

</html>
