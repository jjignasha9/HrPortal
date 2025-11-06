<?php
// session_start();  
// include "include/conn.php";

 
 
// if(empty($_SESSION['um_fullname']))
// {
// header('Location:home.php');   
// exit;
// }
//   else
//   { 
//     //$isadmin = $_SESSION['isadmin'];
//     $user_role = $_SESSION['user_role']; 
//     $um_id = $_SESSION['um_id'];     
//     $um_fullname = $_SESSION['um_fullname'];             
//     $isstatus = $_SESSION['isstatus'];                 
//     $um_image = $_SESSION['um_image'];
//     $email_id = $_SESSION['emailid'];                 
//     $um_mobileno = $_SESSION['um_mobileno'];                 
//     $address = $_SESSION['address'];
//     $createddate = $_SESSION['createddate'];
// }
?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo $company_name."-".$_SESSION['fy_name'];?></title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="include/ext_resource/font_api.css">
  <!-- Mac-style theme -->
  <link rel="stylesheet" href="css/macos.css">
  <!--  Form validator  and toastr kp  --> 
    <script type="text/javascript" src="include/ext_resource/toastr.min.js"></script>
  <link href="include/ext_resource/toastr.min.css" rel="stylesheet">
  <!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- dropdown search -->
  <script src='dist/js/select2.min.js' type='text/javascript'></script>

  <!-- dropdown search  CSS -->
  <link href='dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  <script src="bower_components/ckeditor/ckeditor.js"></script>

  <style>
    .example-modal .modal { position: relative; top: auto; bottom: auto; right: auto; left: auto; display: block; z-index: 1; }
    .example-modal .modal { background: transparent !important; }

    /* navbar look like dashboard dock */
    .mac-nav-wrap{display:flex;justify-content:center}
    .mac-nav-glass{background:rgba(30,40,50,0.45);border-radius:26px;padding:10px 18px;margin:8px auto;box-shadow:inset 0 1px 0 rgba(255,255,255,0.25),0 10px 30px rgba(0,0,0,0.18)}
    .mac-top-nav{display:flex;align-items:center;gap:18px;flex-wrap:nowrap}
    .mac-top-nav .nav-icon{width:34px;height:34px;display:block}
    .mac-top-nav .nav-label{display:none}
    .mac-top-nav > li > a{display:flex;align-items:center;gap:6px;font-weight:600}
    .mac-top-nav .mac-divider{width:1px;height:34px;background:rgba(255,255,255,0.35);margin:0 8px}
    .mac-nav-glass .navbar-nav>li{float:none}
    .mac-nav-glass .navbar-nav{float:none}

    /* flyout dropdown styling */
    .mac-fly-dropdown{min-width:420px;padding:14px 16px;border:none;border-radius:18px;background:#ffffff;box-shadow:0 18px 40px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.7)}
    .mac-fly-dropdown:before{content:"";position:absolute;left:50%;transform:translateX(-50%);bottom:-10px;border:10px solid transparent;border-top-color:#ffffff;filter:drop-shadow(0 -2px 2px rgba(0,0,0,0.06))}
    .mac-fly-dropdown .mac-menu-title{font-weight:700;margin:-2px -2px 10px -2px;background:linear-gradient(#f6f8fa,#eaeef3);padding:10px 12px;border-radius:12px;color:#2b2b2b}
    .mac-fly-dropdown>li>a{color:#222}
    .mac-fly-dropdown>li+li{margin-top:4px}

    /* dock icon cleanup */
    .mac-dock .dock-item{padding:0 10px}
    .mac-dock .dock-item img{display:block;width:36px;height:36px}
    .mac-dock .mac-dock-divider{width:1px;height:46px;background:rgba(0,0,0,0.25);margin:0 10px;border-radius:1px}
  </style>
  
  <!-- Visby Font -->
  <link rel="stylesheet" href="css/visby-fonts.css">

</head>

<body class="skin-red sidebar-collapse macos-theme">

<div class="wrapper mac-glass-bg  ">

<!-- Mac Dashboard -->
<section class="">
	<section class="">
            <div class="">
               

            <!-- Flyout cards (same content as top_nav.php) -->
            <style>
            /* ensure flyouts are hidden by default and positioned absolutely */
            .mac-dock .mac-dock-divider {
                display: inline-block !important;
                width: 3px !important;
                height: 58px !important;
                background: #c9c8c8ff !important;
                margin: 0 10px !important;
                border-radius: 2px !important;
                opacity: 1 !important;
                box-shadow: 0 0 0px rgba(255,255,255,0.5) !important;
                vertical-align: middle !important;
                position: relative !important;
                z-index: 1000 !important;
                visibility: visible !important;
				align-self: center;
            }
            
            /* Mobile-specific styles */
            @media (max-width: 767px) {
                .mac-dock {
                    position: fixed !important;
                    left: 0 !important;
                    right: 0 !important;
                    bottom: 10px !important;
                    display: flex !important;
                    flex-wrap: nowrap;
                    justify-content: center;
                    align-items: center;
                    padding: 12px 0 !important;
                    width: 100% !important;
                    max-width: 100% !important;
                    margin: 0 auto !important;
                    z-index: 9999 !important;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    white-space: nowrap;
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                    box-sizing: border-box;
                    background: rgba(30,40,50,0.7);
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                    border-radius: 24px;
                    width: 95% !important;
                    max-width: 500px !important;
                    left: 50% !important;
                    transform: translateX(-50%) !important;
                    scroll-behavior: smooth;
                }
                .mac-dock::-webkit-scrollbar {
                    display: none;
                }
                
                .mac-dock .mac-dock-divider {
                    display: inline-block !important;
                    visibility: visible !important;
                    width: 2px !important;
                    height: 40px !important;
                    background: rgba(255,255,255,0.3) !important;
                    opacity: 1 !important;
                    margin: 0 4px !important;
                    border-radius: 1px !important;
                    flex-shrink: 0 !important;
                }
                
                .mac-dock .dock-item {
                    display: inline-flex !important;
                    flex: 0 0 auto !important;
                    padding: 4px 8px !important;
                    margin: 0 2px !important;
                    transform: none !important;
                    transition: all 0.2s ease !important;
                    scroll-snap-align: center;
                }
                
                /* Add some spacing at the end to ensure last item is scrollable */
                .mac-dock::after {
                    content: '';
                    flex: 0 0 10px;
                }
                
                .mac-dock .dock-item img {
                    width: 50px !important;
                    height: 50px !important;
                    margin: 0 auto !important;
                    display: block !important;
                }
                
                .mac-dock .dock-item-active {
                    transform: scale(1.1) !important;
                    position: relative;
                    z-index: 2;
                }
                
                .mac-dock .dock-item::after {
                    display: none !important;
                }
                
                .mac-card.mac-flyout {
                    position: fixed !important;
                    left: 10px !important;
                    right: 10px !important;
                    bottom: 80px !important;
                    top: auto !important;
                    width: auto !important;
                    max-width: 100% !important;
                    transform: none !important;
                    margin: 0 !important;
                    max-height: 60vh;
                    overflow-y: auto;
                    -webkit-overflow-scrolling: touch;
                }
                
                .mac-card.mac-flyout.show {
                    display: block !important;
                }
            }
            .mac-card.mac-flyout{display:none;position:absolute;min-width:420px;width:max-content;min-width:0}
            .mac-card.mac-flyout.show{display:block}
            .mac-card .mac-card-title{background:rgba(255,255,255,0.3);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border-radius:12px;padding:10px 12px;font-weight:bold !important; color:#111; text-align: center;}
            .mac-card .mac-list{color:#111; list-style: none; padding: 2px 0; margin: 0;}
            .mac-card .mac-list a{
                color:#111; 
                display: flex; 
                align-items: center; 
                padding: 4px 12px; 
                text-decoration: none; 
                transition: all 0.2s; 
                border-radius: 4px;
                font-size: 16px;
                font-weight: 500;
                line-height: 1;
                margin: 1px 0;
            }
            .mac-card .mac-list a:hover{
                background-color: rgba(0,0,0,0.05);
                color: #1a73e8;
            }
            .mac-card .menu-icon{
                width: 18px;
                height: 18px;
                margin-right: 12px;
                opacity: 0.8;
                flex-shrink: 0;
            }
            </style>
            <div class="mac-card mac-flyout" id="master-setup">
                <div class="mac-card-title">MASTER SETUP</div>
                <ul class="mac-list">
                    <li><a href="view_fy_year_list.php"><img src="images/icons/master_setup/1.svg" class="menu-icon" alt=""> Calendar Year</a></li>
                    <li><a href="view_designation_list.php"><img src="images/icons/master_setup/2.svg" class="menu-icon" alt=""> Designation</a></li>
                    <li><a href="view_department_list.php"><img src="images/icons/master_setup/3.svg" class="menu-icon" alt=""> Department</a></li>
                    <li><a href="view_question_list.php"><img src="images/icons/master_setup/4.svg" class="menu-icon" alt=""> Questions</a></li>
                    <li><a href="view_company.php"><img src="images/icons/master_setup/5.svg" class="menu-icon" alt=""> ILC Laboratory</a></li>
                    <li><a href="view_internal_auditor.php"><img src="images/icons/master_setup/6.svg" class="menu-icon" alt=""> Internal Auditor</a></li>
                </ul>
            </div>
            <div class="mac-card mac-flyout" id="hr-card">
				<div class="mac-card-title">HR DEPARTMENT</div>
				<ul class="mac-list">
					<li><a href="view_member_list.php"><img src="images/icons/hr_department/1.svg" class="menu-icon" alt="">Member</a></li>
					<li><a href="view_com_cre_list.php"><img src="images/icons/hr_department/2.svg" class="menu-icon" alt="">Competency Criteria</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="purchase-card">
				<div class="mac-card-title">PURCHASE & SUPPLIER DEPARTMENT</div>
				<ul class="mac-list">
					<li><a href="view_ext_provider.php"><img src="images/icons/purchase_supplier/1.svg" class="menu-icon" alt="">External Provider</a></li>
					<li><a href="view_eq_list.php"><img src="images/icons/purchase_supplier/2.svg" class="menu-icon" alt="">Equipment List</a></li>
					<li><a href="view_purchage_indent.php"><img src="images/icons/purchase_supplier/3.svg" class="menu-icon" alt="">Purchase Indent</a></li>
					<li><a href="view_consumable.php"><img src="images/icons/purchase_supplier/4.svg" class="menu-icon" alt="">Consumables Item</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="audit-mrm-card">
				<div class="mac-card-title">INTERNAL AUDIT & MRM</div>
				<ul class="mac-list">
					<li><a href="view_audit.php"><img src="images/icons/audit_mrm/1.svg" class="menu-icon" alt="">Internal Audit</a></li>
					<li><a href="view_meeting.php"><img src="images/icons/audit_mrm/2.svg" class="menu-icon" alt="">MRM</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="records-card">
				<div class="mac-card-title">RECORDS, ILC & PT</div>
				<ul class="mac-list">
					<li><a href="view_list_record.php"><img src="images/icons/records_ilc_pt/1.svg" class="menu-icon" alt="">List Of Record & Distribution</a></li>
					<li><a href="view_scope.php"><img src="images/icons/records_ilc_pt/2.svg" class="menu-icon" alt="">Scope</a></li>
					<li><a href="view_com_process.php"><img src="images/icons/records_ilc_pt/3.svg" class="menu-icon" alt="">Communication Process</a></li>
					<li><a href="view_master_list.php"><img src="images/icons/records_ilc_pt/4.svg" class="menu-icon" alt="">Master List Of Documents</a></li>
					<li><a href="view_pt.php"><img src="images/icons/records_ilc_pt/5.svg" class="menu-icon" alt="">Pt - Proficiency Testing </a></li>
					<li><a href="view_ilc.php"><img src="images/icons/records_ilc_pt/6.svg" class="menu-icon" alt="">ILC - Inter laboratory Comparison</a></li>
					<li><a href="view_method_verification.php"><img src="images/icons/records_ilc_pt/7.svg" class="menu-icon" alt="">Method Verification Record</a></li>
					<li><a href="view_reference_material_standard_list.php"><img src="images/icons/records_ilc_pt/8.svg" class="menu-icon" alt="">Reference Material Standard</a></li>
					<li><a href="view_review_and_change_request_record.php"><img src="images/icons/records_ilc_pt/9.svg" class="menu-icon" alt="">Review & Change Request Record</a></li>

				</ul>
			</div>
            <div class="mac-card mac-flyout" id="mu-iqc-card">
				<div class="mac-card-title">MU, IQC & EMP</div>
				<ul class="mac-list">
					<li><a href="view_mu.php"><img src="images/icons/mu_iqc/1.svg" class="menu-icon" alt=""> Measurement Of Uncertainty</a></li>
					<li><a href="view_iqc.php"><img src="images/icons/mu_iqc/2.svg" class="menu-icon" alt=""> Internal Quality Checks</a></li>
					<li><a href="view_env.php"><img src="images/icons/mu_iqc/3.svg" class="menu-icon" alt=""> Environmental & Monitoring Plan</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="improvements-card">
				<div class="mac-card-title">IMPROVEMENTS, RISK & OPP.</div>
				<ul class="mac-list">
					<li><a href="view_risk.php"><img src="images/icons/improvement_risk/1.svg" class="menu-icon" alt="">Laboratory Risk & Opportunity</a></li>
					<li><a href="view_quality.php"><img src="images/icons/improvement_risk/2.svg" class="menu-icon" alt="">Quality Objectives</a></li>
					<li><a href="view_improvement.php"><img src="images/icons/improvement_risk/3.svg" class="menu-icon" alt="">Improvements</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="feedback-card">
				<div class="mac-card-title">FEEDBACK & COMPLAINTS</div>
				<ul class="mac-list">
					<li><a href="view_feedback.php"><img src="images/icons/customer_feedback/1.svg" class="menu-icon" alt=""> Customer Feedback</a></li>
					<li><a href="view_complaints.php"><img src="images/icons/customer_feedback/2.svg" class="menu-icon" alt=""> Complaints</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="master-data-card">
				<div class="mac-card-title">MASTER DATA</div>
				<ul class="mac-list">
					<li><a href="view_lqm_list.php"><img src="images/icons/master_data/1.svg" class="menu-icon" alt="">Laboratory Quality Manual</a></li>
					<li><a href="view_msp_list.php"><img src="images/icons/master_data/2.svg" class="menu-icon" alt="">Management System Procedure (Msp)</a></li>
					<li><a href="view_sop_list.php"><img src="images/icons/master_data/3.svg" class="menu-icon" alt="">Standard Operation Procedure (Sop)</a></li>
					<li><a href="view_nabl_list.php"><img src="images/icons/master_data/4.svg" class="menu-icon" alt="">Nabl Document (External Document)</a></li>
					<li><a href="view_is_list.php"><img src="images/icons/master_data/5.svg" class="menu-icon" alt="">Test Method (External Document)</a></li>
					<li><a href="view_om_list.php"><img src="images/icons/master_data/6.svg" class="menu-icon" alt="">Operating Manual (External Document)</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="master-docs-card">
				<div class="mac-card-title">MASTER DOCUMENTS</div>
				<ul class="mac-list">
					<li><a href="master_4.php"><img src="images/icons/master_document/1.svg" class="menu-icon" alt="">General Requirements</a></li>
					<li><a href="master_5.php"><img src="images/icons/master_document/2.svg" class="menu-icon" alt="">Structural Requirements</a></li>
					<li><a href="master_6.php"><img src="images/icons/master_document/3.svg" class="menu-icon" alt="">Resource Requirements</a></li>
					<li><a href="master_7.php"><img src="images/icons/master_document/4.svg" class="menu-icon" alt="">Process Requirements</a></li>
					<li><a href="master_8.php"><img src="images/icons/master_document/5.svg" class="menu-icon" alt="">Management System Documentation</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="general-req-card">
				<div class="mac-card-title">GENERAL REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_all_impart.php"><img src="images/icons/general_requirements/1.svg" class="menu-icon" alt="">(F/4.1/01) Impartiality Agreement</a></li>
					<li><a href="hrd_rpt/print_all_conf.php"><img src="images/icons/general_requirements/2.svg" class="menu-icon" alt="">(F/4.1/02) Confidentiality Agreement</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="structural-req-card">
				<div class="mac-card-title">STRUCTURAL REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_scope.php"><img src="images/icons/structural_requirements/1.svg" class="menu-icon" alt="">(F/5.3/01) Print Scope</a></li>
					<li><a href="hrd_rpt/print_communication_process.php"><img src="images/icons/structural_requirements/2.svg" class="menu-icon" alt="">(F/5.5/01) Communication Process</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="resource-req-card">
				<div class="mac-card-title">RESOURCE REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_list_personal.php"><img src="images/icons/resource_requirement/1.svg" class="menu-icon" alt="">(F/6.2/01) List Of Personnel</a></li>
					<li><a href="hrd_rpt/print_all_job_desc.php"><img src="images/icons/resource_requirement/2.svg" class="menu-icon" alt="">(F/6.2/02) Job Description</a></li>
					<li><a href="hrd_rpt/print_comp_creteria.php"><img src="images/icons/resource_requirement/3.svg" class="menu-icon" alt="">(F/6.2/03) Competency Criteria</a></li>
					<li><a href="hrd_rpt/print_iqc_record.php"><img src="images/icons/resource_requirement/4.svg" class="menu-icon" alt="">(F/6.2/04) Competency Evalution & Monitoring Record</a></li>
					<li><a href="hrd_rpt/print_training_plan_all.php"><img src="images/icons/resource_requirement/5.svg" class="menu-icon" alt="">(F/6.2/05) Training Plan & Schedule</a></li>
					<li><a href="hrd_rpt/print_all_training_record.php"><img src="images/icons/resource_requirement/6.svg" class="menu-icon" alt="">(F/6.2/06) Training Record</a></li>
					<li><a href="hrd_rpt/print_all_attendance_log.php"><img src="images/icons/resource_requirement/7.svg" class="menu-icon" alt="">(F/6.2/07) All Attendance Log</a></li>
					<li><a href="hrd_rpt/print_list_autho_matrix.php"><img src="images/icons/resource_requirement/8.svg" class="menu-icon" alt="">(F/6.2/08) Authorization Matrix</a></li>
					<li><a href="hrd_rpt/print_all_env.php"><img src="images/icons/resource_requirement/9.svg" class="menu-icon" alt="">(F/6.3/01) Enviromental Monitoring Plan & Record</a></li>
					<li><a href="hrd_rpt/print_equipment_list.php"><img src="images/icons/resource_requirement/10.svg" class="menu-icon" alt="">(F/6.4/01) List Of Equipment And Calibration Schedule</a></li>
					<li><a href="hrd_rpt/print_equipment_list_d.php"><img src="images/icons/resource_requirement/11.svg" class="menu-icon" alt="">(F/6.4/01-a) List Of Equipment (Inter-mediat Check Index)</a></li>
					<li><a href="hrd_rpt/print_all_calibration_request.php"><img src="images/icons/resource_requirement/12.svg" class="menu-icon" alt="">(F/6.4/02) Calibration Request & Certificate Verification Review</a></li>
					<li><a href="hrd_rpt/print_all_equipment_verification.php"><img src="images/icons/resource_requirement/13.svg" class="menu-icon" alt="">(F/6.4/03) Equipment Verification Recoard</a></li>
					<li><a href="hrd_rpt/print_maintanance_plan.php"><img src="images/icons/resource_requirement/14.svg" class="menu-icon" alt="">(F/6.4/04-a) Maintanance Plan</a></li>
					<li><a href="hrd_rpt/print_all_maintanance_log.php"><img src="images/icons/resource_requirement/15.svg" class="menu-icon" alt="">(F/6.4/04-b) Maintenance Log</a></li>
					<li><a href="hrd_rpt/print_consumable.php"><img src="images/icons/resource_requirement/16.svg" class="menu-icon" alt="">(F/6.6/01) List Of Consumables & Acceptance Criteria</a></li>
					<li><a href="hrd_rpt/print_consumable_data.php"><img src="images/icons/resource_requirement/17.svg" class="menu-icon" alt="">(F/6.6/01-a) List Of Consumables Stocks</a></li>
					<li><a href="hrd_rpt/print_all_eval_selection_ext_provider.php"><img src="images/icons/resource_requirement/18.svg" class="menu-icon" alt="">(F/6.6/02) Evolution & Selection Of External Provider</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="process-req-card">
				<div class="mac-card-title">PROCESS REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_all_method_verification.php"><img src="images/icons/process_requirements/1.svg" class="menu-icon" alt="">(F/7.2/01) Method Verification Record</a></li>
					<li><a href="hrd_rpt/print_all_mu.php"><img src="images/icons/process_requirements/2.svg" class="menu-icon" alt="">(F/7.6/01) Measurement Uncertinity</a></li>
					<li><a href="hrd_rpt/print_ilc.php"><img src="images/icons/process_requirements/3.svg" class="menu-icon" alt="">(F/7.7/01) Print Ilc Plan</a></li>
					<li><a href="hrd_rpt/print_iqc_plan.php"><img src="images/icons/process_requirements/4.svg" class="menu-icon" alt="">(F/7.7/02) Iqc Plan & Schedule</a></li>
					<li><a href="hrd_rpt/print_iqc_record_all.php"><img src="images/icons/process_requirements/5.svg" class="menu-icon" alt="">(F/7.7/02) Iqc Plan & Record</a></li>
					<li><a href="hrd_rpt/print_ref_mat_standard.php"><img src="images/icons/process_requirements/6.svg" class="menu-icon" alt="">(F/7.7/03) Reference Material/standard</a></li>
					<li><a href="hrd_rpt/print_complaints.php"><img src="images/icons/process_requirements/7.svg" class="menu-icon" alt="">(F/7.9/01) Complaints</a></li>
					<li><a href="view_audit.php"><img src="images/icons/process_requirements/8.svg" class="menu-icon" alt="">(F/7.10/01) Nonconforming Work</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="ms-doc-card">
				<div class="mac-card-title">MANAGEMENT SYSTEM DOCUMENTATION</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_all_quality_objective.php"><img src="images/icons/management_document/1.svg" class="menu-icon" alt="">(F	/8.2/01) Quality Objectives</a></li>
					<li><a href="hrd_rpt/print_master_list.php"><img src="images/icons/management_document/2.svg" class="menu-icon" alt="">(F/8.3/01) Print Master List Of Documents</a></li>
					<li><a href="hrd_rpt/print_review_changes_req_record.php"><img src="images/icons/management_document/3.svg" class="menu-icon" alt="">(F/8.3/02) Print Review & Change Request Record</a></li>
					<li><a href="hrd_rpt/print_list_record.php"><img src="images/icons/management_document/4.svg" class="menu-icon" alt="">(F/8.4/01) Print List Record</a></li>
					<li><a href="hrd_rpt/print_all_risk_data.php"><img src="images/icons/management_document/5.svg" class="menu-icon" alt="">(F/8.5/01) Print Risk And Opportunity Review</a></li>
					<li><a href="hrd_rpt/print_all_improvement.php"><img src="images/icons/management_document/6.svg" class="menu-icon" alt="">(F/8.6/01) Improvements</a></li>
					<li><a href="hrd_rpt/print_feedback.php"><img src="images/icons/management_document/7.svg" class="menu-icon" alt="">(F/8.6/02) Feedback</a></li>
					<li><a href="view_audit.php"><img src="images/icons/management_document/8.svg" class="menu-icon" alt="">(F/8.7/01) Corrective Action Report</a></li>
					<li><a href="view_audit.php"><img src="images/icons/management_document/9.svg" class="menu-icon" alt="">(F/8.8/01) Internal Audit Report</a></li>
					<li><a href="view_meeting.php"><img src="images/icons/management_document/10.svg" class="menu-icon" alt="">(F/8.9/01) MRM Report</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="internal-doc-card">
				<div class="mac-card-title">INTERNAL DOCUMENTS (FOR LAB USE)</div>
				<ul class="mac-list">
					<li><a href="hrd_rpt/print_ilc_letter.php"><img src="images/icons/internal_document/1.svg" class="menu-icon" alt="">ILC Request Forwarding Letter</a></li>
					<li><a href="hrd_rpt/print_pt.php"><img src="images/icons/internal_document/2.svg" class="menu-icon" alt="">Print PT Plan</a></li>
					<li><a href="hrd_rpt/print_feedback_summry.php"><img src="images/icons/internal_document/3.svg" class="menu-icon" alt="">Customer Feedback Evaluation Record</a></li>
					<li><a href="hrd_rpt/print_equipment_list_c.php"><img src="images/icons/internal_document/4.svg" class="menu-icon" alt="">(F/6.4/01-C) List Of Equipment (Reviewed)</a></li>
					<li><a href="hrd_rpt/print_all_purchase_indent_eng.php"><img src="images/icons/internal_document/5.svg" class="menu-icon" alt="">(F/6.6/04-a) Purchase Indent (Internal)</a></li>
					<li><a href="hrd_rpt/print_all_pos_eng.php"><img src="images/icons/internal_document/6.svg" class="menu-icon" alt="">(F/6.6/05-A) Purchase Orders (Internal)</a></li>
				</ul>
			</div>
            
			<!-- Dock -->   
            <div class="mac-dock">	
                <a class="dock-item" href="#" data-flyout="master-setup" title="Master Setup"><img src="images/nav_icon/master_setup.svg" style="width:60px;height:60px" alt="Master" /></a>
                <a class="dock-item" href="#" data-flyout="hr-card" title="HR"><img src="images/nav_icon/hr.svg" style="width:60px;height:60px" alt="HR" /></a>
                <a class="dock-item" href="#" data-flyout="purchase-card" title="Purchase & Supplier"><img src="images/nav_icon/purchase_supplier.svg" style="width:60px;height:60px" alt="Purchase" /></a>
                <a class="dock-item" href="#" data-flyout="records-card" title="RECORDS, ILC & PT"><img src="images/nav_icon/records_ilc_pt.svg" style="width:60px;height:60px" alt="RECORDS, ILC & PT" /></a>
                <a class="dock-item" href="#" data-flyout="audit-mrm-card" title="Audit & MRM"><img src="images/nav_icon/audit_mrm.svg" style="width:60px;height:60px" alt="Audit" /></a>

                <a class="dock-item" href="#" data-flyout="mu-iqc-card" title="MU, IQC & EMP"><img src="images/nav_icon/mu_iqc.svg" style="width:60px;height:60px" alt="Equipment" /></a>
                <a class="dock-item" href="#" data-flyout="improvements-card" title="Risk & Opp."><img src="images/nav_icon/improvement_risk.svg" style="width:60px;height:60px" alt="Risk" /></a>
                <a class="dock-item" href="#" data-flyout="feedback-card" title="Feedback"><img src="images/nav_icon/feedback.svg" style="width:60px;height:60px" alt="Feedback" /></a>
                <span class="mac-dock-divider" aria-hidden=""></span>
                <a class="dock-item" href="#" data-flyout="master-data-card" title="Master Data"><img src="images/nav_icon/master_data.svg" style="width:60px;height:60px" alt="Master Data" /></a>
                <a class="dock-item" href="#" data-flyout="master-docs-card" title="Master Documents"><img src="images/nav_icon/master_documents.svg" style="width:60px;height:60px" alt="Docs" /></a>
                <a class="dock-item" href="#" data-flyout="general-req-card" title="General Requirements"><img src="images/nav_icon/general_requirement.svg" style="width:60px;height:60px" alt="General" /></a>
                <a class="dock-item" href="#" data-flyout="structural-req-card" title="Structural Requirements"><img src="images/nav_icon/structural_requirements.svg" style="width:60px;height:60px" alt="Structural" /></a>
                <a class="dock-item" href="#" data-flyout="resource-req-card" title="Resource Requirements"><img src="images/nav_icon/resource_requirementsvg.svg" style="width:60px;height:60px" alt="Resource" /></a>
                <a class="dock-item" href="#" data-flyout="process-req-card" title="Process Requirements"><img src="images/nav_icon/process_requirement.svg" style="width:60px;height:60px" alt="Process" /></a>
                <a class="dock-item" href="#" data-flyout="ms-doc-card" title="Management System Doc"><img src="images/nav_icon/management_system_doc.svg" style="width:60px;height:60px" alt="Management System" /></a>
                <a class="dock-item" href="#" data-flyout="internal-doc-card" title="Internal Documents"><img src="images/nav_icon/internal_document.svg" style="width:60px;height:60px" alt="Internal Docs" /></a>
            </div>
		</div>
	</section>
</section>

<style>
/* dock item styles */
.mac-dock .dock-item {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 4px 8px;
    margin: 0;
    position: relative;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    cursor: pointer;
    text-decoration: none !important;
        transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    transform-origin: bottom center;
    height: 100%;
    box-sizing: border-box;
    transform: translateY(0);
}

.mac-dock .dock-item img {
    width: 60px;
    height: 60px;
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    display: block;
    background: transparent !important;
    border: none !important;
    margin: 0;
    will-change: transform;
    position: relative;
    z-index: 1;
}

/* Active dot indicator */
.dock-item::after {
    content: '';
    position: absolute;
    bottom: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background-color: #007bff;
    border-radius: 50%;
    opacity: 0;
    transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
    z-index: 2;
}

/* Remove default hover effect - we'll handle it with JS */
.mac-dock .dock-item:hover {
    transform: none;
}

.mac-dock .dock-item:hover::after {
    opacity: 0;
    transform: translateX(-50%) scale(1);
}

.mac-dock .dock-item:hover img {
    transform: none;
}

/* Wave effect classes */
.mac-dock .dock-item.wave-3 {
    transform: translateY(-15px);
}
.mac-dock .dock-item.wave-2 {
    transform: translateY(-10px);
}
.mac-dock .dock-item.wave-1 {
    transform: translateY(-5px);
}
.mac-dock .dock-item.active {
    transform: translateY(-18px);
    z-index: 10;
}
.mac-dock .dock-item.active::after {
    opacity: 1;
    transform: translateX(-50%) scale(1.2);
}
.mac-dock .dock-item.active img {
    transform: scale(1.08) translateY(-2px);
}

/* Selected (current page) state: same lift/scale as hover active */
.mac-dock .dock-item.selected {
    transform: translateY(-18px);
    z-index: 10;
}
.mac-dock .dock-item.selected::after {
    opacity: 1;
    transform: translateX(-50%) scale(1.2);
}
.mac-dock .dock-item.selected img {
    transform: scale(1.08) translateY(-2px);
}

/* Remove any white space around the images */
.mac-dock {
    line-height: 0;
    font-size: 0;
    background: transparent !important; /* Ensure dock background is transparent */
}

/* Ensure the dock items have no extra spacing */
.mac-dock > * {
    margin: 0;
    padding: 0;
    background: transparent !important;
}

/* Remove any default button/appearance styles */
.mac-dock .dock-item,
.mac-dock .dock-item:focus,
.mac-dock .dock-item:active,
.mac-dock .dock-item:hover {
    background: transparent !important;
    box-shadow: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
}
</style>

<script>
// Wave effect for dock items with smooth transitions
(function() {
    function initWaveEffect() {
        const dockItems = document.querySelectorAll('.mac-dock .dock-item');
        if (dockItems.length === 0) {
            // Retry if dock items not ready yet
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initWaveEffect);
            } else {
                setTimeout(initWaveEffect, 100);
            }
            return;
        }

    let animationFrame;
    let lastHovered = null;
    
    // Pre-define the transition for smoother performance
    const transition = 'transform 2.1s cubic-bezier(0.16, 1, 0.3, 1)';
    
    // Set initial transition for all items
    dockItems.forEach(item => {
        item.style.transition = transition;
        item.style.willChange = 'transform';
    });
    
    function applyWaveEffect(hoveredItem) {
        // Cancel any pending animation frame
        if (animationFrame) {
            cancelAnimationFrame(animationFrame);
        }
        
        // Use requestAnimationFrame for smoother animations
        animationFrame = requestAnimationFrame(() => {
            // Don't re-apply if hovering the same item
            if (lastHovered === hoveredItem) return;
            lastHovered = hoveredItem;
            
            // Reset all items first with a smooth transition, but keep selected lifted
            dockItems.forEach(item => {
                item.classList.remove('active', 'wave-1', 'wave-2', 'wave-3');
                item.style.transform = '';
                if (item.dataset.selected === 'true') {
                    item.classList.add('selected');
                    item.style.transform = 'translateY(-18px)';
                }
            });
            
            if (!hoveredItem) return;
            
            const index = Array.from(dockItems).indexOf(hoveredItem);
            
            // Apply immediately so hover-in uses the same timing as leave
            hoveredItem.classList.add('active');
            hoveredItem.style.transform = 'translateY(-18px) scale(1.08)';
            
            // Apply wave effect to adjacent icons with staggered delays
            const applyWithDelay = (item, y, scale, delay) => {
                setTimeout(() => {
                    item.style.transform = `translateY(${y}px) scale(${scale})`;
                }, delay);
            };
            
            // Left side with staggered timing (aligned to leave feel)
            if (index > 0) {
                applyWithDelay(dockItems[index - 1], -12, 1.06, 24);
                if (index > 1) {
                    applyWithDelay(dockItems[index - 2], -6, 1.03, 48);
                }
            }
            
            // Right side with staggered timing (aligned to leave feel)
            if (index < dockItems.length - 1) {
                applyWithDelay(dockItems[index + 1], -12, 1.06, 24);
                if (index < dockItems.length - 2) {
                    applyWithDelay(dockItems[index + 2], -6, 1.03, 48);
                }
            }
        });
    }
    
    // Add event listeners for hover
    dockItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            applyWaveEffect(this);
        });
        
        item.addEventListener('mouseleave', function() {
            // Do not hard reset on per-icon mouseleave to keep movement smooth between icons
        });
    });
    
        // Reset all items when mouse leaves the dock container
    const dock = document.querySelector('.mac-dock');
    dock.addEventListener('mouseleave', function() {
        // Use a smooth transition when leaving
        dockItems.forEach((item, i) => {
            setTimeout(() => {
                item.style.transition = 'transform 2.1s cubic-bezier(0.16, 1, 0.3, 1)';
                item.classList.remove('active', 'wave-1', 'wave-2', 'wave-3');
                item.style.transform = '';
                // If item is the selected (current page) one, keep it lifted
                if (item.dataset.selected === 'true') {
                    item.classList.add('selected');
                    item.style.transform = 'translateY(-18px)';
                } 
                
                // Reset transition after animation completes
                setTimeout(() => {
                    item.style.transition = transition;
                }, 2100);
            }, i * 24); // Larger stagger for a very slow, smooth settle
        });
        lastHovered = null;
    });
    }

    // Initialize wave effect
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWaveEffect);
    } else {
        initWaveEffect();
    }
})();

