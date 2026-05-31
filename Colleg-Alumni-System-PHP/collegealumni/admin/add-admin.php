<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (empty($_SESSION['casaid'])) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $AName=$_POST['adminname'];
    $UName=$_POST['username'];
    $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    
    // Check if username already exists
    $ret="select UserName from tbladmin where UserName=:uname";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':uname', $UName, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() == 0)
    {
        $sql="INSERT INTO tbladmin(AdminName,UserName,MobileNumber,Email,Password) VALUES(:adminname,:username,:mobilenumber,:email,:password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
        $query->bindParam(':username',$UName,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Admin created successfully.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
            echo "<script>window.location.href ='manage-admins.php'</script>";
        }
        else
        {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Something went wrong. Please try again.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
        }
    }
    else
    {
        echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Username already exists. Please try another one.', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || Add Admin</title>
      
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="style.css" />
      <link rel="stylesheet" href="css/responsive.css" />
      <link rel="stylesheet" href="css/colors.css" />
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <link rel="stylesheet" href="css/custom.css" />
      <link rel="stylesheet" href="css/responsive-overhaul.css" />
   </head>
   <body class="inner_page general_elements">
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
                              <h2>Add New Admin</h2>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row column8 graph">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Admin Details</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post">
                                                   <fieldset>
                                                      <div class="field">
                                                         <label class="label_field">Admin Name</label>
                                                         <input type="text" name="adminname" value="" class="form-control" required='true'>
                                                      </div>
                                                      <br>
                                                      <div class="field">
                                                         <label class="label_field">User Name</label>
                                                         <input type="text" name="username" value="" class="form-control" required="true">
                                                      </div>
                                                      <br>
                                                      <div class="field">
                                                         <label class="label_field">Mobile Number</label>
                                                         <input type="text" name="mobilenumber" value="" class="form-control" maxlength='10' required='true' pattern="[0-9]+">
                                                      </div>
                                                      <br>
                                                      <div class="field">
                                                         <label class="label_field">Email</label>
                                                         <input type="email" name="email" value="" class="form-control" required='true'>
                                                      </div>
                                                      <br>
                                                      <div class="field">
                                                         <label class="label_field">Password</label>
                                                         <input type="password" name="password" value="" class="form-control" required='true'>
                                                      </div>
                                                      <br>
                                                      <div class="field margin_0">
                                                         <label class="label_field hidden">hidden label</label>
                                                         <button class="main_bt" type="submit" name="submit" id="submit">Add Admin</button>
                                                      </div>
                                                   </fieldset>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
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
