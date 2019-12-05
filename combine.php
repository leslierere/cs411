<?php  
require_once "pdo.php";

/**************connect the neo4j database****************/
require_once '/Users/leslieren/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:itwillwork@localhost:7474') // Example for HTTP connection configuration (port is optional)
    //->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional)
    ->build();

/**************connect the neo4j database****************/

//the mysql part
$sql = "select distinct primaryInstructor from GPA where subject=\"CS\" and number=411;";
// | Alawini, Abdussalam A  |
// | Chang, Kevin C         |
// | Parameswaran, Aditya G |
// | Sinha, Saurabh         |
// | Cunningham, Ryan M     |
// | Weninger, Timothy E    |
// | Zhao, Peixiang         |
echo "<pre>\n$sql\n</pre>";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$nameArray = array();// Full name array for professors.
foreach ($rows as $row) {
	echo "<p>";
	$name = $row['primaryInstructor'];
	$name = str_replace(",", "", $name);
	// echo $name, "\n\n";	
	$nameArray[] = $name;

	// $var = explode(" ", $name);	
	echo "\n
	";
	echo "</p>";
}

print_r($nameArray);


// neo4j part
$rating = array();
foreach ($nameArray as $name) {
	echo "<p>";
	$var = explode(" ", $name);
	$lastName = $var[0];
	$firstName = $var[1];

	
	echo $firstName, " ",$lastName;
	echo "</p>";

	$query = "MATCH (n:Professor{LastName:'$lastName', FirstName:'$firstName'}) RETURN n.OverallRating";

	try {
		$result = $client->run($query);
		$record = $result->getRecord();
		$va = $record->value('n.OverallRating');
		echo $va;
		$rating[$firstName." ".$lastName] = $va;
		
	} catch (Exception $e) {
		// echo "No related record, set to 0";
	}
	
	
}
echo "\n\n\n";
print_r($rating);	

echo "<p></p>";

// print the highest quality professor
echo (array_keys($rating, max($rating)))[0];



?>