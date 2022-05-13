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

require_once("./skripty/db_connect.php");
require_once("./skripty/funkce.php");
globalni_pr();


if(!$p)
{
// str uvodni stranky
$p = 'uvod';
}


// pokud se jedna o stranku ze staticky stranek a ma vyplneny potrebne udaje, nahradime slogan, title a keywords
$menu_seo = MySQL_Query("SELECT title, description, keywords FROM stranky6 WHERE str='".addslashes($p)."'");
$row_seo = MySQL_fetch_object($menu_seo);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="cs" />
<meta name="description" content="<? 
if($row_seo->description)
{
echo stripslashes($row_seo->description);
}
else
{
echo __DESCRIPTION__;
}
?>" />
<meta name="keywords" content="<? 
if($row_seo->keywords)
{
echo stripslashes($row_seo->keywords);
}
else
{
echo __KEYWORDS__;
}
?>" lang="cs" />
<meta name="author" content="eline.cz" />
<meta name="robots" content="index,follow,snippet,archive" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta http-equiv="imagetoolbar" content="no" />
<title><? 
if($row_seo->title)
{
echo stripslashes($row_seo->title);
}
else
{
echo " | ".__TITLE__;
}
?></title>
<style type="text/css" media="screen">
@import url("/css/thickbox.css");
@import url("/css/rs.css");
</style>
<link rel="stylesheet" href="/css/anythingslider.css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/css/cookieconsent.css">
    <script type="text/javascript" src="/js/cookieconsent.js" defer></script>
    <script type="text/javascript" src="/js/cookieconsent-init.js" defer></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/thickbox.js"></script>
<script type="text/javascript" src="/js/jquery.anythingslider.js"></script>
<script type="text/javascript" src="/js/cufon-yui.js"></script>
<script type="text/javascript" src="/js/Calibri_400-Calibri_700.font.js"></script>
<script type="text/javascript">
	
		$(function(){
			$('#slider').anythingSlider({
			buildNavigation     : false,
			buildStartStop      : false,
			autoPlay            : true,
			delay               : 9000
				});
		});
		
</script>
<script type="text/javascript">
Cufon.replace('#cufon_top_menu_odkazy'); 
Cufon.replace('#cufon_nadpis_velky'); 
Cufon.replace('#cufon_nadpis_velky2', {
				textShadow: '#056939 1px 1px'
			}); 
Cufon.replace('#cufon_nadpis_velky4', {
				textShadow: '#056939 1px 1px'
			}); 
Cufon.replace('#cufon_text_obsah_nadpis'); 
Cufon.replace('#cufon_nadpis_velky3'); 
Cufon.replace('#cufon_nadpis_maly'); 
Cufon.replace('#cufon_nadpis_maly2'); 
</script> 

<script type="text/plain" data-cookiecategory="performance">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40026181-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script> 

