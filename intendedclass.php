<?php

# so we don't need write database info in every file
require_once "pdo.php";
$old_netid = isset($_POST['netID']) ? $_POST['netID']: "";
// to display the value you just input


/**************connect the neo4j database****************/
require_once '/Users/leslieren/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:itwillwork@localhost:7474') // Example for HTTP connection configuration (port is optional)
    //->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional)
    ->build();

/**************connect the neo4j database****************/


// var_dump($_POST);
if ( isset($_POST['delete']) && isset($_POST['netID']) && isset($_POST['department']) && isset($_POST['courseNumber'])) {
	$sql1 = 'DELETE FROM Course WHERE courseNumber = :courseNo AND netID = :netID AND department = :dpt';
	echo "<pre>\n$sql1\n</pre>\n";
	$stmt1 = $pdo->prepare($sql1);
	$stmt1->execute(array(
		':courseNo'=>$_POST['courseNumber'],
		':netID'=>$_POST['netID'],
		':dpt'=>strtoupper($_POST['department'])
	));
}


?>



<html>
<head>
    <title>Intened Class Table</title>
</head><body>
<p>
<a href="main.html">Main Page</a>
</p>
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
	echo "</th><th>"; 
	echo "Professor w/highest rating";
	echo("</th></tr>\n");

foreach ( $rows as $row ) {
	$dept = strtoupper($row['department']);
	$thenumber = $row['courseNumber'];


	//the mysql part
	$sql = "select distinct primaryInstructor from GPA where subject='$dept' and number=$thenumber;";
	// echo "<p>";
	// echo "\n$sql\n";
	// echo "</p>";
	$innerstmt = $pdo->prepare($sql);
	$innerstmt->execute();

	$innerrows = $innerstmt->fetchAll(PDO::FETCH_ASSOC);

	$nameArray = array();// Full name array for professors.
	foreach ($innerrows as $innerrow) {
		
		$name = $innerrow['primaryInstructor'];
		$name = str_replace(",", "", $name);
		// echo $name, "\n\n";	
		$nameArray[] = $name;
		// $var = explode(" ", $name);	
	}

	// echo "Professor array for this class:\n";
	// print_r($nameArray);

	// neo4j part
	$rating = array();
	foreach ($nameArray as $name) {
		// echo "<p>";
		$var = explode(" ", $name);
		$lastName = $var[0];
		$firstName = $var[1];

		
		// echo $firstName, " ",$lastName;
		// echo "</p>";

		$query = "MATCH (n:Professor{LastName:'$lastName', FirstName:'$firstName'}) RETURN n.OverallRating";
		// echo $query;
		try {
			$result = $client->run($query);
			$record = $result->getRecord();
			$va = $record->value('n.OverallRating');
			// echo $va;
			$rating[$firstName." ".$lastName] = $va;
			
		} catch (Exception $e) {
			// echo "No related record, set to 0";
		}
		
		
	}
	// echo "\n\n\n";
	// echo "<p></p>";
	// print_r($rating);
	// echo "<p></p>";

	// print the highest quality professor
	// echo (array_keys($rating, max($rating)))[0];




    echo "<tr><td>";
    echo($row['department']);
    echo "</td><td>";
    echo($row['courseNumber']);
    echo "</td><td>";
    echo (array_keys($rating, max($rating)))[0];
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