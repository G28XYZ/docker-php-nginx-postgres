<?php

phpinfo();

$dbh = new PDO('pgsql:host=db;dbname=postgres', 'postgres', 'postgres');

var_dump($dbh);