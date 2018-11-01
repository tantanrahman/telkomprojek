<?php

	for ($i=0;$i<count($_POST['titipan']);$i++)
	{
		$titipan = $_POST['titipan'][$i];
		$talangan = $_POST['talangan'][$i];
		$tempat = $_POST['tempat'][$i];
		$pecah = explode('.',$tempat);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


		$sql5 = "SELECT * from titipan where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
		$ambildata5 = mysqli_query( $konek,$sql5);
		$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
		if ($rows == null)
			{


			$insert = "INSERT INTO `kopeg`.`titipan` 
					(tanggal,tempat,titipan,talangan)
					VALUES ('$pecah[0]', '$pecah[1]', $titipan,$talangan)";
			$sql=mysqli_query($konek,$insert);
			}
			else 
			{
				$UPDATE = "UPDATE  titipan set titipan=$titipan, talangan=$talangan where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
				
				$sql=mysqli_query($konek,$UPDATE);
			}
			



	}




?>