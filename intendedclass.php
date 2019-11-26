<?php

# so we don't need write database info in every file
require_once "pdo.php";
$old_netid = isset($_POST['netID']) ? $_POST['netID']: "";
// to display the value you just input


// var_dump($_POST);
if ( isset($_POST['delete']) && isset($_POST['netID']) && isset($_POST['department']) && isset($_POST['courseNumber'])) {
	$sql1 = 'DELETE FROM Course WHERE courseNumber = :courseNo AND netID = :netID AND department = :dpt';
	echo "<pre>\n$sql1\n</pre>\n";
	$stmt1 = $pdo->prepare($sql1);
	$stmt1->execute(array(
		':courseNo'=>$_POST['courseNumber'],
		':netID'=>$_POST['netID'],
		':dpt'=>$_POST['department']
	));
}


?>



<html>
<head>
    <title>Intened Class Table</title>
</head><body>

<pre>
	<?php
	$sql = "SELECT department, courseNumber,netID FROM Course where netID = :netID";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
	        ':netID' => $_POST['netID']
	    ));

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo '<table border="1">'."\n";
	echo "</tr><th>"; //tr: table row, th: table header
	echo "Department";
	echo "</th><th>"; //td: table data/cell
	echo "Course Number";
	echo("</th></tr>\n");

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['department']);
    echo "</td><td>";
    echo($row['courseNumber']);
    echo "</td><td>";
    echo "<form method='post'><input type='hidden' ";
    echo "name = 'netID' value='".$row['netID']."'>"."\n";//name要改
    echo "<input type='hidden' name = 'department' value='".$row['department']."'>"."\n";
    echo "<input type='hidden' name = 'courseNumber' value='".$row['courseNumber']."'>"."\n";
    echo "<input type='submit' value = 'Del' name ='delete'> ";
    echo "\n</form>\n";
    echo("</td></tr>\n");
}
echo "</table>\n";
	?>
</pre>



<p>Check out your intended classes:</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="20" value="<?= $old_netid ?>"></p>
<p><input type="submit" value="click"/></p>
</form>
</body>