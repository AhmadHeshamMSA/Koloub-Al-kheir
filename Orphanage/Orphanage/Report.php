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
                        <h2>Create Report</h2>
                    </div>
                    <form action="#" method="post">
                        <div class="form-group">
                            <h4 style="margin-top: 0%;">Zeyad Salah</h4>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Reason <span style="color: red;">*</span></label>
                            <textarea name="Reason" class="form-control"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Permission valid till: <span style="color: red;">*</span> </label>
                            <input type="date" name="" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Guardian name</label>
                            <input type="text" name="PhoneNumber" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Guardian Phone Number</label>
                            <input type="text" name="PhoneNumber" class="form-control" value="">
                            <span class="help-block"></span>
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