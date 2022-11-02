@component('mail::message')


<h3>{{__('Nice connection! Thanks for exchanging data with me. Happy to provide all my details here in a nice overview.')}}</h3>

@if($member['firstname'] != "")
<h3>Voornaam:</h3>
<p>{{ $member['firstname'] }}</p>
@endif

@if($member['lastname'] != "")
<h3>Naam:</h3>
<p>{{ $member['lastname'] }}</p>
@endif

@if($member['mobileWork'] != "")
<h3>Telefoon:</h3>
<p>{{ $member['mobileWork'] }}</p>
@endif

@if($member['email'] != "")
<h3>Email:</h3>
<p>{{ $member['email'] }}</p>
@endif

@if($member['jobTitle'] != "")
<h3>Functie:</h3>
<p>{{ $member['jobTitle'] }}</p>
@endif

@if($member['company'] != "")
<h3>Bedrijf:</h3>
<p>{{ $member['company'] }}</p>
@endif



<div>
    @if($member['website'] != "")
        <a href="https://{{$member->website }}">
            <img src="{{asset('images/socials/website.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>

<div>
    @if($member['facebook'] != "")
        <a href="{{ $member['facebook'] }}">
            <img src="{{asset('images/socials/facebook.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>
<div>
    @if($member['instagram'] != "")
        <a href="{{ $member['instagram'] }}">
            <img src="{{asset('images/socials/instagram.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>
<div>@if($member['linkedIn'] != "")
        <a href="{{ $member['linkedIn'] }}">
            <img src="{{asset('images/socials/linkedin.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>
<div>
    @if($member['twitter'] != "")
        <a href="{{ $member['twitter'] }}">
            <img src="{{asset('images/socials/twitter.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>
<div>
    @if($member['tikTok'] != "")
        <a href="{{ $member['tikTok'] }}">
            <img src="{{asset('images/socials/tiktok.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>
<div>
    @if($member['whatsApp'] != "")
        <a href="https://wa.me/{{ $member->whatsApp }}">
            <img src="{{asset('images/socials/whatsapp.png')}}" width="40" height="40" alt="">
        </a>
    @endif
</div>











<h3 style="margin-top: 40px; margin-bottom: 5px">{{__('Please do not hesitate to contact me!')}} </h3>
<h3>{{__('Graag tot binnenkort.')}} </h3>


@endcomponent

