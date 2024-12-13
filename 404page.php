<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/rsa1ajy.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="assets/tastethreads.css">
    <title>404 Page</title>
</head>
<body>
    <!-- !Navigation Bar -->
    <?php require_once 'includes/nav.php'; ?>

    <main>
        <section class="errorPage">
            <div class="errorContainer">
                <h1>Oh! No! We didn't find the recipe you were looking for! Try rephrasing your search.</h1>
                <a href="cusinepage.php">
                    <span class="searchButton">Go Back</span>
                </a>
            </div>
        </section>
    </main>

    <!-- !Footer -->
    <?php require_once 'includes/footer.php'; ?>

    <!-- !JavaScript -->
    <script src="assets/tasteThreads.js"></script>
</body>
</html>