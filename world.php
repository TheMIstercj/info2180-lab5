<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

header('Content-Type: text/html; charset=UTF-8');

$country = isset($_GET['country']) && is_string($_GET['country'])
    ? trim($_GET['country']) : '';
$lookup = isset($_GET['lookup']) && is_string($_GET['lookup'])
    ? $_GET['lookup'] : 'countries';

function h($value) {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    if ($lookup === 'cities') {
        $sql = "SELECT ci.name, ci.district, ci.population
                FROM cities ci
                INNER JOIN countries co ON ci.country_code = co.code
                WHERE co.name LIKE :country
                ORDER BY co.name, ci.name";
    } else {
        $sql = "SELECT name, continent, independence_year, head_of_state
                FROM countries
                WHERE name LIKE :country
                ORDER BY name";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute(['country' => '%' . $country . '%']);
    $results = $stmt->fetchAll();
} catch (PDOException $error) {
    http_response_code(500);
    echo '<p class="message">Database connection or query failed. Check the database setup.</p>';
    exit;
}

if (count($results) === 0) {
    echo '<p class="message">No results found.</p>';
    exit;
}

if ($lookup === 'cities') {
    echo '<table><thead><tr><th>Name</th><th>District</th><th>Population</th></tr></thead><tbody>';

    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . h($row['name']) . '</td>';
        echo '<td>' . h($row['district']) . '</td>';
        echo '<td>' . h(number_format((int) $row['population'])) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<table><thead><tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr></thead><tbody>';

    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . h($row['name']) . '</td>';
        echo '<td>' . h($row['continent']) . '</td>';
        echo '<td>' . ($row['independence_year'] === null ? 'N/A' : h($row['independence_year'])) . '</td>';
        echo '<td>' . h($row['head_of_state'] ?? 'N/A') . '</td>';
        echo '</tr>';
    }
}

echo '</tbody></table>';
