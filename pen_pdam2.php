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
            
        <form action="?id=40" method="POSt">
            
            <input type="hidden" name="nilai" value="<?php echo "$tanggal1";?>">
            <input type="hidden" name="nilai2" value="<?php echo "$tanggal2";?>">
            <center>
                <input type="submit" value="Tampilkan Semua Table" class="btn btn-default">
            </center>
            </form>
			<br></br>
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
                    $fee = $_POST['fee'];
                    $lokasi = $_POST['lokasi'];
                     $fee = $_POST['fee'];
                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                    {

                         if ($lokasi == NULL AND $fee<>NULL)
                        {
                            $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket   where (pdam.tanggal = '$tampil_date' or pdam.tanggal is NULL) AND fee_admin=$fee group by lokasi.lokasi, fee_admin,bill");
                        }
                        else if ($fee == NULL AND $lokasi<>NULL)
                        {
                            $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where (pdam.tanggal = '$tampil_date' or pdam.tanggal is NULL) and lokasi like '%$lokasi%' group by lokasi.lokasi, fee_admin,bill");    
                        }
                        else
                        {
                        $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket  where (pdam.tanggal = '$tampil_date' or pdam.tanggal is NULL) AND fee_admin=$fee and lokasi like '%$lokasi%' group by lokasi.lokasi, fee_admin,bill");
                        }


                    

                    
                    }
                    else
                    {
                         if ($lokasi == null  AND $fee<>NULL)
                        {
                            $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket  where ((pdam.tanggal between '$tanggal1' AND '$tanggal2') or pdam.tanggal is NULL) AND fee_admin=$fee group by lokasi.lokasi, fee_admin,bill");
                        }
                        else if ($fee == NULL  AND $lokasi<>NULL)
                        {
                         $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where ((pdam.tanggal between '$tanggal1' AND '$tanggal2') or pdam.tanggal is NULL)  AND pdlokasi like '%$lokasi%' group by lokasi.lokasi, fee_admin,bill");
                        }
                        else
                        {
                           $query=mysql_query("select lokasi.lokasi as pdlokasi, pdam.tanggal as pdtanggal,  lokasi.loket as pdloket, sum(pdam.bill) as pdbill, sum(pdam.total_kopeg) as pdpendapatan, ceiling(pdam.fee_admin/pdam.bill) as pdfee from lokasi left join pdam on lokasi.loket = pdam.loket where ((pdam.tanggal between '$tanggal1' AND '$tanggal2') or pdam.tanggal is NULL) AND fee_admin=$fee AND pdlokasi like '%$lokasi%' group by lokasi.lokasi, fee_admin,bill");
                        }
                        
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
                <tr><td colspan="3" align="center" class="tx">Jumlah</td><td align="right" class="tx"><?php echo "$tampil1";?></td><td align="right" class="tx"><?php echo "$tampil2";?></td><td align="right" class="tx"><?php echo "$tampil3";?></td>
                <td align="right" class="tx"><?php echo "$tampil4";?></td>
                <td align="right" class="tx"><?php echo "$tampil5";?></td>
                </tr>
            </table>
                
			</div>                    
</body>

</html>
