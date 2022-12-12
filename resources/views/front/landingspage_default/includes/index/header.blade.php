<!-- Header Image -->
<div class="header-image">
    @if($profile->state->banner)
        <div class="js-parallax"
             style="background-image: url({{$profile->banner ? asset('/') . $profile->banner->file : asset('assets/front/img/bg-vcard.png')}});"></div>
    @else
        <div class="js-parallax" style="background-image: url({{asset('assets/front/img/bg-vcard.png')}});"></div>
    @endif
</div>
