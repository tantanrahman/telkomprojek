<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "kopeg";    
    $konek = mysql_connect($server,$user,$password) or die("Koneksi gagal");
    mysql_select_db($database, $konek) or die("Database tidak bisa dibuka");
?>
    <style type="text/css">
        
      table  td {
            padding-bottom :10px !important;
            padding-left: 10px;
            font-size: 14pt !important;
        }
        option {
            font-size: 14pt !important;
        }


    </style>
    <center><h2 class="page-header">
        Input Konpensasi
    </h2>
    </center>
    <br>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center>Berikut adalah halaman <strong>Input Konpensasi</strong> </center>
        </div>

    <br>
    <br>
    <form method="post">
                    <table>
                        <tr>
                            <td>Tanggal Masalah</td><td>:</td>
                            <td>
                            <input class="datepicker form-control" type="text" name="nilai" placeholder="Tanggal Awal">
                            </td> 
                        </tr>
                        <tr>
                            <td>Tanggal Konpensasi</td><td>:</td>
                            <td>
                            <input class="datepicker form-control" type="text" name="nilai2" placeholder="Tanggal Awal">
                            </td> 
                        </tr>
                        <tr>
                            <td>Pendapatan</td><td>:</td>
                            <td>
                                <select name="pen"  class="form-control">
                                    <option value="k_pln">FINNET PLN</option>
                                    <option value="k_pdam">FINNET PDAM </option>
                                    <option value="k_sopp">FINNET SOPP </option>
                                    <option value="k_voucher_tsel">FINNET VOUCHER TSEL </option>
                                    <option value="k_voucher_smart">FINNET VOUCHER SMART </option>
                                    <option value="k_voucher_tri">FINNET VOUCHER TRI</option>
                                    <option value="k_indovision">FINNET INDOVISION </option>
                                    <option value="k_arindo_adiratv">ARINDO ADIRATV</option>
                                    <option value="k_arindo_adira">ARINDO ADIRA</option>
                                    <option value="k_arindo_baf">ARINDO BAF</option>
                                    <option value="k_arindo_bpjs">ARINDO BPJS</option>
                                    <option value="k_arindo_fif">ARINDO FIF</option>
                                    <option value="k_arindo_indovision">ARINDO INDOVISION</option>
                                    <option value="k_arindo_pdam">ARINDO PDAM</option>
                                    <option value="k_arindo_pln">ARINDO PLN</option>
                                    <option value="k_arindo_toptv">ARINDO TOPTV</option>
                                    <option value="k_arindo_bigtv">ARINDO BIGTV</option>
                                    <option value="k_arindo_voucher">ARINDO VOUCHER</option>
                                    <option value="k_arindo_wom">ARINDO WOM</option>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td>Loket</td><td>:</td>
                            <td>
                                <select name="loket"  class="form-control">
                            <?php
                                $query=mysql_query("SELECT  loket as 'tempat' from lokasi");
                                while($row=mysql_fetch_array($query))
                                    {
                                        echo "<option value={$row['tempat']}>{$row['tempat']}</option>";
                                    }
                            ?>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td>Tempat</td><td>:</td>
                            <td>
                                <select name="tempat"  class="form-control">
                            <?php
                                $query=mysql_query("SELECT DISTINCT tempat as 'tempat' from lokasi");
                                while($row=mysql_fetch_array($query))
                                    {
                                        echo "<option value={$row['tempat']}>{$row['tempat']}</option>";
                                    }
                            ?>
                                </select>
                            </td> 
                        </tr>
                        <tr>
                            <td>Nominal</td><td>:</td>
                            <td>
                            <input type="text" name="nominal" class="form-control">
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-primary" name="filter"><i class="fa fa-search fa-fw"></i> Input Konpensasi</button>
    </form></td>
                        </tr>
                    </table>
                    <br>
                    
    </div>

<?php
    $tanggal1 = $_POST['nilai'];
    $date = explode("-", $tanggal1);
    $arr = array("$date[2]","$date[1]","$date[0]");
    $tampil_date = implode("-", $arr);
    $tanggal2 = $_POST['nilai2'];
    $date2 = explode("-", $tanggal2);
    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
    $tampil_date2 = implode("-", $arr2);
    $pen = $_POST['pen'];
    $loket = $_POST['loket'];
    $tempat = $_POST['tempat'];
    $nominal = $_POST['nominal'];

    $query = mysql_query("INSERT INTO $pen VALUES ('$tampil_date','$tampil_date2','$loket','$tempat',$nominal)");
   if (($pen=="k_arindo_adiratv") OR ($pen=="k_arindo_adira") OR ($pen=="k_arindo_baf") OR ($pen=="k_arindo_bpjs") OR ($pen=="k_arindo_fif") OR ($pen=="k_arindo_indovision") OR ($pen=="k_arindo_pdam") OR ($pen=="k_arindo_pln") OR ($pen=="k_arindo_toptv") OR ($pen=="k_arindo_bigtv") OR ($pen=="k_arindo_voucher") OR ($pen=="k_arindo_wom"))
   {
        $query = mysql_query("INSERT INTO k_arindo VALUES ('$tampil_date','$tampil_date2','$loket','$tempat',$nominal)");
   }

?>