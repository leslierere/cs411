<?php
require_once "pdo.php";

if ( isset($_POST['netID']) && isset($_POST['department']) && isset($_POST['courseNumber']) ) {
    $sql = "INSERT INTO Course (netID, department, courseNumber) 
              VALUES (:netID, :department, :courseNumber)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':netID' => $_POST['netID'],
        ':department' => $_POST['department'],
        ':courseNumber' => $_POST['courseNumber']
    ));
}
?>
<html>
<head>
	<title>Insert</title>
</head><body>
<p>Add a new class you wanna take:</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="20"></p>
<p>Department:
<input type="text" name="department" size="20"></p>
<p>Course Number:
<input type="text" name="courseNumber" size="20"></p>
<p><input type="submit" value="Add new"/></p>
</form>
</body>
