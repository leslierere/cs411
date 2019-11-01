<?php
require_once "pdo.php";

if ( isset($_POST['netID']) && isset($_POST['name']) 
     && isset($_POST['major'])) {
    $sql = "INSERT INTO Student (netID, name, major) 
              VALUES (:name, :email, :password)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['netID'],
        ':email' => $_POST['name'],
        ':password' => $_POST['major']));
}
?>
<html>
<head></head><body>
<p>Add A New User</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="40"></p>
<p>Name:
<input type="text" name="name"></p>
<p>Major:
<input type="text" name="major"></p>
<p><input type="submit" value="Add New"/></p>
</form>
</body>