// Dock hover flyout (robust close behavior)
(function(){
    function initFlyout() {
        var triggers = document.querySelectorAll('.dock-item[data-flyout]');
        var flyouts = document.querySelectorAll('.mac-flyout');
        if (triggers.length === 0 || flyouts.length === 0) {
            // Retry if elements not ready yet
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initFlyout);
            } else {
                setTimeout(initFlyout, 100);
            }
            return;
        }

    var current = null, hideTimer;
    
    function isMobile(){ return window.innerWidth <= 767; }
    
    function hideAll(){ 
        flyouts.forEach(function(f){ 
            f.classList.remove('show'); 
        }); 
        document.querySelectorAll('.dock-item').forEach(function(item) {
            item.classList.remove('dock-item-active');
        });
        current = null; 
    }
    
    function position(trigger, flyout){ 
        var rect = trigger.getBoundingClientRect(); 
        flyout.style.display='block'; 
        var width=flyout.offsetWidth, height=flyout.offsetHeight; 
        flyout.style.display=''; 
        if(isMobile()){
            // Mobile: center horizontally, position above dock with top spacing
            var left = (window.innerWidth - width) / 2;
            if(left < 16) left = 16;
            if(left + width > window.innerWidth - 16) left = window.innerWidth - width - 16;
            var bottom = 100; // dock bottom (10px) + dock height (~70px) + spacing (20px)
            flyout.style.left = left + 'px';
            flyout.style.top = 'auto';
            flyout.style.bottom = bottom + 'px';
            flyout.style.marginTop = '0';
        } else {
            // Desktop: position above trigger
            var left = rect.left + (rect.width/2) - (width/2); 
            if(left < 16) left = 16; 
            if(left + width > window.innerWidth - 16) left = window.innerWidth - width - 16; 
            var top = rect.top - height - 35; 
            if(top < 10) top = 10; 
            flyout.style.left = left + 'px'; 
            flyout.style.top = top + 'px';
            flyout.style.bottom = 'auto';
            flyout.style.marginTop = '0';
        }
    }
    
    function show(){ 
        var id = this.getAttribute('data-flyout'); 
        var flyout = document.getElementById(id); 
        if(!flyout) return; 
        clearTimeout(hideTimer); 
        
        // Remove active class from all dock items and flyouts
        document.querySelectorAll('.dock-item').forEach(function(item) {
            item.classList.remove('dock-item-active');
        });
        
        if(current) current.classList.remove('show'); 
        
        // Add active class to current item and show its flyout
        this.classList.add('dock-item-active');
        position(this, flyout); 
        flyout.classList.add('show'); 
        current = flyout; 
    }
    
    function scheduleHide(){ 
        clearTimeout(hideTimer); 
        hideTimer = setTimeout(hideAll, 140); 
    }
    
    // Add event listeners
    triggers.forEach(function(t){ 
        t.addEventListener('mouseenter', show); 
        t.addEventListener('mouseleave', scheduleHide); 
        t.addEventListener('click', function(e){ 
            e.preventDefault(); 
            show.call(t); 
        }); 
    });
    
    flyouts.forEach(function(f){ 
        f.addEventListener('mouseenter', function(){ 
            clearTimeout(hideTimer); 
        }); 
        f.addEventListener('mouseleave', scheduleHide); 
    });
    
    window.addEventListener('scroll', hideAll, {passive:true});
    window.addEventListener('resize', hideAll);
    
    document.addEventListener('click', function(e){ 
        if(current && !e.target.closest('.mac-flyout') && !e.target.closest('.dock-item')) {
            hideAll(); 
        }
    });
    }

    // Initialize flyout
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFlyout);
    } else {
        initFlyout();
    }
})();

