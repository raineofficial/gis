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

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
      </script>
    </head>

    <body>

        <?php
            require_once 'connection.php';
            include 'nav.php';
        ?>

        <div class="content">

            <label>Search: </label>
                <input type="text" class="form-control" style="width: 250px; display: inline; margin-left: 10px;" id="search">
                <br><br>

            <?php

                    $sql = "SELECT * FROM 7_eleven ORDER BY store_name";

                    if($result = $mysqli->query($sql))
                    {
                        if($result->num_rows > 0)
                        {

            ?>

                            <table>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Store Name</th>
                                        <th>Address</th>
                                        <th>Island</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                
                                <?php
                                    $i = 1;
                                    while($row = $result->fetch_array())
                                    {
                                
                                        echo "<tr class='clickable-row' data-href='read.php?id=". $row['store_no'] ."'>";
                                        echo "<td>" . $i . "</td>";
                                        echo "<td>" . $row['store_name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['island'] . "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                ?>

                                    </tbody>                          
                            </table>

            <?php
                            $result->free();
                        } 
                        else
                        {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } 
                    else
                    {
                    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }				

                $mysqli->close();

            ?>

            <script>

                $("#search").keyup(function () 
                {
                    var value = this.value.toLowerCase().trim();

                    $("table tr").each(function (index) 
                    {
                        if (!index) return;
                        $(this).find("td").each(function () 
                        {
                            var id = $(this).text().toLowerCase().trim();
                            var not_found = (id.indexOf(value) == -1);
                            $(this).closest('tr').toggle(!not_found);
                            return not_found;
                        });
                    });
                });

            </script>
    </body>
</html>