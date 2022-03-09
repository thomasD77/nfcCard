<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>vCard - About</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="author" content="ArtTemplate" />
    <meta name="description" content="vCard" />

    <!-- Twitter data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ArtTemplates">
    <meta name="twitter:title" content="vCard">
    <meta name="twitter:description" content="vCard">
    <meta name="twitter:image" content="../assets/images/social.jpg">

    <!-- Open Graph data -->
    <meta property="og:title" content="ArtTemplate" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="your url website" />
    <meta property="og:image" content="../assets/images/social.jpg" />
    <meta property="og:description" content="vCard" />
    <meta property="og:site_name" content="vCard" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicons/apple-touch-icon-57x57.png">
    <link rel="shortcut icon" href="../assets/images/favicons/favicon.png" type="image/png">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style-dark.css') }}"/>

    <!-- Add icon library -->
    <script src="https://kit.fontawesome.com/f6658138a8.js" crossorigin="anonymous"></script>

    <!-- Mapbox-->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader__wrap">
        <div class="circle-pulse">
            <div class="circle-pulse__1"></div>
            <div class="circle-pulse__2"></div>
        </div>
        <div class="preloader__progress"><span></span></div>
    </div>
</div>

<main class="main">
    <!-- Header Image -->
    <div class="header-image">
        <div class="js-parallax" style="background-image: url({{asset('assets/front/img/bg-vcard.png')}});"></div>
    </div>

    <div class="container gutter-top">
        <!-- Header -->
        <header class="header box">
            <div class="header__left">
                <div class="header__photo">
                    <img class="header__photo-img" src=" {{ $member->avatar ? asset('card/avatars') . "/" . $member->avatar : asset('assets/front/img/main-photo.svg')}}" alt="{{ $member->firstname . $member->lastname }}">
                </div>
                <div class="header__base-info">
                    @if($member->lastname || $member->firstname )
                        <h4 class="title titl--h4">{{ $member->lastname . " " . $member->firstname }}</h4>
                    @endif

                    @if($member->company)
                        <h5 class="status">{{ $member->company }}</h5>
                    @endif

                    @if($member->jobTitle)
                        <div class="status">{{ $member->jobTitle }}</div>
                    @endif
                </div>
                <div class="box box-content">

                        <a class="w-100" href="{{ route('members.vCard', $member->card_id ) }}"><button type="submit" class="btn_cstm save w-100 mt-3 p-4"><i class="fa-solid fa-cloud-arrow-up mr-2 "></i>SAVE ME</button></a>

                </div>
            </div>

            <div class="header__right">
                <ul class="header__contact">
                    @if($member->email)
                        <li><span class="overhead">Email</span>{{ $member->email }}</li>
                    @endif

                    @if($member->mobileWork)
                        <li><span class="overhead">Work Phone</span>{{ $member->mobileWork }}</li>
                    @endif

                    @if($member->mobile)
                        <li><span class="overhead">Personal Phone</span>{{ $member->mobile }}</li>
                    @endif
                </ul>
                <ul class="header__contact">
                    @if($member->age)
                        <li><span class="overhead">Birthday</span>{{ \Carbon\Carbon::parse($member->age)->format('Y-M-d') }}</li>
                    @endif

                    @if($member->addressLine1)
                        <li><span class="overhead">Location</span>{{ $member->addressLine1 . ", " . $member->postalCode . ", " }}
                            <br> {{ $member->city . ", " . $member->country  }}
                        </li>
                    @endif
                </ul>
            </div>
        </header>

        <div class="row sticky-parent">

            <!-- Content -->
            <div class="col-12 col-md-12 col-lg-10">
                <div class="box box-content" id="content">

                    <div class="content">
                        <!-- ABOUT -->
                        <div id="about-tab" class="tabcontent active">
                            @if($member->notes)
                                <div class="pb-0 pb-sm-2">
                                    <h1 class="title title--h1 first-title title__separate">About Me</h1>
                                        <p> {{ $member->notes }}</p>
                                </div>
                            @endif

                            <!-- What -->
                            <div class="mt-1">
                                <h2 class="title title--h3">My Socials</h2>
                                <div class="row">
                                    @if($member->website)
                                        <!-- Website -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->website }}"><button type="submit" class="btn_cstm website w-100 mt-2"><i class="fa-solid fa-earth-africa mx-2"></i>Website</button></a>
                                        </div>
                                    @endif

                                    @if($member->facebook)
                                        <!-- Facebook -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm facebook w-100 mt-2"><i class="fa-brands fa-facebook mr-2"></i>Facebook</button></a>
                                        </div>
                                    @endif

                                    @if($member->facebookMessenger)
                                        <!-- Messenger -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm messenger w-100 mt-2"><i class="fa-brands  fa-facebook-messenger mx-2"></i>Messenger</button></a>
                                        </div>
                                    @endif

                                    @if($member->instagram)
                                        <!-- Instagram -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm instagram w-100 mt-2"><i class="fa-brands  fa-instagram mx-2"></i>Instagram</button></a>
                                        </div>
                                    @endif

                                    @if($member->linkedIn)
                                        <!-- LinkedIn -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm w-100 linkedIn mt-2"><i class="fa-brands  fa-linkedin-in mx-2"></i>LinkedIn</button></a>
                                        </div>
                                    @endif

                                    @if($member->twitter)
                                        <!-- Twitter -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm w-100 twitter mt-2"><i class="fa-brands  fa-twitter mx-2"></i>Twitter</button></a>
                                        </div>
                                    @endif

                                    @if($member->youTube)
                                        <!-- YouTube -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href=""> <button type="submit" class="w-100 btn_cstm youTube mt-2"><i class="fa-brands fa-youtube mx-2"></i>YouTube</button></a>
                                        </div>
                                    @endif

                                    @if($member->tikTok)
                                        <!-- TikTok -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href=""> <button type="submit" class="btn_cstm tikTok w-100 mt-2"><i class="fa-brands fa-tiktok mx-2"></i>TikTok</button></a>
                                        </div>
                                    @endif

                                    @if($member->whatsApp)
                                        <!-- WhatsApp -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href=""><button type="submit" class="btn_cstm whatsApp w-100 mt-2"><i class="fa-brands fa-whatsapp mx-2"></i>WhatsApp</button></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer"><a style="text-decoration: none; color: white" href="https://innova-webcreations.be">Innova Webcreations</a> © {{ now()->format('Y') }}</footer>
                <footer class="footer">
                    <a style="text-decoration: none; color: white" href="{{ asset('/login') }}">Login</a>
                </footer>
            </div>
        </div>
    </div>