// Select dock icon based on current URL matching any link in its dropdown
(function(){
    function initDockSelection() {
        var flyouts = document.querySelectorAll('.mac-flyout');
        if (flyouts.length === 0) {
            // Retry if flyouts not ready yet
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initDockSelection);
            } else {
                setTimeout(initDockSelection, 100);
            }
            return;
        }

        function fileName(path){
            if(!path) return '';
            return path.split('?')[0].split('#')[0].split('/').pop().toLowerCase();
        }
        var currentFile = fileName(window.location.pathname);
        if(!currentFile) return;
        var selectedSet = false;
        flyouts.forEach(function(f){
            if(selectedSet) return;
            var links = f.querySelectorAll('a[href]');
            for(var i=0;i<links.length;i++){
                var hrefFile = fileName(links[i].getAttribute('href'));
                if(hrefFile && hrefFile === currentFile){
                    var dockItem = document.querySelector(".dock-item[data-flyout='"+f.id+"']");
                    if(dockItem){
                        dockItem.dataset.selected = 'true';
                        dockItem.classList.add('selected');
                    }
                    selectedSet = true;
                    break;
                }
            }
        });
    }

    // Initialize dock selection
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDockSelection);
    } else {
        initDockSelection();
    }
})();

</script>

<script>
function abc(){ window.location.href = 'home.php'; }
</script>


