 <?php

for ($i=0;$i<count($_POST['jumlah']);$i++)
	{
		$jumlah = $_POST['jumlah'][$i];
		$tanggal = $_POST['tanggal'][$i];

		$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


		$sql5 = "SELECT * from rincian_sopp_input where tanggal='$pecah[0]' AND lokasi='$pecah[1]'";
		$ambildata5 = mysqli_query( $konek,$sql5);
		$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
		if ($rows == null)
			{


			$insert = "INSERT INTO `kopeg`.`rincian_sopp_input` 
					VALUES ('$pecah[0]', '$pecah[1]', $jumlah)";
			$sql=mysqli_query($konek,$insert);
			}
			else 
			{
				$UPDATE = "UPDATE  rincian_sopp_input set fee_finnet=$jumlah where tanggal='$pecah[0]' AND lokasi='$pecah[1]'";
				
				$sql=mysqli_query($konek,$UPDATE);
			}
			



	}
	
	
include_once ('lembar_keu.php');

?>