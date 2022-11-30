<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>SWAP - Let's Connect</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    {{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="author" content="SWAP NFC"/>
    <meta name="description" content="This is a personal Swap profile. Find out more about your new connection here."/>

    <!-- Twitter data -->
    <meta name="twitter:card" content="SWAP">
    <meta name="twitter:site" content="@SWAP">
    <meta name="twitter:title" content="Company profile">
    <meta name="twitter:description"
          content="This is my company profile where you can find all our information. Let's get to know each other!">
    <meta name="twitter:image" content="{{ asset('images/content/logo_swap.png') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="My personal profile"/>
    <meta property="og:type" content="Information sharing"/>
    <meta property="og:url" content="swap-nfc.be"/>
    <meta property="og:image" content="{{ asset('images/content/logo_swap.png') }}"/>
    <meta property="og:description"
          content="This is my company profile where you can find all our information. Let's get to know each other!"/>
    <meta property="og:site_name" content="SWAP NFC"/>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}"/>
    @if($member->front_style === "dark")
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
    <!-- Header Image -->
    <div class="header-image">
        @if($member->state->banner)
            <div class="js-parallax"
                 style="background-image: url({{$member->banner ? asset('/') . $member->banner->file : asset('assets/front/img/bg-vcard.png')}});"></div>
        @else
            <div class="js-parallax" style="background-image: url({{asset('assets/front/img/bg-vcard.png')}});"></div>
        @endif
    </div>

    <div class="container gutter-top">

        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Header -->
                <header class="header box w-100 d-flex justify-content-center">
                    <div class="row mx-auto w-100">
                        <div class="col-md-6">
                            @if($member->state->avatar)
                                <div class="header__photo mx-auto ml-lg-0 mb-lg-3" style="position:relative; overflow:inherit;">
                                    <img class="header__photo-img" style="border-radius: 50px;"
                                         src=" {{ $member->avatar ? asset('card/avatars') . "/" . $member->avatar : asset('assets/front/img/main-photo.svg')}}"
                                         alt="avatar">
                                    @if($member->state->avatar && $member->state->logo)
                                        @if($member->logo)
                                            <img style="position:absolute; bottom:-5%; width: 40px; height: 40px; right: -10%; border-radius: 50%; border: 1px black solid;"
                                                 src="{{asset($member->logo->file)}}" alt="logo"/>
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="header__base-info">

                                @if($member->company && $member->state->company)
                                    <h4 class="title titl--h4">{{ $member->company }}</h4>
                                    <br>
                                @endif

                                @if($member->jobTitle && $member->state->jobTitle)
                                    <div class="status">{{ $member->jobTitle }}</div>
                                @endif

                                <div class="">

                                @if($member->user->business)
                                    <!-- Button trigger modal -->
                                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                                                class="btn_cstm save w-100 my-3 p-3"><i class="fa fa-rotate mr-2 "></i>SWAP
                                        </button>
                                        <!-- Modal -->
                                    @else
                                        <div class="py-4">
                                            <a href="{{ route('members.vCard', $member->card_id) }}"
                                               style="text-decoration: none; color: white"
                                               class="btn_cstm save w-100 mt-5 p-3">
                                                <i class="fa fa-floppy-disk me-1 opacity-50"></i> SAVE
                                            </a>
                                        </div>

                                    @endif

                                <!-- Session flash-->
                                    @if(Session::has('existing_contact_message'))
                                        <p class="alert alert-info my-3">{{session('existing_contact_message')}}</p>
                                    @endif
                                <!-- End Session flash -->

                                    @error('name')
                                    <p class="text-danger mt-2 mb-0">Oops, something went wrong! </p>
                                    @enderror
                                    @error('email')
                                    <p class="text-danger">Please try again.</p>
                                    @enderror
                                    @if(Session::has('recaptcha_error'))
                                        <p class="text-danger">{{session('recaptcha_error')}}</p>
                                    @endif
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog mt-0">
                                            <form class="row mb-0" name="contactformulier"
                                                  action="{{action('App\Http\Controllers\CardController@saveInfo', $member->card_id)}}"
                                                  method="post"
                                            >
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="d-flex justify-content-end me-3">
                                                        <button type="button" class="btn_close m-2" data-bs-dismiss="modal"
                                                                aria-label="Close">X
                                                        </button>
                                                    </div>
                                                    <div class="modal-header pt-1">
                                                        <div class="d-flex flex-column">
                                                            <h2 class="talk">Let's talk!</h2>
                                                            <p>Please fill in your information. I will send you a mail to
                                                                talk later.</p>
                                                        </div>
                                                    </div>

                                                    <div class="modal-body">
                                                        @if($member->settings)
                                                            @if($member->settings->name)
                                                                <div class="mb-4 d-flex justify-content-start flex-column">
                                                                    <label class="form-label"
                                                                           for="frontend-contact-firstname">Name</label>
                                                                    <input type="text"
                                                                           class="form-control input_modal"
                                                                           name="name"
                                                                           placeholder="ex: John Doe"
                                                                           autocomplete="name"
                                                                    >
                                                                    @error('name')
                                                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($member->settings)
                                                            @if($member->settings->email)
                                                                <div class="mb-4">
                                                                    <label class="form-label" for="frontend-contact-email">Email</label>
                                                                    <input type="email"
                                                                           class="form-control input_modal"
                                                                           name="email"
                                                                           autocomplete="email"
                                                                           placeholder="Enter your email...">
                                                                    @error('email')
                                                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($member->settings)
                                                            @if($member->settings->phone)
                                                                <label class="form-label"
                                                                       for="frontend-contact-email">Phone</label>
                                                                <div class="mb-4">
                                                                    <input type="text" class="form-control input_modal"
                                                                           name="phone"
                                                                           placeholder="ex: +32474413669"
                                                                           autocomplete="phone">
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($member->settings)
                                                            @if($member->settings->company)
                                                                <div class="mb-4 d-flex justify-content-start flex-column">
                                                                    <label class="form-label"
                                                                           for="frontend-contact-firstname">Company</label>
                                                                    <input type="text"
                                                                           class="form-control input_modal"
                                                                           name="company"
                                                                           placeholder="Enter your company..."
                                                                           autocomplete="name"
                                                                    >
                                                                    @error('company')
                                                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($member->settings)
                                                            @if($member->settings->VAT)
                                                                <div class="mb-4 d-flex justify-content-start flex-column">
                                                                    <label class="form-label"
                                                                           for="frontend-contact-firstname">VAT</label>
                                                                    <input type="text"
                                                                           class="form-control input_modal"
                                                                           name="VAT"
                                                                           placeholder="Enter your VAT..."
                                                                           autocomplete="VAT"
                                                                    >
                                                                    @error('VAT')
                                                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if($member->settings)
                                                            @if($member->settings->notes)
                                                                <div class="mb-4">

                                                                    <label class="form-label" for="frontend-contact-email">Message</label>

                                                                    <textarea name="message"
                                                                              placeholder="Enter your message for {{ $member->firstname }}... "
                                                                              class="form-control input_modal" id=""
                                                                              cols="5" rows="5"></textarea>

                                                                </div>
                                                            @endif
                                                        @endif

                                                        <input type="hidden" name="recaptcha" id="recaptcha">

                                                        <button id="closemodal" type="submit"
                                                                class="btn_cstm input_modal w-100">
                                                            <i class="fa fa-paper-plane me-1 opacity-50"></i> SEND
                                                        </button>
                                                        <small class="mb-3 pl-2">*I agree to the terms and conditions by
                                                            clicking send</small>

                                                        <div class="bodem mb-5 pt-4 mt-5">


                                                            <div class="">
                                                                <strong>Only Save</strong>
                                                                <p>If you only want to save my contact download here.</p>
                                                            </div>

                                                            <a href="{{ route('members.vCard', $member->card_id) }}"
                                                               id="closeNow"
                                                               style="text-decoration: none; color: white"
                                                               class="btn_cstm input_modal p-3">
                                                                <i class="fa fa-floppy-disk me-1 opacity-50"></i> SAVE
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <script src="https://www.google.com/recaptcha/api.js"></script>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 d-md-flex flex-md-column justify-content-md-end align-items-md-end">
                            <ul class="pl-0 pl-lg-3 w-100" style="list-style: none">
                                @if($member->email && $member->state->email)
                                    <li class="mb-2"><span class="overhead">Email</span>
                                        <a class="text-white" href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                    </li>
                                @endif

                                @if($member->mobileWork && $member->state->mobileWork)
                                    <li class="mb-2"><span class="overhead">Mobile</span>
                                        <a class="text-white" href="tel:{{ $member->mobileWork }}">{{ $member->mobileWork }}</a>
                                    </li>
                                @endif

                                @if($member->mobile && $member->state->mobile)
                                    <li class="mb-2"><span class="overhead">Mobile</span>
                                        <a class="text-white" href="tel:{{ $member->mobile }}">{{ $member->mobile }}</a>
                                    </li>
                                @endif
                            </ul>

                            <ul class="pl-0 pl-lg-3 w-100" style="list-style: none">
                                @if($member->age && $member->state->age)
                                    <li class="mb-2"><span class="overhead">Birthday</span>
                                        <span class="text-white">{{ \Carbon\Carbon::parse($member->age)->format('Y-M-d') }}</span>
                                    </li>
                                @endif

                                @if($member->state->addressLine1 || $member->state->postalCode || $member->state->city || $member->state->country  )
                                    <li><span class="overhead">Location</span>
                                        <span class="text-white">
                                             @if($member->addressLine1 && $member->state->addressLine1){{ $member->addressLine1 }}, @endif
                                        </span>
                                        <br>
                                        <span class="text-white">@if($member->postalCode && $member->state->postalCode){{ $member->postalCode }}@endif</span>
                                        <span class="text-white">@if($member->city && $member->state->city){{ $member->city }}@endif</span>
                                        <span class="text-white">@if($member->country && $member->state->country){{ $member->country }}@endif</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
        </div>

        <div class="row">
            <!-- Content -->
            <div class="col-12 col-md-8 mx-auto">
                <div class="box mt-0" id="content">
                    <div class="content box mt-0">
                        <!-- ABOUT -->
                        <div id="about-tab" class="tabcontent active">
                            @if($member->notes && $member->state->notes)
                                <div class="pb-0 pb-sm-2">
                                    <h1 class="title title--h1 first-title title__separate">About Us</h1>
                                    <p> {{ $member->notes }}</p>
                                </div>
                        @endif

                        <!-- What -->
                            <div class="mt-1">

                                <div class="row">

                                    @if($member->video && $member->state->video)
                                        <div class="col-12 d-flex justify-content-center my-3">
                                            <video style="width: 100%; height: auto;" controls autoplay muted>
                                                <source src="{{asset('media/videos/' . $member->video->file)}}"
                                                        type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif

                                    @if($member->youtube_video && $member->state->youtube_video)
                                        <div class="col-12 d-flex justify-content-center my-3">
                                            <iframe src="{{ $member->youtube_video }}?rel=0&amp;autoplay=1&mute=1"
                                                    width="560" height="auto" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @endif

                                    @if($member->website && $member->state->website)
                                    <!-- Website -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="https://{{$member->website }}">
                                                <button type="submit" class="btn_cstm website w-100 mt-2"><i
                                                        class="fa-solid fa-earth-africa mx-2"></i>Website
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->facebook && $member->state->facebook)
                                    <!-- Facebook -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->facebook }}">
                                                <button type="submit" class="btn_cstm facebook w-100 mt-2"><i
                                                        class="fa-brands fa-facebook mr-2"></i>Facebook
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->instagram && $member->state->instagram)
                                    <!-- Instagram -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->instagram }}">
                                                <button type="submit" class="btn_cstm instagram w-100 mt-2"><i
                                                        class="fa-brands  fa-instagram mx-2"></i>Instagram
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->linkedIn && $member->state->linkedIn)
                                    <!-- LinkedIn -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->linkedIn }}">
                                                <button type="submit" class="btn_cstm w-100 linkedIn mt-2"><i
                                                        class="fa-brands  fa-linkedin-in mx-2"></i>LinkedIn
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->twitter && $member->state->twitter)
                                    <!-- Twitter -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->twitter }}">
                                                <button type="submit" class="btn_cstm w-100 twitter mt-2"><i
                                                        class="fa-brands  fa-twitter mx-2"></i>Twitter
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->youTube && $member->state->youTube)
                                    <!-- YouTube -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->youTube }}">
                                                <button type="submit" class="w-100 btn_cstm youTube mt-2"><i
                                                        class="fa-brands fa-youtube mx-2"></i>YouTube
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->tikTok && $member->state->tikTok)
                                    <!-- TikTok -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->tikTok }}">
                                                <button type="submit" class="btn_cstm tikTok w-100 mt-2"><i
                                                        class="fa-brands fa-tiktok mx-2"></i>TikTok
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->whatsApp && $member->state->whatsApp)
                                    <!-- WhatsApp -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank"
                                               href="https://wa.me/{{ $member->whatsApp }}">
                                                <button type="submit" class="btn_cstm whatsApp w-100 mt-2"><i
                                                        class="fa-brands fa-whatsapp mx-2"></i>WhatsApp
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if($member->customField && $member->customText && $member->state->customField)
                                    <!-- Custom -->
                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->customField }}">
                                                <button type="submit" class="btn_cstm custom w-100 mt-2"><i
                                                        class="fa-solid fa-play mx-2"></i>{{ $member->customText }}
                                                </button>
                                            </a>
                                        </div>
                                    @endif

                                    @if(isset($buttons))
                                        @foreach($buttons as $button)
                                            @if($button->state)
                                                @if($button->name && $button->link)
                                                    <!-- Multiple custom buttons -->
                                                    <div class="col-12 col-lg-6 d-flex justify-content-center">
                                                        <a class="w-100" target="_blank" href="{{ $button->link }}">
                                                            @php
                                                                $color = '#' . substr(md5(rand()), 0, 6);
                                                            @endphp
                                                            <button style="background-color: {{ $color }}" type="submit" class="btn_cstm w-100 mt-2"><i
                                                                    class="fa fa-link mx-2"></i>{{ $button->name }}
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->

                <footer class="footer">
                    @guest
                        <a style="text-decoration: none; color: black"
                           class="badge badge-pill bg-white p-3 my-3 text-uppercase"
                           href="{{ asset('/') }}">Login</a>
                    @endguest
                    @auth
                        @if($member->front_style === "dark")
                            <a style="text-decoration: none; color: black"
                               class="badge badge-pill bg-white p-3 my-3 text-uppercase" href="{{ asset('/admin') }}">Dashboard</a>
                        @else
                            <a style="text-decoration: none; color: white"
                               class="badge badge-pill bg-dark p-3 my-3 text-uppercase" href="{{ asset('/admin') }}">Dashboard</a>
                        @endif
                    @endauth
                    <div>
                        <button class="mb-3"
                                style="background: none; border: none; cursor: pointer"
                                data-href="{{$member->memberURL}}"
                                id="to-clipboard">
                            @if($member->front_style === "dark")
                                <img width="25px" height="25px" class="img-fluid far fa-copy"
                                     src="{{ asset('images/content/share-nodes-white.png') }}" alt="share">
                            @else
                                <img width="25px" height="25px" class="img-fluid far fa-copy"
                                     src="{{ asset('images/content/share-nodes.png') }}" alt="share">
                            @endif
                        </button>
                        <div class="alert-success p-2 rounded">Copied to clipboard!</div>
                    </div>
                </footer>
                <div class="d-flex justify-content-center">
                    <a class="footer text-white mb-1 d-flex align-items-center" target="_blank"
                       style="text-decoration: none" href="https://swap-nfc.be/"><i class="fa fa-globe px-2"></i>
                        swap-nfc.be</a>
                </div>
                {{--                <footer class="footer"><a style="text-decoration: none; color: white" href="https://innova-webcreations.be">SWAP</a> © {{ now()->format('Y') }}</footer>--}}
            </div>
        </div>

    </div>
</main>
<div class="back-to-top"></div>
<!-- JavaScripts -->
<script src="https://www.google.com/recaptcha/api.js?render={{ config('custom.RECAPTCHA_SITE_KEY') }}"></script>
<script>
    grecaptcha.ready(function () {

        grecaptcha.execute('{{ config('custom.RECAPTCHA_SITE_KEY') }}', {action: 'contact'}).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>
<script src="{{ asset('assets/front/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/front/js/common.js') }}"></script>

<!-- Mapbox init -->
<script src="{{ asset('assets/front/js/mapbox.init.js') }}"></script>
<script>
    $('#closemodal').click(function () {
        $('#exampleModal').modal('hide');
    });
    $(document).ready(function () {
        $('#closeNow').click(function () {
            $('#exampleModal').modal('hide');
        });
    });
</script>
<script>
    $('.alert-success').hide();

    $("#to-clipboard").on('click', function (e) {
        let target = $(e.target);
        if (target.hasClass("far fa-copy")) {
            target = $(target).parent();
            var status = true;
        }
        let text = $(target).attr("data-href");
        navigator.clipboard.writeText(text);
        if (status) {
            $('.alert-success').show().delay(2000).fadeOut();
        }
    })
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>