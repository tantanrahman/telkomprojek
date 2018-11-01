<center>
    <h2 class="page-header">
        Hapus Kode Awal
    </h2>
<style type="text/css">
	table td,th 
	{
		font-size: 11pt!important;
	}
</style>
<form method="POST">
<table class="table-responsive table-bordered table">
<tr>
	<th>Kode Awal</th>
	<th>Produk</th>
	<th>Hapus</th>
</tr>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$query = "Select * from kode_awal order by produk,nomor_awal";
$eksekusi = mysql_query($query,$koneksi);
while ($row=mysql_fetch_array($eksekusi,MYSQL_ASSOC))
{
	echo "<tr>";
	echo "<td>{$row['nomor_awal']}</td>";
	echo "<td>{$row['produk']}</td>";
	echo "<td><input type=radio name=edit value='{$row[nomor_awal]}'></td>";
	echo "</tr>";
}
?>
<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-danger"></td></tr>
</table></form>
<?php
if (isset($_POST['submit']))
{
	$kode_awal=$_POST['edit'];
	$query = "DELETE from kode_awal where nomor_awal='$kode_awal'";
	$eksekusi = mysql_query($query,$koneksi);
	
}
?>