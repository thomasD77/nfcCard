
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
    $("body").on("change", "#banner_id", function (e) {
        let target = $(e.target);
        let files = e.target.files;
        let file = files[0];
        let ext = file.name.split(".")[1];
        let base = "media/banners/";
        let type = "banner";
        if (file.size <= 2097152) {
            if (ext === "jpg" || ext === "jpeg" || ext === "png") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/image-cropper/upload",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': reader.result,
                            'name': $("#banner_id").val(),
                            "base": base,
                            "type": "banner",
                            'member_id': {{ $member->id }},
                            "uploadType": 'member'
                        },
                        success: function (data) {
                            if (data.success === "success") {
                                $("." + type + "-message").removeClass("hide-message");
                                $("." + type + "-message").removeClass("alert-danger");
                                if (!$("." + type + "-message").hasClass('alert-success')) {
                                    $("." + type + "-message").toggleClass("alert-success");
                                }
                                $("." + type + "-message").text("Successfully updated");
                                $("." + type + "-preview").attr("src", "/" + base + data.name);
                                $("#" + type + '_id').val('');
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            } else {
                $(target).val('');
                $("." + type + "-message").removeClass("hide-message");
                $("." + type + "-message").removeClass("alert-success");
                if (!$("." + type + "-message").hasClass('alert-danger')) {
                    $("." + type + "-message").toggleClass("alert-danger");
                }
                $("." + type + "-message").text("Valid types jpg, jpeg and png");
            }
        } else{
            $(target).val('');
            $("." + type + "-message").removeClass("hide-message");
            $("." + type + "-message").removeClass("alert-success");
            if (!$("." + type + "-message").hasClass('alert-danger')) {
                $("." + type + "-message").toggleClass("alert-danger");
            }
            $("." + type + "-message").text("The image you want to upload is to large");
        }
    });

    /* Logo upload */

    $("body").on("change", "#logo_id", function (e) {
        let target = $(e.target);
        let files = e.target.files;
        let file = files[0];
        let ext = file.name.split(".")[1];
        let base = "media/logos/";
        let type = "logo";
        if (file.size <= 2097152) {
            if (ext === "jpg" || ext === "jpeg" || ext === "png") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/image-cropper/upload",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': reader.result,
                            'name': $("#logo_id").val(),
                            "base": base,
                            "type": type,
                            'member_id': {{ $member->id }},
                            "uploadType": 'member'
                        },
                        success: function (data) {
                            if (data.success === "success") {
                                $("." + type + "-message").removeClass("hide-message");
                                $("." + type + "-message").removeClass("alert-danger");
                                if (!$("." + type + "-message").hasClass('alert-success')) {
                                    $("." + type + "-message").toggleClass("alert-success");
                                }
                                $("." + type + "-message").text("Successfully updated");
                                $("." + type + "-preview").attr("src", "/" + base + data.name);
                                $("#" + type + '_id').val('');
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            } else {
                $(target).val('');
                $("." + type + "-message").removeClass("hide-message");
                $("." + type + "-message").removeClass("alert-success");
                if (!$("." + type + "-message").hasClass('alert-danger')) {
                    $("." + type + "-message").toggleClass("alert-danger");
                }
                $("." + type + "-message").text("Valid types jpg, jpeg and png");
            }
        } else{
            $(target).val('');
            $("." + type + "-message").removeClass("hide-message");
            $("." + type + "-message").removeClass("alert-success");
            if (!$("." + type + "-message").hasClass('alert-danger')) {
                $("." + type + "-message").toggleClass("alert-danger");
            }
            $("." + type + "-message").text("The image you want to upload is to large");
        }
    });

    /* AVATAR CROPPER */

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    var aspectRatio = 1;
    var type = "avatar";
    $("body").on("change", "#avatar_id", function (e) {
        let target = $(e.target);
        $(".modal-content").addClass($(target).attr('id'));
        if ($(target).attr('id') === "banner_id") {
            aspectRatio = 2;
            type = "banner";
        } else {
            aspectRatio = 1;
            type = "avatar";
        }
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (file.size <= 2097152) {
                let ext = file.name.split(".")[1];
                if (ext === "jpg" || ext === "jpeg" || ext === "png") {
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                } else {
                    $(target).val('');
                    $modal.modal('hide');
                    $(".modal-content").addClass(type + "_id");
                    $("." + type + "-message").removeClass("hide-message");
                    $("." + type + "-message").removeClass("alert-success");
                    if (!$("." + type + "-message").hasClass('alert-danger')) {
                        $("." + type + "-message").toggleClass("alert-danger");
                    }
                    $("." + type + "-message").text("Valid types jpg, jpeg and png");
                }
            } else {
                $(target).val('');
                $modal.modal('hide');
                $(".modal-content").addClass(type + "_id");
                $("." + type + "-message").removeClass("hide-message");
                $("." + type + "-message").removeClass("alert-success");
                if (!$("." + type + "-message").hasClass('alert-danger')) {
                    $("." + type + "-message").toggleClass("alert-danger");
                }
                $("." + type + "-message").text("The image you want to upload is to large");
                //alert('The image you want to upload is to large');
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: aspectRatio,
            viewMode: 5,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        $(".modal-content").removeClass("avatar_id");
        $(".modal-content").removeClass("banner_id");
    });

    $("#crop").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                let base = "card/avatars/";
                if (type === "banner") {
                    base = "media/banners/";
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/image-cropper/upload",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'image': base64data,
                        'name': $("#" + type + "_id").val(),
                        "base": base,
                        "type": type,
                        'member_id': {{ $member->id }},
                        "uploadType": 'member'
                    },
                    success: function (data) {
                        if (data.success === "success") {
                            $modal.modal('hide');
                            $(".modal-content").addClass(type + "_id");
                            $("." + type + "-message").removeClass("hide-message");
                            $("." + type + "-message").removeClass("alert-danger");
                            if (!$("." + type + "-message").hasClass('alert-success')) {
                                $("." + type + "-message").toggleClass("alert-success");
                            }
                            $("." + type + "-message").text("Successfully updated");
                            $("." + type + "-preview").attr("src", "/" + base + data.name);
                            $("#" + type + '_id').val('');
                        } else if (data.success === "no") {
                            $modal.modal('hide');
                            $(".modal-content").addClass(type + "_id");
                            //alert('Valid image types are (.jpg , .png , .jpeg)');
                        }
                    }
                });
            }
            $(".modal-content").removeClass("avatar_id");
            $(".modal-content").removeClass("banner_id");
        });
    })

</script>
