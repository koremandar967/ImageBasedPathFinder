<?php

$link=mysql_connect("localhost","root") or die("Could not connect".mysql_error());
mysql_select_db("imagemap")or die("Could not connect: ". mysql_error());
$Rdateus=date('Y-m-d h:i:s');

?>
