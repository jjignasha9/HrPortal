 <?php 
	
    // include "include/conn.php";
  ?>
 <!-- Left side column. contains the logo and sidebar -->
<style>
.skin-blue .sidebar-menu>li>a {
    border-left: 3px solid transparent;
    font-size: 21px;
}


</style>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="user_photo/<?php echo strtoupper($um_image); ?>" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info"  style="margin-top: 5%;">

          <p><?php echo strtoupper($um_fullname); ?></p>


        </div>

      </div>


      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

          <li>
				<a href="db_bup.php">
					<i class="fa fa-download"></i> <span>BACK UP</span>
				</a>
		  </li>
		  
		  <li>
				<a href="home.php">
					<i class="fa fa-home"></i> <span>Home</span>
				</a>
		  </li>
		  
		  <li class="treeview">

            <a href="#">

              <i class="fa fa-table"></i> <span>Master</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>

                </span>

            </a>

            <ul class="treeview-menu">
              
			  <li class="active"><a href="view_fy_year_list.php"><i class="fa fa-circle-o"></i> Financial Year</a></li>
			  <li class=""><a href="view_designation_list.php"><i class="fa fa-circle-o"></i>Designation</a></li>
			   <li class=""><a href="view_department_list.php"><i class="fa fa-circle-o"></i> Department</a></li>
			  <li class=""><a href="view_question_list.php"><i class="fa fa-circle-o"></i> Questions</a></li>
			
            </ul>

          </li>
		  
		   <li class="treeview">

            <a href="#">

              <i class="fa fa-table"></i> <span>HRD</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>

                </span>

            </a>

            <ul class="treeview-menu">              			  
			 <li class="active"><a href="view_member_list.php"><i class="fa fa-circle-o"></i> Members</a></li>
			  <li class=""><a href="view_com_cre_list.php"><i class="fa fa-circle-o"></i> Competency Criteria</a></li>
			  <li class=""><a href="view_com_process.php"><i class="fa fa-circle-o"></i> Communication Process</a></li>
            </ul>

          </li>
		  
		  <li class="treeview">

            <a href="#">

              <i class="fa fa-table"></i> <span>PURCHASE</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>

                </span>

            </a>

            <ul class="treeview-menu"> 
			 <li class="active"><a href="view_ext_provider.php"><i class="fa fa-circle-o"></i>External Provider</a></li>
			  <!--<li class=""><a href="view_com_cre_list.php"><i class="fa fa-circle-o"></i> Competency Criteria</a></li>
			  <li class=""><a href="view_com_process.php"><i class="fa fa-circle-o"></i> Communication Process</a></li>-->
			  
            </ul>

          </li>
		  
		  <li class="treeview">

            <a href="#">

              <i class="fa fa-table"></i> <span>RECORD</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>

                </span>

            </a>

            <ul class="treeview-menu">

              <li class="active"><a href="view_list_record.php"><i class="fa fa-circle-o"></i>LIST OF RECORD &amp; Distribution</a></li>
              <li class=""><a href="view_scope.php"><i class="fa fa-circle-o"></i>SCOPE</a></li>
              <li class=""><a href="view_master_list.php"><i class="fa fa-circle-o"></i>MASTER LIST OF DOCUMENTS</a></li>
			  

            </ul>

          </li>
		  
		  
		 
	</ul>

    </section>

    <!-- /.sidebar -->

  </aside>


     