var map;
var image;

function myMap(){
 
}

function setMonth( objects, li ){

	
	if( li != "" ){
		jQuery( "#block-views-home-what-s-coming-up-block header li" ).removeClass( "active" );
		jQuery( li ).addClass( "active" );

	}

	if( objects ){
		
		jQuery("#block-views-home-what-s-coming-up-block header ul li").removeClass("active");
		jQuery(li).addClass("active");
		
		item = objects[0];
		
		jQuery( "#block-views-home-what-s-coming-up-block .content-principal source" ).attr( "srcset", item.field_thumbnail_medium.und[0].url );
		jQuery( "#block-views-home-what-s-coming-up-block .content-principal img" ).attr( "src", item.field_thumbnail_medium.und[0].url );
		jQuery( "#block-views-home-what-s-coming-up-block .content-principal h3" ).html( "<a href='"+item.link+"'>"+item.title+"</a>");
		jQuery( "#block-views-home-what-s-coming-up-block .content-principal .cont-description p" ).html(item.field_summary.und[0].field_description_1.und[0].value + "... <a href='"+item.link+"'> Read More</a>" );
	
	}
	
	for(i=0;i<=4;i++){
		//if( typeof objects[i+1] !== "undefined" ){

		try{

			item = objects[i+1];

			jQuery( "#block-views-home-what-s-coming-up-block .general-article article:eq("+i+")" ).css( "display", "block" );

			if( typeof item.field_thumbnail_small.und !== "undefined" )
				jQuery( "#block-views-home-what-s-coming-up-block .general-article article:eq("+i+") img" ).attr( "src", item.field_thumbnail_small.und[0].url );
			
			if( typeof item.title !== "undefined" )
				jQuery( "#block-views-home-what-s-coming-up-block .general-article article:eq("+i+") h3" ).html( "<a href='"+item.link+"'>"+item.title+"</a>");
			
			if( typeof item.link !== "undefined" )
				jQuery( "#block-views-home-what-s-coming-up-block .general-article article:eq("+i+") .cont-description p a" ).html("Read More").attr("href",item.link);
		
		}catch(err){
			setMonth( wcu_data[ "May" ],  jQuery( "#block-views-home-what-s-coming-up-block .general-article article:eq(4)" ).parent( ) );
		}	
	}
}

var sub = 0;
function setMarker(data){

	  var myLatLng = {lat: Number(data.lat), lng: Number(data.long)};

	  var contentString = "<div><div class='img'><img src='" + data.image + "' /></div><div class='attrs'><h3><a href='/" + data.link + "'>" + data.name + "</<></h3></div></div>"

	  var infowindow = new google.maps.InfoWindow({
	    content: contentString
	  });

	  var marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	    title: data.name,
	    icon: "/sites/default/files/marker-gmaps.png"
	  });

	  marker.addListener('click', function() {
	    infowindow.open(map, marker);
	  });

	  if(sub == 0)
	  	map.setCenter( myLatLng );

	  sub++;
	}

var myLatlng;
jQuery( document ).ready( function(){

	if( jQuery( ".node-type-article" ).length > 0 ){
		myLatlng = new google.maps.LatLng(20.3531019, -87.6361318);
	    var mapOptions = {
	        center: myLatlng,
	        zoom: 12,
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    }
	 	map = new google.maps.Map(document.getElementById("map"), mapOptions);
	}

	//FILTRO DE CATEGORIA DESTACADA DEL HOME
	jQuery( ".filter-category ul li a" ).bind( "click", function( event ){
		value = jQuery( this ).parent().index();

		//console.log( jQuery( ".jqTransformHidden option:eq("+value+")" ).val() );

		jQuery.post( "/seeing/get_articles_home", { "section": jQuery( ".jqTransformHidden option:eq("+value+")" ).val() }, function( data ){

			var sub = 0;
			jQuery.each( data, function( index, value ){

				jQuery( "#block-views-home-lifestyle-block article:eq( "+sub+" ) img" ).attr( "src", value.image );
				jQuery( "#block-views-home-lifestyle-block article:eq( "+sub+" ) .cont-description p" ).html( value.text + "... <a href='/" + value.link + "'>Read more</a>" );
				jQuery( "#block-views-home-lifestyle-block article:eq( "+sub+" ) h3 a" ).text( value.title );
				jQuery( "#block-views-home-lifestyle-block article:eq( "+sub+" ) h3 a" ).attr( "href", "/" + value.link );
				
				sub = sub + 1;
			} )

			jQuery( "#block-views-home-lifestyle-block footer a" ).attr( "href", "/" + data.ppal_link );

		}, "json" )
		jQuery( "#block-views-home-lifestyle-block h1" ).text( jQuery( this ).text() );
	} )

	jQuery( "#first-time" ).remove( );

	jQuery( ".search-mini-form" ).bind( "submit", function( ){
		jQuery( this ).attr( "action", "/search/node/" + jQuery( ".search-mini-form #search" ).val( ) + "/" );
	} )

	jQuery( ".search-header" ).bind( "submit", function( ){
		jQuery( this ).attr( "action", "/search/node/" + jQuery( ".search-header #input_search" ).val( ) + "/" );
	} )

	jQuery( ".search-404" ).bind( "submit", function( ){
		jQuery( this ).attr( "action", "/search/node/" + jQuery( ".search-404 #input-search-404" ).val( ) + "/" );
	} )

	if( jQuery( "#block-views-home-what-s-coming-up-block" ).length > 0 ){

		//console.log( wcu_data[ month_actual ] );

		setMonth( wcu_data[ month_actual ],  jQuery( this ).parent( ) );

		jQuery( "#block-views-home-what-s-coming-up-block header ul li.available a" ).bind( "click", function(){
			setMonth( wcu_data[ jQuery( this ).text( ) ], jQuery( this ).parent( ) );
			return false;
		} )

	}

	if( jQuery( ".node-type-article" ).length > 0 ){
	    setTimeout(function(){
	        jQuery.each( nodes, function( index, value ){
	            setMarker( value ) 
	        } )
	    }, 5000 )
	}

} )