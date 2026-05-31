<?php
session_start();
error_reporting(0);
include('../admin/includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $emailid=$_POST['emailid'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tblalumni WHERE Emailid=:emailid and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':emailid', $emailid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['alumniid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for emailid
setcookie ("user_login",$_POST["emailid"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Invalid Details', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
    
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || Alumni Login Page</title>
     
      <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="../admin/style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="../admin/css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="../admin/css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="../admin/css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="../admin/css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="../admin/css/custom.css" />
      <link rel="stylesheet" href="../admin/css/responsive-overhaul.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="../admin/js/semantic.min.css" />
   
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
             <div class="center verticle_center full_height">
                <div class="login_section">
                   <div class="login_form">
                      <div class="form_title_container">
                         <h2>Alumni Login</h2>
                         <p>Access your professional alumni network portal.</p>
                      </div>
                      <form method="post" name="login">
                         <div class="form-group">
                            <label class="form_label">Email ID</label>
                            <input type="text" class="form-control form_input" placeholder="Enter your email id" required="true" name="emailid" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
                         </div>
                         <div class="form-group">
                            <label class="form_label">Password</label>
                            <input type="password" class="form-control form_input" placeholder="Enter your password" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                         </div>
                         <div class="form_row">
                            <label class="form-check-label"><input class="form-check-input" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> type="checkbox"/> Remember Me</label>
                            <a class="forgot" href="forgot-password.php">Forgot Password?</a>
                         </div>
                         <button class="main_bt btn_submit" name="login" type="submit">Login</button>
                         <div class="form_footer">
                            <a class="forgot home_link" href="../index.php"><i class="fa fa-home"></i> Back to Home</a>
                            <span class="divider">|</span>
                            <a class="forgot register_link" href="registration.php"><i class="fa fa-user-plus"></i> Register</a>
                         </div>
                      </form>
                   </div>
                </div>
             </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="../admin/js/jquery.min.js"></script>
      <script src="../admin/js/popper.min.js"></script>
      <script src="../admin/js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="../admin/js/animate.js"></script>
      <!-- select country -->
      <script src="../admin/js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="../admin/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="../admin/js/custom.js"></script>
   </body>
</html>