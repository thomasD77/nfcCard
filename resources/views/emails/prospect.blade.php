<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
<div class="container" style="background-color:rgba(63,121,250,0.29)">
    <div class="row">
        <div style="background-color:  #F2F8FE;; margin-left: 150px; margin-right: 150px; padding: 100px">
            <h3>Bekijk hier met wie je een nieuwe connectie hebt gemaakt.</h3>

            @if($contact->name)
                <h3>Naam:</h3>
                <p>{{ $contact->name }}</p>
            @endif

            @if($contact->email)
                <h3>Email:</h3>
                <p>{{ $contact->email }}</p>
            @endif

            @if($contact->phone)
                <h3>Telefoon:</h3>
                <p>{{ $contact->phone }}</p>
            @endif

            @if($contact->message)
                <h3>Bericht:</h3>
                <p>{{ $contact->message }}</p>
            @endif

            <div style="margin-top: 200px">
                <center>
                    © {{ date('Y') }} SWAP. @lang('All rights reserved.')
                </center>
            </div>
        </div>
    </div>
</div>
</body>
</html>

