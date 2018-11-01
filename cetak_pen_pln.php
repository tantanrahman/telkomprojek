<center>
    <h2 class="page-header">
        <b>Simpan Pendapatan PLN</b>
    </h2>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Cetak Pendapatan PLN</strong> silakan masukan Tanggal yang akan disimpan.</center>
        </div>
    <br>
    <br>
    <form action="proses_cetak_pen_pln.php" method="post" target="_blank">
                    <table>
                        <tr>
                            <td>
                                <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                            </td>
                            <td class="col-md-3">  
                            </td>
                            <td>
                                <input class="datepicker2 form-control" type="text" name="nilai2" placeholder="Tanggal Akhir">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-floppy-disk fa-fw"></i> Simpan Pendapatan PLN</button>
    </form>
</center>