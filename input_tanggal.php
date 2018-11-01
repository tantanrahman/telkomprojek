<center>
    <h2 class="page-header">
        Input Tanggal <strong>Libur</strong> atau <strong>Masuk</strong>
    </h2>
<div class="panel panel-primary">
    <div class="panel-heading">
    Berikut adalah halaman untuk memasukan Tanggal <strong>Libur</strong> atau <strong>Masuk</strong>
    </div>
    <br>
        <table>
        	<tr>
        		<td><input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal"></td>
                        <td class="col-md-3">  
        		<td><select name="status" class="form-control">
        				<option value="libur">Libur</option>
        				<option value="masuk">Masuk</option>
        		</select></td>
        	</tr>
        </table>
        <br>
        <table>
    	<form method="POST">
    		<tr>
                            <td>
                                <input type="submit" value="Input Tanggal Libur" class="btn btn-primary">
                            </td>
                        </tr>
            <form>
        </table>
</center>
</div>


<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db(kopeg);

$tanggal1 = $_POST['nilai'];
$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);
$status = $_POST['status'];
$cari = "select * from status_tanggal where tanggal='$tampil_date'";
$eksekusi = mysql_query($cari);
$row = mysql_fetch_array($eksekusi,MYSQL_ASSOC);

if ($row == NULL)
{
	$insert = "INSERT into status_tanggal values ('$tampil_date','$status')";
	$eksekusi = mysql_query($insert);
}
else
{
	$insert = "Update status_tanggal set status='$status' where tanggal='$tampil_date'";
	$eksekusi = mysql_query($insert);
}
?>