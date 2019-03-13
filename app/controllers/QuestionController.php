<?php

namespace Controllers;
use Models\Users;
use Models\Questions;
use Models\Results;
class QuestionController
{
	protected $twig;

	public function __construct()
    	{
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
    public function get()
    {
        $username=Users::getUserinfo($_COOKIE['user']);
        if (isset($_COOKIE['user']))
        {
        	$number=htmlspecialchars($_GET['q']);
        	$problem=Questions::getQuestion($number);
        	echo $this->twig->render("question.html",array(
                "user"=>$username,
        		"problem"=>$problem
        	));
        }
        else
        {
            header("Location: /");
        }
    }
    public function post()
    {
        $username=htmlspecialchars($_COOKIE['user']);
    	$number=htmlspecialchars($_POST['q']);
    	$answer=htmlspecialchars($_POST['option']);
    	//$correct=Solve::Answer($number,$option);
        $user=Users::getUserinfo($username);
        $question=Questions::getQuestion($number);

        if ($answer===$question['correct'])
        {
            $correct=true;
            $results=Results::getResults($username,$number);
            if ($results)
            {
                $points=$user['points'];
            }
            else
            {
                $points=$user['points']+$question['points'];
                Users::updateUser($username,$points);
                Results::updateResults($username,$number,"answered-correct");
            }

        }
        else
        {
            $correct=false;
            $points=$user['points'];
            Results::updateResults($username,$number,"answered-incorrect");
        }


    	if ($correct===true)
    	{
    		echo json_encode(array(
    			"points"=>$points,
    			"result"=>"correct"
    		));	
    	}
    	else
    	{
    		echo json_encode(array(
    			"points"=>$points,
    			"result"=>"incorrect answer"
    		));
    	}
    }
}

?>