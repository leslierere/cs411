<?php

# so we don't need write database info in every file
require_once "pdo.php";


$sql = "Select B.courseTitle, B.maxGPA, A.prof_name, B.subject, B.number
From (Select Distinct prof_name
   From TeacherRank
   Where unit = 'COMPUTER SCIENCE' and ranking = 'Outstanding') as A NATURAL JOIN
(Select A.courseTitle, A.prof_name, B.maxGPA, A.subject, A.number
From(
SELECT courseTitle,  prof_name, subject,number,((SUM(Aplus)*4.0 + SUM(Aonly)*4.0 + SUM(Aminus)*3.67 + SUM(Bplus)*3.33 + SUM(Bonly)*3.0 + SUM(Bminus)*2.67 + SUM(Cplus)*2.33+ SUM(Conly)*2.0 + SUM(Cminus)*1.67 + SUM(Dplus)*1.33 + SUM(Donly)*1.0 + SUM(Dminus)*0.67)/(SUM(Aplus) + SUM(Aonly) + SUM(Aminus) + SUM(Bplus) + SUM(Bonly) + SUM(Bminus) + SUM(Cplus) + SUM(Conly) + SUM(Cminus) + SUM(Dplus) + SUM(Donly) + SUM(Dminus) + SUM(Fail))) AS avgGPA
   From GPA
   Where subject = 'CS'
    Group By courseTitle, prof_name, subject, number) as A NATURAL JOIN
 
(Select courseTitle, MAX(avgGPA) as maxGPA
From (SELECT courseTitle, prof_name, ((SUM(Aplus)*4.0 + SUM(Aonly)*4.0 + SUM(Aminus)*3.67 + SUM(Bplus)*3.33 + SUM(Bonly)*3.0 + SUM(Bminus)*2.67 + SUM(Cplus)*2.33+ SUM(Conly)*2.0 + SUM(Cminus)*1.67 + SUM(Dplus)*1.33 + SUM(Donly)*1.0 + SUM(Dminus)*0.67)/(SUM(Aplus) + SUM(Aonly) + SUM(Aminus) + SUM(Bplus) + SUM(Bonly) + SUM(Bminus) + SUM(Cplus) + SUM(Conly) + SUM(Cminus) + SUM(Dplus) + SUM(Donly) + SUM(Dminus) + SUM(Fail))) AS avgGPA
    From GPA
    Where subject = 'CS'
    Group By courseTitle, prof_name) as t
    Group By courseTitle
    Order By courseTitle) as B
Where A.avgGPA = B.maxGPA) as B
Order By B.courseTitle;
";


$stmt = $pdo->prepare($sql);
$stmt->execute();

?>


<html>
<head>
    <title>Teacher Has the Highest GPA</title>
</head><body>
	<p>
<a href="main.html">Main Page</a>
</p>

<?php
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table border="1">'."\n";
echo "</tr><td>";
echo "subject";
echo "</td><td>";
echo "number";
echo "</td><td>";
echo "Course Title";
echo "</td><td>";
echo "Instructor";
echo "</td><td>";
echo "Max GPA ";
echo("</td></tr>\n");

foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['subject']);
    echo "</td><td>";
    echo($row['number']);
    echo "</td><td>";
    echo($row['courseTitle']);
    echo "</td><td>";
    echo($row['prof_name']);
    echo "</td><td>";
    echo($row['maxGPA']);
    echo("</td></tr>\n");
}
echo "</table>\n";


?>


</body>
