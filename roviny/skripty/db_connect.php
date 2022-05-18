<?
$db_user	= "c2bestlekarna";
$db_passwd = "f@58eXeR";
$db = "c2bestlekarna";
$db_host = "localhost";

@$spojeni = mysql_Connect($db_host , $db_user , $db_passwd) or die("Nepodarilo se pripojit k databazi.");



MySQL_Select_DB($db);

mysql_query("SET character_set_results=UTF8");
mysql_query("SET character_set_connection=UTF8");
mysql_query("SET character_set_client=UTF8");
mysql_query("SET NAMES 'utf8'");

?>
