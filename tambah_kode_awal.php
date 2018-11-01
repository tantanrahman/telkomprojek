<center>
    <h2 class="page-header">
        Tambah Kode Awal
    </h2>
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
			<td>Nomor Awal</td>
			<td>:</td>
			<td><input type="text" name="nomor_awal"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Produk *Harus sesuai dengan produk pada bagian harga pulsa*</td>
			<td>:</td>
			<td><input type="text" name="produk"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary"></td></tr>
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
		
	$insert = " INSERT INTO `kopeg`.`kode_awal` 
				VALUES ('$nomor_awal','$produk')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data berhasil ditambah";
		

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
	}
	
}

?>