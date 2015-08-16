<?php

//STEP 1 Connect To Database

$connect = mysql_connect("localhost","root","");
if (!$connect)
{
die("MySQL could not connect!");
}

$DB = mysql_select_db('Register');

if(!$DB)
{
die("My SQL could not select Database!");
}

//STEP 2 Declare Variables

$Username = $_POST['username'];
$Email = $_POST['email'];
$Email1 = "@";
$Email_Check = strpos($Email,$Email1);
$Password = $_POST['password'];
$Re_Password = $_POST['re-password'];
$Birth = $_POST['birth'];

//STEP 3 Check To See If All Information Is Correct

if($Username == "")
{
echo "<script>alert('Oops! You didn't enter a username');
window.location = 'register.php';</script>";
}

if($Password == "" || $Re_Password == "")
{
echo "<script>alert('Oops!You didn't enter one of your passwords!');
window.location = 'register.php';</script>";
}

if($Birth == "")
{
echo "<script>alert('Oops!You never entered in your birth year!!');
window.location = 'register.php';</script>";
}

if($Password != $Re_Password)
{
echo "<script>alert('Your passwords don't match! Try again.');
window.location = 'register.php';</script>";
}

if($Email_Check === false)
{
echo "<script>alert('That's not an email!.');
window.location = 'register.php';</script>";
}

//STEP 4 Insert Information Into MySQL Database

if(!mysql_query("INSERT INTO users (email, username, password, birth)
VALUES ('$Email', '$Username', '$Password', '$Birth')"))
{
die("We could not register you due to a mysql error (Contact the website owner if this continues to happen.)");}
else
{
echo "<script>alert('You have successfully signed up!.');
window.location = 'login.php';</script>";
}

?>