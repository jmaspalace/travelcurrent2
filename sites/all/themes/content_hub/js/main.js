var h_screen = jQuery(window).height(),
	w_screen = jQuery(window).width(),
	h_header = jQuery("header").height(),
	//h_footer = jQuery("footer").height(),
	//custom_event = jQuery.support.touch ? "tap" : "click",
	isMobile,
	bgModule,
	bit_url_short,
	status_menu="close",
	tags=0,
	resolucionMinima=960;

		
function getResolution(){
	h_screen = jQuery(window).height();
	w_screen = jQuery(window).width();
	//evalMobile();
}


function evalMobile(){
	if(w_screen>=resolucionMinima){
		isMobile=false;
	}else{
		isMobile=true;
	}
}

//Landscape
jQuery(window).bind('orientationchange', function(e) {
  switch( window.orientation ){
    case 90:
		jQuery( ".lbox-alert-mobile" ).css("display","block");
		jQuery(".landscape").addClass("landscape2");
		jQuery( ".landscape" ).css("display","none");
		jQuery( ".landscape2" ).css("display","block");
       break;

    case -90:
       jQuery( ".lbox-alert-mobile" ).css("display","block");
		jQuery(".landscape").removeClass("landscape2");
		jQuery( ".landscape2" ).css("display","none");
		jQuery( ".landscape" ).css("display","block");
		break;
		  
	case 0:
		jQuery( ".lbox-alert-mobile" ).css("display","none");
	break;
  }
});


//Lightbox
function showLbox(){
	TweenLite.to(jQuery(".lightbox"), .3, {opacity:1, display:"block"});
}
function closeLbox(){
	TweenLite.to(jQuery(".lightbox"), .3, {opacity:0, display:"none", delay:.3, onComplete:cleanWrapperLbox});
}


function showWrapperLbox(obj){
	showLbox();
	addClassWrapperLbox(obj);
	htmlWrapperLbox(obj);
	TweenLite.to(jQuery(".lightbox .wrapper-lbox"), .5, {opacity:1, display:"block", top:"50%", delay:.4});
}
function hideWrapperLbox(){
	TweenLite.to(jQuery(".lightbox .wrapper-lbox"), .5, {opacity:0, display:"none", top:"45%"});
	closeLbox();
}


function addClassWrapperLbox(obj){
	if(jQuery(obj).hasClass("embed-video")){
		var customClass = "embed-video";
		jQuery(".wrapper-lbox").addClass(customClass);
	}
}
function htmlWrapperLbox(obj){
	if(jQuery(obj).hasClass("embed-video")){
		var urlVideo = jQuery(obj).attr("url-video");
		jQuery(".wrapper-lbox .body-lbox").addClass("embed-responsive embed-responsive-16by9");
		jQuery(".wrapper-lbox .body-lbox").html("<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/"+urlVideo+"?&amp;autohide=1&amp;showinfo=0;&amp;autoplay=1&amp;rel=0'></iframe>");
	}
}
function cleanWrapperLbox(){
	if(jQuery(".wrapper-lbox").hasClass("embed-video")){
		jQuery(".wrapper-lbox .body-lbox").html("");
		jQuery(".wrapper-lbox .body-lbox").attr("class", "body-lbox");
	}
	jQuery(".wrapper-lbox").attr("class", "wrapper-lbox");
}
//Lightbox



//Menu
function hoverColMenu(){
	var obj = jQuery("header .content-nav .sub-menu.col-layout .wrapper-categories ul li a.selected");
	var imgCat = jQuery(obj).parent().find(".hidden .image-categorie").html();
	var titleCat = jQuery(obj).parent().find(".hidden h3").html();
	var pCat = jQuery(obj).parent().find(".hidden p").html();
	
	jQuery("header.header .content-nav nav ul.menu li.expanded .sub-menu.col-layout .row.last").find("img").attr("src", imgCat);
	jQuery("header.header .content-nav nav ul.menu li.expanded .sub-menu.col-layout .row.last").find("h3").html(titleCat);
	jQuery("header.header .content-nav nav ul.menu li.expanded .sub-menu.col-layout .row.last").find("p").html(pCat);
}
function hoverParentMenu(elem){
	var obj = jQuery(elem).parent().find(".sub-menu.col-layout .wrapper-categories ul li:first-child a");
	var imgCat = jQuery(obj).parent().find(".hidden .image-categorie").html();
	var titleCat = jQuery(obj).parent().find(".hidden h3").html();
	var pCat = jQuery(obj).parent().find(".hidden p").html();
	
	jQuery(elem).parent().find(".sub-menu.col-layout .row.last img").attr("src", imgCat);
	jQuery(elem).parent().find(".sub-menu.col-layout .row.last h3").html(titleCat);
	jQuery(elem).parent().find(".sub-menu.col-layout .row.last p").html(pCat);
}
//Menu



