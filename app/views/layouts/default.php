<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
    <link href="/public/css/style.min.css" rel="stylesheet">
</head>
<body>
    <?php
    /**
     * Page Content
     */
    $this->yieldView(); ?>

    <?php
    /**
     * Footer
     */
    //$this->partial('app/views/layouts/partials/footer.php'); ?>

    <script src="/public/js/script.js"></script>
</body>
</html>
