<?php

# so we don't need write database info in every file
require_once "pdo.php";


$sql = "SELECT primaryInstructor AS Instructor, ((SUM(Aplus)*4.0 + SUM(Aonly)*4.0 + SUM(Aminus)*3.67 + SUM(Bplus)*3.33 + SUM(Bonly)*3.0 + SUM(Bminus)*2.67 + SUM(Cplus)*2.33+ SUM(Conly)*2.0 + SUM(Cminus)*1.67 + SUM(Dplus)*1.33 + SUM(Donly)*1.0 + SUM(Dminus)*0.67)/(SUM(Aplus) + SUM(Aonly) + SUM(Aminus) + SUM(Bplus) + SUM(Bonly) + SUM(Bminus) + SUM(Cplus) + SUM(Conly) + SUM(Cminus) + SUM(Dplus) + SUM(Donly) + SUM(Dminus) + SUM(Fail))) AS avgGPA
FROM GPA
WHERE subject = :subject AND number = :courseno
GROUP BY primaryInstructor
ORDER BY primaryInstructor;";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
        ':subject' => strtoupper($_POST['subject']),
        ':courseno' => $_POST['courseno']
    ));



?>



<html>
<head>
    <title>Search</title>
</head><body>
	<p>
<a href="main.html">Main Page</a>
</p>

<?php
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table border="1">'."\n";
echo "</tr><td>";
echo "Instructor";
echo "</td><td>";
echo "Average GPA ";
echo("</td></tr>\n");

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['Instructor']);
    echo "</td><td>";
    echo($row['avgGPA']);
    echo("</td></tr>\n");
}
echo "</table>\n";


?>

<p>Check out the average GPA of the class:</p>
<form method="post">
<p>Department(example:CS):
<input type="text" name="subject" size="20"></p>
<p>Course Number:
<input type="text" name="courseno" size="20"></p>
<p><input type="submit" value="click"/></p>
</form>
</body>