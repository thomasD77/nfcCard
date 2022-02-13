<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/highlightjs/styles/atom-one-dark.css'); ?>


<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
    <div class="content content-full text-center pt-7 pb-5">
        <h1 class="h2 text-white mb-2">
            Components
        </h1>
        <h2 class="h4 fw-normal text-white-75">
            Here you can Build & Change the Components!
        </h2>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-body-extra-light">
    <div class="content">
        <div class="row items-push justify-content-center">

            <section>
                <h2>Google Maps</h2>
                <p class="my-1">We search for address in Google Maps, click the "share" button.</p>
                <p class="my-1">We can choose the option "Embed a map". Copy this iframe HTML code in your project.</p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2515.1628446178706!2d3.201859651658176!3d50.92070456114867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c337734b4e039f%3A0x7afc46a51ccc3b5b!2sRoeselaarsestraat%20214%2C%208870%20Izegem!5e0!3m2!1sen!2sbe!4v1632469803441!5m2!1sen!2sbe"
                    width="1000" height="550" style="border:0;" allowfullscreen="" loading="lazy" class="mt-3">
                </iframe>
            </section>

            <section class="my-3">
                <style>
                    #social a{
                        font-size: 1rem;
                        color: white;
                        width: 2rem;
                        height: 2rem;
                        background: rgb(0, 71, 141);
                    }
                    #social a:hover{
                        background: white;
                        color: rgb(0, 71, 141);
                        font-size: 1.3rem;
                    }
                    #social p {
                        font-family: RobotoRegular;
                        font-size: 0.8rem;
                    }
                </style>

                <h2 class="mt-5 mb-2">Social Media Buttons with Share link</h2>

                <div id="social" class="d-flex align-items-center">
                    <p class="mb-0">Share this:</p>

                    <a class="d-flex justify-content-center align-items-center rounded mx-1"
                       href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&display=popup" target="_blank"><i
                            class="fab fa-facebook-f" id="facebook"></i></a>

                    <a class="d-flex justify-content-center align-items-center rounded mx-1"
                       href="https://twitter.com/intent/tweet?text=my share text&url={{Request::url()}}" target="_blank"><i
                            class="fab fa-twitter"></i></a>

                    <a class="d-flex justify-content-center align-items-center rounded mx-1"
                       href="http://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&title=my share text&summary=dit is de linkedin summary" target="_blank"><i
                            class="fab fa-linkedin"></i></a>

                    <a class="d-flex justify-content-center align-items-center rounded mx-1"
                       href="https://wa.me/?text={{Request::url()}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </div>

            </section>

            <section>

                <h2 class="my-5">Here you find the pop-up code</h2>
                <style type="text/css">
                    body,h1,h2,p{
                        margin: 0px;
                        padding: 0px;
                    }
                    .container{
                        width:800px;
                        margin: 0px auto;
                        text-align: justify;
                    }
                    #main{
                        width: 100%;
                        height: 100vh;
                        background: #0008;
                        position: absolute;
                        top: 0;
                        left: 0;
                        display: none;
                    }
                    #pop-up{
                        text-align: center;
                        background: #ffffff;
                        box-sizing: border-box;
                        padding: 20px;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%,-50%);
                    }
                </style>
                <div id="main">
                    <div id="pop-up">
                        <div class="modal-header d-flex justify-content-between">
                            <h1>This is our title.</h1>
                            <button id='close-btn' class="btn btn-dark"><i class="fa fa-window-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque deleniti ratione ab quos, ad
                                tempora, qui rem in debitis. Officiis aperiam quisquam eum explicabo recusandae officia commodi
                                consequuntur pariatur, voluptate hic inventore quidem necessitatibus laudantium labore eaque
                                reprehenderit animi et!</p>
                        </div>
                        <div class="modal-footer mb-3">
                            Here we ask for action
                        </div>
                    </div>
                </div>

                <!-- jquery cdn for POPUP -->
{{--                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
                {{--    Javascript for POPUP--}}
                <script src="{{ asset('js/plugins/popup/popup.js') }}"></script>

            </section>


        </div>
</div>
<!-- END Page Content -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>

