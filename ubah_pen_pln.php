<?php  
					$server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    $konek = mysqli_connect($server,$user,$password,$database) or die("Koneksi gagal");
                    if (isset($_POST['ubah'])) {
                    	$id = $_POST['id'];
                    	$jum_pen = $_POST['jum_pen'];
                    	$jum_lem = $_POST['jum_lem'];
                    	
                 
                    $sql="update pln set pln.total_kopeg='$jum_pen', pln.bill='$jum_lem' where id='$id'";
                    	 
                    $sql2=mysqli_query($konek,$sql);
                    
                    if ($sql2) {
                    	echo "Berhasil";

                    }
                    else 
                    {
                    	echo "gagal";
                    	echo "$sql";
                    }
                }

?>