<?php
namespace Models;
use Models\Utils;

class Solve
{
	public static function Answer($number,$answer)
	{
		$db=Utils::getDB();
		$username=$_COOKIE['user'];
		$user=Utils::getUserinfo($username);
		$question=Utils::getQuestion($number);
		if ($answer===$question['correct'])
		{
			$bool=true;
			$results=$db->prepare('
					SELECT * FROM results WHERE username=:username AND q=:number
				');
			$results->execute(array(
				"username"=>$username,
				"number"=>$number
			));
			$result=$results->fetch(\PDO::FETCH_ASSOC);
			if ($result)
			{
				$points=$user['points'];
			}
			else
			{
				$query1=$db->prepare('
				INSERT INTO results(username,q,status) VALUES(:username,:q,:status)
				');
				$query1->execute(array(
					"username"=>$username,
					"q"=>$number,
					"status"=>"answered-correct"
				));
				$points=$user['points']+$question['points'];
				$query=$db->prepare('
						UPDATE users SET points=:points WHERE username=:username
					');
				$query->execute(array(
					"points"=>$points,
					"username"=>$username
				));
			}
		}
		else
		{
			$query1=$db->prepare('
				INSERT INTO results(username,q,status) VALUES(:username,:q,:status)
				');
			$query1->execute(array(
				"username"=>$username,
				"q"=>$number,
				"status"=>"answered-incorrect"
			));
			$points=$user['points'];
			$bool=false;
		}
		return array(
					"points"=>$points,
					"bool"=>$bool
				);
		
	}
}

?>