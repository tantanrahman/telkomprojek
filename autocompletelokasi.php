 <?php
mysql_connect('localhost','root','');
mysql_select_db('kopeg');

$kata = $_POST['kata'];
$sql = mysql_query ("SELECT lokasi FROM lokasi where lokasi like '%$kata%'");
echo"<ul>";

while ($a=mysql_fetch_array($sql))
{
	$lokasi = str_replace($kata,"<b>$kata</b>",$a['lokasi']);
	echo"<li>$lokasi</li>";
}


?>