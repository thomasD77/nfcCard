<style>
    .parent {
        position: relative;
    }
    #flash_message {
        position: absolute;
        top: 15px;
        right: 15px;
        opacity: 0.9;
        color: white;
    }
    #flash_message:hover{
        transform: scale(1.1);
        opacity: 1.1;
    }
</style>
<div style="z-index: 99;" id="flash_message">
    @if(Session::has('flash_message'))
        <p class="alert bg-success">{{session('flash_message')}}</p>
    @endif
</div>


<!-- Session Flash Timer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    setTimeout(function() {
        $('#flash_message').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
</script>
