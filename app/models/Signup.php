<?php
namespace Models;
use Models\Utils;

class Signup
{
	public static function register($username, $password)
	{
		$password_hash=hash('sha256',$password);
		$db=Utils::getDB();
		$query=$db->prepare("
				SELECT * FROM users WHERE username=:username
			");
		$query->execute(array(
			"username"=>$username
		));
		$x=$query->fetchAll();
		if (count($x)>0) 
		{
				return false;
		}
		else
		{
			$user=$db->prepare("
					INSERT INTO users(username,password)VALUES(:username,:password)
				");
			$user->execute(array(
				"username"=>$username,
				"password"=>$password_hash
			));
			return true;
		}
	}
}

?>