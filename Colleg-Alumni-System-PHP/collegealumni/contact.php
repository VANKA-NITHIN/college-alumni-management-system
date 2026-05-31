<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<title>College Alumni System || Contact</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
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
								<li>Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Contact -->

	<div class="contact">
		


		<!-- Contact Info -->

		<div class="contact_info_container">
			<div class="container">
				<div class="row">

				

					<!-- Contact Info -->
					<div class="col-lg-8">
						<div class="contact_info">
							<div class="contact_info_title">Contact Info</div>
						
							<div class="contact_info_location">
								<?php
$sql="SELECT * from tblpage where PageType='contactus'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
								<ul class="location_list">
									<li><h3>Address</h3>
								<p><?php  echo htmlentities($row->PageDescription);?></p></li>
									<li><h3>Contact Number</h3>
								
								<p>+<?php  echo htmlentities($row->MobileNumber);?></p></li>
									<li><h3>Email</h3>
								
								<p><?php  echo htmlentities($row->Email);?></p></li>
								</ul><?php $cnt=$cnt+1;}} ?>
							</div>
							
						</div>
					</div>
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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="plugins/marker_with_label/marker_with_label.js"></script>
<script src="js/contact.js"></script>
</body>
</html>