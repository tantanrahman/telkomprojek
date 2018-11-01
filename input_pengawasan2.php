<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$tanggal1 = $_POST['nilai'];
$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);

$cari = "select * from pengawasan where tanggal='$tampil_date'";
					$eksekusi = mysql_query($cari);
					$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

?>
<h1>Input Pengawasan</h1>
<form method="POST" action="?id=81"> 
	<table>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><input type="text" name="tanggal" value="<?php echo $tampil_date ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td>Transfer Ke Finnet</td>
			<td>:</td>
			<td><input type="text" name="finnet1" value="<?php echo "{$data[transfer1]}"; ?>"></td>
		</tr>
		<tr>
			<td>Transfer Ke Finnet</td>
			<td>:</td>
			<td><input type="text" name="finnet2" value="<?php echo "{$data[transfer2]}"; ?>"></td>
		</tr>
		<tr>
			<td>Transfer Ke Finnet</td>
			<td>:</td>
			<td><input type="text" name="finnet3" value="<?php echo "{$data[transfer3]}"; ?>"></td>
		</tr>
		<tr>
			<td>Transfer Ke Finnet</td>
			<td>:</td>
			<td><input type="text" name="finnet4" value="<?php echo "{$data[transfer4]}"; ?>"></td>
		</tr>
		<tr>
			<td>Biaya</td>
			<td>:</td>
			<td><input type="text" name="biaya" value="<?php echo "{$data[biaya]}"; ?>"></td>
		</tr>
		<tr>
			<td>Tarik Tunai</td>
			<td>:</td>
			<td><input type="text" name="tarik_tunai" value="<?php echo "{$data[tarik_tunai]}"; ?>"></td>
		</tr>
		<tr>
			<td>Jasa Giro</td>
			<td>:</td>
			<td><input type="text" name="jasa_giro" value="<?php echo "{$data['jasa giro']}"; ?>"></td>
		</tr>
		<tr>
			<td>PPH</td>
			<td>:</td>
			<td><input type="text" name="pph" value="<?php echo "{$data[pph]}"; ?>"></td>
		</tr>
		<tr>
			<td>Kel Giro</td>
			<td>:</td>
			<td><input type="text" name="kel_giro" value="<?php echo "{$data['kel giro']}"; ?>"></td>
		</tr>
	</table>
	<input type="submit" value="Simpan">
</form>