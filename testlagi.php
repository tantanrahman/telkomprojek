<table>
<tr><td>1</td><td>2</td></tr>
<?php

$i=$j=1;

while ($i <= 10) 
{	
	echo "<tr>";
	echo "<td>$i</td>";
	while ($j <= $i) 
	{
		if ($j==$i)
		{
		echo "<td>$j</td>";
		}
		$j++;
	}
	echo "</tr>";
	$i++;
}

?>
</table>