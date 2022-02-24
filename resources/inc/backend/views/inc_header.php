<?php
/**
 * backend/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of each page (Backend pages)
 *
 */

use Illuminate\Support\Facades\Auth;

?>

<!-- Header -->
<header id="page-header">
  <!-- Header Content -->
  <div class="content-header">
    <!-- Left Section -->
    <div class="d-flex align-items-center">
      <!-- Toggle Sidebar -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
      <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
        <i class="fa fa-fw fa-bars"></i>
      </button>
      <!-- END Toggle Sidebar -->

      <!-- Toggle Mini Sidebar -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
      <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
        <i class="fa fa-fw fa-ellipsis-v"></i>
      </button>
      <!-- END Toggle Mini Sidebar -->

      <!-- Open Search Section (visible on smaller screens) -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout" data-action="header_search_on">
        <i class="fa fa-fw fa-search"></i>
      </button>
      <!-- END Open Search Section -->

      <!-- Search Form (visible on larger screens) -->
<!--      <form class="d-none d-md-inline-block" action="be_pages_generic_search.php" method="POST">-->
<!--        <div class="input-group input-group-sm">-->
<!--          <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">-->
<!--          <span class="input-group-text border-0">-->
<!--            <i class="fa fa-fw fa-search"></i>-->
<!--          </span>-->
<!--        </div>-->
<!--      </form>-->
      <!-- END Search Form -->
    </div>
    <!-- END Left Section -->

    <!-- Right Section -->
    <div class="d-flex align-items-center">
      <!-- User Dropdown -->
      <div class="dropdown d-inline-block ms-2">
        <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle" height="30" width="30" src="<?php echo  Auth::user()->avatar ?  asset('/') . Auth::user()->avatar->file : asset('/assets/front/img/Avatar-4.svg') ?>" alt="<?php echo Auth::user()->name; ?>">
            <span class="d-none d-sm-inline-block ms-2"><?php echo Auth::user()->name; ?></span>
          <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
          <div class="p-3 text-center bg-body-light border-bottom rounded-top">
              <img class="rounded-circle" height="62" width="62" src="<?php echo  Auth::user()->avatar ?  asset('/') . Auth::user()->avatar->file : asset('/assets/front/img/Avatar-4.svg') ?>" alt="<?php echo Auth::user()->name; ?>">
              <p class="mt-2 mb-0 fw-medium"><?php echo Auth::user()->name; ?></p>
            <p class="mb-0 text-muted fs-sm fw-medium"><?php echo Auth::user() && Auth::user()->roles->first() ? Auth::user()->roles->first()->name : "" ?></p>
          </div>
          <div class="p-2">
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?php echo route('users.edit', Auth::user() ? Auth::user()->id : "") ?>">
              <span class="fs-sm fw-medium">Account</span>
                <i class="far fa-user"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- END User Dropdown -->

      <!-- Notifications Dropdown -->
<!--      <div class="dropdown d-inline-block ms-2">-->
<!--        <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--          <i class="fa fa-fw fa-bell"></i>-->
<!--          <span class="text-primary">•</span>-->
<!--        </button>-->
<!--        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">-->
<!--          <div class="p-2 bg-body-light border-bottom text-center rounded-top">-->
<!--            <h5 class="dropdown-header text-uppercase">Notifications</h5>-->
<!--          </div>-->
<!--          <ul class="nav-items mb-0">-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-check-circle text-success"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">You have a new follower</div>-->
<!--                  <span class="fw-medium text-muted">15 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-plus-circle text-primary"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">1 new sale, keep it up</div>-->
<!--                  <span class="fw-medium text-muted">22 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-times-circle text-danger"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">Update failed, restart server</div>-->
<!--                  <span class="fw-medium text-muted">26 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-plus-circle text-primary"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">2 new sales, keep it up</div>-->
<!--                  <span class="fw-medium text-muted">33 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-user-plus text-success"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">You have a new subscriber</div>-->
<!--                  <span class="fw-medium text-muted">41 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a class="text-dark d-flex py-2" href="javascript:void(0)">-->
<!--                <div class="flex-shrink-0 me-2 ms-3">-->
<!--                  <i class="fa fa-fw fa-check-circle text-success"></i>-->
<!--                </div>-->
<!--                <div class="flex-grow-1 pe-2">-->
<!--                  <div class="fw-semibold">You have a new follower</div>-->
<!--                  <span class="fw-medium text-muted">42 min ago</span>-->
<!--                </div>-->
<!--              </a>-->
<!--            </li>-->
<!--          </ul>-->
<!--          <div class="p-2 border-top text-center">-->
<!--            <a class="d-inline-block fw-medium" href="javascript:void(0)">-->
<!--              <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..-->
<!--            </a>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
      <!-- END Notifications Dropdown -->

      <!-- Toggle Side Overlay -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
<!--      <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout" data-action="side_overlay_toggle">-->
<!--        <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>-->
<!--      </button>-->
      <!-- END Toggle Side Overlay -->
    </div>
    <!-- END Right Section -->
  </div>
  <!-- END Header Content -->

  <!-- Header Search -->
  <div id="page-header-search" class="overlay-header bg-body-extra-light">
    <div class="content-header">
      <form class="w-100" action="be_pages_generic_search.php" method="POST">
        <div class="input-group">
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
            <i class="fa fa-fw fa-times-circle"></i>
          </button>
          <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
        </div>
      </form>
    </div>
  </div>
  <!-- END Header Search -->

  <!-- Header Loader -->
  <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
  <div id="page-header-loader" class="overlay-header bg-body-extra-light">
    <div class="content-header">
      <div class="w-100 text-center">
        <i class="fa fa-fw fa-circle-notch fa-spin"></i>
      </div>
    </div>
  </div>
  <!-- END Header Loader -->
</header>
<!-- END Header -->
