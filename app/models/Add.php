<?php
namespace Models;
use Models\Utils;

class Add
{
	public static function AddQue($title,$question,$a,$b,$c,$d,$correct,$points)
	{
		$db=Utils::getDB();
		$ques=$db->prepare('
			INSERT INTO questions(Title,Question,a,b,c,d,correct,points) VALUES(:title,:question,:a,:b,:c,:d,:correct,:points)
		');
		$ques->execute(array(
			"title"=>$title,
			"question"=>$question,
			"a"=>$a,
			"b"=>$b,
			"c"=>$c,
			"d"=>$d,
			"correct"=>$correct,
			"points"=>$points
		));
	}
}

?>