<?php
include('db_connection.php');

$heroes_per_page = 15;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $heroes_per_page;

$query = "SELECT COUNT(*) FROM heroes";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$total_heroes = $row[0];
$total_pages = ceil($total_heroes / $heroes_per_page);

$query = "SELECT * FROM heroes LIMIT $offset, $heroes_per_page";
$result = mysqli_query($conn, $query);

while ($hero = mysqli_fetch_assoc($result)) {
    echo "<div class='hero'>";
    echo "<h3>" . $hero['name'] . "</h3>";
    echo "<p>" . $hero['description'] . "</p>";
    echo "</div>";
}

echo "<div class='pagination'>";
if ($page > 1) {
    echo "<a href='heroes.php?page=" . ($page - 1) . "'>Anterior</a>";
}
if ($page < $total_pages) {
    echo "<a href='heroes.php?page=" . ($page + 1) . "'>Próxima</a>";
}
echo "</div>";

?>
