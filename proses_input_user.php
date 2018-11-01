<center>
    <h2 class="page-header"><b>Input User</b></h2>
</center>
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

for ($i=0;$i<count($_POST['user']);$i++)
	{
		$user = $_POST['user'][$i];
		$loket = $_POST['loket'][$i];
		
		$delete = "DELETE FROM loket WHERE tanggal='$tampil_date' and loket='$loket'";
		$sql=mysqli_query($konek,$delete);
		$insert = "INSERT INTO loket VALUES('$loket','$user','$tampil_date')";
			$sql=mysqli_query($konek,$insert);	
			
	}

echo "<center>Berhasil Ubah data user</center>";