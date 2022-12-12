<div class="back-to-top"></div>
<!-- JavaScripts -->
<script src="https://www.google.com/recaptcha/api.js?render={{ config('custom.RECAPTCHA_SITE_KEY') }}"></script>
<script>
    grecaptcha.ready(function () {

        grecaptcha.execute('{{ config('custom.RECAPTCHA_SITE_KEY') }}', {action: 'contact'}).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>
<script src="{{ asset('assets/front/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/front/js/common.js') }}"></script>

<!-- Mapbox init -->
<script src="{{ asset('assets/front/js/mapbox.init.js') }}"></script>
<script>
    $('#closemodal').click(function () {
        $('#exampleModal').modal('hide');
    });
    $(document).ready(function () {
        $('#closeNow').click(function () {
            $('#exampleModal').modal('hide');
        });
    });
</script>
<script>
    $('.alert-success').hide();

    $("#to-clipboard").on('click', function (e) {
        let target = $(e.target);
        if (target.hasClass("far fa-copy")) {
            target = $(target).parent();
            var status = true;
        }
        let text = $(target).attr("data-href");
        navigator.clipboard.writeText(text);
        if (status) {
            $('.alert-success').show().delay(2000).fadeOut();
        }
    })
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
