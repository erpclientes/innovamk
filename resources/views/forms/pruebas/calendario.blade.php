<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="description" content="">
	<title>Calendar - Admin</title>
	<link href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css" rel="stylesheet">
	<link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/jqvmap.css?v=16275756370585718435" rel="stylesheet">
	<link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/flag-icon.min.css?v=10757425894848348376" rel="stylesheet">
	<!-- Fullcalendar-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css" rel="stylesheet">
	<!-- Materialize-->
	<link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/admin-materialize.min.css?v=8850535670742419153" rel="stylesheet">
	<!-- Material Icons-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" async="" src="https://cdn.shopify.com/s/javascripts/tricorder/trekkie.storefront.min.js?v=2020.07.13.1"></script><script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');</script><meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/17758583/digital_wallets/dialog">
<meta name="shopify-checkout-api-token" content="6aacc581eb2b41d74f03c38d3c985dba">
<meta id="in-context-paypal-metadata" data-shop-id="17758583" data-venmo-supported="true" data-environment="production" data-locale="en_US" data-paypal-v4="true" data-currency="USD">
<link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">
<script id="apple-pay-shop-capabilities" type="application/json">{"shopId":17758583,"countryCode":"US","currencyCode":"USD","merchantCapabilities":["supports3DS"],"merchantId":"gid:\/\/shopify\/Shop\/17758583","merchantName":"Materialize Themes","requiredBillingContactFields":["postalAddress","email"],"requiredShippingContactFields":["postalAddress","email"],"shippingType":"shipping","supportedNetworks":["visa","masterCard","amex","discover"],"total":{"type":"pending","label":"Materialize Themes","amount":"1.00"}}</script>
<script id="shopify-features" type="application/json">{"accessToken":"6aacc581eb2b41d74f03c38d3c985dba","betas":["rich-media-storefront-analytics"],"domain":"themes.materializecss.com","predictiveSearch":true,"shopId":17758583,"smart_payment_buttons_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js","dynamic_checkout_cart_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js","locale":"en"}</script>
<script>var Shopify = Shopify || {};
Shopify.shop = "materialize-themes.myshopify.com";
Shopify.locale = "en";
Shopify.currency = {"active":"USD","rate":"1.0"};
Shopify.theme = {"name":"debut","id":133945025,"theme_store_id":796,"role":"main"};
Shopify.theme.handle = "null";
Shopify.theme.style = {"id":null,"handle":null};
Shopify.cdnHost = "cdn.shopify.com";</script>
<script type="module">!function(o){(o.Shopify=o.Shopify||{}).modules=!0}(window);</script>
<script>!function(o){function n(){var o=[];function n(){o.push(Array.prototype.slice.apply(arguments))}return n.q=o,n}var t=o.Shopify=o.Shopify||{};t.loadFeatures=n(),t.autoloadFeatures=n()}(window);</script>
<script>window.ShopifyPay = window.ShopifyPay || {};
window.ShopifyPay.apiHost = "pay.shopify.com";</script>
<script id="__st">var __st={"a":17758583,"offset":-25200,"reqid":"e7091baa-2142-4c5f-9208-93d9db6132f9","pageurl":"themes.materializecss.com\/pages\/admin-calendar","s":"pages-18650824793","u":"74b6f7deeac9","p":"page","rtyp":"page","rid":18650824793};</script>
<script>window.ShopifyPaypalV4VisibilityTracking = true;</script>
<script>window.ShopifyAnalytics = window.ShopifyAnalytics || {};
window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
window.ShopifyAnalytics.meta.currency = 'USD';
var meta = {"page":{"pageType":"page","resourceType":"page","resourceId":18650824793}};
for (var attr in meta) {
 window.ShopifyAnalytics.meta[attr] = meta[attr];
}</script>
<script>window.ShopifyAnalytics.merchantGoogleAnalytics = function() {
 
};
</script>
<script class="analytics">(window.gaDevIds=window.gaDevIds||[]).push('BwiEti');


