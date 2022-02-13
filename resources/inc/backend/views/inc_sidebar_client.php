<?php
/**
 * backend/views/inc_sidebar.php
 *
 * Author: pixelcave
 *
 * The sidebar of each page (Backend pages)
 *
 */

use Illuminate\Support\Facades\Auth;

?>

<!-- Sidebar -->
<!--
    Sidebar Mini Mode - Display Helper classes

    Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

    Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
    Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
    Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
-->
<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="">
      <span class="smini-visible">
        <i class="fa fa-circle-notch text-primary"></i>
      </span>
      <span class="smini-hide fs-5 tracking-wider"><?php echo \App\Models\CompanyCredential::first()->companyName ?></span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div>
      <!-- Dark Mode -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
        <i class="far fa-moon"></i>
      </button>
      <!-- END Dark Mode -->

      <!-- Options -->
      <div class="dropdown d-inline-block ms-1">
        <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-circle"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
          <!-- Color Themes -->
          <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="default" href="#">
            <span>Default</span>
            <i class="fa fa-circle text-default"></i>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/amethyst.min.css" href="#">
            <span>Amethyst</span>
            <i class="fa fa-circle text-amethyst"></i>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/city.min.css" href="#">
            <span>City</span>
            <i class="fa fa-circle text-city"></i>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/flat.min.css" href="#">
            <span>Flat</span>
            <i class="fa fa-circle text-flat"></i>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/modern.min.css" href="#">
            <span>Modern</span>
            <i class="fa fa-circle text-modern"></i>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/smooth.min.css" href="#">
            <span>Smooth</span>
            <i class="fa fa-circle text-smooth"></i>
          </a>
          <!-- END Color Themes -->

          <div class="dropdown-divider"></div>

          <!-- Sidebar Styles -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
            <span>Sidebar Light</span>
          </a>
          <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
            <span>Sidebar Dark</span>
          </a>
          <!-- END Sidebar Styles -->

          <div class="dropdown-divider"></div>

          <!-- Header Styles -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
            <span>Header Light</span>
          </a>
          <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
            <span>Header Dark</span>
          </a>
          <!-- END Header Styles -->
        </div>
      </div>
      <!-- END Options -->

      <!-- Close Sidebar, Visible only on mobile screens -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
        <i class="fa fa-fw fa-times"></i>
      </a>
      <!-- END Close Sidebar -->
    </div>
    <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
<!--        --><?php //$one->build_nav(); ?>
          <div class="content-side">
              <ul class="nav-main">
                  <li class="nav-main-item">
                      <a class="nav-main-link<?php request()->is('dashboard') ? ' active' : '' ?>  " href="<?php echo route('admin.home') ?>">
                          <i class="nav-main-link-icon si si-cursor"></i>
                          <span class="nav-main-link-name">Dashboard</span>
                      </a>
                  </li>
                  <li class="nav-main-heading text-uppercase">AGENDA</li>
                  <li class="nav-main-item <?php echo request()->is('pages/*') ? ' open' : '' ?>">
                      <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                          <i class="nav-main-link-icon  far fa-calendar-alt"></i>
                          <span class="nav-main-link-name ">Bookings</span>
                      </a>
                      <ul class="nav-main-submenu">
                          <li class="nav-main-item">
                              <a class="nav-main-link<?php echo request()->is('pages/datatables') ? ' active' : '' ?>" href="<?php echo route('bookings.index') ?>">
                                  <span class="nav-main-link-name">List</span>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </div>
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
