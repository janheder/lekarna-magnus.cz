// nastavení EU cookies
// (c) based on Robert Hlobílek script 2022

function getCookie(name) 
{
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)')); 
    return match ? match[1] : null;
}

function deleteCookie(name) 
{
	var domena = window.location.hostname;
    var domena_bez = getDomainName(window.location.hostname);
    
	/*const dom_arr = domena.split('.');
	if(dom_arr[0]!='www')
	{
	  //alert('subdomena');
	}
	else
	{
	  //alert('www');
	}*/

    document.cookie = name +"=; Path=/; domain=."+domena_bez+"; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = name +"=; Path=/; domain="+domena_bez+"; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = name +"=; Path=/; domain=."+domena+"; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = name +"=; Path=/; domain="+domena+"; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

function setCookie(name,value,days)
{
    var expires = "";
    if (days) 
    {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}


function getDomainName(hostName)
{
    return hostName.substring(hostName.lastIndexOf(".", hostName.lastIndexOf(".") - 1) + 1);
}


function eucPodrobneNastaveni()
{	
	setCookie('euc',1,365);
	
	if(document.getElementById('chb_euc_statisticke').checked == true)
	{
		setCookie('euc_statisticke',1,365);
	}
	else
	{
		setCookie('euc_statisticke',-1,365);
	}
	
	if(document.getElementById('chb_euc_marketingove').checked == true)
	{
		setCookie('euc_marketingove',1,365);
	}
	else
	{
		setCookie('euc_marketingove',-1,365);
	}
	/*if(document.getElementById('chb_euc_socialni_site').checked == true)
	{
		setCookie('euc_socialni_site',1,365);
	}
	else
	{
		setCookie('euc_socialni_site',-1,365);
	}
	*/
	
	
	
	setTimeout(function()
    {
      skryjListu();
	}, 0);
	MicroModal.close('euc_div_modal');
}


function eucNastaveni(c)
{
  
  
  if(c==1)
  {
    // přijmout vše
    setCookie('euc',1,365);
    setCookie('euc_statisticke',1,365);
    setCookie('euc_marketingove',1,365);
    setCookie('euc_socialni_site',1,365);
    

    document.getElementById('euc_text_p').innerHTML = 'Vaše nastavení cookies bylo uloženo'; 
   
    setTimeout(function()
    {
      skryjListu();
	}, 0);
     MicroModal.close('euc_div_modal');
  }
  else if(c==-1)
  {
    // odmítnout vše
    setCookie('euc',1,365);
    setCookie('euc_statisticke',-1,365);
    setCookie('euc_marketingove',-1,365);
    setCookie('euc_socialni_site',-1,365);

    document.getElementById('euc_text_p').innerHTML = 'Vaše nastavení cookies bylo uloženo'; 
	
    setTimeout(function()
    {
      skryjListu();
	}, 0);
	MicroModal.close('euc_div_modal');
  }


  else if(c==2 || c==3)
  {
    // podrobné nastavení
    // úprava nastavení
 
    if(getCookie('euc_statisticke')==1)
    {
      var euc_statisticke_ch = 'checked';
    }
    else
    {
      var euc_statisticke_ch = '';
    }
    
    if(getCookie('euc_marketingove')==1)
    {
      var euc_marketingove_ch = 'checked';
    }
    else
    {
      var euc_marketingove_ch = '';
    }
    
    var euc_text = '<div class="modal__overlay" tabindex="-1"> <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title"> <header class="modal__header"> <h2 class="modal__title" id="modal-1-title"> Cookies </h2> <button class="modal__close" aria-label="Close modal" data-micromodal-close></button> </header> <main class="modal__content" id="modal-1-content"> <div class="notice-single"> <label class="switch"> <input type="checkbox" id="chb_euc_funkcni" value="1" checked="" disabled=""> <span class="slider round"></span> </label> <p><b>Funkční</b>Tyto cookies jsou nezbytné pro základní funkčnost webu a nelze je deaktivovat.</p> </div> <div class="notice-single"> <label class="switch"> <input type="checkbox" id="chb_euc_statisticke" value="1"'+euc_statisticke_ch+'> <span class="slider round"></span> </label> <p><b>Statistické</b>Tyto cookies pomáhají majitelům webových stránek pochopit, jak návštěvníci interagují s webovými stránkami, a to prostřednictvím anonymního shromažďování a vykazování informací.</p> </div> <div class="notice-single"> <label class="switch"> <input type="checkbox" id="chb_euc_marketingove" value="1"'+euc_marketingove_ch+'> <span class="slider round"></span> </label> <p><b>Marketingové</b>Tyto cookies se používají ke sledování návštěvníků na různých webových stránkách. Záměrem je zobrazovat reklamy, které jsou relevantní a zajímavé pro jednotlivé uživatele, a tím hodnotnější pro vydavatele a inzerenty třetích stran.</p> </div> </main> <footer class="modal__footer"> <input type="button" data-dismiss="modal" id="but_upravit_nastaveni" value="Uložit nastavení" onclick="eucPodrobneNastaveni();"> <span> <input type="button" id="but_odmitnout" value="Odmítnout vše" onclick="eucNastaveni(-1);"> <input type="button" id="but_prijmout" value="Přijmout vše" onclick="eucNastaveni(1);"> </span> </footer> </div> </div>';
    
    document.getElementById('euc_div_modal').innerHTML = euc_text; 
	
	MicroModal.show('euc_div_modal');
  }



}


function skryjListu()
{
  elmnt = document.getElementById("euc_div_obal");
  elmnt.classList.toggle('hide');
}


function readAllCookies() 
{

var allcookies = document.cookie;
cookiearray = allcookies.split(';');

	for(var i=0; i<cookiearray.length; i++) 
	{
	   name = cookiearray[i].split('=')[0];
	   name2 = name.trim();
       var ga = name2.substring(0, 3);
	   if(ga == '_ga' || ga == '__g')
	   {
		  deleteCookie(name2);
	   }
	   
	}
}

/***************************************************************************/
   
var cokies_nastaveno = getCookie('euc');
var euc_barva_textu = '#ffffff';
var euc_barva_pozadi = '#000000';
var euc_barva_pozadi_b1 = '#a6f2a2';
var euc_barva_pozadi_b2 = '#f9a2a2';
var euc_barva_pozadi_b3 = '#a4d5f9';

var euc_text = 'Na základě <a href="https://edpb.europa.eu/our-work-tools/our-documents/guidelines/guidelines-052020-consent-under-regulation-2016679_cs" target="_blank">nařízení EU</a> jsme nuceni od každého návštěvníka tohoto webu získat souhlas s používáním cookies. Tento web používá soubory cookies k zajištění funkčnosti a s Vaším souhlasem i mj. k personalizaci obsahu a měření návštěvnosti. Kliknutím na tlačítko „Přijmout vše“ souhlasíte s využívaním cookies a předáním údajů o chování na webu pro zobrazení cílené reklamy na sociálních sítích, reklamních sítích na dalších webech.';

var but_prijmout = '<input type="button" id="but_prijmout" value="Přijmout vše" onclick="eucNastaveni(1);">';
var but_odmitnout = '<input type="button" id="but_odmitnout" value="Odmítnout vše" onclick="eucNastaveni(-1);">';
var but_podrobne_nastaveni = '<input type="button" id="but_podrobne_nastaveni" value="Podrobné nastavení" onclick="eucNastaveni(2);" data-micromodal-trigger="euc_div_modal">';
var but_upravit_nastaveni = '<input type="button" data-dismiss="modal" id="but_upravit_nastaveni" value="Upravit nastavení" onclick="eucNastaveni(3);">';
var zalozka = '<div id="zalozka" onclick="skryjListu();">&darr;</div>';

if(cokies_nastaveno == 1)
{
   // nastavení provedeno
   var obsah_in = ' <div class="modal micromodal-slide" aria-hidden="true" id="euc_div_modal"></div><div id="euc_div_levy"><p id="euc_text_p">'+euc_text+'</p></div><div id="euc_div_pravy">'+but_upravit_nastaveni+'</div>'+zalozka+' ';
}
else
{
   var obsah_in = '<div class="modal micromodal-slide" aria-hidden="true" id="euc_div_modal"></div><div id="euc_div_levy"><p id="euc_text_p">'+euc_text+'</p></div><div id="euc_div_pravy">'+but_prijmout+' '+but_odmitnout+' '+but_podrobne_nastaveni+'</div>'+zalozka+' ';
}   


function eucDelCookies()
{
   if(cokies_nastaveno == 1)
	{
	   // nastavení provedeno	
	   
	   if(getCookie('euc_statisticke')==-1)
	   { 
	     // smažeme statistické
	     deleteCookie('NID');
	     deleteCookie('FPAU');
	     deleteCookie('AID');
	     deleteCookie('TAID');
	     deleteCookie('FPGCLDC');
	     deleteCookie('_gcl_dc');
	     deleteCookie('_gcl_au');
	     deleteCookie('FCNEC');
	     deleteCookie('FPGCLAW');
		 deleteCookie('FPGCLGB');
		 deleteCookie('_gcl_gb');
		 deleteCookie('_gcl_aw');
		 deleteCookie('FPLC');
		 deleteCookie('_ga');
		 deleteCookie('_gid');
		 deleteCookie('_gat');
	     deleteCookie('__utma');
		 deleteCookie('__utmb');
		 deleteCookie('__utmc');
		 deleteCookie('__utmt');
		 deleteCookie('__utmz');
		 deleteCookie('__utmv');
		 deleteCookie('__utmv');
		 deleteCookie('FPID');
		 deleteCookie('_gaexp');
	     deleteCookie('_gaexp_rc');
	     deleteCookie('_opt_awcid');
		 deleteCookie('_opt_awmid');
		 deleteCookie('_opt_awgid');
		 deleteCookie('_opt_awkid');
		 deleteCookie('_opt_utmc');
		 deleteCookie('_gcl_gf');
		 deleteCookie('_gcl_ha');
		 deleteCookie('PAIDCONTENT');
		 deleteCookie('_opt_expid');
		 deleteCookie('ssupp.vid');
		 deleteCookie('ssupp.visits');
		 
		 
	   }
	   
	   if(getCookie('euc_marketingove')==-1)
	   {
	     // smažeme marketingové
	     deleteCookie('__gsas');
	     deleteCookie('NID');
	     deleteCookie('DSID');
	     deleteCookie('id');
	     deleteCookie('__gads');
	     deleteCookie('GED_PLAYLIST_ACTIVITY');
		 deleteCookie('ACLK_DATA');
		 deleteCookie('FPAU');
		 deleteCookie('ANID');
		 deleteCookie('AID');
		 deleteCookie('IDE');
		 deleteCookie('TAID');
		 deleteCookie('FPGCLDC');
		 deleteCookie('_gcl_dc');
		 deleteCookie('_gcl_au');
		 deleteCookie('FLC');
		 deleteCookie('RUL');
		 deleteCookie('FPGCLAW');
		 deleteCookie('FPGCLGB');
		 deleteCookie('_gcl_gb');
		 deleteCookie('_gcl_aw');
		 deleteCookie('1P_JAR');
		 deleteCookie('Conversion');
		 deleteCookie('_gcl_gf');
		 deleteCookie('_gcl_ha');
		 deleteCookie('PAIDCONTENT');
		 deleteCookie('retargeting');
		 deleteCookie('_fbp');
		 
	   }
	}
	else
	{
		// nastavení není provedeno
		// nic neukládáme dokud neprovede nastavení
		// vymažeme všechny cookies kromě funkčních
		var obsah_in = '<div class="modal micromodal-slide" aria-hidden="true" id="euc_div_modal"></div><div id="euc_div_levy"><p id="euc_text_p">'+euc_text+'</p></div><div id="euc_div_pravy">'+but_prijmout+' '+but_odmitnout+' '+but_podrobne_nastaveni+'</div>'+zalozka+' ';
	
		deleteCookie('__gsas');
		deleteCookie('NID');
		deleteCookie('DSID');
		deleteCookie('id');
		deleteCookie('__gads');
		deleteCookie('GED_PLAYLIST_ACTIVITY');
		deleteCookie('ACLK_DATA');
		deleteCookie('FPAU');
		deleteCookie('ANID');
		deleteCookie('AID');
		deleteCookie('IDE');
		deleteCookie('TAID');
		deleteCookie('FPGCLDC');
		deleteCookie('_gcl_dc');
		deleteCookie('_gcl_au');
		deleteCookie('FLC');
		deleteCookie('RUL');
		deleteCookie('FCNEC');
		deleteCookie('FPGCLAW');
		deleteCookie('FPGCLGB');
		deleteCookie('_gcl_gb');
		deleteCookie('_gcl_aw');
		deleteCookie('1P_JAR');
		deleteCookie('Conversion');
		deleteCookie('FPLC');
		deleteCookie('_ga');
		deleteCookie('_gid');
		deleteCookie('_gat');
		deleteCookie('__utma');
		deleteCookie('__utmb');
		deleteCookie('__utmc');
		deleteCookie('__utmt');
		deleteCookie('__utmz');
		deleteCookie('__utmv');
		deleteCookie('__utmv');
		deleteCookie('FPID');
		deleteCookie('_gaexp');
		deleteCookie('_gaexp_rc');
		deleteCookie('_opt_awcid');
		deleteCookie('_opt_awmid');
		deleteCookie('_opt_awgid');
		deleteCookie('_opt_awkid');
		deleteCookie('_opt_utmc');
		deleteCookie('_gcl_gf');
		deleteCookie('_gcl_ha');
		deleteCookie('PAIDCONTENT');
		deleteCookie('_opt_expid');
		deleteCookie('retargeting');
		deleteCookie('ssupp.vid');
		deleteCookie('ssupp.visits');
		deleteCookie('_fbp');
		
		
	}
}



eucDelCookies();




// generujeme lištu
window.onload = function() 
{

// kvůli responzivitě musíme přidat CSS
var style = document.createElement('style');
style.setAttribute('type', 'text/css');
style.innerHTML = '';
document.head.appendChild(style);
	
var div = document.createElement('div');
div.setAttribute("id", "euc_div_obal");
div.innerHTML = obsah_in;

document.body.appendChild(div);

if(cokies_nastaveno == 1)
{
	skryjListu();
}


// zde musíme vymazat speciální GA cookies s proměnlivými názvy
readAllCookies();

// znovu po vygenerování
eucDelCookies();


}


// -----------------------------------------------------------------------------
// MODAL INIT
// -----------------------------------------------------------------------------


  !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e="undefined"!=typeof globalThis?globalThis:e||self).MicroModal=t()}(this,(function(){"use strict";function e(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function t(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var o=0,n=new Array(t);o<t;o++)n[o]=e[o];return n}var n,i,a,r,s,l=(n=["a[href]","area[href]",'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',"select:not([disabled]):not([aria-hidden])","textarea:not([disabled]):not([aria-hidden])","button:not([disabled]):not([aria-hidden])","iframe","object","embed","[contenteditable]",'[tabindex]:not([tabindex^="-"])'],i=function(){function o(e){var n=e.targetModal,i=e.triggers,a=void 0===i?[]:i,r=e.onShow,s=void 0===r?function(){}:r,l=e.onClose,c=void 0===l?function(){}:l,d=e.openTrigger,u=void 0===d?"data-micromodal-trigger":d,f=e.closeTrigger,h=void 0===f?"data-micromodal-close":f,v=e.openClass,g=void 0===v?"is-open":v,m=e.disableScroll,b=void 0!==m&&m,y=e.disableFocus,p=void 0!==y&&y,w=e.awaitCloseAnimation,E=void 0!==w&&w,k=e.awaitOpenAnimation,M=void 0!==k&&k,A=e.debugMode,C=void 0!==A&&A;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,o),this.modal=document.getElementById(n),this.config={debugMode:C,disableScroll:b,openTrigger:u,closeTrigger:h,openClass:g,onShow:s,onClose:c,awaitCloseAnimation:E,awaitOpenAnimation:M,disableFocus:p},a.length>0&&this.registerTriggers.apply(this,t(a)),this.onClick=this.onClick.bind(this),this.onKeydown=this.onKeydown.bind(this)}var i,a,r;return i=o,(a=[{key:"registerTriggers",value:function(){for(var e=this,t=arguments.length,o=new Array(t),n=0;n<t;n++)o[n]=arguments[n];o.filter(Boolean).forEach((function(t){t.addEventListener("click",(function(t){return e.showModal(t)}))}))}},{key:"showModal",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;if(this.activeElement=document.activeElement,this.modal.setAttribute("aria-hidden","false"),this.modal.classList.add(this.config.openClass),this.scrollBehaviour("disable"),this.addEventListeners(),this.config.awaitOpenAnimation){var o=function t(){e.modal.removeEventListener("animationend",t,!1),e.setFocusToFirstNode()};this.modal.addEventListener("animationend",o,!1)}else this.setFocusToFirstNode();this.config.onShow(this.modal,this.activeElement,t)}},{key:"closeModal",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,t=this.modal;if(this.modal.setAttribute("aria-hidden","true"),this.removeEventListeners(),this.scrollBehaviour("enable"),this.activeElement&&this.activeElement.focus&&this.activeElement.focus(),this.config.onClose(this.modal,this.activeElement,e),this.config.awaitCloseAnimation){var o=this.config.openClass;this.modal.addEventListener("animationend",(function e(){t.classList.remove(o),t.removeEventListener("animationend",e,!1)}),!1)}else t.classList.remove(this.config.openClass)}},{key:"closeModalById",value:function(e){this.modal=document.getElementById(e),this.modal&&this.closeModal()}},{key:"scrollBehaviour",value:function(e){if(this.config.disableScroll){var t=document.querySelector("body");switch(e){case"enable":Object.assign(t.style,{overflow:""});break;case"disable":Object.assign(t.style,{overflow:"hidden"})}}}},{key:"addEventListeners",value:function(){this.modal.addEventListener("touchstart",this.onClick),this.modal.addEventListener("click",this.onClick),document.addEventListener("keydown",this.onKeydown)}},{key:"removeEventListeners",value:function(){this.modal.removeEventListener("touchstart",this.onClick),this.modal.removeEventListener("click",this.onClick),document.removeEventListener("keydown",this.onKeydown)}},{key:"onClick",value:function(e){(e.target.hasAttribute(this.config.closeTrigger)||e.target.parentNode.hasAttribute(this.config.closeTrigger))&&(e.preventDefault(),e.stopPropagation(),this.closeModal(e))}},{key:"onKeydown",value:function(e){27===e.keyCode&&this.closeModal(e),9===e.keyCode&&this.retainFocus(e)}},{key:"getFocusableNodes",value:function(){var e=this.modal.querySelectorAll(n);return Array.apply(void 0,t(e))}},{key:"setFocusToFirstNode",value:function(){var e=this;if(!this.config.disableFocus){var t=this.getFocusableNodes();if(0!==t.length){var o=t.filter((function(t){return!t.hasAttribute(e.config.closeTrigger)}));o.length>0&&o[0].focus(),0===o.length&&t[0].focus()}}}},{key:"retainFocus",value:function(e){var t=this.getFocusableNodes();if(0!==t.length)if(t=t.filter((function(e){return null!==e.offsetParent})),this.modal.contains(document.activeElement)){var o=t.indexOf(document.activeElement);e.shiftKey&&0===o&&(t[t.length-1].focus(),e.preventDefault()),!e.shiftKey&&t.length>0&&o===t.length-1&&(t[0].focus(),e.preventDefault())}else t[0].focus()}}])&&e(i.prototype,a),r&&e(i,r),o}(),a=null,r=function(e){if(!document.getElementById(e))return console.warn("MicroModal: ❗Seems like you have missed %c'".concat(e,"'"),"background-color: #f8f9fa;color: #50596c;font-weight: bold;","ID somewhere in your code. Refer example below to resolve it."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",'<div class="modal" id="'.concat(e,'"></div>')),!1},s=function(e,t){if(function(e){e.length<=0&&(console.warn("MicroModal: ❗Please specify at least one %c'micromodal-trigger'","background-color: #f8f9fa;color: #50596c;font-weight: bold;","data attribute."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",'<a href="#" data-micromodal-trigger="my-modal"></a>'))}(e),!t)return!0;for(var o in t)r(o);return!0},{init:function(e){var o=Object.assign({},{openTrigger:"data-micromodal-trigger"},e),n=t(document.querySelectorAll("[".concat(o.openTrigger,"]"))),r=function(e,t){var o=[];return e.forEach((function(e){var n=e.attributes[t].value;void 0===o[n]&&(o[n]=[]),o[n].push(e)})),o}(n,o.openTrigger);if(!0!==o.debugMode||!1!==s(n,r))for(var l in r){var c=r[l];o.targetModal=l,o.triggers=t(c),a=new i(o)}},show:function(e,t){var o=t||{};o.targetModal=e,!0===o.debugMode&&!1===r(e)||(a&&a.removeEventListeners(),(a=new i(o)).showModal())},close:function(e){e?a.closeModalById(e):a.closeModal()}});return"undefined"!=typeof window&&(window.MicroModal=l),l}));

  MicroModal.init();
