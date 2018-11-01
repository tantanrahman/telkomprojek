 <?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db(kopeg);
$ubah = $_POST['ubah'];
$kueri = "SELECT  * from kaliuser where user = '$ubah'";
$eksekusi = mysql_query($kueri,$koneksi);


?>
<form method="post" action="?id=29">


<?php

while ($row = mysql_fetch_array($eksekusi,MYSQL_ASSOC)) {
	echo "
	Lokasi : <input type='text' value='{$row['lokasi']}' readonly='readonly'><br>
	User : <input name ='user' type='text' value='{$row['user']}' readonly='readonly'><br>
	Xfee : <input name='xfee' type='text' value='{$row['xfee']}'><br>
	Xtitip : <input name='xtitip'  type='text' value='{$row['xtitip']}'><br>
	Xadmin : <input name='xadmin' type='text' value='{$row['xadmin']}'><br>
	";
	
	
}

?>

<input type="submit" value="Update">
</form>


