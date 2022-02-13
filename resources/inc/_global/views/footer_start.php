<?php
/**
 * footer_start.php
 *
 * Author: pixelcave
 *
 * All vital JS scripts are included here
 *
 */

use Brian2694\Toastr\Facades\Toastr;

?>

<!--
    OneUI JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="<?php echo $one->assets_folder; ?>/js/oneui.app.js"></script>

<!-- Laravel Toastr -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

