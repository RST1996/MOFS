<?php
echo $string = "INSERT INTO `acad_response` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `response`) VALUES ,('1', '1', '1', '8', '5'),('1', '10', '2', '8', '4'),('1', '1', '1', '9', '3'),('1', '10', '2', '9', '2'),('1', '9', '3', '4', '0')";

echo "<br />";
$patterns = '/VALUES ,/';
$replacements = 'VALUES ';
$string = preg_replace($patterns, $replacements, $string);

echo $string;
?>