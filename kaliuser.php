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
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

    <!-- CSS and JS for table fixed header -->
    <link rel="stylesheet" href="table-fixed-header.css">
    <script src="table-fixed-header.js"></script>

</head>
<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
    $('.table-fixed-header').fixedHeader();
    });
  </script>
  <?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db(kopeg);

$kueri = "SELECT  * from kaliuser";
$eksekusi = mysql_query($kueri,$koneksi);

?>
<form method="post" action="?id=28">
<table id="mytable" class="table table-bordered table-striped table-fixed-header">
                    <thead class="header">
<tr>
	<th>ID</th>
	<th>Lokasi</th>
	<th>User</th>
	<th>X Fee</th>
	<th>X Titip</th>
	<th>X Admin</th>
	<th>EDIT</th>
</tr>
</thead>
<?php
$i=1;
while ($row = mysql_fetch_array($eksekusi,MYSQL_ASSOC)) {
	echo "<tr>
	<td class='tx'>$i</td>
	<td class='tx'>{$row['lokasi']}</td>
	<td class='tx'>{$row['user']}</td>
	<td>{$row['xfee']}</td>
	<td>{$row['xtitip']}</td>
	<td>{$row['xadmin']}</td>
	<td><input type='radio' name='ubah' value='{$row['user']}'></td>
</tr>";
	
	$i++;
}

?>
</table>
<center>
	<input type="submit" value="UBAH" class="btn btn-primary">
</center>
</form>