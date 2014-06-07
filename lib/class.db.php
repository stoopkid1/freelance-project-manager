<?php 
/*
 * ######################################################
* Author: Michael Loring
* Project: Freelance Project Manager
* Began: June 05th, 2014
* Finished: Code is never done, but in a working state
* Notes: Database Connection class...
* ######################################################
*/
class DB_Class {
	
		var $link;
		
		var $host     = ""; //database host
		var $username = ""; //database username
		var $password = ""; //database password
		var $database = ""; //mysql database
		var $prefix   = ""; //table prefix
		
		public function __construct() {
			global $connection;
			mb_internal_encoding( 'UTF-8' );
			mb_regex_encoding( 'UTF-8' );
			$this->link = new mysqli( $this->host, $this->username, $this->password, $this->database );
		}
		
		public function __destruct() {
			$this->disconnect();
		}
		
	function query($query) {
			$result = mysqli_query($query, $this->link) or die ("Invalid query: " . mysqli_error());
		 return $result;
	}
	
	function numRows($result) {
		$count = mysqli_num_rows($result);
		 return $count;
	}
	
	function fetch($query) {
		  $data = array();
			$result = $this->link->query($query);
				while($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}

		  return $data;
	}
	
	public function disconnect()
	{
		$this->link->close();
	}
	
	/*
	 * INSTALLATION
	*/
	
	function runInstaller() {
		
		if($this->link) {
			$query = "
			CREATE TABLE `" . $this->prefix . "companies` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`company` varchar(50) DEFAULT NULL,
			`owner` varchar(50) DEFAULT NULL,
			`website` varchar(100) DEFAULT NULL,
			`admin` int(10) DEFAULT NULL,
			`created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			`status` int(1) DEFAULT '1',
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1
				
			CREATE TABLE `" . $this->prefix . "pages` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`page` varchar(50) DEFAULT NULL,
			`description` varchar(10000) DEFAULT NULL,
			`project` int(10) DEFAULT NULL,
			`company` int(10) DEFAULT NULL,
			`modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1
				
			/*Table structure for table `projects` */
				
			CREATE TABLE `" . $this->prefix . "projects` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`project` varchar(50) DEFAULT NULL,
			`type` varchar(100) DEFAULT 'web site',
			`created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			`description` varchar(10000) DEFAULT NULL,
			`company` int(10) DEFAULT NULL,
			`status` int(1) DEFAULT '1',
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
				
			/*Table structure for table `tasks` */
				
			CREATE TABLE `" . $this->prefix . "tasks` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`task` varchar(50) DEFAULT NULL,
			`description` varchar(10000) DEFAULT NULL,
			`status` int(100) DEFAULT '0',
			`project` int(10) DEFAULT NULL,
			`priority` varchar(15) DEFAULT NULL,
			`assignee` varchar(30) DEFAULT NULL,
			`dueDate` date DEFAULT NULL,
			`company` int(10) DEFAULT NULL,
			`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`notes` blob,
			`percent` int(10) DEFAULT '0',
			`lastUpdate` timestamp NULL DEFAULT NULL,
			`completeDate` timestamp NULL DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1
				
			/*Table structure for table `users` */
				
			CREATE TABLE `" . $this->prefix . "users` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`username` varchar(50) DEFAULT NULL,
			`email` varchar(150) DEFAULT NULL,
			`role` varchar(20) DEFAULT NULL,
			`created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			`modified` timestamp NULL DEFAULT NULL,
			`salt` varchar(100) DEFAULT NULL,
			`hash` varchar(100) DEFAULT NULL,
			`status` int(1) DEFAULT '0',
			`forget` varchar(250) DEFAULT NULL,
			`company` varchar(250) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;
			";
	
			mysqli_multi_query($query, $this->link) or die ("Invalid query: " . mysqli_error());
			print "Installation Completed. Please <a href=\"admin\">Login</a>";
		} else {
			print "<strong>Error</strong> Please check your connection details and try again";
		}
	
	}
	
}
?>
