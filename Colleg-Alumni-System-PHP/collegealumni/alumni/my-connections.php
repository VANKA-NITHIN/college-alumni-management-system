<?php
session_start();
//error_reporting(0);
include('../admin/includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
} else {
  
$alumniid = $_SESSION['alumniid'];

// Handle Accept/Reject Actions
if(isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $connId = $_GET['id'];
    
    if($action == 'accept' || $action == 'reject') {
        $status = ($action == 'accept') ? 'Accepted' : 'Rejected';
        // Verify this request belongs to this user
        $sql = "UPDATE tblconnections SET Status=:status WHERE ID=:id AND ReceiverID=:alumniid";
        $query = $dbh->prepare($sql);
        $query->execute(array(':status'=>$status, ':id'=>$connId, ':alumniid'=>$alumniid));
        echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Connection updated successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
        echo "<script>window.location.href='my-connections.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || My Connections</title>
      
      <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
      <link rel="stylesheet" href="../admin/style.css" />
      <link rel="stylesheet" href="../admin/css/responsive.css" />
      <link rel="stylesheet" href="../admin/css/colors.css" />
      <link rel="stylesheet" href="../admin/css/bootstrap-select.css" />
      <link rel="stylesheet" href="../admin/css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="../admin/css/custom.css" />
      <link rel="stylesheet" href="../admin/css/responsive-overhaul.css" />
      
      <style>
          .connection-card {
              background: #fff;
              border-radius: 12px;
              padding: 20px;
              box-shadow: 0 4px 15px rgba(0,0,0,0.05);
              margin-bottom: 20px;
              display: flex;
              align-items: center;
              border: 1px solid #f1f5f9;
          }
          .conn-img {
              width: 60px;
              height: 60px;
              border-radius: 50%;
              object-fit: cover;
              margin-right: 15px;
          }
          .conn-info {
              flex-grow: 1;
          }
          .conn-name {
              font-size: 16px;
              font-weight: 600;
              color: #1e293b;
              margin-bottom: 2px;
          }
          .conn-meta {
              font-size: 13px;
              color: #64748b;
          }
          .conn-actions {
              min-width: 150px;
              text-align: right;
          }
      </style>
   </head>
   <body class="dashboard dashboard_1">
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
                              <h2>My Connections</h2>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row">
                        <!-- Incoming Requests -->
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Pending Incoming Requests</h2>
                                 </div>
                              </div>
                              <div class="padding_infor_info">
                                  <?php
                                  $sql = "SELECT c.ID as ConnID, a.FullName, a.Image, a.CurrentlyConnected FROM tblconnections c JOIN tblalumni a ON c.SenderID = a.ID WHERE c.ReceiverID=:alumniid AND c.Status='Pending'";
                                  $query = $dbh->prepare($sql);
                                  $query->execute(array(':alumniid'=>$alumniid));
                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                  
                                  if($query->rowCount() > 0) {
                                      foreach($results as $row) {
                                  ?>
                                  <div class="connection-card">
                                      <img loading="lazy" src="images/<?php echo htmlentities($row->Image); ?>" class="conn-img" onerror="this.src='../admin/images/layout_img/user_img.jpg'">
                                      <div class="conn-info">
                                          <div class="conn-name"><?php echo htmlentities($row->FullName); ?></div>
                                          <div class="conn-meta"><i class="fa fa-briefcase"></i> <?php echo htmlentities($row->CurrentlyConnected); ?></div>
                                      </div>
                                      <div class="conn-actions">
                                          <a href="my-connections.php?action=accept&id=<?php echo $row->ConnID; ?>" class="btn btn-success btn-sm">Accept</a>
                                          <a href="my-connections.php?action=reject&id=<?php echo $row->ConnID; ?>" class="btn btn-danger btn-sm">Reject</a>
                                      </div>
                                  </div>
                                  <?php 
                                      }
                                  } else {
                                      echo "<p>No pending requests.</p>";
                                  }
                                  ?>
                              </div>
                           </div>
                        </div>
                        
                        <!-- My Network -->
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>My Network (Accepted)</h2>
                                 </div>
                              </div>
                              <div class="padding_infor_info">
                                  <?php
                                  // Find accepted connections where I am sender or receiver
                                  $sql = "SELECT a.FullName, a.Image, a.Emailid, a.CurrentlyConnected 
                                          FROM tblconnections c 
                                          JOIN tblalumni a ON (c.SenderID = a.ID OR c.ReceiverID = a.ID)
                                          WHERE (c.SenderID=:alumniid OR c.ReceiverID=:alumniid) 
                                          AND c.Status='Accepted' 
                                          AND a.ID != :alumniid";
                                  $query = $dbh->prepare($sql);
                                  $query->execute(array(':alumniid'=>$alumniid));
                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                  
                                  if($query->rowCount() > 0) {
                                      foreach($results as $row) {
                                  ?>
                                  <div class="connection-card">
                                      <img loading="lazy" src="images/<?php echo htmlentities($row->Image); ?>" class="conn-img" onerror="this.src='../admin/images/layout_img/user_img.jpg'">
                                      <div class="conn-info">
                                          <div class="conn-name"><?php echo htmlentities($row->FullName); ?></div>
                                          <div class="conn-meta"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo htmlentities($row->Emailid); ?>"><?php echo htmlentities($row->Emailid); ?></a></div>
                                          <div class="conn-meta mt-1"><i class="fa fa-briefcase"></i> <?php echo htmlentities($row->CurrentlyConnected); ?></div>
                                      </div>
                                      <div class="conn-actions">
                                          <span class="badge badge-success px-3 py-2">Connected</span>
                                      </div>
                                  </div>
                                  <?php 
                                      }
                                  } else {
                                      echo "<p>You don't have any accepted connections yet. Go to the Alumni Directory to connect!</p>";
                                  }
                                  ?>
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
      <script src="../admin/js/animate.js"></script>
      <script src="../admin/js/bootstrap-select.js"></script>
      <script src="../admin/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <script src="../admin/js/custom.js"></script>
   </body>
</html>
<?php } ?>
