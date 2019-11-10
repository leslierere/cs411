<?php

# so we don't need write database info in every file
require_once "pdo.php";
$old_netid = isset($_POST['netID']) ? $_POST['netID']: "";


$sql = "SELECT department, courseNumber FROM Course where netID = :netID";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
        ':netID' => $_POST['netID']
    ));


$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table border="1">'."\n";
echo "</tr><td>";
echo "Department";
echo "</td><td>";
echo "Course Number";
echo("</td></tr>\n");

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['department']);
    echo "</td><td>";
    echo($row['courseNumber']);
    echo("</td></tr>\n");
}
echo "</table>\n";
?>



<html>
<head>
    <title>Search</title>
</head><body>
<p>Check out your intended classes:</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="20" value="<?= $old_netid ?>"></p>
<p><input type="submit" value="click"/></p>
</form>
</body>