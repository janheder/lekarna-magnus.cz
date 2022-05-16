<?
########################################################
# RS W-Publicator - v. 3.02 - (c) Robert Hlobilek 2008 #
#                  funkce                              #
########################################################

define(__URL__,"http://".$_SERVER['SERVER_NAME']);


function globalni_pr()
{
$query_nastaveni = MySQL_Query("SELECT str,obsah FROM obecne_nastaveni6") or die(err(1));
	while($row_nastaveni = mysql_fetch_object($query_nastaveni))
	{
	define("__".$row_nastaveni->str."__",$row_nastaveni->obsah);
	}

}

function kontrola_ref()
{
$server = "http://".$_SERVER['SERVER_NAME'];
$referer = $_SERVER['HTTP_REFERER'];

if(!ereg("^".$server, $referer))
{
 die ("špatny referer<br />originální stránky jsou na <a href=\"".__URL__."\">".__URL__."</a>");
}
}


function getip() {
    if ($_SERVER) {
        if ( $_SERVER[HTTP_X_FORWARDED_FOR] ) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif ( $_SERVER["HTTP_CLIENT_IP"] ) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }

    } else {
        if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
            $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
        } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
            $realip = getenv( 'HTTP_CLIENT_IP' );
        } else {
            $realip = getenv( 'REMOTE_ADDR' );
        }
    }

    return $realip;
}


function is_email($autor_eml) {
      $autor_eml = strtolower($autor_eml);

    if (strlen($autor_eml) < 6)
    {
        return false;
      }
    if (strpos($autor_eml, "@") != strrpos($autor_eml, "@"))
    {
        return false;
      }
    if ((strpos($autor_eml, "@") < 1) || (strpos($autor_eml, "@") > (strlen($autor_eml) - 4)))
    {
        return false;
      }
    if (strrpos($autor_eml, ".") < strpos($autor_eml, "@"))
    {
        return false;
      }
   if (strstr($autor_eml, " "))
    {
        return false;
    }
    if (((strlen($autor_eml) - strrpos($autor_eml, ".") - 1) < 2) ||
   ((strlen($autor_eml) - strrpos($autor_eml, ".") - 1) > 4))
    {
        return false;
      }
    return true;
}


function err($e)
{
// chybove hlasky
switch ($e)
{
case 1:
   $hlaska = "Nepodařilo se vybrat data z databáze";
   break;
case 2:
   $hlaska = "Nepodařilo se uložit záznam";
   break;
case 3:
   $hlaska = "Nepodařilo se updatovat záznam";
   break;
case 4:
   $hlaska = "Nepodařilo se připojit k databázi";
   break;
case 5:
   $hlaska = "Nepodařilo se smazat záznam";
   break;
case 6:
   $hlaska = "Nepodařilo se optimalizovat tabulku";
   break;
default:
   $hlaska = "Nespecifikovaná chyba";
}

return $hlaska;
}




