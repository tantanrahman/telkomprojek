<!DOCTYPE html>
<html>

<body>
        <div class="container-fluid">
                <!-- /.row -->
			
            
			<hr>            
			<br></br>
            <div id="pen_pln">
                    <?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    ini_set('display_errors',TRUE);

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
					$tanggal_rk = $_POST["tanggal_rk"];
					$usser_rk = $_POST["usser_rk"];
					$nilai_rk = $_POST["nilai_rk"];
                    $query="insert into rk (tanggal, usser, jumlah_rk) values ('$tanggal_rk','$usser_rk','$nilai_rk');";
					
					if (!mysql_query($query,$konek))
						{
						die('Error: ' . mysql_error());
						}
					else
						{
						echo "1 record added";
						include('insert_rk.php');
						};
                    ?>
            </div>
			</div>        
</body>

</html>
