<!DOCTYPE html>
<html lang="en">

<?php

session_start();
if(!isset($_SESSION['TMSuser_id'])) {
  ?>
      <script>
          alert("Must Login first");
          window.location = "login.php";
      </script>
  <?php
 }


include 'Connection/connection.php';
include 'forms/overall.php';



?>


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Training Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/tmscrop.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<!-- Date Time Picker  -->

<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/>
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
.sidebar{

/* background: url("assets/img/sidebarimage.jpg") ; */
background: url("assets/img/wood.jpg") ;

background-size: 500px 1000000px;
}


#datetime{
    position:absolute;
    left: 60%;
    top: 80%;
    transform: translate(-50%, -50%)
}
#pe{
    position:absolute;
    left: 60%;
    top: 30%;
    transform: translate(-50%, -50%)
}

.card{
       
        border-style: solid;
        border-color: #B45309;
    }

.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 17px;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}
table tr:hover td {
  background-color: #C6F1F8;
}

iframe{
                display: block;       /* iframes are inline by default */
                background: #000;
                border: none;         /* Reset default border */
                height: 50vh;        /* Viewport-relative units */
                width: 78vw;
                        
             }
             .button-cus1{
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border-radius: 6px;
                border: 2px solid #33691E;
                color: BLACK;
                background: 0 0;
                padding: 8px;
                box-shadow: rgba(0, 0, 0, 0.07) 0px 2px 4px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1.5px 0px;
                font-weight: 800;
                font-size: 16px;
                height: 42px;
                width: 200px;
    }
    .button-cus1:hover{
                    background-color: #C0FFC0;
                    color: BLACK;
                }

                .button-cus2{
    display: inline-block;
                outline: 0;
                cursor: pointer;
                border-radius: 6px;
                border: 2px solid #46B3E5;
                color: BLACK;
                background: 0 0;
                padding: 8px;
                box-shadow: rgba(0, 0, 0, 0.07) 0px 2px 4px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1.5px 0px;
                font-weight: 800;
                font-size: 16px;
                height: 42px;
                width: 200px;
    }
    .button-cus2:hover{
                    background-color: #C1E5F6;
                    color: BLACK;
                }




</style>

<body>

  
<?php 
include 'header.php';
include 'sidebar.php';
?>


<main id="main" class="main">

<div class="pagetitle">
  <!-- <h1>Common Training</h1> -->
 
</div><!-- End Page Title -->


<div class="card">



            <div class="card-body">
            <?php 
             
             $elearningID = $_GET['elearningID'];
             $title = $_GET['title'];
             $employeeno= $_GET['employeeno'];

             
             $get_data = "SELECT  * FROM [dbo].[tbl_elearningstatus] WHERE  [ElearningTransID] = '$elearningID' and EmployeeNumber = '$employeeno'";
             $stmt3 = sqlsrv_query($conn,$get_data);
                            while($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
                                $id = $row['ID'];
                                $elearningtitle = $row['Title'];
                                $targetemployee= $row['Target_Employee'];
                                $enddate = $row['End_Date'];
                                $targetdate = $row['Target_Date'];
                                $status = $row['Elearning_Status'];
                                $section = $row['Section'];
                                $employeenoTarget = $row['EmployeeNumber'];
                                $elearningtransid= $row['ElearningTransID'];
                                $requestnumber = $row['RequestNumber'];
                                $classification = $row['Classification'];
                              
                            }

             
             ?>
          
             <h5 class="card-title">Request Number: <?php echo $requestnumber ?></h5>
             <h4 >Elearning Classifciation: <?php echo $classification ?></h4>       
             <h8 >Elearning Title: <?php echo $title ?></h8>       
             
             
         

          
              <!-- Floating Labels Form -->

              
              <form class="row g-3">

              <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="employeeno" name="employeeno" placeholder="Employee Number" autocomplete="off">
                    <label for="floatingName">BIPH Employee Number :  <?php echo  $employeenoTarget?></label>
                  </div>
                </div>
               
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Name" autocomplete="off">
                    <label for="floatingName">Name: <?php echo $targetemployee?></label>
                  </div>
                  <br>
                </div>
               
         



             

            
            
                
         
              
       
              </form><!-- End floating Labels Form -->

            </div>
          </div>

          <div class="card" id="hidden-pdf" >
                <div class="card-body">
                    <h5 class="card-title">Powerpoint: <?php echo htmlspecialchars($elearningtitle); ?></h5>

                    <?php

                                            // Set headers to prevent automatic download
                                    
                    
                    $getPPT = "SELECT Distinct PDF FROM [dbo].[tbl_question] WHERE [Title] = '$title'";
                    $stmtppt = sqlsrv_query($conn, $getPPT);
                    
                    if ($stmtppt === false) {
                        die(print_r(sqlsrv_errors(), true)); // Check for SQL errors
                    }
                    
                    while ($row = sqlsrv_fetch_array($stmtppt, SQLSRV_FETCH_ASSOC)) {
                      
                      
                        $pdf = $row['PDF'];
                      
                     
                    }
               
                    $pdf_location = "uploaded_elearning/PDF/".$pdf; // Adjust path if necessary
                    

                    ?>


                    

                      
                        <iframe src="<?php echo htmlspecialchars($pdf_location); ?>" width="100%" height="500px" frameborder="0"></iframe>
                        <?php echo htmlspecialchars($pdf_location); ?> 
                   <br>

              
                   <div class="row">
    <div class="col-12" style="display: flex; justify-content: right; align-items: left;">
                    <button type="button" class="button-cus1 float-right mt-3" id="btn-next" role="button">
                Next <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
    </div>
