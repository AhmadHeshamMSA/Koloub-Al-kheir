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
$name = $gender = $address = $phone = $identification = $amount = $method= $time = "";
$name_err = $gender_err = $address_err = $phone_err = $identification_err = $amount_err = $method_err = "";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate Gender
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please enter donator's gender.";     
    } else if ($input_gender == "Female" || $input_gender == "Male") {
        $gender = $input_gender;
    }else{
        $gender_err = "Please enter donator's gender.";
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
        // $phone_err = strlen($input_phone);
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

    // Validate Amount
    $input_amount = trim($_POST["amount"]);
    if(empty($input_amount)){
        $amount_err = "Please enter an amount.";
    } else{
        $amount = $input_amount;
    }

    // Validate method
    $input_method = trim($_POST["method"]);
    if(empty($input_method)){
        $method_err = "Please enter an method.";
    }else{
        $method = $input_method;
        $time = date("Y-m-d H:i:s");
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($gender_err) && empty($address_err) && empty($phone_err) && empty($identification_err) && empty($amount_err) && empty($method_err) && empty($time_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO donations (d_name, d_gender, d_address, d_phone, d_identification, d_amount, d_method, d_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssis", $param_name, $param_gender, $param_address, $param_phone, $param_identification, $param_amount, $param_method, $param_time);
            // Set parameters
            $param_name = $name;
            $param_gender = $gender;
            $param_address = $address;
            $param_phone = $phone;
            $param_identification = $identification;
            $param_amount = $amount;
            $param_method = $method;
            $param_time = $time;

            $time = date("Y-m-d H:i:s");
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: donations.php");
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add donation record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                        <label>Gender</label>
                        <div class="radio">
                          <label><input type="radio" name="gender" value="<?php echo $method; ?> Male">Male</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="gender" value="<?php echo $method; ?> Female">Female</label>
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
                        <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
                            <span class="help-block"><?php echo $amount_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($method_err)) ? 'has-error' : ''; ?>">
                        <label>Method</label>
                        <div class="radio">
                          <label><input type="radio" name="method" value="<?php echo $method; ?> 1">Cash</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="method" value="<?php echo $method; ?> 2">Credit Card</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="donations.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>