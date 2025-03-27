<?php 
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Search Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <style>
        /* 🌅 Background Image */
        body {
            background: url('images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        
/* Optional: To add a slightly darker overlay */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(4, 4, 4, 0.52); /* Dark overlay for better readability */
    z-index: -5;
}

        /* 🎨 Blog Post Card */
        .card.blog-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 2px 6px rgba(243, 236, 236, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card.blog-card:hover {
            transform: scale(1.02);
            box-shadow: 0px 4px 12px rgba(200, 190, 190, 0.2);
        }

        /* 📸 Image Styling */
        .blog-img-container {
            position: relative;
            width: 100%;
            height: 390px; /* 🔥 Increased height for better visuals */
            overflow: hidden;
        }

        .blog-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-img-container img {
            transform: scale(1.05);
        }

        /* 📌 Info Overlay */
        .blog-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
        }

        .blog-info-overlay a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: bold;
        }

        .blog-info-overlay a:hover {
            text-decoration: underline;
        }

        /* 🔘 Read More Button */
        .btn-custom {
            background: #007bff;
            border-radius: 20px;
            padding: 8px 16px;
            color: white;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-custom:hover {
            background: rgb(109, 164, 222);
            transform: scale(1.05);
            color: white;
        }

        /* 📖 Pagination */
        .pagination .page-link {
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        .pagination .page-link:hover {
            background: rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?><br><br><br>

    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Blog Post -->
                <?php 
                if ($_POST['searchtitle'] != '') {
                    $st = $_SESSION['searchtitle'] = $_POST['searchtitle'];
                } else {
                    $st = $_SESSION['searchtitle'];
                }

                // Convert search to lowercase for case-insensitive search
                $st = strtolower($st);

                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                // Case-insensitive query using LOWER() for PostTitle
                $total_pages_sql = "SELECT COUNT(*) FROM tblposts WHERE LOWER(PostTitle) LIKE '%$st%' AND Is_Active = 1";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $query = mysqli_query($con, "SELECT tblposts.id as pid, tblposts.PostTitle as posttitle, tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, tblposts.PostDetails as postdetails, tblposts.PostingDate as postingdate, tblposts.PostUrl as url, tblposts.PostImage 
                FROM tblposts 
                LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId 
                LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
                WHERE LOWER(tblposts.PostTitle) LIKE '%$st%' AND tblposts.Is_Active = 1 
                LIMIT $offset, $no_of_records_per_page");

                $rowcount = mysqli_num_rows($query);
                if ($rowcount == 0) {
                    echo "<h3 style='color:white;'>No record found</h3>";
                } else {
                    while ($row = mysqli_fetch_array($query)) {
                ?>

                        <div class="card mb-4 blog-card">
                            <div class="blog-img-container">
                                <img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                                <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="btn btn-custom">Read More &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on <?php echo htmlentities($row['postingdate']); ?>
                            </div>
                        </div>
                <?php } ?>

                    <!-- 📖 Pagination -->
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                            <a href="<?php if ($pageno > 1) { echo "?pageno=1"; } else { echo '#'; } ?>" class="page-link">First</a>
                        </li>
                        <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                            <a href="<?php if ($pageno > 1) { echo "?pageno=" . ($pageno - 1); } else { echo '#'; } ?>" class="page-link">Prev</a>
                        </li>
                        <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                            <a href="<?php if ($pageno < $total_pages) { echo "?pageno=" . ($pageno + 1); } else { echo '#'; } ?>" class="page-link">Next</a>
                        </li>
                        <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                            <a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a>
                        </li>
                    </ul>
                <?php } ?>

            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
