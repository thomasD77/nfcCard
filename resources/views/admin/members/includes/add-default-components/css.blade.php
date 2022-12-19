<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .hide-message {
        display: none;
    }

    .preview {
        overflow: hidden;
        width: 200px;
        height: 200px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-body .preview {
        border-radius: 50%;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .avatar_id .cropper-face {
        border-radius: 50%;
        border: 5px dotted black;
    }

    .avatar_id .cropper-container.cropper-bg .cropper-crop-box, .cropper-view-box {
        border-radius: 50%;
    }

    .avatar_id .cropper-view-box {
        box-shadow: 0 0 0 1px #39f;
        outline: 0 !important;
    }

    /** Slider Styling **/

    .slider {
        border: none;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width: 125px;
    }

    .slider-checkbox {
        display: none;
    }

    .slider-label {
        border: 2px solid #666;
        border-radius: 20px;
        cursor: pointer;
        display: block;
        overflow: hidden;
    }

    .slider-inner {
        display: block;
        margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
        width: 200%;
    }

    .slider-inner:before,
    .slider-inner:after {
        box-sizing: border-box;
        display: block;
        float: left;
        font-family: sans-serif;
        font-size: 14px;
        font-weight: bold;
        height: 30px;
        line-height: 30px;
        padding: 0;
        width: 50%;
    }

    .slider-inner:before {
        background-color: #23262B;
        color: #fff;
        content: "DARK";
        padding-left: .75em;
    }

    .slider-inner:after {
        background-color: transparent;
        color: #666;
        content: "LIGHT";
        padding-right: .75em;
        text-align: right;
    }

    .slider-circle {
        background-color: #23262B;
        border: 2px solid #666;
        border-radius: 20px;
        bottom: 0;
        display: block;
        margin: 5px;
        position: absolute;
        right: 91px;
        top: 0;
        transition: all 0.3s ease-in 0s;
        width: 20px;
    }

    .slider-checkbox:checked + .slider-label .slider-inner {
        margin-left: 0;
    }

    .slider-checkbox:checked + .slider-label .slider-circle {
        background-color: white;
        right: 0;
    }

    .slider-profile {
        border: none;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width: 125px;
    }

    .slider-checkbox-profile {
        display: none;
    }

    .slider-label-profile {
        border: 2px solid #666;
        border-radius: 20px;
        cursor: pointer;
        display: block;
        overflow: hidden;
    }

    .slider-inner-profile {
        display: block;
        margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
        width: 200%;
    }

    .slider-inner-profile:before,
    .slider-inner-profile:after {
        box-sizing: border-box;
        display: block;
        float: left;
        font-family: sans-serif;
        font-size: 14px;
        font-weight: bold;
        height: 30px;
        line-height: 30px;
        padding: 0;
        width: 50%;
    }

    .slider-inner-profile:before {
        background-color: green;
        color: #ffffff;
        content: "ACTIVE";
        padding-left: .75em;
    }

    .slider-inner-profile:after {
        background-color: transparent;
        color: black;
        content: "UNACTIVE";
        padding-right: .75em;
        text-align: right;
    }

    .slider-circle-profile {
        background-color: green;
        border: 2px solid #666;
        border-radius: 20px;
        bottom: 0;
        display: block;
        margin: 5px;
        position: absolute;
        right: 91px;
        top: 0;
        transition: all 0.3s ease-in 0s;
        width: 20px;
    }

    .slider-checkbox-profile:checked + .slider-label-profile .slider-inner-profile {
        margin-left: 0;
    }

    .slider-checkbox-profile:checked + .slider-label-profile .slider-circle-profile {
        background-color: #ffffff;
        right: 0;
    }
</style>
