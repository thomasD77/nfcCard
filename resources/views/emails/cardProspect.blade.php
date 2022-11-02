@component('mail::message')

<h3>{{__('See who you made a new connection with here.')}}</h3>

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

@endcomponent