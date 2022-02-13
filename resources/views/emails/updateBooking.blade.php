@component('mail::message')

<p>We would like you to know that a booking is updated for you!
    Here is all the information you need to know:</p>

<p><strong><small>Please dubble check your booking DATE & TIMESLOT</small></strong></p>

<p><strong>Date:</strong></p>
<p>{{ $booking['date'] }}</p>

<p><strong>Timeslot:</strong></p>
<p>{{ $booking['startTime'] }}</p>
<p>{{ $booking['endTime'] }}</p>

<p class="mt-2"><strong>Status:</strong></p>
<p>{{ $status['name'] }}</p>

<p><strong>Location:</strong></p>
<p> {{ $location['name'] }}</p>

<p><strong>Services:</strong></p>
@foreach($services as $service)
    <li> {{ $service }} </li>
@endforeach

<p class="mt-2"><strong>Remarks:</strong></p>
<p>{{ $booking['remarks'] }}</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ $company['companyName'] }}
@endcomponent
