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
                        	<!-- <div id="map" style="width:100%;height:500px; float: right;"></div> -->
                        	<div class="form-group">
                                <div class="read-image" style="background-image: url('<?php echo $row["img"]; ?>')"></div>
                            </div>  
                        </div>
                    </div>  

                    <?php
                        echo "<a href='edit.php?id=". $row['store_no'] ."' class='content_button_design'>Edit</a>";
                    ?>
                        <a href="index.php" class="content_button_design">Cancel</a>      
                </div>
            </div>
        </div>
    </body>
</html>