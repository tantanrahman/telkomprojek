<style type="text/css">
   
   table td
   {    
    font-size: 14px!important;
   }
   table th
   {    
    font-size: 14px!important;
   }
</style>
<center>
    <h2 class="page-header">Input User</b>
</center>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
$konek = mysqli_connect('localhost','root','','kopeg');
		mysql_select_db('kopeg');

$query = "select  loket from lokasi";
$execute = mysql_query($query,$koneksi);
$no=1;
?>
<form method="POST" action="?id=116">
<table id="mytable" class="table-bordered table-striped table-fixed-header table">
<thead class="header">
<tr><td class="tx">Tanggal</td><td><input class="datepicker form-control" type="text" name="nilai" placeholder=""></td></tr>
<tr><th>LOKET</th><th>USER</th></tr>
</thead>

<?php
while ($row=mysql_fetch_array($execute, MYSQL_ASSOC)) 

{
	echo 	"<tr><td class='tx'>{$row['loket']}</td><td><div class='col-lg-4'><input type=text class='form-control' name='user[]' size=50>
			   <input type=hidden name='loket[]' value={$row['loket']}>
			</td></tr>";
	
}
?>
<tr><td colspan="2" align="center"><button type="submit" class="btn btn-primary" name="filter" >SIMPAN DATA</button></td></tr>
</table>
</form>