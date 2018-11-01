<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Lembar Pendapatan SOPP Finnet
            </h2>
					
			<form action="filter_pen_sopp.php" method="post">
			Field : <select name="kolom" Size="1">
				<option value = "pensopp.pstanggal"> Tanggal </option>
				<option value = "pensopp.pslokasi"> Lokasi </option>
				<option value = "pensopp.psuser"> Usser </option>
				<option value = "pensopp.psl11"> Jumlah L11 </option>
				<option value = "pensopp.pspendapatan">Pendapatan </option>
				<option value = "pensopp.psadmin"> Admin </option>
			</select>
			
			Value : <input type="text" name="nilai"><br>
			<input type="submit">
			</form>
			
			
			<br></br>
                    <table class="table" border="1" width=100%>
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Loket</th>
                        <th colspan=2>Selisih Tgl 6</th>
                        <th> Pendapatan</th>
                        <th rowspan=2>Sisa Setoran</th>
						<th rowspan=2>RK Tgl 7</th>
						<th colspan=2>Selisih Tgl 6</th>
						<th rowspan=2>Saldo Bank</th>
						
                    </tr>
					<tr>
						<th>Titipan</th>
                        <th>Talangan</th>
						<th>Jumlah</th>
						<th>Titipan</th>
                        <th>Talangan</th>
                    </tr>

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
                    $query=mysql_query("select pengawasan.pwslokasi, pengawasan.pwsjumlah_rk, pengawasan.total_trans, pengawasan.titipan, pengawasan.talangan, pengawasan.total_trans-pengawasan.titipan-pengawasan.talangan as sisa_setoran from (select rekap.pslokasi as pwslokasi, COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0) as total_trans, rekap.jumlah_rk as pwsjumlah_rk, if(rekap.jumlah_rk>COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),rekap.jumlah_rk-COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),0) as titipan, if(rekap.jumlah_rk>COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),0,rekap.jumlah_rk-COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0)) as talangan from ( select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sum(sopp.bill) as psl11, sum(sopp.amount) as pspendapatan, sum(sopp.bill)*kaliuser.xadmin as psadmin, sum(sopp.amount)+sum(sopp.bill)*kaliuser.xadmin as psjumlah, COALESCE(pln.bill, 0) as plbill, COALESCE(pln.total_kopeg, 0) as plpendapatan, COALESCE(pdam.bill, 0) as pdbill, COALESCE(pdam.total_kopeg, 0) as pdpendapatan, COALESCE(rk.jumlah_rk, 0) as jumlah_rk from kaliuser left join sopp on kaliuser.user = sopp.user left join pln on kaliuser.user = pln.loket left join pdam on kaliuser.user = pdam.loket left join rk on kaliuser.user = rk.usser group by kaliuser.user ) as rekap) as pengawasan;");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pwslokasi'];?></td>
							<td><?php echo $row['titipan'];?></td>
							<td><?php echo $row['talangan'];?></td>
							<td><?php echo $row['total_trans'];?></td>
							<td><?php echo $row['sisa_setoran'];?></td>
							<td><?php echo $row['pwsjumlah_rk'];?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
                        <?php
                    }
                    ?>					
                    </table>
					</div>
</body>

</html>
