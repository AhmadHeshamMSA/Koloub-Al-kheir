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
                $id = $row["id"];
                $name = $row["d_name"];
                $address = $row["d_address"];
                $phone = $row["d_phone"];
                $ident = $row["d_identification"];
                $time = $row["d_time"];
                $category = $row["d_category"];
                $pname = $row["d_pname"];
                $quantity = $row["d_quantity"];
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
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donation Invoice - Orphanage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Invoice # <?php echo $row["id"]; ?><br>
                                Created: <?php echo $row["d_time"]; ?><br>
                                Phone: 0233022690<br>
                            </td>

                            <td class="title">
                                <img src="https://s1.imghub.io/02TUH.png" style="width:100%; max-width:300px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Name: <?php echo $row["d_name"]; ?><br>
                                Identification: <?php echo $row["d_identification"]; ?>
                            </td>
                            <td>
                                Qoloub, Inc.<br>
                                4 Ibn Al Rom, Madinet Al Eelam<br>
                                Agouza, Giza Governorate<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Product Name
                </td>
                
                <td>
                    Quantity
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    <?php echo $row["d_pname"]; ?>
                </td>
                
                <td>
                    <?php echo $row["d_quantity"]; ?>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Category
                </td>
                
                <td>

                </td>
            </tr>
            
            <tr class="Category">
                <td>
                    <?php echo $row["d_category"]; ?>
                </td>
                
                <td>

                </td>
            </tr>
            
        </table>
    </div>
    <a href="admin.php" class="btn btn-success" style="margin-left: 19%; margin-top: 2%;">Print Invoice</a>  
    <a href="products.php" class="btn btn-dark pull-right" style="margin-left: 1%; margin-top: 2%;">Back</a>
    
</body>
</html>
