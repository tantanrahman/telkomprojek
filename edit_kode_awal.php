<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from kode_awal where nomor_awal='$edit'";
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
			<td>Nomor Awal</td>
			<td>:</td>
			<td><input type="text" name="nomor_awal" value="<?=$row['nomor_awal'] ?>" readonly="readonly"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Produk *Harus sesuai dengan produk pada bagian harga pulsa*</td>
			<td>:</td>
			<td><input type="text" name="produk" value="<?=$row['produk'] ?>"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{
	
    	$nomor_awal=$_POST['nomor_awal'];
    	$produk = $_POST['produk'];

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		$hapus = "DELETE from kode_awal where nomor_awal='$nomor_awal'";
		
		$eksekusihapus = mysqli_query($konek,$hapus);
	$insert = " INSERT INTO `kopeg`.`kode_awal` 
				VALUES ('$nomor_awal','$produk')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data berhasil diubah";
		include 'view_kode_awal.php';

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
	}
	
}

?>