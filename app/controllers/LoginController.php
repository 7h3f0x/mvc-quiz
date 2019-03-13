<?php

namespace Controllers;
use Models\Login;
class LoginController
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
    		echo $this->twig->render("login.html");
    	}
    public function post()
        {
            if (isset($_POST['username'])&&isset($_POST['password']))
            {
                $username=htmlspecialchars($_POST['username']);
                $password=htmlspecialchars($_POST['password']);
                if (Login::Validate($username, $password)) 
                {
                    setcookie('user',$username,time()+(86400*30),"/");
                    header("Location: /solve");
                }
                else
                {
                    echo $this->twig->render("login.html", array(
                        "error"=>"Invalid Username or Password")) ;
                }
            }
            else
            {
                echo $this->twig->render("login.html", array(
                        "error"=>"Please enter a username and a password"
                    )) ;
            }
        }
}