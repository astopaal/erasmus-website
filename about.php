<div class="header-wrapper">
    <?php

    require_once('includes/header.php');

    ?>
</div>

<?php

require_once('pages/aboutcontent.php')
    ?>
<style>
    body {
        margin: 0
    }

    .header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 999;
    }
</style>

<?php
require_once('includes/footer.php');
?>