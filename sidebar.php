 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/avatar22.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li >
          <a href="dashboard.php ">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Entry</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="add-inputs"><a href="add-entry.php"><i class="fa fa-circle-o"></i>Add Input</a></li>
            <li class="add-inputs"><a href="add-emp.php"><i class="fa fa-circle-o"></i>Add Employee</a></li>
			<li class="view-reports"><a href="live-loom.php"><i class="fa fa-circle-o"></i>Live Loom</a></li>
            <li class="view-reports"><a href="view-reports.php"><i class="fa fa-circle-o"></i>View Report</a></li>
            <li class="view-reports"><a href="view-reports3.php"><i class="fa fa-circle-o"></i>View Report<br>New Incentive</a></li>
            
          </ul>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>