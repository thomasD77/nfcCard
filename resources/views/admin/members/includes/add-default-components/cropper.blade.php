<script>
    /* AVATAR CROPPER */

    var profile = "{{$profile->id}}";
    profile = profile.replace(' ', '');
    var $modal = $('#modal-' + profile);
    var image = document.getElementById('image-' + profile);
    var cropper;
    var aspectRatio = 1;
    $("body").on("change", ".avatar_id-" +profile, function (e) {
        let target = $(e.target);
        $(".modal-content").addClass($(target).attr('id'));
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
                if (ext === "jpg" || ext === "JPG" || ext === "JPEG" || ext === "PNG" || ext === "jpeg" || ext === "png") {
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
                    $(".avatar-message-" + profile).removeClass("hide-message");
                    $(".avatar-message-" + profile).removeClass("alert-success");
                    if (!$(".avatar-message-" + profile).hasClass('alert-danger')) {
                        $(".avatar-message-" + profile).toggleClass("alert-danger");
                    }
                    $(".avatar-message-" + profile).text("Valid types jpg, jpeg and png");
                }
            } else {
                $(target).val('');
                $modal.modal('hide');
                $(".modal-content").addClass(type + "_id");
                $(".avatar-message-" + profile).removeClass("hide-message");
                $(".avatar-message-" + profile).removeClass("alert-success");
                if (!$(".avatar-message-" + profile).hasClass('alert-danger')) {
                    $(".avatar-message-" + profile).toggleClass("alert-danger");
                }
                $(".avatar-message-" + profile).text("The image you want to upload is to large");
                //alert('The image you want to upload is to large');
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: aspectRatio,
            viewMode: 5,
            preview: '#preview-' + profile
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop-"+profile).click(function () {
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
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/image-cropper/upload",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'image': base64data,
                        'name': $("#avatar_id-" + profile).val(),
                        "base": base,
                        "type": "avatar",
                        'profile_id': {{ $profile->id }},
                        "uploadType": 'profile'
                    },
                    success: function (data) {
                        if (data.success === "success") {
                            $modal.modal('hide');
                            $(".avatar-message-" + profile).removeClass("hide-message");
                            $(".avatar-message-" + profile).removeClass("alert-danger");
                            if (!$(".avatar-message-" + profile).hasClass('alert-success')) {
                                $(".avatar-message-" + profile).toggleClass("alert-success");
                            }
                            $(".avatar-message-" + profile).text("Successfully updated");
                            $(".avatar-preview-" + profile).attr("src", "/" + base + data.name);
                            $(target).val('');
                        } else if (data.success === "no") {
                            $modal.modal('hide');
                            //alert('Valid image types are (.jpg , .png , .jpeg)');
                        }
                    }
                });
            }
        });
    });
</script>
