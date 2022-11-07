@component('mail::message')
# Welkom!

Bedankt voor het maken van een <strong>SWAP account</strong>. <br>

Vanaf dit moment kan je vlekkeloos inloggen in je account. <br> Hoe kan je dit doen?
Tik met je Swap kaart op je telefoon. Daarna krijg je het Swap profiel te zien. Onderaan staat een button "login".
<br> Wanneer je hier op klikt word je naar het login scherm gestuurd.

Een andere mogelijkheid is om via onderstaande knop naar de juiste login pagina te gaan.
Handige tip? Wanneer je het profiel aanvult probeer dit te doen via desktop voor je social media links.
<br> Daar moet je steeds de volledige url copy/pasten.

Genoeg informatie! Ben je er klaar voor? <br> Klik dan op onderstaande knop:


@component('mail::button', ['url' => config('custom.GET_BASE_URL') . '/login'])
<strong>SWAP APP</strong>
@endcomponent

<strong>Good to know! Dit is je login link:</strong>
{{ config('custom.GET_BASE_URL') }}

<br>
Thanks,<br>
SWAP TEAM
@endcomponent
