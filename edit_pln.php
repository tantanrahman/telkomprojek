<?php

$server = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "kopeg";

                    //$tanggal1 = $_POST['nilai'];
                    $tanggal1 = "26-01-2016";
                    //$user = $_POST['user'];
                    $loket = 'cijaura';
                    ini_set('display_errors',TRUE);
                    $date = explode("-", $tanggal1);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $tampil_date = implode("-", $arr);
                   

                    $tanggal=date("d/m/Y");
                        
                    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

                    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
                    $c = 0;
                    
                    $query=mysql_query("select * from pln where tanggal='$tampil_date' AND loket like '%$loket%' ");


                    ?>

                    <table>
                    	<tr>
                    		<td>Tanggal</td>
                    		<td>Divre</td>
                    		<td>Kode Kopegtel</td>
                    		<td>Kopegtel</td>
                    		<td>Loket</td>
                    		<td>Nomor</td>
                    		<td>Transaksi</td>
                    		<td>Bill</td>
                    		<td>Amount</td>
                    		<td>Fee Admin</td>
                    		<td>Total Kopeg</td>
                    	</tr>
                    

                    <?php

                    while ($row=mysql_fetch_array($query,MYSQL_ASSOC)) 
                    {
                    	?>

                    		<tr>
                    			<td><input type='text' readonly='readonly' name='tanggal' value='<?php echo "{$row['tanggal']}"; ?>'></td>
                    			<td><input type='text' name='divre' value='<?php echo "{$row['divre']}"; ?>'></td>
                    			<td><input type='text' name='kode_kopegtel' value='<?php echo "{$row['kode_kopegtel']}"; ?>'></td>
                    			<td><input type='text' name='kopegtel' value='<?php echo "{$row['kopegtel']}"; ?>'></td>
                    			<td><input type='text' name='loket' value='<?php echo "{$row['loket']}"; ?>'></td>
                    			<td><input type='text' name='nomor' value='<?php echo "{$row['nomor']}"; ?>'></td>
                    			<td><input type='text' name='trx' value='<?php echo "{$row['trx']}"; ?>'></td>
                    			<td><input type='text' name='bill' value='<?php echo "{$row['bill']}"; ?>'></td>
                    			<td><input type='text' name='amount' value='<?php echo "{$row['amount']}"; ?>'></td>
                    			<td><input type='text' name='fee_admin' value='<?php echo "{$row['fee_admin']}"; ?>'></td>
                    			<td><input type='text' name='total_kopeg' value='<?php echo "{$row['total_kopeg']}"; ?>'></td>
                    		</tr>
                    	<?php
                    }
                    
                    

?>
</table>