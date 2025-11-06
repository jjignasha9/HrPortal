<?php
// Reusable top navbar with SVG icons and dropdown menus
$__standalone = (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'] ?? ''));
$__base = $__standalone ? '../' : '';
if ($__standalone) {
?>
<?php 
 $HIDE_TOPBAR = true; // hide default header for pure dashboard look
 include "/header.php";
 include "include/conn.php";
?>

<!-- Mac Dashboard -->
<section class="content-wrapper mac-glass-bg" style="min-height:calc(100vh);">
	<section class="content">
            <div class="mac-dashboard">
               

            <!-- Flyout cards (same content as top_nav.php) -->
            <style>
            /* ensure flyouts are hidden by default and positioned absolutely */
			.mac-dock .mac-dock-divider

 {
    width: 1px;
    height: 63px;
    background: rgba(0, 0, 0, 0.25);
    margin: 0 10px;
    border-radius: 1px;
}
            .mac-card.mac-flyout{display:none;position:absolute;min-width:420px;width:max-content;min-width:0}
            .mac-card.mac-flyout.show{display:block}
            .mac-card .mac-card-title{background:rgba(255,255,255,0.3);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border-radius:12px;padding:10px 12px;font-weight:700;color:#111}
            .mac-card .mac-list{color:#111}
            .mac-card .mac-list a{color:#111}
            </style>
            <div class="mac-card mac-flyout" id="master-setup">
				<div class="mac-card-title">MASTER SETUP</div>
				<ul class="mac-list">
					<li><a href="view_fy_year_list.php">Calendar Year</a></li>
					<li><a href="view_designation_list.php">Designation</a></li>
					<li><a href="view_department_list.php">Department</a></li>
					<li><a href="view_question_list.php">Questions</a></li>
					<li><a href="view_company.php">ILC Laboratory</a></li>
					<li><a href="view_internal_auditor.php">Internal Auditor</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="hr-card">
				<div class="mac-card-title">HR DEPARTMENT</div>
				<ul class="mac-list">
					<li><a href="view_member_list.php">Member</a></li>
					<li><a href="#">Competency Criteria</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="purchase-card">
				<div class="mac-card-title">PURCHASE & SUPPLIER DEPARTMENT</div>
				<ul class="mac-list">
					<li><a href="view_ext_provider.php">External Provider</a></li>
					<li><a href="view_eq_list.php">Equipment List</a></li>
					<li><a href="#">Purchase Indent</a></li>
					<li><a href="#">Consumables Item</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="audit-mrm-card">
				<div class="mac-card-title">INTERNAL AUDIT & MRM</div>
				<ul class="mac-list">
					<li><a href="view_audit.php">Internal Audit</a></li>
					<li><a href="view_meeting.php">MRM</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="records-card">
				<div class="mac-card-title">RECORDS, ILC & PT</div>
				<ul class="mac-list">
					<li><a href="#">List Of Record & Distribution</a></li>
					<li><a href="#">Scope</a></li>
					<li><a href="#">Communication Process</a></li>
					<li><a href="#">Master List Of Documents</a></li>
					<li><a href="view_pt.php">Proficiency Testing</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="mu-iqc-card">
				<div class="mac-card-title">MU, IQC & EMP</div>
				<ul class="mac-list">
					<li><a href="#">Measurement Of Uncertainty</a></li>
					<li><a href="view_iqc.php">Internal Quality Checks</a></li>
					<li><a href="#">Environmental & Monitoring Plan</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="improvements-card">
				<div class="mac-card-title">IMPROVEMENTS, RISK & OPP.</div>
				<ul class="mac-list">
					<li><a href="view_risk.php">Laboratory Risk & Opportunity</a></li>
					<li><a href="#">Quality Objectives</a></li>
					<li><a href="#">Improvements</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="feedback-card">
				<div class="mac-card-title">FEEDBACK & COMPLAINTS</div>
				<ul class="mac-list">
					<li><a href="view_feedback.php">Customer Feedback</a></li>
					<li><a href="#">Complaints</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="master-data-card">
				<div class="mac-card-title">MASTER DATA</div>
				<ul class="mac-list">
					<li><a href="#">Laboratory Quality Manual</a></li>
					<li><a href="#">Management System Procedure</a></li>
					<li><a href="#">Standard Operation Procedure</a></li>
					<li><a href="#">External Documents</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="master-docs-card">
				<div class="mac-card-title">MASTER DOCUMENTS</div>
				<ul class="mac-list">
					<li><a href="#">General Requirements</a></li>
					<li><a href="#">Structural Requirements</a></li>
					<li><a href="#">Resource Requirements</a></li>
					<li><a href="#">Process Requirements</a></li>
					<li><a href="#">Management System Documentation</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="general-req-card">
				<div class="mac-card-title">GENERAL REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="#">Impartiality Agreement</a></li>
					<li><a href="#">Confidentiality Agreement</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="structural-req-card">
				<div class="mac-card-title">STRUCTURAL REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="#">Print Scope</a></li>
					<li><a href="#">Communication Process</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="resource-req-card">
				<div class="mac-card-title">RESOURCE REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="#">List Of Personnel</a></li>
					<li><a href="#">Job Description</a></li>
					<li><a href="#">Competency Criteria</a></li>
					<li><a href="#">Training Plan & Schedule</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="process-req-card">
				<div class="mac-card-title">PROCESS REQUIREMENTS</div>
				<ul class="mac-list">
					<li><a href="#">Method Verification Record</a></li>
					<li><a href="#">Measurement Uncertainty</a></li>
					<li><a href="#">IQC Plan</a></li>
					<li><a href="#">Nonconforming Work</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="ms-doc-card">
				<div class="mac-card-title">MANAGEMENT SYSTEM DOCUMENTATION</div>
				<ul class="mac-list">
					<li><a href="#">Quality Objectives</a></li>
					<li><a href="#">Master List Of Documents</a></li>
					<li><a href="#">Review & Change Request</a></li>
					<li><a href="#">Risk And Opportunity Review</a></li>
					<li><a href="#">Internal Audit Report</a></li>
				</ul>
			</div>
            <div class="mac-card mac-flyout" id="internal-doc-card">
				<div class="mac-card-title">INTERNAL DOCUMENTS (FOR LAB USE)</div>
				<ul class="mac-list">
					<li><a href="#">ILC Request Forwarding Letter</a></li>
					<li><a href="#">Print PT Plan</a></li>
					<li><a href="#">Customer Feedback Evaluation Record</a></li>
					<li><a href="#">(F/6.4/01-C) List Of Equipment (Reviewed)</a></li>
					<li><a href="#">(F/6.6/04-a) Purchase Indent (Internal)</a></li>
					<li><a href="#">(F/6.6/05-A) Purchase Orders (Internal)</a></li>
				</ul>
			</div>
            
			<!-- Dock -->   
            <div class="mac-dock">
                <a class="dock-item" href="#" data-flyout="master-setup" title="Master Setup"><img src="images/nav_icon/master_setup.svg" style="width:60px;height:60px" alt="Master" /></a>
                <a class="dock-item" href="#" data-flyout="hr-card" title="HR"><img src="images/nav_icon/hr.svg" style="width:60px;height:60px" alt="HR" /></a>
                <a class="dock-item" href="#" data-flyout="purchase-card" title="Purchase & Supplier"><img src="images/nav_icon/purchase_supplier.svg" style="width:60px;height:60px" alt="Purchase" /></a>
                <a class="dock-item" href="#" data-flyout="resource-req-card" title="Equipment"><img src="images/nav_icon/resource_requirementsvg.svg" style="width:60px;height:60px" alt="Equipment" /></a>
                <a class="dock-item" href="#" data-flyout="master-docs-card" title="Master Documents"><img src="images/nav_icon/master_documents.svg" style="width:60px;height:60px" alt="Docs" /></a>
                <a class="dock-item" href="#" data-flyout="audit-mrm-card" title="Audit & MRM"><img src="images/nav_icon/audit_mrm.svg" style="width:60px;height:60px" alt="Audit" /></a>
                <a class="dock-item" href="#" data-flyout="process-req-card" title="Quality"><img src="images/nav_icon/process_requirement.svg" style="width:60px;height:60px" alt="Quality" /></a>
                <a class="dock-item" href="#" data-flyout="improvements-card" title="Risk & Opp."><img src="images/nav_icon/improvement_risk.svg" style="width:60px;height:60px" alt="Risk" /></a>
                <span class="mac-dock-divider" aria-hidden=""></span>
				
                <a class="dock-item" href="#" data-flyout="feedback-card" title="Feedback"><img src="images/nav_icon/feedback.svg" style="width:60px;height:60px" alt="Feedback" /></a>
                <a class="dock-item" href="#" data-flyout="master-data-card" title="Master Data"><img src="images/nav_icon/master_data.svg" style="width:60px;height:60px" alt="Master Data" /></a>
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
/* dashboard-only override to match top_nav icon sizing */
.mac-dock .dock-item img{width:60px;height:60px}
</style>

<script>


// Dock hover flyout (robust close behavior)
(function(){
	var triggers = document.querySelectorAll('.dock-item[data-flyout]');
	var flyouts = document.querySelectorAll('.mac-flyout');
	var current = null, hideTimer;
	function hideAll(){ flyouts.forEach(function(f){ f.classList.remove('show'); }); current=null; }
	function position(trigger, flyout){ var rect = trigger.getBoundingClientRect(); flyout.style.display='block'; var width=flyout.offsetWidth, height=flyout.offsetHeight; flyout.style.display=''; var left = rect.left + (rect.width/2) - (width/2); if(left<16) left=16; if(left+width>window.innerWidth-16) left=window.innerWidth-width-16; var top = rect.top - height - 35; if(top<10) top=10; flyout.style.left=left+'px'; flyout.style.top=top+'px'; }
	function show(){ var id=this.getAttribute('data-flyout'); var flyout=document.getElementById(id); if(!flyout) return; clearTimeout(hideTimer); if(current && current!==flyout) current.classList.remove('show'); position(this, flyout); flyout.classList.add('show'); current=flyout; }
	function scheduleHide(){ clearTimeout(hideTimer); hideTimer=setTimeout(hideAll, 140); }
	triggers.forEach(function(t){ t.addEventListener('mouseenter', show); t.addEventListener('mouseleave', scheduleHide); t.addEventListener('click', function(e){ e.preventDefault(); show.call(t); }); });
	flyouts.forEach(function(f){ f.addEventListener('mouseenter', function(){ clearTimeout(hideTimer); }); f.addEventListener('mouseleave', scheduleHide); });
	window.addEventListener('scroll', hideAll, {passive:true});
	window.addEventListener('resize', hideAll);
	document.addEventListener('click', function(e){ if(current && !e.target.closest('.mac-flyout') && !e.target.closest('.dock-item')) hideAll(); });
})();
</script>

<?php include "footer.php"; ?>



<?php } ?>