</div>


                    
                </div>
             
            </div>


<!-- JavaScript -->
<script>
  // Wait for the DOM to be fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    // Get the next and back button elements
    const btnNext = document.getElementById('btn-next');
    const btnBack = document.getElementById('btn-back');

    // Get the hidden card and hidden pdf elements
    const hiddenCard = document.getElementById('hidden-card');
    const hiddenPdf = document.getElementById('hidden-pdf');

    // Check if elements are found
    if (btnNext && btnBack && hiddenCard && hiddenPdf) {
      // Add click event listener to the next button
      btnNext.addEventListener('click', function() {
        hiddenCard.style.display = 'block';
        hiddenPdf.style.display = 'none';
        btnNext.style.display = 'none';
        btnBack.style.display = 'block';
      });

      // Add click event listener to the back button
      btnBack.addEventListener('click', function() {
        hiddenCard.style.display = 'none';
        hiddenPdf.style.display = 'block';
        btnNext.style.display = 'block';
        btnBack.style.display = 'none';
      });
    } else {
      console.error('One or more elements (btnNext, btnBack, hiddenCard, hiddenPdf) not found.');
    }
  });
</script>




    <div class="card" id="hidden-card" style="display: none;">
            <div class="card-body" >
            <h5 class="card-title">Elearning Title: <?php echo $elearningtitle?></h5>

            <?php


            if($classification == 'QualityAnalysis'){


              $targetTable = '[dbo].[tbl_topic_LIST_qualityanalysis_MAINREQUEST]';

              $targetTableSkillMap = '[dbo].[tbl_topic_LIST_qualityanalysis]';
                  
                // Add topic-specific columns
                  if ($elearningtitle == 'Product Introduction') {
                    $topicSpecificColumns = 'Product_Introduction';
                } elseif ($elearningtitle == 'Quality Criteria (Defects)') {
                    $topicSpecificColumns = 'Quality_Criteria_Defects';
                } elseif ($elearningtitle == 'Basic Cassette Troubleshooting') {
                    $topicSpecificColumns = 'Basic_Cassette_Troubleshooting';
                }else{
                  echo 'Specific Column not set...';
                }


              }
              elseif($classification == 'WorkStandard'){

                $targetTable = '[dbo].[tbl_topic_LIST_workstandard_MAINREQUEST]';
                
                $targetTableSkillMap = '[dbo].[tbl_topic_LIST_workstandard]';
             
                  
                  // Add topic-specific columns
                  if ($elearningtitle == 'Work Standard for Preparing Process Control Charts') {
                    $topicSpecificColumns = 'Work_Standard_for_Preparing_Process_Control_Charts';
                } elseif ($elearningtitle == 'Work Standard for Analysis Techniques') {
                    $topicSpecificColumns = 'Work_Standard_for_Analysis_Techniques';
                } elseif ($elearningtitle == 'Standard for Intermediate_Materials Production Quantity Comparison') {
                    $topicSpecificColumns= 'Standard_for_Intermediate_Materials_Production_Quantity_Comparison';
                }elseif ($elearningtitle == 'Standard for Determining Standard Times for Assembly Processes') {
                    $topicSpecificColumns = 'Standard_for_Determining_Standard_Times_for_Assembly_Processes';
                }elseif ($elearningtitle == 'Work Standard for Jig Specification Preparation') {
                    $topicSpecificColumns = 'Work_Standard_for_Jig_Specification_Preparation';
                }elseif ($elearningtitle == 'Work Standard for Preparing Job Instruction Sheets') {
                    $topicSpecificColumns = 'Work Standard for Preparing Job Instruction Sheets';
                }elseif ($elearningtitle == 'Work Standard for Specification Kanban') {
                    $topicSpecificColumns = 'Work_Standard_for_Specification_Kanban';
                }elseif ($elearningtitle == 'Work Standard for Man-hour control') {
                    $topicSpecificColumns = 'Work_Standard_for_Man-hour_control';
                }elseif ($elearningtitle == 'Work Standard for Process Design') {
                    $topicSpecificColumns = 'Work_Standard_for_Process_Design';
                }elseif ($elearningtitle == 'Work Standard for Learning Curve and Line Establishment') {
                    $topicSpecificColumns = 'Work_Standard_for_Learning_Curve_and_Line_Establishment';
                }elseif ($elearningtitle == 'Work Standard for Prevention of Total_Defect') {
                    $topicSpecificColumns = 'Work_Standard_for_Prevention_of_Total_Defect';
                }elseif ($elearningtitle == 'Work Standard for Preparation of New Jig Models') {
                    $topicSpecificColumns = 'Work_Standard_for_Preparation_of_New_Jig_Models';
                }elseif ($elearningtitle == 'Work Standard for Assembly Lines') {
                    $topicSpecificColumns = 'Work_Standard_for_Assembly_Lines';
                }elseif ($elearningtitle == 'Work Standard for Training to Improve Abilities of Inspectors') {
                    $topicSpecificColumns = 'Work_Standard_for_Training_to_Improve_Abilities_of_Inspectors';
                }elseif ($elearningtitle == 'Work Standard for Container Inspection before Loading') {
                    $topicSpecificColumns = 'Work_Standard_for_Container_Inspection_before_Loading';
                }
                elseif ($elearningtitle == 'Work Standard for Part Distribution') {
                    $topicSpecificColumns = 'Work_Standard_for_Part_Distribution';
                }
                elseif ($elearningtitle == 'Work Standard for Warehouse Layout') {
                    $topicSpecificColumns = 'Work_Standard_for_Warehouse_Layout';
                }
                elseif ($elearningtitle == 'Work Standard for PS Processes') {
                    $topicSpecificColumns = 'Work_Standard_for_PS_Processes';
                }
                elseif ($elearningtitle == 'Work Standard for Parts Acceptance Inspection') {
                    $topicSpecificColumns = 'Work_Standard_for_Parts_Acceptance_Inspection';
                }
                elseif ($elearningtitle == 'Work Standard for Factory Efficiency Manhour_Management') {
                    $topicSpecificColumns = 'Work_Standard_for_Factory_Efficiency_Manhour_Management';
                }
                elseif ($elearningtitle == 'Work Standard for Direct and Indirect Operation Optimization Activities') {
                    $topicSpecificColumns = 'Work_Standard_for_Direct_and_Indirect_Operation_Optimization_Activities';
                }
                elseif ($elearningtitle == 'Work Standard for Factory Concurrency Progress') {
                    $topicSpecificColumns = 'Work_Standard_for_Factory_Concurrency_Progress';
                }
                elseif ($elearningtitle == 'Work Standard for Production Loss Debit Invoicing') {
                    $topicSpecificColumns = 'Work_Standard_for_Production_Loss_Debit_Invoicing';
                }
                elseif ($elearningtitle == 'Work Standard for Assembly Fixtures') {
                    $topicSpecificColumns = 'Work_Standard_for_Assembly_Fixtures';
                }
                elseif ($elearningtitle == 'Work Standard for Establishing New Models') {
                    $topicSpecificColumns = 'Work_Standard_for_Establishing_New_Models';
                }
                elseif ($elearningtitle == 'Work Standard for Handling Belt Conveyors') {
                    $topicSpecificColumns = 'Work_Standard_for_Handling_Belt_Conveyors';
                }


                echo $targetTable . '<br>';
                
                echo $topicSpecificColumns;


              }


              elseif($classification == 'MgtGroupRegulation'){

                $targetTable = '[dbo].[tbl_topic_LIST_mgtgroupregulation_MAINREQUEST]';

                $targetTableSkillMap = '[dbo].[tbl_topic_LIST_mgtgroupregulation]';


                            
                    // Add topic-specific columns
                    if ($elearningtitle == 'Measuring instruments management procedure') {
                      $topicSpecificColumns = 'Measuring_instruments_management_procedure';
                  }
                  elseif ($elearningtitle == 'Product Incident Handling Regulation') {
                      $topicSpecificColumns = 'Product_Incident_Handling_Regulation';
                  }
                  elseif ($elearningtitle == 'Parts Storage Regulations') {
                      $topicSpecificColumns = 'Parts_Storage_Regulations';
                  }
                  elseif ($elearningtitle == 'Regulations for process quality control') {
                      $topicSpecificColumns = 'Regulations_for_process_quality_control';
                  }
                  elseif ($elearningtitle == 'Procedure for quality-related failure costs indicator management') {
                      $topicSpecificColumns = 'Procedure_for_quality_related_failure_costs_indicator_management';
                  }
                  elseif ($elearningtitle == 'Regulation for Handling Critical Quality Problems') {
                      $topicSpecificColumns = 'Regulation_for_Handling_Critical_Quality_Problems';
                  }
                  elseif ($elearningtitle == 'Product Safety Rules') {
                      $topicSpecificColumns = 'Product_Safety_Rules';
                  }
                  elseif ($elearningtitle == 'Regulation for Quality Assurance') {
                      $topicSpecificColumns = 'Regulation_for_Quality_Assurance';
                  }
                  elseif ($elearningtitle == 'Regulation for production daily control management') {
                      $topicSpecificColumns = 'Regulation_for_production_daily_control_management';
                  }
                  else{
                      echo "Column not found in database...";
                  }
                
              }



              elseif($classification == 'CommonTraining'){


                $targetTable = '[dbo].[tbl_topic_LIST_commontraining_MAINREQUEST]';

                $targetTableSkillMap = '[dbo].[tbl_topic_LIST_commontraining]';


                  // Add topic-specific columns
                        if ($elearningtitle == 'Train the Trainers') {
                          $topicSpecificColumns = 'Train_the_Trainers';
                      }
                      elseif ($elearningtitle == 'IE Techniques') {
                          $topicSpecificColumns = 'IE_Techniques';
                      }
                      elseif ($elearningtitle == 'TWI -JR') {
                          $topicSpecificColumns = 'TWI_JR';
                      }
                      elseif ($elearningtitle == 'TWI -JR') {
                          $topicSpecificColumns = 'TWI_JI';
                      }
                      elseif ($elearningtitle == 'ISO90001 (QMS)') {
                          $topicSpecificColumns = 'ISO90001_QMS';
                      }
                      elseif ($elearningtitle == 'QCC Basic Knowledge (QC 7 Tools)') {
                          $topicSpecificColumns = 'QCC_Basic_Knowledge_QC_7_Tools';
                      }
                      elseif ($elearningtitle == 'Proposal Activity') {
                          $topicSpecificColumns = 'Proposal_Activity';
                      }
                      elseif ($elearningtitle == 'Excel Macro Training') {
                          $topicSpecificColumns = 'Excel_Macro_Training';
                      }
                      elseif ($elearningtitle == 'Safety Training') {
                          $topicSpecificColumns = 'Safety_Training';
                      }
                      elseif ($elearningtitle == 'Quality Education') {
                          $topicSpecificColumns = 'Quality_Education';
                      }
                      elseif ($elearningtitle == 'Fundamentals of Acceptance Sampling') {
                          $topicSpecificColumns = 'Fundamentals_of_Acceptance_Sampling';
                      }
                      elseif ($elearningtitle == 'Zero Defects Through Poka Yoke') {
                          $topicSpecificColumns = 'Zero_Defects_Through_Poka_Yoke';
                      }
                      elseif ($elearningtitle == 'Advanced Pull Manufacturing with Heijunka') {
                          $topicSpecificColumns = 'Advanced_Pull_Manufacturing_with_Heijunka';
                      }
                      elseif ($elearningtitle == 'Achieving High Results Through People') {
                          $topicSpecificColumns = 'Achieving_High_Results_Through_People';
                      }
                      else{
                          echo "Column not found in database...";
                      }





              
              }


              elseif($classification == 'ProdHashira'){

                $targetTable = '[dbo].[tbl_topic_LIST_hashira_MAINREQUEST]';

                $targetTableSkillMap = '[dbo].[tbl_topic_LIST_hashira]';

                                
                        // Add topic-specific columns
                        if ($elearningtitle == 'Observation Standard Operation') {
                          $topicSpecificColumns = 'ObservationStandardOperation';
                      }
                      elseif ($elearningtitle == 'Limit Sample') {
                          $topicSpecificColumns = 'LimitSample';
                      }
                      elseif ($elearningtitle == 'Quality Check Status by Supervisor') {
                          $topicSpecificColumns = 'QualityCheckStatusBySupervisor';
                      }
                      elseif ($elearningtitle == 'Assembly Basic Action Check Status by Supervisor') {
                          $topicSpecificColumns = 'AssemblyBasicActionCheckStatusBySupervisor';
                      }
                      elseif ($elearningtitle == 'Specification Change Work') {
                          $topicSpecificColumns = 'SpecificationChangeWork';
                      }
                      elseif ($elearningtitle == 'First In First Out') {
                          $topicSpecificColumns = 'FirstInFirstOut';
                      }
                      elseif ($elearningtitle == 'Maintain and control equipment, jig, tool and measuring instrument') {
                          $topicSpecificColumns = 'MaintainAndControlEquipmentJigToolAndMeasuringInstrument';
                      }
                      elseif ($elearningtitle == 'Maintain and control work environment') {
                          $topicSpecificColumns = 'MaintainAndControlWorkEnvironment';
                      }
                      elseif ($elearningtitle == 'Understanding Change point: Design Change') {
                          $topicSpecificColumns = 'UnderstandingChangePointDesignChange';
                      }
                      elseif ($elearningtitle == 'Understanding Change point: Man') {
                          $topicSpecificColumns = 'UnderstandingChangePointMan';
                      }
                      elseif ($elearningtitle == 'Understanding Change point: Awareness') {
                          $topicSpecificColumns = 'UnderstandingChangePointAwareness';
                      }
                      elseif ($elearningtitle == 'Preparation for a change and quality Check method') {
                          $topicSpecificColumns = 'PreparationForAChangeAndQualityCheckMethod';
                      }
                      elseif ($elearningtitle == 'Production Line stop in case of abnormality') {
                          $topicSpecificColumns = 'ProductionLineStopInCaseOfAbnormality';
                      }
                      elseif ($elearningtitle == 'Recurrence prevention of in-process defect outflow') {
                          $topicSpecificColumns = 'RecurrencePreventionOfInProcessDefectOutflow';
                      }
                      elseif ($elearningtitle == 'Recurrence prevention of in-process defect') {
                          $topicSpecificColumns = 'RecurrencePreventionOfInProcessDefect';
                      }
                      elseif ($elearningtitle == 'Recurrence prevention from outflow to post process') {
                          $topicSpecificColumns = 'RecurrencePreventionFromOutflowToPostProcess';
                      }
                      elseif ($elearningtitle == 'Important process control') {
                          $topicSpecificColumns = 'ImportantProcessControl';
                      }
                      elseif ($elearningtitle == 'Control of Fabrication condition') {
                          $topicSpecificColumns = 'ControlOfFabricationCondition';
                      }
                      elseif ($elearningtitle == 'Trend Control') {
                          $topicSpecificColumns = 'TrendControl';
                      }
                      elseif ($elearningtitle == 'Quality Kiken Yochi') {
                          $topicSpecificColumns = 'QualityKikenYochi';
                      }
                      elseif ($elearningtitle == 'Development of quality oriented personnel') {
                          $topicSpecificColumns = 'DevelopmentOfQualityOrientedPersonnel';
                      }
                      elseif ($elearningtitle == 'Work Instruction Sheet') {
                          $topicSpecificColumns = 'WorkInstructionSheet';
                      }
                      elseif ($elearningtitle == 'Process Organization Table: Inlne operation') {
                          $topicSpecificColumns = 'ProcessOrganizationTableInlineOperation';
                      }
                      elseif ($elearningtitle == 'Process Organization Table: Offline Operation') {
                          $topicSpecificColumns = 'ProcessOrganizationTableOfflineOperation';
                      }
                      elseif ($elearningtitle == 'Rules in Automated Operation') {
                          $topicSpecificColumns = 'RulesInAutomatedOperation';
                      }
                      elseif ($elearningtitle == 'Understanding Production Progress') {
                          $topicSpecificColumns = 'UnderstandingProductionProgress';
                      }
                      elseif ($elearningtitle == 'Root cause investigation') {
                          $topicSpecificColumns = 'RootCauseInvestigation';
                      }
                      elseif ($elearningtitle == 'Implementation of Recovery measures') {
                          $topicSpecificColumns = 'ImplementationOfRecoveryMeasures';
                      }
                      elseif ($elearningtitle == 'Proper Stock in Production Site') {
                          $topicSpecificColumns = 'ProperStockInProductionSite';
                      }
                      elseif ($elearningtitle == 'Securing Manpower') {
                          $topicSpecificColumns = 'SecuringManpower';
                      }
                      elseif ($elearningtitle == 'Human Resource Development') {
                          $topicSpecificColumns = 'HumanResourceDevelopment';
                      }
                      elseif ($elearningtitle == 'Kitting') {
                          $topicSpecificColumns = 'Kitting';
                      }
                      elseif ($elearningtitle == 'Cost Education and Reduction Activity') {
                          $topicSpecificColumns = 'CostEducationAndReductionActivity';
                      }
                      elseif ($elearningtitle == 'Usage Control/Understanding Energy Cost') {
                          $topicSpecificColumns = 'UsageControlUnderstandingEnergyCost';
                      }
                      elseif ($elearningtitle == 'Usage/Cost Control') {
                          $topicSpecificColumns = 'UsageCostControl';
                      }
                      elseif ($elearningtitle == 'First-In, First-Out') {
                          $topicSpecificColumns = 'FirstInFirstOut';
                      }
                      elseif ($elearningtitle == 'Labor Cost') {
                          $topicSpecificColumns = 'LaborCost';
                      }
                      elseif ($elearningtitle == 'Control of Fixed Assets') {
                          $topicSpecificColumns = 'ControlOfFixedAssets';
                      }
                      elseif ($elearningtitle == 'Used space in Production area') {
                          $topicSpecificColumns = 'UsedSpaceInProductionArea';
                      }
                      elseif ($elearningtitle == 'Accuracy of Budget Control') {
                          $topicSpecificColumns = 'AccuracyOfBudgetControl';
                      }
                      elseif ($elearningtitle == 'Reduction of Cost of Poor Quality') {
                          $topicSpecificColumns = 'ReductionOfCostOfPoorQuality';
                      }
                      else{
                          echo "Column not found in database...";
                      }



                
              }


              elseif($classification == 'TechStandard'){

                $targetTable = '[dbo].[tbl_topic_LIST_technicalstandard_MAINREQUEST]';
                $targetTableSkillMap = '[dbo].[tbl_topic_LIST_technicalstandard]';


                              // Add topic-specific columns
                    if ($elearningtitle == 'Standard for proces control chart') {
                      $topicSpecificColumns = 'Standard_for_proces_control_chart';
                  }
                  elseif ($elearningtitle == 'Standard for Electronic Component Packaging and Storage') {
                      $topicSpecificColumns = 'Standard_for_Electronic_Component_Packaging_and_Storage';
                  }
                  elseif ($elearningtitle == 'Air blow selection and installation work standard') {
                      $topicSpecificColumns = 'Air_blow_selection_and_installation_work_standard';
                  }
                  elseif ($elearningtitle == 'Air blow work standard') {
                      $topicSpecificColumns = 'Air_blow_work_standard';
                  }
                  elseif ($elearningtitle == 'Cleaning work standard in product assembling') {
                      $topicSpecificColumns = 'Cleaning_work_standard_in_product_assembling';
                  }
                  elseif ($elearningtitle == 'Clean Bench Standard') {
                      $topicSpecificColumns = 'Clean_Bench_Standard';
                  }
                  elseif ($elearningtitle == 'Screw tightening Equipment Selection/ Installation Standard') {
                      $topicSpecificColumns = 'Screw_tightening_Equipment_Selection_Installation_Standard';
                  }
                  elseif ($elearningtitle == 'Electric Screwdriver work standard') {
                      $topicSpecificColumns = 'Electric_Screwdriver_work_standard';
                  }
                  elseif ($elearningtitle == 'Standard for the operations carried out for preventing damage to the external parts operation') {
                      $topicSpecificColumns = 'Standard_for_the_operations_carried_out_for_preventing_damage_to_the_external_parts_operation';
                  }
                  elseif ($elearningtitle == 'Standard for selection and installation ionizers') {
                      $topicSpecificColumns = 'Standard_for_selection_and_installation_ionizers';
                  }
                  elseif ($elearningtitle == 'Work standard for installing ionizers') {
                      $topicSpecificColumns = 'Work_standard_for_installing_ionizers';
                  }
                  elseif ($elearningtitle == 'Visual Appearance work standard') {
                      $topicSpecificColumns = 'Visual_Appearance_work_standard';
                  }
                  elseif ($elearningtitle == 'Standard for appearance and visual check with limit samples') {
                      $topicSpecificColumns = 'Standard_for_appearance_and_visual_check_with_limit_samples';
                  }
                  elseif ($elearningtitle == 'Production Equipments Maintenance Standard') {
                      $topicSpecificColumns = 'Production_Equipments_Maintenance_Standard';
                  }
                  elseif ($elearningtitle == 'Lever-type Dial Gauge Handling Standard') {
                      $topicSpecificColumns = 'Levertype_Dial_Gauge_Handling_Standard';
                  }
                  elseif ($elearningtitle == 'Standard for determining standard times for assembly processes') {
                      $topicSpecificColumns = 'Standard_for_determining_standard_times_for_assembly_processes';
                  }
                  elseif ($elearningtitle == 'Standard for Standard Time Settings for Machining Operations') {
                      $topicSpecificColumns = 'Standard_for_Standard_Time_Settings_for_Machining_Operations';
                  }
                  elseif ($elearningtitle == 'Basic Standardfor implementation of countermeasure against electrostatic damage') {
                      $topicSpecificColumns = 'Basic_Standardfor_implementation_of_countermeasure_against_electrostatic_damge';
                  }
                  elseif ($elearningtitle == 'Standard for handling wrist strap') {
                      $topicSpecificColumns = 'Standard_for_handling_wrist_strap';
                  }
                  elseif ($elearningtitle == 'Standard for handling conductive mat') {
                      $topicSpecificColumns = 'Standard_for_handling_conductive_mat';
                  }
                  elseif ($elearningtitle == 'Standard for handling anti static shoes') {
                      $topicSpecificColumns = 'Standard_for_handling_anti_static_shoes';
                  }
                  elseif ($elearningtitle == 'Standard for job instruction sheets') {
                      $topicSpecificColumns = 'Standard_for_job_instruction_sheets';
                  }
                  elseif ($elearningtitle == 'Standard for Part Delivery Packaging') {
                      $topicSpecificColumns = 'Standard_for_Part_Delivery_Packaging';
                  }
                  elseif ($elearningtitle == 'Standard for Preparing Process Analysis Tree Sheets') {
                      $topicSpecificColumns = 'Standard_for_Preparing_Process_Analysis_Tree_Sheets';
                  }
                  elseif ($elearningtitle == 'Standard for Safety Tests in Production Processes') {
                      $topicSpecificColumns = 'Standard_for_Safety_Tests_in_Production_Processes';
                  }
                  elseif ($elearningtitle == 'Torque Driver Work Standard') {
                      $topicSpecificColumns = 'Torque_Driver_Work_Standard';
                  }
                  elseif ($elearningtitle == 'Preparation and managerial standards of hand soldering tools') {
                      $topicSpecificColumns = 'Preparation_and_managerial_standards_of_hand_soldering_tools';
                  }
                  elseif ($elearningtitle == 'Hand Soldering Work Standard') {
                      $topicSpecificColumns = 'Hand_Soldering_Work_Standard';
                  }
                  elseif ($elearningtitle == 'Standards of Adhesion') {
                      $topicSpecificColumns = 'Standards_of_Adhesion';
                  }
                  elseif ($elearningtitle == 'Standard for Grease and Oil Applying Operation') {
                      $topicSpecificColumns = 'Standard_for_Grease_and_Oil_Applying_Operation';
                  }
                  elseif ($elearningtitle == 'Standard for Product Safety Risk Assessment') {
                      $topicSpecificColumns = 'Standard_for_Product_Safety_Risk_Assessment';
                  }
                  elseif ($elearningtitle == 'Standard for Determining Product Safety Markings') {
                      $topicSpecificColumns = 'Standard_for_Determining_Product_Safety_Markings';
                  }
                  elseif ($elearningtitle == 'Standard for Product Safety Information in Instruction Manuals') {
                      $topicSpecificColumns = 'Standard_for_Product_Safety_Information_in_Instruction_Manuals';
                  }
                  elseif ($elearningtitle == 'Standard for Safety Assurance Indications on Products') {
                      $topicSpecificColumns = 'Standard_for_Safety_Assurance_Indications_on_Products';
                  }
                  elseif ($elearningtitle == 'Air Cleanliness Measurement Standard') {
                      $topicSpecificColumns = 'Air_Cleanliness_Measurement_Standard';
                  }
                  else{
                      echo "Column not found in database...";
                  }




              
              }


              else{

              }
                    
             
              
              ?>



