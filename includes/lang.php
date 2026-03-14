<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : "en";

$text = [

"en" => [
"welcome" => "Welcome to BuildSmart",
"find_constructors" => "Find Constructors"
],

"sw" => [
"welcome" => "Karibu BuildSmart",
"find_constructors" => "Tafuta Wakandarasi"
]

];

function t($key){
global $text,$lang;
return $text[$lang][$key] ?? $key;
}

?>