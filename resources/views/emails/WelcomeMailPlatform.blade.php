@component('mail::message')
# Welcome!

Thank you for creating your <strong>SWAP account</strong>.We are very excited to have you on board! <br>

From this moment when you use your <strong>SWAP CARD</strong> you will be redirected to your profile.
You can use this any time on you phone. <br>
To complete some information it comes handy to use a desktop computer. <br>
That's why we send you this link. Use the button bellow to access your <strong>SWAP APPLICATION</strong>

@component('mail::button', ['url' => 'https://portal.swap-nfc.be/login'])
<strong>SWAP APP</strong>
@endcomponent

<strong>The full link you can find here: https://portal.swap-nfc.be</strong>

<br>
Thanks,<br>
SWAP TEAM
@endcomponent
