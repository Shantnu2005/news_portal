<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
} else {

    if(isset($_POST['submit'])) {
        $category = $_POST['category'];
        $description = $_POST['description'];
        $status = 1;

        // Check if the Image column exists in the database
        $checkColumn = mysqli_query($con, "SHOW COLUMNS FROM tblcategory LIKE 'Image'");
        if(mysqli_num_rows($checkColumn) == 0) {
            mysqli_query($con, "ALTER TABLE tblcategory ADD COLUMN Image VARCHAR(255) NOT NULL");
        }

        // Image upload handling
        $targetDir = "uploads/category_images/"; // Folder where images will be stored
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create folder if not exists
        }

        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                echo "<script>alert('Image uploaded successfully: " . $targetFilePath . "');</script>";

                // Insert into database
                $query = mysqli_query($con, "INSERT INTO tblcategory(CategoryName, Description, Is_Active, Image) VALUES ('$category', '$description', '$status', '$targetFilePath')");
                
                if ($query) {
                    echo "<script>alert('Category created successfully with image!');</script>";
                } else {
                    echo "<script>alert('Database error: " . mysqli_error($con) . "');</script>";
                }
            } else {
                echo "<script>alert('Error uploading image. Check file permissions and folder existence.');</script>";
            }
        } else {
            echo "<script>alert('Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Newsportal | Add Category</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">
        <div id="wrapper">
            <?php include('includes/topheader.php');?>
            <?php include('includes/leftsidebar.php');?>

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Category</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Category</a></li>
                                        <li class="active">Add Category</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Category</b></h4>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php if(isset($msg)){ ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                                </div>
                                            <?php } ?>

                                            <?php if(isset($error)){ ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="category" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category Description</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" rows="5" name="description" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Upload Image</label>
                                                    <div class="col-md-10">
                                                        <input type="file" class="form-control" name="image" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">
                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php include('includes/footer.php');?>

            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
<?php } ?>
