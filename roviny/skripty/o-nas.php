<?
error_reporting(E_ERROR | E_WARNING | E_PARSE);
setlocale(LC_ALL, 'cs_CZ.UTF-8');
$p = strip_tags(addslashes($_GET['p']));
if(!strip_tags(addslashes($_GET['lang'])))
{
define(__LANG__,"cz");
}
else
{
define(__LANG__,strip_tags(addslashes($_GET['lang'])));
}

require_once("./db_connect.php");
require_once("./funkce.php");
globalni_pr();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="cs" />
<style>

.obal
{
width: auto; 
margin: 20px;
padding: 20px; 
font-size: 14px; 
font-family: Arial, Tahoma, Verdana;
color: #4A4A4A;	
background-color: #ffffff;
}

a:link, a:visited
{
color: #1187BC;
text-decoration: underline;
}

a:hover
{
color: #4C8936;
text-decoration: underline;
}



</style>
</head>
<body>
<?
echo "<div class=\"obal\">";


	$query_k = MySQL_Query("SELECT * FROM stranky4 WHERE id='4'") or die(err(1));
    $row_k = MySQL_fetch_object($query_k);
	echo stripslashes($row_k->obsah);


echo "</div>";
?>
</body>
</html>
