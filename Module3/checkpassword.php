<!DOCTYPE HTML>
<?php
session_start();
require 'connectingtodatabase.php';
$username = (string)$_POST['user'];
$pwd_guess = (string)$_POST['passwd'];
//if(!hash_equals($_SESSION['token'], $_POST['token'])){
//	die("Request forgery detected");
//}
$stmt = $mysqli->prepare("select COUNT(*), id, name, passwd, country from users where name = ? group by id");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}
$stmt->bind_param('s',$username);
$stmt->execute();

$stmt->bind_result($cnt, $user_id, $name, $pwd_hash, $country);
$stmt->fetch();

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash))
{
        echo 'login successful!';
        $_SESSION['userid']= $user_id;
        $_SESSION['usercountry']= $country;
        $_SESSION['username']=$username;
        header("refresh:2; url=mainpage.php");
        $stmt->close();
        exit;
}
echo "</ul>\n";
echo 'invalid username or passwd';
$stmt->close();
?>
