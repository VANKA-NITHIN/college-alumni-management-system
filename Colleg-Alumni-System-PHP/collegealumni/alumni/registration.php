<?php
session_start();
//error_reporting(0);
include('../admin/includes/dbconnection.php');

if(isset($_POST['signup']))
{

// Getting Post values
$fname=$_POST['fullname'];
$collegeid=$_POST['collegeid'];
$gender=$_POST['gender'];
$batch=$_POST['batch'];
$coursegrad=$_POST['coursegrad'];
$currentlyconnectedto=$_POST['currentlyconnectedto'];
$emailid=$_POST['emailid'];   
 
$password=md5($_POST['password']); 
$pic=$_FILES["pic"]["name"];
 $extension = substr($pic,strlen($pic)-4,strlen($pic));
 $allowed_extensions = array(".jpg","jpeg",".png",".gif");
 if(!in_array($extension,$allowed_extensions))
{
echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Pic has Invalid format. Only jpg / jpeg/ png /gif format allowed', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
}
else
{

$picnew=md5($pic).time().$extension;
 move_uploaded_file($_FILES["pic"]["tmp_name"],"images/".$picnew); 
 $ret="select Emailid,CollegeID from tblalumni where Emailid=:emailid || CollegeID=:collegeid";
 $query= $dbh -> prepare($ret);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':collegeid',$collegeid,PDO::PARAM_STR);
$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{

// query for data insertion
$sql="INSERT INTO tblalumni(FullName,CollegeID,Gender,Batch,CourseGraduated,CurrentlyConnected,Image,Emailid,Password) VALUES(:fname,:collegeid,:gender,:batch,:coursegrad,:currentlyconnectedto,:picnew,:emailid,:password)";
//preparing the query
$query = $dbh->prepare($sql);
//Binding the values
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':collegeid',$collegeid,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':batch',$batch,PDO::PARAM_STR);
$query->bindParam(':currentlyconnectedto',$currentlyconnectedto,PDO::PARAM_STR);
$query->bindParam(':coursegrad',$coursegrad,PDO::PARAM_STR);
$query->bindParam(':picnew',$picnew,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);

//Execute the query
$query->execute();
//Check that the insertion really worked
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Success : Alumni signup successfull. Now you can signin', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
echo "<script>window.location.href='login.php'</script>";  
}
else 
{
echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Error : Something went wrong. Please try again', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";   
}
}
else
{

echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({title: 'Notification', text: 'Email-id already exist. Please try again', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true}); });</script>";
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
    
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
      <title>College Alumni System || Alumni Registration Page</title>
     
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
                         <h2>Alumni Registration</h2>
                         <p>Create your profile to connect with fellow alumni.</p>
                      </div>
                      <form method="post" name="login" enctype="multipart/form-data">
                         <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="form_label">Fullname</label>
                               <input type="text" class="form-control form_input" placeholder="Enter your fullname" required="true" name="fullname">
                            </div>
                            <div class="form-group col-md-6">
                               <label class="form_label">College ID</label>
                               <input type="text" class="form-control form_input" placeholder="Enter college ID" required="true" name="collegeid">
                            </div>
                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="form_label">Gender</label>
                               <select class="form-control form_input" required="true" name="gender">
                                  <option value="">Select Gender</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                               </select>
                            </div>
                            <div class="form-group col-md-6">
                               <label class="form_label">Batch</label>
                               <input type="text" class="form-control form_input" placeholder="e.g. 2020-2024" required="true" name="batch">
                            </div>
                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="form_label">Course Graduated</label>
                               <select class="form-control form_input" required="true" name="coursegrad">
                                  <option value="">Select Course</option>
                                  <?php 
                                  $sql2 = "SELECT * from tblcourse";
                                  $query2 = $dbh->prepare($sql2);
                                  $query2->execute();
                                  $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                                  foreach($result2 as $row2) {          
                                  ?>  
                                  <option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->CourseName);?></option>
                                  <?php } ?>
                               </select>
                            </div>
                            <div class="form-group col-md-6">
                               <label class="form_label">Currently Connected To</label>
                               <input type="text" class="form-control form_input" placeholder="Company/Institution" required="true" name="currentlyconnectedto">
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="form_label">Profile Pic</label>
                            <input type="file" class="form-control form_input file_input" required="true" name="pic">
                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="form_label">Email</label>
                               <input type="email" class="form-control form_input" placeholder="Enter email address" required="true" name="emailid">
                            </div>
                            <div class="form-group col-md-6">
                               <label class="form_label">Password</label>
                               <input type="password" class="form-control form_input" placeholder="Create password" name="password" required="true">
                            </div>
                         </div>
                         <button class="main_bt btn_submit" name="signup" type="submit">Register</button>
                         <div class="form_footer">
                            <a class="forgot login_link" href="login.php"><i class="fa fa-sign-in"></i> Already registered? Signin</a>
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