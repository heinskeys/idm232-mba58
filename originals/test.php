<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/rsa1ajy.css">
    <link rel="stylesheet" href="assets/tastethreads.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    $servername = "localhost"; // Or the server IP
    $username = "root";
    $password = "root";
    $database = "idm232"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `title`, `subtitle`, `cuisine`, `cook time`, `servings`, `main image`, `description`, `ingredients`, `steps` FROM `idm232_recipies_test` WHERE id=1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($recipe = $result->fetch_assoc()) {
    ?>

    <main>
        <!-- Recipe Image -->
        <section class="recipeHeader">
            <div class="recipeImage">
                <img src="<?php echo htmlspecialchars($recipe['main image']); ?>" alt="Image of <?php echo htmlspecialchars($recipe['title']); ?>">
            </div>

            <!-- Recipe Meta -->
            <div class="recipeInfo">
                <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>
                <h3><?php echo htmlspecialchars($recipe['subtitle']); ?></h3>
                <hr>
                <div class="recipeMeta">
                    <div class="metaItem">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                            <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                        </svg>                      
                        <?php echo htmlspecialchars($recipe['cook time']); ?> mins
                    </div>
                    <div class="metaItem">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                            <path d="M240-80v-366q-54-14-87-57t-33-97v-280h80v240h40v-240h80v240h40v-240h80v280q0 54-33 97t-87 57v366h-80Zm400 0v-381q-54-18-87-75.5T520-667q0-89 47-151t113-62q66 0 113 62.5T840-666q0 73-33 130t-87 75v381h-80Z"/>
                        </svg>
                        <?php echo htmlspecialchars($recipe['cuisine']); ?>
                    </div>
                    <div class="metaItem">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                            <path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67ZM160-160v-100q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.34 45.17 30.33 14.33 48.83 41.83T800-260v100H160Z"/>
                        </svg>
                        <?php echo htmlspecialchars($recipe['servings']) . ' servings'; ?>
                    </div>
                </div>
                <p><?php echo htmlspecialchars($recipe['description']); ?></p>
            </div>
        </section>

        <!-- Color Block -->
        <div class="recipeBorder"></div>

        <!-- Recipe Ingredients List -->
        <section class="recipeContent">
            <section class="ingredients">
                <h4>Ingredients</h4>
                <hr>
                <!-- Placeholder content -->
                <ul class="ingredientsList">
                    <?php 
                        if (!empty($recipe['ingredients'])) {
                            $ingredients = preg_split('/,\s*|\r\n|\r|\n/', $recipe['ingredients']); 
                            foreach ($ingredients as $ingredient) :
                                if (!empty($ingredient)) : ?>
                                    <li><?= htmlspecialchars(trim($ingredient)) ?></li>
                                <?php endif; 
                            endforeach; 
                        } else {
                            echo "<li>No ingredients listed.</li>";
                        }
                    ?>
                </ul>

                <!-- <ul class="ingredientsList">
                    <li>Ingredient 1</li>
                    <li>Ingredient 2</li>
                    <li>Ingredient 3</li>
                </ul> -->
            </section>
            <!-- Recipe Steps -->
            <section class="steps">
                <h4>Preparation</h4>
                <hr>
                <ul class="stepList">
                    <?php
                        if (!empty($recipe['steps'])) {
                            // Split steps by '*'
                            $steps = explode('*', $recipe['steps']);
                            
                            foreach ($steps as $step) {
                                // Split each step into title and instruction by '--'
                                $stepParts = explode('--', $step);
                                
                                if (count($stepParts) === 2) {
                                    // Trim the step title and instruction to avoid any unwanted whitespace
                                    $stepTitle = trim($stepParts[0]);
                                    $stepInstruction = trim($stepParts[1]);
                                    ?>
                                    <li>
                                        <h5><?php echo htmlspecialchars($stepTitle); ?></h5>
                                        <p><?php echo htmlspecialchars($stepInstruction); ?></p>
                                    </li>
                                    <?php
                                }
                            }
                        } else {
                            echo "<li>No preparation steps available.</li>";
                        }
                    ?>
                </ul>

            </section>
        </section>
    </main>

<?php
    }
} else {
    echo "No recipes found.";
}

// Fetch recipes from database
$sql = "SELECT `title`, `subtitle`, `cuisine`, `cook time`, `servings`, `main image` FROM `idm232_recipies_test` WHERE cuisine = 'Mexican'"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Use a loop to iterate over each row
    while($recipe = $result->fetch_assoc()) {
?>
        <div class="recipeCard">
            <!-- Recipe Image -->
            <img src="<?php echo htmlspecialchars($recipe['main image']); ?>" alt="Image of <?php echo htmlspecialchars($recipe['title']); ?>">
            
            <!-- Recipe Title and Subtitle -->
            <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>
            <h3><?php echo htmlspecialchars($recipe['subtitle']); ?></h3>
            
            <!-- Recipe Meta Section -->
            <div class="recipeMeta">
                <!-- Cook Time -->
                <div class="metaItem">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                        <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                    </svg>
                    <?php echo htmlspecialchars($recipe['cook time']); ?> mins
                </div>
                
                <!-- Cuisine -->
                <div class="metaItem">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                        <path d="M240-80v-366q-54-14-87-57t-33-97v-280h80v240h40v-240h80v240h40v-240h80v280q0 54-33 97t-87 57v366h-80Zm400 0v-381q-54-18-87-75.5T520-667q0-89 47-151t113-62q66 0 113 62.5T840-666q0 73-33 130t-87 75v381h-80Z"/>
                    </svg>
                    <?php echo htmlspecialchars($recipe['cuisine']); ?>
                </div>
                
                <!-- Serving Size -->
                <div class="metaItem">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                        <path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67ZM160-160v-100q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.34 45.17 30.33 14.33 48.83 41.83T800-260v100H160Z"/>
                    </svg>
                    <?php echo htmlspecialchars($recipe['servings']) . ' servings'; ?>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "No recipes found.";
}
$conn->close();
?>
</body>
</html>

