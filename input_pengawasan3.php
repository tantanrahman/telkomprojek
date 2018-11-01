<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$tanggal = $_POST['tanggal'];
$transfer1 = $_POST['finnet1'];
$transfer2 = $_POST['finnet2'];
$transfer3 = $_POST['finnet3'];
$transfer4 = $_POST['finnet4'];
$biaya = $_POST['biaya'];
$tarik_tunai = $_POST['tarik_tunai'];
$jasa_giro = $_POST['jasa_giro'];
$pph = $_POST['pph'];
$kel_giro = $_POST['kel_giro'];


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



?>
