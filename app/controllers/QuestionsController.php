<?php
namespace Controllers;
use Models\Utils;
use Models\Solve;
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
		$username=Utils::getUserinfo($_COOKIE['user']);
		if (isset($_COOKIE['user']))
		{
			$questions=Utils::getQuestions();
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