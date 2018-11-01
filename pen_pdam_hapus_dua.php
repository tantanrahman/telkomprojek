<?php
                    $server   = "localhost";
                    $user     = "root";
                    $password = "";
                    $database = "kopeg";

                    $konek= mysql_connect($server,$user,$password);
                    if (isset($_POST['hapus'])) {
                    	$hapus= $_POST['hapuspdam'];
                    

                    $sql = "delete from pdam where tanggal='$hapus'";

                    mysql_select_db($database);
                    $hapusdata = mysql_query($sql,$konek);

                    if ($hapusdata) {
                    	include "pen_pdam.php";
                    	echo "<center><h2>Data Berhasil Dihapus</h2></center>";

                    }

                    else {
                    	echo "gagal";
                    }

                }


?>