function novinky_uvod()
{
$query_novinky = MySQL_Query("SELECT * FROM aktuality6 WHERE aktivni=1 AND lang='".__LANG__."' ORDER BY datum DESC, id DESC") or die(err(1));


echo '<ul id="slider" class="slider-container">';

$x = 1;
 while ($row_novinky = MySQL_fetch_object($query_novinky))
 {	
		if(
	   (!$row_novinky->datum_od && !$row_novinky->datum_do)
		|| (!$row_novinky->datum_do && $row_novinky->datum_od && $row_novinky->datum_od<time())
		|| (!$row_novinky->datum_od && $row_novinky->datum_do && $row_novinky->datum_do>time()) 
		|| ($row_novinky->datum_do>time() && $row_novinky->datum_od<time()) 
		)
	   {
			   if($x==1)
				{
				echo '<li class="slide-visible"><div class="novinka_obal-wrap">';
				}
			   
		
				echo  '<div class="novinka_obal">
						<div class="novinka_obal_stred">
						<h2>'.stripslashes($row_novinky->nadpis).'</h2>
						<div class="clear" style="height: 15px;"></div>
						<p>'.stripslashes($row_novinky->perex).'</p>
						</div>
						
						<div class="novinka_datum">
							<div class="novinka_datum_in">
							<b>'.date("d.m",$row_novinky->datum).'</b>
							<br />
							'.date("Y",$row_novinky->datum).'
							</div>
						</div>
						
						<div class="novinka_detail"><a href="./skripty/detail_novinky.php?idn='.$row_novinky->id.'&amp;keepThis=true&amp;TB_iframe=true&amp;height=500&amp;width=800" 
						title="'.stripslashes($row_novinky->nadpis).'"
						class="thickbox"><img src="/img/lupa.png" 
						alt="detail novinky" title="detail novinky" style="border: 0px;" /></a></div>
		
						
						<div class="clear" style="height: 20px;"></div>
					</div>
					<div class="clear"></div>';
					
				if($x==4 || $x==8 || $x==12 || $x==16 || $x==20)
				{
				echo '</div></li><li><div class="novinka_obal-wrap">';
				}
					
					$x++;
				
				

 
	  } 
 }
 
 echo  '</ul>';

}


function produkty_uvod($x)
{
  $query_pa = MySQL_Query("SELECT idp FROM zbozi6") or die(err(1));
   while ($row_pa = MySQL_fetch_object($query_pa))
   {
	   $pr_arr[] = $row_pa->idp;
   }
	
	$a = 1;
	if(is_array($pr_arr))
	{
		$query_p = MySQL_Query("SELECT P.id, P.str, P.nazev, P.popis, P.cena_A as CENA_DB, P.sleva, 
		P.platnost_slevy, P.id_kategorie, O.nazev AS ONAZ, DP.dph
		FROM produkty P 
		LEFT JOIN obrazky O ON O.idp=P.id 
		LEFT JOIN dph DP ON DP.id=P.id_dph  
		WHERE P.aktivni=1 AND P.id IN (".implode(",",$pr_arr).") AND O.typ=1 
		ORDER BY RAND()
		LIMIT $x") or die(err(1));
		 while ($row_p = MySQL_fetch_object($query_p))
		 {
			 $url = url_produktu($row_p->id,$row_p->id_kategorie);
			 
			 
			 
			 
			if($row_p->sleva>0 && ($row_p->platnost_slevy>time())) 
			{
			 $cena_s_dph = round(($row_p->CENA_DB*($row_p->dph / 100 + 1)) - ($row_p->CENA_DB*($row_p->dph / 100 + 1)/100*$row_p->sleva));
			}
			else
			{
			  $cena_s_dph = round($row_p->CENA_DB*($row_p->dph / 100 + 1));
		    }
			  			  
			  //obrazek
			  if(!$row_p->ONAZ)
				{
				$row_p->ONAZ = "neni.gif";
				}
			 
			 echo '<div class="produkt_obal" ';
				if($a%3==0){echo ' style="margin-right: 0px;" ';}
			 echo '  onclick="self.location.href=\'https://best-lekarna.cz'.$url.'\'" title="'.stripslashes($row_p->nazev).'">';
			 
			 echo '<div class="produkt_cena">'.$cena_s_dph.' Kč</div>';
			 echo '<div class="produkt_obr"><img src="https://best-lekarna.cz/img_produkty/stredni/'.$row_p->ONAZ.'" 
			 alt="'.stripslashes($row_p->nazev).'" title="'.stripslashes($row_p->nazev).'" /></div>';
			 echo '<div class="produkt_nazev">'.stripslashes($row_p->nazev).'</div>';

			 echo '</div>';
			 
			 $a++;
		 }
     }
	
}


function url_produktu($id_p,$id_k)
{
	
$ret = '';
// produkt
$query_p = MySQL_Query("SELECT str FROM produkty WHERE id='".intval($id_p)."'") or die(err(1));
$row_p = MySQL_fetch_object($query_p);

// id kategorie je pole - z duvodu moznosti zarazeni produktu do vice kategorii
$id_k2 = unserialize($id_k);

$query_v = MySQL_Query("SELECT vnor FROM kategorie WHERE id='".intval($id_k2[0])."' ") or die(err(1));
$row_v = MySQL_fetch_object($query_v);
$vnor = $row_v->vnor;



if($vnor==1)
{
  $query_s1 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($id_k2[0])."'") or die(err(1));
  $row_s1 = MySQL_fetch_object($query_s1);
  $ret = '/produkty/'.$row_s1->str.'/'.$row_p->str.'/'.$id_p.'.html';   
  
}

if($vnor==2)
{
     $query_s2 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($id_k2[0])."'") or die(err(1));
     $row_s2 = MySQL_fetch_object($query_s2);
  
     $query_s1 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($row_s2->id_nadrazeneho)."'") or die(err(1));
     $row_s1 = MySQL_fetch_object($query_s1);
	 
	 $ret = '/produkty/'.$row_s1->str.'/'.$row_s2->str.'/'.$row_p->str.'/'.$id_p.'.html';  

}

