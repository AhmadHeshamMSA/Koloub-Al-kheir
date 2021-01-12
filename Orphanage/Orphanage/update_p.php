<?php
// Include config file
require_once "PHP/Model/config.php";
 
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
 
// Define variables and initialize with empty values
$name = $address = $phone = $identification = $category = $pname = $quantity = $time = "";
$name_err = $address_err = $phone_err = $identification_err = $category_err = $pname_err = $quantity_err = $time_err = "";


 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    

    // Validate Address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }
    

    // Validate Phone
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter donator's phone number.";     
    } else if (strlen($input_phone) == 11) {
        $phone = $input_phone;
    }else{
        $phone_err = "Please enter a valid phone.";
    }

    // Validate Identification
    $input_identification = trim($_POST["identification"]);
    if(empty($input_identification)){
        $identification_err = "Please enter an identification.";
    } else if (strlen($input_identification) == 14) {
        $identification = $input_identification;
    } else{
        $identification_err = "Please enter a valid identification.";
    }

    // Validate category
    $input_category = "";
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter an category.";
    }else{
        $category = $input_category;
        $time = date("Y-m-d H:i:s");
    }

    // Validate Product Name
    $input_pname = trim($_POST["pname"]);
    if(empty($input_pname)){
        $pname_err = "Please enter an product name.";
    }else{
        $pname = $input_pname;
    }

    // Validate Quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Please enter a valid quantity.";
    }else{
        $quantity = $input_quantity;
    }

    
    // Check input errors before inserting in database
 
    if(empty($name_err) && empty($address_err) && empty($phone_err) && empty($identification_err) && empty($category_err) && empty($pname_err) && empty($quantity_err) && empty($time_err)){
        // Prepare an update statement
        $sql = "UPDATE products SET d_name=?, d_address=?, d_phone=?, d_identification=?, d_pname=?, d_quantity=?, d_time=?  WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_address, $param_phone, $param_identification, $param_pname, $param_quantity, $param_time, $param_id);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_phone = $phone;
            $param_identification = $identification;
            $param_pname = $pname;
            $param_quantity = $quantity;
            $param_time = $time;
            $param_id = $id;

            $time = date("Y-m-d H:i:s");
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: products.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later. #1";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    $identification= $row["d_identification"];
                    $category= $row["d_category"];
                    $pname= $row["d_pname"];
                    $quantity= $row["d_quantity"];
                    $time= $row["d_time"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later. #2";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Donation - Orphanage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        
        html, body {
            height: 120vh;
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($identification_err)) ? 'has-error' : ''; ?>">
                            <label>Identification</label>
                            <input type="text" name="identification" class="form-control" value="<?php echo $identification; ?>">
                            <span class="help-block"><?php echo $identification_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pname_err)) ? 'has-error' : ''; ?>">
                            <label>Product Name</label>
                            <input type="text" name="pname" class="form-control" value="<?php echo $pname; ?>">
                            <span class="help-block"><?php echo $pname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                        <label>Category</label>
                        <div class="radio">
                          <label><input type="radio" name="category" value="<?php echo $category; ?> Food">Food</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="category" value="<?php echo $category; ?> Clothes">Clothes</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="category" value="<?php echo $category; ?> Electronics">Electronics</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="category" value="<?php echo $category; ?> Games">Games</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="category" value="<?php echo $category; ?> Others">Others</label>
                        </div>
                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>Quantity</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="products.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>