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
    <!-- CSS only -->
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
            

                <a class="btn_cstm_download p-3 text-center my-3" style="color:white; text-decoration: none; list-style: none" href="{{ route('members.vCard', $member->card_id) }}">
                <h3> {{ $member->titleMessage }} </h3>
                @if($member->message)
                    <br>
                        {{ $member->message}}
                    <br>
                @endif

                <br> SAVE TO CONTACTS <br>
                    <i class="fa fa-2x fa-floppy-disk me-1 opacity-50"></i>
                </a>
                
                <a class="btn_cstm save p-3 text-center my-3" style="color:white; text-decoration: none; list-style: none" href="{{ route('direction', $member->card_id) }}">
                <i class="fa fa-rotate mr-2"></i> Back to profile
                </a>


            </div>

            
        </header>

    
    </div>
</main>

<div class="back-to-top"></div>
<!-- JavaScripts -->
<script src="{{ asset('assets/front/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/front/js/common.js') }}"></script>

<!-- Mapbox init -->
<script src="{{ asset('assets/front/js/mapbox.init.js') }}"></script>
<script>
    $('#closemodal').click(function() {
        $('#exampleModal').modal('hide');
    });
    $(document).ready(function(){
        $('#closeNow').click(function(){
            $('#exampleModal').modal('hide');
        });
    });
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
