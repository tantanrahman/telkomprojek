<!DOCTYPE html>
<html lang="en">

<head>
    <link href='assets/images/icon.png' rel='shortcut icon'>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kopeg 1.01</title>

    <script type="text/javascript" src="assets/bootstrap/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/morris.min.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/bootstrap/js/plugins/morris/morris-data.js"></script>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/sb-admin.css" rel="stylesheet">
    <link href="assets/bootstrap/css/plugins/morris.css" rel="stylesheet">  
    <link href="assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
            <div class="container-fluid">
                <!-- /.row -->

                <h2 align="center">
                    Rekap Pendapatan Loket
                    </h2>

                    <table class="table" border="1" width=100%>
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>USER / LOKER SOPP</th>
                        <th colspan=4>JASTEL</th>
                        <th colspan=2>PLN</th>
                        <th colspan=2>PDAM</th>
                        <th colspan=2>TRANSAKSI ARINDO</th>
						<th rowspan=2>Total Trans</th>
						<th rowspan=2>RK Tangal</th>
						<th colspan=2>Selisih Tangal</th>
					</tr>
                    <tr>
						<th>L11</th>
						<th>Pendapatan</th>
						<th>Admin Jastel</th>
						<th>Jumlah Jastel</th>
						<th>Lbr</th>
						<th>Pendapatan</th>
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
                    $query=mysql_query("select * from lokasi inner join pln on lokasi.loket = pln.loket");
                    

                    while($row=mysql_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $c=$c+1;?></td>
                            <td><?php echo $row['lokasi'];?></td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
                            <td><?php echo $row['bill'];?></td>
                            <td><?php echo $row['total_kopeg'];?></td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>
							<?php  
								$jumlah_jastel = 0;
								$total_trans = $row['total_kopeg'] + $jumlah_jastel;
								echo $total_trans;
								?></td>
							<td>0</td>
							<td>0</td>
							<td>
							<?php echo $total_trans; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
						<tr>
							<td colspan=2> Total</th>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>
								<?php 
								$result=mysql_query('select sum(bill) as sum_bill from pln'); 
								$row = mysql_fetch_assoc($result); 
								$sum = $row['sum_bill'];
								echo $sum;
								?></td>
							<td>
								<?php 
								$result=mysql_query('select sum(amount) as sum_amount from pln'); 
								$row = mysql_fetch_assoc($result); 
								$sum = $row['sum_amount'];
								echo $sum;
								?></td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
                    </table>

                </div>
</body>

</html>
