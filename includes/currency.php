<?php

function convert_currency($amount,$country){

switch($country){

case "Kenya":
return "KES ".($amount*130);

case "Tanzania":
return "TZS ".($amount*2500);

case "Uganda":
return "UGX ".($amount*3800);

case "USA":
return "$".$amount;

case "UK":
return "£".($amount*0.8);

default:
return "$".$amount;

}

}
?>