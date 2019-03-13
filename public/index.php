<?php

require_once __DIR__ . "/../vendor/autoload.php";
Toro::serve(array(
"/" => "Controllers\\HomeController",
"/login"=>"Controllers\\LoginController",
"/signup"=>"Controllers\\SignupController",
"/solve"=>"Controllers\\SolveController",
"/add"=>"Controllers\\AddController",
"/leaderboard"=>"Controllers\\LeaderboardController",
"/logout"=>"Controllers\\LogoutController",
"/problem"=>"Controllers\\QuestionController",
"/questions"=>"Controllers\\QuestionsController",
"/change"=>"Controllers\\ChangeController"
));

?>