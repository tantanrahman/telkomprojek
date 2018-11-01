<?php


$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
		$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');
$tanggal = $_POST['nilai'];





$sql = "Select * from saldo where tanggal='$tanggal'";
$ambildata = mysql_query( $sql, $koneksi);
$row =mysql_fetch_array($ambildata);

$saldo = $row['saldo'];


?>
<form method="POST">
<table>
<tr>
                        <td>
                            <input  type="text" name="saldo" value="<?php echo "$saldo"; ?>">
                            <input type="hidden" name="tanggal" value="<?php echo "$tanggal"; ?>">
                        </td>
                        
                    </tr>
</table>
<input type="submit" value="simpan" name="simpan">
</form>
<?php
if (isset($_POST['simpan']))
{

$saldo = $_POST['saldo'];
$tanggal = $_POST['tanggal'];
$sql = "delete from saldo where tanggal='$tanggal'";
mysqli_query($konek,$sql);



	$insert = "INSERT INTO `kopeg`.`saldo` 
					(tanggal,saldo)
					VALUES ('$tanggal', $saldo)";
			$sql=mysqli_query($konek,$insert);
			
			
		}
else
{

}

?>