(function () {
 var customDocumentWrite = function(content) {
	var jquery = null;

	if (window.jQuery) {
	  jquery = window.jQuery;
	} else if (window.Checkout && window.Checkout.$) {
	  jquery = window.Checkout.$;
	}

	if (jquery) {
	  jquery('body').append(content);
	}
 };

 var isDuplicatedThankYouPageView = function() {
	return document.cookie.indexOf('loggedConversion=' + window.location.pathname) !== -1;
 }

 var setCookieIfThankYouPage = function() {
	if (window.location.pathname.indexOf('/checkouts') !== -1 &&
		 window.location.pathname.indexOf('/thank_you') !== -1) {

	  var twoMonthsFromNow = new Date(Date.now());
	  twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

	  document.cookie = 'loggedConversion=' + window.location.pathname + '; expires=' + twoMonthsFromNow;
	}
 }

 var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
 if (trekkie.integrations) {
	return;
 }
 trekkie.methods = [
	'identify',
	'page',
	'ready',
	'track',
	'trackForm',
	'trackLink'
 ];
 trekkie.factory = function(method) {
	return function() {
	  var args = Array.prototype.slice.call(arguments);
	  args.unshift(method);
	  trekkie.push(args);
	  return trekkie;
	};
 };
 for (var i = 0; i < trekkie.methods.length; i++) {
	var key = trekkie.methods[i];
	trekkie[key] = trekkie.factory(key);
 }
 trekkie.load = function(config) {
	trekkie.config = config;
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.onerror = function(e) {
	  (new Image()).src = '//v.shopify.com/internal_errors/track?error=trekkie_load';
	};
	script.async = true;
	script.src = 'https://cdn.shopify.com/s/javascripts/tricorder/trekkie.storefront.min.js?v=2020.07.13.1';
	var first = document.getElementsByTagName('script')[0];
	first.parentNode.insertBefore(script, first);
 };
 trekkie.load(
	{"Trekkie":{"appName":"storefront","development":false,"defaultAttributes":{"shopId":17758583,"isMerchantRequest":null,"themeId":133945025,"themeCityHash":"1670185919760860438","contentLanguage":"en","currency":"USD"},"isServerSideCookieWritingEnabled":true,"isPixelGateEnabled":false},"Performance":{"navigationTimingApiMeasurementsEnabled":true,"navigationTimingApiMeasurementsSampleRate":1},"Google Analytics":{"trackingId":"UA-56218128-1","domain":"auto","siteSpeedSampleRate":"10","enhancedEcommerce":true,"doubleClick":true,"includeSearch":true},"Session Attribution":{}}
 );

 var loaded = false;
 trekkie.ready(function() {
	if (loaded) return;
	loaded = true;

	window.ShopifyAnalytics.lib = window.trekkie;
	
	  ga('require', 'linker');
	  function addListener(element, type, callback) {
		 if (element.addEventListener) {
			element.addEventListener(type, callback);
		 }
		 else if (element.attachEvent) {
			element.attachEvent('on' + type, callback);
		 }
	  }
	  function decorate(event) {
		 event = event || window.event;
		 var target = event.target || event.srcElement;
		 if (target && (target.getAttribute('action') || target.getAttribute('href'))) {
			ga(function (tracker) {
			  var linkerParam = tracker.get('linkerParam');
			  document.cookie = '_shopify_ga=' + linkerParam + '; ' + 'path=/';
			});
		 }
	  }
	  addListener(window, 'load', function(){
		 for (var i=0; i < document.forms.length; i++) {
			var action = document.forms[i].getAttribute('action');
			if(action && action.indexOf('/cart') >= 0) {
			  addListener(document.forms[i], 'submit', decorate);
			}
		 }
		 for (var i=0; i < document.links.length; i++) {
			var href = document.links[i].getAttribute('href');
			if(href && href.indexOf('/checkout') >= 0) {
			  addListener(document.links[i], 'click', decorate);
			}
		 }
	  });
	

	var originalDocumentWrite = document.write;
	document.write = customDocumentWrite;
	try { window.ShopifyAnalytics.merchantGoogleAnalytics.call(this); } catch(error) {};
	document.write = originalDocumentWrite;
	  (function () {
		 if (window.BOOMR && (window.BOOMR.version || window.BOOMR.snippetExecuted)) {
			return;
		 }
		 window.BOOMR = window.BOOMR || {};
		 window.BOOMR.snippetStart = new Date().getTime();
		 window.BOOMR.snippetExecuted = true;
		 window.BOOMR.snippetVersion = 12;
		 window.BOOMR.application = "storefront-renderer";
		 window.BOOMR.shopId = 17758583;
		 window.BOOMR.themeId = 133945025;
		 window.BOOMR.url =
			"https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
		 var where = document.currentScript || document.getElementsByTagName("script")[0];
		 var parentNode = where.parentNode;
		 var promoted = false;
		 var LOADER_TIMEOUT = 3000;
		 function promote() {
			if (promoted) {
			  return;
			}
			var script = document.createElement("script");
			script.id = "boomr-scr-as";
			script.src = window.BOOMR.url;
			script.async = true;
			parentNode.appendChild(script);
			promoted = true;
		 }
		 function iframeLoader(wasFallback) {
			promoted = true;
			var dom, bootstrap, iframe, iframeStyle;
			var doc = document;
			var win = window;
			window.BOOMR.snippetMethod = wasFallback ? "if" : "i";
			bootstrap = function(parent, scriptId) {
			  var script = doc.createElement("script");
			  script.id = scriptId || "boomr-if-as";
			  script.src = window.BOOMR.url;
			  BOOMR_lstart = new Date().getTime();
			  parent = parent || doc.body;
			  parent.appendChild(script);
			};
			if (!window.addEventListener && window.attachEvent && navigator.userAgent.match(/MSIE [67]./)) {
			  window.BOOMR.snippetMethod = "s";
			  bootstrap(parentNode, "boomr-async");
			  return;
			}
			iframe = document.createElement("IFRAME");
			iframe.src = "about:blank";
			iframe.title = "";
			iframe.role = "presentation";
			iframe.loading = "eager";
			iframeStyle = (iframe.frameElement || iframe).style;
			iframeStyle.width = 0;
			iframeStyle.height = 0;
			iframeStyle.border = 0;
			iframeStyle.display = "none";
			parentNode.appendChild(iframe);
			try {
			  win = iframe.contentWindow;
			  doc = win.document.open();
			} catch (e) {
			  dom = document.domain;
			  iframe.src = "javascript:var d=document.open();d.domain='" + dom + "';void(0);";
			  win = iframe.contentWindow;
			  doc = win.document.open();
			}
			if (dom) {
			  doc._boomrl = function() {
				 this.domain = dom;
				 bootstrap();
			  };
			  doc.write("<body onload='document._boomrl();'>");
			} else {
			  win._boomrl = function() {
				 bootstrap();
			  };
			  if (win.addEventListener) {
				 win.addEventListener("load", win._boomrl, false);
			  } else if (win.attachEvent) {
				 win.attachEvent("onload", win._boomrl);
			  }
			}
			doc.close();
		 }
		 var link = document.createElement("link");
		 if (link.relList &&
			typeof link.relList.supports === "function" &&
			link.relList.supports("preload") &&
			("as" in link)) {
			window.BOOMR.snippetMethod = "p";
			link.href = window.BOOMR.url;
			link.rel = "preload";
			link.as = "script";
			link.addEventListener("load", promote);
			link.addEventListener("error", function() {
			  iframeLoader(true);
			});
			setTimeout(function() {
			  if (!promoted) {
				 iframeLoader(true);
			  }
			}, LOADER_TIMEOUT);
			BOOMR_lstart = new Date().getTime();
			parentNode.appendChild(link);
		 } else {
			iframeLoader(false);
		 }
		 function boomerangSaveLoadTime(e) {
			window.BOOMR_onload = (e && e.timeStamp) || new Date().getTime();
		 }
		 if (window.addEventListener) {
			window.addEventListener("load", boomerangSaveLoadTime, false);
		 } else if (window.attachEvent) {
			window.attachEvent("onload", boomerangSaveLoadTime);
		 }
		 if (document.addEventListener) {
			document.addEventListener("onBoomerangLoaded", function(e) {
			  e.detail.BOOMR.init({
				 producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
				 ResourceTiming: {
					enabled: true,
					trackedResourceTypes: ["script", "img", "css"]
				 },
			  });
			  e.detail.BOOMR.t_end = new Date().getTime();
			});
		 } else if (document.attachEvent) {
			document.attachEvent("onpropertychange", function(e) {
			  if (!e) e=event;
			  if (e.propertyName === "onBoomerangLoaded") {
				 e.detail.BOOMR.init({
					producer_url: "https://monorail-edge.shopifysvc.com/v1/produce",
					ResourceTiming: {
					  enabled: true,
					  trackedResourceTypes: ["script", "img", "css"]
					},
				 });
				 e.detail.BOOMR.t_end = new Date().getTime();
			  }
			});
		 }
	  })();
	

	if (!isDuplicatedThankYouPageView()) {
	  setCookieIfThankYouPage();
	  
		 window.ShopifyAnalytics.lib.page(
			null,
			{"pageType":"page","resourceType":"page","resourceId":18650824793}
		 );
	  
	  
	}
 });

 
	  var eventsListenerScript = document.createElement('script');
	  eventsListenerScript.async = true;
	  eventsListenerScript.src = "//cdn.shopify.com/s/assets/shop_events_listener-2632023fb2795bd6668b6fbae05b661baba07afb3d62048f023763eca3cd96e3.js";
	  document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);
	
})();</script><script async="" src="//cdn.shopify.com/s/assets/shop_events_listener-2632023fb2795bd6668b6fbae05b661baba07afb3d62048f023763eca3cd96e3.js"></script>
<script>var storefrontFormsRecaptchaCallback = function() {
 grecaptcha.execute("6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9", { action: "contact_form" }).then(function(token) {
	var forms = document.querySelectorAll('form[action^="/contact"]');

	forms.forEach(function(form) {
	  var contact_form_flag = form.querySelector('input[name="form_type"][value="contact"]');

	  if(contact_form_flag === null) {
		 return;
	  }

	  var tokenInput = form.querySelector('input[name=recaptcha-v3-token]');
	  if (tokenInput instanceof HTMLElement) {
		 tokenInput.setAttribute("value", token);
	  }
	  else {
		 tokenInput = document.createElement("input");
		 tokenInput.setAttribute("name", "recaptcha-v3-token");
		 tokenInput.setAttribute("type", "hidden");
		 tokenInput.setAttribute("value", token);
		 form.appendChild(tokenInput, form);
	  }
	});
 });
};</script>
<script>document.addEventListener('DOMContentLoaded', function() {
 // Look for a contact form
 var form = document.querySelector('form[action^="/contact"] input[name="form_type"][value="contact"]');
 if (form === null) {
	return;
 }

 // If found, inject reCAPTCHA V3
 var recaptchaV3Script = document.createElement("script");
 recaptchaV3Script.setAttribute("src", "https://www.recaptcha.net/recaptcha/api.js?onload=storefrontFormsRecaptchaCallback&render=6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9&hl=en");

 document.body.appendChild(recaptchaV3Script);

 return;
});</script>
<script>document.addEventListener('DOMContentLoaded', function() {
 // Look for reCAPTCHA disclaimer
 var spam_detection_disclaimer = document.querySelector('p[data-spam-detection-disclaimer]');

 if (spam_detection_disclaimer === null) {
	return;
 }

 var styleElement = document.createElement("style");

 document.head.appendChild(styleElement);

 // If found, hide the banner
 var styleSheet = styleElement.sheet;
 styleSheet.insertRule(".grecaptcha-badge { visibility: hidden; }");
});</script>
<script integrity="sha256-BFmLd7EQOpIHg76CWl9MJFqROXNgxiHNdyBpz5k0cRM=" crossorigin="anonymous" data-source-attribution="shopify.loadfeatures" defer="defer" src="//cdn.shopify.com/s/assets/storefront/load_feature-04598b77b1103a920783be825a5f4c245a91397360c621cd772069cf99347113.js"></script>
<script crossorigin="anonymous" defer="defer" src="//cdn.shopify.com/s/assets/shopify_pay/storefront-21b5dddfc8b64c1ad68cee3ba7448d1ffa15c24e969ebc1fbccf1a3784b659ad.js?v=20190107"></script>
<script integrity="sha256-h+g5mYiIAULyxidxudjy/2wpCz/3Rd1CbrDf4NudHa4=" data-source-attribution="shopify.dynamic-checkout" defer="defer" src="//cdn.shopify.com/s/assets/storefront/features-87e8399988880142f2c62771b9d8f2ff6c290b3ff745dd426eb0dfe0db9d1dae.js" crossorigin="anonymous"></script>


