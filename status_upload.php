 <center>
    <h2 class="page-header">
        Status Upload
    </h2>
<style type="text/css">
	table td,th 
	{
		font-size: 11pt!important;
	}
</style>
<br><br><br><br><br><br><br>
<form method="POST">

<input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
<input type="submit" name="submit">
</form>
<?php
if (isset($_POST['submit']))
{
?>
<table class="table-responsive table-bordered table">
<tr>
	<th>Tanggal</th>
	<th>Nama file</th>
	<th>Pendapatan</th>
</tr>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$tanggal1 = $_POST['nilai'];
                    $date = explode("-", $tanggal1);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $tampil_date = implode("-", $arr);

$edit = $_POST['edit'];
$query = "Select * from upload where tanggal='$tampil_date' order by pen";
$eksekusi = mysql_query($query,$koneksi);
while ($row=mysql_fetch_array($eksekusi,MYSQL_ASSOC))
{
	echo "<tr>";
	echo "<td>{$row['tanggal']}</td>";
	echo "<td>{$row['nama']}</td>";
	echo "<td>{$row['pen']}</td>";
	echo "</tr>";
}

}
?>
</table>