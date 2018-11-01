<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from fee_pdam where pdam='$edit'";
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
			<td>PDAM</td>
			<td>:</td>
			<td><input type="text" name="pdam" value="<?=$row['pdam'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Regional</td>
			<td>:</td>
			<td><input type="text" name="regional" value="<?=$row['regional'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Biaya Admin</td>
			<td>:</td>
			<td><input type="text" name="biaya_admin" value="<?=$row['biaya_admin'] ?>"></td>
		</tr>
		<tr style="font-size:12pt!important;">
			<td>Fee Mitra</td>
			<td>:</td>
			<td><input type="text" name="fee_mitra" value="<?=$row['fee_mitra'] ?>"></td>
		</tr>
		
		
		<tr><td colspan="3"><input type="submit" name="submit"></td></tr>
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
		$hapus = "DELETE from fee_pdam where pdam='$pdam'";
		
		$eksekusihapus = mysqli_query($konek,$hapus);
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