</main>

<div class="back-to-top"></div>

<!-- SVG masks -->
{{--<svg class="svg-defs">--}}
{{--    <clipPath id="avatar-box">--}}
{{--        <path d="M1.85379 38.4859C2.9221 18.6653 18.6653 2.92275 38.4858 1.85453 56.0986.905299 77.2792 0 94 0c16.721 0 37.901.905299 55.514 1.85453 19.821 1.06822 35.564 16.81077 36.632 36.63137C187.095 56.0922 188 77.267 188 94c0 16.733-.905 37.908-1.854 55.514-1.068 19.821-16.811 35.563-36.632 36.631C131.901 187.095 110.721 188 94 188c-16.7208 0-37.9014-.905-55.5142-1.855-19.8205-1.068-35.5637-16.81-36.63201-36.631C.904831 131.908 0 110.733 0 94c0-16.733.904831-37.9078 1.85379-55.5141z"/>--}}
{{--    </clipPath>--}}
{{--    <clipPath id="avatar-hexagon">--}}
{{--        <path d="M0 27.2891c0-4.6662 2.4889-8.976 6.52491-11.2986L31.308 1.72845c3.98-2.290382 8.8697-2.305446 12.8637-.03963l25.234 14.31558C73.4807 18.3162 76 22.6478 76 27.3426V56.684c0 4.6805-2.5041 9.0013-6.5597 11.3186L44.4317 82.2915c-3.9869 2.278-8.8765 2.278-12.8634 0L6.55974 68.0026C2.50414 65.6853 0 61.3645 0 56.684V27.2891z"/>--}}
{{--    </clipPath>--}}
{{--</svg>--}}

<!-- JavaScripts -->
<script src="{{ asset('assets/front/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/front/js/common.js') }}"></script>

<!-- Mapbox init -->
<script src="{{ asset('assets/front/js/mapbox.init.js') }}"></script>
</body>
</html>
