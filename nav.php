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

        <style>

            hr {
                padding: 0;
                margin: 0;
                border-width: 2px;
            }

            /* Logo of the site */
            #logo {
                margin:5px;
                margin-top:20px;
            }

            /* Table in index */
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            tr {
                background: #28B463;
                color:white;
            }

            .clickable-row {
                background:none;
                color:black;
            }

            .clickable-row:hover {
                background-color: #f5f5f5;
                cursor: pointer;
            }

            .error_msg {
                color: red;
            }

            /* Sidebar navigation */
            .sidebar {
                background: #239B56;
                position: fixed;
                width: 150px;
                height: 100%;
                transition: 0.5s;
            }

            /* Sidebar button and links such as edit */
            button, a {
                background-color: Transparent;
                background-repeat:no-repeat;
                border: none;
                cursor:pointer;
                overflow: hidden;
                outline:none;
                padding: 8px 35px 8px 35px;
                text-decoration: none;
                font-size: 25px;
                color: white;
                display: block;
                transition: 0.3s;
                font: Arial;
                font-size: 15px;
            }

            /* Sidebar button and links styles */
            button {
                border-bottom: solid 2px;
                width:100%;
            }

            button:hover {
                border-bottom: solid 2px green;
            }

            .sidebar a:hover, button:hover{
                color: black;
                text-decoration: none;
            }

            /* Content Design */
            .content {  
                width: auto;
                height: 100vh;
                background: white;
                margin-left: 150px;
                padding: 50px;
                position: relative;
                overflow: auto;
                z-index: 1;
            }

            /* Button style in content */
            .content_button_design {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius:3px;
                width: 150px;
            }

            .read-image {
                position: relative;
                margin-left:50px;
                width:  450px;
                height: 300px;
                background-position: 50% 50%;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* Content Hover over links made as buttons */
            a:hover {
                text-decoration: none;
                color:white;
            }

            @media (min-width:600px) {
                .sidebar 
                {
                    width: 250px;
                }
                .content 
                {
                    margin-left: 250px;
                }
            } 
        </style>
    </head>

    <body>
        <form action="#" method="post">
            <div class="sidebar">
                <center><img src="img/logo.png" height="40px" width="230px" id="logo"></center>
                <br><br><hr>
                <button type="submit" name="show_list" class="sidebar-button"><a href="index.php">Show List</a></button>
                <button type="submit" name="add_data" class="sidebar-button"><a href="add.php">Add Data</a></button>
                <button type="submit" name="show_map" class="sidebar-button"><a href="map.php">Map</a></button>
                <!-- <button type="submit" class="sidebar-button"><a href="">Example</a></button> -->
            </div>
        </form>
    </body>