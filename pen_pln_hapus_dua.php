<?php
                    $server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    $konek= mysql_connect($server,$user,$password);
                    if (isset($_POST['hapus'])) {
                    	$hapus= $_POST['hapuspln'];
                    

                    $sql = "delete from pln where tanggal='$hapus'";

                    mysql_select_db($database);
                    $hapusdata = mysql_query($sql,$konek);

                    if ($hapusdata) {
                    	include "pen_pln.php";
                    	echo "<center><h2>Data Berhasil Dihapus</h2></center>";

                    }

                    else {
                    	echo "gagal";
                    }

                }


?>