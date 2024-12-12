
<?php
    $server = getenv ('DB_SERVER');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $name = getenv('DB_NAME');

    $connection = new mysqli($server, $username, $password, $name);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>
