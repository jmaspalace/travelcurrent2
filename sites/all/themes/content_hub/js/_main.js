var h_screen = jQuery(window).height(),
	w_screen = jQuery(window).width(),
	h_header = jQuery("header").height(),
	//h_footer = jQuery("footer").height(),
	//custom_event = jQuery.support.touch ? "tap" : "click",
	isMobile,
	bgModule,
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
		if(pSlide.html() == "Right"){
			jQuery(pSlide).parent().addClass("right");
		}else if(pSlide.html() == "Left"){
			jQuery(pSlide).parent().addClass("left");
		}else if(pSlide.html() == "Center"){
			jQuery(pSlide).parent().addClass("center");
		}
	}
}


function myMap(){
	var myLatlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
        center: myLatlng,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

/*
function splitTitle(obj){
	var spanTitle = jQuery(obj);
		spanTitle = spanTitle.text().split(" ");
		spanTitle = jQuery(obj).text().replace(spanTitle[0], "<span>"+spanTitle[0]+"</span>");
		
		jQuery(obj).html(spanTitle);
}

function zoomPreview(obj){
	jQuery(obj).hover(function(){
		TweenLite.to( jQuery(this).find(".views-field-field-image img"), 1.0, {scaleX:1.1, scaleY:1.1, rotation:1.1, ease:Quad.easeOut});
	}, function(){
		TweenLite.to( jQuery(this).find(".views-field-field-image img"), .5, {scaleX:1, scaleY:1, rotation:0, ease:Quad.easeOut});
	});
}*/


jQuery(document).ready(function() {
	
	getResolution();
	
	jQuery(".flexslider").flexslider({
    	//animation: "slide"
  	});
	
	textSlider();
	
	filterSize();
	
	selectTransform("form.jqtransform");
	
	insertBgModule(".custom-bg-block");
	
	overThumbArticle("section article .cont-image");
	
	imgPosition("article.category-block", ".content-principal .cont-image img");
	
	$(".article-wcu-home .content header .wrapper").mCustomScrollbar({
		theme:"minimal",
		axis:"x",
		scrollInertia: 0
	});
	
	jQuery("header.header .toogler-menu").click(function(){
		TweenLite.to(jQuery("header.header nav ul.menu"), .4, {display:"block", opacity:1});
	});
	
	jQuery("header.header .close-menu").click(function(){
		TweenLite.to(jQuery("header.header nav ul.menu"), .4, {display:"none", opacity:0});
		setTimeout(function(){
			jQuery("header.header nav ul.menu").attr("style", "");	
		},500);
	});
	
	//myMap();
	
	jQuery(window).resize(function(){
		getResolution();
		insertBgModule(".custom-bg-block");
		imgPosition("article.category-block", ".content-principal .cont-image img");
	});
	
	//alerta landscape
	/*jQuery(window).bind('orientationchange', function(e) {

	  switch ( window.orientation ) {
	
		case 0:
			jQuery( ".lightbox-alertMobile" ).css("display","none");
		break;
	
		case 90:
			jQuery( ".lightbox-alertMobile" ).css("display","block");
		break;
	
		case -90:
			jQuery( ".lightbox-alertMobile" ).css("display","block");
		break;
	
	  }
	
	});*/
	
});

(window).onscroll = function (){
	//var scroll_site = document.documentElement.scrollTop || document.body.scrollTop;
};