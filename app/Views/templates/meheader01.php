<?php
//$this->uri = new \CodeIgniter\HTTP\URI();
$this->uri = current_url(true);
$myusermod = model('App\Models\MyUserModel');
$cuser = $myusermod->mysys_user();
$ntotal_segments = $this->uri->getTotalSegments();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>mySimple iLogistic PH</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url('assets/img/mesys.png');?>" rel="icon">
  <link href="<?=base_url('assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?=base_url('assets/vendor/jquery/jquery-ui-1.13.2.custom/jquery-ui.min.js')?>"></script>
  <link href="<?=base_url('assets/vendor/jquery/jquery-ui-1.13.2.custom/jquery-ui.min.css');?>" rel="stylesheet" />  
  
  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/boxicons/css/boxicons.min.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/quill/quill.snow.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/quill/quill.bubble.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/remixicon/remixicon.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/vendor/simple-datatables/style.css');?>" rel="stylesheet" /> 
  
  <!-- Template Main CSS File -->
  <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet" /> 
  <link href="<?=base_url('assets/css/mepreloader.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/me-custom.css');?>" rel="stylesheet">
  <script src="<?=base_url('assets/js/mysysapps.js')?>"></script>

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=site_url();?>" class="logo d-flex align-items-center">
        <img src="assets/img/novo.png" alt="">
        <span class="d-none d-lg-block">mySimple iLogistic PH</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$cuser;?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$cuser;?></h6>
              <span>Manager</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=site_url();?>melogout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
<?php
$menu_show_memasterdata = '';
$menu_collapsed_memasterdata = 'collapsed';
$submenu_active_memasterdata_artm = '';
$submenu_active_memasterdata_shpprm = '';
$submenu_active_memasterdata_custm = '';
$submenu_active_memasterdata_suppm = '';
$submenu_active_memasterdata_consgnm = '';
$submenu_active_memasterdata_acctcoam = '';
$submenu_active_memasterdata_agentm = '';
$submenu_active_memasterdata_vendm = '';
$mebase_segment = $this->uri->getSegment(1);
if($ntotal_segments > 0):
	if($mebase_segment == 'mymd-customer') { 
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_custm = 'class="active"';
	} elseif($mebase_segment == 'mymd-item-materials') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_artm = 'class="active"';
	} elseif($mebase_segment == 'mymd-shipper') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_shpprm = 'class="active"';
	} elseif($mebase_segment == 'mymd-consignee') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_consgnm = 'class="active"';
	} elseif($mebase_segment == 'mymd-supplier') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_suppm = 'class="active"';
	} elseif($mebase_segment == 'mymd-agent') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_agentm = 'class="active"';
	} elseif($mebase_segment == 'mymd-vendor') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_vendm = 'class="active"';
	} elseif($mebase_segment == 'mymd-acct-coa') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_acctcoam = 'class="active"';
	} elseif($mebase_segment == 'mymd-charges') {
		$menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_charges = 'class="active"';
	} elseif($mebase_segment == 'mymd-units'){
    $menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_units = 'class="active"';
  } elseif($mebase_segment == 'mymd-container'){
    $menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
		$submenu_active_memasterdata_containertype = 'class="active"';
  } elseif($mebase_segment == 'mymd-vehicle-type'){
    $menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
    $submenu_active_memasterdata_vehicletype = 'class="active"';
  } elseif($mebase_segment == 'mymd-currency'){
    $menu_collapsed_memasterdata = '';
		$menu_show_memasterdata = " show";
    $submenu_active_memasterdata_currency = 'class="active"';
  }

  
  
  //CRM
endif;

$menu_show_quotation_dashb = '';
$menu_collapsed_quotation = 'collapsed';
$menu_show_mecrm = '';
$menu_collapsed_mecrm = 'collapsed';
$submenu_active_entry = '';
$submenu_active_lead_entry = '';
$submenu_active_dashb = '';
$submenu_active_mecrm_salesrally = '';
$submenu_active_mecrm_prospect = '';
$submenu_active_mecrm_lead = '';
$submenu_active_mecrm_activity = '';
$submenu_active_mecrm_visit_planning = '';
$mebase_segment = $this->uri->getSegment(1);
if($ntotal_segments > 0):
	if($mebase_segment == 'mycrm-quotation-dashb') { 
    $menu_collapsed_mecrm = '';
    $menu_show_mecrm = " show";
		$submenu_active_dashb = 'class="active"';
	} elseif($mebase_segment == 'mycrm-quotation-entry') {
    $menu_collapsed_mecrm = '';
    $menu_show_mecrm = " show";
		$submenu_active_entry = 'class="active"';
	}
  elseif($mebase_segment == 'mycrm-leads-entry'){
    $menu_collapsed_mecrm = '';
    $menu_show_mecrm = " show";
		$submenu_active_lead_entry = 'class="active"';
  }
  elseif($mebase_segment == 'mycrm-sales-rally'){
    $menu_collapsed_mecrm = '';
    $submenu_active_mecrm_salesrally = 'class="active"';
    $menu_show_mecrm = " show";
  }
  elseif($mebase_segment == 'mycrm-prospect'){
    $menu_collapsed_mecrm = '';
    $submenu_active_mecrm_prospect = 'class="active"';
    $menu_show_mecrm = " show";
  }
  elseif($mebase_segment == 'mycrm-lead'){
    $menu_collapsed_mecrm = '';
    $submenu_active_mecrm_lead = 'class="active"';
    $menu_show_mecrm = " show";
  }
  elseif($mebase_segment == 'mycrm-activity'){
    $menu_collapsed_mecrm = '';
    $submenu_active_mecrm_activity = 'class="active"';
    $menu_show_mecrm = " show";
  } elseif($mebase_segment == 'mycrm-visit_planning'){
    $menu_collapsed_mecrm = '';
    $submenu_active_mecrm_visit_planning = 'class="active"';
    $menu_show_mecrm = " show";
  }

