<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="font-semibold text-dual" href="">
                        <span class="smini-visible">
                            <i class="fa fa-circle-notch text-primary"></i>
                        </span>


            <span class="smini-hide fs-5 tracking-wider"><?php use Illuminate\Support\Facades\Auth;echo Auth::user()->billing ? Auth::user()->billing->company : ""   ?></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle" href="javascript:void(0)">
                <i class="far fa-moon"></i>
            </a>
            <!-- END Dark Mode -->

            <!-- Options -->
            <div class="dropdown d-inline-block ms-1">
                <a class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="far fa-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                    <!-- Color Themes -->
                    <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="default" href="#">
                        <span>Default</span>
                        <i class="fa fa-circle text-default"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/amethyst.css') }}" href="#">
                        <span>Amethyst</span>
                        <i class="fa fa-circle text-amethyst"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/city.css') }}" href="#">
                        <span>City</span>
                        <i class="fa fa-circle text-city"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/flat.css') }}" href="#">
                        <span>Flat</span>
                        <i class="fa fa-circle text-flat"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/modern.css') }}" href="#">
                        <span>Modern</span>
                        <i class="fa fa-circle text-modern"></i>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between font-medium" data-toggle="theme" data-theme="{{ asset('css/themes/smooth.css') }}" href="#">
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
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ asset('/admin') }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                @can('is_superAdmin')
                <li class="nav-main-heading">Content</li>
                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon far fa-id-badge"></i>
                        <span class="nav-main-link-name">Pages</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('homePage.index')}}">
                                <span class="nav-main-link-name">Home</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('disclaimer.index')}}">
                                <span class="nav-main-link-name ms-3">Disclaimer</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('privacy.index')}}">
                                <span class="nav-main-link-name ms-3">Privacy Policy</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('cookie.index')}}">
                                <span class="nav-main-link-name ms-3">Cookie Policy</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('is_superAdmin')
                    <li class="nav-main-heading text-uppercase">ACCOUNT USERS</li>
                    <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                            <i class="nav-main-link-icon  fa fa-users"></i>
                            <span class="nav-main-link-name ">Users</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('users.index')}}">
                                    <span class="nav-main-link-name">List</span>
                                </a>
                            </li>
                            @can('is_superAdmin')
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="{{route('roles.index')}}">
                                        <span class="nav-main-link-name">Roles</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <li class="nav-main-heading text-uppercase">Card Members</li>
                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon far fa-list-alt"></i>
                        <span class="nav-main-link-name ">Members</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('members.index')}}">
                                <span class="nav-main-link-name">List</span>
                            </a>
                        </li>
                    </ul>
                </li>


{{--                <li class="nav-main-heading text-uppercase">AGENDA</li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon  far fa-calendar-alt"></i>--}}
{{--                        <span class="nav-main-link-name ">Bookings</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('bookings.index')}}">--}}
{{--                                <span class="nav-main-link-name">List</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('bookings.agenda')}}">--}}
{{--                                <span class="nav-main-link-name">Agenda</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="nav-main-heading">e-Commerce</li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon fab fa-shopify"></i>--}}
{{--                        <span class="nav-main-link-name">Shop</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('products.index')}}">--}}
{{--                                <span class="nav-main-link-name">Products</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('location.index')}}">--}}
{{--                                <span class="nav-main-link-name">Locations</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="{{ route('services.index') }}">--}}
{{--                                <span class="nav-main-link-name">Services</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/blank') ? ' active' : '' }}" href="{{ route('service-categories.index') }}">--}}
{{--                                <span class="nav-main-link-name ms-3">Categories</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/blank') ? ' active' : '' }}" href="{{ route('promos.index') }}">--}}
{{--                                <span class="nav-main-link-name">Promos</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="nav-main-heading">People</li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon far fa-gem"></i>--}}
{{--                        <span class="nav-main-link-name">Clients</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('clients.index')}}">--}}
{{--                                <span class="nav-main-link-name">list</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="nav-main-heading">Publish</li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon fa fa-blog"></i>--}}
{{--                        <span class="nav-main-link-name">Blog</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('posts.index')}}">--}}
{{--                                <span class="nav-main-link-name">Posts</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('postcategories.index')}}">--}}
{{--                                <span class="nav-main-link-name ms-3">Category</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('post.gallery')}}">--}}
{{--                                <span class="nav-main-link-name">Gallery</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon far fa-question-circle"></i>--}}
{{--                        <span class="nav-main-link-name">Faqs</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('faqs.index')}}">--}}
{{--                                <span class="nav-main-link-name">List</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon fa fa-comment-dots"></i>--}}
{{--                        <span class="nav-main-link-name">Testimonials</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('testimonials.index')}}">--}}
{{--                                <span class="nav-main-link-name">list</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('testimonials.form')}}">--}}
{{--                                <span class="nav-main-link-name">Form</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon far fa-list-alt"></i>--}}
{{--                        <span class="nav-main-link-name">Submissions</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('submissions.index')}}">--}}
{{--                                <span class="nav-main-link-name">List</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                        <i class="nav-main-link-icon fab fa-mailchimp"></i>--}}
{{--                        <span class="nav-main-link-name">MailChimp</span>--}}
{{--                    </a>--}}
{{--                    <ul class="nav-main-submenu">--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('mailchimp.form')}}">--}}
{{--                                <span class="nav-main-link-name">Signup Form</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-main-item">--}}
{{--                            <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('mailchimp.contact')}}">--}}
{{--                                <span class="nav-main-link-name">Contact</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}


{{--                @canany(['is_superAdmin', 'is_admin'])--}}
{{--                    <li class="nav-main-heading">Components</li>--}}
{{--                    <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                            <i class="nav-main-link-icon far fa-address-card"></i>--}}
{{--                            <span class="nav-main-link-name">My Company</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nav-main-submenu">--}}
{{--                            <li class="nav-main-item">--}}
{{--                                <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('credentials.index')}}">--}}
{{--                                    <span class="nav-main-link-name">Data</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}

{{--                @can('is_superAdmin')--}}
{{--                    <li class="nav-main-heading">Components</li>--}}
{{--                    <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">--}}
{{--                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">--}}
{{--                            <i class="nav-main-link-icon far fa-address-card"></i>--}}
{{--                            <span class="nav-main-link-name">Forms/Components</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nav-main-submenu">--}}
{{--                            <li class="nav-main-item">--}}
{{--                                <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="{{route('components.index')}}">--}}
{{--                                    <span class="nav-main-link-name">Components</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}


            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
