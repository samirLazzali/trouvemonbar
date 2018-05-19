<?php

/**
* 
*/
class UserManager
{
	private $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	function getId ($id) {
		$query = $this->db->query("SELECT * FROM users WHERE id = $id");
		if ($query->rowCount() > 0) 
		{
			return new User($query->fetch());
		}
		else
		{
			echo 'UserManager: id not found<br>';
		}
	}

}

