<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_dbrestore extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!is_cli() && !$this->session->userdata('admin_details')) {
			show_404();
		}
	}

	public function index()
	{
				
	header('Content-Type: text/plain; charset=utf-8');
		// Name of the file
		$filename = 'c:\new\a.sql';
		// MySQL host
		$mysql_host = 'localhost';
		// MySQL username
		$mysql_username = 'root';
		// MySQL password
		$mysql_password = '';
		// Database name
		$mysql_database = 'agwb';

		// Connect to MySQL server
		mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
		// Select database
		mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line)
		{
		// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;

		// Add this line to the current segment
		$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';')
		{
			// Perform the query
			mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');

			// Reset temp variable to empty
			$templine = '';
		}
		}
		 echo "Tables imported successfully";
	}
	
}
