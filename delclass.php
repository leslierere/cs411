<?php
require_once "pdo.php";

if ( isset($_POST['netID']) && isset($_POST['department']) && isset($_POST['courseNumber']) ) {
    $sql = "DELETE FROM Course WHERE department = :department and courseNumber = :courseNumber and netID = :netID";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    	':department' => $_POST['department'],
    	':courseNumber' => $_POST['courseNumber'],
    	':netID' => $_POST['netID']
    ));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
</head>
<body>
<p>Delete A Intended Course for a User</p>
<form method="post">
<p>NetID:
<input type="text" name="netID"></p>
<p>Department:
<input type="text" name="department"></p>
<p>Course Number:
<input type="text" name="courseNumber"></p>
<p><input type="submit" value="Delete"/></p>
</form>
</body>
</html>


