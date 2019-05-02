<?php

            if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

                require_once 'connection.php';
                

                $sql = "SELECT * FROM 7_eleven WHERE store_no = ?";
                
                if($stmt = $mysqli->prepare($sql))
                {
                    $stmt->bind_param("i", $param_id);
                    $param_id = trim($_GET["id"]);
                    
                    if($stmt->execute())
                    {
                        $result = $stmt->get_result();
                        
                        if($result->num_rows == 1)
                        {

                            $row = $result->fetch_array(MYSQLI_ASSOC);

                            $name = $row["store_name"];
                            $address = $row["address"];
                            $island = $row["island"];
                        } 
                        else
                        {

                            header("location: error.php");
                            exit();
                        }
                        
                    } 
                    else
                    {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                 
                $stmt->close();
                
                $mysqli->close();
            } 
            else
            {
                header("location: error.php");
                exit();
            }

            
        ?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>7-Eleven</title>
        <link rel="shortcut icon" href="img/icon.png"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    </head>

    <body>
        <?php
            include 'nav.php';
        ?>
<div class="content">
            <div class="wrapper">
                <div class="container-fluid">
                <div class="page-header">
                    <h3>Details</h3>
                </div>
                    <div class="row">
                        <div class="col-md-5">
                            

                            <div class="form-group">
                                <label>Store Name:</label>
                                <span class="form-control-static"><?php echo $row["store_name"]; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Address:</label>
                                <span class="form-control-static"><?php echo $row["address"]; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Island:</label>
                                <span class="form-control-static"><?php echo $row["island"]; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Latitude:</label>
                                <span class="form-control-static"><?php echo $row["latitude"]; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Longitude:</label>
                                <span class="form-control-static"><?php echo $row["longitude"]; ?></span>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div id="map" style="width:100%;height:650px; float: right;"></div>
                        </div>
                    </div>  

                    <?php
                        echo "<a href='edit.php?id=". $row['store_no'] ."' class='content_button_design'>Edit</a>";
                    ?>
                        <a href="index.php" class="content_button_design">Cancel</a>      
                </div>
            </div>
        </div>
    
    <script type="text/javascript">
            //<![CDATA[

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

              if (window.location.href.indexOf("id") > -1) {
                var url = document.URL; // or window.location.href for current url
                var captured = /id=([^&]+)/.exec(url)[1]; 
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

            //]]>

          </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=APIKEYGOESHERE=initMap"></script>
</body>
</html>
