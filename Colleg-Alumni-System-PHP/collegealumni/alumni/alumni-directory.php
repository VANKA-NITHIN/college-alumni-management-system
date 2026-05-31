<?php
session_start();
include('../admin/includes/dbconnection.php');
if (strlen($_SESSION['alumniid']==0)) {
  header('location:logout.php');
} else {

// Handle search filters
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$searchCourse = isset($_GET['searchCourse']) ? $_GET['searchCourse'] : '';

// Handle connection request
if(isset($_GET['connect'])) {
    $receiverId = $_GET['connect'];
    $senderId = $_SESSION['alumniid'];
    
    if($receiverId != $senderId) {
        $check = $dbh->prepare("SELECT ID FROM tblconnections WHERE (SenderID=:sid AND ReceiverID=:rid) OR (SenderID=:rid AND ReceiverID=:sid)");
        $check->execute(array(':sid'=>$senderId, ':rid'=>$receiverId));
        if($check->rowCount() == 0) {
            $sql = "INSERT INTO tblconnections(SenderID,ReceiverID,Status) VALUES(:sid,:rid,'Pending')";
            $query = $dbh->prepare($sql);
            $query->execute(array(':sid'=>$senderId, ':rid'=>$receiverId));
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Connection request sent successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
        } else {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Connection already exists or is pending.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
        }
    }
    echo "<script>window.location.href='alumni-directory.php'</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || Alumni Directory</title>
      
      <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
      <link rel="stylesheet" href="../admin/style.css" />
      <link rel="stylesheet" href="../admin/css/responsive.css" />
      <link rel="stylesheet" href="../admin/css/colors.css" />
      <link rel="stylesheet" href="../admin/css/bootstrap-select.css" />
      <link rel="stylesheet" href="../admin/css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="../admin/css/custom.css" />
      <link rel="stylesheet" href="../admin/css/responsive-overhaul.css" />
      
      <style>
          /* Premium Glassmorphism Card Styling for Directory */
          .alumni-card {
              background: rgba(255, 255, 255, 0.85);
              backdrop-filter: blur(10px);
              -webkit-backdrop-filter: blur(10px);
              border: 1px solid rgba(255, 255, 255, 0.3);
              border-radius: 16px;
              padding: 24px;
              box-shadow: 0 8px 32px rgba(31, 38, 135, 0.07);
              transition: transform 0.3s ease, box-shadow 0.3s ease;
              margin-bottom: 30px;
              text-align: center;
              height: 100%;
              display: flex;
              flex-direction: column;
              align-items: center;
          }
          .alumni-card:hover {
              transform: translateY(-5px);
              box-shadow: 0 12px 40px rgba(31, 38, 135, 0.12);
          }
          .alumni-img-wrapper {
              width: 100px;
              height: 100px;
              border-radius: 50%;
              padding: 4px;
              background: linear-gradient(135deg, #14bdee, #6366f1);
              margin-bottom: 15px;
          }
          .alumni-img-wrapper img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              border-radius: 50%;
              border: 3px solid #fff;
          }
          .alumni-name {
              font-size: 18px;
              font-weight: 700;
              color: #2c3e50;
              margin-bottom: 5px;
          }
          .alumni-batch {
              font-size: 12px;
              background: rgba(99, 102, 241, 0.1);
              color: #6366f1;
              padding: 4px 10px;
              border-radius: 20px;
              font-weight: 600;
              margin-bottom: 12px;
              display: inline-block;
          }
          .alumni-details {
              font-size: 13px;
              color: #64748b;
              margin-bottom: 8px;
              line-height: 1.5;
          }
          .alumni-details i {
              width: 16px;
              color: #14bdee;
              margin-right: 5px;
          }
          
          /* Search Bar Styling */
          .directory-search {
              background: #fff;
              padding: 20px;
              border-radius: 12px;
              box-shadow: 0 4px 15px rgba(0,0,0,0.03);
              margin-bottom: 30px;
          }
          .directory-search .form-control {
              border-radius: 8px;
              border: 1px solid #e2e8f0;
          }
          .directory-search .btn {
              border-radius: 8px;
              padding: 10px 24px;
              font-weight: 600;
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
                              <h2>Alumni Directory</h2>
                           </div>
                        </div>
                     </div>
                     
                     <!-- Search Filter -->
                     <div class="row">
                         <div class="col-md-12">
                             <div class="directory-search">
                                 <form method="GET" action="alumni-directory.php" class="row">
                                     <div class="col-md-4 mb-3 mb-md-0">
                                         <input type="text" name="searchName" class="form-control" placeholder="Search by name..." value="<?php echo htmlentities($searchName); ?>">
                                     </div>
                                     <div class="col-md-4 mb-3 mb-md-0">
                                         <select name="searchCourse" class="form-control">
                                             <option value="">All Courses</option>
                                             <?php
                                             $cSql = "SELECT * FROM tblcourse";
                                             $cQuery = $dbh->prepare($cSql);
                                             $cQuery->execute();
                                             $cResults = $cQuery->fetchAll(PDO::FETCH_OBJ);
                                             if($cQuery->rowCount() > 0) {
                                                 foreach($cResults as $cRow) {
                                                     $selected = ($searchCourse == $cRow->ID) ? 'selected' : '';
                                                     echo "<option value='".$cRow->ID."' ".$selected.">".$cRow->CourseName."</option>";
                                                 }
                                             }
                                             ?>
                                         </select>
                                     </div>
                                     <div class="col-md-4">
                                         <button type="submit" class="btn btn-primary w-100">Search</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>

                     <!-- Directory Grid -->
                     <div class="row">
                        <?php 
                        // Build query dynamically based on search
                        $sql = "SELECT tblalumni.*, tblcourse.CourseName FROM tblalumni 
                                JOIN tblcourse ON tblalumni.CourseGraduated = tblcourse.ID 
                                WHERE 1=1";
                        
                        $params = array();
                        
                        if(!empty($searchName)) {
                            $sql .= " AND tblalumni.FullName LIKE :name";
                            $params[':name'] = "%".$searchName."%";
                        }
                        
                        if(!empty($searchCourse)) {
                            $sql .= " AND tblalumni.CourseGraduated = :course";
                            $params[':course'] = $searchCourse;
                        }
                        
                        $sql .= " ORDER BY tblalumni.FullName ASC";
                        
                        $query = $dbh->prepare($sql);
                        
                        foreach($params as $key => &$val) {
                            $query->bindParam($key, $val);
                        }
                        
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if($query->rowCount() > 0) {
                            foreach($results as $row) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="alumni-card">
                                <div class="alumni-img-wrapper">
                                    <img loading="lazy" src="images/<?php echo htmlentities($row->Image); ?>" alt="<?php echo htmlentities($row->FullName); ?>" onerror="this.src='../admin/images/layout_img/user_img.jpg'">
                                </div>
                                <div class="alumni-name"><?php echo htmlentities($row->FullName); ?></div>
                                <div class="alumni-batch">Batch: <?php echo htmlentities($row->Batch); ?></div>
                                
                                <div class="alumni-details text-left w-100 mt-2">
                                    <div><i class="fa fa-graduation-cap"></i> <?php echo htmlentities($row->CourseName); ?></div>
                                    <div class="mt-1"><i class="fa fa-briefcase"></i> <?php echo htmlentities($row->CurrentlyConnected); ?></div>
                                </div>
                                <?php if($row->ID != $_SESSION['alumniid']) { ?>
                                    <a href="alumni-directory.php?connect=<?php echo htmlentities($row->ID); ?>" class="btn btn-outline-primary btn-sm mt-3 w-100" style="border-radius:20px; font-weight:600;">Connect</a>
                                <?php } else { ?>
                                    <button class="btn btn-secondary btn-sm mt-3 w-100" style="border-radius:20px; font-weight:600;" disabled>You</button>
                                <?php } ?>
                            </div>
                        </div>
                        <?php 
                            } 
                        } else {
                            echo '<div class="col-12"><div class="alert alert-warning text-center">No alumni found matching your criteria.</div></div>';
                        }
                        ?>
                     </div>
                     
                  </div>
                  <!-- footer -->
                  <?php include_once('includes/footer.php');?>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
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
