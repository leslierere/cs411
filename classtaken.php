<?php
/**************connect the neo4j database****************/
require_once '/Users/leslieren/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:itwillwork@localhost:7474') // Example for HTTP connection configuration (port is optional)
    //->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional)
    ->build();

/**************connect the neo4j database****************/

$old_netid = isset($_POST['netID']) ? $_POST['netID'] : '';



if ( isset($_POST['netID']) && isset($_POST['department']) && isset($_POST['courseNumber']) ) {
    //add one course the student took.
    $id = $_POST['netID'];
    $course = $_POST['department'].$_POST['courseNumber'];


    // $trial = "merge (s:Student{netID:'$id'})
    // merge (c:Class{courseNo:'CS110'})
    // merge (s)-[:took]->(c)"

    $query = "merge (s:Student{netID:\"$id\"})
merge (cl:Class{courseNo:\"$course\"})
merge (s)-[:took]->(cl);";
    
    // for debug
    // echo("<pre>\n".$query."\n</pre>\n");
    
    $client->run($query);


    }
?>
<html>
<head>
	<title>Classes taken</title>
</head><body>
<p>
<a href="main.html">Main Page</a>
</p>
<p>Add the class you have taken:</p>
<form method="post">
<p>NetID:
<input type="text" name="netID" size="20" value="<?= htmlentities($old_netid) ?>"></p>
<p>Department:
<input type="text" name="department" size="20"></p>
<p>Course Number:
<input type="text" name="courseNumber" size="20"></p>
<p><input type="submit" value="Add new"/></p>
</form>

<p>
    <?php
    echo "Classes you have taken:";
    echo '<table border="1">'."\n";
    echo "</tr><th>"; //tr: table row, th: table header
    echo "Course";
    echo "</th><th>"; //td: table data/cell
    echo "Students who took this course also took";
    echo("</th></tr>\n");



    

    $getClass = "match (s:Student{netID:\"$old_netid\"})-[:took]->(c:Class)
return c.courseNo;";
    
    // for debug
    // echo("<pre>\n".$getClass."\n</pre>\n");

    $classes = $client->run($getClass);

    foreach ($classes->getRecords() as $record) {
        $theCourse = strtoupper($record->value('c.courseNo'));
        echo "<tr><td>";

        echo sprintf("%s", $theCourse);
        echo "</td><td>";
        // echo("placeholder");




        $query = "match (s1:Student{netID:\"$old_netid\"})-[:took]->(c1:Class{courseNo:\"$theCourse\"})<-[:took]-(s2:Student)-[:took]->(c2:Class)
where s2<>s1
return c2.courseNo";
        
        $rec_classes = $client->run($query);
        $result = "";

        foreach ($rec_classes->getRecords() as $i) {
            $result = $result.$i->value('c2.courseNo').", ";
            // echo sprintf("%s, ", $i->value('c2.courseNo'));
        }
        echo trim($result, ", ");
        echo("</td></tr>\n");

    }



    ?>

</p>





</body>
