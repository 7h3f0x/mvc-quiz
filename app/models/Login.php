<?php
namespace Models;
use Models\Utils;

class Login
{
	public static function Validate($username,$password){
			$password_hash=hash('sha256', $password);
			$db=Utils::getDB();
			$user = $db->prepare("
				SELECT * FROM users WHERE username=:username AND password=:password
			");
			$user->execute(array(
				"username"=>$username,
				"password"=>$password_hash
			));
				$info=$user->fetch(\PDO::FETCH_ASSOC);
				if ($info)
				{
					return true;
				}
				else
				{
					return false;
				}

		}
}

?>