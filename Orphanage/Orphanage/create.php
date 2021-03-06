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
$name = $address = $salary = $rank = $PhoneNumber = "";
$name_err = $address_err = $salary_err = $rank_err = $PhoneNumber_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
        $rank = "";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
        $rank = "";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";   
        $rank = "";  
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
        $rank = "";
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
        $rank = "";
    } else{
        $salary = $input_salary;
    }
    
    // Validate rank
    $input_rank = trim($_POST["rank"]);
    if(empty($input_rank)){
        $rank_err = "Please choose a rank name from the list.";
        $rank = "";
    }else{
        $rank = $input_rank;
    }

    // Validate PhoneNumber
    $input_PhoneNumber = trim($_POST["PhoneNumber"]);
    if(empty($input_PhoneNumber)){
        $PhoneNumber_err = "Please enter the Phone Number";
        $rank = "";
    } elseif(!ctype_digit($input_PhoneNumber)){
        $PhoneNumber_err = "Please enter a positive integer value.";
        $rank = "";
    } elseif(strlen($input_PhoneNumber) < 11){
        $PhoneNumber_err = "Please enter a valid Phone Number.";
        $rank = "";
    } else{
        $PhoneNumber = $input_PhoneNumber;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err) && empty($rank_err) && empty($PhoneNumber_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary, rank, PhoneNumber) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_address, $param_salary, $param_rank, $param_PhoneNumber);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_rank = $rank;
            $param_PhoneNumber = $PhoneNumber;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
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
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($rank_err)) ? 'has-error' : ''; ?>">
                        <label>Rank</label>
                        <div class="radio">
                          <label><input type="radio" name="rank" value="<?php echo $rank; ?> Admin">Admin</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="rank" value="<?php echo $rank; ?> SuperVisor">SuperVisor</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="rank" value="<?php echo $rank; ?> Teacher">Teacher</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="rank" value="<?php echo $rank; ?> Cheif">Cheif</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="rank" value="<?php echo $rank; ?> Driver">Driver</label>
                          <span class="help-block"><?php echo $rank_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($PhoneNumber_err)) ? 'has-error' : ''; ?>">
                            <label>Phone Number</label>
                            <input type="text" name="PhoneNumber" class="form-control" value="<?php echo $PhoneNumber; ?>">
                            <span class="help-block"><?php echo $PhoneNumber_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employees.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>