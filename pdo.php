<?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=seeker', 
    'zhiyan', 'zyr');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