<style id="shopify-dynamic-checkout-cart">@media screen and (min-width: 750px) {
 #dynamic-checkout-cart {
	min-height: 50px;
 }
}

@media screen and (max-width: 750px) {
 #dynamic-checkout-cart {
	min-height: 240px;
 }
}
</style><script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
 <link rel="canonical" href="https://themes.materializecss.com/pages/admin-calendar">
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><link href="https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js" rel="preload" as="script"><iframe src="about:blank" title="" loading="eager" style="width: 0px; height: 0px; border: 0px; display: none;"></iframe></head>
 <body class="has-fixed-sidenav" cz-shortcut-listen="true">
	<header>
	  {{-- <div class="navbar-fixed">
		 <nav class="navbar white">
			<div class="nav-wrapper"><a href="#!" class="brand-logo grey-text text-darken-4">Calendar</a>
			  <ul id="nav-mobile" class="right">
				 <li class="hide-on-med-and-down"><a href="/products/admin">Buy Now!</a></li>
				 <li class="hide-on-med-and-down"><a href="#!" data-target="dropdown1" class="dropdown-trigger waves-effect"><i class="material-icons">notifications</i></a><div id="dropdown1" class="dropdown-content notifications" tabindex="0">
		 <div class="notifications-title" tabindex="0">notifications</div>
		 <div class="card" tabindex="0">
			<div class="card-content"><span class="card-title">Joe Smith made a purchase</span>
			  <p>Content</p>
			</div>
			<div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
		 </div>
		 <div class="card" tabindex="0">
			<div class="card-content"><span class="card-title">Daily Traffic Update</span>
			  <p>Content</p>
			</div>
			<div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
		 </div>
		 <div class="card" tabindex="0">
			<div class="card-content"><span class="card-title">New User Joined</span>
			  <p>Content</p>
			</div>
			<div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
		 </div>
	  </div></li>
				 <li><a href="#!" data-target="chat-dropdown" class="dropdown-trigger waves-effect"><i class="material-icons">settings</i></a><div id="chat-dropdown" class="dropdown-content dropdown-tabbed" tabindex="0">
		 <ul class="tabs tabs-fixed-width" tabindex="0">
			<li class="tab col s3"><a href="#settings">Settings</a></li>
			<li class="tab col s3"><a href="#friends" class="active">Friends</a></li>
		 <li class="indicator" style="left: 0px; right: 0px;"></li></ul>
		 <div id="settings" class="col s12" tabindex="0" style="display: none;">
			<div class="settings-group">
			  <div class="setting">Night Mode
				 <div class="switch right">
					<label>
					  <input type="checkbox"><span class="lever"></span>
					</label>
				 </div>
			  </div>
			  <div class="setting">Beta Testing
				 <label class="right">
					<input type="checkbox"><span></span>
				 </label>
			  </div>
			</div>
		 </div>
		 <div id="friends" class="col s12 active" tabindex="0">
			<ul class="collection flush">
			  <li class="collection-item avatar">
				 <div class="badged-circle online"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait1.jpg?v=1218798423999129079" alt="avatar" class="circle"></div><span class="title">Jane Doe</span>
				 <p class="truncate">Lo-fi you probably haven heard of them</p>
			  </li>
			  <li class="collection-item avatar">
				 <div class="badged-circle"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait2.jpg?v=15342908036415923195" alt="avatar" class="circle"></div><span class="title">John Chang</span>
				 <p class="truncate">etsy leggings raclette kickstarter four dollar toast</p>
			  </li>
			  <li class="collection-item avatar">
				 <div class="badged-circle"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait3.jpg?v=4679613373594475586" alt="avatar" class="circle"></div><span class="title">Lisa Simpson</span>
				 <p class="truncate">Raw denim fingerstache food truck chia health goth synth</p>
			  </li>
			</ul>
		 </div>
	  </div></li>
			  </ul><a href="#!" data-target="sidenav-left" class="sidenav-trigger left"><i class="material-icons black-text">menu</i></a>
			</div>
		 </nav>
	  </div> --}}

	  {{-- <ul id="sidenav-left" class="sidenav sidenav-fixed">
		 <li><a href="/pages/admin-dashboard" class="logo-container">Admin<i class="material-icons left">spa</i></a></li>
		 <li class="no-padding">
			<ul class="collapsible collapsible-accordion">
			  <li class="bold waves-effect"><a class="collapsible-header" tabindex="0">Pages<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body">
					<ul>
					  <li><a href="/pages/admin-dashboard" class="waves-effect">Dashboard<i class="material-icons">web</i></a></li>
					  <li><a href="/pages/admin-fixed-chart" class="waves-effect">Fixed Chart<i class="material-icons">list</i></a></li>
					  <li><a href="/pages/admin-grid" class="waves-effect">Grid<i class="material-icons">dashboard</i></a></li>
					  <li><a href="/pages/admin-chat" class="waves-effect">Chat<i class="material-icons">chat</i></a></li>
					</ul>
				 </div>
			  </li>
			  <li class="bold waves-effect"><a class="collapsible-header" tabindex="0">Charts<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body">
					<ul>
					  <li><a href="/pages/admin-line-charts" class="waves-effect">Line Charts<i class="material-icons">show_chart</i></a></li>
					  <li><a href="/pages/admin-bar-charts" class="waves-effect">Bar Charts<i class="material-icons">equalizer</i></a></li>
					  <li><a href="/pages/admin-area-charts" class="waves-effect">Area Charts<i class="material-icons">multiline_chart</i></a></li>
					  <li><a href="/pages/admin-doughnut-charts" class="waves-effect">Doughnut Charts<i class="material-icons">pie_chart</i></a></li>
					  <li><a href="/pages/admin-financial-charts" class="waves-effect">Financial Charts<i class="material-icons">euro_symbol</i></a></li>
					  <li><a href="/pages/admin-interactive-charts" class="waves-effect">Interactive Charts<i class="material-icons">touch_app</i></a></li>
					</ul>
				 </div>
			  </li>
			  <li class="bold waves-effect"><a class="collapsible-header" tabindex="0">Tables<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body">
					<ul>
					  <li><a href="/pages/admin-fullscreen-table" class="waves-effect">Fullscreen with Chart<i class="material-icons">show_chart</i></a></li>
					  <li><a href="/pages/admin-table-custom-elements" class="waves-effect">Table with Custom Elements<i class="material-icons">settings</i></a></li>
					</ul>
				 </div>
			  </li>
			  <li class="bold waves-effect active"><a class="collapsible-header" tabindex="0">Calendar<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body" style="display: block;">
					<ul>
					  <li><a href="/pages/admin-calendar" class="waves-effect active">Calendar<i class="material-icons">cloud</i></a></li>
					</ul>
				 </div>
			  </li>
			  <li class="bold waves-effect"><a class="collapsible-header" tabindex="0">Headers<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body">
					<ul>
					  <li><a href="/pages/admin-header-tabbed" class="waves-effect">Tabbed<i class="material-icons">tab</i></a></li>
					  <li><a href="/pages/admin-header-metrics" class="waves-effect">Metrics<i class="material-icons">web</i></a></li>
					  <li><a href="/pages/admin-header-search" class="waves-effect">Search<i class="material-icons">search</i></a></li>
					</ul>
				 </div>
			  </li>
			  <li class="bold waves-effect"><a class="collapsible-header" tabindex="0">Account<i class="material-icons chevron">chevron_left</i></a>
				 <div class="collapsible-body">
					<ul>
					  <li><a href="/pages/admin-log-in" class="waves-effect">Log In<i class="material-icons">person</i></a></li>
					  <li><a href="/pages/admin-settings" class="waves-effect">Settings<i class="material-icons">settings</i></a></li>
					</ul>
				 </div>
			  </li>
			</ul>
		 </li>
	  </ul> --}}

	  
	  
	</header>
	<main><div class="container">


 <div class="row">
	<div class="col s12">
	  <h2>Month View</h2>
	  <div class="card">
		 <div id="calendar" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div><button type="button" class="fc-prev-button fc-button fc-state-default"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default"><span class="fc-icon fc-icon-right-single-arrow"></span></button><h2>August 2020</h2></div></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table class=""><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 488px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 81px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2020-07-26"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2020-07-27"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2020-07-28"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2020-07-29"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2020-07-30"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2020-07-31"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2020-08-01"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2020-07-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2020-07-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2020-07-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2020-07-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2020-07-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2020-07-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-sat fc-past" data-date="2020-08-01"><span class="fc-day-number">1</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 81px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2020-08-02"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2020-08-03"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2020-08-04"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2020-08-05"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2020-08-06"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2020-08-07"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2020-08-08"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2020-08-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-mon fc-past" data-date="2020-08-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-tue fc-past" data-date="2020-08-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-wed fc-past" data-date="2020-08-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-thu fc-past" data-date="2020-08-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-fri fc-past" data-date="2020-08-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-sat fc-past" data-date="2020-08-08"><span class="fc-day-number">8</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 81px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2020-08-09"></td><td class="fc-day fc-widget-content fc-mon fc-today " data-date="2020-08-10"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2020-08-11"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2020-08-12"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2020-08-13"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2020-08-14"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2020-08-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2020-08-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-mon fc-today " data-date="2020-08-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-tue fc-future" data-date="2020-08-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-wed fc-future" data-date="2020-08-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-thu fc-future" data-date="2020-08-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-fri fc-future" data-date="2020-08-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-sat fc-future" data-date="2020-08-15"><span class="fc-day-number">15</span></td></tr></thead><tbody><tr><td class="fc-event-container" colspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Long Event</span></div><div class="fc-resizer fc-end-resizer"></div></a></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">All Day Event</span></div><div class="fc-resizer fc-end-resizer"></div></a></td><td class="fc-event-container" rowspan="9"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">7a</span> <span class="fc-title">Birthday Party</span></div></a></td><td rowspan="9"></td><td rowspan="9"></td><td rowspan="9"></td></tr><tr><td rowspan="8"></td><td rowspan="8"></td><td class="fc-event-container fc-limited"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable" href="http://google.com/"><div class="fc-content"> <span class="fc-title">Click for Google</span></div><div class="fc-resizer fc-end-resizer"></div></a></td><td class="fc-more-cell" rowspan="1"><div><a class="fc-more">+8 more</a></div></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">2:30p</span> <span class="fc-title">Meeting</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">4p</span> <span class="fc-title">Repeating Event</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">4p</span> <span class="fc-title">Repeating Event</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">5:30p</span> <span class="fc-title">Happy Hour</span></div></a></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable"><div class="fc-content"><span class="fc-time">8p</span> <span class="fc-title">Dinner</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 81px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2020-08-16"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2020-08-17"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2020-08-18"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2020-08-19"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2020-08-20"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2020-08-21"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2020-08-22"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2020-08-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-mon fc-future" data-date="2020-08-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-tue fc-future" data-date="2020-08-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-wed fc-future" data-date="2020-08-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-thu fc-future" data-date="2020-08-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-fri fc-future" data-date="2020-08-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-sat fc-future" data-date="2020-08-22"><span class="fc-day-number">22</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 81px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2020-08-23"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2020-08-24"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2020-08-25"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2020-08-26"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2020-08-27"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2020-08-28"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2020-08-29"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2020-08-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-mon fc-future" data-date="2020-08-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-tue fc-future" data-date="2020-08-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-wed fc-future" data-date="2020-08-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-thu fc-future" data-date="2020-08-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-fri fc-future" data-date="2020-08-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-sat fc-future" data-date="2020-08-29"><span class="fc-day-number">29</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 83px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2020-08-30"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2020-08-31"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2020-09-01"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2020-09-02"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2020-09-03"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2020-09-04"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2020-09-05"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2020-08-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-mon fc-future" data-date="2020-08-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2020-09-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2020-09-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2020-09-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2020-09-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2020-09-05"><span class="fc-day-number">5</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
	  </div>
	</div>
 </div>

 <div class="row">
	<div class="col s12">
	  <h2>Week View</h2>
	  <div class="card">
		 <div id="calendar-week" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><h2>Aug 9 – 15, 2020</h2></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-agendaWeek-view fc-agenda-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header" style="border-right-width: 1px; margin-right: 16px;"><table class=""><thead><tr><th class="fc-axis fc-widget-header" style="width: 43px;"></th><th class="fc-day-header fc-widget-header fc-sun fc-past" data-date="2020-08-09"><span>09</span></th><th class="fc-day-header fc-widget-header fc-mon fc-today" data-date="2020-08-10"><span>10</span></th><th class="fc-day-header fc-widget-header fc-tue fc-future" data-date="2020-08-11"><span>11</span></th><th class="fc-day-header fc-widget-header fc-wed fc-future" data-date="2020-08-12"><span>12</span></th><th class="fc-day-header fc-widget-header fc-thu fc-future" data-date="2020-08-13"><span>13</span></th><th class="fc-day-header fc-widget-header fc-fri fc-future" data-date="2020-08-14"><span>14</span></th><th class="fc-day-header fc-widget-header fc-sat fc-future" data-date="2020-08-15"><span>15</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="border-right-width: 1px; margin-right: 16px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-axis fc-widget-content" style="width: 43px;"><span>all-day</span></td><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2020-08-09"></td><td class="fc-day fc-widget-content fc-mon fc-today " data-date="2020-08-10"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2020-08-11"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2020-08-12"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2020-08-13"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2020-08-14"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2020-08-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><tbody><tr><td class="fc-axis" style="width: 43px;"></td><td class="fc-event-container" colspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Long Event</span></div><div class="fc-resizer fc-end-resizer"></div></a></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">All Day Event</span></div><div class="fc-resizer fc-end-resizer"></div></a></td><td rowspan="2"></td><td rowspan="2"></td><td rowspan="2"></td><td rowspan="2"></td></tr><tr><td class="fc-axis" style="width: 43px;"></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable" href="http://google.com/"><div class="fc-content"> <span class="fc-title">Click for Google</span></div><div class="fc-resizer fc-end-resizer"></div></a></td></tr></tbody></table></div></div></div><hr class="fc-divider fc-widget-header"><div class="fc-scroller fc-time-grid-container" style="overflow: hidden scroll; height: 370px;"><div class="fc-time-grid fc-unselectable"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-axis fc-widget-content" style="width: 43px;"></td><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2020-08-09"></td><td class="fc-day fc-widget-content fc-mon fc-today " data-date="2020-08-10"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2020-08-11"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2020-08-12"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2020-08-13"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2020-08-14"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2020-08-15"></td></tr></tbody></table></div><div class="fc-slats"><table class=""><tbody><tr data-time="00:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>12am</span></td><td class="fc-widget-content"></td></tr><tr data-time="00:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="01:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>1am</span></td><td class="fc-widget-content"></td></tr><tr data-time="01:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="02:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>2am</span></td><td class="fc-widget-content"></td></tr><tr data-time="02:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="03:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>3am</span></td><td class="fc-widget-content"></td></tr><tr data-time="03:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="04:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>4am</span></td><td class="fc-widget-content"></td></tr><tr data-time="04:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="05:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>5am</span></td><td class="fc-widget-content"></td></tr><tr data-time="05:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="06:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>6am</span></td><td class="fc-widget-content"></td></tr><tr data-time="06:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="07:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>7am</span></td><td class="fc-widget-content"></td></tr><tr data-time="07:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="08:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>8am</span></td><td class="fc-widget-content"></td></tr><tr data-time="08:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="09:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>9am</span></td><td class="fc-widget-content"></td></tr><tr data-time="09:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="10:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>10am</span></td><td class="fc-widget-content"></td></tr><tr data-time="10:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="11:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>11am</span></td><td class="fc-widget-content"></td></tr><tr data-time="11:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="12:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>12pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="12:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="13:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>1pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="13:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="14:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>2pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="14:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="15:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>3pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="15:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="16:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>4pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="16:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="17:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>5pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="17:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="18:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>6pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="18:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="19:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>7pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="19:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="20:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>8pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="20:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="21:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>9pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="21:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="22:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>10pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="22:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr><tr data-time="23:00:00"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"><span>11pm</span></td><td class="fc-widget-content"></td></tr><tr data-time="23:30:00" class="fc-minor"><td class="fc-axis fc-time fc-widget-content" style="width: 43px;"></td><td class="fc-widget-content"></td></tr></tbody></table></div><hr class="fc-divider fc-widget-header" style="display:none"><div class="fc-content-skeleton"><table><tbody><tr><td class="fc-axis" style="width: 43px;"></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 451px; bottom: -537px; z-index: 1; left: 0%; right: 0%; margin-right: 20px;"><div class="fc-content"><div class="fc-time" data-start="10:30" data-full="10:30 AM - 12:30 PM"><span>10:30 - 12:30</span></div><div class="fc-title">Meeting</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 515px; bottom: -601px; z-index: 2; left: 50%; right: 0%;"><div class="fc-content"><div class="fc-time" data-start="12:00" data-full="12:00 PM"><span>12:00</span></div><div class="fc-title">Lunch</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 623px; bottom: -709px; z-index: 1; left: 0%; right: 33.3333%; margin-right: 20px;"><div class="fc-content"><div class="fc-time" data-start="2:30" data-full="2:30 PM"><span>2:30</span></div><div class="fc-title">Meeting</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 687px; bottom: -773px; z-index: 2; left: 33.3333%; right: 0%; margin-right: 20px;"><div class="fc-content"><div class="fc-time" data-start="4:00" data-full="4:00 PM"><span>4:00</span></div><div class="fc-title">Repeating Event</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 687px; bottom: -773px; z-index: 3; left: 66.6667%; right: 0%;"><div class="fc-content"><div class="fc-time" data-start="4:00" data-full="4:00 PM"><span>4:00</span></div><div class="fc-title">Repeating Event</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 752px; bottom: -838px; z-index: 1; left: 0%; right: 33.3333%; margin-right: 20px;"><div class="fc-content"><div class="fc-time" data-start="5:30" data-full="5:30 PM"><span>5:30</span></div><div class="fc-title">Happy Hour</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 859px; bottom: -945px; z-index: 1; left: 0%; right: 0%;"><div class="fc-content"><div class="fc-time" data-start="8:00" data-full="8:00 PM"><span>8:00</span></div><div class="fc-title">Dinner</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable" style="top: 300px; bottom: -386px; z-index: 1; left: 0%; right: 0%;"><div class="fc-content"><div class="fc-time" data-start="7:00" data-full="7:00 AM"><span>7:00</span></div><div class="fc-title">Birthday Party</div></div><div class="fc-bg"></div><div class="fc-resizer fc-end-resizer"></div></a></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td><td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td></tr></tbody></table></div></div></div></td></tr></tbody></table></div></div></div>
	  </div>
	</div>
 </div>

 <div class="row">
	<div class="col s12">
	  <h2>Day View</h2>
	  <div class="card">
		 <div id="calendar-day"></div>
	  </div>
	</div>
 </div>

 <div class="row">
	<div class="col s12">
	  <h2>List View</h2>
	  <div class="card">
		 <div id="calendar-list" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar">
			 
			<div class="fc-left">
				<div>
					<button type="button" class="fc-today-button fc-button fc-state-default fc-state-disabled" disabled="">today</button><button type="button" class="fc-prev-button fc-button fc-state-default"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default"><span class="fc-icon fc-icon-right-single-arrow"></span></button><h2>August 2020</h2>
			</div>
		</div>
		 
		 <div class="fc-right"></div><div class="fc-center"></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-listMonth-view fc-list-view fc-widget-content" style=""><div class="fc-scroller" style="overflow: hidden auto; height: 514px;"><table class="fc-list-table "><tbody><tr class="fc-list-heading" data-date="2020-08-09"><td class="fc-widget-header" colspan="3"><span class="fc-list-heading-main">Sun</span><span class="fc-list-heading-alt">Aug 9</span></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">all-day</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Long Event</a></td></tr><tr class="fc-list-heading" data-date="2020-08-10"><td class="fc-widget-header" colspan="3"><span class="fc-list-heading-main">Mon</span><span class="fc-list-heading-alt">Aug 10</span></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">all-day</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Long Event</a></td></tr><tr class="fc-list-heading" data-date="2020-08-11"><td class="fc-widget-header" colspan="3"><span class="fc-list-heading-main">Tue</span><span class="fc-list-heading-alt">Aug 11</span></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">all-day</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>All Day Event</a></td></tr><tr class="fc-list-item fc-has-url"><td class="fc-list-item-time fc-widget-content">all-day</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a href="http://google.com/">Click for Google</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">10:30am - 12:30pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Meeting</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">12:00pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Lunch</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">2:30pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Meeting</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">4:00pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Repeating Event</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">4:00pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Repeating Event</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">5:30pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Happy Hour</a></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">8:00pm</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Dinner</a></td></tr><tr class="fc-list-heading" data-date="2020-08-12"><td class="fc-widget-header" colspan="3"><span class="fc-list-heading-main">Wed</span><span class="fc-list-heading-alt">Aug 12</span></td></tr><tr class="fc-list-item"><td class="fc-list-item-time fc-widget-content">7:00am</td><td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot"></span></td><td class="fc-list-item-title fc-widget-content"><a>Birthday Party</a></td></tr></tbody></table></div></div></div></div>
	  </div>
	</div>
 </div>

