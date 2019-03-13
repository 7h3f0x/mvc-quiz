<?php
namespace Models;
use Models\Utils;
class Results
{
	public static function getResults($username,$number)
	{
		$db=Utils::getDB();
		$results=$db->prepare('
					SELECT * FROM results WHERE username=:username AND q=:number
				');
			$results->execute(array(
				"username"=>$username,
				"number"=>$number
			));
			$result=$results->fetch(\PDO::FETCH_ASSOC);
		return $result;
	}
	public static function updateResults($username,$number,$status)
	{
		$db=Utils::getDB();
		$insert=$db->prepare('
		INSERT INTO results(username,q,status) VALUES(:username,:q,:status)
		');
		$insert->execute(array(
			"username"=>$username,
			"q"=>$number,
			"status"=>$status
		));
	}
}
?>