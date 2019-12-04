
<?php
// This script is just a scratch paper!

require_once '/Users/leslieren/vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:itwillwork@localhost:7474') // Example for HTTP connection configuration (port is optional)
    //->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional)
    ->build();


$result = $client->run('MATCH (n:Student) RETURN n.netID');



foreach ($result->getRecords() as $record) {

	// The sprintf() function writes a formatted string to a variable.
	// https://www.w3schools.com/php/func_string_sprintf.asp
	echo sprintf("%s\n", $record->value('n.netID'));
	// echo "";
	// echo $record->value('netID');
}


//taken this course also take, display in classes taken, Done!
$query = 'match (s1:Student{netID:"zhiyanr2"})-[:took]->(c1:Class{courseNo:"CS411"})<-[:took]-(s2:Student)-[:took]->(c2:Class)
where s2<>s1
return c2';




//for intended class

