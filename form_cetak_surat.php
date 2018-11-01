<center>
    <h2 class="page-header">
        Cetak Surat Permohonan
    </h2>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Cetak Surat Permohonan</strong> silakan masukan Tanggal yang akan dicetak.</center>
        </div>
    <br>
Cetak Surat Permohonan
<form action="proses_cetak_surat.php" method="post">
                <table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                        </td>
                        <td class="col-md-3"></td>
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai2" placeholder="Tanggal Akhir">
                        </td>
                        
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-print fa-fw"></i> Cetak Surat Permohonan</button>
</form>

<hr>
Cetak Rincian Surat Permohonan
<form action="proses_cetak_surat2.php" method="post">
                <table>
                    <tr>
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                        </td>
                        <td class="col-md-3"></td>  
                        <td>
                            <input class="datepicker form-control" type="text" name="nilai2" placeholder="Tanggal Awal">
                        </td>
                        
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-print fa-fw"></i> Cetak Rincian Surat Permohonan</button>
</form>