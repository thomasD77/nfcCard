<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.landingspage_default.includes.index.meta')

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}"/>
    @if($profile->front_style === "dark")
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style-dark.css?' .time()) }}"/>
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style-rtl.css?' . time()) }}"/>
    @endif

    <!-- Add icon library -->
    <script src="https://kit.fontawesome.com/f6658138a8.js" crossorigin="anonymous"></script>

    <!-- Mapbox-->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet'/>
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

    @include('front.landingspage_default.includes.index.header')

    <div class="container gutter-top">

        @include('front.landingspage_default.includes.index.part-one')

        @include('front.landingspage_default.includes.index.part-two')

    </div>

</main>

    @include('front.landingspage_default.includes.index.scripts')

</body>
</html>
