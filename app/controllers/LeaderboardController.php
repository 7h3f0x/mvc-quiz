<?php

namespace Controllers;
use Models\Utils;
use Models\Leaderboard;
class LeaderboardController
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
    		$users=Leaderboard::getUsers();
            $rank=0;
            $count=0;
            $score=-1;
            foreach ($users as &$user)
            {
                if ($user['points']===$score)
                {
                    $user['rank']=$rank;
                    $count++;
                }
                else
                {
                    $rank+=1+$count;
                    $score=$user['points'];
                    $count=0;
                    $user['rank']=$rank;
                }
            }
            $username=Utils::getUserinfo($_COOKIE['user']);
            echo $this->twig->render("leaderboard.html",array(
                "userinfo"=>$username,
                "users"=>$users
            ));
            }
            else
            {
                header("Location: /");
            }
    	}
}