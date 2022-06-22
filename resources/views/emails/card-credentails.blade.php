@component('mail::message')


<h3>Leuke connectie! Bedankt om gegevens met mij uit te wisselen. Graag geef ik hier al mijn details in een mooi
    overzicht.</h3>

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

{{--@if($member['website'] != "")--}}
{{--    <a href="https://{{$member->website }}">--}}
{{--        <img src="{{asset('images/socials/website.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}
@if($member['facebook'] != "")
    <a href="{{ $member['facebook'] }}">
        <img src="{{asset('images/socials/facebook.png')}}" width="80" height="80" alt="">
    </a>
@endif
{{--@if($member['instagram'] != "")--}}
{{--    <a href="{{ $member['instagram'] }}">--}}
{{--        <img src="{{asset('images/socials/instagram.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}
{{--@if($member['linkedIn'] != "")--}}
{{--    <a href="{{ $member['linkedIn'] }}">--}}
{{--        <img src="{{asset('images/socials/linkedin.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}
{{--@if($member['twitter'] != "")--}}
{{--    <a href="{{ $member['twitter'] }}">--}}
{{--        <img src="{{asset('images/socials/twitter.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}
{{--@if($member['tikTok'] != "")--}}
{{--    <a href="{{ $member['tikTok'] }}">--}}
{{--        <img src="{{asset('images/socials/tiktok.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}
{{--@if($member['whatsApp'] != "")--}}
{{--    <a href="https://wa.me/{{ $member->whatsApp }}">--}}
{{--        <img src="{{asset('images/socials/whatsapp.png')}}" width="80" height="80" alt="">--}}
{{--    </a>--}}
{{--@endif--}}






<h3 style="margin-top: 80px; margin-bottom: 5px">Aarzel niet om mij te contacteren! </h3>
<h3>Graag tot binnenkort. </h3>


@endcomponent

