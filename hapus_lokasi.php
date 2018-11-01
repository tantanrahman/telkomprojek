
<center>
    <h2 class="page-header">
        Hapus Lokasi
    </h2>
<style type="text/css">
	table td,th 
	{
		font-size: 11pt!important;
	}
</style>

<?php

?>
<form method="POST">
<table class="table-responsive table-bordered table">
<tr>
	<th>No</th>
	<th>Lokasi</th>
	<th>Loket</th>
	<th>Tempat</th>
	<th>User (Khusus Arindo)</th>
	<th>Tempat (Khusus Arindo)</th>
	<th>Hapus</th>
</tr>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from lokasi order by lokasi";

$eksekusi = mysql_query($query,$koneksi);
$i=1;
while ($row=mysql_fetch_array($eksekusi,MYSQL_ASSOC))
{
	echo "<tr>";
	echo "<td>$i</td>";
	echo "<td>{$row['lokasi']}</td>";
	echo "<td>{$row['loket']}</td>";
	echo "<td>{$row['tempat']}</td>";
	echo "<td>{$row['user']}</td>";
	echo "<td>{$row['tempat_arindo']}</td>";
	echo "<td><input type=radio name=edit value='{$row[user_id]}'></td>";
	echo "</tr>";
	$i++;
}
?>
<tr><td colspan="3"><input type="submit" name="submit" class="btn btn-danger"></td></tr>
</table></form>
<?php

if(isset($_POST['submit']))
{
	$edit = $_POST['edit'];
	$hapus = "DELETE from lokasi where user_id='$edit'";
	
	$eksekusihapus = mysqli_query($konek,$hapus);
	if ($eksekusihapus)
	{
		echo "Data berhasil dihapus ";
		

	}
	else
	{
		echo "Data Gagal Disimpan.";
		
		
	}
}

?>