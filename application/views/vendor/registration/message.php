<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo PROJECT_NAME; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h2 class="text-center"><?php echo PROJECT_NAME; ?> - Vendor Registration</h2>
            <?php if ($id): ?>
                <div class='alert alert-success text-center'>Your're registered successfully. Application is in progress with our CA. We'll let update soon.</div>
            <?php else: ?>
                <div class='alert alert-danger text-center'>Your're registration failed. Please try again.</div>
            <?php endif; ?>
        </div>

    </body>
</html>