endif;

$menu_show_maintenance_coa = '';
$menu_collapsed_maintenance = 'collapsed';
$submenu_active_coa = '';

$mebase_segment = $this->uri->getSegment(1);
if($ntotal_segments > 0):
	if($mebase_segment == 'mymaintenance-coa') { 
		$menu_collapsed_maintenance = '';
		$menu_show_maintenance_coa = " show";
		$submenu_active_coa = 'class="active"';
	} 
endif;

?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=site_url();?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link <?=$menu_collapsed_memasterdata;?>" data-bs-target="#memasterdata-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="memasterdata-nav" class="nav-content collapse<?=$menu_show_memasterdata;?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=site_url();?>mymd-item-materials" <?=$submenu_active_memasterdata_artm;?>>
              <i class="bi bi-circle"></i><span>Article Master</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-shipper" <?=$submenu_active_memasterdata_shpprm;?>>
              <i class="bi bi-circle"></i><span>Shipper</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-consignee" <?=$submenu_active_memasterdata_consgnm;?>>
              <i class="bi bi-circle"></i><span>Consignee</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-agent" <?=$submenu_active_memasterdata_agentm;?>>
              <i class="bi bi-circle"></i><span>Agents</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-vendor" <?=$submenu_active_memasterdata_vendm;?>>
              <i class="bi bi-circle"></i><span>Vendor</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-acct-coa" <?=$submenu_active_memasterdata_acctcoam;?>>
              <i class="bi bi-circle"></i><span>Chart of Account</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-charges" <?=$submenu_active_memasterdata_charges;?>>
              <i class="bi bi-circle"></i><span>Charges</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-units" <?=$submenu_active_memasterdata_units;?>>
              <i class="bi bi-circle"></i><span>Units</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-container" <?=$submenu_active_memasterdata_containertype;?>>
              <i class="bi bi-circle"></i><span>Container Type</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-vehicle-type" <?=$submenu_active_memasterdata_vehicletype;?>>
              <i class="bi bi-circle"></i><span>Vehicle Type</span>
            </a>
          </li>
          <li>
            <a href="<?=site_url();?>mymd-currency" <?=$submenu_active_memasterdata_currency;?>>
              <i class="bi bi-circle"></i><span>Currency</span>
            </a>
          </li>
        </ul>
      </li><!-- End Master Data Nav -->

      <li class="nav-item">
        <a class="nav-link <?=$menu_collapsed_maintenance;?>" data-bs-target="#maintenance-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-fill-gear"></i><span>Maintenance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="maintenance-nav" class="nav-content collapse<?=$menu_show_maintenance_coa;?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=site_url();?>mymaintenance-coa" <?=$submenu_active_coa;?>>
              <i class="bi bi-circle"></i><span>Chart of Accounts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Maintenance Nav -->

      <li class="nav-item">
        <a class="nav-link <?=$menu_collapsed_mecrm;?>" data-bs-target="#myquotation-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-post"></i><span>Sales & Service (CRM)</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="myquotation-nav" class="nav-content collapse<?=$menu_show_mecrm;?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=site_url();?>mycrm-sales-rally" <?=$submenu_active_mecrm_salesrally;?>>
              <i class="bi bi-circle"></i><span>Sales Rally</span>
            </a>  
          </li>
          <li>
            <a href="<?=site_url();?>mycrm-prospect" <?=$submenu_active_mecrm_prospect;?>>
              <i class="bi bi-circle"></i><span>Prospect</span>
            </a>  
          </li>
          <li>
            <a href="<?=site_url();?>mycrm-lead" <?=$submenu_active_mecrm_lead;?>>
              <i class="bi bi-circle"></i><span>Lead</span>
            </a>  
          </li>
          <li>
            <a href="<?=site_url();?>mycrm-activity" <?=$submenu_active_activity;?>>
              <i class="bi bi-circle"></i><span>Activity</span>
            </a>  
          </li>
          <li>
            <a href="<?=site_url();?>mycrm-visit-planning" <?=$submenu_active_mecrm_visit_planning;?>>
              <i class="bi bi-circle"></i><span>Visit Planning</span>
            </a>  
          </li>
          <li>
            <a href="<?=site_url();?>mycrm-quotation-dashb" <?=$submenu_active_dashb;?>>
              <i class="bi bi-circle"></i><span>Quotation</span>
            </a>  
          </li>
        </ul>
      </li><!-- End Quotation Nav -->

  </aside><!-- End Sidebar-->

