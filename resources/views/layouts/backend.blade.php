<!doctype html>
<html lang="{{ config('app.locale') }}">

    @include('layouts.includes.head')

    <body>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">

            @canany(['is_superAdmin', 'is_admin', 'is_employee'])
                @include('layouts.includes.sidebar')
            @endcanany

            @can('is_client')
                @include('layouts.includes.sidebarClient')
            @endcan


           @include('layouts.includes.header')

            <!-- Main Container -->
            <!-- Check if user is archived -->
            @if(!Auth::user()->archived)
                <!-- Check if user trial is expired -->
                @if(Auth::user()->member)
                    <!-- Check if user has test card -->
                    @if(Auth::user()->member->listurl)
                        @if(Auth::user()->member->listurl->type_id == 8)
                            @php
                                $date_member = date( 'Y-m-d', strtotime(Auth::user()->member->listurl->trial_date));
                                $date_now = date( 'Y-m-d', strtotime(now()));
                            @endphp
                            <!-- Check if test card is expired -->
                            @if($date_member > $date_now)
                                <main id="main-container">
                                    @yield('content')
                                </main>
                            @else
                                <main id="main-container">
                                    <div class="pt-5 ps-2">
                                        <p class="mb-1">Your account has been expired. Please take contact with Swap to purchuse your own Swap digital business card.</p>
                                        <a href="https://swap-nfc.be/help-center"><span class="text-muted">click here </span>>>> SWAP NFC <span> <<< </span></a>
                                    </div>
                                </main>
                        @endif
                    @endif
                    <!-- No test card -->
                    @else
                        <main id="main-container">
                            @yield('content')
                        </main>
                    @endif
                @endif

                @can('is_superAdmin')
                    <main id="main-container">
                        @yield('content')
                    </main>
                @endcan

            @else
                <main id="main-container">
                    <div class="pt-5 ps-2">
                        <p class="mb-1">Your account has been blocked. Please take contact with Swap or your company.</p>
                        <a href="https://swap-nfc.be/help-center"><span class="text-muted">click here </span>>>> SWAP NFC <span> <<< </span></a>
                    </div>
                </main>
            @endif
            <!-- END Main Container -->

            @include('layouts.includes.footer')

        </div>
        <!-- END Page Container -->

        @include('layouts.includes.scripts')

    </body>
</html>
