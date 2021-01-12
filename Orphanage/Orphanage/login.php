

<html>
	<head>
		<title>Login - Orphanage</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<style type="text/css">
			body{
	    		background-image:
				linear-gradient(180deg, rgba(11,217,237,0.76234243697479) 0%, rgba(12,124,182,0.7511379551820728) 100%), url("img/bg3.jpg");
	        	background-repeat: no-repeat;
	        	background-size: cover;
	        }

	        .wrapper{
	            width: 400px;
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
		        <h4 class="pull-left" style="color: #3B3B3B; margin-left: 40%;">Login</h4>
				<hr>

				<form action="PHP/Controller/LoginController.php" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="login" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <input type="submit" value="Login" class="fadeIn fourth btn btn-primary"name="login">
                    </form>

			  <!-- <form action="PHP/Controller/LoginController.php" method="post">
			  <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username">
			  <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
			  <input type="submit" value="Login" class="fadeIn fourth btn btn-primary"name="login">
			</form> -->

	</body>
</html>