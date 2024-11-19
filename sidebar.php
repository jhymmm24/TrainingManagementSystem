
<style>

.sidebar-nav .nav-content span {
    color: white;
    font-size: 16px;
}


</style>


<?php





// function isActivePage($pageNames)
// {
//     $currentPage = basename($_SERVER['PHP_SELF']);
//     $currentPageURL = $_SERVER['REQUEST_URI'];
    
//     if (is_array($pageNames)) {
//         foreach ($pageNames as $pageName) {
//             if ($currentPage == $pageName || strpos($currentPageURL, $pageName) !== false) {
//                 return true;
//             }
//         }
//     } else {
//         if ($currentPage == $pageNames || strpos($currentPageURL, $pageNames) !== false) {
//             return true;
//         }
//     }
//     return false;
// }

function isActivePage($pageNames)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    $currentPageURL = $_SERVER['REQUEST_URI'];

    if (is_array($pageNames)) {
        foreach ($pageNames as $pageName) {
            if ($currentPage == $pageName || basename(parse_url($currentPageURL, PHP_URL_PATH)) == $pageName) {
                return true;
            }
        }
    } else {
        if ($currentPage == $pageNames || basename(parse_url($currentPageURL, PHP_URL_PATH)) == $pageNames) {
            return true;
        }
    }
    return false;
}


function checkuser_category(){

    if($category !=='User'){

   
    }
}

?>

<aside id="sidebar" class="sidebar">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<ul class="sidebar-nav" id="sidebar-nav">
  
<li class="nav-item">
    <a class="nav-link <?php echo isActivePage('index.php') ? 'active' : 'collapsed'; ?>" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>

  


<?php if ($category !== 'User'): // Hide this section for users with 'User' category ?>
<li class="nav-item">
    <a class="nav-link <?php echo isActivePage(['pcba_enlistment.php','companyfundamentals.php','commonbusinessskills.php','technicalstandard.php','mgtgroupregulation.php','workstandard.php','qualityanalysis.php','commontraining.php','hashira.php','technicalstandard.php','othertrainings.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#components-nav">
        <i class="bi bi-menu-button-wide"></i><span>Enlistments</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="components-nav" class="collapse <?php echo isActivePage(['pcba_enlistment.php','companyfundamentals.php','commonbusinessskills.php','mgtgroupregulation.php','workstandard.php','qualityanalysis.php','commontraining.php', 'hashira.php', 'technicalstandard.php','othertrainings.php']) ? 'show' : ''; ?>">
        <ul class="nav-content">

        
          <?php if ($section == 'PCBA') : ?>
            <li>
                <a href="pcba_enlistment.php" class="<?php echo isActivePage('pcba_enlistment.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>PCBA | Hashira</span>
                </a>
            </li>
        <?php endif; ?>
                

            <li>
                <a href="qualityanalysis.php" class="<?php echo isActivePage('qualityanalysis.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Quality Analysis</span>
                </a>
            </li>
       
            <li>
                <a href="workstandard.php" class="<?php echo isActivePage('workstandard.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Work Standard</span>
                </a>
            </li>
            <li>
                <a href="mgtgroupregulation.php" class="<?php echo isActivePage('mgtgroupregulation.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Mgt Group Regulation</span>
                </a>
            </li>
            <li>
                <a href="commontraining.php" class="<?php echo isActivePage('commontraining.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Common Training</span>
                </a>
            </li>
            <li>
                <a href="hashira.php" class="<?php echo isActivePage('hashira.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Production Hashira</span>
                </a>
            </li>
            <li>
                <a href="technicalstandard.php" class="<?php echo isActivePage('technicalstandard.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Technical Standard</span>
                </a>
            </li>

            <li>
                <a href="commonbusinessskills.php" class="<?php echo isActivePage('commonbusinessskills.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Common Business Skills</span>
                </a>
            </li>

            <li>
                <a href="companyfundamentals.php" class="<?php echo isActivePage('companyfundamentals.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Company Fundamentals</span>
                </a>
            </li>
         
        </ul>
    </div>
</li><!-- End Components Nav -->
<?php endif; ?>

<?php if ($category !== 'User'): // Hide this section for users with 'User' category ?>
<li class="nav-item">
    <a class="nav-link <?php echo isActivePage(['trainingrequest.php','requestapproval.php','requeststatus.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#trainingapplication-nav">
        <i class="bi bi-journal-text"></i><span>Training Application</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <div id="trainingapplication-nav" class="collapse <?php echo isActivePage(['trainingrequest.php', 'requestapproval.php', 'requeststatus.php']) ? 'show' : ''; ?>">
        <ul class="nav-content">
            <li>
                <a href="trainingrequest.php" class="<?php echo isActivePage('trainingrequest.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Training Request</span>
                </a>
            </li>
            <?php if(($category === 'SUPERADMIN' ||$category === 'Admin' || $position === 'Supervisor' || $position === 'Junior Supervisor' || $position === 'Senior Supervisor' || $position ==='Manager' || $position ==='Senior Manager'  || $position ==='Assistant Manager' || $position ==='Adviser' ) || ( $fullname ==='Jill Therese Garcia' || $fullname ==='Jill Therese Garcia' || $fullname ==='Jayvee Hernandez' || $fullname ==='Agustina Andres' || $fullname ==='Jane Balais' || $fullname ==='Bradly Mateo')): ?>
                    <li>
                        <a href="requestapproval.php" class="<?php echo isActivePage('requestapproval.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Request Approval</span>
                        </a>
                    </li>
            <?php endif; ?>


                <a href="requeststatus.php" class="<?php echo isActivePage('requeststatus.php') ? 'active' : ''; ?>">
                    <i class="bi bi-circle"></i><span>Request Status</span>
                </a>
            </li>
        </ul>
    </div>