<?php

if (isset($_SESSION['cooldown_end_time']) && time() < $_SESSION['cooldown_end_time']) {
    $cooldown_remaining = $_SESSION['cooldown_end_time'] - time();
    echo "You've exhausted all attempts. Please wait <span id='cooldown_timer'>$cooldown_remaining</span> seconds before attempting again.";
    // JavaScript for updating cooldown timer dynamically
    echo "<script>
            setInterval(function() {
                var timerElement = document.getElementById('cooldown_timer');
                var remainingTime = parseInt(timerElement.innerHTML);
                remainingTime--;
                if (remainingTime <= 0) {
                    clearInterval();
                    location.reload(); // Reload the page when cooldown ends
                } else {
                    timerElement.innerHTML = remainingTime;
                }
            }, 10);
          </script>";
} else {
    // Retrieve questions based on the selected title
    $generate_questions = "SELECT * FROM [dbo].[tbl_question] WHERE [Title] = '$title'";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn, $generate_questions, $params, $options);

    $row_count = sqlsrv_num_rows($stmt);

    // Initialize score and attempts
    $score = 0;
    $attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 3;

    if ($row_count > 0) {
        $questions = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $questions[] = $row;
        }
        shuffle($questions); // Randomize the sequence of questions

        echo "<form method='post' id='quiz_form' onsubmit='return validateForm()'>";
        foreach ($questions as $row) {
            echo "<h3 id='question_" . $row['ID'] . "'>Question: " . $row['Questions'] . "</h3>";

            // Display choices from database dynamically
            $query = "SELECT ChoicesA, ChoicesB, ChoicesC FROM [dbo].[tbl_question] WHERE ID = " . $row['ID'];
            $choices_result = sqlsrv_query($conn, $query);

            if ($choices_result) {
                $choice_row = sqlsrv_fetch_array($choices_result, SQLSRV_FETCH_ASSOC);

                if ($choice_row) {
                    echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesA'] . '"> ' . $choice_row['ChoicesA'] . '<br>';
                    echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesB'] . '"> ' . $choice_row['ChoicesB'] . '<br>';
                    echo '<input type="radio" name="answers[' . $row['ID'] . ']" value="' . $choice_row['ChoicesC'] . '"> ' . $choice_row['ChoicesC'] . '<br>';
                } else {
                    echo "No choices found for this question.";
                }
            } else {
                echo "Error retrieving choices.";
            }

            echo '<br>';
        }

        echo '<button type="button" class="button-cus1 float-right mt-3" id="btn-back" role="button" style="display: none;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
              </button>';

        echo '<input type="submit" name="submit_answers" class="button-cus2 float-right mt-3" value="Submit">';
        echo "</form>"; // Close the form tag

        echo "<script>
        function validateForm() {
            var questions = document.querySelectorAll('input[type=\"radio\"]:checked');
            if (questions.length < " . count($questions) . ") {
                alert('Please answer all questions before submitting.');
                return false;
            }
            return true;
        }
        </script>";
    }

    if (isset($_POST['submit_answers'])) {
        $total_questions = count($questions); // Total number of questions
        $score = 0;

        // Loop through each submitted answer
        foreach ($_POST['answers'] as $question_id => $user_answer) {
            // Fetch the correct answer from the database
            $correct_answer_query = "SELECT Answers FROM [dbo].[tbl_question] WHERE ID = ?";
            $params = array($question_id);
            $stmt = sqlsrv_query($conn, $correct_answer_query, $params);
            $correct_answer_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $correct_answer = $correct_answer_row['Answers'];

            // Compare user's answer with correct answer and update score accordingly
            if (substr($user_answer, 0, 2) == substr($correct_answer, 0, 2)) {
                $score++;

                // Keep the correct answer selected
                echo "<script>
                var radios = document.getElementsByName('answers[".$question_id."]');
                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].value == '".htmlspecialchars($correct_answer, ENT_QUOTES)."') {
                        radios[i].checked = true;
                        break;
                    }
                }
                </script>";
            } else {
                // Highlight questions with incorrect answers in red
                echo "<script>
                document.getElementById('question_" . $question_id . "').style.color = 'red';
                </script>";
            }
        }

        // Check if the score is perfect or if the user has attempts left
        if ($score == $total_questions) {
            $update_status = "UPDATE [dbo].[tbl_elearningstatus] SET Elearning_Status = 'PASSED', TotalNumber_Finished ='1' WHERE ElearningTransID =  '$elearningtransid' AND EmployeeNumber =  '$employeenoTarget'";
            $resultsupdate = sqlsrv_query($conn, $update_status);

            $update_statusMAINREQUEST = "UPDATE $targetTable SET $topicSpecificColumns = '100%' WHERE  Employee_Number =  '$employeenoTarget'";
            $resultsupdateMAINREQUEST = sqlsrv_query($conn, $update_statusMAINREQUEST);

            $update_statusMAINREQUEST = "UPDATE $targetTableSkillMap SET $topicSpecificColumns = '2' WHERE  Employee_Number =  '$employeenoTarget'";
            $resultsupdateMAINREQUEST = sqlsrv_query($conn, $update_statusMAINREQUEST);

            echo '<script>
            Swal.fire({
                title: "Congratulations!",
                text: "You have PASSED the E-Learning.",
                imageUrl: "assets/img/congrats.gif",
                imageSize: "100x100",
                imageAlt: "Custom image"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "exam.php"; 
                }
            });
            </script>';
        } else {
            $attempts--;
            if ($attempts > 0) {
                echo "You have $attempts attempt(s) left.";
            } else {
                // Set cooldown period
                $_SESSION['cooldown_end_time'] = time() + 5; // 300 seconds cooldown
                $attempts = 3; // Reset attempts to 3
                echo "You've exhausted all attempts. Please wait <span id='cooldown_timer'>5</span> seconds before trying again.";
                // JavaScript for updating cooldown timer dynamically
                echo "<script>
                        setInterval(function() {
                            var timerElement = document.getElementById('cooldown_timer');
                            var remainingTime = parseInt(timerElement.innerHTML);
                            remainingTime--;
                            if (remainingTime <= 0) {
                                clearInterval();
                                location.reload(); // Reload the page when cooldown ends
                            } else {
                                timerElement.innerHTML = remainingTime;
                            }
                        }, 1000);
                      </script>";
            }
        }

        // Store attempts in session
        $_SESSION['attempts'] = $attempts;
    }
}
 
                  ?>

                      <br>
                  
                    </div>
   
     </form>

            
            

    </div>
    </div>


    


    




             


   



