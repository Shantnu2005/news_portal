<?php
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Contact us</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <style>
        /* 🌟 Full Page Background */
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/image.png'); /* Add your background image path */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color:black; /* White text for better contrast */
        }

        /* Overlay for better readability */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: -1;
        }

        /* White Text for Page Content */
        h1, h2, h3, h4, h5, h6, p, a {
            color: white !important;
        }

        a:hover {
            color:rgb(224, 215, 216) !important; /* Light color on hover */
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>
    
    <!-- Page Content -->
    <div class="container">

        <?php
        $pagetype = 'contactus';
        $query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <h1 class="mt-4 mb-3"><?php echo htmlentities($row['PageTitle']) ?>
            </h1>

            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: black;">
                    <a href="index.php" style="color: black;">Home</a>
                </li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>

            <!-- Intro Content -->
            <div class="row">
                <div class="col-lg-12">
                    <p><?php echo $row['Description']; ?></p>
                </div>
            </div>
            <!-- /.row -->
        <?php } ?>

    </div>
    <!-- /.container -->

   

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