</li><!-- End trainingapplication Nav -->
<?php endif; ?>



        <li class="nav-item">
            <a class="nav-link <?php echo isActivePage(['tapping.php','monitoring.php', 'exam.php', 'questionnaire.php','examination.php','topic_setting.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#elearning-nav" >
                <i class="bi bi-layout-text-window-reverse"></i><span>E-Learning</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="elearning-nav" class="collapse <?php echo isActivePage(['tapping.php','monitoring.php', 'exam.php', 'questionnaire.php','examination.php','topic_setting.php']) ? 'show' : ''; ?>">
                <ul class="nav-content">

                <?php if ($category !== 'User' && $category !== 'Section Training PIC' ): // Hide this section for users with 'User' category ?>
                     <li>
                        <a href="topic_setting.php" class="<?php echo isActivePage('topic_setting.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Topic Setting</span>
                        </a>
                    </li>
                    <?php endif; ?>


                <?php if ($category !== 'User'):?>
                    <li>
                        <a href="monitoring.php" class="<?php echo isActivePage('monitoring.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Monitoring</span>
                        </a>
                    </li>
                <?php endif; ?>
         
                    <li>
                        <a href="exam.php" class="<?php echo isActivePage(['exam.php','examination.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>E-Learning Examination</span>
                        </a>
                    </li>
                 

                <?php if ($category !== 'User' && $category !== 'Section Training PIC' ): // Hide this section for users with 'User' category ?>
                    <li>
                        <a href="questionnaire.php"  class="<?php echo isActivePage('questionnaire.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Uploading of E-Learning</span>
                        </a>
                    </li>
                <?php endif; ?>

                    <li>
                        <a href="tapping.php"  class="<?php echo isActivePage('tapping.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>ID Tapping</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li><!-- End elearning Nav -->


        <?php if ($category !== 'User'): // Hide this section for users with 'User' category ?>
        <li class="nav-item">
            <a class="nav-link <?php echo isActivePage(['newstaff_scoring.php','trainingresult-newstaff.php','attendee_status.php','training-scoreboard.php','trainingresult.php', 'trainingresult-soldering.php', 'trainingresult-prodbasic.php','scoring_qualityanalysis.php','scoring_workstandard.php','scoring_prodhashira.php','scoring_commontraining.php','trainingresult-soldering.php','soldering_scoring.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#trainingresults-nav">
                <i class="bi bi-bar-chart"></i><span>Training Result</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="trainingresults-nav" class="collapse<?php echo isActivePage(['newstaff_scoring.php','trainingresult-newstaff.php','attendee_status.php','training-scoreboard.php','trainingresult.php', 'trainingresult-soldering.php', 'trainingresult-prodbasic.php','scoring_qualityanalysis.php','scoring_workstandard.php','scoring_mgtgroupregulation.php','scoring_commontraining.php','scoring_prodhashira.php','trainingresult-soldering.php','soldering_scoring.php']) ? 'show' : ''; ?>">
                <ul class="nav-content">
                    <li>
                        <a href="trainingresult.php" class="<?php echo isActivePage('trainingresult.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Training Result Summary</span>
                        </a>
                    </li>
                    <li>
                        <a href="training-scoreboard.php" class="<?php echo isActivePage(['training-scoreboard.php','scoring_qualityanalysis.php','scoring_workstandard.php','scoring_mgtgroupregulation.php','scoring_commontraining.php','scoring_prodhashira.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Training Scoreboard</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="attendee_status.php"class="<?php echo isActivePage('attendee_status.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Attendee Status</span>
                        </a>
                    </li> -->
                   

                    <li>
                        <a href="trainingresult-newstaff.php" class="<?php echo isActivePage(['newstaff_scoring.php','trainingresult-newstaff.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>New Staff Training</span>
                        </a>
                    </li>
                    <li>
                        <a href="trainingresult-soldering.php" class="<?php echo isActivePage(['trainingresult-soldering.php','soldering_scoring.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Soldering</span>
                        </a>
                    </li>
                    <li>
                        <a href="trainingresult-prodbasic.php" class="<?php echo isActivePage('trainingresult-prodbasic.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Prod Basic Skill</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li><!-- End trainingresults result  -->
        <?php endif; ?>

        <?php if ($category !== 'User'): // Hide this section for users with 'User' category ?>
        <li class="nav-item">
            <a class="nav-link <?php echo isActivePage(['skillmap_companyfundamentals.php','skillmap_commonbusinessskills.php','section_employeelist.php','skillmap_summary.php','skillmap.php', 'skillmap.php','skillmap_upload.php','skillmap_prodhash.php','skillmap_techstandard.php','skillmap_workstandard.php','skillmap_cmntraining.php','skillmap_mgtgroupregulation.php','skillmap_qualityanalysis.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#peskillmap-nav">
                <i class="bi bi-person"></i><span>Section Skill Map</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="peskillmap-nav" class="collapse<?php echo isActivePage(['skillmap_companyfundamentals.php','skillmap_commonbusinessskills.php','section_employeelist.php','skillmap_summary.php','skillmap.php', 'skillmap.php','skillmap_upload.php','skillmap_prodhash.php','skillmap_techstandard.php','skillmap_workstandard.php','skillmap_cmntraining.php','skillmap_mgtgroupregulation.php','skillmap_qualityanalysis.php']) ? 'show' : ''; ?>">
                <ul class="nav-content">
                    <li>
                        <a href="skillmap.php" class="<?php echo isActivePage(['skillmap_companyfundamentals.php','skillmap_commonbusinessskills.php','skillmap.php', 'skillmap.php','skillmap_prodhash.php','skillmap_techstandard.php','skillmap_workstandard.php','skillmap_cmntraining.php','skillmap_mgtgroupregulation.php','skillmap_qualityanalysis.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Topic Skill Map</span>
                        </a>
                    </li>

                    <li>
                        <a href="skillmap_summary.php" class="<?php echo isActivePage(['skillmap_summary.php']) ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Skill Map Summary</span>
                        </a>
                    </li>
                 
                 
                    </li>
                    <li>
                        <a href="skillmap_upload.php" class="<?php echo isActivePage('skillmap_upload.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Skill Map Upload</span>
                        </a>
                    </li>

                    <li>
                        <a href="  section_employeelist.php" class="<?php echo isActivePage('section_employeelist.php') ? 'active' : ''; ?>">
                            <i class="bi bi-circle"></i><span>Section Employee List</span>
                        </a>
                    </li>



                  
                   
                </ul>
            </div>
        </li><!-- End peskillmap   -->
        <?php endif; ?>

        <!-- Add other list items for different sections -->

     <!-- Other sidebar items... -->

     <?php if ($section == "PE"): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo isActivePage(['sectiontraining-pbs.php', 'sectiontraining-soldering.php','sectiontraining-internal.php']) ? 'active' : 'collapsed'; ?>" data-bs-toggle="collapse" href="#section-nav">
                    <i class="bi bi-people-fill"></i><span>PE Section Training</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div id="section-nav" class="collapse<?php echo isActivePage(['sectiontraining-pbs.php', 'sectiontraining-soldering.php','sectiontraining-internal.php']) ? 'show' : ''; ?>">
                    <ul class="nav-content">
                        <li>
                            <a href="sectiontraining-pbs.php"  class="<?php echo isActivePage('sectiontraining-pbs.php') ? 'active' : ''; ?>">
                                <i class="bi bi-circle"></i><span>Prod. Basic Skill Training</span>
                            </a>
                        </li>
                        <li>
                            <a href="sectiontraining-soldering.php" class="<?php echo isActivePage('sectiontraining-soldering.php') ? 'active' : ''; ?>">
                                <i class="bi bi-circle"></i><span>Soldering</span>
                            </a>
                        </li>
                        <li>
                            <a href="sectiontraining-internal.php" class="<?php echo isActivePage('sectiontraining-internal.php') ? 'active' : ''; ?>">
                                <i class="bi bi-circle"></i><span>Section Internal Training</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li><!-- End peskillmap   -->
        <?php endif; ?>

        <!-- Other sidebar items... -->
        <?php if ($category !== 'User' && $category !== 'Section Training PIC'  && $category !== 'Approver' ): // Hide this section for users with 'User' category ?>
                <li class="nav-item">
                <a class="nav-link <?php echo isActivePage('masterlist.php') ? 'active' : 'collapsed'; ?>" href="masterlist.php">
                <i class="bi bi-card-checklist"></i>
                <span>Masterlist</span>
                </a>
            </li><!-- End Contact Page Nav -->
        <?php endif; ?>

        <?php if ($category !== 'User' && $category !== 'Section Training PIC' && $category !== 'Approver' ): // Hide this section for users with 'User' category ?>
      <li class="nav-item">
        <a class="nav-link <?php echo isActivePage('adminmodule.php') ? 'active' : 'collapsed'; ?>" href="adminmodule.php">
          <i class="bi bi-card-checklist"></i>
          <span>Admin Module</span>
        </a>
      </li><!-- End Contact Page Nav -->
      <?php endif; ?>

      <?php if ($fullname == "John Michael Macaraig"): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo isActivePage('admin.php') ? 'active' : 'collapsed'; ?>" href="admin.php">
          <i class="bi bi-person-lock"></i>
          <span>Admin</span>
        </a>
      </li>
      <?php endif; ?>


    
      <li class="nav-item">
        <a class="nav-link collapsed" href="login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->


        <!-- Add other list items for different s.ections -->

    </ul>
</aside><!-- End Sidebar-->

