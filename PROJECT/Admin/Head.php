<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../Assets/Templates/Admin/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../Assets/Templates/Admin/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Black Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../Assets/Templates/Admin/assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../Assets/Templates/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../Assets/Templates/Admin/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../Assets/Templates/Admin/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class=" ">
  <div class="wrapper ">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            CT
          </a>
          <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Creative Tim
          </a>
        </div>
        <ul class="nav">
        <li class="active ">
            <a href="SalesReport.php">
              <i class="tim-icons icon-chart-bar-32"></i>
              <p>Sales Report</p>
            </a>
          </li>
          <li class="active ">
            <a href="CategoryPieChart.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Category-wise Sales</p>
            </a>
          </li>
          <li>
            <a href="district.php">
              <i class="tim-icons icon-square-pin"></i>
              <p>District</p>
            </a>
          </li>
          <li>
            <a href="Place.php">
              <i class="tim-icons icon-square-pin"></i>
              <p>Place</p>
            </a>
          </li>
          <li>
            <a href="Color.php">
              <i class="tim-icons icon-palette"></i>
              <p>Color</p>
            </a>
          </li>
          <li>
            <a href="Material.php">
              <i class="tim-icons icon-palette"></i>
              <p>Materials</p>
            </a>
          </li>
          <li>
            <a href="UserList.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a href="ChangePassword.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li>
            <a href="Category.php">
              <i class="tim-icons icon-components"></i>
              <p>Category</p>
            </a>
          </li>
          <li>
            <a href="Subcategory.php">
              <i class="tim-icons icon-components"></i>
              <p>Sub-Category</p>
            </a>
          </li>
          <li>
            <a href="ManufacturerList.php">
              <i class="tim-icons icon-single-02"></i>
              <p>New Manufacturers</p>
            </a>
          </li>
          <li>
            <a href="Acceptedmanufacturer.php">
              <i class="tim-icons icon-satisfied"></i>
              <p>Accepted Manufacturers</p>
            </a>
          </li>
          <li>
            <a href="NewProducts.php">
              <i class="tim-icons icon-basket-simple"></i>
              <p>New Products</p>
            </a>
          </li>
          <li>
            <a href="AcceptedProducts.php">
              <i class="tim-icons icon-satisfied"></i>
              <p>Accepted Products</p>
            </a>
          </li>
          <li>
            <a href="RejectedManufacturer.php">
              <i class="tim-icons icon-alert-circle-exc"></i>
              <p>Rejected Manufacturers</p>
            </a>
          </li>
          <li>
            <a href="RejectedProducts.php">
              <i class="tim-icons icon-alert-circle-exc"></i>
              <p>Rejected Products</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent   ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="HomePage.php">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto ">
              <div class="search-bar input-group">
                <!-- <input type="text" class="form-control" placeholder="Search...">
      <div class="input-group-addon"><i class="tim-icons icon-zoom-split"></i></div> -->
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i></button>
                <!-- You can choose types of search input -->
              </div>
              <!-- <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="tim-icons icon-simple-remove"></i>
          </button>
        </div>

        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div> -->
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="notification d-none d-lg-block d-xl-block"></div>
                  <i class="tim-icons icon-sound-wave"></i>
                  <p class="d-lg-none">
                    New Notifications
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Mike John responded to your email</a>
                  </li>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">You have 5 more tasks</a>
                  </li>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Your friend Michael is in town</a>
                  </li>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Another notification</a>
                  </li>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Another one</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../Assets/Templates/Admin/assets/img/anime3.png">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Profile</a>
                  </li>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Settings</a>
                  </li>
                  <div class="dropdown-divider"></div>
                  <li class="nav-link">
                    <a href="#" class="nav-item dropdown-item">Log out</a>
                  </li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">