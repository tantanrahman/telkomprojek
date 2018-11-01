<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from lokasi where user_id='$edit'";
$eksekusi = mysql_query($query,$koneksi);
$row=mysql_fetch_array($eksekusi,MYSQL_ASSOC);

?>
<style type="text/css">
	table td,th 
	{
		font-size: 12pt!important;
	}
</style>
<?php 
if (isset($_POST['submit']))
	{
	}
	else
	{
		?>
<form method="POST">
	<table  class="table-responsive table-bordered table" >
		<tr style="font-size:12pt!important;">
			<td>Lokasi</td>
			<td>:</td>
			<td><input type="text" name="lokasi" value="<?=$row['lokasi'] ?>">
				<input type="hidden" name="edit" value="<?=$row['user_id'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Loket</td>
			<td>:</td>
			<td><input type="text" name="loket" value="<?=$row['loket'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Tempat</td>
			<td>:</td>
			<td><input type="text" name="tempat" value="<?=$row['tempat'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>User (Khusus Arindo)</td>
			<td>:</td>
			<td><input type="text" name="user" value="<?=$row['user'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Tempat (Khusus Arindo)</td>
			<td>:</td>
			<td><input type="text" name="tempat_arindo" value="<?=$row['tempat_arindo'] ?>"></td>
		</tr>
		
		<tr><td colspan="3"><input type="submit" name="submit"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{
	
    	
    	$lokasi = $_POST['lokasi'];
    	$loket = $_POST['loket'];
    	$tempat = $_POST['tempat'];
    	$user = $_POST['user'];
    	$tempat_arindo = $_POST['tempat_arindo'];

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		$hapus = "DELETE from lokasi where user_id='$edit'";
		
		$eksekusihapus = mysqli_query($konek,$hapus);
	$insert = " INSERT INTO `kopeg`.`lokasi` (lokasi,loket,tempat,user,tempat_arindo) 
				VALUES ('$lokasi','$loket','$tempat','$user','$tempat_arindo')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data berhasil diubah";
		include 'view_lokasi.php';

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
		
	}
	
}

?>