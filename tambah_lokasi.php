
<center>
    <h2 class="page-header">
        Tambah Lokasi
    </h2>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
?>
<style type="text/css">
	table td,th 
	{
		font-size: 11pt!important;
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
			<td><input type="text" name="lokasi"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Loket</td>
			<td>:</td>
			<td><input type="text" name="loket"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Tempat</td>
			<td>:</td>
			<td><input type="text" name="tempat"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>User (Khusus Arindo)</td>
			<td>:</td>
			<td><input type="text" name="user"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Tempat (Khusus Arindo)</td>
			<td>:</td>
			<td><input type="text" name="tempat_arindo"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary"></td></tr>
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
		echo mysqli_error();
		
		
	}
	
}

?>