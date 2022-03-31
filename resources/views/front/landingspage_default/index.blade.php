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
                <div class="header__base-info">
                    @if($member->lastname || $member->firstname )
                        <h4 class="title titl--h4">{{ $member->lastname . " " . $member->firstname }}</h4>
                        <br>
                    @endif

                    @if($member->company)
                        <h5 class="status">{{ $member->company }}</h5>
                        <br>
                    @endif

                    @if($member->jobTitle)
                        <div class="status">{{ $member->jobTitle }}</div>
                    @endif
                </div>
                <div class="box box-content">
                    <!-- Button trigger modal -->
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn_cstm save w-100 mt-3 p-3"><i class="fa fa-rotate mr-2 "></i>SWAP</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                        <div class="modal-dialog mt-0">
                            <form class="row mb-0" name="contactformulier"
                                  action="{{action('App\Http\Controllers\CardController@saveInfo', $member->card_id)}}"
                                  method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="d-flex justify-content-end me-3">
                                        <button type="button" class="btn_close m-2" data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-header pt-1">
                                        <div class="d-flex flex-column">
                                            <h2 class="talk">Let's talk!</h2>
                                            <p>Please fill in your information. I will send you a mail to talk later.</p>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-4 d-flex justify-content-start flex-column">
                                            <label class="form-label"
                                                   for="frontend-contact-firstname">Name</label>
                                            <input type="text" class="form-control input_modal" name="name"
                                                   placeholder="Enter your name...">
                                            @error('name')
                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="frontend-contact-email">Email</label>
                                            <input type="email" class="form-control input_modal" name="email"
                                                   placeholder="Enter your email...">
                                            @error('email')
                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <a style="color: #AEB0B8;" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <label class="form-label" for="frontend-contact-email">Phone <span style="font-style: italic; font-size: 10px">(optional)</span><i class=" mx-2 fa-solid fa-angles-down"></i></label>
                                            </a>
                                            <div class="collapse" id="collapseExample2">
                                                <input type="text" class="form-control input_modal" name="phone"
                                                       placeholder="Enter your phone...">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <a style="color: #AEB0B8" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <label class="form-label" for="frontend-contact-email">Message <span style="font-style: italic; font-size: 10px">(optional)</span><i class=" mx-2 fa-solid fa-angles-down"></i></label>
                                            </a>
                                            <div class="collapse" id="collapseExample">
                                                <textarea name="message" placeholder="Enter your message... " class="form-control input_modal" id="" cols="5" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <button id="closemodal" type="submit" class="btn_cstm input_modal mb-3 w-100">
                                            <i class="fa fa-paper-plane me-1 opacity-50"></i> SWAP
                                        </button>
                                        <div class="modal-footer mb-5 mt-3">
                                            <h2 class="talk">Only Save</h2>
                                            <p>If you only want to save my contact download here.</p>
                                            <a href="{{ route('members.vCard', $member->card_id) }}"
                                               id="closeNow"
                                               style="text-decoration: none; color: white"
                                               class="btn_cstm text-center input_modal w-100">
                                                 <i class="fa fa-floppy-disk me-1 opacity-50"></i> SAVE
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
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
                                            <a class="w-100" target="_blank" href="{{ $member->facebook }}"><button type="submit" class="btn_cstm facebook w-100 mt-2"><i class="fa-brands fa-facebook mr-2"></i>Facebook</button></a>
                                        </div>
                                    @endif

                                    @if($member->instagram)
                                        <!-- Instagram -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href="{{ $member->instagram }}"><button type="submit" class="btn_cstm instagram w-100 mt-2"><i class="fa-brands  fa-instagram mx-2"></i>Instagram</button></a>
                                        </div>
                                    @endif

                                    @if($member->linkedIn)
                                        <!-- LinkedIn -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href="{{ $member->linkedIn }}"><button type="submit" class="btn_cstm w-100 linkedIn mt-2"><i class="fa-brands  fa-linkedin-in mx-2"></i>LinkedIn</button></a>
                                        </div>
                                    @endif

                                    @if($member->twitter)
                                        <!-- Twitter -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href="{{ $member->twitter }}"><button type="submit" class="btn_cstm w-100 twitter mt-2"><i class="fa-brands  fa-twitter mx-2"></i>Twitter</button></a>
                                        </div>
                                    @endif

                                    @if($member->youTube)
                                        <!-- YouTube -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->youTube }}"> <button type="submit" class="w-100 btn_cstm youTube mt-2"><i class="fa-brands fa-youtube mx-2"></i>YouTube</button></a>
                                        </div>
                                    @endif

                                    @if($member->tikTok)
                                        <!-- TikTok -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <a class="w-100" target="_blank" href="{{ $member->tikTok }}"> <button type="submit" class="btn_cstm tikTok w-100 mt-2"><i class="fa-brands fa-tiktok mx-2"></i>TikTok</button></a>
                                        </div>
                                    @endif

                                    @if($member->whatsApp)
                                        <!-- WhatsApp -->
                                        <div class="col-12 d-flex justify-content-center">
                                             <a class="w-100" target="_blank" href="{{ $member->whatsApp }}"><button type="submit" class="btn_cstm whatsApp w-100 mt-2"><i class="fa-brands fa-whatsapp mx-2"></i>WhatsApp</button></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer"><a style="text-decoration: none; color: white" href="https://innova-webcreations.be">SWAP</a> © {{ now()->format('Y') }}</footer>
                <footer class="footer">
                    <a style="text-decoration: none; color: white" href="{{ asset('/login') }}">Login</a>
                </footer>
            </div>
        </div>
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
