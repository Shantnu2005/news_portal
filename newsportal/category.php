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
    <meta name="description" content="News Portal | Category Page">
    <meta name="author" content="">

    <title>News Portal | Category Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <style>
        /* 🌟 Full Page Background */
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/bg.jpg'); /* Add Full-Size Background Image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay for better readability */
            z-index: -1;
        }

        /* Main Container with Transparency */
        .main-container {
            border-radius: 12px;
            padding: 20px;
            margin-top: 3%;
        }

        /* Subcategory List Container */
        .subcategory-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        /* Subcategory Card with Full Background */
        .subcategory-card {
            position: relative;
            height: 160px;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .subcategory-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(167, 164, 164, 0.2);
        }

        /* Full Background Image for Subcategory */
        .subcategory-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            filter: brightness(0.7);
        }

        /* Overlay with Text */
        .subcategory-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .subcategory-title {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            background-color: rgba(203, 207, 211, 0.61);
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter-row label {
            font-weight: bold;
            color: #333;
            margin-bottom: 0;
        }

        .filter-row select {
            width: 180px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Post Section */
        .post-section {
            padding: 20px;
        }

        .card {
            background-color: #fff;
            color: #000;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-weight: bold;
            color: #000;
        }

        .card-footer {
            background-color: #f1f1f1;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container main-container">
        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                // Check if category ID is passed
                if ($_GET['catid'] != '') {
                    $_SESSION['catid'] = intval($_GET['catid']);
                    unset($_SESSION['subcatid']);
                }

                // Check if subcategory ID is passed
                if ($_GET['subcatid'] != '') {
                    $_SESSION['subcatid'] = intval($_GET['subcatid']);
                }

                // Show Subcategories only if no subcategory is selected
                if (!isset($_SESSION['subcatid']) && isset($_SESSION['catid'])) {
                    $subcat_query = mysqli_query($con, "SELECT SubCategoryId, Subcategory, Image FROM tblsubcategory WHERE CategoryId='" . $_SESSION['catid'] . "' AND Is_Active=1");
                    $subcat_count = mysqli_num_rows($subcat_query);

                    if ($subcat_count > 0) {
                        echo "<h2 style='color: white; font-weight: bold;'>Select Subcategory</h2>";
                        echo "<div class='subcategory-container'>";
                        while ($subcat_row = mysqli_fetch_array($subcat_query)) {
                            $subcat_image = htmlentities($subcat_row['Image']);
                            $subcat_name = htmlentities($subcat_row['Subcategory']);
                        ?>
                            <a href="category.php?subcatid=<?php echo htmlentities($subcat_row['SubCategoryId']); ?>" class="subcategory-card">
                                <div class="subcategory-bg" style="background-image: url('admin/<?php echo $subcat_image; ?>');"></div>
                                <div class="subcategory-overlay">
                                    <h5 class="subcategory-title"><?php echo $subcat_name; ?></h5>
                                </div>
                            </a>
                        <?php
                        }
                        echo "</div>";
                    } else {
                        echo "<h3 style='color: white; font-weight: bold;'>No Subcategories Available</h3>";
                    }
                }
                ?>

                <?php
                // Show Month & Year Filter only if subcategory is selected
                if (isset($_SESSION['subcatid'])) {
                ?>
                    <!-- Month & Year Filter (Visible only when Subcategory is selected) -->
                    <form method="GET" action="">
                        <div class="filter-row">
                            <label for="month">Month:</label>
                            <select name="month" id="month" class="form-control">
                                <option value="">-- Select Month --</option>
                                <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $month_name = date('F', mktime(0, 0, 0, $m, 1));
                                    $selected = ($_GET['month'] == $m) ? 'selected' : '';
                                    echo "<option value='$m' $selected>$month_name</option>";
                                }
                                ?>
                            </select>

                            <label for="year">Year:</label>
                            <select name="year" id="year" class="form-control">
                                <option value="">-- Select Year --</option>
                                <?php
                                $currentYear = date('Y');
                                for ($y = $currentYear; $y >= $currentYear - 5; $y--) {
                                    $selected = ($_GET['year'] == $y) ? 'selected' : '';
                                    echo "<option value='$y' $selected>$y</option>";
                                }
                                ?>
                            </select>

                            <input type="hidden" name="subcatid" value="<?php echo $_SESSION['subcatid']; ?>" />
                            <button type="submit" class="btn btn-success btn-sm">Filter</button>
                        </div>
                    </form>
                <?php
                }
                ?>

                <div class="post-section">
                    <?php
                    // Pagination Setup
                    $pageno = $_GET['pageno'] ?? 1;
                    $no_of_records_per_page = 8;
                    $offset = ($pageno - 1) * $no_of_records_per_page;

                    // Condition to filter posts by category or subcategory
                    $condition = "";
                    if (isset($_SESSION['subcatid'])) {
                        $condition = " AND tblposts.SubCategoryId='" . $_SESSION['subcatid'] . "'";
                    } elseif (isset($_SESSION['catid'])) {
                        $condition = " AND tblposts.CategoryId='" . $_SESSION['catid'] . "'";
                    }

                    // Date Filter Condition
                    $date_filter = "";
                    if (!empty($_GET['month']) && !empty($_GET['year'])) {
                        $month = intval($_GET['month']);
                        $year = intval($_GET['year']);
                        $date_filter = " AND MONTH(tblposts.PostingDate) = $month AND YEAR(tblposts.PostingDate) = $year";
                    }

                    // Count total records with condition
                    $total_pages_sql = "SELECT COUNT(*) FROM tblposts WHERE Is_Active=1 $condition $date_filter";
                    $result = mysqli_query($con, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    // Fetch posts based on selected subcategory
                    $query = mysqli_query($con, "SELECT tblposts.id as pid, tblposts.PostTitle as posttitle, tblposts.PostImage, tblcategory.CategoryName as category, tblsubcategory.Subcategory as subcategory, tblposts.PostingDate as postingdate 
                        FROM tblposts 
                        LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId 
                        LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId 
                        WHERE tblposts.Is_Active=1 $condition $date_filter
                        ORDER BY tblposts.id DESC 
                        LIMIT $offset, $no_of_records_per_page");

                    $rowcount = mysqli_num_rows($query);

                    // Show posts from selected subcategory
                    if ($rowcount == 0) {
                        echo "<h3 style='color: white; font-weight: bold;'>No records found in this category or subcategory.</h3>";
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                            <h3 style="color: white; font-weight: bold;"><?php echo htmlentities($row['category']); ?> News</h3>
                            <div class="card mb-4">
                                <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                                <div class="card-body">
                                    <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                                    <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="btn btn-primary">Read More &rarr;</a>
                                </div>
                                <div class="card-footer text-muted">
                                    Posted on <?php echo htmlentities($row['postingdate']); ?>
                                </div>
                            </div>
                    <?php }
                    } ?>

                    <?php
                    // Show Pagination Links only if records exist
                    if ($rowcount > 0) { ?>
                        <ul class="pagination justify-content-center mb-4">
                            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                            <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                                <a href="<?php if ($pageno > 1) { echo "?pageno=" . ($pageno - 1); } else { echo '#'; } ?>" class="page-link">Prev</a>
                            </li>
                            <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                                <a href="<?php if ($pageno < $total_pages) { echo "?pageno=" . ($pageno + 1); } else { echo '#'; } ?>" class="page-link">Next</a>
                            </li>
                            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
