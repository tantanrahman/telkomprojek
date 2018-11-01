    <style type="text/css">
   
   table td
   {    
    font-size: 11px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); 

$tanggal1 = $_POST['nilai'];
$tanggal2 = $_POST['nilai2'];
$date = explode("-", $tanggal1);
                    $date2 = explode("-", $tanggal2);
                    $arr = array("$date[2]","$date[1]","$date[0]");
                    $arr2 = array("$date2[2]","$date2[1]","$date2[0]");
                    $tampil_date = implode("-", $arr);
                    $tampil_date2 = implode("-", $arr2);

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
        mysql_select_db('kopeg');



$sql =  "
            Select arindo_tempat.user, arindo_tempat.kode_user, sum(pln_trx) as pln_trx ,sum(telepon_trx) as telepon_trx ,sum(indovision_trx) as indovision_trx, sum(halo_trx) as halo_trx, sum(pulsa_trx) as pulsa_trx, sum(pdam_trx) as pdam_trx, sum(adira_trx) as adira_trx, sum(baf_trx) as baf_trx, sum(fif_trx) as fif_trx, sum(bpjs_trx) as bpjs_trx, sum(plnp_trx) as plnp_trx, sum(wom_trx) as wom_trx, sum(total_trx) as total_trx
            from arindo_tempat left join arindo_trx on arindo_tempat.kode_user=arindo_trx.kode_user and tanggal between '$tampil_date' and '$tampil_date2' group by user
            ";
?>

<div class="panel panel-primary">
        <div class="panel-heading">
            <center>Pendapatan <strong>Arindo</strong> tanggal <?=$tanggal1?> - <?=$tanggal2?>.</center>
        </div>

<table id="mytable" class="table table-bordered table-striped table-fixed-header">
    <thead class="header">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Kode User</th>
        <th>PLN </th>
        <th>Telepon </th>
        <th>Indovision </th>
        <th>Kartu Halo </th>
        <th>Pulsa </th>
        <th>PDAM </th>
        <th>WOM </th>
        <th>ADIRA </th>
        <th>BAF </th>
        <th>BPJS </th>
        <th>FIF </th>
        <th>Total </th>
    </tr>
    </thead>

<?php
$ambildata = mysql_query( $sql, $koneksi);
if(! $ambildata )
{
  die('Gagal ambil data: ' . mysql_error());
}
$no=1;
$hasil = $row['hasil'];
$jumlah_desimal ="0";
$pemisah_desimal =",";
$pemisah_ribuan =".";

while($row = mysql_fetch_array($ambildata, MYSQL_ASSOC))
{
    $tampilpln =  number_format($row['pln_trx']+$row['plnp_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampiltelepon =  number_format($row['telepon_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilindovision =  number_format($row['indovision_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilhalo =  number_format($row['halo_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilpulsa =  number_format($row['pulsa_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilpdam =  number_format($row['pdam_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampiladira =  number_format($row['adira_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilbaf =  number_format($row['baf_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilbpjs =  number_format($row['bpjs_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilfif =  number_format($row['fif_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampilwom =  number_format($row['wom_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    $tampiltotal =  number_format($row['total_trx'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);


    

    
    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>{$row['user']}</td>";
    echo "<td>{$row['kode_user']}</td>";
    echo "<td align=right>$tampilpln</td>";
    echo "<td align=right>$tampiltelepon</td>";
    echo "<td align=right>$tampilindovision</td>";
    echo "<td align=right>$tampilhalo</td>";
    echo "<td align=right>$tampilpulsa</td>";
    echo "<td align=right>$tampilpdam</td>";
    echo "<td align=right>$tampilwom</td>";
    echo "<td align=right>$tampiladira</td>";
    echo "<td align=right>$tampilbaf</td>";
    echo "<td align=right>$tampilbpjs</td>";
    echo "<td align=right>$tampilfif</td>";
    echo "<td align=right>$tampiltotal</td>";
    echo "</tr>";
    $jumlahplnp = $jumlahplnp + $row['plnp_trx'];
    $jumlahpln= $jumlahpln + $row['pln_trx'] + $row['plnp_trx'];
    $jumlahtelepon= $jumlahtelepon + $row['telepon_trx'];
    $jumlahindovsion= $jumlahindovsion + $row['indovision_trx'];
    $jumlahhalo= $jumlahhalo + $row['halo_trx'];
    $jumlahpulsa= $jumlahpulsa + $row['pulsa_trx'];
    $jumlahpdam= $jumlahpdam + $row['pdam_trx'];
    $jumlahadira= $jumlahadira + $row['adira_trx'];
    $jumlahbaf= $jumlahbaf + $row['baf_trx'];
    $jumlahbpjs= $jumlahbpjs + $row['bpjs_trx'];
    $jumlahfif= $jumlahfif + $row['fif_trx'];
    $jumlahwom = $jumlahwom + $row['wom_trx'];


    $jumlahtotal = $jumlahtotal + $row['total_trx'];



    $no++;
}

echo "<tr>";
echo "<td align=center colspan=3>TOTAL</td>";
echo "<td align=right>".number_format($jumlahpln, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahtelepon, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahindovsion, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahhalo, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahpulsa, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahpdam, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahwom, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahadira, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahbaf, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahbpjs, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahfif, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "<td align=right>".number_format($jumlahtotal, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</td>";
echo "</tr>";
?>
</table>
</div>