function insertBgModule(obj){
	for (var i = 0; i < jQuery(obj).length; i++){
   		if(w_screen>= 970){
			bgModule = jQuery(obj).eq(i).attr("bg-mod-d");	
			jQuery(obj).eq(i).css('background-image', 'url('+ bgModule +')');
		}else{
			bgModule = jQuery(obj).eq(i).attr("bg-mod-m");
			jQuery(obj).eq(i).css('background-image', 'url('+ bgModule +')');
		}
	}
}

function imgPosition(parentObj,obj){
	var wImg;
	var hImg;
	var qImg;
	
	for(var i=0; i < jQuery(parentObj).length ; i++){
		if(jQuery(parentObj).eq(i).find(".content-principal").length == 1){
			qImg = jQuery(parentObj).eq(i).find(obj);
		
			for(var b=0; b < qImg.length; b++){
				if(jQuery(qImg).eq(b).is(':visible')){
					jQuery(qImg).eq(b).removeClass("hide-image");
					jQuery(qImg).eq(b).addClass("visible");
				}else{
					jQuery(qImg).eq(b).removeClass("visible");
					jQuery(qImg).eq(b).addClass("hide-image");
				}
			}

			wImg = jQuery(parentObj).eq(i).find(obj+".visible").css("width");
			wImg = wImg.replace("px", "");

			hImg = jQuery(parentObj).eq(i).find(obj+".visible").css("height");
			hImg = hImg.replace("px", "");

			jQuery(parentObj).eq(i).find(obj+".visible").css({
				"margin-left": -wImg/2,
				"margin-top": -hImg/2,
			});
		}
	}
}

function selectTransform(obj){
	jQuery(obj).jqTransform();
}


//Filter WCU
function filterSize(){
	var arrItems = jQuery('.article-wcu-home .content header ul li');
	var suma_w_Items = 0;
	for (i=0; i < arrItems.length; i++){
		var w_Items = jQuery(arrItems[i]).css("width");
		w_Items = ( w_Items.replace("px", "") ) * 1;//esto lo convierte en un número
		suma_w_Items += w_Items;
	};
	jQuery(".article-wcu-home .content header ul").css("width", suma_w_Items+50);
}

function overThumbArticle(obj){
	jQuery(obj).hover(function(){
		TweenLite.to(jQuery(this).find(".field-link"), .3, {display:"block", opacity:1, ease:Quad.easeOut});
		TweenLite.to(jQuery(this).find(".field-link span"), .3, {opacity:1, ease:Quad.easeOut, delay:.2});
	},function(){
		TweenLite.to(jQuery(this).find(".field-link span"), .3, {opacity:0, ease:Quad.easeOut});
		TweenLite.to(jQuery(this).find(".field-link"), .3, {display:"none", opacity:0, ease:Quad.easeOut, delay:.2});
	});
}

function textSlider(){
	var slide = jQuery(".slider-home .flexslider .slides > li");
	for(i = 0; i < slide.length; i++){
		var pSlide = jQuery(".slider-home .flexslider .slides > li:eq("+i+") .views-field-field-button-position");
		if(pSlide.html() == "3"){
			jQuery(pSlide).parent().addClass("right");
		}else if(pSlide.html() == "2"){
			jQuery(pSlide).parent().addClass("left");
		}else if(pSlide.html() == "1"){
			jQuery(pSlide).parent().addClass("center");
		}
	}
}


//Google Maps
//var markers = [];
/*var map;
var image;

function myMap(){
	var myLatlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
        center: myLatlng,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
	map = new google.maps.Map(document.getElementById("map"), mapOptions);
	
	image = 'images/marker-gmaps.png';
	
	 var contentString = '<div id="content">'+
     '<div id="siteNotice">'+
     '</div>'+
     '<h1 id="firstHeading" class="firstHeading">Lorem Ipsun</h1>'+
     '<div id="bodyContent">'+
     '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
     'sandstone rock formation in the southern part of the '+
     'Northern Territory, central Australia. It lies 335 km (208 mi).</p>'+
     '</div>'+
     '</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		 maxWidth: 200
	});
	
	marker = new google.maps.Marker({
    	position: myLatlng,
    	map: map,
		icon: image,
		animation: google.maps.Animation.DROP
  	});
	
	marker.addListener('click', function() {
    	infowindow.open(map, marker);
  	});
}*/


