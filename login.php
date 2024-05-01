<?php
    require_once 'database.php';
    session_start();
    if(isset($_SESSION["email"]))
    {
        session_destroy();
    }
    
    $ref = @$_GET['q'];     
    if(isset($_POST['submit']))
    {   
        $email = htmlspecialchars($_POST['email']); 
        $pass = htmlspecialchars($_POST['password']); 
        $email = mysqli_real_escape_string($con, $email);
        $pass = mysqli_real_escape_string($con, $pass);                 
        $query = "SELECT * FROM user WHERE email='$email' and password='$pass'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) != 1) 
        {
            echo "<script>alert('Wrong Username (or) Password');</script>"; 
            header("refresh:0;url=login.php");
            exit(); 
        }
        else
        {
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['logged'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            header('location: welcome.php?q=1');                  
            exit(); 
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login | Online Quiz Application</title>
        <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="css/form.css">
        <style type="text/css">
            body {
                width: 100%;
                background: url(image/book.png);
                background-position:center;
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
                    <div class="box box-border">
                        <div class="box-body">
                            <center> <h5 style="font-family: Calibri (Body);">Login to </h5><h4 style="font-family: Calibri (Body);">Online Quiz Application</h4></center><br>
                            <form method="post" action="login.php" enctype="multipart/form-data">
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
                                <div class="form-group text-center">
                                    <span class="text-muted">Don't have an account?</span> <a href="register.php">Register</a> Here..
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
