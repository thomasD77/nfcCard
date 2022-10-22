<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">

        @if(!Auth()->user()->archived)
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
            @endif
        </div>
        <!-- END Left Section -->
        @if(isset(Auth()->user()->member) && !Auth()->user()->archived && Auth()->user()->member->card_id !== 0)
            <a class="text-center nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('share')}}">
                <img width="25px" height="25px" class="img-fluid" src="{{ asset('images/content/share-nodes.png') }}" alt="QRcode">
            </a>
        @endif

    <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" height="30" width="30"  src="{{Auth::user()->avatar ?  asset('/') . Auth::user()->avatar->file : asset('/assets/front/img/Avatar-4.svg')}}" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ms-2">{{ Auth::user() ? Auth::user()->name : "" }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" height="62" width="62" src="{{ Auth::user()->avatar ?  asset('/') . Auth::user()->avatar->file : asset('/assets/front/img/Avatar-4.svg') }}" alt="">
                        <p class="mt-2 mb-0 fw-medium">{{ Auth::user() ? Auth::user()->name : "" }}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">{{Auth::user() && Auth::user()->roles->first() ? Auth::user()->roles->first()->name : ""}}</p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ asset('/admin') }}">
                            <span class="fs-sm fw-medium">Dashboard</span>
                            <i class="nav-main-link-icon si si-cursor"></i>
                        </a>
                    </div>
                    @if(!Auth()->user()->archived)
                        <div role="separator" class="dropdown-divider m-0"></div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{route('users.edit', Auth::user() ? Auth::user()->id : "")}}">
                                <span class="fs-sm fw-medium">Account</span>
                                <i class="far fa-user"></i>
                            </a>
                        </div>
                    @endif
                    <div role="separator" class="dropdown-divider m-0"></div>

                    <div class="p-2">

                        <a class="dropdown-item d-flex align-items-center justify-content-between w-100" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <i class="fas fa-sign-out-alt"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none bg-dark">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="/dashboard" method="POST">
                @csrf
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
