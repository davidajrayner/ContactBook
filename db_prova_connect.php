<?php
// connection details for connecting to prova database

	$db = mysql_connect('localhost', 'root');   
	$select = mysql_select_db('prova', $db); 
	
?>