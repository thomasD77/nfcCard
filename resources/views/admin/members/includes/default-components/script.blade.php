
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"
      integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
        integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script>

    /* Banner uploade */
    $("body").on("change", ".banner_id", function (e) {
        let target = $(e.target);
        let files = e.target.files;
        let file = files[0];
        let ext = file.name.split(".")[1];
        let base = "media/banners/";
        let type = "banner";
        let profile = $(target).attr("data-profile");
        if (file.size <= 2097152) {
            if (ext === "jpg" || ext === "JPG" || ext === "JPEG" || ext === "PNG" || ext === "jpeg" || ext === "png") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/image-cropper/upload",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': reader.result,
                            'name': $(target).val(),
                            "base": base,
                            "type": "banner",
                            'profile_id': {{ $profile->id }},
                            "uploadType": 'profile'
                        },
                        success: function (data) {
                            if (data.success === "success") {
                                $("." + type + "-message-" + profile).removeClass("hide-message");
                                $("." + type + "-message-" + profile).removeClass("alert-danger");
                                if (!$("." + type + "-message-" +profile).hasClass('alert-success')) {
                                    $("." + type + "-message-" + profile).toggleClass("alert-success");
                                }
                                $("." + type + "-message-" + profile).text("Successfully updated");
                                $("." + type + "-preview-" + profile).attr("src", "/" + base + data.name);
                                $(target).val('');
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            } else {
                $(target).val('');
                $("." + type + "-message-" + profile).removeClass("hide-message");
                $("." + type + "-message-" + profile).removeClass("alert-success");
                if (!$("." + type + "-message-" + profile).hasClass('alert-danger')) {
                    $("." + type + "-message-" + profile).toggleClass("alert-danger");
                }
                $("." + type + "-message-" + profile).text("Valid types jpg, jpeg and png");
            }
        } else{
            $(target).val('');
            $("." + type + "-message-" + profile).removeClass("hide-message");
            $("." + type + "-message-" + profile).removeClass("alert-success");
            if (!$("." + type + "-message-" + profile).hasClass('alert-danger')) {
                $("." + type + "-message-" + profile).toggleClass("alert-danger");
            }
            $("." + type + "-message-" + profile).text("The image you want to upload is to large");
        }
    });

    /* Logo upload */

    $("body").on("change", ".logo_id", function (e) {
        let target = $(e.target);
        let files = e.target.files;
        let file = files[0];
        let ext = file.name.split(".")[1];
        let base = "media/logos/";
        let type = "logo";
        let profile = $(target).attr("data-profile");
        if (file.size <= 2097152) {
            if (ext === "jpg" || ext === "JPG" || ext === "JPEG" || ext === "PNG" || ext === "jpeg" || ext === "png") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/image-cropper/upload",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': reader.result,
                            'name': $(target).val(),
                            "base": base,
                            "type": type,
                            'profile_id': {{ $profile->id }},
                            "uploadType": 'profile'
                        },
                        success: function (data) {
                            if (data.success === "success") {
                                $("." + type + "-message-" + profile).removeClass("hide-message");
                                $("." + type + "-message-" + profile).removeClass("alert-danger");
                                if (!$("." + type + "-message-" + profile).hasClass('alert-success')) {
                                    $("." + type + "-message-" + profile).toggleClass("alert-success");
                                }
                                $("." + type + "-message-" + profile).text("Successfully updated");
                                $("." + type + "-preview-" + profile).attr("src", "/" + base + data.name);
                                $(target).val('');
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            } else {
                $(target).val('');
                $("." + type + "-message-" + profile).removeClass("hide-message");
                $("." + type + "-message-" + profile).removeClass("alert-success");
                if (!$("." + type + "-message-" + profile).hasClass('alert-danger')) {
                    $("." + type + "-message-" + profile).toggleClass("alert-danger");
                }
                $("." + type + "-message-" + profile).text("Valid types jpg, jpeg and png");
            }
        } else{
            $(target).val('');
            $("." + type + "-message-" + profile).removeClass("hide-message");
            $("." + type + "-message-" + profile).removeClass("alert-success");
            if (!$("." + type + "-message-" + profile).hasClass('alert-danger')) {
                $("." + type + "-message-" + profile).toggleClass("alert-danger");
            }
            $("." + type + "-message-" + profile).text("The image you want to upload is to large");
        }
    });

</script>
