@component('mail::message')

<h3>Bekijk hier met wie je een nieuwe connectie hebt gemaakt.</h3>

@if($contact['name'] != "")
<h3>Naam:</h3>
<p>{{ $contact['name'] }}</p>
@endif

@if($contact['email'] != "")
<h3>Email:</h3>
<p>{{ $contact['email'] }}</p>
@endif

@if($contact['phone'] != "")
<h3>Phone:</h3>
<p>{{ $contact['phone'] }}</p>
@endif

@if($contact['message'] != "")
<h3>Message:</h3>
<p>{{ $contact['message'] }}</p>
@endif

@component('mail::button', ['url' => 'https://portal.swap-nfc.be/login'])
    <strong>SWAP APP</strong>
@endcomponent

@endcomponent
