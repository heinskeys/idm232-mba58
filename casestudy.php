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
    <title>Case Study</title>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include 'includes/nav.php'; ?>

    <!-- Main Content -->
    <main>

        <section class="pageHeader recipeVers">
            <h3>Taste Threads - IDM232 Final Project</h3>
        </section>

        <section class="case-study">
            <h2 class="aboutDesc">Overview</h2>
            <p>For my <strong>IDM232 Final Project</strong>, I created a custom web application called <strong>Taste Threads</strong>, an online cookbook focused on weaving together recipes influenced by different cultures. The goal was to design the website in a semi-material design style with a whimsical early-web feel.I also focused on developing a robust text search system, which was a crucial aspect of the final build.</p>
            
            <h2 class="aboutDesc">Context & Challenge</h2>

            <p>I first started this project by developing high-fidelity wireframes. I struggled a lot with the design because I had many ideas I wanted to explore, but none of them worked out when I tried to implement them. This was challenging for me because much of my passion for projects comes from creating something that looks good and inspires me to code. It was tough to design something that was simple enough to code in PHP—a language I had never explored before—while also being visually interesting.</p>

            <p>Eventually, I drew inspiration from the <strong>Material Design System</strong>, particularly a case study Google released about testing material design within a food app. This heavily influenced my branding. I used it as a base while also adding my own visual elements, and I really liked the color palette they developed. This led to the development of wireframes, which you can see below.</p>

            <div class="case-study-images">
                <img src="assets/images/cs-Image-Treatment.png" alt="">
                <img src="assets/images/cs-Taste-Threads-Home.png" alt="">
                <img src="assets/images/cs-Recipe.png" alt="">
            </div>
            
            <h2 class="aboutDesc">Development Process</h2>

            <p>Next, I began the development process. For the pure HTML, CSS, and JavaScript version of the site, I wanted to prioritize using grid instead of flexbox. I almost exclusively use flexbox, but I often run into formatting issues later because I don’t always account for how interactions between flex containers might break over time. Using grid allowed me to create a structure that easily adapted to mobile formats and maintained a consistent layout.</p>

            <p>I spent the first few weeks of the project working on branding and the initial HTML, CSS, and JavaScript code before moving on to PHP development. Most of my time was spent figuring out how to properly set up my database in PHPMyAdmin. It took a lot of trial and error to go from working with an Excel file to having a database that could fetch and display content on my website.</p>

            <p>One major challenge, for example, was working with the class created file for images. The file used descriptive formats and folders unique to each recipe, which ended up making my PHP code difficult to loop. I spent several hours trying to develop code or edit some parts of the naming convention to make it work. Evenetually, I found it much easier to rename all the images with consistent simplified naming conventions, where the folder matched the recipe ID (e.g., 1, 2, 3, etc.) and each image itself had the same name (i.e hero image, step 1, step 2, ingedients). This approach made it easier inserting images into the database and ensured they were fetched correctly.</p>

            <p>Once the database was set up, the PHP coding process wasn’t too difficult, thanks to the helpful examples from class (thanks, Phil!). The main challenge actually ended up being in the development of a more robust search system. I wasn't really interested in adding complex filters to the site, but I did want the <strong>search to function like those on popular websites, where users can make mistakes or input vague terms and still get relevant results</strong>.</p>

            <p>This required a lot of adjustments to my PHP code and database, in order to add <strong>full-text index searching</strong>. This allowed users to search for terms like “30 minutes,” “4 servings,” “Asian,” or even specific ingredients, and still get meaningful results. For example, ordinarily users would search “4” and it would show recipes with four servings but if they added the word "servings" it would show up with no results. This is because in my database the servings are an integer and the word servings is concatanated on (much like with cook time). However, in integrating full-text index searching, users can search "4 servings" or "Asian Cuisine" or "30 mins" and it wouldn’t break the search.</p>

            <p>I also experimented with incorporating <strong>Levenshtein distance</strong> to account for spelling errors, but it was too advanced for me to implement fully. Still, the search is much more robust than before, which was my main goal.</p>

            <p>I also added a few filters toward the end, but I’m especially proud of how the search mechanism turned out!</p>
            
            <h2 class="aboutDesc">Results & Reflection</h2>

            <div class="case-study-links">
                <a href="index.php" class="case-study-link">View Project</a>
                <a href="https://github.com/heinskeys/idm232-mba58/tree/php-version" class="case-study-link">Github</a>
            </div>


            <p>In the end, the project turned out exactly as I envisioned: a <strong>dynamic, functional recipe website</strong> with a <strong>robust search feature</strong>. The search system works well, even if the user enters vague or incorrect terms. While I initially struggled with the design and PHP coding, I’m happy with how it all came together. The design blends modern principles with a bit of whimsy, and the back-end functionality works as intended.</p>
            <p>The project also taught me a lot about integrating <strong>PHP</strong> and <strong>MySQL</strong>, and I’m particularly proud of the search system, which turned out to be more advanced than I had initially expected. In the future, I’d love to continue improving the search feature and potentially add more complex functionality, like user accounts or personalized recipe recommendations.</p>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>