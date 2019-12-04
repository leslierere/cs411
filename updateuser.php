<?php
require_once "pdo.php";

$old_netid = isset($_POST['netID']) ? $_POST['netID']:'';

if ( isset($_POST['netID']) && isset($_POST['newmajor']) 
     ) {
    $sql = "UPDATE Student SET major = :newmajor WHERE netID = :netID";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':newmajor' => $_POST['newmajor'],
        ':netID' => $_POST['netID']));
}
?>



<html>
<head></head><body>
	<p>
<a href="main.html">Main Page</a>
</p>
<p>Update your major:</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="20" value="<?= htmlentities($old_netid)?>"></p>
<p>Your new major:
<input type="text" name="newmajor" size="40"></p>
<p><input type="submit" value="Update"/></p>
</form>
</body>