if($vnor==3)
{
     $query_s3 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($id_k2[0])."'") or die(err(1));
     $row_s3 = MySQL_fetch_object($query_s3);
	 
     $query_s2 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($row_s3->id_nadrazeneho)."'") or die(err(1));
     $row_s2 = MySQL_fetch_object($query_s2);
  
     $query_s1 = MySQL_Query("SELECT str, id_nadrazeneho, vnor, id FROM kategorie WHERE id='".intval($row_s2->id_nadrazeneho)."'") or die(err(1));
     $row_s1 = MySQL_fetch_object($query_s1);
	 
	 $ret = '/produkty/'.$row_s1->str.'/'.$row_s2->str.'/'.$row_s3->str.'/'.$row_p->str.'/'.$id_p.'.html';  
}	
	

return $ret;	
}


function cut_text($text,$delka)
{
	$pocet_znaku = mb_strlen($text,'UTF-8');
	if($delka<$pocet_znaku)
	{
	$c_text = substr($text, 0, $delka); 
	if(!preg_match('//u', $c_text)) 
	{
	/* Odstraníme poslední půlznak */
	$c_text = preg_replace('/[\xc0-\xfd][\x80-\xbf]*$/', '', $c_text);
	} 
	}
	else
	{
	$c_text = $text;
	}
	return $c_text;
}


function bez_diakritiky_obr($s)
{
$a = array("á","ä","č","ď","é","ě","ë","í","ň","ó","ö","ř","š","ť","ú","ů","ü","ý","ž","Á","Ä","Č","Ď","É","Ě","Ë","Í","Ň","Ó","Ö","Ř","Š","Ť","Ú","Ů","Ü","Ý","Ž");
$b = array("a","a","c","d","e","e","e","i","n","o","o","r","s","t","u","u","u","y","z","A","A","C","D","E","E","E","I","N","O","O","R","S","T","U","U","U","Y","Z");
$sb = strtolower(str_replace($a, $b, $s));
$sb = str_replace('\"','',$sb);
$sb = str_replace('/','-',$sb);
$sb = str_replace('+','-',$sb);
$sb = str_replace('&','-',$sb);
$sb = str_replace(',','',$sb);
$sb = str_replace('?','',$sb);
$sb = str_replace('(','',$sb);
$sb = str_replace(')','',$sb);
$sb = str_replace('"','',$sb);
$sb = str_replace(';','',$sb);
$sb = str_replace('!','',$sb);
$sb = str_replace('\'','',$sb);
$sb = str_replace('->','',$sb);
$sb = str_replace('/','',$sb);
$sb = str_replace('α','',$sb);
$sb = str_replace('µ','',$sb);
$sb = str_replace('´','',$sb);
$sb = str_replace(')','',$sb);
$sb = str_replace('(','',$sb);
$sb = str_replace(']','',$sb);
$sb = str_replace('[','',$sb);
$sb = str_replace('---','-',$sb);
$sb = str_replace('--','-',$sb);
$sb = str_replace('&nbsp;','-',$sb);
return  ERegI_Replace('\'','',ERegI_Replace(' ','-',$sb)); 
}





