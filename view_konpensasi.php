 <style type="text/css">
   
   table td
   {    
    font-size: 12px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<center>
    <h2 class="page-header">
        View Konpensasi
    </h2>
<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$query = "Select tanggal_masalah,tanggal_konpensasi,keterangan from konpensasi";
$eksekusi = mysql_query($query,$koneksi);
echo "<form method=post action='?id=133'>";
echo "<table id='mytable'class='table table-bordered table-striped table-fixed-header'><tr><th>Tanggal Masalah</th><th>Tanggal Konpensasi</th><th>Keterangan</th><th>Edit</th></tr>";
while ($row=mysql_fetch_array($eksekusi,MYSQL_ASSOC)) 
{
	echo "<tr>";
	echo "<td>{$row['tanggal_masalah']}</td>";
	echo "<td>{$row['tanggal_konpensasi']}</td>";
	echo "<td>{$row['keterangan']}</td>";
	echo "<td><input type=radio name=edit value={$row['tanggal_masalah']}></td>";
	echo "</tr>";
}
echo "<tr><td colspan=4><input type=submit class='btn btn-primary'></td></tr>";
echo "</table></form>";
?>