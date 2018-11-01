    <!DOCTYPE html>
    <html lang="en">

    <head>

    </head>

    <body>
        <div class="container-fluid">                
            <h2 align="center">
                Lembar Pendapatan SOPP Finnet
            </h2>
        <hr>            
        <center>
            <form action="index.php?id=25" method="post">
                <table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="hapussopp" placeholder="Tanggal Laporan">
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" class="btn btn-danger" name="hapus" value="Hapus Laporan">
                <br>
            </form>
        </center>
                
                <br></br>
                        <table class="table-responsive table-bordered table" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Usser</th>
                            <th>Jumlah L11</th>
                            <th>Pendapatan</th>
                            <th>Admin</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $server = "localhost";
                        $user = "root";
                        $password = "";
                        $database = "kopeg";

                        ini_set('display_errors',TRUE);

                        $tanggal=date("d/m/Y");
                            
                        $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                        mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                        $c = 0;
                        $query=mysql_query("select * from (select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sopp.user as psuser, sum(bill) as psl11, sum(amount) as pspendapatan, sum(bill)*kaliuser.xadmin as psadmin, sum(amount)+sum(bill)*kaliuser.xadmin as psjumlah from sopp inner join kaliuser on kaliuser.user = sopp.user group by sopp.user) as pensopp;");
                        

                        while($row=mysql_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?php echo $c=$c+1;?></td>
                                <td><?php echo $row['pstanggal'];?></td>
                                <td><?php echo $row['pslokasi'];?></td>
                                <td><?php echo $row['psuser'];?></td>
                                <td><?php echo $row['psl11'];?></td>
                                <td><?php echo $row['pspendapatan'];?></td>
                                <td><?php echo $row['psadmin'];?></td>
                                <td><?php echo $row['psjumlah'];?></td>
                           
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                        </div>
    </body>

    </html>
