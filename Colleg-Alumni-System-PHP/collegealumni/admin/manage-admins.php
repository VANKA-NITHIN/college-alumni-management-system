<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (empty($_SESSION['casaid'])) {
  header('location:logout.php');
  } else{

// Code for deletion
if(isset($_GET['delid']))
{
    $rid=intval($_GET['delid']);
    // Check if admin is trying to delete their own account
    if($rid == $_SESSION['casaid']) {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'You cannot delete your own admin account.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    } else {
        $sql="delete from tbladmin where ID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
        echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Admin Data deleted', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>"; 
        echo "<script>window.location.href = 'manage-admins.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || Manage Admins</title>
      
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
                              <h2>Manage Admins</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>List of Administrators</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Admin Name</th>
                                             <th>Username</th>
                                             <th>Mobile Number</th>
                                             <th>Email</th>
                                             <th>Creation Date</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          $sql="SELECT * from tbladmin";
                                          $query = $dbh -> prepare($sql);
                                          $query->execute();
                                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                                          
                                          $cnt=1;
                                          if($query->rowCount() > 0)
                                          {
                                          foreach($results as $row)
                                          {               ?>
                                          <tr>
                                             <td><?php echo htmlentities($cnt);?></td>
                                             <td><?php  echo htmlentities($row->AdminName);?></td>
                                             <td><?php  echo htmlentities($row->UserName);?></td>
                                             <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                             <td><?php  echo htmlentities($row->Email);?></td>
                                             <td><?php  echo htmlentities($row->AdminRegdate);?></td>
                                             <td>
                                                 <?php if($row->ID != $_SESSION['casaid']) { ?>
                                                 <a href="manage-admins.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-sm">Delete</a>
                                                 <?php } else { ?>
                                                 <span class="badge badge-success">Logged In</span>
                                                 <?php } ?>
                                             </td>
                                          </tr>
                                          <?php $cnt=$cnt+1;}} ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- footer -->
                 <?php include_once('includes/footer.php');?>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/animate.js"></script>
      <script src="js/bootstrap-select.js"></script>
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <script src="js/custom.js"></script>
   </body>
</html>
<?php } ?>
