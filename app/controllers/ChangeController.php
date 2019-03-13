<?php

namespace Controllers;
use Models\Users;
use Models\Questions;

class ChangeController
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
        if ($username['isadmin']==='1')
        {
            if (isset($_GET['q']))
            {
            	$number=htmlspecialchars($_GET['q']);
            	$question=Questions::getQuestion($number);
            	echo $this->twig->render("change.html",array(
                    "user"=>$username,
            		"problem"=>$question
            	));
            }
            else
            {
                header("Location: /questions");
            }
        }
        else
        {
            header("Location: /solve");
        }
    }
    public function post()
    {
        $username=Users::getUserinfo($_COOKIE['user']);
        if ($username['isadmin']==='1')
        {

            $number=htmlspecialchars($_POST['q']);
            $title=htmlspecialchars($_POST['title']);
            $question=htmlspecialchars($_POST['question']);
            $a=htmlspecialchars($_POST['a']);
            $b=htmlspecialchars($_POST['b']);
            $c=htmlspecialchars($_POST['c']);
            $d=htmlspecialchars($_POST['d']);
            $correct=htmlspecialchars($_POST['correct']);
            $points=htmlspecialchars($_POST['points']);

            $change=Questions::changeQuestion($number,$title,$question,$a,$b,$c,$d,$correct,$points);
            echo "question changed successfully";

        }
    }
}

?>