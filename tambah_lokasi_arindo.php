
<center>
    <h2 class="page-header">
        Tambah Lokasi Arindo
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
			<td>Kode User</td>
			<td>:</td>
			<td><input type="text" name="kode_user"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>User</td>
			<td>:</td>
			<td><input type="text" name="user"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Tempat</td>
			<td>:</td>
			<td><input type="text" name="tempat"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{

    	$kode_user = $_POST['kode_user'];
    	$user = $_POST['user'];
    	$tempat = $_POST['tempat'];

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		
	$insert = " INSERT INTO `kopeg`.`arindo_tempat`
				VALUES ('$user','$kode_user','$tempat')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data berhasil diubah";
		include 'view_lokasi_arindo.php';

	}
	else
	{
		echo "Data Gagal Disimpan.";
		echo mysqli_error();
		
		
	}
	
}

?>