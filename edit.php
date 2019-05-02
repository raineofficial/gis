<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>7-Eleven</title>
        <link rel="shortcut icon" href="img/icon.png"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>

    <body>
        <?php

            require_once 'connection.php';
             
            $name = $address = $island = $latitude = $longitude = $img = "";
            $name_err = $address_err = $island_err = $latitude_err = $longitude_err = $img_err = "";

            if(isset($_POST["id"]) && !empty($_POST["id"]))
            {

                $input_name = trim($_POST["name"]); 
                $input_address = trim($_POST["address"]);
                $input_island = trim($_POST["island"]);
                $input_latitude = trim($_POST["latitude"]);
                $input_longitude = trim($_POST["longitude"]);
                $input_img = trim($_POST["img"]);
                $id = $_POST["id"];
                

                
                if(empty($input_name))
                    $name_err = "Please enter the store name.";
                else
                    $name = $input_name;
                

                if(empty($input_address))
                    $address_err = 'Please enter an address.';   
                else
                    $address = $input_address;

                if(empty($input_latitude))
                    $latitude_err = 'Please enter a latitude.';  
                else
                    $latitude = $input_latitude;

                if(empty($input_longitude))
                    $longitude_err = 'Please enter a longitude.';  
                else
                    $longitude = $input_longitude;

                if(empty($input_img))
                    $img_err = 'Please enter an Image URL.'; 
                else
                    $img = $input_img;

                if(empty($input_island))
                    $island_err = "Please enter a level.";
                elseif(!filter_var(trim($_POST["island"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/"))))
                    $island_err = 'Please enter a valid character.';
                else
                    $island = $input_island;

                if(empty($name_err) && empty($address_err) && empty($island_err)) 
                {
                    $sql = "UPDATE 7_eleven SET store_name=?, address=?, island=?, latitude=?, longitude=?, img=? WHERE store_no=?";

                    if($stmt = $mysqli->prepare($sql))
                    {
                        $stmt->bind_param("ssssssi", $param_name, $param_address, $param_island, $param_latitude, $param_longitude, $param_img, $param_id);
                    
                        $param_name = $name;
                        $param_address = $address;
                        $param_island = $island;
                        $param_latitude = $latitude;
                        $param_longitude = $longitude;
                        $param_img = $img;
                        $param_id = $id;
                        
                        if($stmt->execute())
                        {

                            header("location: index.php");
                            exit();
                        } 
                        else
                        {
                            echo "Something went wrong. Please try again later.";
                        }
                    }
                    $stmt->close();
                }
                $mysqli->close();
            } 
            else
            {
                if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
                {
                    $id =  trim($_GET["id"]);

                    $sql = "SELECT * FROM 7_eleven WHERE store_no = ?";
                    if($stmt = $mysqli->prepare($sql))
                    {
                        $stmt->bind_param("i", $param_id);
                        $param_id = $id;
                    
                        if($stmt->execute())
                        {
                            $result = $stmt->get_result();
                            
                            if($result->num_rows == 1)
                            {
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $name = $row["store_name"];
                                $address = $row["address"];
                                $latitude = $row["latitude"];
                                $longitude = $row["longitude"];
                                $island = $row["island"];
                                $img = $row["img"];
                            } 
                            else
                            {
                                header("location: index.php");
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
                    header("location: add.php");
                    exit();
                }
            }
            include 'nav.php';
        ?>

        <div class="content">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h3>Update Record</h3>
                                <p>Please edit the input values and submit to update the record.</p>
                            </div>
                            
                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Store Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                    <span class="help-block"><?php echo $name_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                                    <span class="help-block"><?php echo $address_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($latitude_err)) ? 'has-error' : ''; ?>">
                                    <label>Latitude</label>
                                    <input type="number" name="latitude" step="any" class="form-control" value="<?php echo $latitude; ?>">
                                    <span class="help-block"><?php echo $latitude_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($longitude_err)) ? 'has-error' : ''; ?>">
                                    <label>Longitude</label>
                                    <input type="number" name="longitude" step="any" class="form-control" value="<?php echo $longitude; ?>">
                                    <span class="help-block"><?php echo $longitude_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($island_err)) ? 'has-error' : ''; ?>">
                                    <label>Island</label>
                                    <select name="island" class="form-control">
                                        <option value="none">Select an island</option>
                                        <option value="Luzon" <?php if ($island == 'Luzon') { echo 'selected'; } ?> >Luzon</option>
                                        <option value="Visayas" <?php if ($island == 'Visayas') { echo 'selected'; } ?> >Visayas</option>
                                        <option value="Mindanao" <?php if ($island == 'Mindanao') { echo 'selected'; } ?> >Mindanao</option>
                                    </select>
                                    <span class="help-block"><?php echo $island_err;?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
                                    <label>Image URL</label>
                                    <input type="link" name="img" class="form-control" value="<?php echo $img; ?>">
                                    <span class="help-block"><?php echo $img_err;?></span>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <input type="submit" class="content_button_design" value="Submit">
                                <a href="index.php" class="content_button_design" style="vertical-align: bottom;">Cancel</a>
                            </form>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </body>
</html>