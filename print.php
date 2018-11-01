<HTML>
<HEAD>
<TITLE>Print</TITLE>
</HEAD>
<BODY onload="javascript:window.print()">
<?php
/*-------------------------------------------------------------------------------
| http://phpbego.wordpress.com
|-------------------------------------------------------------------------------
*/

if (isset($_REQUEST['print'])) 
{ 
	include $_REQUEST['print'] . ".php";
}
?>
</BODY>
</HTML>
