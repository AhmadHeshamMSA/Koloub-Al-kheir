<?php 
session_start();

if (isset($_SESSION['LOGGED IN'])) {
if ($_SESSION["usertype"] == "Admin") {
    
    }else{
         echo '<script>alert("Access Denied!")</script>';
         echo '<script>location.href="login.php";</script>';
         }  
}
else{
    echo '<script>alert("Access Denied!")</script>';
    echo '<script>location.href="login.php";</script>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donationed Products - Orphanage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        
        html, body {
            height: 100vh;
        }

        body{
            background-image:
            linear-gradient(180deg, rgba(11,217,237,0.76234243697479) 0%, rgba(12,124,182,0.7511379551820728) 100%), url("img/bg3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .space{
            margin-right: 5px;
        }
        .wrapper{
            width: 1200px;
            margin: 0 auto;
            background-color: #FFFF;
            margin-top: 2%;
            background-color: #FFFF;
            padding: 10px;
            border-radius: 3px;

            -webkit-box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
            -moz-box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
            box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" style="color: #3B3B3B;">Donationed Products Details</h2>
                        <a href="create_p.php" class="btn btn-success pull-right">Add New Donation</a>
                        <a href="admin.php" class="btn btn-primary space pull-right">Home</a>
                        <a href="donations.php" class="btn pull-right">Back</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "PHP/Model/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM products";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Phone</th>";
                                        echo "<th>Identification</th>";
                                        echo "<th>Product Name</th>";
                                        echo "<th>Category</th>";
                                        echo "<th>Quantity</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['d_name'] . "</td>";
                                        echo "<td>" . $row['d_address'] . "</td>";
                                        echo "<td>" . $row['d_phone'] . "</td>";
                                        echo "<td>" . $row['d_identification'] . "</td>";
                                        echo "<td>" . $row['d_pname'] . "</td>";
                                        echo "<td>" . $row['d_category'] . "</td>";
                                        echo "<td>" . $row['d_quantity'] . "</td>";
                                        echo "<td>" . $row['d_time'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read_p.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'>
							<span class='glyphicon glyphicon-eye-open'></span>
						  </a>";
                                            echo "<a href='update_p.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete_p.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "<a href='print_p.php?id=". $row['id'] ."' title='Print Record' data-toggle='tooltip'><span class='glyphicon glyphicon-print'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>