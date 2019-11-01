<?php
echo "<pre>\n";
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc','fred', 'zap');
# The first parameter's what's called a connection string, and it tells what kind of database we're going to make, be connecting to, which is MySQL. Where it's connected now, most of the time in production you put your database on a different server, and it's got an address, your local host just means we're the same server and we are, and then there's a port.
$stmt = $pdo->query("SELECT * FROM users");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	#  then we can use that statement to fetch one row at a time using (PDO::FETCH_ASSOC) array, says we would like each row given to us as a series of key value pairs
	print_r($row);
}

echo "</pre>\n";
?>
