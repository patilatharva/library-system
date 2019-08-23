<?php
    function connect_db() {

		$user = 'root';
		$password = 'root';
		$db = 'librarydb';
		$host = 'localhost';
		return mysqli_connect($host, $user, $password, $db);
	}

	$sql_details = array(			// for ajax programs
        'user' => 'root',
        'pass' => 'root',
        'db'   => 'librarydb',
        'host' => 'localhost'
    );
?>