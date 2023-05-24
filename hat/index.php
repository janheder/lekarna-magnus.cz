<?
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', false);
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

include("./lib/mysql.php");
require_once("./skripty/db_connect.php");
require_once("./skripty/funkce.php");
globalni_pr();


if(!$p)
{
// str uvodni stranky
$p = 'uvod';
}


// pokud se jedna o stranku ze staticky stranek a ma vyplneny potrebne udaje, nahradime slogan, title a keywords
$menu_seo = MySQL_Query("SELECT title, description, keywords FROM stranky10 WHERE str='".addslashes($p)."'");
$row_seo = MySQL_fetch_object($menu_seo);


?>
<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5" name="viewport">
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
    <meta content="index,follow,snippet,archive" name="robots">

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

    <meta content="Eline.cz" name="author">
    <link rel="canonical" href="https://www.lekarnahat.cz/">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">

    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/cookieconsent.css">
    <script type="text/javascript" src="/js/cookieconsent.js" defer></script>
    <script type="text/javascript" src="/js/cookieconsent-init.js" defer></script>


    <!-- Custom CSS-->
    <link href="css/normalize.css" rel="stylesheet">

    <link href="css/swiffy-slider.min.css" rel="stylesheet">
    <link href="css/thickbox.css" rel="stylesheet">

    <link href="css/style.min.css" rel="stylesheet">
    <script>

    </script>


<script  type="text/plain" data-cookiecategory="performance">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40026181-8']);
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

    <header id="top">
      <div class="container">
        <div class="header-inner">
          <a href=""><img src="images/logo-avion.png"></a>
          <nav>
            <div id="closeMenu"><img src="images/cross.svg"></div>
          <a href="#kontakt" class="scrollPage" id="openHours">Otevírací doba</a>
            <a href="https://www.best-erecept.cz/">E-recept</a>
            <a href="https://www.best-lekarna.cz/">Eshop</a>
            <a href="./skripty/kontakt.php?keepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=800" title="Kontakt" class="thickbox">Kontakt</a>
          </nav>
          <div class="nav-togggle" id="navToggle"><img src="images/menu.svg"></div>
        </div>
      </div>
    </header>
    <div id="backdrop"></div>

    <main>

      <section class="hero">
        <div class="container">
          <div class="hero-img">
            <img src="images/hero.png">
          </div>
          <div class="hero-content">
          <?
          // text z db
          $query_text = MySQL_Query("SELECT * FROM stranky10 WHERE str='uvod' ") or die(err(1));
          $row_text = MySQL_fetch_object($query_text);
          ?>
            <h1>		 <?	echo stripslashes($row_text->nadpis); ?>
      </h1>
            <p class="text_obsah_text">
            <?
			echo stripslashes($row_text->obsah);
			?>
            </p>

          </div>
          <div class="section-symbol"><img src="images/section-symbol.png"></div>
          <div class="hero-card"><img src="images/card.png"></div>
        </div>
      </section>

      <section class="news">
        <div class="container">
          <h1>Novinky z lékárny</h1>

          <div class="swiffy-slider slider-item-ratio slider-item-ratio-16x9 slider-nav-animation slider-nav-animation-fadein slider-item-first-visible" id="swiffy-animation">

            <button type="button" class="slider-nav" aria-label="Go to previous"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>          


          <?
				if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
					{
						novinky_uvod();
					}
				?>
</div>

        </div>
      </section>


      <section class="contact">
        <div class="container">
          <h1>Kontakty a otevírací doba</h1>
          <div onclick="self.location.href='<? 
		if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
			{
				echo __ODKAZ_MAPA__;
			}
				?>'" title="Mapa" class="contact-map">
            <img src="images/mapa-avion.png">
    </div>

          <div class="otv_doba" id="kontakt">
          <?
		// text z db
		$query_text2 = MySQL_Query("SELECT * FROM stranky10 WHERE id=2 ") or die(err(1));
		$row_text2 = MySQL_fetch_object($query_text2);
		echo stripslashes($row_text2->obsah);
		?>		
          </div>




        </div>
      </section>



      <div class="section-symbol" style="margin-bottom: -8px;"><img src="images/section-symbol.png"></div>
      <section class="products">
        <div class="container">
          <h1>Výhodný nákup</h1>
          <div class="products-grid">

          <?
		produkty_uvod(6);
		?>

          </div>

        </div>
      </section>

    </main>
    
    <footer>
      <section class="other-pharmacies">
        <div class="container">
          <h1>Další lékárny a odkazy</h1>
          <div class="other-pharmacies-wrap">
            <a href="https://krategus.cz/" class="other-pharmacies-single">
              <img src="images/krategus.png" alt="Krategus">
            </a>
            <a href="https://best-lekarna.cz/" class="other-pharmacies-single">
              <img src="images/best.png" alt="Best lékárna">
            </a>
          </div>

          <div class="other-logos">
              <h3>Partneři</h3>
              <div class="other-logos-wrap">
              <?
		$query_partneri = MySQL_Query("SELECT * FROM odkazy6 WHERE id=1 ") or die(err(1));
		$row_partneri = MySQL_fetch_object($query_partneri);
		
		echo stripslashes($row_partneri->text);
		?>
              </div>
          </div>


          <div class="pharmacies">
            <h3>Naše další lékárny</h3>
            <div class="pharmacies-wrap">
                <a href="https://www.lekarnauhradeb.cz"><img src="images/ico_hlucin.png" alt="Lékárna Hlučín" title="Lékárna Hlučín"></a>
                <a href="https://www.lekarna-rovniny.cz"><img src="images/ico_roviny.png" alt="Lékárna Hlučín" title="Lékárna Hlučín"></a>
                <a href="https://www.salvator-lekarna.cz"><img src="images/ico_opava.png" alt="Lékárna Opava" title="Lékárna Opava"></a>
				<a href="http://www.lekarna-magnus.cz"><img src="/img/ico_vrbno.png" alt="Lékárna Vrbno pod Pradědem" title="Lékárna Vrbno pod Pradědem" /></a>
            </div>
        </div>


        </div>
      </section>


      <div class="section-symbol"><img src="images/section-symbol.png"></div>
      <section class="copyright" id="pata">
        <div class="container">
          <div class="copyright__wrap">
            <div class="copyright__title">Všechna práva vyhrazena <a class="copyright__link" href="https://krategus.cz">Krategus</a> s.r.o. © 2022 </div>
            <div class="copyright__author">Vyrobilo studio <a class="copyright__link" href="https://eline.cz">Eline</a></div>
          </div>
        </div>
      </section>


    </footer>

    <div class="sipka_plovouci" title="nahoru"><a href="#top" class="scrollPage">
			<img src="images/sipka_plovouci_A.png" alt="nahoru" title="nahoru" style="border: 0px;"></a>
			<a href="#pata" class="scrollPage"><img src="images/sipka_plovouci_B.png" alt="dolů" title="dolů" style="border: 0px;"></a>
		</div>


    <!-- Custom js plugins and scripts-->
    <script src="js/lazysizes.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/thickbox.js"></script>

    <script src="js/swiffy-slider.min.js"></script>
    <script src="js/smoothscroll.min.js"></script> 

    <script src="js/scripts.js"></script>



    <script>

    </script>


  </body>
</html>