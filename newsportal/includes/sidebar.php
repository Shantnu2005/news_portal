
<div class="col-md-4">
    <!-- 🔎 Search Widget -->
    <div class="card widget-card mb-4">
        <h5 class="card-header widget-title">Search</h5>
        <div class="card-body">
            <form name="search" action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                    <button class="btn btn-dark" type="submit">Go!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🏷️ Categories Widget -->
    <div class="card widget-card my-4">
        <h5 class="card-header widget-title">Categories</h5>
        <div class="card-body">
            <div class="row">
                <?php 
                $query = mysqli_query($con, "SELECT id, CategoryName, Image FROM tblcategory");
                while ($row = mysqli_fetch_array($query)) { 
                    $categoryImage = !empty($row['Image']) ? "admin/" . htmlentities($row['Image']) : "images/default-category.jpg";
                ?>
                    <div class="col-lg-12 mb-2">
                        <a href="category.php?catid=<?php echo htmlentities($row['id'])?>" 
                           class="category-card d-block text-decoration-none" 
                           style="background-image: url('<?php echo $categoryImage; ?>');">
                            <div class="category-overlay">
                                <h6 class="category-title"><?php echo htmlentities($row['CategoryName']); ?></h6>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- 📰 Recent News -->
    <div class="card widget-card my-4">
        <h5 class="card-header widget-title">Recent News</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <?php
                $query = mysqli_query($con, "SELECT id, PostTitle FROM tblposts ORDER BY id DESC LIMIT 8");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <li class="news-item">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['id']); ?>" class="news-link">
                            <?php echo htmlentities($row['PostTitle']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- 🔥 Popular News -->
    <div class="card widget-card my-4">
        <h5 class="card-header widget-title">Popular News</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <?php
                $query1 = mysqli_query($con, "SELECT id, PostTitle FROM tblposts ORDER BY viewCounter DESC LIMIT 5");
                while ($result = mysqli_fetch_array($query1)) {
                ?>
                    <li class="news-item">
                        <a href="news-details.php?nid=<?php echo htmlentities($result['id']); ?>" class="news-link">
                            <?php echo htmlentities($result['PostTitle']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- 🎨 Custom CSS -->
<style>
    /* 🔥 Global Card Styling */
    .widget-card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 2px 6px rgba(67, 62, 62, 0.29);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .widget-card:hover {
        transform: scale(1.02);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }

    .widget-title {
        background: rgba(0, 0, 0, 0.8);
        color: rgba(255, 255, 255, 0.9);
        font-weight: bold;
        padding: 12px;
        text-align: center;
    }

    /* 🏷️ Category Card Styling */
    .category-card {
        position: relative;
        width: 100%;
        height: 80px; /* 🔥 Reduced height for a sleek look */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }

    .category-overlay {
        position: absolute;
        top: 10;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3); /* 🔥 Lighter overlay to keep the image visible */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .category-title {
        color: rgba(255, 255, 255, 0.85); /* 🔥 Lightened text for better visibility */
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        padding: 5px;
    }

    /* 📰 News List */
    .news-item {
        padding: 10px;
        background: rgba(0, 0, 0, 0.03);
        border-radius: 5px;
        margin-bottom: 5px;
        transition: background 0.3s;
    }

    .news-item:hover {
        background: rgba(0, 0, 0, 0.1);
    }

    .news-link {
        color: rgba(0, 0, 0, 0.8);
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .news-link:hover {
        color: rgba(0, 0, 0, 1);
        text-decoration: underline;
    }
    .col-md-4{
        margin-top: 50px;
    }
</style>