function openMenu(obj){
	if(status_menu !== "close"){
		TweenLite.to(jQuery("header.header .content-nav nav ul.menu li .sub-menu"), .3, {display:"none", opacity:0});
		TweenLite.to(jQuery("header.header .content-nav nav ul.menu li .arrow"), .3, {display:"none", opacity:0, delay:.2});
		TweenLite.to(jQuery(obj).parent().find(".sub-menu"), .3, {display:"block", opacity:1});
		TweenLite.to(jQuery(obj).parent().find("> .arrow"), .3, {display:"block", opacity:1, delay:.2});
		jQuery(".close-menu-desktop").click(function(){
			closeMenu();
		});
	}
}

function closeMenu(){
	TweenLite.to(jQuery("header.header .content-nav nav ul.menu li .arrow"), .3, {display:"none", opacity:0});
	TweenLite.to(jQuery("header.header .content-nav nav ul.menu li .sub-menu"), .3, {display:"none", opacity:0, delay:.2});
	status_menu="close";
}


//Share Facebook
function callback(response){}

function postToFeed(){
	// calling the API ...
	var obj = {
	  method: 'feed',
	  link: document.URL,
	  picture: jQuery( ".product-image-gallery #image-main" ).attr( "src" ),
	  name: document.title,
	  caption: 'The Travel Current',
	  description: jQuery( ".node-type-article article.main .content-share .summary" ).html()
	};
	FB.ui(obj, callback);
}

function showSearch(){
	TweenLite.to(jQuery("header.header .content-nav .wrapper-input-search-menu"), .3, {width:"125%"});
	TweenLite.to(jQuery("header.header .content-nav .wrapper-input-search-menu .close-search-menu"), .3, {opacity:1, display:"block", delay:.3});
	
	jQuery("header.header .content-nav .wrapper-input-search-menu .close-search-menu").click(function(){
		TweenLite.to(jQuery("header.header .content-nav .wrapper-input-search-menu .close-search-menu"), .3, {opacity:0, display:"none"});
		TweenLite.to(jQuery("header.header .content-nav .wrapper-input-search-menu"), .3, {width:0, delay:.1});
	});
}


//WCU
function availableLi(){
	var wcuLi = jQuery(".article-wcu .content header ul li");
	for(i=0;i<wcuLi.length;i++){
		var actualLi = jQuery(".article-wcu .content header ul li").eq(i).find("a").text();
		if(wcu_data[actualLi]){
			jQuery(".article-wcu .content header ul li").eq(i).addClass("available");
		}
	}
}
//WCU


//MENU MOBILE
function mobileMenu(obj){
	var actualMenu = jQuery(obj).parent().find(".sub-menu.dropdown-menu");
	TweenLite.to(jQuery(actualMenu), .4, {left:0, opacity:1, display:"block"});
	
	setTimeout(function(){
		jQuery(actualMenu).find(".wrapper-categories > ul > li").each(function(i) {
			jQuery(this).delay((i + 1) * 200).animate({
				opacity: 1
			}, 200);
		});
	},200);
}

function backMenu(obj){
	var actualMenu = jQuery(obj).parent();
	TweenLite.to(jQuery(actualMenu), .4, {left:"110%", opacity:0, display:"none"});
	setTimeout(function(){
		jQuery(actualMenu).find(".wrapper-categories > ul > li").css("opacity",0);
	},300);
}
//MENU MOBILE


//CLONE TAGS
function cloneTag(){
	if(w_screen<=1200){
		tags=1;
		var tagsLength = jQuery(".page-taxonomy-term .category-page .tags-taxonomy").length;
		if(tags!=0 && tagsLength==0){
			var htmlTags=jQuery("article.category-block.featured-top .content-tags").html();
			jQuery(".page-taxonomy-term .category-page").append("<section class='tags-taxonomy'><div class='container'><div class='content-tags'>"+htmlTags+"</div></div></section>");
		}
		//console.log("tags");
	}else{
		tags=0;
		var tagsHtml = jQuery(".page-taxonomy-term .category-page .tags-taxonomy");
		if(tagsHtml!=0){
			tagsHtml.remove();
		}
		//console.log("no tags");
	}
}
//CLONE TAGS


