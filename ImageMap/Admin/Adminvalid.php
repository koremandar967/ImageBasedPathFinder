<?php
include('valid.php');


if(isset($_POST['content1']))
{

$mess="";
$content1=mysql_real_escape_string($_POST['content1']);
$content2=mysql_real_escape_string($_POST['content2']);
$content3=mysql_real_escape_string($_POST['content3']);
$content4=mysql_real_escape_string($_POST['content4']);

$mess.=nullvalid($content1,"Enter First Name, ");
$mess.=nullvalid($content2,"Enter Last Name, ");
$mess.=nullvalid($content3,"Enter Email, ");
$mess.=nullvalid($content4,"Enter Password,");

if($mess=="")
	{
	echo "Yes";
	}
	else
	{
	echo $mess;
	}

}


if(isset($_POST['ucontent']))
{

$mess="";

$ucontent1=mysql_real_escape_string($_POST['ucontent1']);
$ucontent2=mysql_real_escape_string($_POST['ucontent2']);
$ucontent3=mysql_real_escape_string($_POST['ucontent3']);
$ucontent4=mysql_real_escape_string($_POST['ucontent4']);

$mess.=nullvalid($ucontent1,"Enter First Name, ");
$mess.=nullvalid($ucontent2,"Enter Last Name, ");
$mess.=nullvalid($ucontent3,"Enter Email, ");
$mess.=nullvalid($ucontent4,"Enter Password,");

if($mess=="")
	{
		echo "Yes";
	}
	else
	{
		echo $mess;
	}

}

?>