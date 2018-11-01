<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "kopeg";    
    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");
    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
?>
<center>
    <h2 class="page-header">
        View Rekap Pendapatan PER TEMPAT
    </h2>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>View Rekap Pendapatan PER TEMPAT</strong> silakan masukan Tanggal yang akan dilihat.</center>
        </div>
    <br>
<form action="index.php?id=162" method="post">
                <table>
                    <tr>
                        <td>
                            Tempat : <select name="tempat"  class="form-control">
                            <?php
                                $query=mysql_query("SELECT DISTINCT loket as 'tempat' from lokasi");
                                while($row=mysql_fetch_array($query))
                                    {
                                        echo "<option value={$row['tempat']}>{$row['tempat']}</option>";
                                    }
                            ?>
                                </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal"></td>
                    </tr>
                    <tr>                        
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai2" placeholder="Tanggal akhir">
                        </td>                         
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter">View Laporan</button>
</form>
</div>
</center>