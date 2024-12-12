<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/rsa1ajy.css">
    <link rel="stylesheet" href="assets/tastethreads.css">
    <title>Document</title>
</head>
<body>
    <!-- !Navigation Bar -->
    <?php require_once 'includes/nav.php'; ?>
    
    <section class="pageHeader helpVers">
            <h3>Need Help Navigating?</h3>
    </section>
    <main>
        <section class="helpSection">
            <h1>How To Use Taste Threads</h1>
    
            <section class="accordionItem">
                <h3 class="accordionHeader">
                    <span class="material-icons accordionIcon">remove</span> <!-- Expanded by default -->
                    How do I find a recipe?
                </h3>
                <div class="accordionContent" style="display: block;"> <!-- Default open -->
                    <p>You can search for a recipe via the search bar on both the home pages and within our all recipes page! </p>
                </div>
            </section>
            
            <section class="accordionItem">
                <h3 class="accordionHeader">
                    <span class="material-icons accordionIcon">add</span> <!-- Collapsed by default -->
                    How do I learn more about a recipe?
                </h3>
                <div class="accordionContent">
                    <p>To learn more about a recipe, click on it's recipe card within the <a href="cusinepage.php">recipes</a> page! There you can fin the full recipe along with detailed instructions, ingredients lists and step by step images!</p>
                </div>
            </section>
            
            <section class="accordionItem">
                <h3 class="accordionHeader">
                    <span class="material-icons accordionIcon">add</span> <!-- Collapsed by default -->
                    How do I learn more about Taste Threads?
                </h3>
                <div class="accordionContent">
                    <p>Visit our <a href="about.php">About Us</a> page to learn more about our mission, our story, and our philosophy. You can also follow us on social media to stay up-to-date on the latest recipes, news, and events.</p>
                </div>
            </section>
        </section>
    </main>
    
    <!-- !Footer -->
    <?php require_once 'includes/footer.php'; ?>

    <!-- !JavaScript -->
    <script src="assets/tasteThreads.js"></script>
</body>
</html>