<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="https://zalo.me/0359917579" class="nav-link">Contact</a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>

        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>

        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>

        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/Admin-Website" class="brand-link">
    <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Trang Quản Trị</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-item">
          <a href="/Setting_Website" class="nav-link">
            <i class="nav-icon fas fa-microchip"></i>
            <p>
              Cài Đặt Website

            </p>
          </a>
        </li>

        <?php if ($url_site_name == $URL_ADMIN) { ?>
          <li class="nav-item">
            <a href="/Setting_Config_Website" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Cài Đặt Hệ Thống

              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="/Setting_Site" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
            <p>
              Quản Lý Site Con

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Danh_Sach_Api" class="nav-link">
            <i class="nav-icon fa fa-file-archive-o"></i>
            <p>
              Thành Viên API

            </p>
          </a>

        </li>
        <?php } ?>

        <li class="nav-item">
          <a href="/Setting_Themes" class="nav-link">
            <i class="nav-icon  fa fa-sliders"></i>
            <p>
              Cài Đặt Giao Diện

            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/Admin-Thesieure" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
            <p>
              Thẻ siêu rẻ auto
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Admin-Mbbank" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
            <p>
              Mbbank auto
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/Admin-Momo" class="nav-link">
            <i class="nav-icon fas fa-sitemap"></i>
            <p>
              Momo auto

            </p>
          </a>

        </li>
        
        <li class="nav-item">
          <a href="/Band_IP" class="nav-link">
            <i class="nav-icon fa fa-window-close"></i>
            <p>
              Khoá IP User

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Setting_User" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Thành Viên Hệ Thống

            </p>
          </a>

        </li>


        <li class="nav-item">
          <a href="/Setting_Noti" class="nav-link">
            <i class="nav-icon fas fa-bell"></i>
            <p>
              Cài Đặt Thông Báo

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Setting_Noti_Modal" class="nav-link">
            <i class="nav-icon fas fa-tablet"></i>
            <p>
              Thông Báo Modal

            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="/Setting_Nap" class="nav-link">
            <i class="nav-icon fas fa-university"></i>
            <p>
              Cài Đặt Nạp Tiền

            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="/Setting_Nap-Tien" class="nav-link">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Quản Lý Nạp Tiền

            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="/Setting_Don" class="nav-link">
            <i class="nav-icon fas fa-heart"></i>
            <p>
              Quản Lý Đơn Hàng

            </p>
          </a>

        </li>

        <?php $total_hotro = $LTT->get_row("SELECT COUNT(*) FROM `list_hotro`  WHERE `status` = 'wait' AND `url_config` = '" . $url_site_name . "'")['COUNT(*)'];
        ?>

        <li class="nav-item">
          <a href="/List_Ho_Tro" class="nav-link">
            <i class="nav-icon fa fa-envelope-open"></i>
            <p>
              Quản Lý Hỗ Trợ
              <span class="badge badge-info right"><?= $total_hotro; ?></span>
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Setting_Service" class="nav-link">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Cài Đặt Dịch Vụ

            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="/Setting_Auto" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Cài Đặt Auto

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="/Setting_Admin" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Cài Đặt Admin

            </p>
          </a>

        </li>

      </ul>
    </nav>
  </div>
</aside>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Trang Quản Trị</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>