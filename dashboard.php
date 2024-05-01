<?php
include_once 'database.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Online Quiz System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Javascript:void(0)"><b>Online Quiz Application</b></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li <?= @$_GET['q'] == 0 ? 'class="active"' : '' ?>><a href="dashboard.php?q=0">Home Page</a></li>
                    <li <?= @$_GET['q'] == 1 ? 'class="active"' : '' ?>><a href="dashboard.php?q=1">Users List</a></li>
                    <li <?= @$_GET['q'] == 2 ? 'class="active"' : '' ?>><a href="dashboard.php?q=2">Rank Board</a></li>
                    <li class="dropdown <?= @$_GET['q'] == 4 || @$_GET['q'] == 5 ? 'active' : '' ?>">
                        <li><a href="dashboard.php?q=4">Add Quiz</a></li>
                        <li><a href="dashboard.php?q=5">Remove Quiz</a></li>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout1.php?q=dashboard.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (@$_GET['q'] == 0) : ?>
                    <h1> WELCOME TO Admin Page</h1>
                <?php endif; ?>

                <?php if (@$_GET['q'] == 2) : ?>
                    <?php
                    $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC") or die('Error223');
                    ?>
                    <div class="panel title">
                        <div class="table-responsive">
                            <table class="table table-striped title1">
                                <tr style="color:red">
                                    <td><center><b>Rank</b></center></td>
                                    <td><center><b>Email Id</b></center></td>
                                    <td><center><b>Score</b></center></td>
                                </tr>
                                <?php
                                $c = 0;
                                while ($row = mysqli_fetch_array($q)) :
                                    $e = $row['email'];
                                    $s = $row['score'];
                                    $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' ") or die('Error231');
                                    while ($row = mysqli_fetch_array($q12)) :
                                        $name = $row['name'];
                                        $college = $row['college'];
                                    endwhile;
                                    $c++;
                                ?>
                                    <tr>
                                        <td style="color:#99cc32"><center><b><?= $c ?></b></center></td>
                                        <td><center><?= $e ?></center></td>
                                        <td><center><?= $s ?></center></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (@$_GET['q'] == 1) : ?>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM user") or die('Error');
                    ?>
                    <div class="panel">
                        <div class="table-responsive">
                            <table class="table table-striped title1">
                                <tr>
                                    <td><center><b>S.no.</b></center></td>
                                    <td><center><b>Name</b></center></td>
                                    <td><center><b>College</b></center></td>
                                    <td><center><b>Email</b></center></td>
                                    <td><center><b>Action</b></center></td>
                                </tr>
                                <?php
                                $c = 1;
                                while ($row = mysqli_fetch_array($result)) :
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $college = $row['college'];
                                ?>
                                    <tr>
                                        <td><center><?= $c++ ?></center></td>
                                        <td><center><?= $name ?></center></td>
                                        <td><center><?= $college ?></center></td>
                                        <td><center><?= $email ?></center></td>
                                        <td><center><a title="Delete User" href="update.php?demail=<?= $email ?>"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                    if(@$_GET['q']==4 && !(@$_GET['step']) ) 
                    {
                        echo '<div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Enter Quiz Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="total"></label>  
                                    <div class="col-md-12">
                                        <input id="total" name="total" placeholder="Enter the Number of Questions" class="form-control input-md" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="right"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="right" placeholder="Enter the Marks on every Correct Answer" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="wrong" name="wrong" placeholder="Enter Minus Marks on every Wrong Answer(Only the Number)" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Done" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                    }
                ?>

                <?php if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) : ?>
                    <div class="row">
                        <!-- Form for adding quiz questions -->
                    </div>
                <?php endif; ?>

                <?php if (@$_GET['q'] == 5) : ?>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                    ?>
                    <div class="panel">
                        <div class="table-responsive">
                            <table class="table table-striped title1">
                                <tr>
                                    <td><center><b>S.no.</b></center></td>
                                    <td><center><b>Quiz Title</b></center></td>
                                    <td><center><b>Total questions</b></center></td>
                                    <td><center><b>Marks</b></center></td>
                                    <td><center><b>Action</b></center></td>
                                </tr>
                                <?php
                                $c = 1;
                                while ($row = mysqli_fetch_array($result)) :
                                    $title = $row['title'];
                                    $total = $row['total'];
                                    $sahi = $row['sahi'];
                                    $eid = $row['eid'];
                                ?>
                                    <tr>
                                        <td><center><?= $c++ ?></center></td>
                                        <td><center><?= $title ?></center></td>
                                        <td><center><?= $total ?></center></td>
                                        <td><center><?= $sahi * $total ?></center></td>
                                        <td><center><b><a href="update.php?q=rmquiz&eid=<?= $eid ?>" class="pull-right btn sub1" style="margin:0px;background:red;color:black"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></center></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