function prilohy_podstranka($ids)
{
	$query_n2 = MySQL_Query("SELECT * FROM prilohy WHERE id_stranky=".intval($ids)." ORDER BY id") or die(err(1));
	$pocet = mysql_num_rows($query_n2);
	if($pocet)
	{

		echo '<div class="clear" style="height: 20px;"></div>';
		echo '<div class="prilohy_nadpis">'.__KE_STAZENI__.'</div>';
		$x = 1;

		while($row_n2 = MySQL_fetch_object($query_n2))
		{	
		 $velikost = round(filesize("./prilohy/".$row_n2->priloha)/1048576,2);	
		 $pripona_arr = explode(".",$row_n2->priloha);
		 $pripona_e = array_reverse($pripona_arr);

		 echo '<div class="priloha_radek" ';
		  if($x==1){ echo ' style="height: 28px;" ';}
		  if($x==$pocet){ echo ' style="border-bottom: none; -webkit-border-bottom-right-radius: 5px;
-webkit-border-bottom-left-radius: 5px;
-moz-border-radius-bottomright: 5px;
-moz-border-radius-bottomleft: 5px;
border-bottom-right-radius: 5px;
border-bottom-left-radius: 5px;" ';}
		 echo '><img src="/img/d.png" alt="" style="margin-left: 21px; margin-right: 15px; vertical-align: middle;" /><a href="/prilohy/'.$row_n2->priloha.'" ';
		 if(!strstr($_SERVER['HTTP_USER_AGENT'],"W3C_Validator"))
		  {
		  echo 'target="_blank"';
	      }
		 echo ' >'.stripslashes($row_n2->nazev).'</a> ('.$pripona_e[0].' / '.$velikost.' MB)</div>';
		 $x++;

        }

		echo '<div class="clear"></div>';

		
	}
}


function prilohy_novinka($ids)
{
	$query_n2 = MySQL_Query("SELECT * FROM prilohy_novinky WHERE id_novinky=".intval($ids)." ORDER BY id") or die(err(1));
	if(mysql_num_rows($query_n2))
	{
		echo '<div class="clear" style="height: 20px;"></div>';
		echo '<h2>Přílohy</h2>';
		echo '<div class="clear" style="height: 10px;"></div>';
		
		while($row_n2 = MySQL_fetch_object($query_n2))
		{
		 $velikost = round(filesize("./prilohy/".$row_n2->priloha)/1048576,2);	
		 $pripona_arr = explode(".",$row_n2->priloha);
		 $pripona_e = array_reverse($pripona_arr);
		  echo '<div class="det_priloha"><a href="/prilohy/'.$row_n2->priloha.'" target="_blank">'.stripslashes($row_n2->nazev).'</a> ('.$pripona_e[0].' / '.$velikost.' MB)</div>';
		 echo '<div class="clear"></div>';
        }
		
	}
}




function asc2bin ($ascii)
{
  while ( strlen($ascii) > 0 )
  {
   $byte = ""; $i = 0;
   $byte = substr($ascii, 0, 1);
   while ( $byte != chr($i) ) { $i++; }
   $byte = base_convert($i, 10, 2);
   $byte = str_repeat("0", (8 - strlen($byte)) ) . $byte; 
   $ascii = substr($ascii, 1);
   $binary = "$binary$byte";
  }
  return $binary;
} 

function bin2asc ($binary)
{
  $i = 0;
  while ( strlen($binary) > 3 )
  {
   $byte[$i] = substr($binary, 0, 8);
   $byte[$i] = base_convert($byte[$i], 2, 10);
   $byte[$i] = chr($byte[$i]);
   $binary = substr($binary, 8);
   $ascii = "$ascii$byte[$i]";
  }
  return $ascii;
} 


?>
