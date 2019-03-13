<?php
namespace Models;
use Models\Utils;
class Users
{
	public static function getUsers()
	{
		$db=Utils::getDB();
		$user=$db->prepare('
				SELECT username,points FROM users WHERE isadmin != \'1\' ORDER BY points DESC
			');
		$user->execute();
		$users=$user->fetchAll();
		return $users;
	}
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
		$users=$query->fetchAll();
		if (count($users)>0) 
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
	public static function Validate($username,$password)
	{
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
	public static function getUserinfo($username)
    {
        $db=Utils::getDB();
        $query=$db->prepare('
                SELECT username,points,isadmin FROM users WHERE username=:username
            ');
        $query->execute(array(
            "username"=>$username
        ));
        $user=$query->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }
    public static function updateUser($username,$points)
    {
    	$db=Utils::getDB();
    	$query=$db->prepare('
		UPDATE users SET points=:points WHERE username=:username
		');
		$query->execute(array(
			"points"=>$points,
			"username"=>$username
		));
    }
}

?>