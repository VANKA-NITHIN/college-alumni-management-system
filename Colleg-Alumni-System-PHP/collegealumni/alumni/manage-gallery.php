<?php
session_start();
//error_reporting(0);
include('../admin/includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit'])) {
    $alumniid = $_SESSION['alumniid'];
    $title = $_POST['title'];
    
    // File upload logic
    $pic = $_FILES["image"]["name"];
    $extension = substr($pic,strlen($pic)-4,strlen($pic));
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    
    if(!in_array($extension,$allowed_extensions)) {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Invalid format. Only jpg / jpeg/ png /gif format allowed', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    } else {
        $imgnewfile = md5($pic).time().$extension;
        
        // Ensure directory exists
        if (!file_exists('images/gallery/')) {
            mkdir('images/gallery/', 0777, true);
        }
        
        move_uploaded_file($_FILES["image"]["tmp_name"],"images/gallery/".$imgnewfile);
        
        $sql = "INSERT INTO tblgallery(Title,ImagePath,AlumniID,Status) VALUES(:title,:image,:alumniid,'Pending')";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':image',$imgnewfile,PDO::PARAM_STR);
        $query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        
        if ($LastInsertId > 0) {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Photo uploaded successfully. It will be visible after admin approval.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
            echo "<script>window.location.href ='manage-gallery.php'</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Something Went Wrong. Please try again', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
        }
    }
}

// Delete logic
if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $alumniid = $_SESSION['alumniid'];
    
    // Check if image belongs to user before deleting
    $sql = "DELETE FROM tblgallery WHERE ID=:id AND AlumniID=:alumniid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
    $query->execute();
    echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Photo deleted successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    echo "<script>window.location.href='manage-gallery.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>Alumni System || Manage Gallery</title>
      <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
      <link rel="stylesheet" href="../admin/style.css" />
      <link rel="stylesheet" href="../admin/css/responsive.css" />
      <link rel="stylesheet" href="../admin/css/colors.css" />
      <link rel="stylesheet" href="../admin/css/bootstrap-select.css" />
      <link rel="stylesheet" href="../admin/css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="../admin/css/custom.css" />
      <link rel="stylesheet" href="../admin/css/responsive-overhaul.css" />
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
             <?php include_once('includes/header.php');?>
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Manage My Gallery</h2>
                           </div>
                        </div>
                     </div>
                     
                     <!-- Upload Form -->
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Upload New Photo</h2>
                                 </div>
                              </div>
                              <div class="full inner_elements">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="tab_style2">
                                          <div class="tabbar padding_infor_info">
                                             <form method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                   <label class="label_field">Photo Title</label>
                                                   <input type="text" name="title" class="form-control" required="true">
                                                </div>
                                                <div class="form-group">
                                                   <label class="label_field">Select Image</label>
                                                   <input type="file" name="image" class="form-control" required="true">
                                                </div>
                                                <div class="form-group margin_0">
                                                   <button class="main_bt" type="submit" name="submit">Upload Photo</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Uploaded Photos Table -->
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>My Uploaded Photos</h2>
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
                                             <th>Upload Date</th>
                                             <th>Status</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          $alumniid = $_SESSION['alumniid'];
                                          $sql = "SELECT * FROM tblgallery WHERE AlumniID=:alumniid ORDER BY UploadDate DESC";
                                          $query = $dbh->prepare($sql);
                                          $query->bindParam(':alumniid',$alumniid,PDO::PARAM_STR);
                                          $query->execute();
                                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                                          $cnt = 1;
                                          if($query->rowCount() > 0) {
                                             foreach($results as $row) {
                                          ?>
                                          <tr>
                                             <td><?php echo htmlentities($cnt);?></td>
                                             <td><img loading="lazy" src="images/gallery/<?php echo htmlentities($row->ImagePath);?>" width="100" height="70" style="object-fit:cover;"></td>
                                             <td><?php echo htmlentities($row->Title);?></td>
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
                                                <a href="manage-gallery.php?del=<?php echo htmlentities($row->ID);?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you really want to delete this photo?');">Delete</a>
                                             </td>
                                          </tr>
                                          <?php $cnt++; } } else { ?>
                                          <tr>
                                             <td colspan="6" class="text-center">No photos uploaded yet</td>
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
      <script src="../admin/js/jquery.min.js"></script>
      <script src="../admin/js/popper.min.js"></script>
      <script src="../admin/js/bootstrap.min.js"></script>
      <script src="../admin/js/custom.js"></script>
   </body>
</html><?php } ?>
