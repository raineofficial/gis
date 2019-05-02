<!DOCTYPE html>
<html>
	<head>
		<!--API KEY: AIzaSyDJp1mttlf-td8eY0nNsN3Jl1L9QqLIbIs -->
		<link rel="shortcut icon" href="img/icon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


	<style type="text/css">
       #map {
        height: 400px;
        width: 100%;
       }
	</style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
	<script type="text/javascript">
		    var customIcons = {
		      	PUES: {
				        icon: 'icon/blue_MarkerL.png'
				      },      
		      	PUHS: {
				        icon: 'icon/green_MarkerV.png'
				      },
		      	PUC: {
				        icon: 'icon/orange_MarkerM.png'
				      }
		    };

		    
		    function initMap() {
		      var map = new google.maps.Map(document.getElementById("map"), {
		        center: new google.maps.LatLng(12.8797, 121.7740),
		        zoom: 6,
		        mapTypeId: google.maps.MapTypeId.ROADMAP
		      });
		      var infoWindow = new google.maps.InfoWindow();
		      var link;

		      if (window.location.href.indexOf("island") > -1) {
		      	var url = document.URL; // or window.location.href for current url
	    		var captured = /island=([^&]+)/.exec(url)[1]; 
	    		str = captured.replace(/\+/g, ' ');
	      		link = 'allschool.php?island='+str;
		      }else{
		      	link = 'allschool.php';
		      }
		      
		      downloadUrl(link, function(data) {
		        var xml = data.responseXML;
		        var markers = xml.documentElement.getElementsByTagName("marker");
		        for (var i = 0; i < markers.length; i++) {
		          var name = markers[i].getAttribute("store_name");
		          var address = markers[i].getAttribute("address");
		          var island = markers[i].getAttribute("island");
		          var img = markers[i].getAttribute("img");
		          var type;
		          	if(island == 'Luzon'){
		          		type = 'PUES';
		          	}
		          	if(island == 'Visayas'){
		          		type = 'PUHS';
		          	}
		          	if(island == 'Mindanao'){
		          		type = 'PUC';
		          	}

		          var point = new google.maps.LatLng(
		              parseFloat(markers[i].getAttribute("lat")),
		              parseFloat(markers[i].getAttribute("lng")));
		          var html = "<img border='0' align='Left' height='100' width='120' src='"+img+"'> <b>NAME :</b> " + name + " <br/> <b>ADDRESS :</b> " + address  + + "<br /> <b>ISLAND</b> : " + island ;
		          var icon = customIcons[type] || {};
		          var marker = new google.maps.Marker({
		            map: map,
		            position: point,
		            icon: icon.icon,
		          });
		          bindInfoWindow(marker, map, infoWindow, html);
		        }
		      });

		    }

		    function bindInfoWindow(marker, map, infoWindow, html) {
		      google.maps.event.addListener(marker, 'click', function() {
		        infoWindow.setContent(html);
		        infoWindow.open(map, marker);
		      });
		    }

	    function downloadUrl(url,callback) {
		 	var request = window.ActiveXObject ?
		    new ActiveXObject('Microsoft.XMLHTTP') :
		    new XMLHttpRequest;

		 	request.onreadystatechange = function() {
			   	if (request.readyState == 4) {
			     	request.onreadystatechange = doNothing;
			     	callback(request, request.status);//right here
			   	}
		 	};
			request.open('GET', url, true);
			request.send(null);
		}

		    function doNothing() {}

		    String.prototype.toProperCase = function () {
			    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
			};
		  </script>
</head>
<body>
		<?php
		    include 'nav.php';
		?>
    <div class="content" style="padding:0;">
			<div id="map" style="width:100%;height:100%"></div>
    </div>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=APIKEYGOESHERE=initMap"></script>
</body>
</html>