</head>
<body>
<div id="fb-root"></div>
<script type="text/plain" data-cookiecategory="tracking" >(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="holder">
	<div class="prvni_blok" id="top">
		<div class="clear" style="height: 29px;"></div>
		<div class="top_menu">
			<div class="top_menu_logo" title="<? echo __TITLE_LOGA__?>"></div>
			<div class="top_menu_odkazy" id="cufon_top_menu_odkazy">
			<a href="#kontakt" class="scrollPage">Otevírací doba</a>
			<img src="/img/cary.png" alt="" />
			<a href="https://www.best-erecept.cz">el-recept</a>
			<img src="/img/cary.png" alt="" />
			<a href="http://www.best-lekarna.cz">Eshop</a>
			<img src="/img/cary.png" alt="" />
			<a href="./skripty/kontakt.php?keepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=800" title="Kontakt" class="thickbox">Kontakt</a>
			</div>
			<div class="sipka_plovouci" title="nahoru"><a href="#top" class="scrollPage">
			<img src="/img/sipka_plovouci_A.png" alt="nahoru" title="nahoru" style="border: 0px;" /></a>
			<a href="#pata" class="scrollPage"><img src="/img/sipka_plovouci_B.png" alt="dolů" title="dolů" style="border: 0px;" /></a>
			</div>
		</div>
		<?
		// text z db
		$query_text = MySQL_Query("SELECT * FROM stranky6 WHERE str='uvod' ") or die(err(1));
		$row_text = MySQL_fetch_object($query_text);
		?>
		
		<div class="text_obsah">
			<div class="text_obsah_nadpis" id="cufon_text_obsah_nadpis"><h1>
			<?
			echo stripslashes($row_text->nadpis);
			?>
			</h1></div>
			<div class="clear" style="height: 22px;"></div>
			<div class="text_obsah_text">
			<?
			echo stripslashes($row_text->obsah);
			?>
			</div>
		</div>
	</div>
</div>	
<div class="druhy_blok">
	<div class="stred">
		<div class="clear" style="height: 170px;"></div>
		<div class="nadpis_velky" id="cufon_nadpis_velky"><b>NOVINKY</b> Z LÉKÁRNY</div>
		
		
		<div class="clear" style="height: 60px;"></div>
		
			
				<?
				if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
					{
						novinky_uvod();
					}
				?>

	
	</div>
</div>
<div class="treti_blok">
	<div class="treti_blok_in">
		<div class="clear" style="height: 29px;"></div>
		<div class="nadpis_velky2" id="cufon_nadpis_velky2"><b>KONTAKTY</b> A OTEVÍRACÍ DOBA</div>
		<div class="mapa" onclick="self.location.href='<? 
		if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
			{
				echo __ODKAZ_MAPA__;
			}
				?>'" title="Mapa"></div>
		<div class="otv_doba" id="kontakt">
		<?
		// text z db
		$query_text2 = MySQL_Query("SELECT * FROM stranky6 WHERE id=2 ") or die(err(1));
		$row_text2 = MySQL_fetch_object($query_text2);
		echo stripslashes($row_text2->obsah);
		?>
		</div>
	</div>
</div>
<div class="ctvrty_blok">
	<div class="stred">
		<div class="clear" style="height: 70px;"></div>
		<div class="nadpis_velky" id="cufon_nadpis_velky3">VÝHODNÝ NÁKUP</div>
		<div class="clear" style="height: 50px;"></div>
		<?
		produkty_uvod(6);
		?>
	</div>	
</div>
<div class="paty_blok">
	<div class="paty_blok_in">
		<div class="clear" style="height: 73px;"></div>
		<div class="nadpis_velky2" id="cufon_nadpis_velky4"><b>DALŠÍ LÉKÁRNY</b> A ODKAZY</div>
		<div class="clear" style="height: 60px;"></div>
		<a href="http://krategus.cz"><img src="/img/krategus.png" alt="Lékárna Krategus" title="Lékárna Krategus" style="float: left; margin-left: 20px; border: 0px;" /></a>
		<a href="http://best-lekarna.cz"><img src="/img/best.png" alt="Best lékárna" title="Best lékárna" style="float: right; margin-right: 15px; border: 0px;" /></a>
		<div class="clear" style="height: 45px;"></div>
		<div class="nadpis_maly" id="cufon_nadpis_maly">Partneři</div>
		<div class="clear" style="height: 4px;"></div>
		<div class="partneri">
		<?
		$query_partneri = MySQL_Query("SELECT * FROM odkazy6 WHERE id=1 ") or die(err(1));
		$row_partneri = MySQL_fetch_object($query_partneri);
		
		echo stripslashes($row_partneri->text);
		?>
		</div>
		<div class="clear" style="height: 31px;"></div>
		<div class="nadpis_maly2" id="cufon_nadpis_maly2">Naše další lékárny</div>
		<div class="dalsi_lekarny_obal">
			<a href="http://www.lekarna-avion.cz"><img src="/img/ico_rymarov.png" alt="Lékárna Rýmařov" title="Lékárna Rýmařov" /></a>
			<a href="http://www.lekarnauhradeb.cz"><img src="/img/ico_hlucin.png" alt="Lékárna Hlučín" title="Lékárna Hlučín" /></a>
			<a href="http://www.lekarna-rovniny.cz"><img src="/img/ico_roviny.png" alt="Lékárna Hlučín" title="Lékárna Hlučín" /></a>
			<a href="http://www.salvator-lekarna.cz"><img src="/img/ico_opava.png" alt="Lékárna Opava" title="Lékárna Opava" /></a>
		</div>
	</div>
</div>

<div class="pata" id="pata">
	<div class="pata_in">
		<div class="pata_in_leva">Všechna práva vyhrazena <a href="http://www.krategus.cz">Krategus</a> s.r.o. 2012, Vyrobilo studio <a href="http://www.eline.cz">Eline</a></div>
		<div class="facebjuk">
		 <?
		  if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
			{
				echo '<div class="fb-like" data-href="http://www.lekarna-magnus.cz"  data-send="false" data-layout="button_count" data-width="250" data-show-faces="true"></div>';
			}
		  ?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$('.scrollPage').click(function() {
   var elementClicked = $(this).attr("href");
   var destination = $(elementClicked).offset().top;
   $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination-20}, 500 );
   return false;
});
});
</script>
<?
mysql_close($spojeni);
?>
</body>
</html>
