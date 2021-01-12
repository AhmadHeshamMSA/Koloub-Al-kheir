<?php 

session_start();

if (isset($_SESSION['LOGGED IN'])) {
if ($_SESSION["usertype"] == "Supervisor") {
	
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

<html>
	<meta charset="UTF-8">
	<title>Supervisor - Orphanage</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style type="text/css">
        
        body{
    		background-image:
			linear-gradient(180deg, rgba(11,217,237,0.76234243697479) 0%, rgba(12,124,182,0.7511379551820728) 100%), url("img/bg3.jpg");
        	background-repeat: no-repeat;
        	background-size: cover;
        }

        .wrapper{
            width: 800px;
            margin: 0 auto;
            margin-top: 15%;
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
        	<hr>
                        <h4 class="pull-left" style="color: #3B3B3B;">Welcome back, Supervisor!</h4>
                        <hr>
		<div class="row">
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">View Guests</h5>
		        <p class="card-text">Here you can view, add, update, guests.</p>
		        <a href="#" class="btn btn-primary disabled">View Guests</a>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-6">
		    <div class="card">
		      <div class="card-body">
		        <h5 class="card-title">View Orphans</h5>
		        <p class="card-text">Here you can view, add, update, Orphans.</p>
		        <a href="#" class="btn btn-primary disabled">View Orphans</a>
		      </div>
		    </div>
		  </div>
		</div>
		<hr>
		<a href="PHP/Controller/logoutcontroller.php" class="btn btn-dark pull-right" style="margin-left: 90%;">Log out</a>
		</div>
		</div>

	</body>	
</html>