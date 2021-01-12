<?php

//Check Permission
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

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "PHP/Model/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM products WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["d_name"];
                $address = $row["d_address"];
                $phone = $row["d_phone"];
                $ident = $row["d_identification"];
                $category = $row["d_category"];
                $pname = $row["d_pname"];
                $quantity = $row["d_quantity"];
                $time = $row["d_time"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
    }

} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donations - Orphanage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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

        .wrapper{
            width: 650px;
            margin: 0 auto;
            background-color: #FFFF;
            margin-top: 5%;
            background-color: #FFFF;
            padding: 10px;
            border-radius: 3px;

            -webkit-box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
            -moz-box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
            box-shadow: 0px 0px 44px -2px rgba(0,0,0,0.37);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["d_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $row["d_address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p class="form-control-static"><?php echo $row["d_phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Identification</label>
                        <p class="form-control-static"><?php echo $row["d_identification"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <p class="form-control-static"><?php echo $row["d_pname"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <p class="form-control-static"><?php echo $row["d_category"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <p class="form-control-static"><?php echo $row["d_quantity"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <p class="form-control-static"><?php echo $row["d_time"]; ?></p>
                    </div>
                    <p><a href="products.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>