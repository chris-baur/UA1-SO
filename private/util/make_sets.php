<?php

$myObj = null;
$myObj->genders = ["Male","Female","Other"];
$myObj->professions = ["Gamer","Student","Potatoe","Teacher","Professor","Hipster","Trainer","Sloth"];
$myObj->security_one = ["What is the first name of the person you first kissed?","What is the last name of the teacher who gave you your first failing grade?","What is your pet’s name?",
    "What was the name of your elementary / primary school?","In what city or town does your nearest sibling live?","What was your childhood nickname?","What is the name of your favorite childhood friend?"];
$myObj->security_two = ["In what city or town did your mother and father meet?","What is the middle name of your oldest child?","What is your favorite team?","What is your favorite movie?",
    "What was your favorite sport in high school?","What was your favorite food as a child?","Who is your childhood sports hero?","What was the name of the company where you had your first job?"];

$myJSON = json_encode($myObj);

echo file_put_contents("..\..\..\sets.txt",$myJSON);
//echo '\'' . implode('\',\'', $myObj->genders) . '\'';
?>