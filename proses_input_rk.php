<?php

for ($i=0;$i<count($_POST['rk']);$i++)
	{
		$rk = $_POST['rk'][$i];
		$tanggal = $_POST['tanggalrk'][$i];

		$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


		$sql5 = "SELECT * from rk_input where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
		$ambildata5 = mysqli_query( $konek,$sql5);
		$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
		if ($rows == null)
			{


			$insert = "INSERT INTO `kopeg`.`rk_input` 
					VALUES ('$pecah[0]', '$pecah[1]', $rk)";
			$sql=mysqli_query($konek,$insert);
			}
			else 
			{
				$UPDATE = "UPDATE  rk_input set jumlah=$rk where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
				
				$sql=mysqli_query($konek,$UPDATE);
			}
			



	}
	
	for ($i=0;$i<count($_POST['arindo_fee']);$i++)
	{
		$fee = $_POST['arindo_fee'][$i];
		$tanggal = $_POST['tanggal_fee'][$i];

		$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


		$sql5 = "SELECT * from arindo_input where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
		$ambildata5 = mysqli_query( $konek,$sql5);
		$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
		if ($rows == null)
			{


			$insert = "INSERT INTO `kopeg`.`arindo_input` 
					(tanggal,tempat,fee)
					VALUES ('$pecah[0]', '$pecah[1]', $fee)";
			$sql=mysqli_query($konek,$insert);
			}
			else 
			{
				$UPDATE = "UPDATE  arindo_input set fee=$fee where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
				
				$sql=mysqli_query($konek,$UPDATE);
			}
			



	}

	for ($i=0;$i<count($_POST['arindo_pen']);$i++)
	{
		$pen = $_POST['arindo_pen'][$i];
		$tanggal = $_POST['tanggal_pen'][$i];

		$pecah = explode('.',$tanggal);

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');


		$sql5 = "SELECT * from arindo_input where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
		$ambildata5 = mysqli_query( $konek,$sql5);
		$rows = mysqli_fetch_array($ambildata5, MYSQL_ASSOC);
		if ($rows == null)
			{


			$insert = "INSERT INTO `kopeg`.`arindo_input` 
					(tanggal,tempat,pen)
					VALUES ('$pecah[0]', '$pecah[1]', $pen)";
			$sql=mysqli_query($konek,$insert);
			}
			else 
			{
				$UPDATE = "UPDATE  arindo_input set pen=$pen where tanggal='$pecah[0]' AND tempat='$pecah[1]'";
				
				$sql=mysqli_query($konek,$UPDATE);
			}
			



	}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$tanggal = $_POST['tanggall'];
$titipantambahan = $_POST['titipantambahan'];
$transfer1 = $_POST['finnet1'];
$transfer2 = $_POST['finnet2'];
$transfer3 = $_POST['finnet3'];
$transfer4 = $_POST['finnet4'];
$biaya = $_POST['biaya'];
$tarik_tunai = $_POST['tarik_tunai'];
$jasa_giro = $_POST['jasa_giro'];
$pph = $_POST['pph'];
$kel_giro = $_POST['kel_giro'];

if ($transfer1==null)
{
	$transfer1=0;
}
if ($transfer2==null)
{
	$transfer2=0;
}
if ($transfer3==null)
{
	$transfer3=0;
}
if ($transfer4==null)
{
	$transfer4=0;
}
if ($biaya==null)
{
	$biaya=0;
}
if ($tarik_tunai==null)
{
	$tarik_tunai=0;
}
if ($jasa_giro==null)
{
	$jasa_giro=0;
}
if ($pph==null)
{
	$pph=0;
}
if ($kel_giro==null)
{
	$kel_giro=0;
}
$inserttitipan = "insert into titipan2 VALUES('$tanggal',$titipantambahan)";
$hapustitipan = "DELETE from titipan2 where tanggal='$tanggal'";

$eksekusititipan = mysqli_query($konek,$hapustitipan);
$eksekusititipan = mysqli_query($konek,$inserttitipan);

$cari = "select * from pengawasan where tanggal='$tanggal'";
$eksekusi = mysql_query($cari);
$data = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

					if($data == null)
					{

						$insert = "INSERT INTO `kopeg`.`pengawasan` 
						VALUES ($transfer1,$transfer2,$transfer3,$transfer4,$biaya,$tarik_tunai,$jasa_giro,$pph,$kel_giro,'$tanggal')";
					}
					else
						{
							$insert = "UPDATE `kopeg`.`pengawasan` 
					set transfer1=$transfer1, transfer2=$transfer2,transfer3=$transfer3, transfer4=$transfer4, 
						biaya=$biaya, tarik_tunai=$tarik_tunai,
						`jasa giro`=$jasa_giro,pph=$pph,
						`kel giro`=$kel_giro
					 where tanggal='$tanggal'";
						}
						$sql=mysqli_query($konek,$insert);
						echo "$insert";



?>