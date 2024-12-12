<?php 

    require_once 'includes/db.php';
    $statement = $connection->prepare("SELECT * FROM database_table_name");
    $statement->execute();
    $recipe = stat

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php foreach($statement as $recipe)  : ?>
            <div class="recipe">

            </div>
            <div class="recipe_content"> 
                <h2><?php echo htmlspecialchars($recipe['name'])</h2>
            </div>
            <section>
                <h3>Ingredients </h3>
                <ul>
                    <?php 
                        $ingredients = explode(',', $recipe['ingredients']);
                        foreach($ingredients as $ingredient) : ?>
                            <li><?= htmlspecialchars($ingredient) ?></li>
                        <?php endforeach; ?>
                </ul>
            </section>
        <?php endforeach; ?>
    </body>
    </html>