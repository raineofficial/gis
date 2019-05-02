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
	      		link = 'branch.php?id='+str;
		      }else{
		      	link = 'branch.php';
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