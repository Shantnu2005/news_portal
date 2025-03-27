<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
}
else {
    if(isset($_POST['submitsubcat'])) {
        $categoryid = $_POST['category'];
        $subcatname = $_POST['subcategory'];
        $subcatdescription = $_POST['sucatdescription'];
        $status = 1;

        // Image Upload Handling
        $targetDir = "uploads/subcategory_images/"; // Folder to store images
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create folder if it doesn't exist
        }

        $imageName = basename($_FILES["subcatimage"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageFileType, $allowedTypes)) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["subcatimage"]["tmp_name"], $targetFilePath)) {
                // Insert into database with image path
                $query = mysqli_query($con, "INSERT INTO tblsubcategory(CategoryId, Subcategory, SubCatDescription, Image, Is_Active) 
                                             VALUES('$categoryid', '$subcatname', '$subcatdescription', '$targetFilePath', '$status')");
                if ($query) {
                    $msg = "Sub-Category created successfully with image!";
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            } else {
                $error = "Failed to upload image. Please try again.";
            }
        } else {
            $error = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Newsportal | Add Sub Category</title>
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Sub-Category</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Category </a></li>
                                    <li class="active">Add Sub-Category</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Add Sub-Category </b></h4>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Success Message -->
                                        <?php if($msg){ ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                        </div>
                                        <?php } ?>

                                        <!-- Error Message -->
                                        <?php if($error){ ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Form Starts -->
                                        <form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Category</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="category" required>
                                                        <option value="">Select Category </option>
                                                        <?php
                                                        // Fetch active categories
                                                        $ret = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory WHERE Is_Active=1");
                                                        while ($result = mysqli_fetch_array($ret)) {
                                                        ?>
                                                        <option value="<?php echo htmlentities($result['id']); ?>">
                                                            <?php echo htmlentities($result['CategoryName']); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Sub-Category</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="subcategory" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Sub-Category Description</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" name="sucatdescription" required></textarea>
                                                </div>
                                            </div>

                                            <!-- Image Upload Field -->
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Upload Image</label>
                                                <div class="col-md-10">
                                                    <input type="file" class="form-control" name="subcatimage" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">&nbsp;</label>
                                                <div class="col-md-10">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitsubcat">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- Form Ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>

        </div>
    </div>
    <!-- END wrapper -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>
<?php } ?>
