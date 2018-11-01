<center>
    <h2 class="page-header">
        Input Saldo Pertama
    </h2>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Input Saldo Akhir</strong></center>
            <center>Saldo pertama yang di masukan adalah saldo akhir pada tanggal H-1 transaksi</center>
        </div>
    <br>
<form method="post">
                <table>
                    <tr>
                        <td>
                           <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                        </td>
                        <td class="col-md-3">  
                        <td>
                            <input type="text" name="saldo" class="form-control" placeholder="Saldo">
                        </td>
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter">Input Saldo</button>
                
</form>
<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "kopeg";

$konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");

mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");





$tanggal = $_POST['nilai'];
$saldo = $_POST['saldo'];
$date = explode("-", $tanggal);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);

$query = "insert into saldo values ('$tampil_date',$saldo)";
$eksekusi = mysql_query($query,$konek);

?>
</div>
</center>