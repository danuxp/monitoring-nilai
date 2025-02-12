<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="text-center mt-5">
        <div class="error-box">
            <h1>404</h1>
            <h3><i class="fa fa-warning"></i> Oops! Page not found!</h3>
            <p>The page you requested was not found.</p>
            <a href="<?= previous_url(); ?>" class="btn btn-primary go-home">Go to Home</a>
        </div>
    </div>

</body>

</html>