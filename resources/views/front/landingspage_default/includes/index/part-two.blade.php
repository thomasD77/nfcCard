<div class="row">
    <!-- Content -->
    <div class="col-12 col-md-8 mx-auto">
        <div class="box mt-0" id="content">
            <div class="content box mt-0">
                <!-- ABOUT -->
                <div id="about-tab" class="tabcontent active">
                    @if($profile->notes && $profile->state->notes)
                        <div class="pb-0 pb-sm-2">
                            <h1 class="title title--h1 first-title title__separate">About Me</h1>
                            <p> {{ $profile->notes }}</p>
                        </div>
                @endif

                <!-- What -->
                    <div class="mt-1">

                        <div class="row">

                            @if($profile->video && $profile->state->video)
                                <div class="col-12 d-flex justify-content-center my-3">
                                    <video style="width: 100%; height: auto;" controls autoplay muted>
                                        <source src="{{asset('media/videos/' . $profile->video->file)}}"
                                                type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif

                            @if($profile->youtube_video && $profile->state->youtube_video)
                                <div class="col-12 d-flex justify-content-center my-3">
                                    <iframe src="{{ $profile->youtube_video }}?rel=0&amp;autoplay=1&mute=1"
                                            width="560" height="auto" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif

                            @if($profile->website && $profile->state->website)
                            <!-- Website -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="https://{{$profile->website }}">
                                        <button type="submit" class="btn_cstm website w-100 mt-2"><i
                                                class="fa-solid fa-earth-africa mx-2"></i>Website
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->facebook && $profile->state->facebook)
                            <!-- Facebook -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->facebook }}">
                                        <button type="submit" class="btn_cstm facebook w-100 mt-2"><i
                                                class="fa-brands fa-facebook mr-2"></i>Facebook
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->instagram && $profile->state->instagram)
                            <!-- Instagram -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->instagram }}">
                                        <button type="submit" class="btn_cstm instagram w-100 mt-2"><i
                                                class="fa-brands  fa-instagram mx-2"></i>Instagram
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->linkedIn && $profile->state->linkedIn)
                            <!-- LinkedIn -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->linkedIn }}">
                                        <button type="submit" class="btn_cstm w-100 linkedIn mt-2"><i
                                                class="fa-brands  fa-linkedin-in mx-2"></i>LinkedIn
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->twitter && $profile->state->twitter)
                            <!-- Twitter -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->twitter }}">
                                        <button type="submit" class="btn_cstm w-100 twitter mt-2"><i
                                                class="fa-brands  fa-twitter mx-2"></i>Twitter
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->youTube && $profile->state->youTube)
                            <!-- YouTube -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->youTube }}">
                                        <button type="submit" class="w-100 btn_cstm youTube mt-2"><i
                                                class="fa-brands fa-youtube mx-2"></i>YouTube
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->tikTok && $profile->state->tikTok)
                            <!-- TikTok -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->tikTok }}">
                                        <button type="submit" class="btn_cstm tikTok w-100 mt-2"><i
                                                class="fa-brands fa-tiktok mx-2"></i>TikTok
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->whatsApp && $profile->state->whatsApp)
                            <!-- WhatsApp -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank"
                                       href="https://wa.me/{{ $profile->whatsApp }}">
                                        <button type="submit" class="btn_cstm whatsApp w-100 mt-2"><i
                                                class="fa-brands fa-whatsapp mx-2"></i>WhatsApp
                                        </button>
                                    </a>
                                </div>
                            @endif

                            @if($profile->customField && $profile->customText && $profile->state->customField)
                            <!-- Custom -->
                                <div class="col-12 col-lg-6 d-flex justify-content-center">
                                    <a class="w-100" target="_blank" href="{{ $profile->customField }}">
                                        <button type="submit" class="btn_cstm custom w-100 mt-2"><i
                                                class="fa-solid fa-play mx-2"></i>{{ $profile->customText }}
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
                @if($profile->front_style === "dark")
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
                        data-href="{{$profile->memberURL}}"
                        id="to-clipboard">
                    @if($profile->front_style === "dark")
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
