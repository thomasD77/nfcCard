<script src="{{ asset('js/oneui.app.js') }}"></script>

<!-- Laravel Scaffolding JS -->
<!-- <script src="{{ asset('/js/laravel.app.js') }}"></script> -->

@yield('js_after')

@livewireScripts

<!-- Laravel Toastr -->
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<!-- Session Flash Timer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $('.alert-success').hide();

    setTimeout(function() {
        $('#flash_message').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
</script>

<script>
    $('.alert-success').hide();

    $("#to-clipboard").on('click', function(e){
        let target = $(e.target);
        if(target.hasClass("far fa-copy")){
            target = $(target).parent();
            var status = true;
        }
        let text = $(target).attr("data-href");
        navigator.clipboard.writeText(text);
        if(status) {
            $('.alert-success').show().delay(2000).fadeOut();
        }
    })
</script>
