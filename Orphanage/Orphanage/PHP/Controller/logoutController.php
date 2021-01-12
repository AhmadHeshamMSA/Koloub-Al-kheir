<?php

include_once ('../Model/Account.php');
session_start();

if (isset($_SESSION['LOGGED IN'])) {
$data=$_SESSION["user"];
$data->logout();
echo '<script>alert("logged out successfully... \' ")</script>';
echo '<script>location.href="../../login.php";</script>';
}
else{
	echo '<script>alert("Already Logged out... \' ")</script>';
	echo '<script>location.href="../../login.php";</script>';	
}