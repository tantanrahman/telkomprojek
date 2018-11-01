<form method="POST" action="?id=72">
<?php



$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}
$tanggal1 = $_POST['nilai'];

$sql ="Select lokasi.tempat as tempat,lokasi.loket,  titipan.titipan as titipan, titipan.talangan as talangan from lokasi left join titipan on lokasi.tempat = titipan.tempat AND titipan.tanggal='$tanggal1' group by lokasi.tempat";

mysql_select_db('kopeg');
$ambildata = mysql_query( $sql, $koneksi);

?>
<table border="1">
<tr><th>Tempat</th><th>Titipan</th><th>Talangan</th></tr>
<?php
while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
	echo "<tr>
	<td>{$row[tempat]}</td>
	<td><input type=text name=titipan[] value={$row[titipan]}>
		<input type=hidden name='tempat[]' value='$tanggal1.{$row['tempat']}'></td>

	<td><input type=text name=talangan[] value={$row[talangan]}>
		<input type=hidden name='tempat[]' value='$tanggal1.{$row['tempat']}'></td>
		</tr>";
}

?>
</table>


<input type="submit" value="Simpan">
</form>


