<center>
    <h2 class="page-header">
        Cetak Form Konpensasi
    </h2>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Cetak Konpensasi</strong> silakan masukan Tanggal yang akan dicetak.</center>
        </div>
    <br>
Cetak Surat Permohonan Setelah Konpensasi
<form action="proses_cetak_surat_konpensasi.php" method="post">
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
                <button type="submit" class="btn btn-primary" name="filter">Cetak Surat Permohonan</button>
</form>

<hr>
Cetak Rincian Surat Permohonan Setelah Konpensasi
<form action="proses_cetak_surat_konpensasi2.php" method="post">
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
                <button type="submit" class="btn btn-primary" name="filter">Cetak Rincian Surat Permohonan</button>
</form>