//ARTICLE VIDEO IFRAME
var player;
var idVideo;
function onYouTubeIframeAPIReady(){
	idVideo = jQuery(".node-type-video .wrapper-video").attr("url-video");
	player = new YT.Player('player', {
		videoId: idVideo,
		playerVars: {'showinfo': 0, 'rel': 0},
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
	event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
var done = false;
function onPlayerStateChange(event) {        
	if(event.data === 0) {            
		jQuery(".node-type-video .wrapper-video .mask-video").html("<div class='play-video embed-video'><div class='icon-play'></div></div><div id='player'></div>");
		jQuery(".node-type-video .mask-video .play-video").click(function(){
			onYouTubeIframeAPIReady();
			jQuery(this).remove();
		});
	}
}
function stopVideo() {
	player.stopVideo();
}
//ARTICLE VIDEO IFRAME



function detectMenu(){
	var numLis = jQuery(".content-nav nav > ul.menu > li");
	for(i=0;i<numLis.length;i++){
		var compareHref = jQuery(".content-nav nav > ul.menu > li").eq(i).find("a");
		if(window.location.href.indexOf(jQuery(compareHref).attr("href")) > -1){
			jQuery(".content-nav nav > ul.menu > li").removeClass("active");
			jQuery(compareHref).parent().addClass("active");
		}
		
		if(window.location.pathname == "/"){
			jQuery(".content-nav nav > ul.menu > li:eq(0)").addClass("active");
		}
	}
}


var scroll_site;
var newsActive=0;
function topNews(){
	if(localStorage.hideNews != "hide"){
		scroll_site = document.documentElement.scrollTop || document.body.scrollTop;
		var h_news = jQuery(".block-newsletter").height();

		if(w_screen > 540){
			if(scroll_site < (jQuery("html").height()-h_screen*3/2)){
				if(newsActive === 0){
					//TweenLite.to(jQuery(".block-newsletter"), .1, {opacity:0, position:"absolute", bottom:-(scroll_site+h_screen)});
					jQuery(".block-newsletter #close-news-block").show();
					jQuery(".block-newsletter").css({
						position: 'absolute',
						top: scroll_site+h_screen,
						opacity: 0,
						zIndex:10
					});
					jQuery("footer").css({
						paddingTop: h_news
					});
					TweenLite.to(jQuery(".block-newsletter"), .5, {opacity:1, top:scroll_site+h_screen-h_news, delay:0.3});
					newsActive=1;
					setTimeout(function(){
						//TweenLite.to(jQuery(".block-newsletter"), .5, {position:"fixed", bottom:0, left:0});
						jQuery(".block-newsletter").css({
							position: 'fixed',
							top: h_screen-h_news
						});
					},1000);
				}
			}else{
				TweenLite.to(jQuery(".block-newsletter"), .5, {position:"relative", top:0});
				jQuery(".block-newsletter #close-news-block").hide();
				newsActive=0;
				jQuery("footer").css({
					paddingTop: 0
				});
			}	
		}
	}else{
		jQuery(".block-newsletter #close-news-block").hide();
	}
}


jQuery(document).ready(function() {

	getResolution();
	//detectMenu();
	insertBgModule(".custom-bg-block");
	
	
	
	//banner reservation
	if(w_screen>540){
		setTimeout(function(){
			jQuery(".btn-close-banner").trigger("click");
		},1000);
	}else{
		if(jQuery(".category-reservation").length != 0 && localStorage.hideNews != "true"){
			setTimeout(function(){
				jQuery(".btn-close-banner").trigger("click");
			},1000);
			//TweenLite.to(jQuery(".category-reservation"), 1, {bottom:0, delay:.6});
		}	
	}
	
	
	jQuery(".node-type-article article.main .category-reservation .btn-close-banner").click(function(){
		if(w_screen>540){
			TweenLite.to(jQuery(".category-reservation"), .5, {right:"-237px", delay:.3});
			TweenLite.to(jQuery(".category-reservation .compact-banner"), .5, {left:0, delay:.5});
		}else{
			TweenLite.to(jQuery(".category-reservation"), .5, {bottom:"-20%", delay:.3});
			TweenLite.to(jQuery(".category-reservation .compact-banner"), .5, {top:"-150%", delay:.3});
		}
		TweenLite.to(jQuery(this), .5, {display:"none", opacity:0, delay:.1});
	});
	
	jQuery(".node-type-article article.main .category-reservation .compact-banner").click(function(){
		if(w_screen>540){
			TweenLite.to(jQuery(this), .8, {left:"100%", delay:.1});
			TweenLite.to(jQuery(".category-reservation"), .5, {right:0, delay:.5});
		}else{
			TweenLite.to(jQuery(this), .8, {top:"100%", delay:.1});
			TweenLite.to(jQuery(".category-reservation"), .5, {bottom:0, delay:.5});
		}
		TweenLite.to(jQuery(".btn-close-banner"), .5, {display:"block", opacity:1, delay:.3});
	});
	
	
	
	//Submit Newsletter
	setTimeout(function(){
		topNews();
	},500);
	
	jQuery("#block-webform-client-block-39").append("<div id='close-news-block'></div>");
	jQuery(".block-newsletter #close-news-block").click(function(){
		jQuery(this).hide();
		localStorage.setItem("hideNews", "hide");
		TweenLite.to(jQuery(".block-newsletter"), .5, {position:"relative", top:0});
		newsActive=0;
		jQuery("footer").css({paddingTop: 0});
	});
	
	jQuery("#block-webform-client-block-39 .webform-submit").click(function(event){
		var email = jQuery("#edit-submitted-email");
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var isEmail=re.test(email.val());
		if(isEmail){
			jQuery(email).css("border","1px solid #38404d");
		}else{
			event.preventDefault();
			jQuery(email).css("border","1px solid #e9434e");
			jQuery("#webform-client-form-39 > div .form-item label").html("Invalid mail format<span class='arrow'></span>");
			TweenLite.to(jQuery("#webform-client-form-39 > div .form-item label"), .6, {display:"block", opacity:1, top:"-65px"});
			TweenLite.to(jQuery("#webform-client-form-39 > div .form-item label"), .6, {display:"none", opacity:0, top:"-50px", delay:3});
		}
	})
	
	//message status
	if(jQuery("div.messages").length != 0){
		TweenLite.to(jQuery("div.messages"), .6, {display:"block", opacity:1});
		TweenLite.to(jQuery("div.messages"), .6, {display:"none", opacity:0, delay:4});
	}
	
	jQuery(".flexslider").flexslider({
    	//animation: "slide"
  	});
	
	cloneTag();
	
	textSlider();
	
	filterSize();
	
	selectTransform("form.jqtransform");
	
	overThumbArticle("section article .cont-image");
	
	//imgPosition("article.category-block", ".content-principal .cont-image img");
	
	$(".article-wcu-home .content header .wrapper").mCustomScrollbar({
		theme:"minimal",
		axis:"x",
		scrollInertia: 0
	});
	
	availableLi();
	
	
	jQuery("header.header .content-nav nav ul.menu > li > a").hover(function(){
		if(w_screen>=975){
			status_menu="open"
			openMenu(this);
		}
	});
	
	jQuery("header.header .toogler-menu").click(function(){
		TweenLite.to(jQuery("header.header nav ul.menu"), .4, {display:"block", opacity:1});
		
		jQuery("header.header .content-nav nav > ul.menu > li").each(function(i) {
       		jQuery(this).delay((i + 1) * 200).animate({
    			opacity: 1
  			}, 200);
    	});
	});
	
	
	jQuery("header.header .close-menu").click(function(){
		TweenLite.to(jQuery("header.header nav ul.menu"), .4, {display:"none", opacity:0});
		setTimeout(function(){
			jQuery("header.header nav ul.menu").attr("style", "");	
		},500);
		jQuery("header.header .content-nav nav > ul.menu > li").css("opacity",0);
	});
	
	
	/*if(jQuery("#map").length != 0){
		myMap();
	}*/
	
	//Lightbox
	jQuery(".lightbox").click(function(){
		//var thisBox = jQuery(this).find("#box-news").attr("id");
		hideWrapperLbox();
	});

	jQuery(".lightbox .wrapper-lbox").click(function(e){
		e.stopPropagation();
	});
	
	
	//Player video
	jQuery(".call-lbox").click(function(){
		showWrapperLbox(this);
	});
	
	
	//hovermenu
	hoverColMenu();
		
	jQuery("header .content-nav .sub-menu.col-layout .wrapper-categories ul li a").hover(function(){
		if(w_screen>=975){
			jQuery("header .content-nav .sub-menu.col-layout .wrapper-categories ul li a").removeClass("selected");
			jQuery(this).addClass("selected");
			hoverColMenu();	
		}
	});
	
	
	jQuery("header .content-nav nav ul.menu > li > a").hover(function(){
		if(w_screen>=975){
			jQuery(this).parent().find(".sub-menu.col-layout .wrapper-categories ul li a").removeClass("selected");
			jQuery(this).parent().find(".sub-menu.col-layout .wrapper-categories ul li:first-child a").addClass("selected");
			hoverParentMenu(this);
		}
	});
	
	
	//Share Facebook
	window.fbAsyncInit = function() {
    	FB.init({
      		appId      : '1888620791212414',
      		xfbml      : true,
      		version    : 'v2.8'
    	});
  	};
	(function(d, s, id){
     	var js, fjs = d.getElementsByTagName(s)[0];
     	if (d.getElementById(id)) {return;}
     	js = d.createElement(s); js.id = id;
     	js.src = "//connect.facebook.net/en_US/sdk.js";
     	fjs.parentNode.insertBefore(js, fjs);
   	}(document, 'script', 'facebook-jssdk'));
	
	jQuery(".node-type-article article.main .content-share div.icon-fb").click(function(){
		postToFeed();
	});
	
	
	//Bitly
	function bit_url(url){ 
		var url=url;
		var username="cdiinteractive"; // bit.ly username
		var key="R_2b4502cdc2064c639700931c469e7c17";
		$.ajax({
			url:"http://api.bit.ly/v3/shorten",
			data:{longUrl:url,apiKey:key,login:username},
			dataType:"jsonp",
			success:function(v){
				bit_url_short=v.data.url;
				//console.log(bit_url_short);
				var title = jQuery( ".title-section h1" ).html();
				title = title.replace("<span>", "");
				title = title.replace("</span>", "");
				window.open( "https://twitter.com/intent/tweet?text=" + title + " " + bit_url_short, "", "width=600, height=400" );
				return false;
			}
		});
	}
	
	
	//Share News Twitter
	jQuery("article.main .content-share div.icon-twt").click(function(){
		var article_url = document.URL;
		var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
		var urltest=urlRegex.test(article_url);

		if(urltest){
			bit_url(article_url);
		}
	});
	
	//SHARE HASHTAG//
	jQuery(".btn-hash-large").click(function(){
		var desc = "Yo ya estoy #AyudanDOG a miles de #perritos en #Colombia";
		window.open( "https://twitter.com/intent/tweet?text="+ encodeURI(desc)+"", "width=600, height=400" );
		return false;
	});
	
	
	//Search Menu
	jQuery("header.header .content-nav .options-nav .search-bar").click(function(){
		if(w_screen>=975){
			showSearch();
			closeMenu();
		}else{
			TweenLite.to(jQuery(".wrapper-input-search-menu"), .4, {display:"block", opacity:1});
			jQuery("header.header .content-nav .wrapper-input-search-menu .close-search-menu").click(function(){
				TweenLite.to(jQuery("header.header .content-nav .wrapper-input-search-menu"), .4, {display:"none", opacity:0});
			});
		}
	});
	
	
	//Menu Mobile
	jQuery("header.header .content-nav nav ul.menu li > .arrow").click(function(){
		if(w_screen<=974){
			mobileMenu(this);
		}
	});
	jQuery("header.header .content-nav nav ul.menu li.expanded .sub-menu .back-menu").click(function(){
		if(w_screen<=974){
			backMenu(this);
		}
	});
	
	
	jQuery(window).resize(function(){
		getResolution();
		insertBgModule(".custom-bg-block");
		closeMenu();
		cloneTag();
		//imgPosition("article.category-block", ".content-principal .cont-image img");
	});
	
	//alerta landscape
	jQuery(window).bind('orientationchange', function(e) {
	  switch( window.orientation ){
		case 90:
			jQuery( ".lbox-alert-mobile" ).css("display","block");
			jQuery(".landscape").addClass("landscape2");
			jQuery( ".landscape" ).css("display","none");
			jQuery( ".landscape2" ).css("display","block");
		   break;

		case -90:
		   jQuery( ".lbox-alert-mobile" ).css("display","block");
			jQuery(".landscape").removeClass("landscape2");
			jQuery( ".landscape2" ).css("display","none");
			jQuery( ".landscape" ).css("display","block");
			break;
			  
		case 0:
			jQuery( ".lbox-alert-mobile" ).css("display","none");
		break;
	  }
	});
	
	if(jQuery("body").hasClass("node-type-video")){
		onYouTubeIframeAPIReady();
	}
	
	
});

(window).onscroll = function (){
	topNews();
};