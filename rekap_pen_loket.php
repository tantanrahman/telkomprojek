<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->
			
            <h2 align="center">
            Rekap Keuangan
            </h2>
            <hr>
					
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
                    <table class="table-responsive table-bordered table" border="1" width=100%>
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Loker SOPP</th>
                        <th colspan=3>JASTEL</th>
                        <th colspan=2>PLN</th>
                        <th colspan=2>PDAM</th>
						<th colspan=2>ARINDO</th>
						<th rowspan=2>Total Trans</th>
						<th rowspan=2>RK Tanggal</th>
						<th colspan=2>Selisih</th>
						
                    </tr>
					<tr>
						<th>Pendapatan</th>
						<th>Fee Non Admin</th>
						<th>Admin Jastel</th>
						<th>Pendapatan</th>
                        <th>Fee</th>
						<th>Lbr</th>
                        <th>Pendapatan</th>
						<th>L11</th>
                        <th>Pendapatan</th>
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
                    $query=mysql_query("select rekap.pslokasi, rekap.psl11, rekap.pspendapatan, rekap.psadmin, rekap.psjumlah, rekap.fee_admin, rekap.plpendapatan, rekap.pdbill, rekap.pdpendapatan, COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0) as total_trans, rekap.jumlah_rk, if(rekap.jumlah_rk>COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),rekap.jumlah_rk-COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),0) as titipan, if(rekap.jumlah_rk>COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0),0,rekap.jumlah_rk-COALESCE(rekap.psjumlah+rekap.plpendapatan+rekap.pdpendapatan,0)) as talangan from ( select sopp.tanggal as pstanggal, kaliuser.lokasi as pslokasi, sum(sopp.bill) as psl11, sum(sopp.amount) as pspendapatan, sum(sopp.bill)*kaliuser.xadmin as psadmin, sum(sopp.amount)+sum(sopp.bill)*kaliuser.xadmin as psjumlah, COALESCE(pln.fee_admin, 0) as fee_admin, COALESCE(pln.total_kopeg, 0) as plpendapatan, COALESCE(pdam.bill, 0) as pdbill, COALESCE(pdam.total_kopeg, 0) as pdpendapatan, COALESCE(rk.jumlah_rk, 0) as jumlah_rk from kaliuser left join sopp on kaliuser.user = sopp.user left join pln on kaliuser.user = pln.loket left join pdam on kaliuser.user = pdam.loket left join rk on kaliuser.user = rk.usser group by kaliuser.user ) as rekap");
                    

                    while($row=mysql_fetch_array($query)){
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";
$tampilplpendapatan =  number_format($row['plpendapatan'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
$tampilfeeadmin =  number_format($row['fee_admin'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

                        ?>

                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['pslokasi'];?></td>
                            
                            <td><?php echo $row['pspendapatan'];?></td>
							<td><?php if ($row['pslokasi']=="LEMBONG 1" OR $row['pslokasi']=="LEMBONG 2" OR $row['pslokasi']=="LEMBONG 3" OR $row['pslokasi']=="SETIABUDI 1" OR $row['pslokasi']=="SETIABUDI 2")
										{ echo $row['psl11'] * 1650; }
										else{ echo "-";
									echo "<br>".$row['pslokasi'];}
											?></td>
										
							<td><?php echo $row['psadmin'];?></td>
							
							<td align="right"><?php if ($row['plpendapatan'] == 0) 
									{ echo "-";}
									else {
							echo $tampilplpendapatan;}?></td>
							<td align="right"><?php if ($row['fee_admin'] == 0) 
									{ echo "-";}
									else {
									echo $tampilfeeadmin;}?></td>
							<td><?php echo $row['pdbill'];?></td>
							<td><?php echo $row['pdpendapatan'];?></td>
							<td></td>
							<td></td>
							<td><?php echo $row['total_trans'];?></td>
							<td><?php echo $row['jumlah_rk'];?></td>
							<td><?php echo $row['titipan'];?></td>
							<td><?php echo $row['talangan'];?></td>
                       
                        </tr>
                        <?php
                    }
                    ?>					
                    </table>
					</div>
</body>

</html>
