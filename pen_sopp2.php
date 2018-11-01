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
            Lembar Pendapatan SOPP Finnet
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
        

        <form action="?id=44" method="POSt">
            
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
                            <th>User</th>
                            <th>Jumlah L11</th>
                            <th>Pendapatan</th>
                            <th>Admin</th>
                            <th>Fee</th>
                            <th>JUMLAH</th>
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
                                $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND (tanggal='$tampil_date' or tanggal is NULL) AND fee_admin=$fee ) as B 
on A.lokasi=B.pslokasi
");
                            }
                            else if ($fee == NULL AND $lokasi<>NULL)
                            {
                            $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND (tanggal='$tampil_date' or tanggal is NULL) ) as B 
on A.lokasi=B.pslokasi AND A.lokasi like '%$lokasi%'
");
                            }
                            else
                            {
                            $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND (tanggal='$tampil_date' or tanggal is NULL) AND fee_admin=$fee ) as B 
on A.lokasi=B.pslokasi AND A.lokasi like '%$lokasi%'
");
                            }




                        
                        }
                        else
                        {
                                if ($lokasi == NULL AND $fee<>NULL)
                            {
                                $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND ((tanggal between '$tampil_date' AND '$tampil_date2') or tanggal is NULL) AND fee_admin=$fee ) as B 
on A.lokasi=B.pslokasi
");
                            }
                            else if ($fee == NULL AND $lokasi<>NULL)
                            {
                            $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND ((tanggal between '$tampil_date' AND '$tampil_date2') or tanggal is NULL) ) as B 
on A.lokasi=B.pslokasi AND A.lokasi like '%$lokasi%'
");
                            }
                            else
                            {
                            $query=mysql_query("select * from 
(select lokasi.lokasi,lokasi.loket,sopp.user as user from lokasi left join sopp on lokasi.loket = sopp.user group by lokasi.lokasi) as A 
inner join 
(select sopp.tanggal as pstanggal,sopp.fee_admin as fee_admin, kaliuser.lokasi as pslokasi, kaliuser.user as psloket, sopp.user as psuser, bill as psl11, amount as pspendapatan, bill*kaliuser.xadmin as psadmin, amount+bill*kaliuser.xadmin as psjumlah from kaliuser left join sopp on kaliuser.user = sopp.user AND ((tanggal between '$tampil_date' AND '$tampil_date2') or tanggal is NULL) AND fee_admin=$fee ) as B 
on A.lokasi=B.pslokasi AND A.lokasi like '%$lokasi%'
");
                            }


                        }

                        while($row=mysql_fetch_array($query)){
                            $jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampildatabayar =  number_format($row['pspendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar2 =  number_format($row['psadmin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar3 =  number_format($row['psjumlah'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar4 =  number_format($row['psl11'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampildatabayar5 =  number_format($row['fee_admin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                            ?>
                            <tr>
                                <td><?php echo $c=$c+1;?></td>
                                
                                <td><?php echo $row['lokasi'];?></td>
                                <td><?php echo $row['loket'];?></td>
                                <td align="right"><?php echo $tampildatabayar4;?></td>
                                <td align="right"><?php echo $tampildatabayar;?></td>
                                <td align="right"><?php echo $tampildatabayar2;?></td>
                                <td align="right"><?php echo $tampildatabayar5;?></td>
                                <td align="right"><?php echo $tampildatabayar3;?></td>
                           
                            </tr>
                            <?php
                        $jumlah = $jumlah + $row['psl11'];
                        $jumlah2 = $jumlah2 + $row['pspendapatan'];
                        $jumlah3 = $jumlah3 + $row['psadmin'];
                        $jumlah4 = $jumlah4 + $row['psjumlah'];
                        $jumlah5 = $jumlah5 + $row['fee_admin'];
                        }
                        $tampil = number_format($jumlah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        $tampil2 = number_format($jumlah2, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        $tampil3 = number_format($jumlah3, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        $tampil4 = number_format($jumlah4, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        $tampil5 = number_format($jumlah5, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
                        ?>
                    </tbody>
                    <tr>
                        <td class="tx" align="center" colspan="3">Jumlah</td>
                        <td class="tx" align="right"><?php echo "$tampil";?></td>
                        <td class="tx" align="right"><?php echo "$tampil2";?></td>
                        <td class="tx" align="right"><?php echo "$tampil3";?></td>
                        <td class="tx" align="right"><?php echo "$tampil5";?></td>
                        <td class="tx" align="right"><?php echo "$tampil4";?></td>
                    </tr>

                </table>
                    
                        </div>
    </body>

    </html>

