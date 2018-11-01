<center>
    <h2 class="page-header">
        Tambah Harga Pulsa
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
			<td>Kode Pulsa</td>
			<td>:</td>
			<td><input type="text" name="kode_pulsa"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Produk *Harus sesuai dengan produk pada bagian kode awal*</td>
			<td>:</td>
			<td><input type="text" name="produk"></td>
		</tr>

		<tr style="font-size:12pt!important;">
			<td>Harga Arindo</td>
			<td>:</td>
			<td><input type="text" name="harga_arindo"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Harga Jual</td>
			<td>:</td>
			<td><input type="text" name="harga_jual"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Fee Kopeg</td>
			<td>:</td>
			<td><input type="text" name="fee_kopeg"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Penyedia</td>
			<td>:</td>
			<td><input type="text" name="penyedia"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{
	
    	$kode_pulsa=$_POST['kode_pulsa'];
    	$produk = $_POST['produk'];
    	$harga_arindo = $_POST['harga_arindo'];
    	$harga_jual = $_POST['harga_jual'];
    	$fee_kopeg = $_POST['fee_kopeg'];
    	$penyedia = $_POST['penyedia'];

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		
	$insert = " INSERT INTO `kopeg`.`harga_pulsa` 
				VALUES ('$kode_pulsa','$produk',$harga_arindo,$harga_jual,$fee_kopeg,'$penyedia')";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data Disimpan";
		

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
	}
	
}

?>