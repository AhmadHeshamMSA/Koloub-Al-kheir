<?php

include_once('../Model/Account.php');

if ($_POST) {
    if (isset($_POST['login']) && $_POST['login'] == "Login") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        try {
            session_start();
            $data = new Account();
            $ctr = 0;
            if (strpos($password, "'") !== FALSE) {
                $ctr = 1;
            }
            if ($ctr == 0) {
                $userData = $data->login($username, $password);
                if ($userData != null) {
                    
                    if ($userData->getAccountType()->getType() == "Admin") {
                        
                        if ($userData->getAccountStatus()->getType() == "Active") {
                            $_SESSION['LOGGED IN'] = $userData;
                            echo '<script>location.href="../../admin.php";</script>';
                            $usertype = $userData->getAccountStatus()->getType();
                            $_SESSION["usertype"] = "Admin";

                        } else if ($userData->getAccountStatus()->getType() == "Disabled") {
                            echo '<script>alert("Your Account is Disabled")</script>';
                            echo '<script>location.href="../../login.php";</script>';
                        }

                    } else if ($userData->getAccountType()->getType() != "Admin") {
                        
                        if ($userData->getAccountStatus()->getType() == "Active") {
                            $_SESSION['LOGGED IN'] = $userData;
                            $usertype = $userData->getAccountStatus()->getType();
                            $_SESSION["usertype"] = "Supervisor";
                            echo '<script>location.href="../../user.php";</script>';
                        } else if ($userData->getAccountStatus()->getType() == "Disabled") {
                            echo '<script>alert("Your Account is Disabled, Please Contact Website Admin")</script>';
			    echo '<script>location.href="../../login.php";</script>';
                        }
                    }
                } else {
                    echo '<script>alert("Incorrect Username or Password")</script>';
                    echo '<script>location.href="../../login.php";</script>';
                }
            } else {
                echo '<script>alert("Please Do Not Enter \' ")</script>';
                echo '<script>location.href="../../login.php";</script>';
            }
        } catch (Exception $ex) {
            $ms = $ex->getMessage();
            echo "<script>alert('$ms')</script>";
        }
    }
}
?>