<?php
namespace Models;

class Utils
{
	public static function getDB()
	{
        include __DIR__."/../../configs/credentials.php" ;
        
        return new \PDO("mysql:dbname=".
        $db_connect['db_name'].";host=".
        $db_connect['server'] , 
        $db_connect['username'] , 
        $db_connect['password']);
    }
    // public static function getUserinfo($username)
    // {
    //     $db=self::getDB();
    //     $query=$db->prepare('
    //             SELECT username,points,isadmin FROM users WHERE username=:username
    //         ');
    //     $query->execute(array(
    //         "username"=>$username
    //     ));
    //     $user=$query->fetch(\PDO::FETCH_ASSOC);
    //     return $user;
    // }
    
    // public static function getQuestion($number)
    // {
    //     $db=self::getDB();
    //     $query=$db->prepare("
    //             SELECT * FROM questions WHERE number =:number
    //         ");
    //     $query->execute(array(
    //         "number"=>$number
    //     ));
    //     $question=$query->fetch(\PDO::FETCH_ASSOC);
    //     return $question;
    // }
    //     public static function getQuestions()
    // {
    //     $db=self::getDB();
    //     $question=$db->prepare('
    //             SELECT * FROM questions
    //         ');
    //     $question->execute();
    //     $questions=$question->fetchAll();
    //     return $questions;
    // }
}

?>