</div>

	</main>
	
{{-- <footer class="page-footer">
 <div class="container">
	<div class="row">
	  <div class="col s6 m3">
		 <img class="materialize-logo" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/materialize-logo.png?v=17909639059119771368" alt="Materialize">
		 <p>Made with love by Materialize.</p>
	  </div>
	  <div class="col s6 m3">
		 <h5>About</h5>
		 <ul>
			<li><a href="#!">Blog</a></li>
			<li><a href="#!">Pricing</a></li>
			<li><a href="#!">Docs</a></li>
		 </ul>
	  </div>
	  <div class="col s6 m3">
		 <h5>Connect</h5>
		 <ul>
			<li><a href="#!">Community</a></li>
			<li><a href="#!">Subscribe</a></li>
			<li><a href="#!">Email</a></li>
		 </ul>
	  </div>
	  <div class="col s6 m3">
		 <h5>Contact</h5>
		 <ul>
			<li><a href="#!">Twitter</a></li>
			<li><a href="#!">Facebook</a></li>
			<li><a href="#!">Github</a></li>
		 </ul>
	  </div>
	</div>
 </div>
</footer>
 --}}
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>

<!-- External libraries -->

<!-- jqvmap -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script type="text/javascript" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/jquery.vmap.min.js?v=16312383892908448454"></script>
<script type="text/javascript" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/jquery.vmap.world.js?v=7251365059269487148" charset="utf-8"></script>
<script type="text/javascript" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/jquery.vmap.sampledata.js?v=8702362987075556685"></script>

<!-- ChartJS -->

<script type="text/javascript" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/Chart.js?v=2884891905158527706"></script>
<script type="text/javascript" src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/Chart.Financial.js?v=3464499164675255295"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/imagesloaded.pkgd.min.js?v=5881977179676351054"></script>
<script src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/masonry.pkgd.min.js?v=18031290468259756901"></script>


<!-- Initialization script -->
<script src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/admin-materialize.min.js?v=2611245393728459541"></script>
 
<div class="sidenav-overlay"></div><div class="drag-target"></div></body></html>