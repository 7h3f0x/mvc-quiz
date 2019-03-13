<?php
namespace Controllers;
use Models\Users;

class QuestionsController
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
			$questions=Users::getQuestions();
			echo $this->twig->render("solve.html",array(
				"user"=>$username,
				"title"=>"View All Problems",
				"purpose"=>"change",
				"questions"=>$questions
			));
		}
		else
		{
			header("Location: /");
		}
	}
}

?>