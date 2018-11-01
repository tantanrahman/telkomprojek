<table class="table-responsive table-bordered table" id="datatable">
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

                    $tanggal1 = $_POST['nilai'];
                    $tanggal2 = $_POST['nilai2'];
                    $fee = $_POST['fee'];
                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    if ($tanggal1==$tanggal2)
                    {
                    $query=mysql_query("select lokasi.lokasi, lokasi.loket,pln.tanggal, pln.bill as bill, pln.total_kopeg as total_kopeg, ceiling(pln.fee_admin/pln.bill) as bagi from lokasi left join pln on lokasi.loket=pln.loket where (pln.tanggal = '$tanggal1' or pln.tanggal is NULL)  and fee_admin=$fee");
                    }
                    else
                    {
                        $query=mysql_query("select lokasi.lokasi, lokasi.loket,pln.tanggal, sum(pln.bill) as bill, sum(pln.total_kopeg) as total_kopeg, sum(ceiling(pln.fee_admin/pln.bill)) as bagi from lokasi left join pln on lokasi.loket=pln.loket where ((pln.tanggal between '$tanggal1' AND '$tanggal2') or pln.tanggal is NULL) and fee_admin=$fee group by lokasi");
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