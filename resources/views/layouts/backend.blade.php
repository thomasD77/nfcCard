<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
{{--        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">--}}

        <!-- Meta Data -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <title>SWAP - Let's Connect</title>

        <meta name="description" content="SWAP - NFC">
        <meta name="author" content="SWAP">
{{--        <meta name="robots" content="noindex, nofollow">--}}

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/oneui.css') }}">

        <!-- Laravel Toaster -->
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ asset('/css/themes/amethyst.css') }}"> -->
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

        @livewireStyles
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'remember-theme'                            Remembers active color theme between pages using localStorage (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Light themed Header
            'page-header-dark'                          Dark themed Header

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

        DARK MODE

            'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
        -->
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">
            <!-- Side Overlay-->
{{--            <aside id="side-overlay" class="fs-sm">--}}
{{--                <!-- Side Header -->--}}
{{--                <div class="content-header border-bottom">--}}
{{--                    <!-- User Avatar -->--}}
{{--                    <a class="img-link me-1" href="javascript:void(0)">--}}
{{--                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">--}}
{{--                    </a>--}}
{{--                    <!-- END User Avatar -->--}}

{{--                    <!-- User Info -->--}}
{{--                    <div class="ms-2">--}}
{{--                        <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">John Smith</a>--}}
{{--                    </div>--}}
{{--                    <!-- END User Info -->--}}

{{--                    <!-- Close Side Overlay -->--}}
{{--                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
{{--                    <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">--}}
{{--                        <i class="fa fa-fw fa-times"></i>--}}
{{--                    </a>--}}
{{--                    <!-- END Close Side Overlay -->--}}
{{--                </div>--}}
{{--                <!-- END Side Header -->--}}

{{--                <!-- Side Content -->--}}
{{--                <div class="content-side">--}}
{{--                    <p>--}}
{{--                        Content..--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <!-- END Side Content -->--}}
{{--            </aside>--}}
            <!-- END Side Overlay -->

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

            @canany(['is_superAdmin', 'is_admin', 'is_employee'])
                @include('layouts.includes.sidebar')
            @endcanany

            @can('is_client')
                @include('layouts.includes.sidebarClient')
            @endcan

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

                    @if(isset(Auth()->user()->member) && !Auth()->user()->archived)
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

                        <!-- Languages selection -->
{{--                        <div class="dropdown ms-3">--}}
{{--                            <button class="btn btn-alt-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                {{ Config::get('languages')[App::getLocale()] }}--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                @foreach (Config::get('languages') as $lang => $language)--}}
{{--                                    @if ($lang != App::getLocale())--}}
{{--                                        <li><a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a></li>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <!-- END Languages selection -->

                        <!-- Notifications Dropdown -->
{{--                        <div class="dropdown d-inline-block ms-2">--}}
{{--                            <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fa fa-fw fa-bell"></i>--}}
{{--                                <span class="text-primary">•</span>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">--}}
{{--                                <div class="p-2 bg-body-light border-bottom text-center rounded-top">--}}
{{--                                    <h5 class="dropdown-header text-uppercase">Notifications</h5>--}}
{{--                                </div>--}}
{{--                                <ul class="nav-items mb-0">--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">You have a new follower</div>--}}
{{--                                                <span class="fw-medium text-muted">15 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-plus-circle text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">1 new sale, keep it up</div>--}}
{{--                                                <span class="fw-medium text-muted">22 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">Update failed, restart server</div>--}}
{{--                                                <span class="fw-medium text-muted">26 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-plus-circle text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">2 new sales, keep it up</div>--}}
{{--                                                <span class="fw-medium text-muted">33 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-user-plus text-success"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">You have a new subscriber</div>--}}
{{--                                                <span class="fw-medium text-muted">41 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                            <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                                <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1 pe-2">--}}
{{--                                                <div class="fw-semibold">You have a new follower</div>--}}
{{--                                                <span class="fw-medium text-muted">42 min ago</span>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="p-2 border-top text-center">--}}
{{--                                    <a class="d-inline-block fw-medium" href="javascript:void(0)">--}}
{{--                                        <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- END Notifications Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
{{--                        <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout" data-action="side_overlay_toggle">--}}
{{--                            <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>--}}
{{--                        </button>--}}
                        <!-- END Toggle Side Overlay -->
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


            <!-- Main Container -->
                <main id="main-container">
                    @yield('content')
                </main>
            <!-- END Main Container -->


            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row fs-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="https://innova-webcreations.be" target="_blank">INNOVA WEBCREATIONS</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                            <a class="fw-semibold" href="https://innova-webcreations.be" target="_blank">SWAP</a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!--
            OneUI JS

            Core libraries and functionality
        -->
        <script src="{{ asset('js/oneui.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <!-- <script src="{{ asset('/js/laravel.app.js') }}"></script> -->

        @yield('js_after')

        <!-- Laravel Toastr -->
        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

        <!-- Session Flash Timer -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script>
            $('.alert-success').hide();

            setTimeout(function() {
                $('#flash_message').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        </script>

        <script>
            $('.alert-success').hide();

            $("#to-clipboard").on('click', function(e){
                let target = $(e.target);
                if(target.hasClass("far fa-copy")){
                    target = $(target).parent();
                    var status = true;
                }
                let text = $(target).attr("data-href");
                navigator.clipboard.writeText(text);
                if(status) {
                    $('.alert-success').show().delay(2000).fadeOut();
                }
            })
        </script>

        @livewireScripts

    </body>
</html>
