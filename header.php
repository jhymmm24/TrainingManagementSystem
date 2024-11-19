
<style>

.logo3d {
            padding-top: 200px;
            width: 250px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
  }

.header{
   background-color: #cca175; 
   background-image: linear-gradient(-180deg, #cca175 0%, #B88A4D 100%);

  box-sizing: border-box;
  color: #FFFFFF;
  display: flex;
  font-size: 16px;
  justify-content: center;
  padding: 1rem 1.75rem;
  text-decoration: none;
  width: 100%;
  border: 0;
 
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
 
  /* background: url("assets/img/headerimage.jpg") ; */

}

body{
  


  background-image: url('assets/img/blackboard.jpg');
   
    background-size: auto; 
  background-repeat: repeat; 
  
}

</style>



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
    <a href="index.php">
  <img src="assets/img/TMSRESIZEENGRAVED.png" alt="Your Logo"  class="logo3d" draggable="false" style="margin-top:-10px;">
        </a>
    </div><!-- End Logo -->


    
    <div class="row">         
     <div class="align-items-center justify-content-between text-align: center;">
        <span id="datetime" style="font-size: 12px; position:absolute; " ></span> 
    </div>
    </div>

    <h8 id="pe">BIPH - PRODUCTION ENGINEERING</h8>

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/userlogo.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $fullname?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $fullname?></h6>
              <span><?php echo $section?></span> 
              <span><?php echo $position?> </span>
              <span>|</span>
              <span><?php echo $category?></span>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="userprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
        

           
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->