<?php

include_once('../UrlClean.php');

define('BASE_URL' , '/example/');
/** Here we will be providing the directory location where our index.php file is stored and make sure to add slash ( / ) on both ends  **/ 


$inst = new UrlClean();
/** Now we will be creating an instance of the UrlClean class and giving it to the variable $inst **/


/** We will be calling a function RunFun of UrlClean class and providing two parameters--- 
1-The name of variables in the url (here u1),
2-The function we want to run if the no. of parameters in the url is equal to that in the first parameter **/




$inst->RunFun("u1",function($data){
	//This function will run if only one parameter is defined in the url
	extract($data);
	/** Here we wil use extract($data) in order to extract the create the variable. This is pre-requisite and should be done inside every RunFun() in order to get the values of the url parameters in form of variables. **/
	echo "$u1 = ".$u1."<br>";
	//Now we echo the variable u1. You can use this variable to do other stuff.
});


$inst->RunFun("u1/u2",function($data){
	//This function will run if two parameter is defined in the url
	extract($data);
	echo "$u1 = ".$u1."<br>";
	echo "$u2 = ".$u2."<br>";
});

$inst->RunFun("u1/u2/u3",function($data){
	//This function will run if three parameter is defined in the url
	extract($data);
	echo "$u1 = ".$u1."<br>";
	echo "$u2 = ".$u2."<br>";
	echo "$u3 = ".$u3."<br>";
});




?>