</main><!-- End #main -->


    

    



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>BPS</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="">ABCDE</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css">
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>


  <script>
        new DataTable('#example24', {
            initComplete: function () {
                this.api()
                    .columns([1,2,3,4,5])
                    .every(function () {
                        let column = this;
        
                        // Create select element
                        let select = document.createElement('select');
                        select.add(new Option(''));
                        column.header().replaceChildren(select);
        
                        // Apply listener for user change in value
                        select.addEventListener('change', function () {
                            var val = DataTable.util.escapeRegex(select.value);
        
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
        
                        // Add list of options
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.add(new Option(d));
                            });
                    });
            },
            columnDefs: [
        { orderable: false, targets: [0,1,2,3,4,5] }
        ]
        });



  </script>



<script>
      // create a function to update the date and time
      function updateDateTime() {
        // create a new `Date` object
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second:'2-digit'};
       
        const now = new Date();
      

        // get the current date and time as a string
        const currentDateTime = now.toLocaleString("en-US", options);
        

        // update the `textContent` property of the `span` element with the `id` of `datetime`
        document.querySelector('#datetime').textContent = currentDateTime;
      }

      // call the `updateDateTime` function every second
      setInterval(updateDateTime, 1000);
    </script>



<script type="text/javascript">
  function selectComboBox()
  {
      var selectedTopic = document.getElementById('selectedCombo').value;
      if (selectedTopic == '1') {
        document.getElementById('rank').disabled = false ;
        document.getElementById('generate').style.visibility= "hidden";
        document.getElementById('go').style.visibility= "visible";
        document.getElementById('delete').style.visibility= "visible";
      }
      else if (selectedTopic  == '2') {
        document.getElementById('rank').disabled = true;
        document.getElementById('generate').style.visibility= "visible";
        document.getElementById('go').style.visibility= "hidden";
        document.getElementById('delete').style.visibility= "hidden";
      }
      else{
       
        document.getElementById('rank').disabled = false ;
        document.getElementById('generate').style.visibility= "hidden";
      }
 
  }
