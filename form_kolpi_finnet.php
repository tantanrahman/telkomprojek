<center>
    <h2 class="page-header">
        Colfee Finnet
    </h2>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Colfee Finnet.</strong> Silakan pilih Bulan yang akan dicetak.</center>
        </div>
    <br>
<form action="proses_kolpi_finnet.php" method="post" target="_blank">
                <table>
                    <tr>
                        <td>
                            <select name="bulan" class="form-control">
<option selected="selected">Bulan</option>
<?php
$bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
for($bulan=1; $bulan<=12; $bulan++){
if($bulan<=9) { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
}
?>
</select>
                        </td>
                        <td class="col-md-3">
                        <td>
                        <select name="tahun" class="form-control">
                        <option selected="selected">Tahun</option>
						<?php
							;
							for ($tahun=2015;$tahun<=2050;$tahun++)
							{
								echo "<option value='$tahun'>$tahun</option>";
							}
						?>
						</select>
                        </td>
                        
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-print fa-fw"></i> Cetak Colfee Finnet</button>
</form>

<hr>
<form action="kuitansi_finnet.php" method="post" target="_blank">
                <table>
                    <tr>
                        <td>
                            <select name="bulan" class="form-control">
<option selected="selected">Bulan</option>
<?php
$bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
for($bulan=1; $bulan<=12; $bulan++){
if($bulan<=9) { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
}
?>
</select>
                        </td>
                        <td class="col-md-3">
                        <td>
                        <select name="tahun" class="form-control">
                        <option selected="selected">Tahun</option>
                        <?php
                            ;
                            for ($tahun=2015;$tahun<=2050;$tahun++)
                            {
                                echo "<option value='$tahun'>$tahun</option>";
                            }
                        ?>
                        </select>
                        </td>
                        
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-print fa-fw"></i> Cetak Kuitansi Colfee Finnet</button>
</form>
</div>
</center>