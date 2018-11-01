<center>
    <h2 class="page-header">Hapus Pendapatan</h2>
<div class="panel panel-primary">
    <div class="panel-heading">
        Hapus Pendapatan <strong>All Denom</strong> <i>kecuali</i> <strong>Voucher</strong>
    </div>
    <br>
    <form action="?id=102" method="post">
                    <table>
                        <tr>
                            <td>
                                <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                            </td>
                            <td class="col-md-3">  
                            </td>
                            <td>
                                <select name="pen" Size="1">
                <option value = "pln"> PLN </option>
                <option value = "pdam"> PDAM </option>
                <option value = "sopp"> SOPP </option>
                <option value = "voucher"> Voucher </option>
                                <option value = "indovision"> Indovision </option>
                                <option value = "arindo"> arindo </option>
                                <option value = "transvision"> Transvision </option>
              </select>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
    </form>
    <hr>
    <form action="?id=102" method="post">
                    <table>
                        <tr>
                            <td>
                                <input class="datepicker form-control" type="text" name="nilai1" placeholder="Tanggal Awal">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-danger" name="semua">Hapus</button>
    </form>
    <hr>
    <center>
        <h4>Kosongkan Saldo</h2>
    </center>
    <form action="?id=102" method="post">
                    <button type="submit" class="btn btn-danger" name="saldo1">Kosongkan</button>
    </form>
</div>
