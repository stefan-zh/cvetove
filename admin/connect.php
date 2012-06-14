<?php
$conn = @mysql_connect( "localhost", "root", "9008305321" )
or die ("No connection!");
mysql_select_db( "vestnik", $conn )
or die ("This database does not exist!");
$mysql_table = articles;
$issues = issues;
$counter = counter;
?>

