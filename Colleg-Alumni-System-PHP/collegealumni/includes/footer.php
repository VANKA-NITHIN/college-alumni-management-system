<style>
/* Premium Footer Styling */
.footer {
    background: #0f172a !important; /* Deep Slate */
    position: relative;
    padding-top: 60px;
    padding-bottom: 20px;
    color: #cbd5e1 !important;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.footer_background {
    display: none !important; /* Hide the old noisy background image */
}
.footer_logo_text {
    font-family: 'Outfit', sans-serif;
    font-size: 26px !important;
    font-weight: 700;
    color: #fff !important;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}
.footer_logo_text span {
    color: #818cf8 !important;
}
.footer_title {
    font-family: 'Outfit', sans-serif;
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}
.footer_title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    background: #6366f1;
    border-radius: 2px;
}
.footer_about_text p, .footer_contact_info ul li {
    color: #94a3b8;
    font-size: 15px;
    line-height: 1.8;
}
.footer_contact_info ul {
    list-style: none;
    padding: 0;
}
.footer_contact_info ul li {
    margin-bottom: 12px;
}
.footer_links_container ul {
    list-style: none;
    padding: 0;
}
.footer_links_container ul li {
    margin-bottom: 12px;
}
.footer_links_container ul li a {
    color: #94a3b8;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}
.footer_links_container ul li a:hover {
    color: #818cf8;
    transform: translateX(5px);
}
.footer_social ul {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 15px;
    margin-top: 25px;
}
.footer_social ul li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    color: #e2e8f0;
    font-size: 16px;
    transition: all 0.3s ease;
}
.footer_social ul li a:hover {
    background: #6366f1;
    color: #fff;
    transform: translateY(-3px);
}
.copyright_row {
    margin-top: 50px;
    padding-top: 25px;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.cr_text {
    color: #64748b;
    font-size: 14px;
    width: 100%;
    text-align: center;
}
.cr_text a { color: #64748b; text-decoration:none; }

/* Mobile Responsiveness */
@media (max-width: 991px) {
    .footer_col {
        margin-bottom: 45px;
        text-align: center;
    }
    .footer_title::after {
        left: 50%;
        transform: translateX(-50%);
    }
    .footer_social ul {
        justify-content: center;
    }
}
</style>
<footer class="footer">
      <div class="footer_background" style="background-image:url(images/footer_background.png)"></div>
      <div class="container">
         <div class="row footer_row">
            <div class="col">
               <div class="footer_content">
                  <div class="row">

                     <div class="col-lg-4 footer_col">
               
                        <!-- Footer About -->
                        <div class="footer_section footer_about">
                           <div class="footer_logo_container">
                              <a href="#">
                                 <div class="footer_logo_text">College <span>Alumni S/Y</span></div>
                              </a>
                           </div>
                           <div class="footer_about_text">
                              <p>Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</p>
                           </div>
                           <div class="footer_social">
                              <ul>
                                 <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                 <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                 <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                 <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                              </ul>
                           </div>
                        </div>
                        
                     </div>

                     <div class="col-lg-4 footer_col">
               
                        <!-- Footer Contact -->
                        <div class="footer_section footer_contact">
                           <div class="footer_title">Contact Us</div>
                           <div class="footer_contact_info">
                              <ul>
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
                                 <li>Email: <?php  echo htmlentities($row->Email);?></li>
                                 <li>Phone:  +<?php  echo htmlentities($row->MobileNumber);?></li>
                                 <li><?php  echo htmlentities($row->PageDescription);?></li><?php $cnt=$cnt+1;}} ?>
                              </ul>
                           </div>
                        </div>
                        
                     </div>

                     <div class="col-lg-4 footer_col">
               
                        <!-- Footer links -->
                        <div class="footer_section footer_links">
                           <div class="footer_title">Quick Links</div>
                           <div class="footer_links_container">
                              <ul>
                                 <li><a href="index.php">Home</a></li>
                           <li><a href="about.php">About</a></li>
                        
                           <li><a href="contact.php">Contact</a></li>
                           <li><a href="alumni/login.php">Alumni</a></li>
                           <li><a href="admin/login.php">Admin</a></li>
                              </ul>
                           </div>
                        </div>
                        
                     </div>

                    

                  </div>
               </div>
            </div>
         </div>

         <div class="row copyright_row">
            <div class="col">
               <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                  <div class="cr_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> College Alumni System 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- SweetAlert2 CDN for Toast Notifications -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>