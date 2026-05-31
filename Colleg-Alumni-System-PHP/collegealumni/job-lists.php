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
								<li><a href="job-lists.php">Job Lists</a></li>
								<li>Details of Jobs</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Contact -->

	<div class="contact">
		<div class="contact_info_container">
			<div class="container">
				<div class="row">
					<!-- Contact Info -->
					<div class="col-lg-12">
						<div class="contact_info">
							<div class="contact_info_title">Posted Job Details</div>
							<div class="contact_info_text">
                                <div class="table-responsive">
								<table class="table table-bordered">
                                       <thead>
                                             <tr>
                                        <th class="text-center">S.No</th>
                                        <th>Job Title</th>
                                        <th>Company Name</th>
                                        <th>Location</th>
                                        <th>Vacancy</th>
                                        <th>Designation</th>
                                        <th>Job Description</th>
                                        <th>Last Date</th>
                                        <th>Posting Date</th>
                                        <th>Contact Number</th>
                                        <th>Contact Person</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          if (isset($_GET['pageno'])) {
            $pageno = (int)$_GET['pageno'];
        } else {
            $pageno = 1;
        }
        // Formula for pagination
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;
       $ret = "SELECT ID FROM tbljobpost where Status='Approved'";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);
$sql="SELECT * from tbljobpost where Status='Approved' LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                          <tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->JobTitle);?></td>
                                        <td><?php  echo htmlentities($row->CompanyName);?></td>
                                        <td><?php  echo htmlentities($row->Location);?></td>
                                        <td><?php  echo htmlentities($row->Vacancy);?></td>
                                        <td><?php  echo htmlentities($row->Designation);?></td>
                                       <td><?php  echo htmlentities($row->JobDescription);?></td>
                                        <td><?php  echo htmlentities($row->LastDate);?></td>
                                        <td>
                                            <?php  echo htmlentities($row->PostingDate);?>
                                        </td>
                                      <td><?php  echo htmlentities($row->ContactNumber);?></td>
                                      <td ><?php  echo htmlentities($row->ContactPerson);?></td>
                                    </tr><?php $cnt=$cnt+1;}} ?>
                                        </tbody>
                                     </table>
                                     </div>
                                     <div align="left">
    <ul class="pagination" >
        <li><a href="?pageno=1"><strong>First></strong></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong style="padding-left: 10px">Prev></strong></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong style="padding-left: 10px">Next></strong></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
    </ul>
</div>
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