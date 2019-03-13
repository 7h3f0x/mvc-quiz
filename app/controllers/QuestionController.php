<?php

namespace Controllers;
use Models\Utils;
use Models\Solve;
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
        $username=Utils::getUserinfo($_COOKIE['user']);
        if (isset($_COOKIE['user']))
        {
        	$number=htmlspecialchars($_GET['q']);
        	$problem=Utils::getQuestion($number);
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
    	$number=htmlspecialchars($_POST['q']);
    	$option=htmlspecialchars($_POST['option']);
    	$correct=Solve::Answer($number,$option);
    	if ($correct['bool']===true)
    	{
    		$points=$correct['points'];
    		echo json_encode(array(
    			"points"=>$points,
    			"result"=>"correct"
    		));	
    	}
    	else
    	{
    		$points=$correct['points'];
    		echo json_encode(array(
    			"points"=>$points,
    			"result"=>"incorrect answer"
    		));
    	}
    }
}

?>