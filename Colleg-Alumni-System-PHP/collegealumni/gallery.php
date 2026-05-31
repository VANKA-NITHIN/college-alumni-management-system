<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<title>College Alumni System || Alumni Gallery</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/modern-frontend.css">

<style>
    /* Premium Glassmorphism Gallery Styling */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 30px;
        padding: 40px 0;
    }
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        background: #fff;
    }
    .gallery-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.08);
    }
    .gallery-overlay {
        position: absolute;
        bottom: -100%;
        left: 0;
        width: 100%;
        padding: 20px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: bottom 0.4s ease;
        border-top: 1px solid rgba(255, 255, 255, 0.5);
    }
    .gallery-item:hover .gallery-overlay {
        bottom: 0;
    }
    .gallery-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }
    .gallery-meta {
        font-size: 13px;
        color: #64748b;
    }
    .gallery-meta i {
        color: #6366f1;
        margin-right: 5px;
    }
</style>
</head>
<body>

<div class="super_container">

	<!-- Header -->
	<?php include_once('includes/header.php');?>

	<!-- Home Breadcrumbs -->
	<div class="home" style="height: 250px; background: linear-gradient(135deg, rgba(20, 189, 238, 0.8), rgba(99, 102, 241, 0.8));">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php" style="color: #fff;">Home</a></li>
								<li style="color: #fff;">Alumni Gallery</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Gallery -->
	<div class="events">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center" style="margin-top: 50px;">
						<h2 class="section_title">Alumni Memories & Gallery</h2>
						<p class="section_subtitle">Explore photos from past events, reunions, and college days shared by our alumni network.</p>
					</div>
				</div>
			</div>
			
            <div class="gallery-grid">
                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = (int)$_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                
                $no_of_records_per_page = 9;
                $offset = ($pageno-1) * $no_of_records_per_page;
                
                // Get total records
                $ret = "SELECT ID FROM tblgallery WHERE Status='Approved'";
                $query1 = $dbh->prepare($ret);
                $query1->execute();
                $total_rows = $query1->rowCount();
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                
                // Fetch paginated gallery photos
                $sql = "SELECT tblgallery.*, tblalumni.FullName FROM tblgallery 
                        JOIN tblalumni ON tblgallery.AlumniID = tblalumni.ID 
                        WHERE tblgallery.Status='Approved' 
                        ORDER BY tblgallery.UploadDate DESC LIMIT $offset, $no_of_records_per_page";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if($query->rowCount() > 0) {
                    foreach($results as $row) {               
                ?>
                <div class="gallery-item">
                    <img loading="lazy" src="alumni/images/gallery/<?php echo htmlentities($row->ImagePath);?>" onerror="this.src='images/placeholder.jpg'" alt="<?php echo htmlentities($row->Title);?>">
                    <div class="gallery-overlay">
                        <div class="gallery-title"><?php echo htmlentities($row->Title);?></div>
                        <div class="gallery-meta">
                            <i class="fa fa-user"></i> By <?php echo htmlentities($row->FullName);?><br>
                            <i class="fa fa-calendar"></i> <?php echo date("F j, Y", strtotime($row->UploadDate));?>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo "<div class='w-100 text-center py-5'><h4>No photos have been approved yet. Check back soon!</h4></div>";
                }
                ?>
            </div>

            <!-- Pagination -->
            <?php if($total_pages > 1) { ?>
			<div align="center" class="mt-4 mb-5">
                <ul class="pagination justify-content-center" >
                    <li><a href="?pageno=1"><strong>First</strong></a></li>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev</strong></a>
                    </li>
                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next</strong></a>
                    </li>
                    <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
                </ul>
            </div>
            <?php } ?>

		</div>
	</div>

	<!-- Footer -->
	<?php include_once('includes/footer.php');?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
