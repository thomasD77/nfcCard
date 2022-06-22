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


@if($member['facebook'] != "")
<a href="{{ $member['facebook'] }}">
    <img src="{{asset('images/socials/facebook.png')}}" width="50" height="50" alt="">
</a>
@endif







<h3 style="margin-top: 80px; margin-bottom: 5px">Aarzel niet om mij te contacteren! </h3>
<h3>Graag tot binnenkort. </h3>


@endcomponent

