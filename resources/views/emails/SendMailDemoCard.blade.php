@component('mail::message')

<h1>Hallo {{ $user['name'] }},</h1>

Bedankt voor het activeren van jouw Swap demo kaart. <br> Deze heb je kort al eens kunnen testen en gebruiken. <br>
De Swaps die je uitgevoerd hebt zijn niet verloren!

Je kan inloggen tot <strong>{{ $date }} </strong> in het admin panel om je Swaps op te volgen
en/of je profiel te personaliseren. Ontdek daar welke functionaliteiten we allemaal in peto hebben.

Inloggen kan je doen met het e-mail adres die je de eerste keer hebt ingegeven.
Druk hiervoor op de volgende link:

@component('mail::button', ['url' => 'https://portal.swap-nfc.be/login'])
Login here
@endcomponent

Ben je al volledig overtuigd van de kracht die je Swap kaart kan bieden?
Aarzel dan niet langer en bestel je eigen op onze webshop.
Deze kan volledig gepersonaliseerd worden naar wens!

@component('mail::button', ['url' => 'https://swap-nfc.be/shop-swapnfc'])
Webshop
@endcomponent

Thanks,<br>
SWAP NFC
@endcomponent
