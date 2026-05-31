<link rel="stylesheet" type="text/css" href="styles/modern-frontend.css">
<style>
/* Ultra-Premium Nav Styles */
.header {
    position: sticky;
    top: 0;
    z-index: 9999;
    width: 100%;
}

/* Elegant Top Bar */
.top_bar {
    background: #0f172a !important; /* Deep Slate */
    height: 40px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.top_bar_contact_list li {
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    color: #cbd5e1 !important;
}
.top_bar_contact_list li i {
    color: #818cf8 !important;
    margin-right: 6px;
}
.social-icons a {
    color: #cbd5e1;
    margin-left: 15px;
    font-size: 14px;
    transition: color 0.3s;
}
.social-icons a:hover {
    color: #818cf8;
}

/* Glass Header */
.header_container {
    background: rgba(255, 255, 255, 0.92) !important;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
    transition: all 0.3s ease;
}
.header_content {
    height: 90px;
}

/* Gradient Logo */
.logo_container a {
    text-decoration: none;
}
.logo_text {
    font-size: 26px !important;
    letter-spacing: -0.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.logo-icon {
    font-size: 28px;
    background: linear-gradient(135deg, #6366f1, #14bdee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.logo_text span {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
}

/* Nav Links Animation */
.main_nav li {
    position: relative;
    padding: 0 10px;
}
.main_nav li a {
    font-family: 'Inter', sans-serif;
    font-weight: 600 !important;
    color: #334155 !important;
    font-size: 15px;
    padding: 10px 0;
    transition: color 0.3s ease;
}
.main_nav li a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    bottom: -5px;
    left: 50%;
    background: linear-gradient(90deg, #6366f1, #14bdee);
    transition: all 0.3s ease;
    border-radius: 4px;
    transform: translateX(-50%);
}
.main_nav li:hover a::after,
.main_nav li.active a::after {
    width: 80%;
}
.main_nav li:hover a {
    color: #6366f1 !important;
}

/* CTA Buttons */
.nav-actions {
    gap: 15px;
    margin-left: 30px;
}
.btn-nav-login {
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    color: #475569;
    padding: 8px 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    background: #fff;
}
.btn-nav-login:hover {
    color: #6366f1;
    border-color: #6366f1;
    background: rgba(99, 102, 241, 0.05);
}
.btn-nav-register {
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    color: #fff !important;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    padding: 10px 24px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
    transition: all 0.3s ease;
}
.btn-nav-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    color: #fff;
}
.admin-link {
    font-size: 12px;
    color: #94a3b8;
    margin-left: 10px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.admin-link:hover {
    color: #6366f1;
}
/* Mobile Menu Ultra-Premium Styling */
.menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 320px;
    height: 100vh;
    background: rgba(15, 23, 42, 0.98) !important;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: -10px 0 40px rgba(0,0,0,0.3);
    padding: 50px 30px;
    z-index: 10000;
    transition: all 0.4s ease;
    overflow-y: auto;
}
.menu.active {
    right: 0;
}
.menu_nav ul {
    list-style: none;
    padding: 0;
    margin-top: 40px;
}
.menu_nav ul li {
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding-bottom: 15px;
}
.menu_nav ul li a {
    font-family: 'Outfit', sans-serif;
    font-size: 22px !important;
    font-weight: 600 !important;
    color: #f8fafc !important;
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
}
.menu_nav ul li a:hover {
    color: #818cf8 !important;
    transform: translateX(-10px);
}
.menu_close_container {
    background: rgba(255, 255, 255, 0.1);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}
.menu_close_container:hover {
    background: rgba(239, 68, 68, 0.2);
}
.menu_close div {
    background: #fff !important;
    height: 2px;
    width: 20px;
    margin: 4px 0;
    border-radius: 2px;
}
.menu .logo_text {
    color: #fff !important;
    font-size: 28px !important;
    text-align: right;
}
.menu .logo_text span {
    color: #818cf8 !important;
}
.menu_nav ul li.mt-4 {
    border-bottom: none;
}
</style>

<header class="header">
      <!-- Header Content -->
      <div class="header_container">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="header_content d-flex flex-row align-items-center justify-content-between">
                     <!-- Logo -->
                     <div class="logo_container">
                        <a href="index.php">
                           <div class="logo_text"><i class="fa fa-graduation-cap logo-icon"></i> College <span>Alumni</span></div>
                        </a>
                     </div>
                     
                     <!-- Main Navigation -->
                     <nav class="main_nav_contaner ml-auto d-flex flex-row align-items-center">
                        <ul class="main_nav mr-4">
                           <li class="active"><a href="index.php">Home</a></li>
                           <li><a href="about.php">About</a></li>
                           <li><a href="events.php">Events</a></li>
                           <li><a href="gallery.php">Gallery</a></li>
                           <li><a href="job-lists.php">Jobs</a></li>
                           <li><a href="contact.php">Contact</a></li>
                        </ul>
                        
                        <!-- CTA & Login Buttons -->
                        <div class="nav-actions d-none d-lg-flex align-items-center">
                            <a href="alumni/login.php" class="btn-nav-login">Login</a>
                            <a href="alumni/registration.php" class="btn-nav-register">Register Now</a>
                            <a href="admin/login.php" class="admin-link">Admin</a>
                        </div>
                     
                        <!-- Hamburger -->
                        <div class="hamburger menu_mm ml-4">
                           <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                        </div>
                     </nav>

                  </div>
               </div>
            </div>
         </div>
      </div>
</header>

<!-- Mobile Menu -->
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="logo menu_mm">
        <a href="index.php"><div class="logo_text"><i class="fa fa-graduation-cap"></i> College <span>Alumni</span></div></a>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li class="menu_mm"><a href="index.php">Home</a></li>
            <li class="menu_mm"><a href="about.php">About</a></li>
            <li class="menu_mm"><a href="events.php">Events</a></li>
            <li class="menu_mm"><a href="gallery.php">Gallery</a></li>
            <li class="menu_mm"><a href="job-lists.php">Jobs</a></li>
            <li class="menu_mm"><a href="contact.php">Contact</a></li>
            <li class="menu_mm mt-4"><a href="alumni/login.php" style="color:#6366f1;">Alumni Login</a></li>
            <li class="menu_mm"><a href="alumni/registration.php" style="color:#6366f1;">Register Now</a></li>
            <li class="menu_mm mt-2"><a href="admin/login.php" style="color:#ef4444; font-size:18px !important;">Admin Login</a></li>
        </ul>
    </nav>
</div>