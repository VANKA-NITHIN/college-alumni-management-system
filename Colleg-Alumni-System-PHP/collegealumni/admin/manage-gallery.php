<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (empty($_SESSION['casaid'])) {
  header('location:logout.php');
  } else{

// Handle status updates
if(isset($_GET['status']) && isset($_GET['id'])) {
    $status = $_GET['status']; // 'Approved' or 'Rejected'
    $id = $_GET['id'];
    
    $sql = "UPDATE tblgallery SET Status=:status WHERE ID=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();
    echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Photo status updated successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    echo "<script>window.location.href='manage-gallery.php'</script>";
}

// Delete logic
if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM tblgallery WHERE ID=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();
    echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Photo deleted successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    echo "<script>window.location.href='manage-gallery.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>Admin Dashboard || Manage Gallery</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="style.css" />
      <link rel="stylesheet" href="css/responsive.css" />
      <link rel="stylesheet" href="css/colors.css" />
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="css/custom.css" />
      <link rel="stylesheet" href="css/responsive-overhaul.css" />
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
          <?php include_once('includes/sidebar.php');?>
            <div id="content">
             <?php include_once('includes/header.php');?>
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Moderate Alumni Gallery</h2>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>All Uploaded Photos</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Image</th>
                                             <th>Title</th>
                                             <th>Uploaded By</th>
                                             <th>Upload Date</th>
                                             <th>Status</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          $sql = "SELECT tblgallery.*, tblalumni.FullName FROM tblgallery JOIN tblalumni ON tblgallery.AlumniID = tblalumni.ID ORDER BY tblgallery.UploadDate DESC";
                                          $query = $dbh->prepare($sql);
                                          $query->execute();
                                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                                          $cnt = 1;
                                          if($query->rowCount() > 0) {
                                             foreach($results as $row) {
                                          ?>
                                          <tr>
                                             <td><?php echo htmlentities($cnt);?></td>
                                             <td>
                                                 <a href="../alumni/images/gallery/<?php echo htmlentities($row->ImagePath);?>" target="_blank">
                                                    <img loading="lazy" src="../alumni/images/gallery/<?php echo htmlentities($row->ImagePath);?>" width="100" height="70" style="object-fit:cover;">
                                                 </a>
                                             </td>
                                             <td><?php echo htmlentities($row->Title);?></td>
                                             <td><?php echo htmlentities($row->FullName);?></td>
                                             <td><?php echo date("Y-m-d", strtotime($row->UploadDate));?></td>
                                             <td>
                                                 <?php if($row->Status == 'Approved') { ?>
                                                     <span class="badge badge-success">Approved</span>
                                                 <?php } elseif($row->Status == 'Pending') { ?>
                                                     <span class="badge badge-warning">Pending</span>
                                                 <?php } else { ?>
                                                     <span class="badge badge-danger">Rejected</span>
                                                 <?php } ?>
                                             </td>
                                             <td>
                                                <?php if($row->Status != 'Approved') { ?>
                                                    <a href="manage-gallery.php?status=Approved&id=<?php echo htmlentities($row->ID);?>" class="btn btn-success btn-sm mb-1">Approve</a>
                                                <?php } ?>
                                                <?php if($row->Status != 'Rejected') { ?>
                                                    <a href="manage-gallery.php?status=Rejected&id=<?php echo htmlentities($row->ID);?>" class="btn btn-warning btn-sm mb-1">Reject</a>
                                                <?php } ?>
                                                <a href="manage-gallery.php?del=<?php echo htmlentities($row->ID);?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Do you really want to delete this photo permanently?');">Delete</a>
                                             </td>
                                          </tr>
                                          <?php $cnt++; } } else { ?>
                                          <tr>
                                             <td colspan="7" class="text-center">No photos uploaded yet</td>
                                          </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
                  <?php include_once('includes/footer.php');?>
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html><?php } ?>
