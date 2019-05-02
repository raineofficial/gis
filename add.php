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

            function initialize() 
            {
                var address = (document.getElementById('my-address'));
                var autocomplete = new google.maps.places.Autocomplete(address);
                autocomplete.setTypes(['geocode']);
                google.maps.event.addListener(autocomplete, 'place_changed', function() 
                {
                    var place = autocomplete.getPlace();
                    if (!place.geometry) 
                    {
                        return;
                    }

                    var address = '';
                    if (place.address_components) 
                    {
                        address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                    }
                });
            }

            function codeAddress() 
            {
                geocoder = new google.maps.Geocoder();
                var address = document.getElementById("my-address").value;
                geocoder.geocode( { 'address': address}, function(results, status) 
                {
                    if (status == google.maps.GeocoderStatus.OK) 
                    {
                        alert("Latitude: "+results[0].geometry.location.lat());
                        alert("Longitude: "+results[0].geometry.location.lng());
                    } 

                    else 
                    {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </head>

    <body>

        <?php

            require_once 'connection.php';

            $name_err = $address_err = $island_err = $error_msg = $success_msg = $latitude_err = $longitude_err = $img_err = "";
            $input_name = $input_address = $input_island = $input_latitude = $input_longitude = $input_img = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $input_name = trim($_POST["name"]); 
                $input_address = trim($_POST["address"]);
                $input_island = trim($_POST["island"]);
                $input_latitude = trim($_POST["latitude"]);
                $input_longitude = trim($_POST["longitude"]);
                $input_img = trim($_POST["img"]);

                if(empty($input_name))
                {
                    $name_err = "Please enter the branch name.";;
                }    

                if (empty($input_address))
                {
                    $address_err = "Please enter the address.";
                }

                if(empty($input_latitude)){
			        $latitude_err = 'Please enter an Latitude.';     
			    } else{
			        $latitude = $input_latitude;
			    }

			    if(empty($input_longitude)){
			        $longitude_err = 'Please enter an Longitude.';     
			    } else{
			        $longitude = $input_longitude;
			    }

                if (($input_island) == 'none')
                {
                    $island_err = "Please select an island.";
                }
                
                if(empty($input_img)){
                    $img_err = 'Please enter the image URL.';     
                } else{
                    $img = $input_img;
                }

                if(empty($name_err) && empty($address_err) && empty($island_err) && empty($latitude_err) && empty($longitude_err) && empty($img_err))
                {

                    $query_dataCheck = "SELECT * FROM 7_eleven WHERE store_name = '$input_name' and address='$input_address' and island='$input_island'";
                    $data_check = $mysqli->query($query_dataCheck);

                    if ($data_check->num_rows > 0)
                    {
                        $error_msg = "Data already exists.";
                    }
                    else
                    {
                        $sql = "INSERT INTO 7_eleven (store_name, address, island, latitude, longitude, img) VALUES (?, ?, ?, ?, ?, ?)";
                                                
                        if ($stmt = $mysqli->prepare($sql))
                        {
                            $stmt->bind_param("ssssss", $param_name, $param_address, $param_island, $param_latitude, $param_longitude, $param_img);

                            $param_name = $input_name;
                            $param_address = $input_address;
                            $param_island = $input_island;
                            $param_latitude = $input_latitude;
                            $param_longitude = $input_longitude;
                            $param_img = $input_img;

                            if ($stmt->execute())
                            {
                                //$success_msg = "New record successfully added.";
                                echo '<script type="text/javascript">';
                                    echo 'alert("New record successfully added.");';
                                    echo 'window.location= "add.php";';
                                echo '</script>';
                            }
                            else 
                            {
                                $error_msg = "ERROR: Please try again.";
                            }
                        }
                        // $stmt->close();
                    }
                }
                $mysqli->close();
            }

            include 'nav.php';
        ?>

        <div class="content">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h3>Add Data</h3>
                                <p>Please fill this form and submit to add branch of 7-Eleven record to the database.</p>
                            </div>

                            
                            <form action="#" method="post" id="form">

                                <?php
                                    //if (isset($_POST['submit_addData']))
                                    //{
                                        if (!empty($error_msg))
                                        {
                                ?>
                                            <div class="alert alert-danger">
                                                <?php echo $error_msg; ?>
                                            </div>
                                <?php
                                        }
                                        elseif(!empty($success_msg))
                                        {
                                ?>
                                            <div class="alert alert-success">
                                                <?php echo $success_msg; ?>
                                            </div>
                                <?php
                                        }
                                    //}
                                ?>

                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Branch Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $input_name; ?>">
                                    <span class="help-block"><?php echo $name_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control"><?php echo $input_address; ?></textarea>
                                    <span class="help-block"><?php echo $address_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($island_err)) ? 'has-error' : ''; ?>">
                                    <label>Island</label>
                                        <select name="island" class="form-control">
                                            <option value="none">Select an island</option>
                                            <option value="Luzon" <?php if ($input_island == 'Luzon') { echo 'selected'; } ?> >Luzon</option>
                                            <option value="Visayas" <?php if ($input_island == 'Visayas') { echo 'selected'; } ?> >Visayas</option>
                                            <option value="Mindanao" <?php if ($input_island == 'Mindanao') { echo 'selected'; } ?> >Mindanao</option>
                                        </select>
                                        <span class="help-block"><?php echo $island_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Longitude</label>
                                    <input type="number" name="longitude" step="any" class="form-control" value="<?php echo $input_latitude; ?>">
                                    <span class="help-block"><?php echo $longitude_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Latitude</label>
                                    <input type="number" name="latitude" step="any" class="form-control" value="<?php echo $input_latitude; ?>">
                                    <span class="help-block"><?php echo $latitude_err;?></span>
                                </div>
                                
                                <div class="form-group <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
                                    <label>Image URL</label>
                                    <input type="link" name="img" class="form-control" value="<?php echo $input_img; ?>">
                                    <span class="help-block"><?php echo $img_err;?></span>
                                </div>

                                <input type="submit" name="submit_addData" class="content_button_design" value="Add Data" onClick="codeAddress();">
                                <a href="index.php" class="content_button_design" style="vertical-align: bottom;">Cancel</a>

                            </form>

                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </body>
</html>