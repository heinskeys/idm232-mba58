<?php
    require_once 'includes/db.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    $serving_sizes = isset($_GET['servings']) ? (array)$_GET['servings'] : [];
    $cook_time_ranges = isset($_GET['cook_time']) ? (array)$_GET['cook_time'] : [];
    $cuisines = isset($_GET['cuisine']) ? (array)$_GET['cuisine'] : [];    

    // Base SQL query for $query (search text)
    $sql = "
        SELECT `id`, `title`, `subtitle`, `cuisine`, `cook time`, `servings`, `description`, `ingredients`, `steps`, `main image`, `ingredients image`, `step images`
        FROM `idm232_recipies_test`
        WHERE 1 = 1
    ";

    // Parameters and types for prepared statement
    $params = [];
    $types = "";

    // If there is a search query, add it to the WHERE clause
    if ($query) {
        if (is_numeric($query)) {
            $sql .= " AND (`servings` = ? OR `cook time` = ?)";
            $params[] = $query;
            $params[] = $query;
            $types .= "ii";  // Two integers
        } elseif (preg_match('/(\d+)\s*(servings|min)/i', $query, $matches)) {
            $number = $matches[1];
            $keyword = strtolower($matches[2]);
            
            if ($keyword == 'servings') {
                $sql .= " AND `servings` = ?";
                $params[] = $number;
                $types .= "i";
            } elseif ($keyword == 'min') {
                $sql .= " AND `cook time` = ?";
                $params[] = $number;
                $types .= "i";
            }
        } else {
            $sql .= " AND MATCH(`title`, `cuisine`, `description`, `ingredients`, `steps`) AGAINST (? IN NATURAL LANGUAGE MODE)";
            $params[] = $query;
            $types .= "s";
        }
    }

    // Filter by cuisines (if selected)
    if (!empty($cuisines)) {
        $placeholders = implode(',', array_fill(0, count($cuisines), '?'));
        $sql .= " AND `cuisine` IN ($placeholders)";
        $params = array_merge($params, $cuisines);
        $types .= str_repeat('s', count($cuisines));
    }

    // Filter by cook time ranges (if selected)
    if (!empty($cook_time_ranges)) {
        $sql .= " AND (";
        $time_conditions = [];
        foreach ($cook_time_ranges as $range) {
            [$min_time, $max_time] = explode('-', $range);
            $time_conditions[] = "(`cook time` BETWEEN ? AND ?)";
            $params[] = intval($min_time);
            $params[] = intval($max_time);
            $types .= "ii";
        }
        $sql .= implode(' OR ', $time_conditions) . ")";
    }

    // Filter by serving sizes (if selected)
    if (!empty($serving_sizes)) {
        $placeholders = implode(',', array_fill(0, count($serving_sizes), '?'));
        $sql .= " AND `servings` IN ($placeholders)";
        $params = array_merge($params, array_map('intval', $serving_sizes));
        $types .= str_repeat('i', count($serving_sizes));
    }

    // Prepare and execute the statement
    $stmt = $connection->prepare($sql);

    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Render recipes if there are results
    } else {
        // Send the 404 header immediately
        header("HTTP/1.0 404 Not Found");
        header("Location: 404page.php");  // Redirect to 404 page
        exit;  // Terminate the script execution immediately
    }
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
    <link rel="stylesheet" href="assets/tastethreads.css">
    <title>Our Recipes</title>
