<?php
namespace Models;
use Models\Utils;

class Change
{
	public static function changeQuestion($number,$title,$question,$a,$b,$c,$d,$correct,$points)
	{
		$db=Utils::getDB();
		$change=$db->prepare('
				UPDATE questions SET Title=:title,Question=:question,a=:a,b=:b,c=:c,d=:d,correct=:correct,points=:points WHERE number=:number
			');
		$change->execute(array(
			"title"=>$title,
			"question"=>$question,
			"a"=>$a,
			"b"=>$b,
			"c"=>$c,
			"d"=>$d,
			"correct"=>$correct,
			"points"=>$points,
			"number"=>$number
		));
		return;
	}
}

?>