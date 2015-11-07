<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link href="/public/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php $this->partial('app/views/themes/inspinia/sidebar.php'); ?>
        <div id="page-wrapper" class="white-bg">
            <?php $this->partial('app/views/themes/inspinia/menu.php'); ?>
            <?php $this->yieldView(); ?>
            <div class="clearfix"></div>
            <div class="top10">&nbsp;</div>
            <div class="top10">&nbsp;</div>
            <div class="top10">&nbsp;</div>
            <div class="clearfix"></div>
            <?php $this->partial('app/views/themes/inspinia/footer.php'); ?>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="/public/js/script.js"></script>
    <script>
    // Add Toast Notification session based
    <?php if (isset($_SESSION['message'])) { ?>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    showDuration: 400,
                    hideDuration: 1000,
                    extendedTimeOut: 1000,
                    showEasing: 'swing',
                    hideEasing: 'linear',
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 7000
                };
                toastr.<?php echo $_SESSION['alert'] ?>('<?php echo $_SESSION['message'] ?>');
            }, 1300);
        });
    <?php
        unset($_SESSION['alert']);
        unset($_SESSION['message']);
    } ?>
    </script>
</body>
</html>
