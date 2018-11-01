<?php

for ($i=0;$i<count($_POST['titipan']);$i++)
	{	
			
		$titipan = $_POST['titipan'][$i];
		if ($titipan == NULL)
		{
			$titipan=0;
		}
		
		$tanggal = $_POST['tanggal'][$i];

		$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

		
		$hapus = "delete from titipan where tanggal='$pecah[0]' and tempat='$pecah[1]'";
		$hapus2 = mysqli_query($konek,$hapus);

		$insert = 	"INSERT into titipan
					 VALUES ('$pecah[0]','$pecah[1]',$titipan,0)
					";
					$insert2 = mysqli_query($konek,$insert);
					echo "$insert <br>";

		

		
	}
for ($i=0;$i<count($_POST['talangan']);$i++)
		{
			$talangan = $_POST['talangan'][$i];
			$tanggal = $_POST['tanggal'][$i];

			$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

		
		
		$insert = 	"UPDATE titipan
					 set talangan=$talangan
					 WHERE tanggal ='$pecah[0]' and tempat='$pecah[1]'
					";
					$insert2 = mysqli_query($konek,$insert);
					echo "$insert<br>";

		}

?>