</script>



<script type="text/javascript">
  function checkID() {
    $(document).ready(function(){   
     
      var biph_id= document.getElementById('employeeno').value;
  
      
      if (biph_id == null || biph_id == "") {
        document.addUser.biph_id.focus();
        document.getElementById('biphemployeeno_id').focus();
        document.getElementById('employeeno').value = "";
        document.getElementById('fullname').value ="";
        document.getElementById('adid').value ="";
        document.getElementById('section').value ="";
        document.getElementById('email').value ="";
   
      }
      else{
 
        $.ajax({
          url:"fetchdata.php",
          method:"POST",
          data:{biph_id:biph_id},
          dataType:"JSON",
          success:function(data)
          {
          
            $('#fullname').val(data.fullname);
            $('#adid').val(data.adid);
            $('#section').val(data.section);
            $('#email').val(data.email);
          }
        });
      }
 
    });
 
  }
</script>

<script>
$(document).ready(function(){
    // Button click event handler for all buttons with class openModalBtn
    $('table tbody').on('click', '.openModalBtn', function() {
  
        // Get the ID from the button's data attribute
        var id = $(this).data("id");
        // AJAX request to load modal content with ID parameter
        $.ajax({
            url: "examslogs.php?id=" + id, // PHP file that generates modal content with ID parameter
            success: function(response){
                // Display modal with loaded content
                $("#myModal").html(response);
                $("#myModal").modal('show'); // Show Bootstrap modal
            }
        });
    });
});
</script>
</body>

</html>