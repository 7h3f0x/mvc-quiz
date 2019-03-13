<?php 
namespace Controllers;
use Models\Users;

class SignupController
{
	protected $twig;

	public function __construct()
    	{
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
	public function get()
	{
        if (isset($_COOKIE['user']))
        {
            header("Location: /solve");
        }
		echo $this->twig->render("signup.html");
	}
	public function post()
	{
        if(isset($_POST['username'])&&isset($_POST['password']))
        {
    		$username=htmlspecialchars($_POST['username']);
            $password=htmlspecialchars($_POST['password']);
            if (Users::register($username,$password))
            {
            	setcookie('user',$username,time()+(86400*30),"/");
            	header("Location: /solve");
            }
            else
            {
            	echo $this->twig->render("signup.html",array(
    					"error"=>"A user with such credentials exists, please try something else"
            		));
            }
        }
        else
        {
            echo $this->twig->render("signup.html",array(
                        "error"=>"Please enter a username and password"
                    ));
        }
	}
}

?>