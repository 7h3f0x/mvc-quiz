<?php
namespace Models;
use Models\Utils;

class Leaderboard
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
}
?>