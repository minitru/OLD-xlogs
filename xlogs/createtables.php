<?php
// Make a MySQL Connection
mysql_connect("localhost", "xlogs", "doodoo69") or die(mysql_error());
mysql_query("DROP DATABASE xlogs");

mysql_query("CREATE DATABASE xlogs");
mysql_select_db("xlogs") or die(mysql_error());

mysql_query("DROP TABLE users");

mysql_query("CREATE TABLE users(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 email VARCHAR(30),
 fname VARCHAR(30), 
 lname VARCHAR(30), 
 password VARCHAR(80), 
 lang VARCHAR(3),
 grp VARCHAR(30),
 key1 VARCHAR(30),
 sec1 VARCHAR(45),
 notify VARCHAR(30);
 )")
 or die(mysql_error());  

echo "Done\n!";

?>