</head>
<body>
    <!-- !Navigation Bar -->
    <?php require_once 'includes/nav.php'; ?>

    <main>
        <section class="pageHeader recipeVers">
            <h3>Our Recipes</h3>
            <div class="search-bar" id="searchBar"> 
                <form class="searchForm" action="cusinepage.php" method="get">
                    <input type="text" class="searchInput" placeholder="Search for recipes..." name="query" value="<?php echo htmlspecialchars($query); ?>" required>
                    <button type="submit" class="searchButton">Search</button>
                </form>
            </div>
        </section>
        <section class="filterContent">
            <!-- !Filters -->
            <section class="filterList">
                <form class="searchForm" action="cusinepage.php" method="get">
                        <!-- Cuisine Filter -->
                    <div class="cuisineFilter filter">
                        <div class="filterName">Cuisine Type</div>
                        <div class="filterLabels">
                        <label><input type="checkbox" name="cuisine[]" value="Mexican" <?php if (isset($_GET['cuisine']) && in_array('Mexican', $_GET['cuisine'])) echo 'checked'; ?>> Mexican</label>
                        <label><input type="checkbox" name="cuisine[]" value="French" <?php if (isset($_GET['cuisine']) && in_array('French', $_GET['cuisine'])) echo 'checked'; ?>> French</label>
                        <label><input type="checkbox" name="cuisine[]" value="Italian" <?php if (isset($_GET['cuisine']) && in_array('Italian', $_GET['cuisine'])) echo 'checked'; ?>> Italian</label>
                        <label><input type="checkbox" name="cuisine[]" value="American" <?php if (isset($_GET['cuisine']) && in_array('American', $_GET['cuisine'])) echo 'checked'; ?>> American</label>
                        <label><input type="checkbox" name="cuisine[]" value="Asian" <?php if (isset($_GET['cuisine']) && in_array('Asian', $_GET['cuisine'])) echo 'checked'; ?>> Asian</label>
                        <label><input type="checkbox" name="cuisine[]" value="Middle Eastern" <?php if (isset($_GET['cuisine']) && in_array('Middle Eastern', $_GET['cuisine'])) echo 'checked'; ?>> Middle Eastern</label>
                        <label><input type="checkbox" name="cuisine[]" value="Mediterranean" <?php if (isset($_GET['cuisine']) && in_array('Mediterranean', $_GET['cuisine'])) echo 'checked'; ?>> Mediterranean</label>
                        <label><input type="checkbox" name="cuisine[]" value="Indian" <?php if (isset($_GET['cuisine']) && in_array('Indian', $_GET['cuisine'])) echo 'checked'; ?>> Indian</label>
                        <label><input type="checkbox" name="cuisine[]" value="Korean" <?php if (isset($_GET['cuisine']) && in_array('Korean', $_GET['cuisine'])) echo 'checked'; ?>> Korean</label>
                        <label><input type="checkbox" name="cuisine[]" value="Thai" <?php if (isset($_GET['cuisine']) && in_array('Thai', $_GET['cuisine'])) echo 'checked'; ?>> Thai</label>
                        </div>
                    </div>

                    <!-- Serving Size Filter -->
                    <div class="servingFilter filter">
                        <div class="filterName">Serving Size</div>
                        <div class="filterLabels">
                            <label><input type="checkbox" name="servings[]" value="2" <?php if (in_array('2', $serving_sizes)) echo 'checked'; ?>> 2 servings</label>
                            <label><input type="checkbox" name="servings[]" value="4" <?php if (in_array('4', $serving_sizes)) echo 'checked'; ?>> 4 servings</label>
                        </div>
                    </div>

                    <!-- Cook Time Filter -->
                    <div class="cooktimeFilter filter">
                        <div class="filterName">Cook Time</div>
                        <div class="filterLabels">
                            <label><input type="checkbox" name="cook_time[]" value="0-30" <?php if (in_array('0-30', $cook_time_ranges)) echo 'checked'; ?>> 0-30 minutes</label>
                            <label><input type="checkbox" name="cook_time[]" value="31-45" <?php if (in_array('31-45', $cook_time_ranges)) echo 'checked'; ?>> 31-45 minutes</label>
                            <label><input type="checkbox" name="cook_time[]" value="46-60" <?php if (in_array('46-60', $cook_time_ranges)) echo 'checked'; ?>> 46-60 minutes</label>
                        </div>
                    </div>
                    <button type="submit" class="filterButton">Filter</button>
                </form>
            </section>
            <!-- !Recipes -->
            <section class="recipeCards">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($recipe = $result->fetch_assoc()): ?>
                        <a href="recipe.php?id=<?= htmlspecialchars($recipe['id']) ?>" class="recipeLink">
                            <div class="recipeCard">
                                <!-- Recipe Image -->
                                <img src="<?= htmlspecialchars($recipe['main image']) ?>" alt="Image of <?= htmlspecialchars($recipe['title']) ?>">

                                <!-- Recipe Title and Subtitle -->
                                <h2><?= htmlspecialchars($recipe['title']) ?></h2>
                                <h3><?= htmlspecialchars($recipe['subtitle']) ?></h3>

                                <!-- Recipe Meta Section -->
                                <div class="recipeMeta">
                                    <!-- Cook Time -->
                                    <div class="metaItem">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                                            <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                                        </svg>
                                        <?= htmlspecialchars($recipe['cook time']) ?> mins
                                    </div>

                                    <!-- Cuisine -->
                                    <div class="metaItem">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                                            <path d="M240-80v-366q-54-14-87-57t-33-97v-280h80v240h40v-240h80v240h40v-240h80v280q0 54-33 97t-87 57v366h-80Zm400 0v-381q-54-18-87-75.5T520-667q0-89 47-151t113-62q66 0 113 62.5T840-666q0 73-33 130t-87 75v381h-80Z"/>
                                        </svg>
                                        <?= htmlspecialchars($recipe['cuisine']) ?>
                                    </div>

                                    <!-- Serving Size -->
                                    <div class="metaItem">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#356859">
                                            <path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67ZM160-160v-100q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.34 45.17 30.33 14.33 48.83 41.83T800-260v100H160Z"/>
                                        </svg>
                                        <?= htmlspecialchars($recipe['servings']) ?> servings
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                <?php endif; ?>
            </section>
        </section>
    </main>

    <!-- !Footer -->
    <?php require_once 'includes/footer.php'; ?>


    <!-- !JavaScript -->
    <script src="assets/tasteThreads.js"></script>
</body>
</html>