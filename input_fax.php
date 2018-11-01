<style type="text/css">
   
   table td
   {    
    font-size: 12px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<center>
    <h2>Input Pendapatan FAX</h2>
<hr>
</center>
<form method="post">
<table class="table-responsive table-bordered table"> 
<tr><td class="tx" width="100">Tanggal </td><td width="20"> :</td><td><div class='col-lg-4'><input type="text" class="form-control" name="tanggal" id="datepicker"> </td></tr>
<tr><td class="tx">Lokasi </td><td>:</td><td> <span id="autocomplete"><div class="col-lg-4"><input type="text" class="form-control" name="lokasi" id="lokasi"></span></td></tr>
<tr><td class="tx">Fax </td><td>:</td><td><div class="col-lg-4"><input type="text" class="form-control" name="fax"></td></tr>
<tr><td class="tx">Lain - Lain </td><td>:</td><td><div class="col-lg-4"><input type="text" class="form-control" name="lain_lain"> </td></div></tr>
</table>
<center>
	<input type="submit" value="Simpan" class="btn btn-primary">
</center>
</form>


<?php
$tanggal = $_POST['tanggal'];
$lokasi = $_POST['lokasi'];
$fax = $_POST['fax'];
$etc = $_POST['lain_lain'];
$date = explode("-", $tanggal);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_date = implode("-", $arr);




$konek = mysql_connect("localhost","root","");
mysql_select_db(kopeg);
$query = "INSERT INTO fax (tanggal,lokasi,fax,lainlain) values ('$tampil_date','$lokasi',$fax,$etc)";

$eksekusi = mysql_query($query,$konek);
if($eksekusi)
{
	echo "<br> Data Berhasil Dimasukan";
}

?>