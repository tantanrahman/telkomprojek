<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="index.php?id=145"><span aria-hidden="true">&larr;</span> Tambah Fee PDAM</a></li>
    <li class="next"><a href="index.php?id=146">Hapus Fee PDAM <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
<center>
    <h2 class="page-header">
        View FEE PDAM
    </h2>
<style type="text/css">
	table td,th 
	{
		font-size: 11pt!important;
	}
</style>
<form method="POST" action="?id=144">
<table class="table-responsive table-bordered table">
<tr>
	<th>PDAM</th>
	<th>Regional</th>
	<th>Biaya Admin</th>
	<th>Fee Mitra</th>
	<th>Edit</th>
</tr>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$edit = $_POST['edit'];
$query = "Select * from fee_pdam order by regional,pdam";
$eksekusi = mysql_query($query,$koneksi);
while ($row=mysql_fetch_array($eksekusi,MYSQL_ASSOC))
{
	echo "<tr>";
	echo "<td>{$row['pdam']}</td>";
	echo "<td>{$row['regional']}</td>";
	echo "<td>{$row['biaya_admin']}</td>";
	echo "<td>{$row['fee_mitra']}</td>";
	echo "<td><input type=radio name=edit value='{$row[pdam]}'></td>";
	echo "</tr>";
}
?>
<tr><td colspan="3"><input type="submit" class="btn btn-info"></td></tr>
</table></form>