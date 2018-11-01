<?php 

					$server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");
                    if (isset($_POST['edit'])) {
                    	$edit = $_POST['ubah'];
                 
                   
                    $sql="select pln.id, lokasi.lokasi, pln.tanggal, pln.loket, pln.bill, pln.total_kopeg, ceiling(pln.fee_admin/pln.bill) from pln inner join lokasi on lokasi.loket = pln.loket where pln.id = '$edit'";
                    	 mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");

                    	 $ambildata=mysql_query($sql,$konek);
                   	echo "<form method=post action='ubah_pen_pln.php'>";
                    	 echo "<table>";
                    	  while($row=mysql_fetch_array($ambildata, MYSQL_ASSOC)){
                        ?>

                        <tr>
                            <td>ID</td><td><input type="text" name="id" value="<?php echo $row['id'];?>" readonly=readonly></td>
                            <td>Lokasi</td><td><input type="text" name="lokasi" value="<?php echo $row['lokasi'];?>"readonly=readonly></td>
                            <td>User</td><td><input type="text" name="user" value="<?php echo $row['loket'];?>"readonly=readonly></td>
                            <td>Jumlah Pendapatan</td><td><input type="text" name="jum_pen" value="<?php echo $row['bill'];?>"></td>
                            <td>Jumlah Lembar</td><td><input type="text" name="jum_lem" value="<?php echo $row['total_kopeg'];?>"></td>
                            <td>Fee</td><td><input type="text" name="fee" value="<?php echo $row['ceiling(pln.fee_admin/pln.bill)'];?>"></td>
                        </tr>

                        <?php
                        
                    }
                    ?>
                    <input type="submit" name="ubah" value="ubahdong">
                    <?php  

                    }



 ?>