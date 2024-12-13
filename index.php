<?php
    $query = isset($_GET['query']) ? trim($_GET['query']) : '';
?>
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
    <title>Taste Threads</title>
</head>
<body>
    <!-- !Navigation Bar -->
    <?php require_once 'includes/nav.php'; ?>

    <main>
        <section class="homepage">
            <div class="homeContainer">
                <h1 class="homepageTitle"><span class="logoItalic">Taste</span> Threads</h1>
                <div class="search-bar" id="searchBar"> 
                    <form class="searchForm" action="cusinepage.php" method="get">
                        <input type="text" class="searchInput" placeholder="Search for recipes..." name="query" value="<?php echo htmlspecialchars($query); ?>" required>
                        <button type="submit" class="searchButton">Search</button>
                    </form>
                </div>              
            </div>
        </section>
    </main>

    <!-- !Footer -->
    <?php require_once 'includes/footer.php'; ?>

    <!-- !JavaScript -->
    <script src="assets/tasteThreads.js"></script>
</body>
</html>
