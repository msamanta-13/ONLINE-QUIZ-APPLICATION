<?php
include_once 'database.php';
session_start();
if(isset($_SESSION["email"])) session_destroy();
$ref = @$_GET['q'];
if(isset($_POST['submit']))
{	
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $result = mysqli_query($con, "SELECT email FROM admin WHERE email = '$email' AND password = '$password'") or die('Error');
    if(mysqli_num_rows($result) == 1)
    {
        session_start();
        if(isset($_SESSION['email'])) session_unset();
        $_SESSION["name"] = 'Admin';
        $_SESSION["key"] = 'admin';
        $_SESSION["email"] = $email;
        header("location:dashboard.php?q=0");
    }
    else
    {
        echo "<center><h3><script>alert('Wrong Username (or) Password');</script></h3></center>";
        header("refresh:0;url=admin.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login | Online Quiz Application</title>
    <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="css/form.css">
    <style type="text/css">
        body{
              width: 100%;
              background: url(image/book.png) ;
              background-position: right;
              background-repeat: no-repeat;
              background-attachment: fixed;
              background-size: cover;
            }
      </style>
</head>
<body>
    <section class="login black">
        <div class="container">
            <div class="box-wrapper">				
                <div class="border">
                    <div class="box-body">
                        <center> <h2 style="font-family: Calibri (Body);">Administrator</h2><h4 style="font-family: Calibri (Body);">Login</h4></center><br>
                        <form method="post" action="admin.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Email Id:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="fw">Password:
                                    <a href="javascript:void(0)" class="pull-right">Forgot Password?</a>
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div> 
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block" name="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
</body>
</html>

