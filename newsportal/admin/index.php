<?php
session_start();
// Database Configuration File
include('includes/config.php');
// error_reporting(0);

if (isset($_POST['login'])) {
    // Getting username/ email and password
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
    $sql = mysqli_query($con, "SELECT AdminUserName,AdminEmailId,AdminPassword,userType FROM tbladmin WHERE (AdminUserName='$uname' && AdminPassword='$password')");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['utype'] = $num['userType'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News Portal.">
    <meta name="author" content="PHPGurukul">

    <!-- App title -->
    <title>News Portal | Admin Panel</title>

    <!-- App CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <style>
        /* 🌅 Full-Page Background */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('../images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        /* Dark Overlay for Better Readability */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .container-alt {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .account-pages {
            width: 100%;
            max-width: 450px;
            background-color: rgba(106, 98, 98, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
        }

        .account-logo-box {
            margin-bottom: 20px;
        }

        .account-logo-box h2 {
            color: #fff;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #ff4d4d;
            border: none;
        }

        .btn-danger:hover {
            background-color: #e60000;
        }

        /* Link Styles */
        a {
            color: #57c2fc;
            text-decoration: none;
        }

        a:hover {
            color: #ff4d4d;
        }
        
    </style>

    <script src="assets/js/modernizr.min.js"></script>
</head>

<body>

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                    <a href="index.html" class="text-success">
                                        <span>NHITM <b style="color: #57c2fc; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">NEWS PORTAL</b></span>
                                    </a>
                                </h2>
                            </div>

                            <div class="account-content">
                                <form class="form-horizontal" method="post">

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="username" placeholder="Username or email" autocomplete="off">
                                        </div>
                                    </div>
                                    <a href="forgot-password.php"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Log In</button>
                                        </div>
                                    </div>

                                </form><br><br><br>

                                <div class="clearfix"></div>
                                <a href="../index.php" style="background-color: blue; border: none; padding: 5px 10px; border-radius: 8px; color: white; text-decoration: none; font-weight: bold; display: inline-block; transition: background-color 0.3s ease;" 
   onmouseover="this.style.backgroundColor='#0056b3';" 
   onmouseout="this.style.backgroundColor='black';">
    <i class="mdi mdi-home"></i> Back Home
</a>

                            </div>
                        </div>
                        <!-- end card-box-->

                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>
