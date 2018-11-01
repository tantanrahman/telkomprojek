<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="index.php?id=143"><span aria-hidden="true">&larr;</span> View Fee PDAM</a></li>
    <li class="next"><a href="index.php?id=146">Hapus Fee PDAM <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
<center>
    <h2 class="page-header">
        Tambah Fee PDAM
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
			<td>PDAM</td>
			<td>:</td>
			<td><input type="text" name="pdam"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Regional</td>
			<td>:</td>
			<td><input type="text" name="regional"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Biaya Admin</td>
			<td>:</td>
			<td><input type="text" name="biaya_admin"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Fee Mitra</td>
			<td>:</td>
			<td><input type="text" name="fee_mitra"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary"></td></tr>
	</table>
	
</form>

<?php
}
	if (isset($_POST['submit']))
	{
	
    	
    	$pdam = $_POST['pdam'];
    	$regional = $_POST['regional'];
    	$biaya_admin = $_POST['biaya_admin'];
    	$fee_mitra = $_POST['fee_mitra'];

    	$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
		
	$insert = " INSERT INTO `kopeg`.`fee_pdam` 
				VALUES ('$pdam','$regional',$biaya_admin,$fee_mitra)";
	$sql=mysqli_query($konek,$insert);
	if ($sql)
	{
		echo "Data berhasil diubah";
		include 'view_fee_pdam.php';

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
		
	}
	
}

?>