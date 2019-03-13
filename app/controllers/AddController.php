<?php

namespace Controllers;
// use Models\Utils;
use Models\Users;
use Models\Questions;
class AddController
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
    			echo $this->twig->render("add.html",array(
                    "user"=>$username
                ));
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
    		$title=htmlspecialchars($_POST['title']);
    		$question=htmlspecialchars($_POST['question']);
    		$a=htmlspecialchars($_POST['a']);
    		$b=htmlspecialchars($_POST['b']);
    		$c=htmlspecialchars($_POST['c']);
    		$d=htmlspecialchars($_POST['d']);
    		$correct=htmlspecialchars($_POST['correct']);
    		$points=htmlspecialchars($_POST['points']);
    		Questions::AddQue($title,$question,$a,$b,$c,$d,$correct,$points);
    		echo $this->twig->render("add.html",array(
                "user"=>$username,
    			"result"=>"question added successfully"
    		));
    	}
        else
        {
            header("Location: /solve");
        }
    }
}

?>