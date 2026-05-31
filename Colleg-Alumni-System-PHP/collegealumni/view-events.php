<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<title>College Alumni System || View Events Details</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/course.css">
<link rel="stylesheet" type="text/css" href="styles/course_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/modern-frontend.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

		<?php include_once('includes/header.php');?>

	
	<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="events.php">Events</a></li>
								<li>Events Details</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Course -->

	<div class="course">
		<div class="container">
			<div class="row">

				<!-- Course -->
				<div class="col-lg-12">
					
					<div class="course_container">
						<div class="course_title">Events Details</div>
						
 <?php
                                    $vid=$_GET['vid'];
                            
$sql="SELECT * from tblevents where ID = :vid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
						<!-- Course Image -->
						<div class="course_image"><img loading="lazy" src="admin/images/<?php echo $row->BannerImage;?>" alt=""></div>

						<!-- Course Tabs -->
						<div class="course_tabs_container">
							
							<div class="tab_panels">

								<!-- Description -->
								<div class="tab_panel active">
									
									<div class="tab_panel_title"><?php  echo $row->EventTitle;?></div>
									<div class="tab_panel_content">
										<div class="tab_panel_text">
											<p><?php  echo $row->Description;?>.</p>
										</div>
										
										<div class="tab_panel_section">
											<div class="tab_panel_subtitle">Date and Time</div>
											<div class="tab_panel_text">
												<p><?php  echo $row->Schedule;?></p>
											</div>
										</div>
							
									</div>
								</div>

						

							

							</div>
						</div>
					</div><?php $cnt=$cnt+1;}} ?>
				</div>

				
			</div>
		</div>
	</div>


	<!-- Footer -->
	<?php include_once('includes/footer.php');?>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="js/course.js"></script>
</body>
</html>