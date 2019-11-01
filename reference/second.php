<?php

# so we don't need write database info in every file
require_once "pdo.php";

$stmt = $pdo->query("SELECT term, unit, lname, ranking, number FROM TeacherRank limit 5");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table border="1">'."\n";
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['term']);
    echo "</td><td>";
    echo($row['unit']);
    echo "</td><td>";
    echo($row['lname']);
    echo("</td><td>");
    echo($row['ranking']);
    echo("</td><td>");
    echo($row['number']);
    echo("</td></tr>\n");
}
echo "</table>\n";
?>


