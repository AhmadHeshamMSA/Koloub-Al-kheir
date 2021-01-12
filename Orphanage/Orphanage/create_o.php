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
$name = $birthdate = $gender = $nationality = $height = $weight = "";
$name_err = $birthdate_err = $gender_err = $nationality_err = $height_err = $weight_err = "";

 
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
    
    // Validate Birthdate
    $input_birthdate = trim($_POST["birthdate"]);
    if(empty($input_birthdate)){
        $birthdate_err = "Please enter an birthdate.";
    } else{
        $birthdate = $input_birthdate;
    }
    
    // Validate Gender
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please enter your gender.";     
    } else{
        $gender = $input_gender;
    }

    // Validate Nationality
    $input_nationality = trim($_POST["nationality"]);
    if(empty($input_nationality)){
        $nationality_err = "Please enter your nationality.";     
    }elseif(!filter_var($input_nationality, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nationality_err = "Please enter a valid nationality.";
    } else{
        $nationality = $input_nationality;
    }

    // Validate Height
    $input_height = trim($_POST["height"]);
    if(empty($input_height)){
        $height_err = "Please enter an height.";
    } else{
        $height = $input_height;
    }

// Validate Weight
    $input_weight = trim($_POST["weight"]);
    if(empty($input_weight)){
        $weight_err = "Please enter an weight.";
    } else{
        $weight = $input_weight;
    }


    // Check input errors before inserting in database
    if(empty($name_err) && empty($birthdate_err) && empty($gender_err) && empty($nationality_err) && empty($height_err) && empty($weight_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO orphans (o_name, o_birthdate, o_gender, o_nationality, o_height, o_weight) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssii", $param_name, $param_birthdate, $param_gender, $param_nationality, $param_height, $param_weight);
            // Set parameters
            $param_name = $name;
            $param_birthdate = $birthdate;
            $param_gender = $gender;
            $param_nationality = $nationality;
            $param_height = $height;
            $param_weight = $weight;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
                    <p>Please fill this form and submit to add orphan record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($birthdate_err)) ? 'has-error' : ''; ?>">
                            <label>Birthdate</label>
                            <textarea name="birthdate" class="form-control"><?php echo $birthdate; ?></textarea>
                            <span class="help-block"><?php echo $birthdate_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                        <label>Gender</label>
                        <div class="radio">
                          <label><input type="radio" name="gender" value="<?php echo $gender; ?> Male">Male</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="gender" value="<?php echo $gender; ?> female">Female</label>
                        </div>
                        <div class="form-group <?php echo (!empty($nationality_err)) ? 'has-error' : ''; ?>">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" value="<?php echo $nationality; ?>">
                            <span class="help-block"><?php echo $nationality_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($height_err)) ? 'has-error' : ''; ?>">
                            <label>Height</label>
                            <input type="text" name="height" class="form-control" value="<?php echo $height; ?>">
                            <span class="help-block"><?php echo $height_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($weight_err)) ? 'has-error' : ''; ?>">
                            <label>Weight</label>
                            <input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>">
                            <span class="help-block"><?php echo $weight_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="orphans.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>