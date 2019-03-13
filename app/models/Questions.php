<?php
namespace Models;
use Models\Utils;

class Questions
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

	public static function getQuestion($number)
	    {
	        $db=Utils::getDB();
	        $query=$db->prepare("
	                SELECT * FROM questions WHERE number =:number
	            ");
	        $query->execute(array(
	            "number"=>$number
	        ));
	        $question=$query->fetch(\PDO::FETCH_ASSOC);
	        return $question;
	    }
    public static function getQuestions()
	    {
	        $db=Utils::getDB();
	        $question=$db->prepare('
	                SELECT * FROM questions
	            ');
	        $question->execute();
	        $questions=$question->fetchAll();
	        return $questions;
	    }
}

?>