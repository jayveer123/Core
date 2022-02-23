<?php

# Understand the variable declaration, assignment and output with echo, print_r(), var_dump()

# Declaration

/*
	- It mean that you declare a variable with spacific name 
	- In php variable declare with '$' sign
	- You can define or declare variable with $ sign and it automatic define its datatype as per its value you assign
*/

# Assignment

/*
	- In php you asign avalue to a variable like $(variable_name) = 'String Value'
	- You Can give int value without ''.
*/

# Output

/*
	- There Are Diffrent Type Of Variable there in php
	- All variable can be showed in diffrent way
*/

	# Echo 
	/*
		- echo can be use as print any string , int or single asign value to a variable 
		- like , $name = "Hellow";
		- echo $name;
		- It can simply print " Helow " on screen
	*/
	# print_r()
	/*
		-It is used for read a array variable in php
		-declare array like this
		- $myarray = array('Helow','Worls');
		- print_r($myarray);
		- It will show the array with its index as key
	*/
	# var_dump()
	/*
		-it is used to show the variable data type , value length , and the value
		-it work on array as same.
		- like ,
		-$arrayName = array('jay','veer');
		-var_dump($arrayName);
		- It Define wich type of variable we define
	*/

# ----------------------------------------------------------------------------------------------------------

# Conditions

	
echo "<pre>";
$val3=30;
$val1=10;
$val2=50;
if($val1<$val2)
{
	if($val2>$val3)
	{
		echo $val2." is max";
	}
	else
	{
		echo $val3." is max";
	}
}
else
{
	if($val1>$val3)
	{
		echo $val1." is max";
	}
	else
	{
		echo $val3." is max";
	}
}

?>