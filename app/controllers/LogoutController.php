<?php

namespace Controllers;
class LogoutController
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
                unset($_COOKIE[user]);
                setcookie('user','',time()-3600,'/');
            }
            header("Location: /");
    	}
}